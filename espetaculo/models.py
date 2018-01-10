from django.db import models

# Create your models here.
class Estepaculo(models.Model):
    titulo = models.CharField('Título', max_length=150)
    data = models.DateTimeField('Data')

    def __str__(self):
        return self.titulo

class Poltrona(models.Model):
    ocupada = models.BooleanField(default=False)
    espetaculo = models.ForeignKey(Estepaculo)

    def __str__(self):
        return '{} - {}'.format(self.espetaculo.titulo, self.pk)