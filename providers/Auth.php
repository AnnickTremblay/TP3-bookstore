<?php
// providers/Auth.php : contrôle d'accès du site.
namespace App\Providers;
use App\Providers\View;

class Auth {
    // Vérifie que la personne est connectée (empreinte de session valide).
    static public function session(){
        if(isset($_SESSION['fingerPrint']) and $_SESSION['fingerPrint'] == md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR'])){
            return TRUE;
        } else {
            View::redirect('login');
            exit();
        }
    }

    // Vérifie le rôle de la personne connectée (1 = Admin).
    static public function privilege($id) {
        if($_SESSION['privilege_id'] == $id) {
            return TRUE;
        } else {
            View::redirect('login');
            exit();
        }
    }
}