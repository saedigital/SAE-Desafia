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
    $content = $this->shows->list();
    foreach($content as $show){
      $start_us = new DateTime($show->start);
      $duration_us = new DateTime($show->duration);
      $show->start_br = $start_us->format('d/m/Y H:i');
      $show->duration_br = $duration_us->format('H:i');
    }
    $data['title'] = 'Espetáculos';
    $data['content'] = $content;
    $this->template->view('admin/Shows_view', $data, 'admin');
	}

  public function insert()
  {
    if($this->input->post()){

			if($this->form_validation->run('show_fieds') == FALSE){
        $message = [
          'type' => 'error',
          'msg' => 'Ocorreu um erro no preenchimento do(s) campo(s) abaixo: <ul>' . validation_errors('<li>','</li>') . '</ul>'
        ];
	    }else{
        $post = $this->input->post();
        $post['start'] = implode(' ', [$post['start_date'], $post['start_time']]);
        unset($post['start_date']);
        unset($post['start_time']);
				if($this->shows->create( $post )){
          $message = [
            'type' => 'success',
            'msg' => 'Espetáculo incluso com sucesso.'
          ];
				}else{
          $message = [
            'type' => 'error',
            'msg' => 'Ocorreu um erro no servidor e o espetáculo não pôde ser salvo'
          ];
				}
	    }
      if(isset($message)){
        $this->session->set_flashdata($message['type'], $message['msg']);
        if($message['type'] == 'success') redirect(base_url('admin/shows'));
      }
		}

    $data['title'] = 'Incluir espetáculo';
    $this->template->view('admin/Shows-insert_view', $data, 'admin');
  }

  public function update($id=NULL)
  {
    if($post = $this->input->post()){

      if($this->form_validation->run('show_fieds') == FALSE){
        $message = [
          'type' => 'error',
          'msg' => 'Ocorreu um erro no preenchimento do(s) campo(s) abaixo: <ul>' . validation_errors('<li>','</li>') . '</ul>'
        ];
      }else{
        $post_id = $post['id'];
        $post['start'] = implode(' ', [$post['start_date'], $post['start_time']]);
        unset($post['id']);
        unset($post['start_date']);
        unset($post['start_time']);
        if($this->shows->update( $post_id, $post )){
          $message = [
            'type' => 'success',
            'msg' => 'Espetáculo atualizado com sucesso.'
          ];
        }else{
          $message = [
            'type' => 'error',
            'msg' => 'Ocorreu um erro no servidor e o espetáculo não pôde ser atualizado.'
          ];
        }
      }
      if(isset($message)){
        $this->session->set_flashdata($message['type'], $message['msg']);
        redirect(base_url('admin/shows'));
      }
    }

    $data['title'] = 'Editar espetáculo';
    if(!$data['content'] = $this->shows->get_by_id($id)) show_404();
    $start = new DateTime($data['content']->start);
    $data['content']->start_date = $start->format('Y-m-d');
    $data['content']->start_time = $start->format('H:i');
    // histórico de compras
    $sales = $this->sales->get_by_show($id);
    $total_sold = [];
    $data['last_seat'] = 1;
    foreach($sales as $sale){
      $created_at = new DateTime($sale->created_at);
      $sale->created_at_br = $created_at->format('d/m/Y H:i:s');
      $total_sold[] = $sale->seat_value;
      if($sale->seat_number > $data['last_seat']) $data['last_seat'] = $sale->seat_number;
    }
    $data['sales'] = $sales;
    $data['total_sold'] = (float) array_sum($total_sold);
    $this->template->view('admin/Shows-update_view', $data, 'admin');
  }

  public function delete($id=NULL)
  {
    if(!$this->shows->get_by_id($id)) show_404();
    if($this->shows->delete($id)){
      $message = [
        'type' => 'success',
        'msg' => 'Espetáculo excluído com sucesso'
      ];
    }else{
      $message = [
        'type' => 'error',
        'msg' => 'Ocorreu um erro no servidor e o espetáculo não pôde ser excluído'
      ];
    }
    if(isset($message)){
      $this->session->set_flashdata($message['type'], $message['msg']);
      if($message['type'] == 'success') redirect(base_url('admin/shows'));
    }
  }

}
