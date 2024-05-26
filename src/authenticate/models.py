from django.conf import settings
from django.contrib.auth.models import AbstractUser
from django.db import models
# Create your models here.


class User(AbstractUser):
    phone = models.CharField(max_length=13)
    communes = {
    "Bandalungwa": "Bandalungwa",
    "Barumbu": "Barumbu",
    "Bumbu": "Bumbu",
    "Gombe": "Gombe",
    "Kalamu": "Kalamu",
    "Kasa-Vubu":"Kasa-Vubu",
    "Kimbanseke": "Kimbanseke",
    "Kinshasa":"Kinshasa",
    "Kintambo":"Kintambo",
    "Kisenso":"Kisenso",
    "Lemba":"Lemba",
    "Limete":"Limete",
    "Lingwala":"Lingwala",
    "Makala":"Makala",
    "Maluku":"Maluku",
    "Masina":"Masina",
    "Matete":"Matete",
    "Mont-Ngafula":"Mont-Ngafula",
    "Ndjili":"Ndjili",
    "Ngaba":"Ngaba",
    "Ngaliema":"Ngaliema",
    "Ngiri-Ngiri":"Ngiri-Ngiri",
    "Nsele":"Nsele",
    "Selembao":"Selembao",
}
    commune = models.CharField(max_length=50,choices=communes, null=True)
    quartier = models.CharField(max_length=50, null=True)

    def __str__(self):
        return self.username

    