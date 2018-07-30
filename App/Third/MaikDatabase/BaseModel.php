<?php
/**
 * @author Maicon Gonzales<maicon@maiscontrole.net>
 */
namespace MaikDatabase;

use MaikDatabase\Database\Database;
use MaikDatabase\Database\SetsBuilder;

class BaseModel extends Property {

    const HASMANY = "many";
    const HASONE = "one";

    public $___table_name;
    public $___alias;
    public $___aliasTemp;

    public $___Coluns = [];
    public $___hasJoin = [];

    public $___primary;

    public $___aliasConsult = array();
    public $___aliasColun = array();

    public $___isAlone = false;

    /**
     * @var Database
     */
    public $___Connection;

    protected $___SqlQuery;
    protected $___Pagination;

    public function __construct(){
        $this->initTableDefinitions();
        $this->setupTable();
        $this->setConnection();
    }


    public function setConnection($key = null){
        if (Settings::getInstance()->hasKey($key)) {
            $this->___Connection = Settings::getInstance()->getConnection($key);
        }else {
            $this->___Connection = Settings::getInstance()->getActiveConnection();
        }
    }

    public function getConnection(){
        return $this->___Connection;
    }

    public function setTable($table){
        $this->___table_name = $table;
        $this->___alias = $this->alias();
    }

    public function addColum($key, $array){
        $this->___Coluns[$key] = $array;
        if ($array["primary"]){
            $this->___primary = $key;
        }
    }

    public function hasJoin($Model, $array){
        $this->___hasJoin[$Model] = $array;
    }

    public function addOnJoin($Model, $key, $array){
        $this->___hasJoin[$Model][$key] = $array;
    }

    public function getTableSelect(){
        return $this->___table_name." ".$this->___alias;
    }

    public function getColunAlias($col){
        return $this->___alias.".".$col;
    }

    public function getColunAliasTemp($col){
        return $this->___aliasTemp.".".$col;
    }

    public function getWhere($col){
        return $this->getColunAlias($col)." = :{$col}";
    }

    public function getWhereNoAlias($col){
        return "{$col} = :{$col}";
    }

    public function getFields($name, $concat = false){
        $this->___aliasTemp = $name;
        $Field = array();
        foreach ($this->___Coluns as $colun=>$other){
            $this->___aliasColun["{$name}__{$colun}"] = $colun;
            $this->___aliasConsult[$this->getColunAlias($colun)] = "{$name}__{$colun}";
            if ($concat){
                $Field[] = "GROUP_CONCAT(". $this->getColunAlias($colun) ." SEPARATOR '{_;_}')" . " AS {$name}__{$colun}";
            }else {
                $Field[] = $this->getColunAlias($colun) . " AS {$name}__{$colun}";
            }
        }
        return $Field;
    }

    public function addFields($colun){
        $this->___aliasColun["{$this->___aliasTemp}__{$colun}"] = $colun;
        $this->___aliasConsult[$this->getColunAlias($colun)] = "{$this->___aliasTemp}__{$colun}";
    }

    public function getField($colun){
        return $this->___aliasConsult[$this->getColunAlias($colun)];
    }

    public function getFieldColunm($colun){
        return $this->___aliasColun["{$this->___aliasTemp}__{$colun}"];
    }

    public function getSqlQuery(){
        return $this->___SqlQuery;
    }

    public function getPagination(){
        return $this->___Pagination;
    }

    /**
     * @return SetsBuilder SetsBuilder class
     */
    public function setBuilder(){
        return new SetsBuilder();
    }

    /**
     * CONSULTAS
     */

    public function save(){
        $Keys = $this->uiyewyqueyewuqibcnsabh;

        $AutoIncrement = $this->___primary;
        foreach ($this->___Coluns as $colum=>$property) {
            if (!isset($Keys[$colum])){
                $Keys[$colum] = $property['default'];
                $this->$colum = $property['default'];
            }
        }

        $Bind = array();
        foreach ($Keys as $key=>$value){
            if (!isset($this->___Coluns[$key])){
                throw new \Exception("Coluna {$key} não encontrada em {$this->___table_name}");
            }
            $Bind[$key] = $value;
        }
        if ($this->___isAlone){
            $this->___Connection->update($this->___table_name, $Bind, $this->getWhereNoAlias($AutoIncrement), array(':'.$AutoIncrement => $this->$AutoIncrement));
        }else{
            $this->$AutoIncrement = $this->___Connection->create($this->___table_name, $Bind);
            $this->___isAlone = true;
        }

    }

    public function updateTable($where,$array){
        $this->___Connection->update($this->___table_name, $array, $where, array(':'.$this->___primary => $this->___primary));
    }

