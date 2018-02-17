from rest_framework import serializers
from app.models.Reserva import Reserva
from app.serializers.PoltronaSerializer import PoltronaSerializer


class ReservaSerializer(serializers.ModelSerializer):

    poltrona = PoltronaSerializer()
    id = serializers.IntegerField(read_only = False, required = False)

    class Meta:
        model = Reserva
        fields = '__all__'      

    def create(self,validated_data):
        poltronaData = validated_data.pop('poltrona')
        reserva = Reserva.objects.create(poltrona_id = poltronaData['id'],**validated_data)
        
        return reserva