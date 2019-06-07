from django.db import models


# Create your models here.
class Poltronas(models.Model):
    numero = models.CharField(max_length=5)

    def __str__(self):
        return self.numero
