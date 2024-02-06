<?php 

declare(strict_types=1);
namespace app\middlewares;

class Auth
{
    public function verify()
    {
        if($_SESSION['user']==null)
        {
            redirect('/');
        }
    }

    public function verifyAccess()
    {
        if($_SESSION['access']!='admin')
        {
            view('error',[
                'title'=> 'erro',
                'error'=> 'Você não tem permissão para realizar essa ação'
            ]);
            die;
        }
    }
}
?>