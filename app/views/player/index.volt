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
              <th>Username</th>
              <th>Level</th>
              <th>Profession</th>
              <th>Record</th>
            </thead>
            <tbody>
              {% for index, player in top_survivor %}
                <tr>
                  <td scope="row">{{ index + 1 }}</td>
                  <td>{{ link_to('profile/view/' ~ player.player_id, player.username) }}</td>
                  <td>{{ player.level }}</td>
                  <td>{{ player.profession }}</td>
                  <td>{{ player.weekly_ts|number_format }}</td>
                </tr>
              {% elsefor %}
                <tr>
                  <td scope="row" colspan="5">Nothing found...</td>
                </tr>
              {% endfor %}
            </tbody>
          </table>
        </div>
      </div>
      {% if top_survivor is iterable and (top_survivor|length > 0) %}
        <div class="panel-footer">{{ link_to('player/weekly-ts', 'More &rsaquo;') }}</div>
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
              <th>Username</th>
              <th>Level</th>
              <th>Profession</th>
              <th>Record</th>
            </thead>
            <tbody>
              {% for index, player in top_player_killer %}
                <tr>
                  <td scope="row">{{ index + 1 }}</td>
                  <td>{{ link_to('profile/view/' ~ player.player_id, player.username) }}</td>
                  <td>{{ player.level }}</td>
                  <td>{{ player.profession }}</td>
                  <td>{{ player.weekly_tpk|number_format }}</td>
                </tr>
              {% elsefor %}
                <tr>
                  <td scope="row" colspan="5">Nothing found...</td>
                </tr>
              {% endfor %}
            </tbody>
          </table>
        </div>
      </div>
      {% if top_player_killer is iterable and (top_player_killer|length > 0) %}
        <div class="panel-footer">{{ link_to('player/weekly-tpk', 'More &rsaquo;') }}</div>
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
              <th>Username</th>
              <th>Level</th>
              <th>Profession</th>
              <th>Record</th>
            </thead>
            <tbody>
              {% for index, player in all_time_ts %}
                <tr>
                  <td scope="row">{{ index + 1 }}</td>
                  <td>{{ link_to('profile/view/' ~ player.player_id, player.username) }}</td>
                  <td>{{ player.level }}</td>
                  <td>{{ player.profession }}</td>
                  <td>{{ player.all_time_ts|number_format }}</td>
                </tr>
              {% elsefor %}
                <tr>
                  <td scope="row" colspan="5">Nothing found...</td>
                </tr>
              {% endfor %}
            </tbody>
          </table>
        </div>
      </div>
      {% if all_time_ts is iterable and (all_time_ts|length > 0) %}
        <div class="panel-footer">{{ link_to('player/all-time-ts', 'More &rsaquo;') }}</div>
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
              <th>Username</th>
              <th>Level</th>
              <th>Profession</th>
              <th>Record</th>
            </thead>
            <tbody>
              {% for index, player in all_time_tpk %}
                <tr>
                  <td scope="row">{{ index + 1 }}</td>
                  <td>{{ link_to('profile/view/' ~ player.player_id, player.username) }}</td>
                  <td>{{ player.level }}</td>
                  <td>{{ player.profession }}</td>
                  <td>{{ player.all_time_tpk|number_format }}</td>
                </tr>
              {% elsefor %}
                <tr>
                  <td scope="row" colspan="5">Nothing found...</td>
                </tr>
              {% endfor %}
            </tbody>
          </table>
        </div>
      </div>
      {% if all_time_tpk is iterable and (all_time_tpk|length > 0) %}
        <div class="panel-footer">{{ link_to('player/all-time-tpk', 'More &rsaquo;') }}</div>
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
              <th>Username</th>
              <th>Level</th>
              <th>Profession</th>
              <th>Record</th>
            </thead>
            <tbody>
              {% for index, player in top_strongest %}
                <tr>
                  <td scope="row">{{ index + 1 }}</td>
                  <td>{{ link_to('profile/view/' ~ player.player_id, player.username) }}</td>
                  <td>{{ player.level }}</td>
                  <td>{{ player.profession }}</td>
                  <td>{{ player.total_exp|number_format }}</td>
                </tr>
              {% elsefor %}
                <tr>
                  <td scope="row" colspan="5">Nothing found...</td>
                </tr>
              {% endfor %}
            </tbody>
          </table>
        </div>
      </div>
      {% if top_strongest is iterable and (top_strongest|length > 0) %}
        <div class="panel-footer">{{ link_to('player/top-strongest', 'More &rsaquo;') }}</div>
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
              <th>Username</th>
              <th>Level</th>
              <th>Profession</th>
              <th>Money</th>
            </thead>
            <tbody>
              {% for index, player in top_richest %}
                <tr>
                  <td scope="row">{{ index + 1 }}</td>
                  <td>{{ link_to('profile/view/' ~ player.player_id, player.username) }}</td>
                  <td>{{ player.level }}</td>
                  <td>{{ player.profession }}</td>
                  <td>$ {{ player.money|number_format }}</td>
                </tr>
              {% elsefor %}
                <tr>
                  <td scope="row" colspan="5">Nothing found...</td>
                </tr>
              {% endfor %}
            </tbody>
          </table>
        </div>
      </div>
      {% if top_richest is iterable and (top_richest|length > 0) %}
        <div class="panel-footer">{{ link_to('player/top-richest', 'More &rsaquo;') }}</div>
      {% endif %}
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="panel panel-default panel-records">
      <div class="panel-heading">
        <h3 class="panel-title text-center">Top Hardcore</h3>
      </div>
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
              <th>#</th>
              <th>Username</th>
              <th>Level</th>
              <th>Profession</th>
              <th>Record</th>
            </thead>
            <tbody>
              {% for index, player in top_hardcore %}
                <tr>
                  <td scope="row">{{ index + 1 }}</td>
                  <td>{{ link_to('profile/view/' ~ player.player_id, player.username) }}</td>
                  <td>{{ player.level }}</td>
                  <td>{{ player.profession }}</td>
                  <td>{{ player.total_exp|number_format }}</td>
                </tr>
              {% elsefor %}
                <tr>
                  <td scope="row" colspan="5">Nothing found...</td>
                </tr>
              {% endfor %}
            </tbody>
          </table>
        </div>
      </div>
      {% if top_hardcore is iterable and (top_hardcore|length > 0) %}
        <div class="panel-footer">{{ link_to('player/top-hardcore', 'More &rsaquo;') }}</div>
      {% endif %}
    </div>
  </div>
  <div class="col-md-6">
    <div class="panel panel-default panel-records">
      <div class="panel-heading">
        <h3 class="panel-title text-center">Level 325</h3>
      </div>
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
              <th>#</th>
              <th>Username</th>
              <th>Profession</th>
              <th>Total Exp</th>
              <th>AT TS</th>
              <th>AT TPK</th>
            </thead>
            <tbody>
              {% for index, player in level_325 %}
                <tr>
                  <td scope="row">{{ index + 1 }}</td>
                  <td>{{ link_to('profile/view/' ~ player.player_id, player.username) }}</td>
                  <td>{{ player.profession }}</td>
                  <td>{{ player.total_exp|number_format }}</td>
                  <td>{{ player.all_time_ts|number_format }}</td>
                  <td>{{ player.all_time_tpk|number_format }}</td>
                </tr>
              {% elsefor %}
                <tr>
                  <td scope="row" colspan="5">Nothing found...</td>
                </tr>
              {% endfor %}
            </tbody>
          </table>
        </div>
      </div>
      {% if level_325 is iterable and (level_325|length > 0) %}
        <div class="panel-footer">{{ link_to('player/level-325', 'More &rsaquo;') }}</div>
      {% endif %}
    </div>
  </div>
