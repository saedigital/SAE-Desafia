from django.db import models


class Espetaculo(models.Model):
    
    titulo = models.CharField(max_length=60)
    descricao = models.TextField(null=True, blank=True)
    total_de_poltronas = models.PositiveIntegerField(default=20)


    def __str__(self):
        return self.titulo

    def save(self, *args, **kwargs):
        super(Espetaculo, self).save(*args, **kwargs)
