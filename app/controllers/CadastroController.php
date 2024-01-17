<?php 

declare(strict_types=1);
namespace app\controllers;
use app\models\CadastroModel;

class CadastroController
{
    public function index(array $param)
    {
        view('cadastro',[
            'title'=>'cadastro',
            'tipo'=>$param[0]
        ]);
    }

    public function save(array $param)
    {
        $table=($param[0]=='funcionarios')?'users':'students';
        $model=new CadastroModel();
        $pass=$model->saveUser($table,$_POST);
        if ($pass)
        {
        echo "<script>
        alert('Funcionário salvo')
        setTimeout(window.location.href='/cadastro/funcionarios',2000)
        </script>
        ";
        }else
        {
            echo "<script>
            alert('Este nome de usuário já está sendo utilizado')
            setTimeout(window.location.href='/cadastro/funcionarios',2000)
            </script>";
        }
    }
}

?>