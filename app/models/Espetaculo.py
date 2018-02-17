from django.db import models

class Espetaculo(models.Model):

    descricao = models.CharField(max_length = 100)
    data = models.DateField()
    hora = models.TimeField()



