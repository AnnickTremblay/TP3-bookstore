{# Formulaire de connexion (affiche aussi les erreurs de validation). #}

{{ include('layouts/header.php', {title: 'Login', page: 'login'}) }}

        <h1>Login</h1>
        <form method="POST">
            <label>username
                <input type="email" name="username" value="{{user.username}}">
            </label>
            {% if errors.username is defined %}
                <span class="error">{{ errors.username }}</span>
            {% endif %}
            <label>Password
                <input type="password" name="password">
            </label>
            {% if errors.password is defined %}
                <span class="error">{{ errors.password }}</span>
            {% endif %}
            {# message : erreur si le username ou le mot de passe est mauvais. #}
            {% if errors.message is defined %}
                <span class="error">{{ errors.message }}</span>
            {% endif %}

            <input type="submit" value="Login" class="btn">
        </form>

{{ include('layouts/footer.php') }}