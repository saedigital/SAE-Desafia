<?php

class Shows_model extends MY_Model
{
  public $_table = 'shows';
  public $_total_seat = '(SELECT COUNT(*) FROM sales WHERE sales.show_id = shows.id) AS total_seat';
  public $_total_sold = '(SELECT SUM(seat_value) FROM sales WHERE sales.show_id = shows.id) AS total_sold';

  public function __construct()
  {
    parent::__construct();
  }

  public function list()
  {
    $query = $this->db->select('*,'.$this->_total_seat.','.$this->_total_sold)
            ->order_by('start')
            ->get($this->_table);
    if($query) return $query->result();
    return FALSE;
  }

  public function details($id=NULL){
    $query = $this->db->select('*,'.$this->_total_seat.','.$this->_total_sold)
              ->where(['id'=>$id])
              ->get($this->_table);
    if($query) return $query->result()[0];
    return FALSE;
  }

  public function total_seats(){
    $query = $this->db->select_sum('seating_total')->get($this->_table);
    if($query) return $query->result()[0]->seating_total;
    return FALSE;
  }

}
