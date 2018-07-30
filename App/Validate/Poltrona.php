<?php
namespace Validate;

use Models\Model_Tickets;
use System\Libraries\Validate;

class Poltrona extends Validate {

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
     * Validar compo de Código da Poltrona
     * @param $value string input value
     * @param null $args
     * @return bool
     */
    public function validateCode($value, $args = null){
        $isValid = $this->validate($value, ['min' => 1, 'max' => 20], Validate::VARCHAR);
        if ($isValid){
            $hasTikect = Model_Tickets::init_instance()->getCode($args['id'], $value);
            if ($hasTikect){
                $isValid = false;
            }
        }
        return $isValid;
    }

    /**
     * Validar compo de Documento
     * @param $value string input value
     * @param null $args
     * @return bool
     */
    public function validateDoc($value, $args = null){
        $isValid = $this->validate($value, ['min' => 1], Validate::VARCHAR);
        return $isValid;
    }
}