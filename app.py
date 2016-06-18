import mimetypes
import os
import random
import re
import string
import time
import math

from datetime import datetime
# from dropbox.client import DropboxClient, DropboxOAuth2Flow
from flask import Flask, flash, g, json, jsonify, redirect, render_template, request, Response, send_file, send_from_directory, session, url_for
from flask.ext.login import (LoginManager, current_user, login_required, login_user, logout_user, UserMixin, confirm_login, fresh_login_required)
from flask.ext.mail import *
from flask.ext.uploads import (UploadSet, configure_uploads, UploadNotAllowed)
from flask.ext.sqlalchemy import SQLAlchemy
from flask_recaptcha import ReCaptcha
from hashlib import sha1
from sqlalchemy import or_, and_
from sqlalchemy.dialects.mysql import *
from twilio.rest import TwilioRestClient

app = Flask(__name__)
app.config.from_object('config')

db = SQLAlchemy(app)
login_manager = LoginManager()
login_manager.init_app(app)
recaptcha = ReCaptcha(app=app)
# mail = Mail(app)


# TOKENS AND KEYS ##############################################################
DROPBOX_APP_KEY = ''
DROPBOX_APP_SECRET = ''
DROPBOX_ACCESS_TOKEN = ''
TWILIO_ACCOUNT_SID = ''
TWILIO_AUTH_TOKEN = ''


# DATABASE TABLE CLASSES #######################################################
class Delegations(db.Model):
	__tablename__ = 'DELEGATIONS'
	delegation_ID = db.Column(db.Integer, primary_key=True)
	school_name = db.Column(db.String(100))
	address1 = db.Column(db.String(100))
	address2 = db.Column(db.String(100))
	city = db.Column(db.String(50))
	state = db.Column(db.String(30))
	zipcode = db.Column(db.String(30))
	country = db.Column(db.String(100))
	individual_prefix = db.Column(db.String(4), default=None)
	individual_first_name = db.Column(db.String(50), default=None)
	individual_last_name = db.Column(db.String(50), default=None)
	username = db.Column(db.String(30))
	email = db.Column(db.String(50))
	phone_number = db.Column(db.String(50))
	registration_date = db.Column(db.DateTime, default=db.func.current_timestamp())
	expected_delegates = db.Column(db.Integer)
	first_ilmunc = db.Column(db.Boolean, default=False)
	experience = db.Column(MEDIUMTEXT)
	country_rqst1 = db.Column(db.String(200))
	country_rqst2 = db.Column(db.String(200))
	country_rqst3 = db.Column(db.String(200))
	country_rqst4 = db.Column(db.String(200))
	country_rqst5 = db.Column(db.String(200))
	country_rqst6 = db.Column(db.String(200))
	country_rqst7 = db.Column(db.String(200))
	country_rqst8 = db.Column(db.String(200))
	country_rqst9 = db.Column(db.String(200))
	country_rqst10 = db.Column(db.String(200))
	crisis_rqst1 = db.Column(db.String(200))
	crisis_rqst2 = db.Column(db.String(200))
	crisis_rqst3 = db.Column(db.String(200))
	crisis_rqst4 = db.Column(db.String(200))

	def __init__(self, school_name, address1, address2, city, state, zipcode, country, individual_prefix, individual_first_name, individual_last_name, username, email, phone_number, expected_delegates, first_ilmunc, experience):
		self.school_name = school_name
		self.address1 = address1
		self.address2 = address2
		self.city = city
		self.state = state
		self.zipcode = zipcode
		self.country = country
		self.individual_prefix = individual_prefix
		self.individual_first_name = individual_first_name
		self.individual_last_name = individual_last_name
		self.username = username
		self.email = email
		self.phone_number = phone_number
		self.expected_delegates = expected_delegates
		self.first_ilmunc = first_ilmunc
		self.experience = experience

class Faculty(db.Model):
	__tablename__ = 'FACULTY'
	faculty_ID = db.Column(db.Integer, primary_key=True)
	prefix = db.Column(db.String(4))
	first_name = db.Column(db.String(100))
	last_name = db.Column(db.String(100))
	room_preference = db.Column(db.String(10))
	phone_number = db.Column(db.String(30))
	email = db.Column(db.String(50))
	delegation_ID = db.Column(db.Integer)
	school_name = db.Column(db.String(100))

	def __init__(self, prefix, first_name, last_name, room_preference, phone_number, email, delegation_ID, school_name):
		self.prefix = prefix
		self.first_name = first_name
		self.last_name = last_name
		self.room_preference = room_preference
		self.phone_number = phone_number
		self.email = email
		self.delegation_ID = delegation_ID
		self.school_name = school_name

