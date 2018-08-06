from poltronas.models import Poltrona
from poltronas.models import Reserva
from rest_framework import serializers


class PoltronaSerializer(serializers.ModelSerializer):
    
    reserva = serializers.SerializerMethodField()

    class Meta:
        model = Poltrona
        fields = ('id', 'numeracao', 'espetaculo', 'reserva')

    
    def get_reserva(self, obj):
        reserva = obj.reserva_set.first()
        if reserva:
            return reserva.id
        return None


class ReservaSerializer(serializers.ModelSerializer):

    class Meta:
        model = Reserva
        fields = '__all__'
        