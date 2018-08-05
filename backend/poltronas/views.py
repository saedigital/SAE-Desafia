from rest_framework import viewsets
from poltronas.models import Poltrona
from poltronas.models import Reserva
from poltronas.serializers import PoltronaSerializer
from poltronas.serializers import ReservaSerializer
from django_filters import rest_framework as filters


# class PoltronasFilter(django_filters.FilterSet):
#     class Meta:
#         model = Poltrona
#         fields = ('espetaculo')


class PoltronaViewSet(viewsets.ModelViewSet):
    
    queryset = Poltrona.objects.all()
    serializer_class = PoltronaSerializer
    filter_backends = (filters.DjangoFilterBackend,)
    filter_fields = ('espetaculo',)


class ReservaViewSet(viewsets.ModelViewSet):
    
    queryset = Reserva.objects.all()
    serializer_class = ReservaSerializer