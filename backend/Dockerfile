FROM python:3.6
ENV PYTHONUNBUFFERED 1
RUN mkdir /code
WORKDIR /code
ADD requirements.txt /code/
RUN pip install -r requirements.txt
ADD . /code/

EXPOSE 8000
# # Serve the app
CMD ["python", "manage.py", "runserver", "0.0.0.0:8000"]