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
from flask_login import (LoginManager, current_user, login_required, login_user, logout_user, UserMixin, confirm_login, fresh_login_required)
from flask_mail import *
from flask_sqlalchemy import SQLAlchemy
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
class Chairs(db.Model):
	__tablename__ = 'CHAIRS'
	chair_ID = db.Column(db.Integer, primary_key=True)
	user_ID = db.Column(db.Integer)
	committee_ID = db.Column(db.Integer)
	first_name = db.Column(db.String(100))
	last_name = db.Column(db.String(100))

	def __init__(self, user_ID, committee_ID, first_name, last_name):
		self.user_ID = user_ID
		self.committee_ID = committee_ID
		self.first_name = first_name
		self.last_name = last_name

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

class BackgroundGuides(db.Model):
	__tablename__ = 'BACKGROUNDGUIDES'
	bg_ID = db.Column(db.Integer, primary_key=True)
	committee_ID = db.Column(db.Integer)
	canonical_url = db.Column(db.String(100))
	title = db.Column(db.String(500))
	date = db.Column(db.DateTime)
	source = db.Column(db.String(500))
	source_url = db.Column(db.String(500))
	image = db.Column(db.String(500))
	text = db.Column(db.Text)

class Committees(db.Model):
	__tablename__ = 'COMMITTEES'
	committee_ID = db.Column(db.Integer, primary_key=True)
	title = db.Column(db.String(100))
	shortname = db.Column(db.String(20))
	organ = db.Column(db.String(50))
	dualdel = db.Column(TINYINT)
	application = db.Column(TINYINT)
	chair = db.Column(db.String(50))
	chair_email = db.Column(db.String(50))
	chair_letter = db.Column(db.Text)
	crisis_director = db.Column(db.String(50))
	crisis_director_email = db.Column(db.String(50))
	crisis_director_letter = db.Column(db.Text)
	Topic_A_name = db.Column(db.String(100))
	Topic_A_summary = db.Column(db.Text)
	Topic_B_name = db.Column(db.String(100))
	Topic_B_summary = db.Column(db.Text)
	update_paper = db.Column(db.String(500))
	vid_code = db.Column(db.String(15))
	vid_code2 = db.Column(db.String(15))
	vid_code3 = db.Column(db.String(15))
	bg_cover = db.Column(db.String(500))
	bg_link = db.Column(db.String(500))
	height = db.Column(db.Integer, default=1385)
	attendance_s1 = db.Column(TINYINT)
	attendance_s2 = db.Column(TINYINT)
	attendance_s3 = db.Column(TINYINT)
	attendance_s4 = db.Column(TINYINT)
	attendance_s5 = db.Column(TINYINT)
	attendance_s6 = db.Column(TINYINT)
	attendance_s7 = db.Column(TINYINT)
	attendance_s8 = db.Column(TINYINT)
	attendance_s9 = db.Column(TINYINT)
	attendance_s10 = db.Column(TINYINT)
	attendance_s11 = db.Column(TINYINT)
	points_d1 = db.Column(TINYINT)
	points_d2 = db.Column(TINYINT)
	points_d3 = db.Column(TINYINT)
	awards = db.Column(TINYINT)
	location = db.Column(db.String(100))
	closing_remarks = db.Column(db.Text)
	notes = db.Column(db.Text)

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

class Payments(db.Model):
	__tablename__ = 'PAYMENTS'
	payment_ID = db.Column(db.Integer, primary_key=True)
	payment_date = db.Column(db.DateTime)
	payment_amount = db.Column(db.Float)
	payment_currency = db.Column(db.String(3))
	payment_method = db.Column(db.String(25))
	delegation_ID = db.Column(db.Integer)
	school_name = db.Column(db.String(100))

	def __init__(self, payment_date, payment_amount, payment_currency, payment_method, delegation_ID, school_name):
		self.payment_date = payment_date
		self.payment_amount = payment_amount
		self.payment_currency = payment_currency
		self.payment_method = payment_method
		self.delegation_ID = delegation_ID
		self.school_name = school_name

