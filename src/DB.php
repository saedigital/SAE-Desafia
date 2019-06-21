<?php
class DB{
  private static $connection = null;

  public static function getConnection(){
    if (self::$connection === null){
      $dsn = sprintf('%s:host=%s;port=%d;dbname=%s;user=%s;password=%s',
        $_ENV['DB_DRIVER'],
        $_ENV['DB_URL'],
        $_ENV['DB_PORT'],
        $_ENV['DB_DATABASE'],
        $_ENV['DB_USER'],
        $_ENV['DB_PASSWORD']
      );

      $pdo = new \PDO($dsn);
      $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

      self::$connection = $pdo;
    }

    return self::$connection;
  }
}