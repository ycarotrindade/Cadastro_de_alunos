<?php 

declare(strict_types=1);

namespace app\classes;

class Router
{
    private string $path; #indica a url
    private string $request; #indica se o método é GET ou POST

    public function controllerFound(string $controllerNamespace,string $controller, string $action)
    {
        #verifica se o controller ou a action existem, senão retorna um erro
        if(!class_exists($controllerNamespace))
        {
            throw new \Exception("Controller $controller does not exist");
        }else if (!method_exists($controllerNamespace,$action))
        {
            throw new \Exception("Action $action does not exist in controller $controller");
        }
    }

    public function routeFound(array $routes)
    #verifica se a rota existe na array $routes, senão lança uma Exception
    {
        if(!isset($routes[$this->request]) or !isset($routes[$this->request][$this->path]))
        {
            throw new \Exception("Route {$this->path} does not exist");
        }
    }

    public function execute(array $routes)
    #faz algumas verificações e se passou, direciona para o controller
    {
        $this->path=path();
        $this->request=request();
        $this->routeFound($routes);
        list($controller,$action)=explode('@',$routes[$this->request][$this->path]);
        $controllerNamespace="app\\controllers\\{$controller}";
        $this->controllerFound($controllerNamespace,$controller,$action);
        $controllerInstance=new $controllerNamespace;
        $controllerInstance->$action();
    }
}

?>