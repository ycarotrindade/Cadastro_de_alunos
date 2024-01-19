<?php 

declare(strict_types=1);
namespace app\controllers;
use app\models\LoginModel;

class LoginController
{
    public function index()
    {
        $_SESSION['user']=null;
        view('login',[
            'title'=>'Login'
        ]);
    }

    public function login()
    {
        $montagem=new LoginModel();
        $user_hash=$montagem->getPassByName($_POST['user']);
        verifyHash($_POST['password'],$user_hash->hash,$_POST['user']);
    }
}

?>