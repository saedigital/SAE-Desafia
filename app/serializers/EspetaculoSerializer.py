from rest_framework import serializers
from app.models.Espetaculo import Espetaculo

class EspetaculoSerializer(serializers.ModelSerializer):
    
    class Meta:
        model = Espetaculo
        fields = '__all__'


