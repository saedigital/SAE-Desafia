from django.apps import AppConfig
from django.db.models.signals import post_save


class EspetaculosConfig(AppConfig):
    name = 'espetaculos'

    def ready(self):
        from espetaculos.signals import create_poltronas
        from espetaculos.models import Espetaculo
        post_save.connect(create_poltronas, sender=Espetaculo)
