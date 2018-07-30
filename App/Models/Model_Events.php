<?php
namespace Models;

use Models\Base\Base_Events;

class Model_Events extends Base_Events {

    protected static $_instance;

    public static function init_instance(){
        if (is_null(self::$_instance)){
            self::$_instance = new static();
        }
        return self::$_instance;
    }

    /**
     * Criar Espetaculos
     * @param $args array dados do espetaculo
     * @throws \Exception
     */
    public function create($args){
        $this->clearObject();
        $this->name = $args['nome'];
        $this->ticketsLimit = $args['limit'];
        $this->ticketsActive = 0;
        $this->ticketsCancel = 0;
        $this->start_at = date("c", dateToTime($args['init'], "DD/MM/YYYY"));
        $this->end_at = date("c", dateToTime($args['end'], "DD/MM/YYYY"));
        $this->address = $args['address'];
        $this->city = $args['city'];
        $this->state = $args['uf'];
        $this->save();
    }

    /**
     * @param $id
     * @return bool|Model_Events
     */
    public function getId($id){
        $this->clearObject();
        $Find = $this->findOneById($id);
        if ($Find instanceof Model_Events){
            return $Find;
        }
        return false;
    }

    /**
     * Alterar Espetáculo (Considerando que já tenha feito a busca pelo ID ->getId($id))
     * @param $args array dados do espetaculo
     * @throws \Exception
     */
    public function change($args){
        $this->name = $args['nome'];
        $this->ticketsLimit = $args['limit'];
        $this->start_at = date("c", dateToTime($args['init'], "DD/MM/YYYY"));
        $this->end_at = date("c", dateToTime($args['end'], "DD/MM/YYYY"));
        $this->address = $args['address'];
        $this->city = $args['city'];
        $this->state = $args['uf'];
        $this->save();
    }

    /**
     * Obter Lista de Espetáculos
     * @param null $page
     * @param null $per_page
     * @return array
     */
    public function getList($page = null, $per_page = null){
        $this->clearObject();

        $Pagination = null;
        if (!is_null($page)){
            $Pagination = [
                "per_page" => $per_page,
                "page" => $page ? $page : 1
            ];
        }
        $Data = array();
        $pager = $this->find([
            "orderby" => "DESC",
            "ordercol" => "start_at",
            "pagination" => $Pagination,
        ]);
        $Data['Pager'] = $this->getPagination();
        $Data['Results'] = $pager;
        return $Data;
    }

    /**
     * Atualizar reservas
     * @param $ative int numero de ativos
     * @param $cancel int numero de cancelados
     * @throws \Exception
     */
    public function upTickets($ative, $cancel){
        $this->ticketsActive = $ative;
        $this->ticketsCancel = $cancel;
        $this->save();
    }
}