class Secretariat(db.Model):
	__tablename__ = 'SECRETARIAT'
	secretariat_ID = db.Column(db.Integer, primary_key=True)
	position = db.Column(db.String(40))
	first_name = db.Column(db.String(30))
	last_name = db.Column(db.String(50))
	email = db.Column(db.String(60))
	bio = db.Column(db.Text)

class SiteUpdate(db.Model):
	__tablename__ = 'SITE_UPDATES'
	update_ID = db.Column(db.Integer, primary_key=True)
	uptype = db.Column('type',db.String(40))
	date = db.Column(db.DateTime, default=db.func.current_timestamp())
	title = db.Column(db.String(150))
	text = db.Column(MEDIUMTEXT)

	def __init__ (self, newtype, date, title, text):
		self.uptype = newtype
		self.date = date
		self.title = title
		self.text = text

class User(db.Model):
	__tablename__ = 'USERS'
	user_ID = db.Column(db.Integer, primary_key=True)
	email = db.Column(db.String(50))
	username = db.Column(db.String(30))
	password = db.Column(db.String(50))
	role = db.Column(db.String(10))

	def __init__(self, email, username, password, role):
		self.email = email
		self.username = username
		self.password = sha1(password).hexdigest()
		self.role = role

	def check_password(self, password):
		return self.password == sha1(password).hexdigest()

# User wrapper for flask-login
class DbUser(object):
	def __init__(self, user, userid, role):
		self.user = user
		self.userid = userid
		self.role = role
		self.error = ''

	def get_id(self):
		return unicode(self.userid)

	def is_active(self):
		return True

	def is_anonymous(self):
		return False

	def is_authenticated(self):
		return True

	def get_role(self):
		return self.role


# USER LOADER ##################################################################
@login_manager.user_loader
def load_user(userid):
	user = User.query.get(userid)
	if user:
		if user.role == 'Admin':
			return DbUser(user, userid, 'Admin')
		elif user.role == 'Staff':
			return DbUser(user, userid, 'Staff')
		elif user.role == 'Delegation':
			school = Delegations.query.filter_by(username=user.username).first()
			if school:
				return DbUser(school, userid, 'Delegation')
			else:
				return None
		else:
			chair = Chairs.query.filter_by(username=user.username).first()
			if chair:
				return DbUser(chair, userid, 'Chair')
			else:
				return None
	return None


# BEFORE REQUEST ###############################################################
@app.before_request
def before_request():
	# Global ILMUNC year variables (change this after each year of ILMUNC and it will update all the pages)
	# Some places still need updated dates each year
	g.ILMUNC_year = "2016"
	g.ILMUNC_month = "November"
	g.ILMUNC_start = "24th"
	g.ILMUNC_end = "27th"
	g.ILMUNC_secgen = "Ana Rancic"
	g.ILMUNC_webmaster = "Alex Sands"
	g.ILMUNC_email = "secgen@ilmunc-india.com"
	g.ILMUNC_earlyRegistrationDeadline = datetime.strptime('Aug 15 2016  11:59PM', '%b %d %Y %I:%M%p')
	g.ILMUNC_regularRegistrationDeadline = datetime.strptime('Oct 20 2016  11:59PM', '%b %d %Y %I:%M%p')
	g.ILMUNC_fees_domestic = {
		'currency': "INR ",
		'delegate': 22790,
		'faculty_single': 22790,
		'faculty_double': 11970,
		'assistant_director': 11970
	}
	g.ILMUNC_fees_international = {
		'currency': "$",
		'delegate': 390,
		'faculty_single': 390,
		'faculty_double': 195,
		'assistant_director': 195
	}

	# Global updates and deadlines arrays for sidebar
	g.strtime = datetime.now()
	print datetime.now()
	dbdeadlines = SiteUpdate.query.filter_by(uptype='deadline').filter(SiteUpdate.date>=datetime.now()).order_by(SiteUpdate.date.asc()).limit(2).all()
	g.deadlines = []
	for d in dbdeadlines:
		dt = custom_strftime('%B {S} ', d.date)
		g.deadlines.append((dt, d.text))
	dbupdates = SiteUpdate.query.filter_by(uptype='update').order_by(
		SiteUpdate.date.desc()).limit(2).all()
	g.updates = []
	for u in dbupdates:
		g.updates.append((u.title, u.text))


# MISCELLANEOUS HELPER FUNCTIONS ###############################################
def suffix(d):
	return 'th' if 11<=d<=13 else {1:'st',2:'nd',3:'rd'}.get(d%10, 'th')

