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
            echo "<script>
            alert('Você não tem permissão para realizar essa ação')
            </script>
            ";
        }
    }
}
?>