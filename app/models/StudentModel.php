<?php 

declare(strict_types=1);

namespace app\models;

use Exception;
use PDO;

class StudentModel extends Database
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo=$this->getConnection();
    }

    public function PushValues(array $values)
    {
        $sql = 'INSERT INTO students (name, grade1, grade2, grade3, situation) VALUES (?,?,?,?,?)';

        $stmt = $this-> pdo-> prepare($sql);
        $stmt-> bindValue(1,$values['user']);
        $stmt-> bindValue(2,$values['grade1']);
        $stmt-> bindValue(3,$values['grade2']);
        $stmt-> bindValue(4,$values['grade3']);

        $grade_values = [$values['grade1'],$values['grade2'],$values['grade3']];
        $grade_values = $this-> convertToFloat($grade_values);

        $stmt-> bindValue(5,$this-> calcSituation($grade_values));
        $stmt-> execute();

    }

    private function calcSituation(array $grades)
    {
        $situation = '';
        if (in_array(-1,$grades))
        {
            $situation = 'INDEFINIDO';
        }else
        {
            $average=array_sum($grades)/3;
            if ($average >= 7)
            {
                $situation = 'APROVADO';
            }else if ($average >=5 )
            {
                $situation = 'RECUPERACAO';
            }else
            {
                $situation = 'REPROVADO';
            }
        }

        return $situation;
    }

    private function convertToFloat(array $values)
    {
        return array_map(fn($x)=> (float) $x,$values);
    }

    public function getAllValues()
    {
        $sql = 'SELECT * FROM students ORDER BY id ASC';

        $stmt = $this-> pdo-> prepare($sql);
        $stmt-> execute();

        if ($stmt-> rowCount()>0)
        {
            return $stmt-> fetchAll(PDO::FETCH_CLASS);
        }else
        {
            throw new Exception('Vazio');
        }
    }
    
    public function deleteUserById(int $id)
    {
        $sql = 'DELETE FROM students WHERE id=?';

        $stmt = $this-> pdo-> prepare($sql);
        $stmt-> bindValue(1,$id);
        $stmt->execute();
    }

    public function getUserById(int $id)
    {
        $sql = 'SELECT * FROM students WHERE id=?';

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
        $sql = 'UPDATE students SET name=?, grade1=?, grade2=?, grade3=?, situation=? WHERE id=?';

        $stmt = $this-> pdo-> prepare($sql);
        $stmt-> bindValue(1,$values['user']);
        $stmt-> bindValue(2,$values['grade1']);
        $stmt-> bindValue(3,$values['grade2']);
        $stmt-> bindValue(4,$values['grade3']);

        $grade_values = [$values['grade1'],$values['grade2'],$values['grade3']];
        $grade_values = $this-> convertToFloat($grade_values);

        $stmt-> bindValue(5,$this-> calcSituation($grade_values));
        $stmt-> bindValue(6,$id);
        $stmt-> execute();
    }
}

?>