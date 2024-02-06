<?php 

declare(strict_types=1);
namespace app\controllers;

use app\models\UserModel;
use Exception;

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
        $model=new UserModel();
        try
        {
            $data=$model->getUserByName($_POST['user'])[0];
            $hash_db=$data->hash;
            if(password_verify($_POST['password'],$hash_db))
            {
                $_SESSION['user']=$data->user;
                $_SESSION['access']=$data->access;
                header(JSON_HEADER);
                echo json_encode(array("status_code"=>200));
            }else
            {
                header(JSON_HEADER);
                http_response_code(401);
                echo json_encode(array("status_code"=>401));
            }
        }catch(Exception $e)
        {
            $_SESSION['status_code']=204;
            header(JSON_HEADER);
            http_response_code(204);
            echo json_encode(array("status_code"=>204));
        }
    }
}

?>