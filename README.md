# ILMUNC India Website Information
---

### Getting Started
First, make sure Python, pip, and virtualenv are installed on your computer. 
```sh
$ python --version
$ sudo easy_install pip
$ sudo pip install virtualenv
```

After cloning the git repository, cd to the root directory (e.g. where you see `app.py` when you type `ls`) and run:
```sh
$ virtualenv -p /usr/bin/python2.6 venv
$ source venv/bin/activate
$ pip install -r requirements.txt
$ python app.py
```

This will create a Python 2.6 virtual environment (which correlates to the environment on the server), install the necessary requirements, and launch the main app. Every time you want to work on the site, you must run these two commands to start the server locally:
```sh
$ source venv/bin/activate
$ python app.py
```

### Pushing Code
After you have merged any changes to the master branch, push them to the Heroku server. Remember that the Heroku slug must be < 300 MB. So you should add any large files that don't need to be used in your app to `.slugignore`. If they are large PDFs, it might be wise to host them somewhere else.
```sh
$ git push heroku master
```