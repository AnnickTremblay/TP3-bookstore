<?php
// Modèle de la table privilege.
namespace App\Models;
use App\Models\CRUD;

// Sert à afficher la liste des rôles dans le formulaire d'ajout d'un utilisateur.
class Privilege extends CRUD {
    protected $table = "privilege";
    protected $primaryKey = "id";
}