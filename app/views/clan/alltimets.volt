<div class="table-responsive">
  <table class="table table-striped table-hover table-bordered datatable" data-page-length="25">
    <thead>
      <tr>
        <th data-orderable="false" width="5">#</th>
        <th data-orderable="false">Clan</th>
        <th>Record</th>
      </tr>
    </thead>
    <tbody>
      {% for index, result in results %}
        <tr>
          <td>{{ index + 1 }}</td>
          <td data-search="{{ result.clan_name }}">
            {{ link_to('clan/view/' ~ result.clan_id, result.clan_name) }}
          </td>
          <td data-order="{{ result.clan_all_time_ts }}">{{ result.clan_all_time_ts|number_format }}</td>
        </tr>
      {% elsefor %}
        <tr>
          <td scope="row" colspan="3">Nothing found...</td>
        </tr>
      {% endfor %}
    </tbody>
    <tfoot>
      <tr>
        <th>#</th>
        <th>Clan</th>
        <th>Record</th>
      </tr>
    </tfoot>
  </table>
</div>