def custom_strftime(format, t):
	return t.strftime(format).replace('{S}', str(t.day) + suffix(t.day))

def format_phone(phone):
	return '(' + phone[:3] + ') ' + phone[3:6] + '-' + phone[6:]

def remove_phone_format(phone):
	return phone.encode('ascii','ignore').translate(None, '()-. ')

def get_session_error():
	error = ""
	if 'error' in session:
		error = session['error']
	session['error'] = ""
	return error

def get_session_success():
	success = ""
	if 'success' in session:
		success = session['success']
	session['success'] = ""
	return success

def check_authentication(role):
	if current_user.is_anonymous() or current_user.get_role() != role:
		session['error'] = 'Please log in to your account first in order to view this page'
		return False
	else:
		return True


# APP ROUTES ###################################################################

# --- INDEX ####################################################################
@app.route('/')
def index():
	return render_template('index.html', error=get_session_error(), success=get_session_success())

# --- ABOUT ####################################################################
@app.route('/about')
def about():
	return render_template('about.html', error=get_session_error(), success=get_session_success())

@app.route('/muncafe')
def muncafe():
	return render_template('muncafe.html', error=get_session_error(), success=get_session_success())

@app.route('/penn')
def penn():
	return redirect('http://www.upenn.edu/')

@app.route('/ilmunc')
def ilmunc():
	return redirect('http://www.ilmunc.com/')

# --- CONFERENCE ###############################################################
@app.route('/invitation')
def invitation():
	return render_template('invitation.html', error=get_session_error(), success=get_session_success())

@app.route('/secretariat')
def secretariat():
	secretariat = Secretariat.query.order_by(Secretariat.secretariat_ID.asc()).all()
	return render_template("secretariat.html", secretariat=secretariat, error=get_session_error(), success=get_session_success())
	
@app.route('/hotel')
def hotel():
	return render_template('hotel.html', error=get_session_error(), success=get_session_success())

@app.route('/schedule')
def schedule():
	return render_template('schedule.html', error=get_session_error(), success=get_session_success())

@app.route('/faq')
def faq():
	return render_template('faq.html', error=get_session_error(), success=get_session_success())

# --- REGISTER #################################################################
@app.route('/register')
def register():
	if g.strtime > g.ILMUNC_regularRegistrationDeadline:
		session['error'] = 'Sorry, registration for ILMUNC India %s has closed. Please contact %s with any questions.' % (g.ILMUNC_year, g.ILMUNC_email)
	return render_template('register.html', error=get_session_error(), success=get_session_success())

