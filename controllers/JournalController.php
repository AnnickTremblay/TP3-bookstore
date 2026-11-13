<?php
// Contrôleur de la page du journal de bord (réservée à l'admin).
namespace App\Controllers;

// Importe le modèle, la classe View et la classe Auth.
use App\Models\Journal;
use App\Providers\View;
use App\Providers\Auth;

class JournalController {
    // Le constructeur s'exécute avant toute méthode : seulement l'admin peut voir le journal.
    public function __construct() {
        Auth::session();
        Auth::privilege(1);
    }

    // Affiche toutes les visites, de la plus récente à la plus ancienne.
    public function index() {
        $journal = new Journal;
        $journals = $journal->select('id', 'DESC');

        return View::render('journal/index', ['journals' => $journals]);
    }

}