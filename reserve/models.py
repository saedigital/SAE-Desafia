from django.db import models

from show.models import Show


class Chair(models.Model):
    sector = models.CharField(max_length=45)

    def __unicode__(self):
        return str(self.pk)


class Reserve(models.Model):
    cpf = models.CharField(max_length=45)
    price = models.DecimalField(decimal_places=2, max_digits=10)
    show = models.ForeignKey(Show, on_delete=models.CASCADE)
    chair = models.ForeignKey(Chair, on_delete=models.CASCADE)

    def __unicode__(self):
        return self.cpf

