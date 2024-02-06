<?php 

use app\classes\Routes;

$route=new Routes();
$route->addget('/','LoginController@index');
$route->addPost('/login','LoginController@login');
$route->addGet('/home','HomeController@index')->middleware(['Auth@verify']);
$route->addGet('/cadastro/{tipo}','CadastroController@index')->middleware(['Auth@verify','Auth@verifyAccess']);
$route->addGet('/error','ErrorController@index');
$route->addGet('/lista/{tipo}','ListaController@index')->middleware(['Auth@verify']);
$route->addGet('/lista/{tipo}/valores','ListaController@getTableValues');
$route->addDelete('/deletar/{tipo}/{id}','ListaController@delete')->middleware(['Auth@verify']);
$route->addGet('/editar/{tipo}/{id}','ListaController@edit')->middleware(['Auth@verify']);
$route->addPost('/cadastro/{tipo}/salvar','CadastroController@save');
$route->addPut('/editar/{tipo}/{id}/salvar','ListaController@save');
$route->dispatch();

?>