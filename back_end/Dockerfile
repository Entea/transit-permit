FROM python:3.6-alpine

ENV PYTHONUNBUFFERED 1
#
RUN apk update \
#  # psycopg2 dependencies
  && apk add --virtual build-deps gcc python3-dev musl-dev \
#  # Pillow dependencies
#  && apk add jpeg-dev zlib-dev freetype-dev lcms2-dev openjpeg-dev tiff-dev tk-dev tcl-dev \
#  # https://docs.djangoproject.com/en/dev/ref/django-admin/#dbshell
  && apk add mariadb-dev mysql mysql-client

# Requirements are installed here to ensure they will be cached.
COPY ./requirements.txt requirements.txt
RUN pip install --upgrade pip && pip install -r requirements.txt

COPY ./start /start
RUN sed -i 's/\r//' /start
RUN chmod +x /start

WORKDIR /app