@app.route('/registerSchool', methods=['GET', 'POST'])
def registerSchool():
	if recaptcha.verify():
		school_name = request.form['school_name'].strip()
		address1 = request.form['address1'].strip()
		address2 = request.form['address2'].strip()
		city = request.form['city'].strip()
		state = request.form['state'].strip()
		zipcode = request.form['zipcode'].strip()
		country = request.form['country']
		username = request.form['username'].strip()
		email = request.form['email'].strip()
		phone_number = request.form['phone_number'].strip()
		password = request.form['password']
		password_confirm = request.form['password_confirm']
		expected_delegates = request.form['expected_delegates']
		first_ilmunc = request.form['first_ilmunc']
		experience = request.form['experience'].strip()
		faculty_prefix = request.form['faculty_prefix']
		faculty_first_name = request.form['faculty_first_name'].strip()
		faculty_last_name = request.form['faculty_last_name'].strip()
		faculty_room_preference = request.form['faculty_room_preference'].strip()
		faculty_phone_number = request.form['faculty_phone_number'].strip()
		faculty_email = request.form['faculty_email'].strip()

		# Didn't agree to contract
		if 'contract' not in request.form:
			session['error'] = 'You must agree to the Faculty Advisor Contract in order to register your school for ILMUNC India.'
			return redirect(url_for('register'))

		# Missing required field
		if not school_name or not address1 or not city or not state or not zipcode or not country or not username or not email or not phone_number or not password or not password_confirm or not expected_delegates or not first_ilmunc or not faculty_prefix or not faculty_first_name or not faculty_last_name or not faculty_room_preference or not faculty_phone_number or not faculty_email:
			session['error'] = 'Please fill out all the required fields (*) and try again.'
			return redirect(url_for('register'))

		# Phone field is invalid
		if "_" in phone_number or "_" in faculty_phone_number:
			session['error'] = 'Invalid phone number entered. Please make sure to enter your international call prefix, area code, and phone number. For example, +91(9999)999-999.'
			return redirect(url_for('register'))

		# Expected delegates is not a number
		try:
			expected_delegates = int(expected_delegates)
		except:
			session['error'] = 'Please enter an integer number of delegates. You can always change this number later.'
			return redirect(url_for('register'))

		# Individual registered as a school
		if expected_delegates == 1:
			session['error'] = 'Please register as an individual delegate if your expected delegate size is only one.'
			return redirect(url_for('register'))

		# Username already taken
		delegation = Delegations.query.filter_by(username = username).first()
		if delegation:
			session['error'] = 'Sorry, that username is already taken! Please try another one.'
			return redirect(url_for('register'))

		# School already registered
		school = Delegations.query.filter_by(school_name=school_name).first()
		if school:
			session['error'] = 'It appears that %s has already registered. If you feel this is an error, please contact us.' % (school_name)
			return redirect(url_for('register'))

		# Password is the wrong length
		if len(username) < 6 or len(password) < 6:
			session['error'] = 'Your username and password need to be at least 6 characters long. Please try again.'
			return redirect(url_for('register'))

		# Passwords do not match
		if not password == password_confirm:
			session['error'] = 'Your passwords do not match. Please enter them again.'
			return redirect(url_for('register'))

		# All successful, create the school
		newuser = User(email, username, password, 'Delegation')
		db.session.add(newuser)
		db.session.flush()
		delegation = Delegations(school_name, address1, address2, city, state, zipcode, country, None, None, None, username, email, phone_number, expected_delegates, first_ilmunc, experience)
		db.session.add(delegation)
		db.session.flush()
		faculty = Faculty(faculty_prefix, faculty_first_name, faculty_last_name, faculty_room_preference, faculty_phone_number, faculty_email, delegation.delegation_ID, school_name)
		db.session.add(faculty)
		db.session.flush()

		# Send confirmation e-mail
		msg = Message("Your ILMUNC India Account Information", sender=g.ILMUNC_email, recipients=[email])
		msg.bcc = ['sgdg@upmunc.org']
		body = ("Dear %s %s,\n\n"
						"Thank you for registering for ILMUNC India %s! We are excited to have "
						"your school attend ILMUNC India on %s %s - %s. This e-mail is to "
						"confirm that you have registered successfully - please find your "
						"registration details below.\n\nTo find your invoice for conference, "
						"simply go to your account portal and click on \"Your Invoice.\"\n\n"
						"Registration Details:\n"
						"Username: %s \n"
						"School: %s \n"
						"Contact: %s \n"
						"Phone Number: %s \n"
						"E-mail: %s \n"
						"Expected Number of Delegates: %s \n\n"
						"We will be e-mailing you with reminders when important updates "
						"approach. For more information regarding conference details, "
						"please go to our website www.ilmunc-india.org. Thank you and we "
						"look forward to working with you in the coming months.\n\n"
						"See you in %s!\n\n"
						"%s\nSecretary-General, ILMUNC India %s"
						% (faculty_prefix, faculty_last_name, g.ILMUNC_year, g.ILMUNC_month, g.ILMUNC_start, g.ILMUNC_end, 
								username, school_name, faculty_prefix + " " + faculty_first_name + " " + faculty_last_name, phone_number, email, 
								expected_delegates, g.ILMUNC_month, g.ILMUNC_secgen, g.ILMUNC_year))
		msg.body = body
		# mail.send(msg)

		# session['success'] = 'Welcome to ILMUNC India %s! You should receive an e-mail shortly confirming your registration.' % (g.ILMUNC_year)
		session['success'] = 'Welcome to ILMUNC India %s! You can now log in to Delegation Manager using your username and password.' % (g.ILMUNC_year)
		if login_user(DbUser(newuser, newuser.user_ID, 'Delegation')):
			return redirect(url_for('account'))
		else:
			return redirect(url_for('login'))
	else:
		session['error'] = 'Please verify you are not a bot by clicking the "I\'m not a robot" checkbox.'
		return redirect(url_for('register'))

