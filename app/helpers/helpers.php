<?php 

declare(strict_types=1);
use app\classes\Router;
use app\classes\Engine;


function path()
{
    return $_SERVER['REQUEST_URI'];
}

function request()
{
    return $_SERVER['REQUEST_METHOD'];
}

function routerExecute()
{
    #tenta executar a rota solicitada, se não funciona redireciona para a página de erro
    try
    {
        $routes=require 'app/routes/routes.php';
        $router=new Router();
        $router->execute($routes);
    }catch(\Throwable $th)
    {
        var_dump($th->getMessage());
    }

}

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

function urlExceptions(string $url)
{
    $exceptions=['cadastro','lista','deletar','editar'];
    $found='';
    $params=array();
    foreach($exceptions as $valor)
    {
        if(strpos($url,$valor)!=false)
        {
            $found=$valor;
            break;
        }
    }
    if ($found!='')
    {
        $params=explode('/',$url);
        unset($params[0],$params[1]);
        switch ($found)
        {
            case 'cadastro' or 'lista':
                $url=preg_replace(['/alunos/','/funcionarios/'],'{tipo}',$url);
            case 'deletar' or 'editar':
                $url=preg_replace(['/alunos/','/funcionarios/'],'{tipo}',$url);
                $url=preg_replace('/\d+/','{id}',$url);
                break;
        }
    }
    return [$url,array_values($params)];
}
?>