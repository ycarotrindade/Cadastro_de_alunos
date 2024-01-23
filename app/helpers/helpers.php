<?php 

declare(strict_types=1);
use app\classes\Engine;


function view(string $view, array $data=[])
{
    try
    {
        $engine=new Engine();
        echo $engine->render($view,$data);
    }catch(\Throwable $th)
    {
        redirect("/error"); 
    }
}

function verify()
{
    if($_SESSION['user']==null)
    {
        redirect('/');
    }
}

function verifyHash(string $password, string $hash, string $user)
{
    if(password_verify($password,$hash))
    {
        $_SESSION['user']=$user;
        redirect("/home");
    }else
    {
        redirect("/error"); 
    }
}

function redirect(string $to)
{
    header("Location: ".$to);
    die();
}
?>