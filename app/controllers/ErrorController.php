<?php 

namespace app\controllers;

class ErrorController
{
    public function index()
    {
        view('error',[
            'title'=>'Error',
            'error'=>''
        ]);
    }
}

?>