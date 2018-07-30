<?php
namespace Models;

use Models\Base\Base_Users;
use System\Libraries\Passworld;

class Model_Users extends Base_Users {

    protected static $_instance;

    public static function init_instance(){
        if (is_null(self::$_instance)){
            self::$_instance = new static();
        }
        return self::$_instance;
    }

    /**
     * Criar usuário
     * @param $username string
     * @param $passworld string
     * @param int $access
     * @throws \Exception
     */
    public function create($username, $passworld, $access = 1){
        $this->clearObject();
        $this->username = $username;
        $this->password = Passworld::getPassworld($passworld);
        $this->access = $access;
        $this->save();
    }

    /**
     * Validar nome de usuário
     * @param $username
     * @param $args
     * @return bool
     */
    public function ValidUsername($username, $args){
        $this->clearObject();

        if (is_null($username) || empty($username)){
            return false;
        }
        $FindUser = $this->findOneByUsername($username);
        if (!($FindUser instanceof  Model_Users)){
            return false;
        }
        return true;
    }

    /**
     * Validar senha do usuário
     * @param $password
     * @param $args
     * @return bool
     */
    public function ValidPassword($password, $args){
        if (is_null($password) || empty($password)){
            return false;
        }
        if (!Passworld::verifyPassworld($password,$this->password)){
            return false;
        }
        return true;
    }

    /**
     * Obter dado do usuário
     * @param $userId
     * @param bool $returnObject
     * @return array|bool
     */
    public function getUser($userId, $returnObject = true){
        $this->clearObject();
        $Find = $this->findOneById($userId);
        if ($Find instanceof Model_Users){
            if (!$returnObject)
                return $Find->toArray();
            else
                return $Find;
        }

        return false;
    }

}