    public function find($other = null){
        $this->___isAlone = false;

        $BindValues = array();
        $this->___aliasConsult = array();
        $Fields = $this->getFields($this->alias());

        $Joins = array();
        $left_joins = isset($other["leftjoin"]) ? $other["leftjoin"] : array();
        $AliasJoin = array();
        $AliasGet = array();
        foreach($left_joins as $join){
            $GetJoin = $this->createJoin($join);
            if (is_array($GetJoin)){
                $Fields = array_merge($Fields,$GetJoin['fields']);
                $Joins[] = $GetJoin['sql'];
                $AliasJoin[$join] = $GetJoin['alias'];
                if (!empty($GetJoin['alias_get']))
                    $AliasGet[$join] = $GetJoin['alias_get'];
            }
        }

        $OrderKey = isset($other["orderby"]) ? " ".$other["orderby"] : " ASC";

        $OrderColun = isset($other["ordercol"]) ? $this->___aliasConsult[$this->getColunAlias($other["ordercol"])] : $this->___aliasConsult[$this->getColunAlias($this->___primary)];
        $GroupColun = isset($other["groupcol"]) ? $this->___aliasConsult[$this->getColunAlias($other["groupcol"])] : $this->___aliasConsult[$this->getColunAlias($this->___primary)];

        $otherWhere = isset($other["where"]) ?  $other["where"] : null;

        $OrderBy = " ORDER BY ".$OrderColun.$OrderKey ;

        if (count($left_joins ) == 0){
            $GroupBy = "";
        }else {
            $GroupBy = " GROUP BY " . $GroupColun;
        }

        $Limit = isset($other["limit"]) ? "LIMIT {$other["limit"]}" : "";

        $Where = "";
        if (is_array($otherWhere)){
            $Values = array();
            foreach ($otherWhere['coluns'] as $key=>$colun){
                if (isset($colun['Model'])){
                    if (isset($AliasGet[$colun['Model']]))
                        $Values[] = $AliasGet[$colun['Model']].".".$colun['colun'];
                }else{
                    $Values[] = $this->getColunAlias($colun['colun']);
                }
            }
            $Query = str_replace(array_keys($otherWhere['coluns']), $Values,$otherWhere['query']);
            $Where .= " WHERE ".$Query;

            $BindValues = array_merge($BindValues, $otherWhere['bind']);
        }



        if (isset($other['pagination']) && is_array($other['pagination'])){
            $PerPage = isset($other['pagination']['per_page']) ? $other['pagination']['per_page'] : 10;
            $Page = isset($other['pagination']['page'])? $other['pagination']['page'] : 1;

            $this->addFields("totalrows");
            $CountSql = "SELECT COUNT(*) FROM " . $this->getTableSelect() . implode(' ', $Joins) . $Where;
            $Total = $this->___Connection->count($CountSql);
            $n = $Page+1;
            $p = $Page-1;
            $TotalPage =  ceil($Total/$PerPage);

            $this->___Pagination['total'] = $Total;
            $this->___Pagination['page'] = $Page;
            $this->___Pagination['total_page'] = $TotalPage;
            $this->___Pagination['next_page'] = $n > $TotalPage ? null : $n;
            $this->___Pagination['preview_page'] = $p < 1 ? null : $p;

            $offset = ($Page - 1)  * $PerPage;
            $start = $offset;
            $end = min(($offset + $PerPage), $Total);
            $Limit = "LIMIT ".$start.",".$end;

            $Start = $this->___Pagination["page"] - 5;
            $End = $this->___Pagination["page"] + 5;
            if ($Start <= 0){
                $Start = 1;
                $End += 5 - $this->___Pagination["page"];
            }
            if ($End > $this->___Pagination["total_page"]){
                $End = $this->___Pagination["total_page"];
            }
            $this->___Pagination['start_on'] = $Start;
            $this->___Pagination['end_on'] = $End;
        }

        $this->___SqlQuery = "SELECT " . implode(', ',$Fields) . " FROM " . $this->getTableSelect() . implode(' ', $Joins) . $Where. $GroupBy . $OrderBy ." ".$Limit;
        $result = $this->___Connection->run($this->___SqlQuery, $BindValues);
        $result->setFetchMode(\PDO::FETCH_ASSOC);
        $rows = array();
        while($row = $result->fetch()) {
            $Data = array();
            foreach ($row as $key=>$value){
                if (isset($this->___aliasColun[$key])){
                    $Data[$this->___aliasColun[$key]] = $value;
                }
                foreach($left_joins as $join){
                    if (isset($AliasJoin[$join][$key])){
                        $Data[$join][$AliasJoin[$join][$key]] = $value;
                        break;
                    }
                }
            }
            foreach($left_joins as $join){
                $Property = $this->___hasJoin[$join];
                if ($Property["type"] == self::HASMANY){
                    $Model = $Property["class"];
                    $Class = new $Model();
                    $Find = "findBy".$Property['foreign'];
                    $others = isset($Property["other"]) ? $Property["other"] : null;
                    $Data[$join] = $Class->$Find($Data[$Property['local']],$others);
                }
            }
            $rows[] = $Data;
        }
        return $rows;
    }