class Positions(db.Model):
	__tablename__ = 'POSITIONS'
	position_ID = db.Column(db.Integer, primary_key=True)
	position = db.Column(db.String(100))
	committee_ID = db.Column(db.Integer)
	delegation_ID = db.Column(db.Integer)
	school_name = db.Column(db.String(100))
	first_name = db.Column(db.String(100))
	last_name = db.Column(db.String(100))
	attendance_s1 = db.Column(db.Integer)
	attendance_s2 = db.Column(db.Integer)
	attendance_s3 = db.Column(db.Integer)
	attendance_s4 = db.Column(db.Integer)
	attendance_s5 = db.Column(db.Integer)
	attendance_s6 = db.Column(db.Integer)
	attendance_s7 = db.Column(db.Integer)
	attendance_s8 = db.Column(db.Integer)
	attendance_s9 = db.Column(db.Integer)
	attendance_s10 = db.Column(db.Integer)
	attendance_s11 = db.Column(db.Integer)
	points_d1 = db.Column(db.Integer)
	points_d2 = db.Column(db.Integer)
	points_d3 = db.Column(db.Integer)
	speaking_count = db.Column(db.Integer)
	award = db.Column(db.String(30))

	def __init__(self, position, committee_ID, delegation_ID, school_name):
		self.position = position
		self.committee_ID = committee_ID
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
			chair = Chairs.query.filter_by(user_ID=user.user_ID).first()
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
	g.ILMUNC_year = "2017"
	g.ILMUNC_month = "November"
	g.ILMUNC_start = "23rd"
	g.ILMUNC_end = "26th"
	g.ILMUNC_secgen = "Siddharth Kumar"
	g.ILMUNC_webmaster = "Noah Levine"
	g.ILMUNC_email = "secgen@ilmunc-india.com"
	g.ILMUNC_earlyRegistrationDeadline = datetime.strptime('Aug 15 2017  11:59PM', '%b %d %Y %I:%M%p')
	g.ILMUNC_regularRegistrationDeadline = datetime.strptime('Nov 23 2017  6:59PM', '%b %d %Y %I:%M%p')
	g.ILMUNC_adApplicationDeadline = datetime.strptime('Jul 30 2017  11:59PM', '%b %d %Y %I:%M%p')
	g.ILMUNC_fees_domestic = {
		'currency': "INR ",
		'delegate': 23500,
		'faculty_single': 24500,
		'faculty_double': 12500,
		'assistant_director': 12500
	}
	g.ILMUNC_fees_international = {
		'currency': "$",
		'delegate': 380,
		'faculty_single': 390,
		'faculty_double': 200,
		'assistant_director': 200
	}
	g.ILMUNC_sessions = ["Committee Session I - Thursday, 6:30PM", "Committee Session II - Friday, 9:00AM", "Committee Session III - Friday, 11:00AM", "Committee Session IV - Friday, 2:00PM", "Committee Session V - Friday, 4:00PM", "Midnight Crisis - Saturday, 12:00AM", "Committee Session VII - Saturday, 11:00AM", "Committee Session VIII - Saturday, 2:00PM", "Committee Session IX - Saturday, 4:00PM", "Committee Session X - Sunday, 9:30AM", "Committee Session XI - Sunday, 11:30AM"]

	# Global updates and deadlines arrays for sidebar
	g.strtime = datetime.now()
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

def validate_username_available(username):
	# Username already taken
	user = User.query.filter_by(username = username).first()
	if user:
		session['error'] = 'Sorry, that username is already taken! Please try another one.'
		return False
	else:
		return True

def validate_username_length(username):
	# Password is the wrong length
	if len(username) < 6:
		session['error'] = 'Your username needs to be at least 6 characters long. Please try again.'
		return False
	else:
		return True

def validate_password_length(password):
	# Password is the wrong length
	if len(password) < 6:
		session['error'] = 'Your password needs to be at least 6 characters long. Please try again.'
		return False
	else:
		return True

def validate_passwords_match(password, password_confirm):
	# Passwords do not match
	if password != password_confirm:
		session['error'] = 'Your passwords do not match. Please enter them again.'
		return False
	else:
		return True

def validate_phone_number(phone_number):
	# Phone field is invalid
	if "_" in phone_number:
		session['error'] = 'Invalid phone number entered. Please make sure to enter your international call prefix, area code, and phone number. For example, +91(9999)999-999.'
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

