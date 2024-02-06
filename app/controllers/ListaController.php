<?php 

declare(strict_types=1);

namespace app\controllers;

use app\models\UsersModel;
use app\models\StudentModel;
use app\models\UserModel;
use Exception;

class ListaController
{
    private $set=["alunos","funcionarios"];
    public function index(array $params)
    {
        $view_ac=$params[0]=='funcionarios'?'lista_func':'lista_al';
        if(in_array($params[0],$this->set))
        {
            if ($params[0] == 'funcionarios' and getAccess() != 'admin')
            {
                view('error',[
                    'title'=> 'erro',
                    'error'=> 'Você não tem permissão para realizar essa ação'
                ]);
            }else
            {
                view($view_ac,[
                    'title'=>'listagem',
                    'tipo'=>$params[0]
                ]);
            }
        }else
        {
            view('error',
            [
                'title'=> 'error',
                'error'=> 'não é possível o redirecionamento'
            ]);
        }
    }

    public function getTableValues(array $params)
    {
        $model = null;
        if ($params[0] == 'funcionarios')
        {
            $model = new UserModel();
        }else
        {
            $model= new StudentModel();
        }

        try
        {
            $data = $model-> getAllValues();
            header(JSON_HEADER);
            echo json_encode($data);
        }catch(Exception $e)
        {
            if ($e-> getMessage() == 'Vazio')
            {
                $data='Nada Encontrado';
                header(JSON_HEADER);
                http_response_code(204);
                echo json_encode($data);
            }else
            {
                header(JSON_HEADER);
                http_response_code(500);
            }
        }
    }

    public function delete(array $params)
    {
        $model=null;

        if ($params[0] == 'funcionarios')
        {
            $model = new UserModel();
        }else
        {
            $model = new StudentModel();
        }

        try
        {
            try
            {
                $user = $model-> getUserById((int) $params[1])[0];
            }catch(Exception $e)
            {
                throw new Exception('Erro de servidor');
            }

            if ($user-> user == getUser())
            {
                throw new Exception('Proibido');
            }else
            {
                try
                {
                    $model-> deleteUserById((int) $params[1]);
                    header(JSON_HEADER);
                }catch(Exception $e)
                {
                    throw new Exception('Erro de servidor');
                }
            }

        }catch(Exception $e)
        {
            if ($e-> getMessage() == 'Proibido')
            {
                header(JSON_HEADER);
                http_response_code(400);
            }else
            {
                header(JSON_HEADER);
                http_response_code(500);
            }
        }
    }

    public function edit(array $params)
    {
        $model = null;
        $setValues = null;
        
        if ($params[0] == 'funcionarios')
        {
            $model = new UserModel();
            try
            {
                $setValues = $model->getAccessSet();
            }catch(Exception $e)
            {
                $setValues = ['func'];
            }
        }else
        {
            $model = new StudentModel();
        }

        try
        {
            $values = $model-> getUserById((int) $params[1])[0];
            view('editar',[
                'tipo'=> $params[0],
                'title'=> 'editar',
                'id'=> $params[1],
                'values'=> $values,
                'setValues'=> $setValues
            ]);
        }catch(Exception $e)
        {
            if ($e->getMessage() == 'Vazio')
            {
                view('error',[
                    'title'=> 'erro',
                    'error'=> 'Error no servidor'
                ]);
            }
        }
    }

    public function save(array $params)
    {
        $model = null;

        if ($params[0] == 'funcionarios')
        {
            $model = new UserModel();
        }else
        {
            $model = new StudentModel();
        }

        try
        {
            $model-> updateValuesById($_POST, (int) $params[1]);
            header(JSON_HEADER);
        }catch(Exception $e)
        {
            header(JSON_HEADER);
            http_response_code(500);
        }
    }
}

?>