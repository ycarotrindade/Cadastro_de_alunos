<?php 

declare(strict_types=1);

namespace app\controllers;

use app\models\StudentModel;
use app\models\UserModel;
use Exception;

class CadastroController
{
    private $set=["alunos","funcionarios"];
    public function index(array $param)
    {
        $model = new UserModel();
        $setValues = $model-> getAccessSet();
        if(in_array($param[0],$this->set))
        {
            view('cadastro',[
                'title'=>'cadastro',
                'tipo'=>$param[0],
                'acesso'=>$_SESSION['access'],
                'setValues'=>$setValues
            ]);
        }else
        {
            view(
                'error',
                [
                    'title'=>"error"
                ]
                );
        }
    }

    public function save(array $params)
    {
        if ($params[0] == 'funcionarios')
        {
            $model = new UserModel();
        }else
        {
            $model = new StudentModel();
        }
        
        try
        {
            $model-> PushValues($_POST);
            header(JSON_HEADER);
            http_response_code(201);
            echo json_encode(array('status_code'=> 201));

        }catch(Exception $e)
        {
            if ($e->getMessage() == 'Existente')
            {
                header(JSON_HEADER);
                http_response_code(400);
                echo json_encode(array('status_code'=> 400));
            }else
            {
                header(JSON_HEADER);
                http_response_code(500);
                echo json_encode(array('status_code'=> 500));   
            }
        }

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