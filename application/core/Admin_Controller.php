<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->logged_in = $this->session->userdata('logged_in');
    $this->is_admin = $this->session->userdata('is_admin');
  }

  public function index(){
    if(!$this->logged_in || !$this->is_admin) redirect(base_url('admin/login'))
  }

}
