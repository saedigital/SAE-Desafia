from rest_framework import serializers
from app.models.Reserva import Reserva

class ReservaSerializer(serializers.ModelSerializer):
    

    class Meta:
        model = Reserva
        fields = '__all__'
        extra_kwargs = {'id': {'read_only': False,'required':False}}
        


