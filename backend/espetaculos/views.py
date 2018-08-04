from rest_framework import viewsets
from espetaculos.models import Espetaculo
from espetaculos.serializers import EspetaculoSerializer


class EspetaculoViewSet(viewsets.ModelViewSet):
    queryset = Espetaculo.objects.all()
    serializer_class = EspetaculoSerializer