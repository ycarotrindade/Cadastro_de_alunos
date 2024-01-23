<?php 

session_start();
require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../config.php';
use app\classes\Routes;

$route=new Routes();
$route->add('GET','/','LoginController@index');
$route->add('POST','/login','LoginController@login');
$route->add('GET','/home','HomeController@index');
$route->add('GET','/cadastro/{tipo}','CadastroController@index');
$route->add('GET','/error','ErrorController@index');
$route->add('GET','/lista/{tipo}','ListaController@index');
$route->add('GET','/deletar/{tipo}/{id}','ListaController@delete');
$route->add('GET','/editar/{tipo}/{id}','ListaController@edit');
$route->add('POST','/cadastro/{tipo}/salvar','CadastroController@save');
$route->add('POST','/editar/{tipo}/{id}/salvar','ListaController@save');
$route->dispatch();


?>