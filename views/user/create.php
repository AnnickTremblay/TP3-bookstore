{# Formulaire d'inscription d'un utilisateur (affiche aussi les erreurs de validation). #}

{{ include('layouts/header.php', {title: 'Add a user', page: 'users'}) }}

        <h1>Add a user</h1>
        {# success : message de confirmation envoyé par UserController::store. #}
        {% if success is defined %}
            <p class="success">{{ success }}</p>
        {% endif %}
        <form method="POST">
            <label>Name
                <input type="text" name="name" value="{{user.name}}">
            </label>
            {% if errors.name is defined %}
                <span class="error">{{ errors.name }}</span>
            {% endif %}
            <label>Username
                <input type="text" name="username" value="{{user.username}}">
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
            <label>email
                <input type="email" name="email" value="{{user.email}}">
            </label>
            {% if errors.email is defined %}
                <span class="error">{{ errors.email }}</span>
            {% endif %}
            <label>Privilege
                <select name="privilege_id">
                    <option value="">Select a privilege</option>
                    {% for privilege in privileges %}
                        {# selected : seulement pour le privilège déjà choisi. #}
                        <option value="{{ privilege.id }}" {% if privilege.id == user.privilege_id %}selected{% endif %}>{{ privilege.privilege }}</option>
                    {% endfor %}
                </select>
            </label>
            {% if errors.privilege_id is defined %}
                <span class="error">{{ errors.privilege_id }}</span>
            {% endif %}

            <input type="submit" value="Save" class="btn">
        </form>

{{ include('layouts/footer.php') }}