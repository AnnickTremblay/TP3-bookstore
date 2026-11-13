<?php
// Contrôleur de la page de création d'un utilisateur.
namespace App\Controllers;

// Importe les modèles, la classe View et le Validator.
use App\Models\User;
use App\Models\Privilege;
use App\Providers\View;
use App\Providers\Validator;
use App\Providers\Auth;


class UserController {

    // Le constructeur s'exécute avant toute méthode : protège tout le contrôleur.
    public function __construct() {
        Auth::session();
        Auth::privilege(1);

    }

    // Affiche le formulaire d'un utilisateur avec ses rôles.
    public function create() {
        $privilege = new Privilege;
        $privileges = $privilege->select('privilege');

        return View::render('user/create', ['privileges' => $privileges]);
    }

    // Reçoit le formulaire ($data = ce qui a été tapé).
    public function store($data = []) {
        // 1) Vérification de chaque champ.
        $validator = new Validator;
        $validator->field('name', $data['name'])->min(2)->max(50);
        $validator->field('username', $data['username'])->unique('User')->email()->min(2)->max(50);
        $validator->field('password', $data['password'])->min(6)->max(20);
        $validator->field('email', $data['email'])->unique('User')->required()->email()->max(100);
        $validator->field('privilege_id', $data['privilege_id'])->required()->int();

        if($validator->isSuccess()) {
            // 2) Hachage du mot de passe.
            $user = new User;
            $data['password'] = $user->hashPassword($data['password']);
            // 3) Insertion des données du formulaire.
            $insert = $user->insert($data);
            if($insert) {
                // 4) Réaffiche le formulaire vide avec un message de confirmation.
                $privilege = new Privilege;
                $privileges = $privilege->select('privilege');

                return View::render('user/create', ['success' => 'User created successfully!', 'privileges' => $privileges]);
            } else {
                return View::render('error', ['msg' => 'Unable to save the user.']);
            }
        } else {
            // Erreurs : réaffiche le formulaire avec les erreurs et ce qui a été saisi.
            $errors = $validator->getErrors();
            $privilege = new Privilege;
            $privileges = $privilege->select('privilege');

            return View::render('user/create', ['errors' => $errors, 'user' => $data, 'privileges' => $privileges]);
        }
    }
}
