<?php
// Point d'entrée unique du site (toutes les adresses arrivent ici grâce au .htaccess).
session_start();

// Charge l'autoload de Composer (plus besoin de require pour chaque classe).
require_once 'vendor/autoload.php';

// Charge les constantes BASE et ASSET.
require_once 'config.php';

// Importe le modèle du journal.
use App\Models\Journal;

// Note la visite dans le journal (Visitor si la personne n'est pas connectée).
$journal = new Journal;
$journal->insert([
    'ip' => $_SERVER['REMOTE_ADDR'],
    'username' => $_SESSION['username'] ?? 'Visitor',
    'page' => $_SERVER['REQUEST_URI']
]);

// Charge la liste des routes (Route::dispatch() est appelé dans ce fichier).
require_once 'routes/web.php';