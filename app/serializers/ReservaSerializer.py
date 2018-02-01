from rest_framework import serializers
from app.models.Reserva import Reserva

class ReservaSerializer(serializers.ModelSerializer):
    
    class Meta:
        model = Reserva
        fields = '__all__'



