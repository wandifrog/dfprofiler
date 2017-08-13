<footer>
Your Copyright Message &copy; 2017 All Rights Reserved. <br>
This site is not affiliated with or endorsed by Dead Frontier Online Zombie MMO.
</footer>
{% if profile_id is defined %}
  <script type="text/javascript">
    var profile_id = {{ profile_id }};
  </script>
{% endif %}
{% if id_list is defined %}
  <script type="text/javascript">
    var id_list = "{{ id_list }}";
  </script>
{% endif %}
{{ assets.outputJs() }}
{% if js is iterable %}
  {% for script in js %}
    {{ script }}
  {% endfor %}
{% else %}
  {{ js }}
{% endif %}

<!-- here you can add a google analytics code -->
