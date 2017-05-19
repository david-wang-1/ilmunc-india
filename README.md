# ILMUNC India Website Information
---

### First Things First
It will be helpful to install the following:
1. Sublime Text
2. GitHub Desktop
3. Sequel Pro (Mac) or MySQL Workbench (Windows)

### Getting Started
1. Make sure you have Docker installed: https://www.docker.com/community-edition
2. Make sure you have Heroku installed: https://devcenter.heroku.com/articles/heroku-cli#download-and-install
3. Make sure you have Heroku container installed: `heroku plugins:install heroku-container-registry`
4. Clone the git repository to your computer
5. `cd` to the root directory, e.g. where you see `app.py` when you type `ls` (Mac) or `dir` (PC)

### Build with Docker
```sh
docker build -t ilmunc-india:latest .
```

### Run the Server
In order to run the server, you will need the absolute path to the `ilmunc-india` directory on your computer. E.g.:
`/Users/alexsands/Documents/GitHub/ilmunc-india` (on Mac) or `C:\Users\alexsands\Documents\GitHub\ilmunc-india` (on Windows). Once you have this, replace `<absolute-path-to-ilmunc-india>` below. 

On Mac or Windows, run:
```sh
docker run -e PORT=5000 -p 5000:5000 -v <absolute-path-to-ilmunc-india>:/app -it ilmunc-india
```

Then, visit http://0.0.0.0:5000/ in your browser. If that doesn't work, try http://localhost:5000/.

### Pushing Code
After you have merged any changes to the master branch, push them to the Heroku server. Note, you need heroku-container-registry installed. Remember that the Heroku slug must be < 300 MB. So you should add any large files that don't need to be used in your app to `.slugignore`.
```sh
heroku container:login
heroku container:push web 
heroku open
```
*An "--app ilmunc-india" tag may be necessary to identify the target for the push and open operations.

