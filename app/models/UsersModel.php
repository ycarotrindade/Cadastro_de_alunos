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
            $sql='DELETE FROM students WHERE id=?';
            $montagem=$this->pdo->prepare($sql);
            $montagem->bindValue(1,$id);
            $montagem->execute();
            $message="Aluno deletado";
        }
        return $message;
    }
    public function editById(string $table, array $params)
    {
        $message='';
        if($table=='users')
        {
            if($this->verifyExistance($params['user']))
            {
                $sql="UPDATE users SET user=?,hash=? WHERE id=?";
                $montagem=$this->pdo->prepare($sql);
                $montagem->bindValue(1,$params['user']);
                $montagem->bindValue(2,password_hash($params['password'],PASSWORD_DEFAULT));
                $montagem->bindValue(3,$params['id']);
                $montagem->execute();
                $message="Informações do usuário atualizadas";
            }else
            {
                $message="Este nome de usuário está indisponível";
            }
        }else
        {
            $params['situation']=$this->verifySituation($params);
            $sql='UPDATE students SET name=?,grade1=?,grade2=?,grade3=?,situation=? WHERE id=?';
            $montagem=$this->pdo->prepare($sql);
            $montagem->bindValue(1,$params['user']);
            $montagem->bindValue(2,$params['grade1']);
            $montagem->bindValue(3,$params['grade2']);
            $montagem->bindValue(4,$params['grade3']);
            $montagem->bindValue(5,$params['situation']);
            $montagem->bindValue(6,$params['id']);
            $montagem->execute();
            $message='Parâmetros do aluno atualizados';
        }
        return $message;
    }
    public function selectById(string $table, string $id)
    {
        $sql="SELECT * FROM $table WHERE id=?";
        $montagem=$this->pdo->prepare($sql);
        $montagem->bindValue(1,$id);
        $montagem->execute();
        return $montagem->fetchAll(PDO::FETCH_CLASS)[0];
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

    public function verifySituation(array $values)
    {
        $grade_av=($values['grade1']+$values['grade2']+$values['grade3'])/3;
        $situation='';
        if($grade_av>=7)
        {
            $situation="APROVADO";
        } else if($grade_av>=5 and $grade_av<7)
        {
            $situation="RECUPERACAO";
        } else
        {
            $situation="REPROVADO";
        }
        return $situation;
    }
}

?>