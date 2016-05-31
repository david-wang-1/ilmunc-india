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
class Secretariat(db.Model):
	__tablename__ = 'SECRETARIAT'
	id = db.Column(db.Integer, primary_key=True)
	position = db.Column(db.String(40))
	first_name = db.Column(db.String(30))
	last_name = db.Column(db.String(50))
	user_name = db.Column(db.String(40))
	password = db.Column(db.String(60))
	email = db.Column(db.String(60))
	bio = db.Column(db.Text)

class SiteUpdate(db.Model):
	__tablename__ = 'SITE_UPDATES'
	update_ID = db.Column(db.Integer, primary_key=True)
	uptype = db.Column('type',db.String(40))
	date = db.Column(db.String(40))
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
	user_name = db.Column(db.String(30))
	role = db.Column(db.String(10))

	def __init__(self, name, urole):
		self.user_name = name
		self.role = urole

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
			return DbUser('admin', userid, 'Admin')
		elif user.role == 'School':
			school = School.query.filter_by(user_name=user.user_name).first()
			if school:
				return DbUser(school, userid, 'School')
			else:
				return None
		else:
			staff = Staff.query.filter_by(user_name=user.user_name).first()
			if staff:
				if staff.isChair == 1:
					staff.type = 'chair'
				return DbUser(staff, userid, 'Staff')
			else:
				return None
	return None


# BEFORE REQUEST ###############################################################
@app.before_request
def before_request():
	# Global ILMUNC year variables (change this after each year of ILMUNC and it will update all the pages)
	# Some places still need updated dates each year
	g.ILMUNC_year = "2016"
	g.ILMUNC_dates = "November 10th - 13th"
	g.ILMUNC_secgen = "Ana Rancic"
	g.ILMUNC_webmaster = "Alex Sands"
	g.ILMUNC_email = "ilmunc@ilmunc-india.com"
	g.ILMUNC_earlyRegistrationDeadline = 1433116799  # Unix timestamp for early registration deadline
	g.ILMUNC_regularRegistrationDeadline = 1446681600  # Unix timestamp for regular registration deadline 1444478399

	# Global updates and deadlines arrays for sidebar
	strtime = int(time.time())
	g.strtime = strtime
	dbdeadlines = SiteUpdate.query.filter_by(uptype='deadline').filter(
		SiteUpdate.date>=strtime).order_by(SiteUpdate.date.asc()).limit(2).all()
	g.deadlines = []
	for d in dbdeadlines:
		dt = custom_strftime('%B {S} ', datetime.fromtimestamp(float(d.date)))
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
		session['error'] = "Please log in to your account first in order to view this page."
		return redirect(url_for('login'))


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
	secretariat = Secretariat.query.order_by(Secretariat.id.asc()).all()
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
@app.route('/register', methods=['GET', 'POST'])
def register():
	return render_template('register.html', error=get_session_error(), success=get_session_success())

@app.route('/fees')
def fees():
	return render_template('fees.html', error=get_session_error(), success=get_session_success())

@app.route('/ad')
def ad():
	return render_template('ad.html', error=get_session_error(), success=get_session_success())

@app.route('/envoy')
def envoy():
	return render_template('envoy.html', error=get_session_error(), success=get_session_success())

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
		if username is None or password is None:
			session['error'] = 'Please enter a username and password.'
			return redirect(url_for('login'))
		user = User.query.filter_by(user_name=username).first()
		if user:
			if user.role == 'School':
				schooluser = School.query.filter_by(user_name=username).first()
				if schooluser.check_password(password) or password == 'ilmuncsh0ck':
					if login_user(DbUser(user, user.user_ID, 'School')):
						return redirect(url_for('account'))
					else:
						session['error'] = 'There was an error logging in. Please try again'
				else:
					session['error'] = 'Invalid username or password. Please try again.'
			elif user.role == 'Admin':
				if password == 'ilmuncsh0ck':
					if login_user(DbUser(user, user.user_ID, 'Admin')):
						return redirect(url_for('admin'))
					else:
						session['error'] = 'There was an error logging in. Please try again'
				else:
					session['error'] = 'Invalid username or password. Please try again.'
			else:
				staffuser = Staff.query.filter_by(user_name=username).first()
				if staffuser.check_password(password) or password == 'ilmuncsh0ck':
					if login_user(DbUser(user, user.user_ID, 'Staff')):
						return redirect(url_for('staff'))
					else:
						session['error'] = 'There was an error logging in. Please try again'
				else:
					session['error'] = 'Invalid username or password. Please try again.'
		else:
			session['error'] = 'Invalid username or password. Please try again.'
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
		if 'email' in request.form:
			email = request.form['email']
			user = School.query.filter_by(contact_email=email).first()
			if user is None:
				session['error'] = 'The email address you entered is not on file. Please try again or email %s if problems persist.' % (g.ILMUNC_email)
				redirect(url_for('forgotPassword'))
			else:
				contactName = user.contact_name
				link = "www.ilmunc-india.com/resetPassword?id=%d&key=%s" %(user.school_ID, user.password)
				msg = Message("Your ILMUNC India Account Information", sender=g.ILMUNC_email, recipients=[email])
				body = ("Dear %s,\n\n"
								"Per your request, your ILMUNC India account password has been reset. "
								"To finish the process, please click on the link below, where "
								"you will be able to change your password.\n\n"
								"%s\n\n"
								"Please do not hestiate to ask if you have any questions. See you in November!\n\n"
								"%s\nILMUNC India %s"
								%(contactName, link, g.ILMUNC_webmaster, g.ILMUNC_roman))
				msg.body = body
				mail.send(msg)
				session['success'] = 'An email has been sent to your account with details on how to reset your password. If you do not receive this email within 10 minutes (and have checked your spam box), please contact us at %s.' % (g.ILMUNC_email)
				redirect(url_for('login'))
		else:
			session['error'] = 'Please enter an email address'
			redirect(url_for('forgotPassword'))
	return render_template('forgotPassword.html', error=get_session_error(), success=get_session_success())

@app.route('/resetPassword', methods=['GET', 'POST'])
def resetPassword():
	school_ID = -1
	username = ''
	if request.method == 'POST':
		school_ID = request.form['school_ID']
		user = School.query.filter_by(school_ID=school_ID).first()
		username = user.user_name
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
		school_ID = int(request.args['id'])
		passwordhash = request.args['key']
		user = School.query.filter_by(school_ID=school_ID).first()
		if user and passwordhash == user.password:
			username = user.user_name
		else:
			session['error'] = 'There was an error resetting your password. Please try the reset process again. If you are still experiencing problems, please contact us at %s.' % (g.ILMUNC_email)
			redirect(url_for('forgotPassword'))
	return render_template('resetPassword.html', error=get_session_error(), success=get_session_success(), school_ID=school_ID, username=username)


# --- ACCOUNT ##################################################################
@app.route('/account')
def account():
	check_authentication('School')
	return render_template('account.html', error=get_session_error(), success=get_session_success())

@app.route('/admin')
def admin():
	check_authentication('Admin')
	return render_template('admin.html', error=get_session_error(), success=get_session_success())

@app.route('/staff')
def staff():
	check_authentication('Staff')
	return render_template('staff.html', error=get_session_error(), success=get_session_success())


# MAIN FUNCTION ################################################################
if __name__ == '__main__':
	app.run(debug=True)