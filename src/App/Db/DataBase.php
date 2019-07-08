<?php 

namespace App\Db;

use PDO;

class DataBase
{
    private $connection;

    /**
     * @param array $config
     */
    public function __construct($config = [])
    {
        $fileData = './../app/data/base.db';
        if (!is_file($fileData)) {
            file_put_contents($fileData, '');
        }

        $this->connection = new PDO('sqlite:' . $fileData);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, 
                                        PDO::ERRMODE_EXCEPTION);

        $this->createTables();                                
    }

    public function createTables()
    {
        $this->connection->exec("CREATE TABLE IF NOT EXISTS events (
                                 id INTEGER PRIMARY KEY, 
                                 title TEXT, 
                                 description TEXT, 
                                 ticket_value REAL, 
                                 tickets_limit INTEGER, 
                                 tickets_sold INTEGER, 
                                 time TEXT)");


        $this->connection->exec("CREATE TABLE IF NOT EXISTS tickets (
                                id INTEGER PRIMARY KEY, 
                                event_id INTEGER, 
                                number_ticket INTEGER,
                                reserve_number INTEGER,
                                time TEXT)");
                
    }                            
    
    /**
     * @param string $sql
     * @return array
     */
    public function list($sql, $data = [])
    {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($data); 
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param string $sql
     * @return array
     */
    public function item($sql, $data = [])
    {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($data); 
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @return PDO
     */
    public function getConnection()
    {
        return $this->connection;
    }
}
