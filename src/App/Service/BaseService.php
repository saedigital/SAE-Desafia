<?php 

namespace App\Service;

use App\Db\DataBase;

class BaseService
{
    protected $db;

    protected $status = true;
    protected $message = '';

    public function __construct(DataBase $db)
    {
        $this->db = $db;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getMessage()
    {
        return $this->message;
    }
}