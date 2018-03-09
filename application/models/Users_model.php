<?php

class Users_model extends MY_Model
{
  public $_table = 'users';

  public function __construct()
  {
    parent::__construct();
  }

  public function login($data){
    $where = ['email'=>$data['email'], 'password'=>md5($data['password'])];
    $query = $this->db->get_where($this->_table, $where, 1);
    if($query) return $query->result()[0];
    return FALSE;
  }

}
