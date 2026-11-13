{# Vue du PDF : liste des livres (reçoit la variable books de BookController::pdf). #}

<h1>Books</h1>
<table border="1" cellpadding="6" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Title</th>
            <th>ISBN</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        {# Répète une ligne du tableau pour chaque livre. #}
        {% for book in books %}
        <tr>
            <td>{{ book.title }}</td>
            <td>{{ book.isbn }}</td>
            <td>{{ book.price }} $</td>
        </tr>
        {% endfor %}
    </tbody>
</table>