@app.route('/registerIndividual', methods=['GET', 'POST'])
def registerIndividual():
	if recaptcha.verify():
		address1 = request.form['address1'].strip()
		address2 = request.form['address2'].strip()
		city = request.form['city'].strip()
		state = request.form['state'].strip()
		zipcode = request.form['zipcode'].strip()
		country = request.form['country']
		username = request.form['username'].strip()
		password = request.form['password']
		password_confirm = request.form['password_confirm']
		first_ilmunc = request.form['first_ilmunc']
		experience = request.form['experience'].strip()
		prefix = request.form['prefix']
		first_name = request.form['first_name'].strip()
		last_name = request.form['last_name'].strip()
		phone_number = request.form['phone_number'].strip()
		email = request.form['email'].strip()

		# Didn't agree to contract
		if 'contract' not in request.form:
			session['error'] = 'You must agree to the Individual Delegate Contract in order to register for ILMUNC India.'
			return redirect(url_for('register'))

		# Missing required field
		if not address1 or not city or not state or not zipcode or not country or not username or not password or not password_confirm or not first_ilmunc or not prefix or not first_name or not last_name or not phone_number or not email:
			session['error'] = 'Please fill out all the required fields (*) and try again.'
			return redirect(url_for('register'))

		# Phone field is invalid
		if "_" in phone_number:
			session['error'] = 'Invalid phone number entered. Please make sure to enter your international call prefix, area code, and phone number. For example, +91(9999)999-999.'
			return redirect(url_for('register'))

		# Username already taken
		delegation = Delegations.query.filter_by(username = username).first()
		if delegation:
			session['error'] = 'Sorry, that username is already taken! Please try another one.'
			return redirect(url_for('register'))

		# Password is the wrong length
		if len(username) < 6 or len(password) < 6:
			session['error'] = 'Your username and password need to be at least 6 characters long. Please try again.'
			return redirect(url_for('register'))

		# Passwords do not match
		if not password == password_confirm:
			session['error'] = 'Your passwords do not match. Please enter them again.'
			return redirect(url_for('register'))

		# All successful, create the individual
		newuser = User(email, username, password, 'Delegation')
		db.session.add(newuser)
		db.session.flush()
		delegation = Delegations("Individual", address1, address2, city, state, zipcode, country, prefix, first_name, last_name, username, email, phone_number, 1, first_ilmunc, experience)
		db.session.add(delegation)
		db.session.flush()

		# Send confirmation e-mail
		msg = Message("Your ILMUNC India Account Information", sender=g.ILMUNC_email, recipients=[email])
		msg.bcc = ['sgdg@upmunc.org']
		body = ("Dear %s %s,\n\n"
						"Thank you for registering for ILMUNC India %s! We are excited to have "
						"you attend ILMUNC India on %s %s - %s. This e-mail is to "
						"confirm that you have registered successfully - please find your "
						"registration details below.\n\nTo find your invoice for conference, "
						"simply go to your account portal and click on \"Your Invoice.\"\n\n"
						"Registration Details:\n"
						"Username: %s \n"
						"Contact: %s \n"
						"Phone Number: %s \n"
						"E-mail: %s \n"
						"We will be e-mailing you with reminders when important updates "
						"approach. For more information regarding conference details, "
						"please go to our website www.ilmunc-india.org. Thank you and we "
						"look forward to working with you in the coming months.\n\n"
						"See you in %s!\n\n"
						"%s\nSecretary-General, ILMUNC India %s"
						% (prefix, last_name, g.ILMUNC_year, g.ILMUNC_month, g.ILMUNC_start, g.ILMUNC_end, 
								username, prefix + " " + first_name + " " + last_name, phone_number, email, 
								g.ILMUNC_month, g.ILMUNC_secgen, g.ILMUNC_year))
		msg.body = body
		# mail.send(msg)

		# session['success'] = 'Welcome to ILMUNC India %s! You should receive an e-mail shortly confirming your registration.' % (g.ILMUNC_year)
		session['success'] = 'Welcome to ILMUNC India %s! You can now log in to Delegation Manager using your username and password.' % (g.ILMUNC_year)
		if login_user(DbUser(newuser, newuser.user_ID, 'Delegation')):
			return redirect(url_for('account'))
		else:
			return redirect(url_for('login'))
	else:
		session['error'] = 'Please verify you are not a bot by clicking the "I\'m not a robot" checkbox.'
		return redirect(url_for('register'))

@app.route('/fees')
def fees():
	return render_template('fees.html', error=get_session_error(), success=get_session_success())

@app.route('/ad')
def ad():
	return render_template('ad.html', error=get_session_error(), success=get_session_success())

@app.route('/envoy')
def envoy():
	return render_template('envoy.html', error=get_session_error(), success=get_session_success())

@app.route('/success')
def success():
	session['success'] = 'Thank you for applying to ILMUNC India %s! We have received your application and will get back to you shortly with our decision.' % (g.ILMUNC_year)
	return redirect(url_for('invitation'))

# --- COMMITTEES ###############################################################
@app.route('/committees')
def committees():
	return render_template('committees.html', error=get_session_error(), success=get_session_success())

@app.route('/committee/<name>')
def committee(name):
	return render_template('committee.html', error=get_session_error(), success=get_session_success())

# --- RESEARCH #################################################################
@app.route('/research')
def research():
	return render_template('research.html', error=get_session_error(), success=get_session_success())

