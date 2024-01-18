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

    public function saveUser(array $values)
    {
        $retorno=false;
        if ($this->verifyExistance($values['user']))
        {
            $sql="INSERT INTO users (user,hash) VALUES (?,?)";
            $montagem=$this->pdo->prepare($sql);
            $montagem->bindValue(1,$values['user']);
            $montagem->bindValue(2,password_hash($values['password'],PASSWORD_DEFAULT));
            $montagem->execute();
            $retorno=true;
        }
        return $retorno;
    }

    public function verifyExistance(string $user)
    {
        $sql="SELECT * FROM users WHERE user=?";
        $montagem=$this->pdo->prepare($sql);
        $montagem->bindValue(1,$user);
        $montagem->execute();
        $valor=$montagem->fetchAll(PDO::FETCH_CLASS);
        return (empty($valor))?true:false;
    }

    public function saveStudent(array $values)
    {
        $sql="INSERT INTO students (name,grade1,grade2,grade3,situation) VALUES (?,?,?,?,?)";
        $montagem=$this->pdo->prepare($sql);
        $montagem->bindValue(1,$values['user']);
        $montagem->bindValue(2,$values['grade1']);
        $montagem->bindValue(3,$values['grade2']);
        $montagem->bindValue(4,$values['grade3']);
        $montagem->bindValue(5,$values['situation']);
        $montagem->execute();
    }
}

?>