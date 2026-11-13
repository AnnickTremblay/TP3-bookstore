{# Détail d'un livre (reçoit la variable book de BookController::show). #}

{{ include('layouts/header.php', {title: 'Book', page: 'books'}) }}

        <h1>Book Show</h1>

        <div class="fiche">
            <p><strong>Title: </strong>{{ book.title }}</p>
            <p><strong>ISBN: </strong>{{ book.isbn }}</p>
            <p><strong>Description: </strong>{{ book.description }}</p>
            <p><strong>Price: </strong>{{ book.price }} $</p>
            {# author_name est ajouté par le contrôleur. #}
            <p><strong>Author: </strong>{{ book.author_name }}</p>
        </div>

        <div class="actions">
            {# Edit et Delete : seulement pour l'admin (privilège 1). #}
            {% if session.privilege_id == 1 %}
                {# Lien vers la modification du livre (exemple: /book/edit?id=3). #}
                <a href="{{base}}/book/edit?id={{book.id}}" class="btn">Edit</a>

                {# Delete : petit formulaire en POST qui envoie l'id (champ caché). #}
                <form action="{{base}}/book/delete" method="post" onsubmit="return confirm('Warning: this will delete the book permanently. Continue?');">
                    <input type="hidden" name="id" value="{{ book.id }}">
                    <input type="submit" class="btn red" value="Delete">
                </form>
            {% endif %}

            <a href="{{base}}/books" class="btn outline">Back</a>
        </div>

{{ include('layouts/footer.php') }}