from rest_framework import serializers
from app.models.Reserva import Reserva
from app.serializers.ReservaSerializer import ReservaSerializer
from app.models.Espetaculo import Espetaculo

class EspetaculoSerializer(serializers.ModelSerializer):
    
    reservas = ReservaSerializer(many=True, required = False) ## PROPRIEDADE NÃO OBRIGATÓRIA EM POST E UPDATE 

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
            id_reservas.append(reserva['id'])

        for id in id_reservas:
            if id not in reservas_id:
                Reserva.objects.get(id = id).delete() ## DELETANDO RESERVA SE NÃO ESTIVER ENTRE OS ITENS A ATUALIZAR


        # UPDATES AND CREATIONS
        for r in reservas:
            reserva_id = r.get('id',None)
            if reserva_id:
                reserva = Reserva.objects.get(id = reserva_id)
                reserva.poltrona_id = r['poltrona']
                reserva.save()
            else:
                Reserva.objects.create(**r)       
        

        return instance
        
