from espetaculos.models import Espetaculo
from rest_framework import serializers


class EspetaculoSerializer(serializers.ModelSerializer):

    class Meta:
        model = Espetaculo
        fields = (
            'id',
            'titulo',
            'descricao',
        )