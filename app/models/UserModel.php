<?php 

declare(strict_types=1);
namespace app\models;

use Exception;
use PDO;

class UserModel extends Database
{
    private PDO $pdo;
    public function __construct()
    {
        $this->pdo=$this->getConnection();
    }

    public function getUserByName(string $name)
    {
        $sql="SELECT * FROM users WHERE user=?";
        $montagem=$this->pdo->prepare($sql);
        $montagem->bindValue(1,$name);
        $montagem->execute();
        if($montagem->rowCount()>0)
        {
            return $montagem->fetchAll(PDO::FETCH_CLASS);
        }else
        {
            throw new Exception("Error");
        }
    }

    public function getAccessSet()
    {
        $sql = 'DESC users';

        $stmt=$this-> pdo-> prepare($sql);
        $stmt-> execute();
        
        $unformatted_value = $stmt->fetchAll(PDO::FETCH_CLASS)[3]-> Type;
        $formatted_value = explode(',',(str_replace(["'",'set(',')'],'',$unformatted_value)));

        return $formatted_value;
    }

    public function PushValues(array $values)
    {
        if(!$this-> verifyExistance($values['user']))
        {
            $sql = 'INSERT INTO users (user, hash, access) VALUES (?,?,?)';
    
            $stmt = $this-> pdo-> prepare($sql);
            $stmt-> bindValue(1,$values['user']);
            $stmt-> bindValue(2,password_hash($values['password'], PASSWORD_DEFAULT));
            $stmt-> bindValue(3,$values['access']);
            $stmt-> execute();

        }else
        {
            throw new Exception("Existente");
        }
    }

    public function verifyExistance(string $name)
    {
        $sql = 'SELECT * FROM users WHERE user=?';

        $stmt = $this-> pdo-> prepare($sql);
        $stmt-> bindValue(1,$name);
        $stmt-> execute();
        
        return ($stmt-> rowCount()>0) ? true : false;
    }

    public function getAllValues()
    {
        $sql = 'SELECT * FROM users ORDER BY id ASC';

        $stmt = $this-> pdo-> prepare($sql);
        $stmt-> execute();

        if($stmt-> rowCount() > 0)
        {
            return $stmt-> fetchAll(PDO::FETCH_CLASS);
        }else
        {
            throw new Exception("Vazio");
        }
    }

    public function deleteUserById(int $id)
    {
        $sql = 'DELETE FROM users WHERE id=?';

        $stmt = $this-> pdo-> prepare($sql);
        $stmt-> bindValue(1,$id);
        $stmt-> execute();
    }

    public function getUserById(int $id)
    {
        $sql = 'SELECT * FROM users WHERE id=?';

        $stmt = $this-> pdo-> prepare($sql);
        $stmt-> bindValue(1,$id);
        $stmt-> execute();

        if ($stmt-> rowCount() > 0)
        {
            return $stmt-> fetchAll(PDO::FETCH_CLASS);
        }else
        {
            throw new Exception('Vazio');
        }
    }

    public function updateValuesById(array $values, int $id)
    {
        $sql = 'UPDATE users SET user=?, hash=?, access=? WHERE id=?';

        $stmt = $this-> pdo-> prepare($sql);
        $stmt-> bindValue(1,$values['user']);
        $stmt-> bindValue(2,password_hash($values['password'],PASSWORD_DEFAULT));
        $stmt-> bindValue(3,$values['access']);
        $stmt-> bindValue(4,$id);
        $stmt-> execute();
    }
}

?>