<h1>Orders</h1>

<?php

{% if orders|length > 0 %}
 {% for item in orders %}
            <li><a >{{ item.title }}</a></li>
        {% endfor %}
        </ul>
{% endif %}