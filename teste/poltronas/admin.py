from django.contrib import admin

from .models import Poltronas


class PoltronasAdmin(admin.ModelAdmin):
    exclude = ("status",)
    # def get_form(self, request, obj=None, **kwargs):
    #     self.exclude = ("status",)
    #     form = super(PoltronasAdmin, self).get_form(request, obj, **kwargs)
    #     return form


admin.site.register(Poltronas, PoltronasAdmin)
