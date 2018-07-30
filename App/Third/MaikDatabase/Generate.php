<?php
/**
 * @author Maicon Gonzales<maicon@maiscontrole.net>
 */
namespace MaikDatabase;

class Generate {

    public $base;
    public $model;
    public $colun;

    public $baseInit;
    public $modelInit;
    public $colunInit;

    public $ModelName = "Model_";
    public $BaseName = "Base_";

    public $Name = "";

    public function __construct(){
        $this->base = file_get_contents(__DIR__."/BaseGen/ModelBase.txt");
        $this->model = file_get_contents(__DIR__."/BaseGen/Model.txt");
        $this->colun = file_get_contents(__DIR__."/BaseGen/Colun.txt");
    }

    public function init(){
        $this->baseInit = $this->base;
        $this->modelInit = $this->model;
        $this->colunInit = "";
    }

    public function setName($name, $database){
        $Name = ucfirst($name);
        $this->baseInit = str_replace("%NAMECLASS%", $Name, $this->baseInit);
        $this->baseInit = str_replace("%NAMEDB%", $database, $this->baseInit);
        $this->modelInit = str_replace("%NAMECLASS%", $Name, $this->modelInit);

        $this->Name = $Name;
    }

    public function setColun($array){
        $Coluna = $this->colun;
        $Replace = array("%COLUN%","%PRIMARY%", "%AUTO%", "%DEFAULT%");
        $Coluna = str_replace($Replace,$array,$Coluna);
        $this->colunInit .= $Coluna;
    }

    public function generate($dir, $onlyBase = false){
        $this->baseInit = str_replace("%COLLUNSSET%", $this->colunInit, $this->baseInit);

        if (!is_dir($dir)){
            mkdir($dir, 0755, true);
        }
        if (!is_dir($dir."/Base")){
            mkdir($dir."/Base", 0755, true);
        }

        $FileBase = $dir."/Base/".$this->BaseName.$this->Name.".php";
        $FileModel = $dir."/Model_".$this->Name.".php";

        file_put_contents($FileBase, $this->baseInit);

        if (!$onlyBase) {
            file_put_contents($FileModel, $this->modelInit);
        }
    }
}