<?php 

#lista onde armazenaremos as rotas e os métodos usados

return [
    'GET'=>[
        '/'=>'LoginController@index',
        '/error'=>'ErrorController@index',
        '/cadastro/{tipo}'=>'CadastroController@index',
        '/home'=>'HomeController@index'
    ],
    'POST'=>[
        '/login'=>'LoginController@login',
        '/cadastro/{tipo}/salvar'=>'CadastroController@save'
    ]
]

?>