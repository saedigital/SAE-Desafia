from django.db import models
from django.core.urlresolvers import reverse


class Show(models.Model):
    name = models.CharField(max_length=255)
    author = models.CharField(max_length=255)
    date = models.DateField()

    def __unicode__(self):
        return self.name

    def get_absolute_url(self):
        return reverse('show:show_edit', kwargs={'pk': self.pk})
