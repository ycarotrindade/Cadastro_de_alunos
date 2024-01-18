<?php 

declare(strict_types=1);
namespace app\models;
use PDO;

class UsersModel extends Database
{
    private $pdo;
    public function __construct()
    {
        $this->pdo=$this->getConnection();
    }

    public function importValues(string $table)
    {
        $sql="SELECT * FROM $table ORDER BY id ASC";
        $montagem=$this->pdo->prepare($sql);
        $montagem->execute();
        return $montagem->fetchAll(PDO::FETCH_CLASS);
    }

    public function deleteById(string $table, string $id, string $username='')
    {
        $message='';
        if ($table=='users')
        {
            $sql='SELECT user FROM users WHERE id=?';
            $montagem=$this->pdo->prepare($sql);
            $montagem->bindValue(1,$id);
            $montagem->execute();
            $username_table=$montagem->fetchAll(PDO::FETCH_CLASS)[0];
            if($username_table->user==$username)
            {
                $sql='DELETE FROM users WHERE id=?';
                $montagem=$this->pdo->prepare($sql);
                $montagem->bindValue(1,$id);
                $montagem->execute();
                $message="Usuário $username deletado";
            }else{
                $message="Você não tem permissão para deletar esse usuário";
            }
        }else
        {
            
        }
        return $message;
    }
    public function editById(string $table, string $params)
    {
        $message='';
        if($table=='users')
        {
            
        }
    }
    public function selectById(string $table, string $id)
    {

    }
}

?>