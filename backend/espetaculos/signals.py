from django.db.models.signals import post_save
from django.dispatch import receiver


def create_poltronas(sender, instance, created, **kwargs):
    if created:
        total = instance.total_de_poltronas
        for i in range(0, total):
            instance.poltrona_set.create(numeracao=i+1)
        