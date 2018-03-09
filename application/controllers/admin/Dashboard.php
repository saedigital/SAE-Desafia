<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Shows_model', 'shows');
    $this->load->model('Sales_model', 'sales');
  }

	public function index()
	{
    $sales_total = $this->sales->total();
    $seats_total = $this->shows->total_seats();
    $seats_enabled = $seats_total - $sales_total;

    $data['title'] = 'Dashboard';
    $data['total_shows'] = $this->shows->total();
    $data['total_seats'] = $seats_total;
    $data['total_enabled_seats'] = $seats_enabled;
    $data['total_disabled_seats'] = $sales_total;
    $data['total_sold'] = $this->sales->total_sold();
    $this->template->view('admin/Dashboard_view', $data, 'admin');
	}
}
