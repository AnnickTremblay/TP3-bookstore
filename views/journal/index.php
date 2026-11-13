{# Journal de bord (reçoit la variable journals de JournalController::index). #}

{{ include('layouts/header.php', {title: 'Journal', page: 'journal'}) }}

        <h1>Journal</h1>
        <table>
            <thead>
                <tr>
                    <th>IP</th>
                    <th>Date</th>
                    <th>User</th>
                    <th>Page</th>
                </tr>
            </thead>
            <tbody>
                {# Répète une ligne du tableau pour chaque visite. #}
                {% for journal in journals %}
                <tr>
                    <td>{{ journal.ip }}</td>
                    <td>{{ journal.visit_date }}</td>
                    <td>{{ journal.username }}</td>
                    <td>{{ journal.page }}</td>
                </tr>
                {% endfor %}
            </tbody>
        </table>

{{ include('layouts/footer.php') }}