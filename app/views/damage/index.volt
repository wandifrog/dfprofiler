<div class="table-responsive">
  <table class="table table-striped table-hover table-bordered datatable" data-page-length="25">
    <thead>
      <tr>
        <th>Weapon</th>
        <th>Base Damage</th>
        <th>Critical Damage</th>
      </tr>
    </thead>
    <tbody>
      {% for weapon in weapons %}
        <tr>
          <td data-order="{{ weapon.name }}">{{ weapon.name }}</td>
          <td data-order="{{ weapon.damage }}">{{ weapon.damage }}</td>
          <td data-order="{{ weapon.critical }}">{{ weapon.critical }}</td>
        </tr>
      {% elsefor %}
        <tr>
          <td scope="row" colspan="3">Nothing found...</td>
        </tr>
      {% endfor %}
    </tbody>
    <tfoot>
      <tr>
        <th>Weapon</th>
        <th>Base Damage</th>
        <th>Critical Damage</th>
      </tr>
    </tfoot>
  </table>
</div>