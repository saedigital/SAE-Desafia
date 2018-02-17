from rest_framework import viewsets
from django_filters.rest_framework import DjangoFilterBackend
from app.models.Reserva import Reserva
from app.serializers.ReservaSerializer import ReservaSerializer

class ReservaView(viewsets.ModelViewSet):
    
    queryset = Reserva.objects.all()
    serializer_class = ReservaSerializer
    filter_backends = (DjangoFilterBackend,)
    filter_fields = ('id','espetaculo','poltrona',)




