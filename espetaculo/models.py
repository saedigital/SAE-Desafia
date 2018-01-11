from django.db import models

# Create your models here.
class Estepaculo(models.Model):
    titulo = models.CharField('Título', max_length=150)
    data = models.DateTimeField('Data')
    @property
    def total_livre(self):
        return self.poltrona_set.filter(ocupada=False).count()
    @property
    def total_ocupada(self):
        return self.poltrona_set.filter(ocupada=True).count()
    @property
    def arrecadado(self):
        arrecadado = 23.76*self.poltrona_set.filter(ocupada=True).count()
        return "{:.2f}".format(arrecadado)

    def __str__(self):
        return self.titulo

class Poltrona(models.Model):
    ocupada = models.BooleanField(default=False)
    espetaculo = models.ForeignKey(Estepaculo)

    @property
    def status(self):
        if self.ocupada:
            return 'Ocupada'
        else:
            return 'Disponível'
    def __str__(self):
        return '{} - {}'.format(self.espetaculo.titulo, self.pk)