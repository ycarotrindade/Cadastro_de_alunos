<?php 

declare(strict_types=1);
namespace app\models;

use PDO;

class Database
{
    private $connection=null;

    public function getConnection()
    {
        if(empty($this->connection))
        {
            $this->connection=new PDO("mysql:host=".HOSTNAME.";dbname=".DATABASE_NAME,DATABASE_USER,DATABASE_PASSWORD);
        }
        return $this->connection;
    }
}

?>