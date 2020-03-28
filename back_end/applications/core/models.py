# This is an auto-generated Django model module.
# You'll have to do the following manually to clean this up:
#   * Rearrange models' order
#   * Make sure each model has one field with primary_key=True
#   * Make sure each ForeignKey and OneToOneField has `on_delete` set to the desired behavior
#   * Remove `managed = False` lines if you wish to allow Django to create, modify, and delete the table
# Feel free to rename the models, but don't rename db_table values or field names.
import os
from django.db import models
from django.utils.text import slugify
from django.template.loader import render_to_string, get_template
from django.utils.crypto import get_random_string
from django.conf import settings
from weasyprint import HTML, CSS


class Application(models.Model):

    class StatusChoices(models.IntegerChoices):
        STATUS_IN_QUEUED = 0
        STATUS_ACCEPTED = 1
        STATUS_DECLINED = 2

    id = models.AutoField(primary_key=True)
    uid = models.CharField(max_length=255)
    company_name = models.CharField(max_length=255)
    company_iin = models.CharField(max_length=255)
    director_full_name = models.CharField(max_length=255)
    phone_number = models.CharField(max_length=255)
    movement_area = models.TextField()
    email = models.CharField(max_length=255)
    external_id = models.CharField(max_length=255, blank=True, null=True)
    status = models.IntegerField(
        default=StatusChoices.STATUS_IN_QUEUED.value,
        choices=StatusChoices.choices)
    declined_reason = models.TextField(blank=True, null=True)
    officer_full_name = models.TextField(blank=True, null=True)
    reviewed_at = models.DateField(blank=True, null=True)
    created_at = models.DateField(auto_now_add=True)
    updated_at = models.DateField(auto_now=True)

    class Meta:
        managed = False
        db_table = 'application'


class ApplicationCar(models.Model):
    id = models.AutoField(primary_key=True)
    application = models.ForeignKey(
        Application, models.CASCADE, blank=True, null=True)
    driver_full_name = models.CharField(max_length=255)
    car_identifier = models.CharField(max_length=255)

    class Meta:
        managed = False
        db_table = 'application_car'


class ApplicationSingle(models.Model):

    TEMPLATE_PATH = 'pdf_forms/singleapp_profile.html'

    uid = models.CharField("UID", max_length=255, null=True)
    first_name = models.CharField("Имя", max_length=255)
    middle_name = models.CharField("Отчество", max_length=255)
    last_name = models.CharField("Фамилия", max_length=255)
    phone_number = models.CharField("Телефон", max_length=10)
    reason = models.TextField("Причина")
    output_time = models.TimeField("Время выхода")
    input_time = models.TimeField("Время возврата")
    home_address = models.CharField("Адрес места жительства", max_length=500)
    destination_address = models.CharField("Адрес пункта назначения", max_length=500)

    class Meta:
        verbose_name = "Анкета физ. лиц"
        verbose_name_plural = "Анкеты физ. лиц"

    def __str__(self):
        return f'{self.first_name} {self.last_name} {self.middle_name}'

    def save(self, force_insert=False, force_update=False, using=None,
             update_fields=None):
        if not self.uid:
            self.uid = get_random_string(length=25)
        super().save(force_insert, force_update, using, update_fields)


    def get_profile_filename(self):
        first_name = slugify(self.first_name, allow_unicode=True)
        last_name = slugify(self.last_name, allow_unicode=True)
        middle_name = slugify(self.middle_name, allow_unicode=True)
        return f'{first_name}-{last_name}-{middle_name}.pdf'

    def to_pdf(self):
        context = self.__dict__
        context['output_time'] = self.output_time.strftime('%H:%M')
        context['input_time'] = self.input_time.strftime('%H:%M')
        html = render_to_string(self.TEMPLATE_PATH, {'app': context})
        filename = self.get_profile_filename()
        HTML(string=html).write_pdf(os.path.join(settings.MEDIA_ROOT, f'profiles/{filename}'),
                                    stylesheets=[CSS(string='body { font-family: serif !important }')])
        return
