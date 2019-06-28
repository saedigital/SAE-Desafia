<?php
/**
 * Created by PhpStorm.
 * User: arbigaus
 * Date: 2019-06-28
 * Time: 12:11
 */

class showController extends Controller
{
    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $dados = array();

        $shows = new Shows();
        $shows->createShow();
        $shows->updateShow();

        $dados['shows'] = $shows->getShows();
        $this->loadTemplate('shows', $dados);

    }

    public function deleteShow($id) {

        $remove = new Shows();
        $remove->delShow($id);

        header("Location: /show");
    }

}