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

class Espetaculos extends Controller {

    private $vars = [];

    public function __construct(){
        parent::__construct();
        Lang::getInstance()->load("Admin");
        Lang::getInstance()->load("Admin_Espetaculo");

        $hasLoggon = ProfileUser::hasLoggon();
        if (!$hasLoggon){
            redirect("Login");
        }
        $this->vars['Profile'] = $hasLoggon;

        $this->loadHelper("Functions");
    }

    /**
     * Listagem de todos os espetáculos
     */
    public function Index(){
        $Page = (int)Response::get("p");
        $Page = $Page <= 0 ? 1 : $Page;
        $List = Model_Events::init_instance()->getList($Page, 20);

        $this->view(
            "Painel/Layout/Content",
            array_merge(
                $this->vars,
                [
                    'layout' => "Painel/Espetaculos.tpl",
                    'Session' => Session::getInstance(),
                    'Results' => $List['Results'],
                    'Pages' => $List['Pager']
                ]
            )
        );
    }

    /**
     * Página de formulário de cadastro de espetáculo
     */
    public function Novo(){
        $this->view(
            "Painel/Layout/Content",
            array_merge(
                $this->vars,
                [
                    'layout' => "Painel/EspetaculosNovo.tpl",
                    'Forms' => Forms::getInstance()
                ]
            )
        );
    }

    /**
     * Validar e efetuar cadastro dos espetáculos
     */
    public function Cadastrar(){
        Response::getInstance()->setHeaderType(ResponseType::CONTENT_JSON);

        $Lang = Lang::getInstance();
        $Forms = Forms::getInstance();

        $Validate = new \Validate\Espetaculos();
        $Forms->setRules("nome", true, [ $Validate, "validateName" ], [], $Lang->line("esp_error_name"));
        $Forms->setRules("limit", true, [ $Validate, "validateLimit" ], [], $Lang->line("esp_error_limit"));
        $Forms->setRules("init", true, [ $Validate, "validateDataInit" ], [], $Lang->line("esp_error_init"));
        $Forms->setRules("end", true, [ $Validate, "validateDataEnd" ], ["data_init" => Response::post("init")], $Lang->line("esp_error_end"));
        $Forms->setRules("uf", true, [ $Validate, "validateState" ], [], $Lang->line("esp_error_uf"));
        $Forms->setRules("city", true, [ $Validate, "validateCity" ], ["uf" => Response::post("uf")], $Lang->line("esp_error_city"));
        $Forms->setRules("address", true, [ $Validate, "validateAddress" ], [], $Lang->line("esp_error_address"));
        $Forms->validate("cadEspetaculo");

        if ($Forms->hasErrors()){
            echo Response::getInstance()->encodeJson(
                $Lang->line("esp_error_msg"),
                array_merge($Forms->getErrors(), [ "newToken" => $Forms->initJson("cadEspetaculo") ]),
                true
            );
            return;
        }


        $Model = Model_Events::init_instance();
        $Model->create($Forms->getFields());

        echo  Response::getInstance()->encodeJson(
            $Lang->line("esp_create_sucesso"),
            ["url" => base_url("Painel/Espetaculos/View/{$Model->id}")]
        );
    }

    /**
     * Visualizar Espetáculo
     */
    public function Visualizar(){
        $eId = (int)$this->getApp()->getPatch(3);
        $Model = Model_Events::init_instance()->getId($eId);
        if (!$Model){
            Session::getInstance()->setFlash("error", Lang::getInstance()->line("espetaculo_notfound"));
            redirect("Painel/Espetaculos");
        }

        $this->view(
            "Painel/Layout/Content",
            array_merge(
                $this->vars,
                [
                    'layout' => "Painel/EspetaculosView.tpl",
                    'Forms' => Forms::getInstance(),
                    'Esp' => $Model->toArray(),
                    'Reservas' => Model_Tickets::init_instance()->getList($Model->id)
                ]
            )
        );
    }

    /**
     * Página de formulário de edição de Espetáculo
     */
    public function Editar(){
        $eId = (int)$this->getApp()->getPatch(3);
        $Model = Model_Events::init_instance()->getId($eId);
        if (!$Model){
            Session::getInstance()->setFlash("error", Lang::getInstance()->line("espetaculo_notfound"));
            redirect("Painel/Espetaculos");
        }

        $this->view(
            "Painel/Layout/Content",
            array_merge(
                $this->vars,
                [
                    'layout' => "Painel/EspetaculosEditar.tpl",
                    'Forms' => Forms::getInstance(),
                    'Esp' => $Model->toArray(),
                ]
            )
        );
    }

    /**
     * Deletar Espetaculo
     */
    public function Delete(){
        $eId = (int)$this->getApp()->getPatch(3);
        $Model = Model_Events::init_instance()->getId($eId);
        if (!$Model){
            Session::getInstance()->setFlash("error", Lang::getInstance()->line("espetaculo_notfound"));
            redirect("Painel/Espetaculos");
        }

        try {
            $Model->remove();
            Model_Tickets::init_instance()->removeAll($eId);

            Session::getInstance()->setFlash("success", Lang::getInstance()->line("esp_msg_delete"));
            redirect("Painel/Espetaculos");
        }catch (\Exception $e){
            redirect("Painel/Espetaculos");
        }
    }

    /**
     * Request Post Edit espetáculo
     */
    public function Edit(){
        Response::getInstance()->setHeaderType(ResponseType::CONTENT_JSON);

        $eId = (int)Response::post("id");
        $Lang = Lang::getInstance();
        $Forms = Forms::getInstance();

        $Model = Model_Events::init_instance()->getId($eId);
        if (!$Model){
            echo Response::getInstance()->encodeJson($Lang->line("espetaculo_notfound"),[], true);
            return;
        }

        $Validate = new \Validate\Espetaculos();
        $Forms->setRules("nome", true, [ $Validate, "validateName" ], [], $Lang->line("esp_error_name"));
        $Forms->setRules("limit", true, [ $Validate, "validateLimit" ], [], $Lang->line("esp_error_limit"));
        $Forms->setRules("init", true, [ $Validate, "validateDataInit" ], [], $Lang->line("esp_error_init"));
        $Forms->setRules("end", true, [ $Validate, "validateDataEnd" ], ["data_init" => Response::post("init")], $Lang->line("esp_error_end"));
        $Forms->setRules("uf", true, [ $Validate, "validateState" ], [], $Lang->line("esp_error_uf"));
        $Forms->setRules("city", true, [ $Validate, "validateCity" ], ["uf" => Response::post("uf")], $Lang->line("esp_error_city"));
        $Forms->setRules("address", true, [ $Validate, "validateAddress" ], [], $Lang->line("esp_error_address"));
        $Forms->validate("editarEspetaculo");

        if ($Forms->hasErrors()){
            echo Response::getInstance()->encodeJson(
                $Lang->line("esp_error_msg"),
                array_merge($Forms->getErrors(), [ "newToken" => $Forms->initJson("editarEspetaculo") ]),
                true
            );
            return;
        }

        if ($Model->ticketsActive > $Forms->getFields("limit")){
            echo Response::getInstance()->encodeJson(
                $Lang->line("error_esp_limite"),
                [ "newToken" => $Forms->initJson("editarEspetaculo") ],
                true
            );
            return;
        }

        $Model->change($Forms->getFields());

        echo  Response::getInstance()->encodeJson(
            $Lang->line("esp_edit_sucesso"),
            ["url" => base_url("Painel/Espetaculos/View/{$Model->id}")]
        );
    }

}