@app.route('/ivycentral')
def ivycentral():
	return redirect('http://www.ivycentral.com/')

@app.route('/coke')
def coke():
	return redirect('https://www.coca-colaindia.com/')

@app.route('/ashoka')
def ashoka():
	return redirect('https://www.ashoka.edu.in/')

@app.route('/terms')
def terms():
	return render_template('terms.html', error=get_session_error(), success=get_session_success())

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
		faculty_first_name = request.form['faculty_first_name'].strip().title()
		faculty_last_name = request.form['faculty_last_name'].strip().title()
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
		if not validate_phone_number(phone_number) or not validate_phone_number(faculty_phone_number):
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
		if not validate_username_available(username):
			return redirect(url_for('register'))

		# School already registered
		school = Delegations.query.filter_by(school_name=school_name).first()
		if school:
			session['error'] = 'It appears that %s has already registered. If you feel this is an error, please contact us.' % (school_name)
			return redirect(url_for('register'))

		# Password is the wrong length
		if not validate_username_length(username) or not validate_password_length(password):
			return redirect(url_for('register'))

		# Passwords do not match
		if not validate_passwords_match(password, password_confirm):
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
		db.session.commit()

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
		first_name = request.form['first_name'].strip().title()
		last_name = request.form['last_name'].strip().title()
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
		if not validate_phone_number(phone_number):
			return redirect(url_for('register'))

		# Username already taken
		if not validate_username_available(username):
			return redirect(url_for('register'))

		# Password is the wrong length
		if not validate_username_length(username) or not validate_password_length(password):
			return redirect(url_for('register'))

		# Passwords do not match
		if not validate_passwords_match(password, password_confirm):
			return redirect(url_for('register'))

		# All successful, create the individual
		newuser = User(email, username, password, 'Delegation')
		db.session.add(newuser)
		db.session.flush()
		delegation = Delegations("Individual", address1, address2, city, state, zipcode, country, prefix, first_name, last_name, username, email, phone_number, 1, first_ilmunc, experience)
		db.session.add(delegation)
		db.session.flush()
		db.session.commit()

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
	ga = Committees.query.filter_by(organ='GA')
	ecosoc = Committees.query.filter_by(organ='ECOSOC')
	crisis = Committees.query.filter_by(organ='Crisis')
	return render_template('committees.html', error=get_session_error(), success=get_session_success(), ga=ga, ecosoc=ecosoc, crisis=crisis)

@app.route('/committee/<name>')
def committee(name):
	committee = Committees.query.filter_by(shortname=name).first()
	if not committee: return render_template('404.html'), 404
	articles = BackgroundGuides.query.filter_by(committee_ID=committee.committee_ID).all()
	return render_template('committee.html', error=get_session_error(), success=get_session_success(), committee=committee, articles=articles)

@app.route('/committee/<name>/bg/<url>')
def backgroundGuide(name, url):
	committee = Committees.query.filter_by(shortname=name).first()
	article = BackgroundGuides.query.filter_by(canonical_url=url).first()
	if not committee or not article: return render_template('404.html'), 404
	return render_template('backgroundGuide.html', error=get_session_error(), success=get_session_success(), committee=committee, article=article)

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

@app.route('/dynamicBackgroundGuides')
def dynamicBackgroundGuides():
	return render_template('dynamicBackgroundGuides.html', error=get_session_error(), success=get_session_success())

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
	elif current_user.get_role() == 'Chair':
		return redirect(url_for('chair'))

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

		# Missing required field
		if not address1 or not city or not state or not zipcode or not country or not username or not password or not password_confirm or not phone_number or not email:
			session['error'] = 'Please fill out all the required fields (*) and try again.'
			return redirect(url_for('editDelegation'))

		# Phone field is invalid
		if not validate_phone_number(phone_number):
			return redirect(url_for('editDelegation'))

		# Username already taken
		if username != current_user.user.username and not validate_username_available(username):
			return redirect(url_for('editDelegation'))

		# Password is the wrong length
		if not validate_username_length(username) or not validate_password_length(password):
			return redirect(url_for('editDelegation'))

		# Passwords do not match
		if not validate_passwords_match(password, password_confirm):
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
		first_name = request.form.get('first_name').strip().title()
		last_name = request.form.get('last_name').strip().title()
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
		if not validate_phone_number(phone_number):
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
	payments = Payments.query.filter_by(delegation_ID=current_user.user.delegation_ID).all()
	return render_template('invoice.html', error=get_session_error(), success=get_session_success(), single_advisors=single_advisors, double_advisors=double_advisors, assistant_directors=assistant_directors, payments=payments)

