<?php
/**
 * Created by PhpStorm.
 * User: moyses-oliveira
 * Date: 26/06/19
 * Time: 16:36
 */

namespace App\Lib;

use PDO;
use PDOException;
use PDOStatement;

class DB
{

    /**
     * @var PDO PDO
     */
    private static $pdo;

    public static function init(){
        $dbconf = require CONFIG_PATH . 'database.php';
        if(!isset($dbconf['port']))
            $dbconf['port'] = 3306;

        $dns = "{$dbconf['engine']}:dbname={$dbconf['database']};host={$dbconf['host']};port={$dbconf['port']}";
        $GLOBALS['CONNECTION'] = new PDO($dns, $dbconf['user'], $dbconf['pass'], [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]);

        static::$pdo = $GLOBALS['CONNECTION'];
        static::getPDO()->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }

    /**
     * @return PDO
     */
    public static function getPDO(): PDO
    {
        return static::$pdo;
    }

    public static function fetch(string $query) {
        return static::executeFetch($query,PDO::FETCH_ASSOC);
    }

    public static function fetchValue(string $query) {
        return static::executeFetch($query,PDO::FETCH_COLUMN);
    }

    public static function getLastInsertID(){
        return static::fetchValue("SELECT LAST_INSERT_ID() as PK;");
    }

    public static function record(string $query, array $params) {
        $statement = static::getPDO()->prepare($query);
        $statement->execute($params);
    }

    public static function exec(string $query) {
        static::getPDO()->exec($query);
    }

    private static function executeFetch(string $query, int $fetchStyle) {
        $statement = static::getPDO()->prepare($query);
        $statement->execute();
        return $statement->fetch($fetchStyle);
    }

}
DB::init();