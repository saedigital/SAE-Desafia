<?php
namespace Models\Base;

use MaikDatabase\BaseModel;

abstract class Base_Events extends BaseModel {

    public function initTableDefinitions(){
        $this->setTable("Events");

        $this->addColum("id",[
            "primary" => true,
            "auto_increment" => true,
            "default" => null
        ]);
        $this->addColum("name",[
            "primary" => false,
            "auto_increment" => false,
            "default" => null
        ]);
        $this->addColum("ticketsLimit",[
            "primary" => false,
            "auto_increment" => false,
            "default" => null
        ]);
        $this->addColum("ticketsActive",[
            "primary" => false,
            "auto_increment" => false,
            "default" => null
        ]);
        $this->addColum("ticketsCancel",[
            "primary" => false,
            "auto_increment" => false,
            "default" => null
        ]);
        $this->addColum("start_at",[
            "primary" => false,
            "auto_increment" => false,
            "default" => null
        ]);
        $this->addColum("end_at",[
            "primary" => false,
            "auto_increment" => false,
            "default" => null
        ]);
        $this->addColum("address",[
            "primary" => false,
            "auto_increment" => false,
            "default" => null
        ]);
        $this->addColum("city",[
            "primary" => false,
            "auto_increment" => false,
            "default" => null
        ]);
        $this->addColum("state",[
            "primary" => false,
            "auto_increment" => false,
            "default" => null
        ]);


    }

    public function setupTable(){

    }

}