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
        var_dump($th->getMessage());
    }
}

function verifyHash(string $password, string $hash)
{
    if(password_verify($password,$hash))
    {
        redirect("/Home");
    }else
    {
        redirect("/Error"); 
    }
}

function redirect(string $to)
{
    header("Location: ".$to);
}

function urlExceptions(string $url)
{
    $exceptions=['Cadastro'];
    $found='';
    foreach($exceptions as $valor)
    {
        $found=strpos($url,$valor)!=false?$valor:'';
    }
}

?>