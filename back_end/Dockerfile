FROM python:3.6-alpine

ENV PYTHONUNBUFFERED 1
#
RUN apk update \
#  # psycopg2 dependencies
  && apk add --virtual build-deps gcc python3-dev musl-dev \
#  # WeasyPrint dependecies
  && apk --update --upgrade add jpeg-dev zlib-dev libffi-dev cairo-dev pango-dev gdk-pixbuf-dev \
#  # https://docs.djangoproject.com/en/dev/ref/django-admin/#dbshell
  && apk add mariadb-dev mysql mysql-client

# Requirements are installed here to ensure they will be cached.
COPY ./requirements.txt requirements.txt
RUN pip install --upgrade pip && pip install -r requirements.txt

RUN mkdir uploads && mkdir uploads/profiles

COPY ./start /start
RUN sed -i 's/\r//' /start
RUN chmod +x /start

WORKDIR /app
