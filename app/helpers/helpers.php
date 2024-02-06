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

function redirect(string $to)
{
    header("Location: ".$to);
    die();
}

function getAccess()
{
    return $_SESSION['access'];
}

function getUser()
{
    return $_SESSION['user'];
}

?>