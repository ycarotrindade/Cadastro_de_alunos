<?php 

declare(strict_types=1);
namespace app\controllers;
use app\models\LoginModel;

class LoginController
{
    public function index()
    {
        $_SESSION['user']=null;
        $_SESSION['access']=null;
        view('login',[
            'title'=>'Login'
        ]);
    }

    public function login()
    {
        $montagem=new LoginModel();
        $user_info=$montagem->getPassAccessByName($_POST['user']);
        verifyHash($_POST['password'],$user_info->hash,$_POST['user'],$user_info->access);
    }
}

?>