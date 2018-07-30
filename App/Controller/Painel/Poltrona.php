<?php
namespace Controller\Painel;

use Libraries\ProfileUser;
use Models\Model_Events;
use Models\Model_Tickets;
use System\Controller;
use System\Libraries\Forms;
use System\Libraries\Lang;
use System\Libraries\Session;
use System\Response;
use System\ResponseType;

class Poltrona extends Controller {

    private $vars = [];

    public function __construct(){
        parent::__construct();
        Lang::getInstance()->load("Admin");
        Lang::getInstance()->load("Admin_Poltrona");
        Lang::getInstance()->load("Admin_Espetaculo");

        $hasLoggon = ProfileUser::hasLoggon();
        if (!$hasLoggon){
            redirect("Login");
        }
        $this->vars['Profile'] = $hasLoggon;

        $this->loadHelper("Functions");
    }

    /**
     * Reservar Poltrona
     * @throws \Exception
     */
    public function Reserve(){
        Response::getInstance()->setHeaderType(ResponseType::CONTENT_JSON);

        $eId = (int)Response::post("id");
        $Lang = Lang::getInstance();
        $Forms = Forms::getInstance();

        $Model = Model_Events::init_instance()->getId($eId);
        if (!$Model){
            echo Response::getInstance()->encodeJson($Lang->line("espetaculo_notfound"),[], true);
            return;
        }

        $Poltrona = new \Validate\Poltrona();
        $Forms->setRules("nome", true, [ $Poltrona, "validateName" ], [], $Lang->line("error_polt_nome"));
        $Forms->setRules("code", true, [ $Poltrona, "validateCode" ], ["id" => $eId], $Lang->line("error_polt_code"));
        $Forms->setRules("doc", true, [ $Poltrona, "validateDoc" ], [], $Lang->line("error_polt_doc"));
        $Forms->validate("cadPoltrona");

        if ($Forms->hasErrors()){
            echo Response::getInstance()->encodeJson(
                $Lang->line("error_polt_msg"),
                array_merge($Forms->getErrors(), [ "newToken" => $Forms->initJson("cadPoltrona") ]),
                true
            );
            return;
        }

        if ($Model->ticketsActive == $Model->ticketsLimit){
            echo Response::getInstance()->encodeJson(
                $Lang->line("error_polt_limite"),
                [ "newToken" => $Forms->initJson("cadPoltrona") ],
                true
            );
            return;
        }

        $Tickets = Model_Tickets::init_instance();
        $Tickets->create(array_merge($Forms->getFields(), ["id" => $eId, "uId" => $this->vars['Profile']['id']]));
        $Model->upTickets($Model->ticketsActive + 1, $Model->ticketsCancel);

        echo  Response::getInstance()->encodeJson(
            $Lang->line("error_polt_success"),
            ["url" => base_url("Painel/Espetaculos/View/{$Model->id}")]
        );
    }

    /**
     * Cancelar Reserva
     */
    public function Cancel(){
        $ticketId = (int)$this->getApp()->getPatch(3);
        $Model = Model_Tickets::init_instance()->getId($ticketId);
        if (!$Model){
            Session::getInstance()->setFlash("error", Lang::getInstance()->line("error_polt_error"));
            redirect("Painel/Espetaculos");
        }

        if ($Model->status == Model_Tickets::ATIVE) {
            $Model->cancel();
            $Event = Model_Events::init_instance()->getId($Model->eventId);
            $Event->upTickets($Event->ticketsActive - 1, $Event->ticketsCancel + 1);
        }

        redirect("Painel/Espetaculos/View/{$Model->eventId}");
    }

    /**
     * Apagar Reserva
     */
    public function Delete(){
        $ticketId = (int)$this->getApp()->getPatch(3);
        $Model = Model_Tickets::init_instance()->getId($ticketId);
        if (!$Model){
            Session::getInstance()->setFlash("error", Lang::getInstance()->line("error_polt_error"));
            redirect("Painel/Espetaculos");
        }

        if ($Model->status == Model_Tickets::ATIVE) {
            $Event = Model_Events::init_instance()->getId($Model->eventId);
            $Event->upTickets($Event->ticketsActive - 1, $Event->ticketsCancel);
        }
        if ($Model->status == Model_Tickets::CANCEL) {
            $Event = Model_Events::init_instance()->getId($Model->eventId);
            $Event->upTickets($Event->ticketsActive, $Event->ticketsCancel - 1);
        }

        $EventId = $Model->eventId;
        $Model->remove();
        redirect("Painel/Espetaculos/View/{$EventId}");
    }
}