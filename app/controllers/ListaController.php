<?php 

declare(strict_types=1);
namespace app\controllers;
use app\models\UsersModel;

class ListaController
{
    public function index(array $params)
    {
        $view_ac=$params[0]=='funcionarios'?'lista_func':'lista_al';
        view($view_ac,[
            'title'=>'listagem',
            'tipo'=>$params[0],
            'table_values'=>$this->importValues($params[0])
        ]);
    }

    public function importValues(string $value)
    {
        $table=($value=='funcionarios')?'users':'students';
        $model=new UsersModel();
        return $model->importValues($table);
    }

    public function delete(array $params)
    {
        $tipo=$params[0];
        $table=($tipo=='funcionarios')?'users':'students';
        $model=new UsersModel();
        if($table=='users')
        {
            $message=$model->deleteById($table,$params[1],$_SESSION['user']);
        }else
        {
            $message=$model->deleteById($table,$params[1]);
        }
        echo"<script>
        alert('$message')
        setTimeout(window.location.href='/lista/$tipo',2000)
        </script>";
    }

    public function edit(array $params)
    {
        $model=new UsersModel();
        $table=($params[0]=='funcionarios')?'users':'students';
        view('editar',[
            'title'=>'editar',
            'tipo'=>$params[0],
            'id'=>$params[1],
            'values'=>$model->selectById($table,$params[1])
        ]);
    }

    public function save(array $params)
    {
        $tipo=$params[0];
        $table=($tipo=='funcionarios')?'users':'students';
        $_POST['id']=$params[1];
        $model=new UsersModel();
        $message=$model->editById($table,$_POST);
        echo"<script>
        alert('$message')
        setTimeout(window.location.href='/lista/$tipo',2000)
        </script>";
    }
}

?>