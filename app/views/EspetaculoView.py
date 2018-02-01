from rest_framework import viewsets
from app.models.Espetaculo import Espetaculo
from app.serializers.EspetaculoSerializer import EspetaculoSerializer

class EspetaculoView(viewsets.ModelViewSet):
    
    queryset = Espetaculo.objects.all()
    serializer_class = EspetaculoSerializer
    




