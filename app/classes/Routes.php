<?php 

declare(strict_types=1);
namespace app\classes;

class Routes
{
    private $current_route;
    private $current_method;
    private $routes_list=[
        'GET'=>[],
        'POST'=>[],
        'PUT'=>[],
        'DELETE'=>[]
    ];
    public function addGet(string $uri, string $controller)
    {
        $this->routes_list['GET'][$uri]['controller']=$controller;
        $this->current_method='GET';
        $this->current_route=$uri;
        return $this;
    }
    public function addPost(string $uri, string $controller)
    {
        $this->routes_list['POST'][$uri]['controller']=$controller;
        $this->current_method='POST';
        $this->current_route=$uri;
        return $this;
    }
    public function addPut(string $uri, string $controller)
    {
        $this->routes_list['PUT'][$uri]['controller']=$controller;
        $this->current_method='PUT';
        $this->current_route=$uri;
        return $this;
    }
    public function addDelete(string $uri, string $controller)
    {
        $this->routes_list['DELETE'][$uri]['controller']=$controller;
        $this->current_method='DELETE';
        $this->current_route=$uri;
        return $this;
    }

    public function dispatch()
    {
        $method = $_POST['method'] ?? $_SERVER['REQUEST_METHOD'];
        $data=$this->routes_list[$method];
        $user_uri=$_SERVER['REQUEST_URI'];
        $found=false;
        $params=[];
        if(isset($data[$user_uri]))
        {
            $found=true;
        }else
        {
            $user_uri_pieces=explode("/",$user_uri);
            foreach($data as $data_uri=>$datacontroller)
            {
                $pieces=explode('/',$data_uri);
                if(count($user_uri_pieces)!=count($pieces))
                {
                    continue;
                }
                $params_quantitys=substr_count($data_uri,'{');
                $params_values=array_diff_assoc($user_uri_pieces,$pieces);
                if(count($params_values)!=$params_quantitys)
                {
                    continue;
                }
                foreach($params_values as $key=>$value)
                {
                    $user_uri_pieces[$key]=$pieces[$key];
                    $params[]=$value;
                }
                $user_uri=implode("/",$user_uri_pieces);
                $found=True;
                break;
            }
        }
        if($found)
        {
            extract($data[$user_uri]);
            if(isset($middlewares))
            {
                foreach($middlewares as $middleware)
                {
                    [$middleware,$action]=explode('@',$middleware);
                    $middlewareNamespace="app\middlewares\\{$middleware}";
                    $middlewareInstance=new $middlewareNamespace;
                    call_user_func(array($middlewareInstance,$action));
                }
            }
            [$controller,$action]=explode('@',$controller);
            $controllerNamespace="app\\controllers\\{$controller}";
            $controllerInstance=new $controllerNamespace;
            call_user_func(array($controllerInstance,$action),$params);
        }else
        {
            redirect("/error");
        }
    }

    public function middleware(array $middlewares)
    {
        $this->routes_list[$this->current_method][$this->current_route]['middlewares']=$middlewares;
        return $this;
    }
}

?>