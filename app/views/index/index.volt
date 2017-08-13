<div class="row">
  <div class="col-sm-8">
    <div class="row">
      <div class="col-sm-12">
        {{ flash.output() }}
        {{ form_simple.messages('username') }}
        {{ form_simple.messages('csrf') }}
        {% for i in 1..4 %}
          {{ form_multiple.messages('username' ~ i) }}
        {% endfor %}
        {{ form_multiple.messages('csrfmulti') }}
        <ul id="profile-search-tabs" class="nav nav-tabs" role="tablist">
          <li class="active"><a href="#simple" role="tab" data-toggle="tab">Simple</a></li>
          <li><a href="#multiple" role="tab" data-toggle="tab">Multiple</a></li>
        </ul>
        <div class="tab-content home-search">
          <div class="tab-pane fade in active" id="simple">
            {{ form('search/simple') }}
            <div class="input-group">
              <label class="sr-only" for="username">Username</label>
              {{ form_simple.render('username') }}
              <span class="input-group-btn">
                {{ form_simple.render('Go') }}
              </span>
            </div>
            
            {{ form_simple.render('csrf', ['value': form_token]) }}
            {{ endForm() }}
            <h5>Search using the username or user id. If you need help check out the {{ link_to('help', 'help page') }}.</h5>
          </div>
          <div class="tab-pane fade in" id="multiple">
            {{ form('search/multiple') }}

            {% for i in 1..4 %}
            	{{ form_multiple._render('username' ~ i) }}
            {% endfor %}

            <span class="input-group-btn">
              {{ form_multiple.render('Submit') }}
            </span>

            {{ form_multiple.render('csrfmulti', ['value': form_token]) }}
            {{ endForm() }}
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6">
        <div class="panel panel-default panel-records">
          <div class="panel-heading">
            <h3 class="panel-title">Top Survivor</h3>
          </div>
          <div class="panel-body">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Username</th>
                  <th>Record</th>
                </tr>
              </thead>
              <tbody>
                {% for index, player in top_survivor %}
                  <tr>
                    <td scope="row">{{ index + 1 }}</td>
                    <td>{{ link_to('profile/view/' ~ player.player_id, player.username) }}</td>
                    <td>{{ player.weekly_ts|number_format }}</td>
                  </tr>
                {% elsefor %}
                  <tr>
                    <td scope="row" colspan="3">Nothing found...</td>
                  </tr>
                {% endfor %}
              </tbody>
            </table>
          </div>
          {% if top_survivor is iterable and (top_survivor|length > 0) %}
            <div class="panel-footer">{{ link_to('player', 'More &rsaquo;') }}</div>
          {% endif %}
        </div>
      </div>
      <div class="col-sm-6">
        <div class="panel panel-default panel-records">
          <div class="panel-heading">
            <h3 class="panel-title">Top Player Killer</h3>
          </div>
          <div class="panel-body">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Username</th>
                  <th>Record</th>
                </tr>
              </thead>
              <tbody>
                {% for index, player in top_player_killer %}
                  <tr>
                    <td scope="row">{{ index + 1 }}</td>
                    <td>{{ link_to('profile/view/' ~ player.player_id, player.username) }}</td>
                    <td>{{ player.weekly_tpk|number_format }}</td>
                  </tr>
                {% elsefor %}
                  <tr>
                    <td scope="row" colspan="3">Nothing found...</td>
                  </tr>
                {% endfor %}
              </tbody>
            </table>
          </div>
          {% if top_player_killer is iterable and (top_player_killer|length > 0) %}
            <div class="panel-footer">{{ link_to('player', 'More &rsaquo;') }}</div>
          {% endif %}
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6">
        <div class="panel panel-default panel-records">
          <div class="panel-heading">
            <h3 class="panel-title">Clan Top Survivor</h3>
          </div>
          <div class="panel-body">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Clan</th>
                  <th>Record</th>
                </tr>
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
          {% if clan_top_survivor is iterable and (clan_top_survivor|length > 0) %}
            <div class="panel-footer">{{ link_to('clan', 'More &rsaquo;') }}</div>
          {% endif %}
        </div>
      </div>
      <div class="col-sm-6">
        <div class="panel panel-default panel-records">
          <div class="panel-heading">
            <h3 class="panel-title">Clan Top Player Killer</h3>
          </div>
          <div class="panel-body">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Clan</th>
                  <th>Record</th>
                </tr>
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
          {% if clan_top_player_killer is iterable and (clan_top_player_killer|length > 0) %}
            <div class="panel-footer">{{ link_to('clan', 'More &rsaquo;') }}</div>
          {% endif %}
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="panel panel-default panel-records with-background">
      <div class="panel-heading">
        <h3 class="panel-title">Latest Players Added</h3>
      </div>
      <div class="panel-body">
        {% for player in latest_players %}
          {% if loop.first %}
            <ul class="nav nav-pills nav-stacked">
          {% endif %}
            <li>{{ link_to('profile/view/' ~ player.player_id, player.username) }}</li>
          {% if loop.last %}
            </ul>
          {% endif %}
        {% elsefor %}
          <div class="alert alert-warning" role="alert">Nothing found...</div>
        {% endfor %}
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Most Powerful Guns</h3>
      </div>
      <div class="panel-body">
          {% for weapon in weapons %}
            {% if loop.first %}
              <ul class="nav nav-pills nav-stacked">
            {% endif %}
              <li>{{ weapon.name }} <span class="label label-default">base {{ weapon.damage }}</span> <span class="label label-primary">critical {{ weapon.critical }}</span></li>
            {% if loop.last %}
              </ul>
            {% endif %}
          {% elsefor %}
            <div class="alert alert-warning" role="alert">Nothing found...</div>
          {% endfor %}
        </ul>
      </div>
      {% if weapons is iterable and (weapons|length > 0) %}
        <div class="panel-footer">{{ link_to('damage', 'More &rsaquo;') }}</div>
      {% endif %}
    </div>
  </div>
</div>