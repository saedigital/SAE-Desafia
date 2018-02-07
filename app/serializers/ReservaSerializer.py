from rest_framework import serializers
from app.models.Reserva import Reserva
from app.serializers.PoltronaSerializer import PoltronaSerializer


class ReservaSerializer(serializers.ModelSerializer):

    poltrona = PoltronaSerializer(read_only = True)
    
    class Meta:
        model = Reserva
        fields = '__all__'
        extra_kwargs = {'id': {'read_only': False,'required':False}}
        


