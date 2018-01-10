from django.db.models.signals import pre_save, post_save
from django.dispatch import receiver
from django.conf import settings
from .models import Estepaculo, Poltrona
import os.path

@receiver(pre_save, sender=Estepaculo)
def model_pre_change(sender, **kwargs):
    if os.path.isfile(settings.READ_ONLY_FILE):
        raise ReadOnlyException('Model in read only mode, cannot save')

@receiver(post_save, sender=Estepaculo)
def model_post_save(sender, **kwargs):

    if  kwargs['created']:
        estepaculo = kwargs['instance']
        for i in range(1, 41):
            Poltrona.objects.create(espetaculo=estepaculo)

class ReadOnlyException(Exception):
    pass
