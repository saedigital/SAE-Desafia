<?php
class espetaculos_model extends CI_Model{
    //CARREGA A LISTA DE ESPETACULOS QUE AINDA N'AO ACONTECERAM
    public function listaEspetaculos(){
        $this->db->from('espetaculo');
        $espetaculos = $this->db->get()->result_array();
        return $espetaculos;
    }
    //CARREGA DADOS DE UM [UNICO ESPETACULO
    public function listaEspetaculoUnico($e){
        $this->db->where("idEspetaculo", $e);
        $espetaculo = $this->db->get("espetaculo")->row_array();
        return $espetaculo;
    }
    //CONFIRMA RESERVA
    public function confirmaReserva($i){
        $this->db->insert('reservas',$i);
    }
    //ATUALIZA NUMERO DE CADEIRAS DISPONIVEIS
    public function confirmaPoltrona($idEspetaculo, $numReservas){
        $this->db->set('numReservas',$numReservas);
        $this->db->where('idEspetaculo', $idEspetaculo);
        $this->db->update('espetaculo');
    }
    
    //CARREGA A LISTA DE RESERVAS JA REALIZADAS PARA O ESPETACULO SELECIONADO
    public function listaReservas($e){
        $this->db->where('idEspetaculo', $e);
        $this->db->from('reservas');
        $reservas = $this->db->get()->result_array();
        return $reservas;
    }
    //
    public function apagaReserva($r){
        $this->db->where('idReserva', $r);
        $this->db->delete('reservas');
    }
    public function gravaEspetaculo($i){
        $this->db->insert('espetaculo',$i);
    }
    //ATUALIZA NUMERO DE CADEIRAS DISPONIVEIS
    public function atualizarEspetaculo($e, $i){
        $this->db->set('nomeEspetaculo',$i['nomeEspetaculo']);
        $this->db->set('numPoltronas',$i['numPoltronas']);
        $this->db->set('dataEspetaculo',$i['dataEspetaculo']);
        $this->db->where('idEspetaculo', $e);
        $this->db->update('espetaculo');
    }
    public function apagaReservaEspetaculo($e){
        $this->db->where('idEspetaculo', $e);
        $this->db->delete('reservas');
    }
    public function apagaEspetaculo($e){
        $this->db->where('idEspetaculo', $e);
        $this->db->delete('espetaculo');
    }
}