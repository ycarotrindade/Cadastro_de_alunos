<?php 

#lista onde armazenaremos as rotas e os métodos usados

return [
    'GET'=>[
        '/'=>'LoginController@index',
        '/error'=>'ErrorController@index',
        '/cadastro/{tipo}'=>'CadastroController@index',
        '/home'=>['controller'=>'HomeController@index','middleware'=>'Auth@verify'],
        '/lista/{tipo}'=>'ListaController@index',
        '/deletar/{tipo}/{id}'=>'ListaController@delete',
        '/editar/{tipo}/{id}'=>'ListaController@edit'
    ],
    'POST'=>[
        '/login'=>'LoginController@login',
        '/cadastro/{tipo}/salvar'=>'CadastroController@save',
        '/editar/{tipo}/{id}/salvar'=>'ListaController@save'
    ]
]

?>