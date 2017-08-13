{% set title = 'Clans Overview' %}

<div class="row">
  <div class="col-md-6">
    <div class="panel panel-default panel-records">
      <div class="panel-heading">
        <h3 class="panel-title text-center">Top Survivor</h3>
      </div>
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
              <th>#</th>
              <th>Clan</th>
              <th>Record</th>
            </thead>
            <tbody>
              {% for index, clan in clan_top_survivor %}
                <tr>
                  <td scope="row">{{ index + 1 }}</td>
                  <td>{{ link_to('clan/view/' ~ clan.clan_id, clan.clan_name) }}</td>
                  <td>{{ clan.clan_weekly_ts|number_format }}</td>
                </tr>
              {% elsefor %}
                <tr>
                  <td scope="row" colspan="3">Nothing found...</td>
                </tr>
              {% endfor %}
            </tbody>
          </table>
        </div>
      </div>
      {% if clan_top_survivor is iterable and (clan_top_survivor|length > 0) %}
        <div class="panel-footer">{{ link_to('clan/weekly-ts', 'More &rsaquo;') }}</div>
      {% endif %}
    </div>
  </div>
  <div class="col-md-6">
    <div class="panel panel-default panel-records">
      <div class="panel-heading">
        <h3 class="panel-title text-center">Top Player Killer</h3>
      </div>
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
              <th>#</th>
              <th>Clan</th>
              <th>Record</th>
            </thead>
            <tbody>
              {% for index, clan in clan_top_player_killer %}
                <tr>
                  <td scope="row">{{ index + 1 }}</td>
                  <td>{{ link_to('clan/view/' ~ clan.clan_id, clan.clan_name) }}</td>
                  <td>{{ clan.clan_weekly_tpk|number_format }}</td>
                </tr>
              {% elsefor %}
                <tr>
                  <td scope="row" colspan="3">Nothing found...</td>
                </tr>
              {% endfor %}
            </tbody>
          </table>
        </div>
      </div>
      {% if clan_top_player_killer is iterable and (clan_top_player_killer|length > 0) %}
        <div class="panel-footer">{{ link_to('clan/weekly-tpk', 'More &rsaquo;') }}</div>
      {% endif %}
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="panel panel-default panel-records">
      <div class="panel-heading">
        <h3 class="panel-title text-center">All Time TS</h3>
      </div>
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
              <th>#</th>
              <th>Clan</th>
              <th>Record</th>
            </thead>
            <tbody>
              {% for index, clan in clan_all_time_ts %}
                <tr>
                  <td scope="row">{{ index + 1 }}</td>
                  <td>{{ link_to('clan/view/' ~ clan.clan_id, clan.clan_name) }}</td>
                  <td>{{ clan.clan_all_time_ts|number_format }}</td>
                </tr>
              {% elsefor %}
                <tr>
                  <td scope="row" colspan="3">Nothing found...</td>
                </tr>
              {% endfor %}
            </tbody>
          </table>
        </div>
      </div>
      {% if clan_all_time_ts is iterable and (clan_all_time_ts|length > 0) %}
        <div class="panel-footer">{{ link_to('clan/all-time-ts', 'More &rsaquo;') }}</div>
      {% endif %}
    </div>
  </div>
  <div class="col-md-6">
    <div class="panel panel-default panel-records">
      <div class="panel-heading">
        <h3 class="panel-title text-center">All Time TPK</h3>
      </div>
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
              <th>#</th>
              <th>Clan</th>
              <th>Record</th>
            </thead>
            <tbody>
              {% for index, clan in clan_all_time_tpk %}
                <tr>
                  <td scope="row">{{ index + 1 }}</td>
                  <td>{{ link_to('clan/view/' ~ clan.clan_id, clan.clan_name) }}</td>
                  <td>{{ clan.clan_all_time_tpk|number_format }}</td>
                </tr>
              {% elsefor %}
                <tr>
                  <td scope="row" colspan="3">Nothing found...</td>
                </tr>
              {% endfor %}
            </tbody>
          </table>
        </div>
      </div>
      {% if clan_all_time_tpk is iterable and (clan_all_time_tpk|length > 0) %}
        <div class="panel-footer">{{ link_to('clan/all-time-tpk', 'More &rsaquo;') }}</div>
      {% endif %}
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="panel panel-default panel-records">
      <div class="panel-heading">
        <h3 class="panel-title text-center">Top Strongest</h3>
      </div>
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
              <th>#</th>
              <th>Clan</th>
              <th>Record</th>
            </thead>
            <tbody>
              {% for index, clan in clan_top_strongest %}
                <tr>
                  <td scope="row">{{ index + 1 }}</td>
                  <td>{{ link_to('clan/view/' ~ clan.clan_id, clan.clan_name) }}</td>
                  <td>{{ clan.clan_total_exp|number_format }}</td>
                </tr>
              {% elsefor %}
                <tr>
                  <td scope="row" colspan="3">Nothing found...</td>
                </tr>
              {% endfor %}
            </tbody>
          </table>
        </div>
      </div>
      {% if clan_top_strongest is iterable and (clan_top_strongest|length > 0) %}
        <div class="panel-footer">{{ link_to('clan/top-strongest', 'More &rsaquo;') }}</div>
      {% endif %}
    </div>
  </div>
  <div class="col-md-6">
    <div class="panel panel-default panel-records">
      <div class="panel-heading">
        <h3 class="panel-title text-center">Top Richest</h3>
      </div>
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
              <th>#</th>
              <th>Clan</th>
              <th>Money</th>
            </thead>
            <tbody>
              {% for index, clan in clan_top_richest %}
                <tr>
                  <td scope="row">{{ index + 1 }}</td>
                  <td>{{ link_to('clan/view/' ~ clan.clan_id, clan.clan_name) }}</td>
                  <td>$ {{ clan.clan_money|number_format }}</td>
                </tr>
              {% elsefor %}
                <tr>
                  <td scope="row" colspan="3">Nothing found...</td>
                </tr>
              {% endfor %}
            </tbody>
          </table>
        </div>
      </div>
      {% if clan_top_richest is iterable and (clan_top_richest|length > 0) %}
        <div class="panel-footer">{{ link_to('clan/top-richest', 'More &rsaquo;') }}</div>
      {% endif %}
    </div>
  </div>
</div>