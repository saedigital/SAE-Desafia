from django.db import models
from espetaculos.models import Espetaculo
from django.contrib.auth.models import User


class Poltrona(models.Model):
    
    numeracao = models.PositiveIntegerField(default=0)
    espetaculo = models.ForeignKey(Espetaculo, on_delete=models.CASCADE)


class Reserva(models.Model):

    # usuario = models.ForeignKey(User, null=True, blank=True, 
    #     on_delete=models.CASCADE)
    poltrona = models.ForeignKey(Poltrona, on_delete=models.CASCADE)