@app.route('/chair', methods=['GET', 'POST'])
def chair():
	if not check_authentication('Chair'): return redirect(url_for('login'))
	committee = Committees.query.get(current_user.user.committee_ID)
	if request.method == 'POST': # Commitee session selector
		if 'committee_session' in request.form and request.form['committee_session'] != '':
			committee_session = int(request.form['committee_session'])
			return redirect(url_for('chairAttendance', id=committee_session))
		elif 'day' in request.form and request.form['day'] != '':
			day = int(request.form['day'])
			return redirect(url_for('chairPoints', id=day))
		else:
			session['error'] = 'Please select a committee session and try again.'
			return redirect(url_for('chair'))
	return render_template('chair.html', error=get_session_error(), success=get_session_success(), committee=committee)

@app.route('/chair/attendance/<int:id>', methods=['GET', 'POST'])
def chairAttendance(id):
	if not check_authentication('Chair'): return redirect(url_for('login'))
	if id:
		committee = Committees.query.get(current_user.user.committee_ID)
		if request.method == 'POST':
			position_IDs = request.form.getlist("attending")
			for position_ID in position_IDs:
				delegate = Positions.query.get(int(position_ID))
				setattr(delegate, 'attendance_s' +  str(id), 1)
			setattr(committee, 'attendance_s' +  str(id), 1)

			db.session.commit()
			return redirect(url_for('chairTracker', id=id))		
		else:
			positions = Positions.query.filter_by(committee_ID=committee.committee_ID).order_by(Positions.position)
			return render_template('chairAttendance.html', error=get_session_error(), success=get_session_success(), committee=committee, positions=positions, committee_session=id)
	else:
		session['error'] = 'To take attendance, please select a committee session below and then try again.'
		return redirect(url_for('chair'))

@app.route('/chair/tracker/<int:id>', methods=['GET', 'POST'])
def chairTracker(id):
	if not check_authentication('Chair'): return redirect(url_for('login'))
	if id:
		committee = Committees.query.get(current_user.user.committee_ID)
		positions = Positions.query.filter_by(committee_ID=committee.committee_ID).order_by(Positions.position)
		if request.method == 'POST':
			notes = str(request.json['notes'])
			for position in positions:
				position_ID = position.position_ID
				speaking_count = int(request.json[str(position_ID)])
				position.speaking_count = speaking_count
			committee.notes = notes
			db.session.commit()
			return str(request.json)
		else:
			present_count = 0.0
			num_columns = 1
			if positions.count() > 20: num_columns = 2
			if positions.count() > 40: num_columns = 3
			for position in positions:
				position_attendance = getattr(position, 'attendance_s' + str(id))
				if position_attendance == 1:
					present_count += 1.0
			return render_template('chairTracker.html', error=get_session_error(), success=get_session_success(), committee=committee, positions=positions, committee_session=id, present_count=present_count, num_columns=num_columns)
	else:
		session['error'] = 'Please select a committee session below and then try again.'
		return redirect(url_for('chair'))

