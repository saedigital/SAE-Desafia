from rest_framework import viewsets
from poltronas.models import Poltrona
from poltronas.models import Reserva
from poltronas.serializers import PoltronaSerializer
from poltronas.serializers import ReservaSerializer


class PoltronaViewSet(viewsets.ModelViewSet):
    
    queryset = Poltrona.objects.all()
    serializer_class = PoltronaSerializer


class ReservaViewSet(viewsets.ModelViewSet):
    
    queryset = Reserva.objects.all()
    serializer_class = ReservaSerializer