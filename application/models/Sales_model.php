<?php

class Sales_model extends MY_Model
{
  public $_table = 'sales';

  public function __construct()
  {
    parent::__construct();
  }

  public function get_by_show($id=NULL, $where=NULL){

    $query = $this->db->select('
                sales.id as sales_id,
                sales.seat_number,
                sales.seat_value,
                sales.created_at,
                users.id as user_id,
                users.name as user_name
              ')
              ->from($this->_table)
              ->join('users', 'users.id = sales.user_id')
              ->where(['show_id'=>$id])
              ->get();
    if($query) return $query->result();
    return FALSE;
  }


  public function cancel($show_id=NULL, $seat_number=NULL){
    $where = ['show_id'=>$show_id, 'seat_number'=>$seat_number];
    if($query = $this->db->where($where)->delete($this->_table)) return TRUE;
    return FALSE;
  }

  public function total_sold(){
    $query = $this->db->select_sum('seat_value')->get($this->_table);
    if($query) return $query->result()[0]->seat_value;
    return FALSE;
  }

}
