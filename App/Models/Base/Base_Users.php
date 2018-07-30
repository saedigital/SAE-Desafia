<?php
namespace Models\Base;

use MaikDatabase\BaseModel;

abstract class Base_Users extends BaseModel {

    public function initTableDefinitions(){
        $this->setTable("Users");

        $this->addColum("id",[
            "primary" => true,
            "auto_increment" => true,
            "default" => null
        ]);
        $this->addColum("username",[
            "primary" => false,
            "auto_increment" => false,
            "default" => null
        ]);
        $this->addColum("password",[
            "primary" => false,
            "auto_increment" => false,
            "default" => null
        ]);
        $this->addColum("access",[
            "primary" => false,
            "auto_increment" => false,
            "default" => null
        ]);


    }

    public function setupTable(){

    }

}