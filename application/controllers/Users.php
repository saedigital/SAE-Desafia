<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Users_model', 'users');
  }

	public function login()
	{
    $template = 'default';
    if($this->session->userdata('logged_in')){
      if($this->session->userdata('is_admin')){
        redirect(base_url('admin'));
      }else{
        redirect(base_url());
      }
    }

    if($post = $this->input->post()){

      if($this->form_validation->run('login') == FALSE){
        $message = [
          'type' => 'error',
          'msg' => '<ul>' . validation_errors('<li>','</li>') . '</ul>'
        ];
      }else{
        if($user = $this->users->login( $post )){
          $this->session->set_userdata('logged_in', TRUE);
          $this->session->set_userdata('id', $user->id);
          $this->session->set_userdata('name', $user->name);
          $name = explode(' ', $user->name);
          $this->session->set_userdata('first_name', $name['0']);

          if($user->type == 1){
            $template = 'admin';
            $this->session->set_userdata('is_admin', TRUE);
            redirect(base_url('admin/dashboard'));
          }
          redirect(base_url());
        }else{
          $this->session->set_flashdata('error', 'Login ou senha inválidos');
          redirect(base_url($this->uri->segment(1).'/login'));
        }
      }
    }
    $data['title'] = 'Login';
    $this->template->view('Users-login_view', $data, $template);
	}


  public function logout(){
    $this->session->unset_userdata('logged_in');
    $this->session->unset_userdata('is_admin');
    redirect(base_url());
  }

}