    private function findBy($colun, $value, $other = null){
        $this->___isAlone = false;

        $original = $colun;
        if (!isset($this->___Coluns[$colun])){
            $colun = lcfirst($colun);
            if (!isset($this->___Coluns[$colun])){
                throw new \Exception("Coluna ".$original." não existe.");
            }
        }

        if ($other == null) {
            $Results = $this->___Connection->read($this->getTableSelect(), $this->getWhere($colun), array(":{$colun}" => $value), "{$this->___alias}.*");
            return $Results;
        }else{
            $BindValues = array(":{$colun}" => $value);

            $this->___aliasConsult = array();
            $Fields = $this->getFields($this->alias());
            $Joins = array();
            $left_joins = isset($other["leftjoin"]) ? $other["leftjoin"] : array();
            $AliasJoin = array();
            $AliasGet = array();


            foreach($left_joins as $join){
                $GetJoin = $this->createJoin($join);
                if (is_array($GetJoin)){
                    $Fields = array_merge($Fields,$GetJoin['fields']);
                    $Joins[] = $GetJoin['sql'];
                    $AliasJoin[$join] = $GetJoin['alias'];
                    if (!empty($GetJoin['alias_get']))
                        $AliasGet[$join] = $GetJoin['alias_get'];
                }
            }

            $OrderKey = isset($other["orderby"]) ? " ".$other["orderby"] : " ASC";
            $OrderColun = isset($other["ordercol"]) ? $this->___aliasConsult[$this->getColunAlias($other["ordercol"])] : $this->___aliasConsult[$this->getColunAlias($this->___primary)];
            $GroupColun = isset($other["groupcol"]) ? $this->___aliasConsult[$this->getColunAlias($other["groupcol"])] : $this->___aliasConsult[$this->getColunAlias($this->___primary)];

            $otherWhere = isset($other["where"]) ?  $other["where"] : null;

            $OrderBy = " ORDER BY ".$OrderColun.$OrderKey ;
            $GroupBy = " GROUP BY ".$GroupColun;
            $Limit = isset($other["limit"]) ? $this->___aliasConsult[$other["limit"]] : "";

            $Where = " WHERE ".$this->getWhere($colun)." ";
            if (is_array($otherWhere)){
                $Values = array();
                foreach ($otherWhere['coluns'] as $key=>$colun){
                    if (isset($colun['Model'])){
                        if (isset($AliasGet[$colun['Model']]))
                            $Values[] = $AliasGet[$colun['Model']].".".$colun['colun'];
                    }else{
                        $Values[] = $this->getColunAlias($colun['colun']);
                    }
                }
                $Query = str_replace(array_keys($otherWhere['coluns']), $Values,$otherWhere['query']);
                $Where .= "AND ".$Query;

                $BindValues = array_merge($BindValues, $otherWhere['bind']);
            }

            $this->___SqlQuery = "SELECT " . implode(', ',$Fields) . " FROM " . $this->getTableSelect() . implode(' ', $Joins) . $Where. $GroupBy . $OrderBy ." ".$Limit;

            $result = $this->___Connection->run($this->___SqlQuery, $BindValues);
            $result->setFetchMode(\PDO::FETCH_ASSOC);
            $rows = array();

            while($row = $result->fetch()) {
                $Data = array();
                foreach ($row as $key=>$value){
                    if (isset($this->___aliasColun[$key])){
                        $Data[$this->___aliasColun[$key]] = $value;
                    }
                    foreach($left_joins as $join){
                        if (isset($AliasJoin[$join][$key])){
                            $Data[$join][$AliasJoin[$join][$key]] = $value;
                            break;
                        }
                    }
                }
                foreach($left_joins as $join){
                    $Property = $this->___hasJoin[$join];
                    if ($Property["type"] == self::HASMANY){
                        $Model = $Property["class"];
                        $Class = new $Model();
                        $Find = "findBy".$Property['foreign'];
                        $Data[$join] = $Class->$Find($Data[$Property['local']]);
                    }
                }
                $rows[] = $Data;
            }
            return $rows;
        }
    }


