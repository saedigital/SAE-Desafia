from django.contrib import admin

# Register your models here.
from .models import Reservas


class ReservasAdmin(admin.ModelAdmin):
    list_display = ('id', 'get_espetaculo', 'get_poltrona')

    def get_espetaculo(self, obj):
        return obj.espetaculo.titulo

    get_espetaculo.short_description = 'Espetaculo'

    def get_poltrona(self, obj):
        return obj.poltrona.numero

    get_poltrona.short_description = 'Poltrona'


admin.site.register(Reservas, ReservasAdmin)