@app.route('/chair/points/<int:id>', methods=['GET', 'POST'])
def chairPoints(id):
	if not check_authentication('Chair'): return redirect(url_for('login'))
	if id:
		committee = Committees.query.get(current_user.user.committee_ID)
		points_count = 10
		points_sum = 0

		# If it is time for awards, redirect to the awards page
		if id == 3:
			return redirect(url_for('chairAwards'))

		# Check if points have already been submitted for this committee
		if getattr(committee, 'points_d' + str(id)) == 1:
			session['error'] = 'You have already submitted points for this day. Please contact the Secretariat if you would like to change them.'
			return redirect(url_for('chair'))

		if request.method == 'POST':
			# Get the points for each of the positions provided
			for n in range(points_count):
				position_ID = request.form.get('position' + str(n))
				points = request.form.get('points' + str(n))
				if position_ID != None and points != None:
					position = Positions.query.get(int(position_ID))
					setattr(position, 'points_d' +  str(id), int(points))
					points_sum += int(points)
			setattr(committee, 'points_d' +  str(id), 1)

			# Check that < 10 points were allocated
			if points_sum > 10:
				session['error'] = 'You have tried to allocate more than 10 total points to delegates in your committee. Please try again.'
				return redirect(url_for('chairPoints', id=id))

			db.session.commit()
			session['success'] = 'You have successfully submitted your points for today\'s committee sessions. Thanks!'
			return redirect(url_for('chair'))
		else:
			positions = Positions.query.filter_by(committee_ID=committee.committee_ID).order_by(Positions.position)
			return render_template('chairPoints.html', error=get_session_error(), success=get_session_success(), committee=committee, positions=positions, day=id, points_count=points_count)
	else:
		session['error'] = 'To allocate points, please select a day below and then try again.'
		return redirect(url_for('chair'))

@app.route('/chair/awards', methods=['GET', 'POST'])
def chairAwards():
	if not check_authentication('Chair'): return redirect(url_for('login'))
	committee = Committees.query.get(current_user.user.committee_ID)
	positions = Positions.query.filter_by(committee_ID=committee.committee_ID).order_by(Positions.position)
	award_name = ['Best Delegate', 'Outstanding Delegate', 'Honorable Mention', 'Verbal Commendation']
	award_form_name = ['best', 'outstanding', 'honorable', 'verbal']
	award_count = {'GA': [1, 2, 3, 4], 'ECOSOC': [1, 2, 2, 3], 'Crisis': [1, 1, 1, 1]}
	committee_awards = award_count[committee.organ]
	if committee.shortname == "UNFPA":
		committee_awards = [1, 1, 2, 2]

	# Check if awards have already been submitted for this committee
	if committee.awards == 1:
		session['error'] = 'You have already submitted your awards for your committee. Please contact the Secretariat if you would like to change them.'
		return redirect(url_for('chair'))

	if request.method == 'POST':
		closing_remarks = request.form.get('closing_remarks')

		awards_given = []
		for a in range(len(committee_awards)):
			for i in range(1, committee_awards[a] + 1):
				position_ID = request.form.get(award_form_name[a] + str(i))
				position = Positions.query.get(position_ID)
				position.award = award_name[a]
				if position_ID in awards_given:
					session['error'] = 'You have given more than one award to the same delegation. Please try submitting your awards again.'
					return redirect(url_for('chairAwards'))
				else:
					awards_given.append(position_ID)

		committee.closing_remarks = closing_remarks
		committee.awards = 1

		db.session.commit()
		session['success'] = 'You have successfully submitted your awards for your committee. Thanks!'
		return redirect(url_for('chair'))
	else:
		# Sum up all the points for each position that has them
		positions_points = {}
		for position in positions:
			points_sum = position.points_d1 + position.points_d2 + position.points_d3
			if points_sum > 0:
				positions_points[position.position] = [position.points_d1, position.points_d2, position.points_d3, points_sum]
		return render_template('chairAwards.html', error=get_session_error(), success=get_session_success(), committee=committee, positions=positions, award_count=committee_awards, positions_points=positions_points)

@app.route('/staff')
def staff():
	if not check_authentication('Staff'): return redirect(url_for('login'))
	individuals = Delegations.query.filter_by(school_name='Individual').all()
	schools = Delegations.query.filter_by(individual_prefix=None).all()
	advisors_single = Faculty.query.filter_by(room_preference='Single').all()
	advisors_double = Faculty.query.filter_by(room_preference='Double').all()
	return render_template('staff.html', error=get_session_error(), success=get_session_success(), individuals=individuals, schools=schools, advisors_single=advisors_single, advisors_double=advisors_double)

