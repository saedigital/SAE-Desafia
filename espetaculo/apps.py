from django.apps import AppConfig


class EspetaculoConfig(AppConfig):
    name = 'espetaculo'
    def ready(self):
        import espetaculo.signals