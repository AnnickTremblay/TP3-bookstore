<?php
// Modèle de la table user.
namespace App\Models;
use App\Models\CRUD;

class User extends CRUD {
    protected $table = "user";
    protected $primaryKey = "id";
    protected $fillable = ['name', 'username', 'password', 'email', 'privilege_id'];

    // Hache le mot de passe avec BCRYPT (coût 10 par défaut).
    public function hashPassword($password, $cost = 10) {
        $options = ['cost' => $cost];
        return password_hash($password, PASSWORD_BCRYPT, $options);
    }

    // Vérifie le login.
    public function checkUser($username, $password) {
        // 1) Cherche l'utilisateur avec son username.
        $user = $this->unique('username', $username);
        if($user){
            // 2) Compare le mot de passe tapé avec celui de la base.
            if(password_verify($password, $user['password'])){
                // 3) Change l'identifiant de session.
                session_regenerate_id();
                // 4) Garde la personne en mémoire pour les autres pages.
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['username'] = $user['username'];   // pour le journal
                $_SESSION['privilege_id'] = $user['privilege_id'];
                // Empreinte du navigateur et de l'adresse IP.
                $_SESSION['fingerPrint'] = md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']);
                // Pour afficher Welcome seulement à la première page après la connexion.
                $_SESSION['welcome'] = true;
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}