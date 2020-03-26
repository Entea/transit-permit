# This is an auto-generated Django model module.
# You'll have to do the following manually to clean this up:
#   * Rearrange models' order
#   * Make sure each model has one field with primary_key=True
#   * Make sure each ForeignKey and OneToOneField has `on_delete` set to the desired behavior
#   * Remove `managed = False` lines if you wish to allow Django to create, modify, and delete the table
# Feel free to rename the models, but don't rename db_table values or field names.
from django.db import models


class Application(models.Model):
    uid = models.CharField(max_length=255)
    company_name = models.CharField(max_length=255)
    company_iin = models.CharField(max_length=255)
    director_full_name = models.CharField(max_length=255)
    phone_number = models.CharField(max_length=255)
    movement_area = models.TextField()
    email = models.CharField(max_length=255)
    external_id = models.CharField(max_length=255, blank=True, null=True)
    status = models.IntegerField()
    declined_reason = models.TextField(blank=True, null=True)
    officer_full_name = models.TextField(blank=True, null=True)
    reviewed_at = models.DateField(blank=True, null=True)
    created_at = models.DateField()
    updated_at = models.DateField(blank=True, null=True)

    class Meta:
        managed = False
        db_table = 'application'


class ApplicationCar(models.Model):
    application = models.ForeignKey(Application, models.DO_NOTHING, blank=True, null=True)
    driver_full_name = models.CharField(max_length=255)
    car_identifier = models.CharField(max_length=255)

    class Meta:
        managed = False
        db_table = 'application_car'
