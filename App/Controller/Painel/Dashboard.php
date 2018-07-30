<?php
namespace Controller\Painel;

use Libraries\ProfileUser;
use System\Controller;
use System\Libraries\Lang;

class Dashboard extends Controller {

    private $vars = [];

    public function __construct(){
        parent::__construct();
        Lang::getInstance()->load("Admin");
        Lang::getInstance()->load("Admin_Dashboard");

        $hasLoggon = ProfileUser::hasLoggon();
        if (!$hasLoggon){
            redirect("Login");
        }
        $this->vars['Profile'] = $hasLoggon;
    }

    public function Index(){
        $this->view(
            "Painel/Layout/Content",
            array_merge(
                $this->vars,
                ['layout' => "Painel/Dashboard.tpl"]
            )
        );
    }
}