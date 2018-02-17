from rest_framework import serializers
from app.models.Poltrona import Poltrona

class PoltronaSerializer(serializers.ModelSerializer):
    
    id = serializers.IntegerField(read_only=False, required = False)

    class Meta:
        model = Poltrona
        fields = '__all__'



