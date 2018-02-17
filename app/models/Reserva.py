from django.db import models
from app.models.Espetaculo import Espetaculo
from app.models.Poltrona import Poltrona

class Reserva(models.Model):
    
    espetaculo = models.ForeignKey(Espetaculo,on_delete = models.CASCADE, related_name = 'reservas')
    poltrona = models.ForeignKey(Poltrona, on_delete = models.CASCADE, related_name = 'reservas')
    