@app.route('/staff/individuals')
def staffIndividuals():
	if not check_authentication('Staff'): return redirect(url_for('login'))
	individuals = Delegations.query.filter_by(school_name='Individual').all()
	return render_template('staffIndividuals.html', error=get_session_error(), success=get_session_success(), individuals=individuals)

@app.route('/staff/schools')
def staffSchools():
	if not check_authentication('Staff'): return redirect(url_for('login'))
	schools = Delegations.query.filter_by(individual_prefix=None).all()
	return render_template('staffSchools.html', error=get_session_error(), success=get_session_success(), schools=schools)

@app.route('/staff/viewDelegation/<int:id>', methods=['GET', 'POST'])
def staffViewDelegation(id):
	if not check_authentication('Staff'): return redirect(url_for('login'))
	delegation = Delegations.query.filter_by(delegation_ID=id).first()
	advisors = Faculty.query.filter_by(delegation_ID=id).all()
	positions = Positions.query.filter_by(delegation_ID=id).all()
	committees = Committees.query.all()
	return render_template('staffViewDelegation.html', error=get_session_error(), success=get_session_success(), delegation=delegation, advisors=advisors, positions=positions, committees=committees)

@app.route('/staff/editDelegation/<int:id>', methods=['GET', 'POST'])
def staffEditDelegation(id):
	if not check_authentication('Staff'): return redirect(url_for('login'))
	delegation = Delegations.query.filter_by(delegation_ID=id).first()

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
		prefix = request.form.get('prefix', None)
		first_name = request.form.get('first_name', None)
		last_name = request.form.get('last_name', None)
		school_name = request.form.get('school_name', 'Individual')
		expected_delegates = request.form.get('expected_delegates', 1)

		# Missing required field
		if not address1 or not city or not state or not zipcode or not country or not username or not phone_number or not email:
			session['error'] = 'Please fill out all the required fields (*) and try again.'
			return redirect(url_for('staffEditDelegation', id=id))

		# Phone field is invalid
		if not validate_phone_number(phone_number):
			return redirect(url_for('staffEditDelegation', id=id))

		# Username already taken
		if username != delegation.username and not validate_username_available(username):
			return redirect(url_for('staffEditDelegation', id=id))

		# Password is the wrong length
		if not validate_username_length(username):
			return redirect(url_for('staffEditDelegation', id=id))

		# Update all the fields
		account = User.query.filter_by(username=delegation.username).first()
		account.email = email
		account.username = username
		delegation.address1 = address1
		delegation.address2 = address2
		delegation.city = city
		delegation.state = state
		delegation.zipcode = zipcode
		delegation.country = country
		delegation.username = username
		delegation.email = email
		delegation.phone_number = phone_number
		delegation.prefix = prefix
		delegation.first_name = first_name
		delegation.last_name = last_name
		delegation.school_name = school_name
		delegation.expected_delegates = expected_delegates

		db.session.commit()
		session['success'] = 'You have successfully updated this delegation\'s information. The new details you have entered are shown below.'
		if first_name == None:
			return redirect(url_for('staffSchools'))
		else:
			return redirect(url_for('staffIndividuals'))

	else:
		return render_template('staffEditDelegation.html', error=get_session_error(), success=get_session_success(), delegation=delegation)

@app.route('/staff/deleteDelegation/<int:id>')
def staffDeleteDelegation(id):
	if not check_authentication('Staff'): return redirect(url_for('login'))

	delegation = Delegations.query.filter_by(delegation_ID=id).first()
	advisors = Faculty.query.filter_by(delegation_ID=id).all()
	user = Users.query.filter_by(username=delegation.username).first()
	db.session.delete(delegation)
	db.session.delete(advisors)
	db.session.delete(user)
	db.session.commit()
	session['success'] = 'This delegation has been successfully removed.'
	return redirect(url_for('staff'))

