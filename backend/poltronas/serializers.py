from poltronas.models import Poltrona
from poltronas.models import Reserva
from rest_framework import serializers


class PoltronaSerializer(serializers.ModelSerializer):
    
    class Meta:
        model = Poltrona
        fields = '__all__'


class ReservaSerializer(serializers.ModelSerializer):

    class Meta:
        model = Reserva
        fields = '__all__'
        