</div>

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
              <th>Username</th>
              <th>Level</th>
              <th>Record</th>
            </thead>
            <tbody>
              {% for index, player in ts_winners %}
                <tr>
                  <td scope="row">{{ index + 1 }}</td>
                  <td>{{ link_to('profile/view/' ~ player.p.player_id, player.p.username) }}</td>
                  <td>{{ player.d.level }}</td>
                  <td>{{ player.d.record|number_format }}</td>
                </tr>
              {% elsefor %}
                <tr>
                  <td scope="row" colspan="5">Nothing found...</td>
                </tr>
              {% endfor %}
            </tbody>
          </table>
        </div>
      </div>
      {% if ts_winners is iterable and (ts_winners|length > 0) %}
        <div class="panel-footer">{{ link_to('player/dusk-winners', 'More &rsaquo;') }}</div>
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
              <th>Username</th>
              <th>Level</th>
              <th>Record</th>
            </thead>
            <tbody>
              {% for index, player in tpk_winners %}
                <tr>
                  <td scope="row">{{ index + 1 }}</td>
                  <td>{{ link_to('profile/view/' ~ player.p.player_id, player.p.username) }}</td>
                  <td>{{ player.d.level }}</td>
                  <td>{{ player.d.record|number_format }}</td>
                </tr>
              {% elsefor %}
                <tr>
                  <td scope="row" colspan="5">Nothing found...</td>
                </tr>
              {% endfor %}
            </tbody>
          </table>
        </div>
      </div>
      {% if tpk_winners is iterable and (tpk_winners|length > 0) %}
        <div class="panel-footer">{{ link_to('player/dusk-winners', 'More &rsaquo;') }}</div>
      {% endif %}
    </div>
  </div>
</div>