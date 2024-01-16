<?php 

#lista onde armazenaremos as rotas e os métodos usados

return [
    'GET'=>[
        '/'=>'LoginController@index',
        '/Error'=>'ErrorController@index'
    ],
    'POST'=>[
        '/Login'=>'LoginController@login'
    ]
]

?>