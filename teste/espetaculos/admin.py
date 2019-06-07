from django.contrib import admin

# Register your models here.
from .models import Espetaculos
from poltronas.models import Poltronas

class EspetaculosAdmin(admin.ModelAdmin):
    list_display = ('titulo', 'get_total_poltrona', 'get_total_poltrona_vendida', 'get_valor_arrecadado')

    def get_total_poltrona(self, obj):
        return Poltronas.objects.all().count()

    get_total_poltrona.short_description = 'Total poltronas'

    def get_total_poltrona_vendida(self, obj):
        return obj.reservas_set.count()

    get_total_poltrona_vendida.short_description = 'Total poltronas vendidas'

    def get_valor_arrecadado(self, obj):
        return 'R$ {}'.format(obj.reservas_set.count() * float(23.76))

    get_valor_arrecadado.short_description = 'Valor arrecadado'


admin.site.register(Espetaculos, EspetaculosAdmin)
