<?php 

#lista onde armazenaremos as rotas e os métodos usados

return [
    'GET'=>[
        '/'=>'LoginController@index',
        '/error'=>'ErrorController@index',
        '/cadastro/{tipo}'=>'CadastroController@index'
    ],
    'POST'=>[
        '/login'=>'LoginController@login'
    ]
]

?>