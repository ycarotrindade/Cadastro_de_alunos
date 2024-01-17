<?php 

declare(strict_types=1);
namespace app\controllers;


class HomeController
{
    public function index()
    {
        view('template',[
            'title'=>'home'
        ]);
    }
}

?>