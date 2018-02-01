from django.db import models
from app.models.Poltrona import Poltrona

class Reserva(models.Model):
    
    poltrona = models.ForeignKey(Poltrona, on_delete = models.CASCADE)
    data = models.DateField()
    hora = models.TimeField()

