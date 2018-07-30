<?php
namespace System\Libraries;

class Validate {
    static $Type = array('varchar','int','onlyAlpha','onlyAlphanumeric','date','email','money','url','float');
    private $varchar;
    private $format = "DD/MM/YYYY";

    const VARCHAR = "varchar";
    const INT = "int";
    const FLOAT = "float";
    const ONLYALPHA = "onlyAlpha";
    const ONLYALPHANUMERIC = "onlyAlphanumeric";
    const DATE = "date";
    const EMAIL = "email";
    const URL = "url";
    const MONEY = "money";

    public function validate($Sting, $args = array(), $Tipo = 'varchar', $function = ""){
        if (!in_array($Tipo,Validate::$Type)){
            $Tipo = "varchar";
        }

        $hasFunction = false;
        if (!empty($function)) {
            try {
                $this->varchar = $function($Sting, $args);
                $hasFunction = true;
            } catch (\Exception $e) {
                $hasFunction = false;
            }
        }

        $Method = "_".$Tipo;
        if (method_exists($this,$Method) && !$hasFunction){
            $this->varchar = $this->$Method($Sting, $args);
        }
        return $this->varchar;
    }

    private function _varchar($str, $args){
        if (isset($args['min']) && is_numeric($args['min'])){
            if (!isset($str{$args['min']-1})){
                return false;
            }
        }
        if (isset($args['max']) && is_numeric($args['max'])){
            if (isset($str{$args['max']})){
                return false;
            }
        }
        return $str;
    }

    private function _int($str, $args){
        if (isset($args['min']) && is_numeric($args['min'])){
            if ($str < $args['min']){
                return false;
            }
        }
        if (isset($args['max']) && is_numeric($args['max'])){
            if ($str > $args['max']){
                return false;
            }
        }
        if (empty($str) || filter_var($str,FILTER_VALIDATE_INT)){
            return $str;
        }
        return false;
    }

    private function _float($str, $args){
        $value = str_replace(",","",$str);
        if (isset($args['min']) && is_numeric($args['min'])){
            if ($str < $args['min']){
                return false;
            }
        }
        if (isset($args['max']) && is_numeric($args['max'])){
            if ($str > $args['max']){
                return false;
            }
        }
        if (filter_var($str, FILTER_VALIDATE_FLOAT) || filter_var($str, FILTER_VALIDATE_INT)){
            return $value;
        }
        return false;
    }

    private function _onlyAlpha($str, $args){
        if (isset($args['min']) && is_numeric($args['min'])){
            if (!isset($str{$args['min']-1})){
                return false;
            }
        }
        if (isset($args['max']) && is_numeric($args['max'])){
            if (isset($str{$args['max']})){
                return false;
            }
        }
        if (ctype_alpha($str)) {
            return $str;
        }
        return false;
    }

    private function _onlyAlphanumeric($str, $args){
        if (isset($args['min']) && is_numeric($args['min'])){
            if (!isset($str{$args['min']-1})){
                return false;
            }
        }
        if (isset($args['max']) && is_numeric($args['max'])){
            if (isset($str{$args['max']})){
                return false;
            }
        }
        if (ctype_alnum($str)) {
            return $str;
        }
        return false;
    }

    private function _date($date, $args){
        if (isset($args['format'])){
            $this->format = $args['format'];
        }

        switch($this->format){
            case 'YYYY/MM/DD':
            case 'YYYY-MM-DD':
                list( $y, $m, $d ) = preg_split( '/[-\.\/ ]/', $date );
                break;
            case 'YYYY/DD/MM':
            case 'YYYY-DD-MM':
                list( $y, $d, $m ) = preg_split( '/[-\.\/ ]/', $date );
                break;
            case 'DD-MM-YYYY':
            case 'DD/MM/YYYY':
                list( $d, $m, $y ) = preg_split( '/[-\.\/ ]/', $date );
                break;

            case 'MM-DD-YYYY':
            case 'MM/DD/YYYY':
                list( $m, $d, $y ) = preg_split( '/[-\.\/ ]/', $date );
                break;

            case 'YYYYMMDD':
                $y = substr( $date, 0, 4 );
                $m = substr( $date, 4, 2 );
                $d = substr( $date, 6, 2 );
                break;

            case 'YYYYDDMM':
                $y = substr( $date, 0, 4 );
                $d = substr( $date, 4, 2 );
                $m = substr( $date, 6, 2 );
                break;

            default:
                return false;
        }
        if (checkdate($m,$d,$y)){
            return $date;
        }
        return false;
    }

    private function _email($value, $args) {
        if (filter_var($value, FILTER_VALIDATE_EMAIL)){
            return $value;
        }
        return false;
    }

    private function _url($value, $args) {
        if (filter_var($value, FILTER_VALIDATE_URL)){
            return $value;
        }
        return false;
    }

    private function _money($value, $args){
        preg_match("/\b\d{1,3}(?:,?\d{3})*(?:\.\d{2})?\b/", $value, $From);
        if (isset($From[0])){
            return $From[0];
        }
        return false;
    }

}