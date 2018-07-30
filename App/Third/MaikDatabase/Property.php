<?php
/**
 * @author Maicon Gonzales<maicon@maiscontrole.net>
 */
namespace MaikDatabase;

abstract class Property {
    protected $uiyewyqueyewuqibcnsabh = array();

    public function initTableDefinitions(){

    }

    public function setupTable(){

    }

    public function __set($name,$value = null){
        $this->uiyewyqueyewuqibcnsabh[$name] = $value;
    }

    public function &__get($name){
        return $this->uiyewyqueyewuqibcnsabh[$name];
    }

    public function __isset($name){
        return isset($this->uiyewyqueyewuqibcnsabh[$name]);
    }

    public function __unset($name){
        unset($this->uiyewyqueyewuqibcnsabh[$name]);
    }
}