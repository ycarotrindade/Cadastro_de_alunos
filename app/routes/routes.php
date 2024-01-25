<?php 

use app\classes\Routes;

$route=new Routes();
$route->add('GET','/','LoginController@index');
$route->add('POST','/login','LoginController@login');
$route->add('GET','/home','HomeController@index')->middleware(['Auth@verify']);
$route->add('GET','/cadastro/{tipo}','CadastroController@index')->middleware(['Auth@verify','Auth@verifyAccess']);
$route->add('GET','/error','ErrorController@index');
$route->add('GET','/lista/{tipo}','ListaController@index')->middleware(['Auth@verify']);
$route->add('GET','/deletar/{tipo}/{id}','ListaController@delete')->middleware(['Auth@verify']);
$route->add('GET','/editar/{tipo}/{id}','ListaController@edit')->middleware(['Auth@verify']);
$route->add('POST','/cadastro/{tipo}/salvar','CadastroController@save');
$route->add('POST','/editar/{tipo}/{id}/salvar','ListaController@save');
$route->dispatch();

?>