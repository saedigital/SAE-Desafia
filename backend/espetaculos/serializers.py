from espetaculos.models import Espetaculo
from rest_framework import serializers


class EspetaculoSerializer(serializers.ModelSerializer):

    total_reservados = serializers.SerializerMethodField()
    total_livres = serializers.SerializerMethodField()
    total_arrecadado = serializers.SerializerMethodField()
    total_impostos = serializers.SerializerMethodField()

    class Meta:
        model = Espetaculo
        fields = (
            'id',
            'titulo',
            'descricao',
            'total_de_poltronas',
            'total_reservados',
            'total_livres',
            'total_arrecadado',
            'total_impostos',
        )

    def get_total_reservados(self, obj):
        return obj.poltrona_set.filter(
            reserva__isnull=False).count()
    
    def get_total_livres(self, obj):
        return obj.poltrona_set.filter(
            reserva__isnull=True).count()
    
    def get_total_arrecadado(self, obj):
        return obj.get_total_arrecadado()
    
    def get_total_impostos(self, obj):
        return obj.get_total_impostos()