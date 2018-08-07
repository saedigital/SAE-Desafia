<?php

namespace Application\Poltrona;
use Application\Core;

class Model extends \Application\Core\Model
{
    public function getData($data)
    {
       return $data;
    }

    public function getOcupadas()
    {
      $queryBuilder = $this->conexaoDbal()->createQueryBuilder();
      $queryBuilder
                ->select('espetaculo_id AS id', 'group_concat(poltrona) AS ocupadas', 'count(p.id) AS totalOcupadas', "FORMAT(count(p.id)*valor,2,'pt_BR') AS valorTotal")
                ->from('poltronas','p')
                ->join('p','espetaculos','e','e.id=p.espetaculo_id')
                ->groupBy('espetaculo_id');
      
      $query = $queryBuilder->getSQL();
      return $this->conexaoDbal()->fetchAll($query);
    }

}