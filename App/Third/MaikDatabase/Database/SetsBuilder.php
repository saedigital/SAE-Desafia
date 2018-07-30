<?php
/**
 * @author Maicon Gonzales<maicon@maiscontrole.net>
 */
namespace MaikDatabase\Database;

class SetsBuilder {

    public $Query = array();

    /**
     * @param $col string coluna
     * @param $val string valor
     * @param string $operador string Operado = != etc
     * @param string $coma string AND OR etc
     * @return $this
     */
    public function where($col, $val, $operador = "=", $coma = "AND"){
        if (!isset($this->Query['where'])){
            $this->Query['where'] = array();
        }

        $colun = "%{$col}%";
        if (isset($this->Query['where']['query'])){
            $this->Query['where']['query'] .= " {$coma} {$colun} {$operador} :val_{$col}";
        }else{
            $this->Query['where']['query'] = "{$colun} {$operador} :val_{$col}";
        }

        $this->Query['where']['coluns'][$colun]["colun"] = $col;
        $this->Query['where']['bind'][":val_{$col}"] = $val;

        return $this;
    }

    /**
     * @param $col string coluna
     * @param $val string valor
     * @param string $operador stirng operador = != etc
     * @return $this
     */
    public function andWhere($col, $val, $operador = "="){
        $this->where($col, $val, $operador, "AND");
        return $this;
    }

    /**
     * @param $col string coluna
     * @param $val string valor
     * @param string $operador string operador = != etc
     * @return $this
     */
    public function orWhere($col, $val, $operador = "="){
        $this->where($col, $val, $operador, "OR");
        return $this;
    }


    /**
     * @param $col string nome da coluna
     * @param string $by ASC DESC
     * @return $this
     */
    public function order($col,$by = "ASC"){
        $this->Query['orderby'] = $by;
        $this->Query['ordercol'] = $col;
        return $this;
    }

    /**
     * @param $join string HasMany Ou HasOne configurado no Model
     * @return $this
     */
    public function leftJoin($join){
        $this->Query['leftjoin'][] = $join;
        return $this;
    }

    /**
     * @param $start int Inicio
     * @param null $end int Fim
     * @return $this
     */
    public function limit($start,$end = null){
        $this->Query['limit'] = $start;
        if (!is_null($end)){
            $this->Query['limit'] .= ",".$end;
        }
        return $this;
    }

    /**
     * @param $page int Pagína Atual
     * @param $per_page int Linhas por Páginha
     * @return $this
     */
    public function pagination($page, $per_page){
        $Pagination = null;
        if (!is_null($page)){
            $Pagination = [
                "per_page" => $per_page,
                "page" => $page ? $page : 1
            ];
        }
        if (!is_null($Pagination)){
            $this->Query['pagination'] = $Pagination;
        }
        return $this;
    }

    /**
     * @return array Configs to find
     */
    public function getArray(){
        return $this->Query;
    }
}