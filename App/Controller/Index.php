<?php
namespace Controller;

use Libraries\ProfileUser;
use Models\Model_Users;
use System\Controller;
use System\Libraries\Forms;
use System\Libraries\Lang;
use System\Response;
use System\ResponseType;

class Index extends Controller {

    public function __construct(){
        parent::__construct();
        Lang::getInstance()->load("Users");
    }

    /**
     * Default Route Method
     * @return null
     */
    public function Login(){
        $Data = [];
        $Data['Forms'] = Forms::getInstance();
        $this->view("Painel/Login", $Data);
    }

    /**
     * Route Action Login
     * @return null
     */
    public function ActionLogin(){
        Response::getInstance()->setHeaderType(ResponseType::CONTENT_JSON);

        $Lang = Lang::getInstance();
        $Forms = Forms::getInstance();
        $Model = Model_Users::init_instance();

        $Forms->setRules("username", true, [$Model, "ValidUsername"], [], $Lang->line("login_error_username"));
        $Forms->setRules("password", true, [$Model, "ValidPassword"], [], $Lang->line("login_error_password"));
        $Forms->validate("loginForm", Response::POST);

        if ($Forms->hasErrors()){
            echo Response::getInstance()->encodeJson(
                $Lang->line("login_error_msg"),
                array_merge($Forms->getErrors(), [ "newToken" => $Forms->initJson("loginForm") ]),
                true
            );
            return;
        }

        ProfileUser::setLoggon($Model->id);

        echo  Response::getInstance()->encodeJson(
            $Lang->line("login_success"),
            ["url" => base_url("Painel/Financeiro")]
        );
    }

}
