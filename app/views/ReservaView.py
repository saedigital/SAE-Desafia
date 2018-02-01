from rest_framework import viewsets
from app.models.Reserva import Reserva
from app.serializers.ReservaSerializer import ReservaSerializer

class ReservaView(viewsets.ModelViewSet):
    
    queryset = Reserva.objects.all()
    serializer_class = ReservaSerializer