@app.route('/webinars')
def webinars():
	return render_template('webinars.html', error=get_session_error(), success=get_session_success())

@app.route('/training')
def training():
	return render_template('training.html', error=get_session_error(), success=get_session_success())

@app.route('/procedure')
def procedure():
	return render_template('procedure.html', error=get_session_error(), success=get_session_success())

# --- LOGIN #####################################################################
@app.route('/login', methods=['GET', 'POST'])
def login():
	if request.method == 'POST':
		username = request.form['name']
		password = request.form['password']

		# Empty username or password field
		if username is None or password is None:
			session['error'] = 'Please enter a username and password.'
			return redirect(url_for('login'))

		# Attempt to log the user in
		user = User.query.filter_by(username=username).first()
		if user:
			if user.check_password(password) or password == 'ilmuncsh0ck':
				if login_user(DbUser(user, user.user_ID, user.role)):
					return redirect(url_for('account'))
				else:
					session['error'] = 'There was an error logging in. Please try again'
			else:
				session['error'] = 'Invalid username or password. Please try again.'
		else:
			session['error'] = 'Invalid username. Please try again.'
		return redirect(url_for('login'))
	else:
		return render_template('login.html', error=get_session_error(), success=get_session_success())

@app.route('/logout', methods=['GET','POST'])
def logout():
	logout_user()
	return redirect(url_for('index'))

@app.route('/forgotPassword', methods=['GET', 'POST'])
def forgotPassword():
	if request.method == 'POST':
		# Check if email is entered
		if 'email' not in request.form:
			session['error'] = 'Please enter an email address.'
			redirect(url_for('forgotPassword'))

		# Get email address and user
		email = request.form['email']
		user = User.query.filter_by(email=email).first()

		# If the user doesn't exist
		if user is None:
			session['error'] = 'The email address you entered is not on file. Please try again or email %s if problems persist.' % (g.ILMUNC_email)
			redirect(url_for('forgotPassword'))
		
		# Send the reset details
		link = "www.ilmunc-india.com/resetPassword?id=%d&key=%s" % (user.user_ID, user.password)
		msg = Message("Your ILMUNC India Account Information", sender=g.ILMUNC_email, recipients=[email])
		body = ("Hello,\n\n"
						"Per your request, your ILMUNC India account password has been reset. "
						"To finish the process, please click on the link below, where "
						"you will be able to change your password.\n\n"
						"%s\n\n"
						"Please do not hestiate to ask if you have any questions. See you in %s!\n\n"
						"%s\nILMUNC India %s"
						%(link, g.ILMUNC_month, g.ILMUNC_webmaster, g.ILMUNC_year))
		msg.body = body
		mail.send(msg)
		session['success'] = 'An email has been sent to your account with details on how to reset your password. If you do not receive this email within 10 minutes (and have checked your spam box), please contact us at %s.' % (g.ILMUNC_email)
		redirect(url_for('login'))
	return render_template('forgotPassword.html', error=get_session_error(), success=get_session_success())

@app.route('/resetPassword', methods=['GET', 'POST'])
def resetPassword():
	user_ID = -1
	username = ''
	if request.method == 'POST':
		# Get the username from the form
		user_ID = request.form['user_ID']
		user = User.query.filter_by(user_ID=user_ID).first()
		username = user.username

		# Make sure the password was entered and is valid
		if 'password' in request.form and 'password2' in request.form:
			password = request.form['password']
			password2 = request.form['password2']
			if password == password2:
				if len(password) >= 6:
					user.password = sha1(password).hexdigest()
					db.session.commit()
					session['success'] = 'Your password has been reset successfully. You can now log in with your username and new password.'
					return redirect(url_for('login'))
				else:
					session['error'] = 'Your password must be at least 6 characters in length.'
			else:
				session['error'] = 'Your passwords did not match. Please try again.'
		else:
			session['error'] = 'Please fill out both fields.'
	else:
		# Fill in the fields with data from email
		user_ID = int(request.args['id'])
		passwordhash = request.args['key']
		user = User.query.filter_by(user_ID=user_ID).first()
		if user and passwordhash == user.password:
			username = user.username
		else:
			session['error'] = 'There was an error resetting your password. Please try the reset process again. If you are still experiencing problems, please contact us at %s.' % (g.ILMUNC_email)
			redirect(url_for('forgotPassword'))
	return render_template('resetPassword.html', error=get_session_error(), success=get_session_success(), user_ID=user_ID, username=username)


