import os
_basedir = os.path.abspath(os.path.dirname(__file__))

DEBUG = False

ADMINS = frozenset(['acsands13@gmail.com'])
SECRET_KEY = 'SecretKeyForSessionSigning'

host = 'staffindia.db.10655880.hostedresource.com'
username = 'staffindia'
password = 'ILLmonkey2015!'
database = 'staffindia'
uri =  'mysql://%s:%s@%s/%s' % (username, password, host, database)
SQLALCHEMY_POOL_RECYCLE = 50
SQLALCHEMY_POOL_TIMEOUT = 800
SQLALCHEMY_DATABASE_URI = uri

THREADS_PER_PAGE = 8

CSRF_ENABLED=True
CSRF_SESSION_KEY="somethingimpossibletoguess"

RECAPTCHA_ENABLED = True
RECAPTCHA_SITE_KEY = "6Ld5IR8TAAAAAKm_qoty4GkBUtC56Csamsl4MA9U"
RECAPTCHA_SECRET_KEY = "6Ld5IR8TAAAAAMUUiw0dh15W2oThfQ3NPqLmcH6g"
RECAPTCHA_THEME = "light"
RECAPTCHA_TYPE = "image"
RECAPTCHA_SIZE = "normal"
RECAPTCHA_RTABINDEX = 0

# MAIL_SERVER = 'mail.upmunc.org'
# MAIL_PORT = 587
# MAIL_USERNAME = 'ilmunc@ilmunc-india.org'
# MAIL_PASSWORD = 'bacardi151rum'
# DEFAULT_MAIL_SENDER = 'ilmunc@ilmunc-india.org'

