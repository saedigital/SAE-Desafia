<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
            $this->load->model("espetaculos_model");
            $espetaculos = $this->espetaculos_model->listaEspetaculos();
            if ($espetaculos == Array()){
                $espetaculos = null;
            }
        
            $data['espetaculos'] = $espetaculos;
            
            $this->load->view('header', $data);
            $this->load->view('home', $data);
            $this->load->view('footer', $data);
	}
        public function reserva($e){
            $this->load->model("espetaculos_model");
            $esp = $this->espetaculos_model->listaEspetaculoUnico($e);
            if ($esp['numReservas'] == $esp['numPoltronas']){
                $data['msg']="Lugares esgotados";
                $data['acao']=0;
                $data['e'] = $esp;
            }else{
                $data['acao']=1;
                $data['e'] = $esp;
            }
            $this->load->view('header', $data);
            $this->load->view('reserva', $data);
            $this->load->view('footer', $data);
        }
        public function confirmaReserva(){
            $this->load->model("espetaculos_model");
            $idEspetaculo = $this->input->post('idEspetaculo');
            $numReservas = $this->input->post('numReservas');
            $atlz = $numReservas + 1;
            $infoReserva = array(
            'idEspetaculo' => $this->input->post('idEspetaculo'),
            'nomeCliente' => $this->input->post('nomeCliente'),
            'dataReserva' => date("Y-m-d")
            );
            if (!$this->espetaculos_model->confirmaReserva($infoReserva)) {
                if(!$this->espetaculos_model->confirmaPoltrona($idEspetaculo, $atlz)) {
                    redirect('home/reservaConfirmada');
                }else{
                    redirect('home/reservaErro');
                }
            } else {
                redirect('home/reservaErro');
            }
            
        }
        public function reservaErro(){
            $data['erro'] =  'Erro na reserva';
            $this->load->view('header', $data);
            $this->load->view('reservaErro', $data);
            $this->load->view('footer', $data);
        }
        public function reservaConfirmada(){
            $data['msg'] =  'Reserva Confirmada!';
            $this->load->view('header', $data);
            $this->load->view('reservaConfirmada', $data);
            $this->load->view('footer', $data);
        }
        
        public function admReserva($e){
            $this->load->model("espetaculos_model");
            $esp = $this->espetaculos_model->listaEspetaculoUnico($e);
            $data['e'] = $esp;
            $data['faturamento'] = ($esp['numReservas'] * 23.76);
            $data['reservas'] = $this->espetaculos_model->listaReservas($e);
            $this->load->view('header', $data);
            $this->load->view('admReservas', $data);
            $this->load->view('footer', $data);
        }
        public function cancelarReserva($r,$e){
            $this->load->model("espetaculos_model");
            $esp = $this->espetaculos_model->listaEspetaculoUnico($e);
            $numReservas = $esp['numReservas'];
            $atlz = $numReservas - 1;
            if(!$this->espetaculos_model->apagaReserva($r)){
                if(!$this->espetaculos_model->confirmaPoltrona($e, $atlz)){
                    redirect('home/admReserva/'.$e);
                }else{
                    redirect('home/admReserva/'.$e);
                }
            }else{
                redirect('home/admReserva/'.$e);
            }
        }
        public function cadastrarEspetaculo(){
            $data['hoje'] = date("Y-m-d");
            $this->load->view('header', $data);
            $this->load->view('cadastrarEspetaculo', $data);
            $this->load->view('footer', $data);
        }
        public function gravaEspetaculo(){
            $this->load->model("espetaculos_model");
            $infoEspetaculo = array(
            'nomeEspetaculo' => $this->input->post('nomeEspetaculo'),
            'numPoltronas' => $this->input->post('numPoltronas'),
            'dataEspetaculo' => $this->input->post('dataEspetaculo'),
            'numReservas' => 0,
            );
            if (!$this->espetaculos_model->gravaEspetaculo($infoEspetaculo)) {
                redirect('home');
            } else {
                redirect('home');
            }
        }
        public function editarEspetaculo($e){
            $this->load->model("espetaculos_model");
            $esp = $this->espetaculos_model->listaEspetaculoUnico($e);
            $data['e'] = $esp;
            $this->load->view('header', $data);
            $this->load->view('editarEspetaculo', $data);
            $this->load->view('footer', $data);
        }
        public function atualizarEspetaculo($e){
           $this->load->model("espetaculos_model");
            $infoEspetaculo = array(
            'nomeEspetaculo' => $this->input->post('nomeEspetaculo'),
            'numPoltronas' => $this->input->post('numPoltronas'),
            'dataEspetaculo' => $this->input->post('dataEspetaculo'),
            );
            if (!$this->espetaculos_model->atualizarEspetaculo($e,$infoEspetaculo)) {
                redirect('home');
            } else {
                redirect('home');
            } 
        }
        public function deletaEspetaculo($e){
            $this->load->model("espetaculos_model");
            if(!$this->espetaculos_model->apagaReservaEspetaculo($e)){
                if(!$this->espetaculos_model->apagaEspetaculo($e)){
                    redirect('home');
                }else{
                    redirect('home');
                }
            }else{
                redirect('home');
            }
        }
}
