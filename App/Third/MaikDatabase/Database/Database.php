<?php
/**
 * @author Maicon Gonzales<maicon@maiscontrole.net>
 */
namespace MaikDatabase\Database;

use MaikDatabase\Generate;

class Database {
    public $config;
    public $db;

    function __construct($config) {
        $this->init($config);
    }

    public function init($config){
        $this->config = $config;

        $dbhost = $config->hostname;
        $dbuser = $config->username;
        $dbpass = $config->password;
        $dbname = $config->database;

        $options = array(
            \PDO::ATTR_PERSISTENT => true,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        );

        try {
            $conn = "mysql:host={$dbhost};dbname={$dbname};charset=utf8";
            $this->db = new \PDO($conn, $dbuser, $dbpass, $options);
        } catch(\PDOException $e) {
            echo $e->getMessage(); exit(1);
        }

        if ($this->config->generate){
            $this->generateModels();
        }
    }

    function count($sql){
        return $this->db->query($sql)->fetchColumn();
    }

    function run($sql, $bind=array()) {
        $sql = trim($sql);

        try {
            $result = $this->db->prepare($sql);
            $result->execute($bind);
            return $result;
        } catch (\PDOException $e) {
            echo $e->getMessage(); exit(1);
        }
    }

    function create($table, $data) {
        $fields = $this->filter($table, $data);
        $sql = "INSERT INTO " . $table . " (" . implode($fields, ", ") . ") VALUES (:" . implode($fields, ", :") . ");";
        $bind = array();
        foreach($fields as $field)
            $bind[":$field"] = $data[$field];

        $result = $this->run($sql, $bind);

        return $this->db->lastInsertId();
    }

    function read($table, $where="", $bind=array(), $fields="*", $limit = null) {
        $sql = "SELECT " . $fields . " FROM " . $table;
        if(!empty($where))
            $sql .= " WHERE " . $where;

        if (!is_null($limit)){
            $sql .= " LIMIT {$limit} ";
        }

        $sql .= ";";

        $result = $this->run($sql, $bind);
        $result->setFetchMode(\PDO::FETCH_ASSOC);
        $rows = array();
        while($row = $result->fetch()) {
            $rows[] = $row;
        }
        return $rows;
    }

    function update($table, $data, $where, $bind = array()) {
        $fields = $this->filter($table, $data);
        $fieldSize = sizeof($fields);
        $sql = "UPDATE " . $table . " SET ";
        for($f = 0; $f < $fieldSize; ++$f) {
            if($f > 0)
                $sql .= ", ";
            $sql .= $fields[$f] . " = :update_" . $fields[$f];
        }
        $sql .= " WHERE " . $where . ";";

        foreach($fields as $field)
            $bind[":update_$field"] = $data[$field];


        $result = $this->run($sql, $bind);
        return $result->rowCount();
    }

    function delete($table, $where, $bind="") {
        $sql = "DELETE FROM " . $table . " WHERE " . $where . ";";
        $result = $this->run($sql, $bind);
        return $result->rowCount();
    }

    function getTables(){
        $sql = "SHOW TABLES";
        $result = $this->run($sql);
        $result->setFetchMode(\PDO::FETCH_NUM);


        $rows = array();
        $row = $result->fetchAll();
        foreach($row as $item){
            $rows[] = $item[0];
        }
        return $rows;
    }

    function getColuns($table){
        $sql = "SHOW COLUMNS FROM {$table}";
        $result = $this->run($sql);
        $result->setFetchMode(\PDO::FETCH_ASSOC);


        $rows = array();
        $row = $result->fetchAll();
        foreach($row as $item){
            $rows[] = $item;
        }
        return $rows;

    }

    private function filter($table, $data) {
        $sql = "DESCRIBE " . $table . ";";
        $key = "Field";
        if(false !== ($list = $this->run($sql))) {
            $fields = array();
            foreach($list as $record)
                $fields[] = $record[$key];
            return array_values(array_intersect($fields, array_keys($data)));
        }
        return array();
    }

    function generateModels(){
        $Generate = new Generate();
        $Tables = $this->getTables();
        foreach ($Tables as $table){
            $Generate->init();
            $Generate->setName($table,$table);

            $Colunas = $this->getColuns($table);
            foreach ($Colunas as $coluna){
                $Array = array(
                    $coluna['Field'],
                    $coluna['Key'] == "PRI" ? "true" : "false",
                    $coluna['Extra'] == "auto_increment" ? "true" : "false",
                    empty($coluna['Default']) ? "null" : '"'.addslashes($coluna['Default']).'"'
                );
                $Generate->setColun($Array);
            }
            $Generate->generate($this->config->generate_dir, $this->config->generate_base);
        }
    }

}