from django.db import models
from django.conf import settings


class Espetaculo(models.Model):
    
    titulo = models.CharField(max_length=60)
    descricao = models.TextField(null=True, blank=True)
    total_de_poltronas = models.PositiveIntegerField(default=20)


    def __str__(self):
        return self.titulo

    def save(self, *args, **kwargs):
        super(Espetaculo, self).save(*args, **kwargs)

    def get_total_arrecadado(self):
        total_reservados = self.get_total_reservados()
        valor_total = total_reservados * settings.VALOR_POLTRONA
        return valor_total 
    
    def get_total_impostos(self):
        total_reservados = self.get_total_reservados()
        valor_total = total_reservados * settings.VALOR_POLTRONA
        return valor_total * settings.VALOR_IMPOSTOS/100
    
    def get_total_reservados(self):
        return self.poltrona_set.filter(
            reserva__isnull=False).count()