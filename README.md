# Bookstore MVC

TP3 — Programmation Web avancée (582-31B-MA)
Annick Tremblay — Collège de Maisonneuve

Librairie en PHP orienté objet (MVC) avec MySQL et Twig, à laquelle on ajoute une connexion, des rôles (administrateur et client), un journal de bord et l'export de la liste des livres en PDF.

## Compte de démonstration

Client (privilège 2)
- username : client@test.com
- mot de passe : XUxH6HODVJ

## Les tables

- `author` — les auteurs
- `book` — les livres, avec une clé étrangère vers `author`
- `client` — les clients
- `sale` — les ventes, qui relient un client et un livre
- `privilege` — les rôles (Admin et Client)
- `user` — les utilisateurs, avec un mot de passe haché et une clé étrangère vers `privilege`
- `journal` — les visites du site (IP, date et heure, utilisateur, page)

## Les dossiers

- `models` — `CRUD` et un modèle par table
- `views` — les vues Twig
- `controllers` — `HomeController`, `BookController`, `UserController`, `AuthController` et `JournalController`
- `routes` — `Route` et `web.php`
- `providers` — `View`, `Validator` et `Auth`

## Les fonctionnalités

- Connexion et déconnexion, avec mot de passe haché (BCRYPT) et session sécurisée.
- Contrôle d'accès selon le rôle, même en tapant l'adresse dans le navigateur :
  - Visiteur : accueil, statistiques et connexion.
  - Client : liste des livres, détail d'un livre et PDF.
  - Administrateur : tout, y compris l'ajout, la modification et la suppression de livres, l'ajout d'utilisateurs et le journal de bord.
- Journal de bord : chaque visite est enregistrée (visible seulement par l'administrateur).
- Nouvelle fonctionnalité : export de la liste des livres en PDF avec Dompdf (bouton « Download PDF » sur la page des livres).
- Validation des formulaires.

## Installation

1. Importer `sql/bookstore.sql` dans MySQL.
2. Mettre les informations de la base dans `models/CRUD.php`.
3. Lancer `composer install`.
4. Lancer `php -S localhost:8000 router.php`.