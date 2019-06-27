<?php
/**
 * Created by PhpStorm.
 * User: moyses-oliveira
 * Date: 27/06/19
 * Time: 11:05
 */

namespace App\Repository;

use App\Lib\DB;
use App\Model\EspetaculoModel;

class EspetaculoRepository
{
    public static function getAll() {
        return DB::results('
            SELECT 
              e.id, 
              e.chrEspetaculo, 
              l.chrLocal,
              COUNT(p.id) as poltronas,
              COUNT(r.id) as reservas
            FROM `espetaculo` e 
            JOIN `local` l  ON l.id=e.fkLocal
            LEFT JOIN `local_poltrona` p ON p.fkLocal=l.id
			LEFT JOIN `espetaculo_reserva` r ON r.fkPoltrona=p.id AND r.fkEspetaculo=e.id
            GROUP BY e.id
            ;
        ');
    }


    public static function getStatus(int $id) {
        return DB::fetch("
            SELECT 
              COUNT(p.id) as poltronas,
              COUNT(r.id) as reservas
            FROM `espetaculo` e 
            JOIN `local` l  ON l.id=e.fkLocal
            LEFT JOIN `local_poltrona` p ON p.fkLocal=l.id
			LEFT JOIN `espetaculo_reserva` r ON r.fkPoltrona=p.id AND r.fkEspetaculo=e.id
			WHERE e.id=$id
            GROUP BY e.id
            ;
        ");
    }

    public static function getPoltronas($id) {
        $collection = LocalRepository::getPoltronas((new EspetaculoModel)->find($id)->getFkLocal());
        $ocupadas = static::getPoltronasOcupadas($id);
        foreach($collection as &$row)
            $row['disponivel'] = !in_array($row['id'], $ocupadas);

        return $collection;
    }

    public static function getPoltronasOcupadas($id) {
        return DB::fetchColumn('SELECT fkPoltrona FROM espetaculo_reserva WHERE fkEspetaculo=:id', [':id'=>$id]);
    }

    public static function getPoltronasDisponíveis($id) {
        $ocupadas = static::getPoltronasOcupadas($id);
        $collection = implode(',', $ocupadas);
        $query = "SELECT id, chrCodigo FROM `local_poltrona` WHERE fkLocal=:fkLocal ";
        if($ocupadas)
            $query .= "AND id NOT IN($collection)";

        return DB::results($query, [':fkLocal'=>(new EspetaculoModel)->find($id)->getFkLocal()]);
    }

}