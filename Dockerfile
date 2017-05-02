FROM ubuntu:14.04

# Install dependencies and setup
RUN apt-get update -y
RUN apt-get install -y python-pip python-dev libmysqlclient-dev build-essential
COPY . /app
WORKDIR /app
RUN pip install --upgrade pip
RUN pip install -r requirements.txt
RUN pip install wsgiref

# Run the app
ENTRYPOINT ["python"]
CMD ["app.py"]