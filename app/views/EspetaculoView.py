from rest_framework import viewsets, status
from app.models.Poltrona import Poltrona
import json
from app.models.Reserva import Reserva
from rest_framework.response import Response
from rest_framework.decorators import detail_route
from app.models.Espetaculo import Espetaculo
from app.serializers.EspetaculoSerializer import EspetaculoSerializer
from app.serializers.ReservaSerializer import ReservaSerializer

class EspetaculoView(viewsets.ModelViewSet):
    
    queryset = Espetaculo.objects.all().order_by('id')
    serializer_class = EspetaculoSerializer
    
    @detail_route(methods=['GET'])
    def reservas_espetaculo(self,request,pk=None): ## RETORNAR TOTAL DE RESERVAS POR ESPETÁCULO
        total = Reserva.objects.filter(espetaculo_id=pk).values().count()  ## Espetaculo.objects.raw('SELECT e.id FROM app_espetaculo AS e LEFT JOIN app_reserva AS r ON r.espetaculo_id = e.id')
        
        return Response({"data":total},status = status.HTTP_200_OK)   

    @detail_route(methods=['GET'])
    def poltronas_dispo(self,request,pk=None): ## RETORNAR TOTAL DE POLTRONAS DISPONÍVEIS POR ESPETÁCULO
        total_poltronas = Poltrona.objects.all().count()
        total_reservas = Reserva.objects.filter(espetaculo_id=pk).values().count() ## TOTAL DE RESERVAS NO ESPETACULO

        poltronas_disponiveis = total_poltronas - total_reservas
        
        return Response({"data":poltronas_disponiveis}, status = status.HTTP_200_OK)

