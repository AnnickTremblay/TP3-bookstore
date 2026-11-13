<?php
// Modèle de la table journal.
namespace App\Models;

use App\Models\CRUD;

class Journal extends CRUD {
    protected $table = "journal";
    protected $primaryKey = "id";
    protected $fillable = ['ip','username', 'page'];
}