from rest_framework import serializers
from app.models.Poltrona import Poltrona

class PoltronaSerializer(serializers.ModelSerializer):
    
    class Meta:
        model = Poltrona
        fields = '__all__'



