<?php
// Contrôleur de la connexion et de la déconnexion.
namespace App\Controllers;

// Importe le modèle, la classe View et le Validator.
use App\Models\User;
use App\Providers\View;
use App\Providers\Validator;


class AuthController {

    // Affiche le formulaire de connexion.
    public function index() {
        return View::render('auth/index');
    }

    // Reçoit le formulaire de connexion.
    public function store($data) {
        // 1) Vérification de chaque champ.
        $validator = new Validator;
        $validator->field('username', $data['username'])->required()->email()->min(2)->max(50);
        $validator->field('password', $data['password'])->required()->min(6)->max(20);

        if ($validator->isSuccess()) {
            $user = new User();
            $checkUser = $user->checkUser($data['username'], $data['password']);
            if($checkUser) {
                // Connecté : redirige à la liste des livres.
                return View::redirect('books');
            } else {
                $errors['message'] = 'Please check your credentials!';

                return View::render('auth/index', ['errors' => $errors, 'user' => $data]);
            }
        } else {
            $errors = $validator->getErrors();

            return View::render('auth/index', ['errors' => $errors, 'user' => $data]);
        }
    }

    // Déconnexion : détruit la session puis retourne au login.
    public function delete() {
        session_destroy();

        return View::redirect('login');
    }
}
