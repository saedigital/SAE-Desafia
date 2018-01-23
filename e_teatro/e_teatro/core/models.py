from django.contrib.auth.models import User
from django.db import models


class Entertainment(models.Model):
    name = models.CharField(max_length=150, verbose_name='Nome')
    start_date = models.DateTimeField(verbose_name='Data de Início')
    end_date = models.DateTimeField(verbose_name='Data de Termino')

    class Meta:
        verbose_name = 'Espetáculo'

    def __str__(self):
        return self.name


class Seat(models.Model):
    number = models.CharField(max_length=5, verbose_name='Número')
    reserve = models.ForeignKey(User, on_delete=models.PROTECT, verbose_name='Reserva', null=True, blank=True)
    value = models.FloatField(default=23.76, verbose_name='Valor')
    entertainments = models.ForeignKey(Entertainment, verbose_name='Espetáculo', on_delete=models.PROTECT)

    def reserve_tag(self):
        result = True if self.reserve else False
        return result

    reserve_tag.boolean = True
    reserve_tag.short_description = 'Reservado?'

    class Meta:
        verbose_name = 'Poltrona'

    def __str__(self):
        return '{0} - {1}'.format(self.number, self.entertainments.name)


class Reserve(Seat):
    class Meta:
        verbose_name = 'Reserva'
        proxy = True
