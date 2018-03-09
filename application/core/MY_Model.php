<?php

class MY_Model extends CI_Model
{

  public $_table = '';
  public $_primary = 'id';


  public function __construct()
  {
    parent::__construct();
  }

  // localiza todos os registros
  public function get_all($limit=NULL, $offset=NULL){
    if($query = $this->db->get($this->_table)) return $query->result();
    return FALSE;
  }

  // localiza os registros baseados em uma condição
  public function get_where($data, $limit=NULL, $offset=NULL){
    if($query = $this->db->get_where($this->_table, $data, $limit, $offset)) return $query->result();
    return FALSE;
  }

  // localiza um único registro pelo ID
  public function get_by_id($id){
    if($id && $query = $this->db->get_where($this->_table, [$this->_primary => $id])) return @$query->result()[0];
    return FALSE;
  }

  // adiciona um registro
  public function create($data){
    if($query = $this->db->insert($this->_table, $data)) return $this->db->insert_id();
    return FALSE;
  }

  // atualiza um registro
  public function update($id, $data){
    if($query = $this->db->where($this->_primary,$id)->update($this->_table, $data)) return $id;
    return FALSE;
  }

  // exclui um registro
  public function delete($id){
    if($query = $this->db->where($this->_primary,$id)->delete($this->_table)) return $id;
    return FALSE;
  }

  // Soma todos os registros
  public function total(){
    if($query = $this->db->count_all($this->_table)) return $query;
    return FALSE;
  }

}
