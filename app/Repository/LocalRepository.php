<?php
/**
 * Created by PhpStorm.
 * User: moyses-oliveira
 * Date: 27/06/19
 * Time: 10:56
 */

namespace App\Repository;

use App\Lib\DB;

class LocalRepository
{

    public static function getAll():array {
        return DB::results('SELECT id, chrLocal FROM `local`;');
    }

    public static function getOptions():array  {
        return DB::fetchKeyPair('SELECT id, chrLocal FROM `local`;');
    }

    public static function getPoltronas($id):array {
        return DB::results('SELECT id, chrCodigo FROM `local_poltrona` WHERE fkLocal=:id;', [':id'=>$id]);
    }
}