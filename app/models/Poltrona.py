from django.db import models
from app.models.Espetaculo import Espetaculo

class Poltrona(models.Model):
    
    numero = models.IntegerField()

