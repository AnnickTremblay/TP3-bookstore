{# Haut de page commun à toutes les vues (inclus avec {{ include('layouts/header.php', {title: '...'}) }}). #}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {# asset : chemin du dossier public (défini dans config.php). #}
    <link rel="stylesheet" href="{{ asset }}/css/style.css">
    {# title : le titre envoyé par chaque vue. #}
    <title>{{ title }}</title>
</head>
<body>
    <header>
        {# Menu de navigation (base : début des adresses, défini dans config.php). #}
        <nav>
            <ul>
                <li><a class="{% if page == 'home' %}active{% endif %}" href="{{ base }}/">Home</a></li>
                {# Les livres : seulement pour une personne connectée. #}
                {% if guest is empty %}
                    <li><a class="{% if page == 'books' %}active{% endif %}" href="{{ base }}/books">Books</a></li>
                {% endif %}
                <li><a class="{% if page == 'stats' %}active{% endif %}" href="{{ base }}/stats">Statistics</a></li>
                {# Liens réservés à l'admin (privilège 1). #}
                {% if session.privilege_id == 1 %}
                    <li><a class="{% if page == 'users' %}active{% endif %}" href="{{ base }}/user/create">Users</a></li>
                    <li><a class="{% if page == 'journal' %}active{% endif %}" href="{{ base }}/journal">Journal</a></li>
                {% endif %}
                {# Login pour un visiteur, Logout pour une personne connectée. #}
                {% if guest %}
                    <li><a class="{% if page == 'login' %}active{% endif %}" href="{{ base }}/login">Login</a></li>
                {% else %}
                    <li><a href="{{ base }}/logout">Logout</a></li>
                {% endif %}
            </ul>
        </nav>
    </header>
    <main class="container">
        {# Welcome à la première page après la connexion, Logged in as ensuite. #}
        {% if guest is empty %}
            {% if welcome %}
                <p>Welcome {{ session.user_name }}!</p>
            {% else %}
                <p>Logged in as {{ session.user_name }}</p>
            {% endif %}
        {% endif %}
