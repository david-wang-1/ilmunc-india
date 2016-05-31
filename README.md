# ILMUNC India Website Information
---

### Getting Started
First, make sure Python, pip, and virtualenv are installed on your computer. After cloning the git repository, cd to the root directory and run:
```sh
$ virtualenv -p /usr/bin/python2.6 venv
$ source venv/bin/activate
$ pip install -r requirements.txt
$ python app.py
```
This will create a Python 2.6 virtual environment (which correlates to the environment on the server), install the necessary requirements, and launch the main app. Every time you want to work on the site, you must run these two commands to start the server locally:
```sh
$ pip install -r requirements.txt
$ python app.py
```