@app.route('/staff/payments', methods=['GET', 'POST'])
def staffPayments():
	if not check_authentication('Staff'): return redirect(url_for('login'))

	if request.method == 'POST':
		delegation_ID = request.form.get('delegation_ID')
		payment_amount = request.form.get('payment_amount')
		payment_currency = request.form.get('payment_currency')
		payment_method = request.form.get('payment_method')
		payment_date = request.form.get('payment_date')

		delegation = Delegations.query.filter_by(delegation_ID=delegation_ID).first()
		if delegation.individual_prefix == None:
			school_name = delegation.school_name
		else:
			school_name = delegation.individual_prefix + " " + delegation.individual_first_name + " " + delegation.individual_last_name

		newpayment = Payments(payment_date, payment_amount, payment_currency, payment_method, delegation_ID, school_name)
		db.session.add(newpayment)
		db.session.commit()

		session['success'] = 'This payment has been successfully added and will now show up on the delegation\'s invoice.'
		return redirect(url_for('staffPayments'))
	else:
		delegations = Delegations.query.all()
		names = []
		for delegation in delegations:
			if delegation.individual_prefix == None:
				names.append((delegation.school_name, delegation.delegation_ID))
			else:
				names.append((delegation.individual_prefix + " " + delegation.individual_first_name + " " + delegation.individual_last_name, delegation.delegation_ID))

		payments = Payments.query.order_by(Payments.payment_date.desc()).all()
		return render_template('staffPayments.html', error=get_session_error(), success=get_session_success(), schools=sorted(names), payments=payments)

@app.route('/staff/positionAllocations', methods=['GET', 'POST'])
def staffPositionAllocations():
	if not check_authentication('Staff'): return redirect(url_for('login'))

	if request.method == 'POST':
		position = request.form.get('position')
		committee_ID = request.form.get('committee_ID')
		delegation = request.form.get('delegation')

		try:
			delegation_ID = delegation[delegation.index("[") + 1:delegation.rindex("]")]
		except:
			session['error'] = 'The delegation you typed did not include an ID. Please use the suggestions in the autocomplete in order to complete this form.'
			return redirect(url_for('staffPositionAllocations'))

		delegation_found = Delegations.query.filter_by(delegation_ID=delegation_ID).first()
		committee_found = Committees.query.filter_by(committee_ID=committee_ID).first()

		if not delegation_found:
			session['error'] = 'This delegation does not exist. Please make sure you have typed it exactly as written or used the suggestions in the autocomplete box.'
			return redirect(url_for('staffPositionAllocations'))

		if not committee_found:
			session['error'] = 'This committee does not exist. Please choose an option in the dropdown menu.'
			return redirect(url_for('staffPositionAllocations'))

		newposition = Positions(position, committee_found.committee_ID, delegation_found.delegation_ID, delegation)
		db.session.add(newposition)
		db.session.commit()

		session['success'] = 'This position allocation has been successfully added. You may add another below.'
		return redirect(url_for('staffPositionAllocations'))
	else:
		committees = Committees.query.order_by(Committees.committee_ID.asc()).all()
		delegations = Delegations.query.all()
		positions = Positions.query.all()
		return render_template('staffPositionAllocations.html', error=get_session_error(), success=get_session_success(), committees=committees, delegations=delegations, positions=positions)

@app.route('/admin')
def admin():
	if not check_authentication('Admin'): return redirect(url_for('login'))
	return render_template('admin.html', error=get_session_error(), success=get_session_success())

@app.route('/admin/addAdmin', methods=['GET', 'POST'])
def adminAddAdmin():
	if not check_authentication('Admin'): return redirect(url_for('login'))
	if request.method == 'POST':
		username = request.form.get('username').strip()
		email = request.form.get('email').strip()
		password = request.form.get('password')
		password_confirm = request.form.get('password_confirm')

		# Check username doesn't exist
		if not validate_username_available(username):
			session['error'] = 'Could not add admin. Please try again.'
			return redirect(url_for('adminAddAdmin'))

		# Check passwords match
		if not validate_passwords_match(password, password_confirm):
			session['error'] = 'Could not add admin. Please try again.'
			return redirect(url_for('adminAddAdmin'))

		# Check length of username and password
		if not validate_username_length(username) or not validate_password_length(password):
			session['error'] = 'Could not add admin. Please try again.'
			return redirect(url_for('adminAddAdmin'))

		newuser = User(email, username, password, 'Admin')
		db.session.add(newuser)
		db.session.commit()
		session['success'] = 'This admin account has been successfully added to the database.'
		return redirect(url_for('account'))
	else:
		return render_template('adminAddAdmin.html', error=get_session_error(), success=get_session_success())

