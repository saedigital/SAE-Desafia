# -*- coding: utf-8 -*-
# Generated by Django 1.10 on 2018-02-12 19:00
from __future__ import unicode_literals
from app.models.Poltrona import Poltrona

from django.db import migrations

def criarPoltronas(): ## PRÉ-DEFININDO AS 100 POLTRONAS DO TEATRO
    poltronas_qs = []

    for x in range(100):
        poltronas_qs.append(Poltrona(numero = x + 1))

    Poltrona.objects.bulk_create(poltronas_qs)


class Migration(migrations.Migration):

    dependencies = [
        ('app', '0002_reserva_espetaculo'),
    ]

    operations = [
		migrations.RunSQL(criarPoltronas()),
        migrations.RemoveField(
            model_name='poltrona',
            name='espetaculo',
        ),
    ]

    	
 
