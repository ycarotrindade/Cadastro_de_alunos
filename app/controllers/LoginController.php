<?php 

declare(strict_types=1);
namespace app\controllers;

class LoginController
{
    public function index()
    {
        view('login',[
            'title'=>'Login'
        ]);
    }
}

?>