@app.route('/admin/addStaff', methods=['GET', 'POST'])
def adminAddStaff():
	if not check_authentication('Admin'): return redirect(url_for('login'))
	if request.method == 'POST':
		username = request.form.get('username').strip()
		email = request.form.get('email').strip()
		password = request.form.get('password')
		password_confirm = request.form.get('password_confirm')

		# Check username doesn't exist
		if not validate_username_available(username):
			session['error'] = 'Could not add staff. Please try again.'
			return redirect(url_for('adminAddStaff'))

		# Check passwords match
		if not validate_passwords_match(password, password_confirm):
			session['error'] = 'Could not add staff. Please try again.'
			return redirect(url_for('adminAddStaff'))

		# Check length of username and password
		if not validate_username_length(username) or not validate_password_length(password):
			session['error'] = 'Could not add staff. Please try again.'
			return redirect(url_for('adminAddStaff'))

		newuser = User(email, username, password, 'Staff')
		db.session.add(newuser)
		db.session.commit()
		session['success'] = 'This staff account has been successfully added to the database.'
		return redirect(url_for('account'))
	else:
		return render_template('adminAddStaff.html', error=get_session_error(), success=get_session_success())

@app.route('/admin/addChair', methods=['GET', 'POST'])
def adminAddChair():
	if not check_authentication('Admin'): return redirect(url_for('login'))
	if request.method == 'POST':
		username = request.form.get('username').strip()
		email = request.form.get('email').strip()
		password = request.form.get('password')
		password_confirm = request.form.get('password_confirm')
		first_name = request.form.get('first_name').strip()
		last_name = request.form.get('last_name').strip()
		committee_ID = request.form.get('committee_ID')

		# Check username doesn't exist
		if not validate_username_available(username):
			session['error'] = 'Could not add chair. Please try again.'
			return redirect(url_for('adminAddChair'))

		# Check passwords match
		if not validate_passwords_match(password, password_confirm):
			session['error'] = 'Could not add chair. Please try again.'
			return redirect(url_for('adminAddChair'))

		# Check length of username and password
		if not validate_username_length(username) or not validate_password_length(password):
			session['error'] = 'Could not add chair. Please try again.'
			return redirect(url_for('adminAddChair'))

		newuser = User(email, username, password, 'Chair')
		db.session.add(newuser)
		db.session.flush()
		newchair = Chairs(newuser.user_ID, committee_ID, first_name, last_name)
		db.session.add(newchair)
		db.session.flush()
		db.session.commit()

		session['success'] = 'This chair account has been successfully added to the database.'
		return redirect(url_for('account'))
	else:
		committees = Committees.query.order_by(Committees.committee_ID.asc()).all()
		return render_template('adminAddChair.html', error=get_session_error(), success=get_session_success(), committees=committees)

@app.route('/admin/resetChairSubmissions')
def adminResetChairSubmissions():
	if not check_authentication('Admin'): return redirect(url_for('login'))
	positions = Positions.query.all()
	committees = Committees.query.all()

	for position in positions:
		for n in range(1, 12):
			setattr(position, 'attendance_s' + str(n), 0)
		for n in range(1, 4):
			setattr(position, 'points_d' + str(n), 0)
		position.speaking_count = 0

	for committee in committees:
		for n in range(1, 12):
			setattr(committee, 'attendance_s' + str(n), 0)
		for n in range(1, 4):
			setattr(committee, 'points_d' + str(n), 0)
		committee.awards = 0
		committee.closing_remarks = ""
		committee.notes = ""

	db.session.commit()
	session['success'] = 'All the chair submission details (points, awards, attendance, etc.) have been reset.'
	return redirect(url_for('account'))


# ERROR HANDLERS ###############################################################
@app.errorhandler(400)
def bad_request(e):
	return render_template('400.html'), 400

@app.errorhandler(404)
def page_not_found(e):
	return render_template('404.html'), 404

@app.errorhandler(500)
def internal_server_error(e):
	return render_template('500.html'), 500


# MAIN FUNCTION ################################################################
if __name__ == '__main__':
	app.run(debug=True,host='0.0.0.0')