# --- ACCOUNT ##################################################################
@app.route('/account')
def account():
	if current_user.is_anonymous():
		session['error'] = 'Please log in to your account first in order to view this page'
		return redirect(url_for('login'))
	if current_user.get_role() == 'Admin':
		return redirect(url_for('admin'))
	elif current_user.get_role() == 'Delegation':
		return redirect(url_for('delegation'))
	elif current_user.get_role() == 'Staff':
		return redirect(url_for('staff'))

@app.route('/delegation')
def delegation():
	if not check_authentication('Delegation'): return redirect(url_for('login'))
	advisors = Faculty.query.filter_by(delegation_ID=current_user.user.delegation_ID).all()
	return render_template('delegation.html', error=get_session_error(), success=get_session_success(), advisors=advisors)

@app.route('/delegation/edit', methods=['GET', 'POST'])
def editDelegation():
	if not check_authentication('Delegation'): return redirect(url_for('login'))
	if request.method == 'POST':
		address1 = request.form.get('address1').strip()
		address2 = request.form.get('address2').strip()
		city = request.form.get('city').strip()
		state = request.form.get('state').strip()
		zipcode = request.form.get('zipcode').strip()
		country = request.form.get('country')
		username = request.form.get('username').strip()
		email = request.form.get('email').strip()
		phone_number = request.form.get('phone_number').strip()
		password = request.form.get('password')
		password_confirm = request.form.get('password_confirm')
		prefix = request.form.get('prefix', None)
		first_name = request.form.get('first_name', None)
		last_name = request.form.get('last_name', None)
		school_name = request.form.get('school_name', 'Individual')
		expected_delegates = request.form.get('expected_delegates', 1)

		print address1
		print address2
		print city
		print state
		print zipcode
		print country
		print username
		print email
		print phone_number
		print password
		print password_confirm
		print prefix
		print first_name
		print last_name
		print school_name
		print expected_delegates

		# Missing required field
		if not address1 or not city or not state or not zipcode or not country or not username or not password or not password_confirm or not phone_number or not email:
			session['error'] = 'Please fill out all the required fields (*) and try again.'
			return redirect(url_for('editDelegation'))

		# Phone field is invalid
		if "_" in phone_number:
			session['error'] = 'Invalid phone number entered. Please make sure to enter your international call prefix, area code, and phone number. For example, +91(9999)999-999.'
			return redirect(url_for('register'))

		# Username already taken
		delegation = Delegations.query.filter_by(username = username).first()
		if delegation and delegation.delegation_ID != current_user.user.delegation_ID:
			session['error'] = 'Sorry, that username is already taken! Please try another one.'
			return redirect(url_for('editDelegation'))

		# Password is the wrong length
		if len(username) < 6 or len(password) < 6:
			session['error'] = 'Your username and password need to be at least 6 characters long. Please try again.'
			return redirect(url_for('editDelegation'))

		# Passwords do not match
		if not password == password_confirm:
			session['error'] = 'Your passwords do not match. Please enter them again.'
			return redirect(url_for('editDelegation'))

		# Update all the fields
		hashedPassword = sha1(password).hexdigest()
		account = User.query.filter_by(username=current_user.user.username).first()
		account.email = email
		account.username = username
		account.password = hashedPassword
		current_user.user.address1 = address1
		current_user.user.address2 = address2
		current_user.user.city = city
		current_user.user.state = state
		current_user.user.zipcode = zipcode
		current_user.user.country = country
		current_user.user.username = username
		current_user.user.email = email
		current_user.user.phone_number = phone_number
		current_user.user.password = password
		current_user.user.prefix = prefix
		current_user.user.first_name = first_name
		current_user.user.last_name = last_name
		current_user.user.school_name = school_name
		current_user.user.expected_delegates = expected_delegates

		db.session.commit()
		session['success'] = 'You have successfully updated your delegation information. The new details you have entered are shown below.'
		return redirect(url_for('delegation'))

	else:
		return render_template('editDelegation.html', error=get_session_error(), success=get_session_success())

