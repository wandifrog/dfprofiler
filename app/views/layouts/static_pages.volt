{% if title is defined %}
<div class="page-title">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">{{ title }}</div>
    </div>
  </div>
</div>
{% endif %}
<div class="container main">
  <div class="row">
    <div class="col-sm-12">
      {{ partial('partials/top-banner') }}
      {{ content() }}
    </div>
  </div>
</div>