<?php
namespace Validate;

use System\Libraries\Validate;

class Espetaculos extends Validate {

    /**
     * Validar compo de nome
     * @param $value string input value
     * @param null $args
     * @return bool
     */
    public function validateName($value, $args = null){
        $isValid = $this->validate($value, ['min' => 3, 'max' => 255], Validate::VARCHAR);
        return $isValid;
    }

    /**
     * Validar campo de limite de poltronas
     * @param $value string input value
     * @param null $args
     * @return bool
     */
    public function validateLimit($value, $args = null){
        $isValid = $this->validate($value, ['min' => 1], Validate::INT);
        return $isValid;
    }

    /**
     * Validar campo de data
     * @param $value string input value
     * @param null $args
     * @return mixed
     */
    public function validateDataInit($value, $args = null){
        $isValid = $this->validate($value, ['format' => "DD/MM/YYYY"], Validate::DATE);
        return $isValid;
    }

    /**
     * Validar campo de data final
     * @param $value string input value
     * @param null $args array necessidade de passar o data_init, valor do campo de data inicial
     * @return mixed
     */
    public function validateDataEnd($value, $args = null){
        $isValid = $this->validate($value, ['format' => "DD/MM/YYYY"], Validate::DATE);
        if (dateToTime($args['data_init'], "DD/MM/YYYY") > dateToTime($value, "DD/MM/YYYY")){
            return false;
        }
        return $isValid;
    }

    /**
     * Validar campo do estado
     * @param $value string input value
     * @param null $args
     * @return mixed
     */
    public function validateState($value, $args = null){
        $allStates = getStates();
        if (!isset($allStates[$value])){
            return false;
        }
        return true;
    }

    /**
     * Validar campo da cidade
     * @param $value string input value
     * @param null $args array enviar uf do campo do estado
     * @return mixed
     */
    public function validateCity($value, $args = null){
        $dataBrasil = json_decode(file_get_contents(ROOT_PATH."/public/js/brasil.json"), 1);
        if (!isset($args['uf']) || !isset($dataBrasil[$args['uf']]) || !in_array($value, $dataBrasil[$args['uf']])){
            return false;
        }
        return true;
    }

    /**
     * Validar campo de endereço
     * @param $value string input value
     * @param null $args
     * @return mixed
     */
    public function validateAddress($value, $args = null){
        $isValid = $this->validate($value, ['min' => 3, 'max' => 255], Validate::VARCHAR);
        return $isValid;
    }
}