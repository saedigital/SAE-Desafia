<?php
/**
 * Created by PhpStorm.
 * User: moyses-oliveira
 * Date: 26/06/19
 * Time: 22:16
 */

namespace App\Model;

use App\Lib\DB;
use ReflectionClass;
use ReflectionProperty;

abstract class AbstractModel
{
    protected $_primaryKey = 'id';

    protected $_table = '';


    public function getColumns() {
        $reflection = new ReflectionClass(get_class($this));
        $properties= $reflection->getProperties(ReflectionProperty::IS_PUBLIC);
        $keys = array_map(function($row) { return $row->name; }, $properties);
        return $keys;
    }

    public function fill($params) {
        $keys = $this->getColumns();
        foreach ($params as $key=>$value)
            if(in_array($key, $keys))
                $this->{"set" . ucfirst($key)}($value);


        return $this;
    }

    public function save() {
        $pk = $this->_primaryKey;
        if($this->{$pk})
            return $this->update();

        return $this->insert();
    }

    public function update() {
        $keys = $this->getColumns();
        $columns = $params = [];
        $pk = $this->_primaryKey;
        if(!$this->getKey())
            throw new \Exception('Primary key is empty.');

        foreach($keys as $k):
            if($k === $pk)
                continue;

            $value = $this->{$k};
            if(!$value)
                continue;


            $columns[] = "`$k`=:$k";
            $params[':'.$k] = $value;
        endforeach;
        $query = sprintf('UPDATE `%s` SET %s WHERE %s',$this->_table, implode(',',$columns), "`$pk`= :$pk");
        DB::record($query, $params);

        return $this->find($this->{$pk});
    }

    public function insert() {
        $keys = $this->getColumns();
        $columns = $params = [];
        $pk = $this->_primaryKey;

        foreach($keys as $k):
            if($k === $pk)
                continue;

            $value = $this->{$k};
            if(is_null($value))
                continue;


            $columns[] = $k;
            $params[':'.$k] = $value;
        endforeach;
        $references = array_map(function ($row){ return ":$row"; }, $columns);
        $props = [
            $this->_table,
            implode('`,`', $columns),
            implode(',', $references)
        ];
        $query = vsprintf('INSERT INTO `%s` (`%s`) VALUES (%s);', $props);
        DB::record($query, $params);

        return $this->find(DB::getLastInsertID());
    }

    public function find($id) {
        $pk = $this->_primaryKey;
        $data = DB::fetch("SELECT * FROM {$this->_table} WHERE `$pk`=$id");
        $this->fill($data);
        return $this;
    }

    public function getKey() {
        return $this->{$this->_primaryKey};
    }

}