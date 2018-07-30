<?php
namespace Models;

use Models\Base\Base_Tickets;
use System\Libraries\UUID;

class Model_Tickets extends Base_Tickets {

    const ATIVE = "Ativa";
    const CANCEL = "Cancelada";

    protected static $_instance;

    public static function init_instance(){
        if (is_null(self::$_instance)){
            self::$_instance = new static();
        }
        return self::$_instance;
    }

    /**
     * Criar Reserva
     * @param $args
     * @throws \Exception
     */
    public function create($args){
        $this->clearObject();
        $this->eventId = $args['id'];
        $this->reservedBy = $args['uId'];
        $this->reservationToken = UUID::v4();
        $this->reservationTo = $args['nome'];
        $this->reservationCpf = $args['doc'];
        $this->reservationPolt = $args['code'];
        $this->status = Model_Tickets::ATIVE;
        $this->create_at = date("c");
        $this->save();
    }

    /**
     * @param $id
     * @return bool|Model_Tickets
     */
    public function getId($id){
        $this->clearObject();
        $Find = $this->findOneById($id);
        if ($Find instanceof Model_Tickets){
            return $Find;
        }
        return false;
    }

    /**
     * Contar totais Ativa
     */
    public function countActive(){
        $Connect = $this->getConnection();
        $Count = $Connect->read( "Tickets",
            "status = :status",
            [":status" => Model_Tickets::ATIVE],
            "COUNT(id) as total"
        );
        return $Count[0]['total'];
    }

    /**
     * Contar totais Canceladas
     */
    public function countCancel(){
        $Connect = $this->getConnection();
        $Count = $Connect->read( "Tickets",
            "status = :status",
            [":status" => Model_Tickets::CANCEL],
            "COUNT(id) as total"
        );
        return $Count[0]['total'];
    }


    /**
     * Verificar Reserba
     * @param $eId int Event Id
     * @param $code string Codigo
     * @return bool
     */
    public function getCode($eId, $code){
        $Connect = $this->getConnection();
        $Count = $Connect->read( "Tickets",
            "eventId = :eid AND reservationPolt = :code AND status = :status",
            [":eid" => $eId, ":code" => $code, ":status" => Model_Tickets::ATIVE],
            "id", 1
        );
        if (count($Count) >= 1){
            return true;
        }
        return false;
    }

    /**
     * Cancelar Reserva
     * @throws \Exception
     */
    public function cancel(){
        $this->status = Model_Tickets::CANCEL;
        $this->update_at = date("c");
        $this->save();
    }

    /**
     * Obter Lista de Espetáculos
     * @param int $eId Event Id
     * @param null $page
     * @param null $per_page
     * @return array
     */
    public function getList($eId, $page = null, $per_page = null){
        $this->clearObject();

        $Builder = $this->setBuilder();
        $Builder->where("eventId", $eId);
        $Builder->order("create_at", "ASC");
        $Builder->pagination($page, $per_page);

        $Data = array();
        $pager = $this->find($Builder->getArray());
        $Data['Pager'] = $this->getPagination();
        $Data['Results'] = $pager;
        return $Data;
    }

    /**
     * Remover todas do evento
     * @param $eId int Evento ID
     */
    public function removeAll($eId){
        $Connect = $this->getConnection();
        $Connect->delete("Tickets",
            " eventId = :eid ",
            [ ":eid" => $eId ]
        );
    }
}