<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shows extends MY_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Shows_model', 'shows');
    $this->load->model('Sales_model', 'sales');
  }

	public function index()
	{
    $data['title'] = 'Espetáculos';
    if($shows = $this->shows->list()){
      foreach($shows as $show){
        // data de início e duração
        $start_date = new DateTime($show->start);
        $show->start_date_br = $start_date->format('d/m/Y');
        $show->start_time = $start_date->format('H:i');
        $show->duration_min = strtotime('1970-01-01 '.$show->duration.'UTC')/60;
        // resumo
        $excerpt = substr($show->description,0,100);
        $excerpt = explode(' ', $excerpt);
        array_pop($excerpt);
        $show->excerpt = implode(' ', $excerpt);
        // acentos disponíveis
        $show->seat_enable = $show->seating_total - $show->total_seat;
      }
      $data['shows'] = $shows;
    }
    if(count($shows) == 0){
      $data['info'] = 'Não foram encontrados espetáculos cadastrados';
    }
    $this->template->view('Shows_view', $data);

	}

  public function details($id=NULL){
    if(!$show = $this->shows->details($id)) show_404();
    $sales = $this->sales->get_by_show($id);
    $data['title'] = $show->title;
    $data['show'] = $show;
    // data de início e duração
    $start_date = new DateTime($show->start);
    $data['show']->start_date_br = $start_date->format('d/m/Y');
    $data['show']->start_time = $start_date->format('H:i');
    $data['show']->duration_min = strtotime('1970-01-01 '.$show->duration.'UTC')/60;
    // acentos disponíveis
    $data['show']->seat_enable = $show->seating_total - $show->total_seat;
    // acentos vendidos
    foreach($sales as $seat){
      if($seat->user_id == $this->session->userdata('id')) $data['show']->my_seat[] = $seat;
    }
    $data['show']->disabled = $sales;
    $this->template->view('Shows-details_view', $data);
  }

  public function reserve(){
    if(!$post = $this->input->post()) show_404();
    $count = 0;
    foreach($post['seating'] as $seat_number){
      $reserve = [
        'user_id' => $this->session->userdata('id'),
        'show_id' => $post['id'],
        'seat_number' => $seat_number,
        'seat_value' => $post['seat_value'],
      ];
      $this->sales->create($reserve);
      $count++;
    }
    if($count == count($post['seating'])){
      $msg_type = 'success';
      $msg = 'Reserva realizada com sucesso';
    }else{
      $msg_type = 'error';
      $msg = 'Ocorreu um erro e a reserva não pode ser realizada';
    }
    $this->session->set_flashdata($msg_type, $msg);
    redirect(base_url('shows/details/'.$post['id']));
  }

  public function cancel($show_id=NULL, $seat_number=NULL)
  {

    if($sale = $this->sales->cancel($show_id, $seat_number)){
      $msg_type = 'success';
      $msg = 'Reserva cancelada com sucesso';
    }else{
      $msg_type = 'error';
      $msg = 'Ocorreu um erro e a reserva não pôde ser cancelada';
    }

    $this->session->set_flashdata($msg_type, $msg);
    redirect(base_url('shows/details/'.$show_id));
  }


}
