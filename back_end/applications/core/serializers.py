from rest_framework import serializers
from rest_framework.fields import SerializerMethodField

from applications.core.models import (
    Application,
    ApplicationCar,
)
from applications.core.utils import generate_qrcode


class ApplicationCarSerializer(serializers.ModelSerializer):
    id = serializers.IntegerField(read_only=True)

    class Meta:
        model = ApplicationCar
        fields = [
            'id', 'driver_full_name', 'car_identifier',
        ]


class ApplicationSerializer(serializers.ModelSerializer):
    id = serializers.IntegerField(read_only=True)
    uid = serializers.CharField(read_only=True)
    external_id = serializers.CharField(read_only=True)
    status = serializers.IntegerField(read_only=True)
    declined_reason = serializers.CharField(read_only=True)
    officer_full_name = serializers.CharField(read_only=True)
    reviewed_at = serializers.DateField(read_only=True)
    created_at = serializers.DateField(read_only=True)
    updated_at = serializers.DateField(read_only=True)
    cars = ApplicationCarSerializer(many=True, required=False, write_only=True)
    app_cars = ApplicationCarSerializer(source='applicationcar_set', many=True, read_only=True)
    qr = SerializerMethodField(read_only=True)

    class Meta:
        model = Application
        fields = [
            'id', 'uid', 'external_id', 'status', 'declined_reason',
            'officer_full_name', 'reviewed_at', 'created_at', 'updated_at',
            'director_full_name', 'company_iin', 'company_name', 'phone_number',
            'movement_area', 'email', 'cars', 'app_cars', 'qr',
        ]

    def create(self, validated_data):
        cars_data = validated_data.pop('cars') if 'cars' in validated_data else None
        instance = Application.objects.create(**validated_data)
        if cars_data:
            for car_data in cars_data:
                ApplicationCar.objects.create(application=instance, **car_data)
        return instance

    def get_qr(self, obj):
        return generate_qrcode(obj.application_link, f'{obj.uid}.png', 10)
