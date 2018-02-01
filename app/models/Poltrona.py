from django.db import models
from app.models.Espetaculo import Espetaculo

class Poltrona(models.Model):
    
    espetaculo = models.ForeignKey(Espetaculo, on_delete = models.CASCADE, related_name = 'poltronas')
    numero = models.IntegerField()

