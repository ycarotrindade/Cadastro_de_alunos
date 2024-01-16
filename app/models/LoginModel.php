<?php 

declare(strict_types=1);
namespace app\models;
use PDO;

class LoginModel extends Database
{
    private $pdo;

    public function __construct()
    {
        $this->pdo=$this->getConnection();
    }

    public function getPassByName(string $name)
    {
        $sql="SELECT hash FROM users WHERE user=?";
        $montagem=$this->pdo->prepare($sql);
        $montagem->bindValue(1,$name);
        $montagem->execute();
        return $montagem->fetchAll(PDO::FETCH_CLASS)[0];
    }
}

?>