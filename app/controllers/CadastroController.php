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
        $model=new CadastroModel();
        if ($param[0]=='funcionarios')
        {
            $pass=$model->saveUser($_POST);
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
        }else
        {
            $_POST['situation']=(in_array(-1,$_POST))?'INDEFINIDO':$this->verifySituation($_POST);
            $model=new CadastroModel();
            $model->saveStudent($_POST);
            echo "<script>
            alert('Estudante Cadastrado')
            setTimeout(window.location.href='/cadastro/alunos',2000)
            </script>
            ";
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