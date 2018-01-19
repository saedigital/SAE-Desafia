from django.contrib import admin
from django.db.models import Q, Sum

from e_teatro.core.models import *


class BaseModelAdmin(admin.ModelAdmin):
    def changelist_view(self, request, extra_context=None):
        extra_context = extra_context or {}
        extra_context['total'] = Seat.objects.filter(reserve__isnull=False).aggregate(Sum('value'))['value__sum']
        return super(BaseModelAdmin, self).changelist_view(request, extra_context=extra_context)


@admin.register(Entertainment)
class EntertainmentAdmin(BaseModelAdmin):
    list_display = ('name', '_max_value_seat', '_max_value_seat_reserve')

    def _max_value_seat(self, obj):
        return Seat.objects.filter(entertainments=obj).aggregate(Sum('value'))['value__sum']

    _max_value_seat.short_description = 'Total'

    def _max_value_seat_reserve(self, obj):
        return Seat.objects.filter(entertainments=obj, reserve__isnull=False).aggregate(Sum('value'))['value__sum']

    _max_value_seat_reserve.short_description = 'Total Reservado'


@admin.register(Seat)
class SeatAdmin(BaseModelAdmin):
    exclude = ('reserve',)


class ReserveAdmin(admin.SimpleListFilter):
    title = 'Reservas'
    parameter_name = 'reserve'

    def lookups(self, request, model_admin):
        return (
            (None, 'Disponíveis'),
            ('MY', 'Minhas Reservas'),
        )

    def queryset(self, request, queryset):
        user = request.user
        query = Seat.objects.filter(Q(reserve__isnull=True) | Q(reserve=user))
        if self.value() == 'MY':
            query = query.filter(reserve=user)
        return query


def action_reserve(modeladmin, request, queryset):
    user = request.user
    queryset.update(reserve=user)


action_reserve.short_description = 'Reservar'


def action_cancellation_reserve(modeladmin, request, queryset):
    queryset.update(reserve=None)


action_cancellation_reserve.short_description = 'Cancelar Reserva'


@admin.register(Reserve)
class ReserveAdmin(BaseModelAdmin):
    list_filter = (ReserveAdmin,)
    actions = [action_reserve, action_cancellation_reserve]
    view_on_site = True
    readonly_fields = ('number', 'value', 'entertainments')
    exclude = ('reserve',)
    list_display = ('number', 'entertainments', 'value', 'reserve_tag')

    def get_actions(self, request):
        actions = super(ReserveAdmin, self).get_actions(request)
        if 'delete_selected' in actions:
            del actions['delete_selected']
        return actions
