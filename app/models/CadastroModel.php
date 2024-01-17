<?php 

declare(strict_types=1);
namespace app\models;
use PDO;

class CadastroModel extends Database
{
    private $pdo;

    public function __construct()
    {
        $this->pdo=$this->getConnection();
    }

    public function saveUser(string $table,array $values)
    {
        $retorno=false;
        if ($this->verifyExistance($table,$values['user']))
        {
            $sql="INSERT INTO $table (user,hash) VALUES (?,?)";
            $montagem=$this->pdo->prepare($sql);
            $montagem->bindValue(1,$values['user']);
            $montagem->bindValue(2,password_hash($values['password'],PASSWORD_DEFAULT));
            $montagem->execute();
            $retorno=true;
        }
        return $retorno;
    }

    public function verifyExistance(string $table,string $user)
    {
        $sql="SELECT * FROM $table WHERE user=?";
        $montagem=$this->pdo->prepare($sql);
        $montagem->bindValue(1,$user);
        $montagem->execute();
        $valor=$montagem->fetchAll(PDO::FETCH_CLASS);
        return (empty($valor))?true:false;
    }
}

?>