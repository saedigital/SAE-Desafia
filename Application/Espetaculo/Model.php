<?php

namespace Application\Espetaculo;
use Application\Core;

class Model extends \Application\Core\Model
{
    public function getData($data)
    {
       return $data;
    }

    public function getAll()
    {
      $queryBuilder = $this->conexaoDbal()->createQueryBuilder();
      $queryBuilder->select('*')->from('espetaculos');
      
      $query = $queryBuilder->getSQL();
      return $this->conexaoDbal()->fetchAll($query);
    }
    
}