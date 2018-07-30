<?php
/**
 * @author Maicon Gonzales<maicon@maiscontrole.net>
 */
namespace MaikDatabase;

use MaikDatabase\Database\Database;

class Settings {
    private static $instance = null;

    private $keysConnect = 0;
    private $connection = array();
    private $activeConnect;
    private $hasKey = array();

    public function __construct(){
        if (self::$instance == null){
            self::$instance = $this;
        }
    }

    public static function getInstance(){
        if (self::$instance == null){
            self::$instance = new static();
        }

        return self::$instance;
    }

    /**
     * @param $configs object stdClass
     * @param $key string|int
     * @param $isActive boolean Definir como conexão ativa
     * @return string|int Connection Key
     */
    public function createConnection($configs, $isActive = true,  $key = null){
        $KeyReturn = null;
        if ($key) {
            $this->connection[$key] = new Database($configs);
            $this->hasKey[$key] = true;
            if ($isActive)
                $this->activeConnect = $this->connection[$key];

            return $key;
        }else {
            $this->keysConnect = time()/mt_rand(1000,2000);
            $this->connection[$this->keysConnect] = new Database($configs);
            $this->hasKey[$this->keysConnect] = true;
            if ($isActive)
                $this->activeConnect = $this->connection[$this->keysConnect];

            return $this->keysConnect;
        }
    }

    /**
     * @param $key string|int ID DA CONEXÃO
     */
    public function setActiveConnection($key){
        if (isset($this->connection[$key]))
            $this->activeConnect = $this->connection[$key];
    }

    /**
     * @return Database
     */
    public function getActiveConnection(){
        return $this->activeConnect;
    }

    /**
     * @param $key string|int
     * @return Database
     */
    public function getConnection($key){
        if (isset($this->connection[$key]))
            return $this->connection[$key];

        return null;
    }

    /**
     * @param $key string|int Connection Key
     * @return bool boolean True or False
     */
    public function hasKey($key){
        if (isset($this->hasKey[$key]))
            return true;

        return false;
    }
}