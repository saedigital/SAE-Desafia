from rest_framework import serializers
from rest_framework.relations import PrimaryKeyRelatedField
from app.models.Reserva import Reserva
from app.serializers.ReservaSerializer import ReservaSerializer
from app.models.Espetaculo import Espetaculo

class EspetaculoSerializer(serializers.ModelSerializer):
    
    reservas_id = PrimaryKeyRelatedField(many=True, read_only = True, source='reservas') ## PROPRIEDADE UTILIZADA EM GET REQUESTS
    reservas = ReservaSerializer(many=True, required = False,write_only = True)  ## PROPRIEDADE NÃO OBRIGATÓRIA EM POST E UPDATE 

    class Meta:
        model = Espetaculo
        fields = '__all__'
    

    def update(self,instance, validated_data):

        instance.descricao = validated_data.get('descricao', instance.descricao)
        instance.data = validated_data.get('data', instance.data)
        instance.hora = validated_data.get('hora', instance.hora)
        instance.save()
      
        reservas = validated_data.get('reservas',None)
        
        ## RESERVAS A SEREM EXCLUÍDAS
        reservas_id = Reserva.objects.filter(espetaculo_id = instance.id).values_list('id',flat = True) ## RECUPERANDO OS IDS DOS ITENS NO BANCO DE DADOS
        id_reservas = [] ## VARIÁVEL PARA GUARDAR OS IDS DO ITENS A SEREM ATUALIZADOS

        for reserva in reservas:
            if hasattr(reserva, 'id'):
                id_reservas.append(reserva['id'])

        for id in id_reservas: 
            if id not in reservas_id: 
                Reserva.objects.get(id = id).delete() ## DELETANDO RESERVA DO BANCO SE NÃO ESTIVER ENTRE OS ITENS A ATUALIZAR


        # UPDATES AND CREATIONS
        for r in reservas:
            reserva_id = r.get('id',None)
            if reserva_id: ## ATUALIZANDO RESERVAS EXISTENTES
                reserva = Reserva.objects.get(id = reserva_id)
                reserva.espetaculo_id = r['espetaculo'].id
                reserva.poltrona_id = r['poltrona']['id']              
                reserva.save()
            else: ## SE RESERVA NÃO POSSUI ID, ENTÃO É UMA RESERVA A SER CRIADA
                Reserva.objects.create(poltrona_id = r['poltrona']['id'], espetaculo_id = r['espetaculo'].id)       
        

        return instance
        
