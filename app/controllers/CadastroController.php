<?php 

declare(strict_types=1);
namespace app\controllers;

class CadastroController
{
    public function index(array $param)
    {
        view('cadastro',[
            'title'=>'cadastro',
            'tipo'=>$param[0]
        ]);
    }
}

?>