from rest_framework import viewsets
from app.models.Poltrona import Poltrona
from app.serializers.PoltronaSerializer import PoltronaSerializer

class PoltronaView(viewsets.ModelViewSet):

    queryset = Poltrona.objects.all()
    serializer_class = PoltronaSerializer

    """description of class"""


