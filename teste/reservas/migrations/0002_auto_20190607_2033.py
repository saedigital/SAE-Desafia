# Generated by Django 2.2.2 on 2019-06-07 20:33

from django.db import migrations


class Migration(migrations.Migration):

    dependencies = [
        ('espetaculos', '0001_initial'),
        ('poltronas', '0002_remove_poltronas_status'),
        ('reservas', '0001_initial'),
    ]

    operations = [
        migrations.AlterUniqueTogether(
            name='reservas',
            unique_together={('espetaculo', 'poltrona')},
        ),
    ]