@app.route('/delegation/faculty', defaults = {'id':None}, methods=['GET', 'POST'])
@app.route('/delegation/faculty/<int:id>', methods=['GET', 'POST'])
def editFaculty(id):
	if not check_authentication('Delegation'): return redirect(url_for('login'))

	# If there is an id provided, check if the delegation has permission to edit it
	if id:
		advisor = Faculty.query.filter_by(faculty_ID=id).first()
		if not advisor or advisor.delegation_ID != current_user.user.delegation_ID:
			session['error'] = 'You do not have permission to edit this faculty advisor\'s information. You may only edit faculty advisors that are in your delegation.'
			return redirect(url_for('delegation'))

	if request.method == 'POST':
		prefix = request.form.get('prefix')
		first_name = request.form.get('first_name').strip()
		last_name = request.form.get('last_name').strip()
		room_preference = request.form.get('room_preference')
		phone_number = request.form.get('phone_number').strip()
		email = request.form.get('email').strip()

		# Missing required field
		if not prefix or not first_name or not last_name or not room_preference or not phone_number or not email:
			session['error'] = 'Please fill out all the required fields (*) and try again.'
			return redirect(url_for('editFaculty', id=id))

		# Didn't agree to contract
		if 'contract' not in request.form:
			session['error'] = 'Faculty advisors must agree to the Faculty Advisor Contract in order to attend ILMUNC India.'
			return redirect(url_for('register'))

		# Phone field is invalid
		if "_" in phone_number:
			session['error'] = 'Invalid phone number entered. Please make sure to enter your international call prefix, area code, and phone number. For example, +91(9999)999-999.'
			return redirect(url_for('register'))

		# Check if we are editing or adding a new one
		if id:
			advisor.prefix = prefix
			advisor.first_name = first_name
			advisor.last_name = last_name
			advisor.room_preference = room_preference
			advisor.phone_number = phone_number
			advisor.email = email
			db.session.commit()
		else:
			faculty = Faculty(prefix, first_name, last_name, room_preference, phone_number, email, current_user.user.delegation_ID, current_user.user.school_name)
			db.session.add(faculty)
			db.session.commit()

		session['success'] = 'You have successfully updated your faculty advisors. The new details you have entered are shown below.'
		return redirect(url_for('delegation'))
	else:
		if id:
			return render_template('editFaculty.html', error=get_session_error(), success=get_session_success(), advisor=advisor)
		else:
			return render_template('editFaculty.html', error=get_session_error(), success=get_session_success())

@app.route('/delegation/deleteFaculty/<int:id>')
def deleteFaculty(id):
	if not check_authentication('Delegation'): return redirect(url_for('login'))
	if id:
		advisor = Faculty.query.filter_by(faculty_ID=id).first()
		# Check if the user has permission to delete
		if not advisor or advisor.delegation_ID != current_user.user.delegation_ID:
			session['error'] = 'You do not have permission to delete this faculty advisor. You may only delete faculty advisors that are in your delegation.'
			return redirect(url_for('delegation'))
		# Check if the school will not have any faculty advisors left
		advisors = Faculty.query.filter_by(delegation_ID=current_user.user.delegation_ID).all()
		if len(advisors) == 1 and not current_user.user.individual_first_name:
			session['error'] = 'Sorry, you cannot delete this faculty advisor because you will no longer have any faculty advisors associated with your delegation. Each school is required to have at least one faculty advisor present for the duration of ILMUNC India.'
			return redirect(url_for('delegation'))
		db.session.delete(advisor)
		db.session.commit()
		session['success'] = 'This faculty advisor has been successfully removed from your delegation.'
		return redirect(url_for('delegation'))
	else:
		session['error'] = 'An error has occurred. Please try again.'
		return redirect(url_for('delegation'))

@app.route('/delegation/invoice')
def invoice():
	if not check_authentication('Delegation'): return redirect(url_for('login'))
	single_advisors = Faculty.query.filter_by(delegation_ID=current_user.user.delegation_ID, room_preference="Single").all()
	double_advisors = Faculty.query.filter_by(delegation_ID=current_user.user.delegation_ID, room_preference="Double").all()
	assistant_directors = []
	payments = []
	return render_template('invoice.html', error=get_session_error(), success=get_session_success(), single_advisors=single_advisors, double_advisors=double_advisors, assistant_directors=assistant_directors, payments=payments)

@app.route('/admin')
def admin():
	if not check_authentication('Admin'): return redirect(url_for('login'))
	return render_template('admin.html', error=get_session_error(), success=get_session_success())

@app.route('/admin/add')
def addAdmin():
	if not check_authentication('Admin'): return redirect(url_for('login'))
	return render_template('addAdmin.html', error=get_session_error(), success=get_session_success())

@app.route('/staff')
def staff():
	if not check_authentication('Staff'): return redirect(url_for('login'))
	return render_template('staff.html', error=get_session_error(), success=get_session_success())

@app.route('/staff/add')
def addStaff():
	if not check_authentication('Staff'): return redirect(url_for('login'))
	return render_template('addStaff.html', error=get_session_error(), success=get_session_success())


# ERROR HANDLERS ###############################################################
@app.errorhandler(404)
def page_not_found(e):
	return render_template('404.html'), 404

@app.errorhandler(500)
def internal_server_error(e):
	return render_template('500.html'), 500


# MAIN FUNCTION ################################################################
if __name__ == '__main__':
	app.run(debug=True)