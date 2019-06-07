from django.db import models


# Create your models here.
class Reservas(models.Model):
    espetaculo = models.ForeignKey('espetaculos.Espetaculos', on_delete=models.CASCADE)
    poltrona = models.ForeignKey('poltronas.Poltronas', on_delete=models.CASCADE)

    class Meta:
        unique_together = ('espetaculo', 'poltrona')
