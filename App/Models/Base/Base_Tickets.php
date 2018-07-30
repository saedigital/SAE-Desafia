<?php
namespace Models\Base;

use MaikDatabase\BaseModel;

abstract class Base_Tickets extends BaseModel {

    public function initTableDefinitions(){
        $this->setTable("Tickets");

        $this->addColum("id",[
            "primary" => true,
            "auto_increment" => true,
            "default" => null
        ]);
        $this->addColum("eventId",[
            "primary" => false,
            "auto_increment" => false,
            "default" => null
        ]);
        $this->addColum("reservedBy",[
            "primary" => false,
            "auto_increment" => false,
            "default" => null
        ]);
        $this->addColum("reservationToken",[
            "primary" => false,
            "auto_increment" => false,
            "default" => null
        ]);
        $this->addColum("reservationTo",[
            "primary" => false,
            "auto_increment" => false,
            "default" => null
        ]);
        $this->addColum("reservationCpf",[
            "primary" => false,
            "auto_increment" => false,
            "default" => null
        ]);
        $this->addColum("reservationPolt",[
            "primary" => false,
            "auto_increment" => false,
            "default" => null
        ]);
        $this->addColum("status",[
            "primary" => false,
            "auto_increment" => false,
            "default" => null
        ]);
        $this->addColum("create_at",[
            "primary" => false,
            "auto_increment" => false,
            "default" => null
        ]);
        $this->addColum("update_at",[
            "primary" => false,
            "auto_increment" => false,
            "default" => null
        ]);


    }

    public function setupTable(){

    }

}