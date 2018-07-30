<?php
namespace Controller\Painel;

use Libraries\ProfileUser;
use Models\Model_Tickets;
use System\Controller;
use System\Libraries\Lang;

class Financeiro extends Controller {

    private $vars = [];

    public function __construct(){
        parent::__construct();
        Lang::getInstance()->load("Admin");
        Lang::getInstance()->load("Admin_Financeiro");

        $hasLoggon = ProfileUser::hasLoggon();
        if (!$hasLoggon){
            redirect("Login");
        }
        $this->vars['Profile'] = $hasLoggon;

        $this->loadHelper("Functions");
    }

    public function Index(){
        $Ticket = Model_Tickets::init_instance();

        $this->view(
            "Painel/Layout/Content",
            array_merge(
                $this->vars,
                [
                    'layout' => "Painel/Dashboard.tpl",
                    'actives' => $Ticket->countActive(),
                    'cancels' => $Ticket->countCancel()
                ]
            )
        );
    }
}