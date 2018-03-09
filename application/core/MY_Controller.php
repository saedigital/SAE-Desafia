<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    if($this->uri->segment(1) == 'admin' && !$this->session->userdata('is_admin')) redirect(base_url('admin/login'));
    if(!$this->session->userdata('logged_in')) redirect(base_url('login'));
  }

}
