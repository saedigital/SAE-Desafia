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

    public static function fetchKeyPair(string $query, array $params=[]) {
        return static::executeFetchAll($query,PDO::FETCH_KEY_PAIR, $params);
    }

    public static function fetch(string $query, array $params=[]) {
        return static::executeFetch($query,PDO::FETCH_ASSOC, $params);
    }

    public static function fetchValue(string $query, array $params=[]) {
        return static::executeFetch($query,PDO::FETCH_COLUMN, $params);
    }

    public static function getLastInsertID(){
        return static::fetchValue("SELECT LAST_INSERT_ID() as PK;");
    }

    public static function fetchColumn(string $query, array $params=[]) {
        return static::executeFetchAll($query,PDO::FETCH_COLUMN, $params);
    }

    public static function results(string $query, array $params=[]) {
        return static::executeFetchAll($query,PDO::FETCH_ASSOC, $params);
    }

    public static function exec(string $query) {
        static::getPDO()->exec($query);
    }

    public static function executeFetchAll(string $query, int $fetchStyle, array $params=[]) {
        return static::execute($query, $params)->fetchAll($fetchStyle);
    }

    public static function executeFetch(string $query, int $fetchStyle, array $params=[]) {
        return static::execute($query, $params)->fetch($fetchStyle);
    }

    public static function execute(string $query, array $params=[]): PDOStatement {
        $statement = static::getPDO()->prepare($query);
        $statement->execute($params);
        return $statement;
    }

}
DB::init();