    private function findOneBy($colun, $value, $other = null){
        $Results = $this->getOne($colun, $value);
        if ($Results != null){
            foreach ($Results as $key=>$value){
                $this->$key = $value;
            }
            $this->___isAlone = true;
            return $this;
        }
        return null;
    }

    /**
     * Obeter Dados Relativos
     * @param $join
     */
    public function get($join){
        $Property = $this->___hasJoin[$join];
        if ($Property["type"] == self::HASMANY){
            $Model = $Property["class"];
            $Class = new $Model();
            $Find = "findBy".$Property['foreign'];

            $value = $Property['local'];
            $this->$join = $Class->$Find($this->$value);
        }elseif ($Property["type"] == self::HASONE){
            $Model = $Property["class"];
            $Class = new $Model();

            $value = $Property['local'];
            $this->$join = $Class->getOne($Property['foreign'], $this->$value);
        }
    }

    /**
     * Obter unico valor
     * @param $colun
     * @param $value
     * @return null
     * @throws \Exception
     */
    public function getOne($colun, $value){
        $original = $colun;
        if (!isset($this->___Coluns[$colun])){
            $colun = lcfirst($colun);
            if (!isset($this->___Coluns[$colun])){
                throw new \Exception("Coluna ".$original." não existe.");
            }
        }
        $Results = $this->___Connection->read($this->getTableSelect(), $this->getWhere($colun), array(":{$colun}" => $value), "{$this->___alias}.*", "1");
        if (isset($Results[0])){
            return $Results[0];
        }
        return null;
    }

    /**
     * Remover Dado
     * @param null $id
     */
    public function remove($id = null){
        $AutoIncrement = $this->___primary;
        if ($this->___isAlone){
            $this->___Connection->delete($this->___table_name, $this->getWhereNoAlias($AutoIncrement), array(":{$AutoIncrement}" => $this->$AutoIncrement));

            $this->___isAlone = false;
            foreach ($this->___Coluns as $colum=>$property) {
                $this->$colum = null;
            }

        }else{
            if ($id != null){
                $this->___Connection->delete($this->___table_name, $this->getWhereNoAlias($AutoIncrement), array(":{$AutoIncrement}" => $id));
            }
        }
    }

    /**
     * @param String $Join
     * @return array
     */
    private function createJoin($Join){
        if (isset($this->___hasJoin[$Join])) {
            $Property = $this->___hasJoin[$Join];
            $Model = $Property["class"];

            /**
             * @var $Class BaseModel
             */
            $Class = new $Model();
            if ($Property["type"] == self::HASONE){
                $LeftJoin = " LEFT JOIN {$Class->getTableSelect()} ON {$Class->getColunAlias($Property['foreign'])} = {$this->getColunAlias($Property['local'])} ";
                $Field = $Class->getFields($this->alias());
                return array("sql" => $LeftJoin, "fields" => $Field, "alias" => $Class->___aliasColun, "alias_get" => $Class->___alias);
            }else if ($Property["type"] == self::HASMANY){
                return array("sql" => "", "fields" => array(), "alias" => "", "alias_get" => "");
            }


        }

        return null;
    }

    public function alias() {
        $lmin = 'bcdfghjklmnpqrstvwxyz';
        $retorno = '';
        $caracteres = $lmin;

        $len = strlen($caracteres);
        for ($n = 1; $n <= 3; $n++) {
            $rand = mt_rand(1, $len);
            $retorno .= $caracteres[$rand-1];
        }
        return $retorno;
    }

    public function __call($_Name, $arguments){
        $by = null;
        $count = count($arguments);
        if (substr($_Name, 0, 6) == 'findBy') {
            $by = substr($_Name, 6, strlen($_Name));
            $method = 'findBy';
            if ($count > 2) {
                throw new \Exception("Set a valid argument to the method 'findBy'.");
            }
        } else if (substr($_Name, 0, 9) == 'findOneBy') {
            $by = substr($_Name, 9, strlen($_Name));
            $method = 'findOneBy';
            if ($count > 2) {
                throw new \Exception("Set a valid argument to the method 'findOneBy'.");
            }
        }

        if (!isset($method) || !method_exists($this,$method)) {
            throw new \Exception("The method ".$_Name." not exist.");
        }

        switch ($method) {
            case "findBy":
                return $this->$method($by,$arguments[0], isset($arguments[1]) ? $arguments[1] : null);
                break;
            case "findOneBy":
                return $this->$method($by,$arguments[0], isset($arguments[1]) ? $arguments[1] : null);
                break;
        }

    }

    public function toArray(){
        return $this->uiyewyqueyewuqibcnsabh;
    }

    public function clearObject(){
        $this->uiyewyqueyewuqibcnsabh = array();
        $this->___isAlone = false;
    }

}