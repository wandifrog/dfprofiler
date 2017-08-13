<ul id="duskwinners" class="nav nav-tabs" role="tablist">
  <li class="active"><a href="#ts" role="tab" data-toggle="tab">Top Survivor</a></li>
  <li><a href="#tpk" role="tab" data-toggle="tab">Top Player Killer</a></li>
</ul>
<div class="tab-content">
  <div class="tab-pane fade in active" id="ts">
    <div class="row">
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-striped table-hover table-bordered" data-page-length="25">
            <thead>
              <tr>
                <th>Username</th>
                <th>Level</th>
                <th>Profession</th>
                <th>Week</th>
                <th>Record</th>
              </tr>
            </thead>
            <tbody>
              {% for result in ts_winners %}
                <tr>
                  <td>{{ link_to('profile/view/' ~ result.p.player_id, result.p.username) }}</td>
                  <td>{{ result.d.level }}</td>
                  <td>{{ result.d.profession }}</td>
                  <td>{{ result.d.date_start|format_date }} - {{ result.d.date_end|format_date }}</td>
                  <td>{{ result.d.record|number_format }}</td>
                </tr>
              {% elsefor %}
                <tr>
                  <td scope="row" colspan="5">Nothing found...</td>
                </tr>
              {% endfor %}
            </tbody>
            <tfoot>
              <tr>
                <th>Username</th>
                <th>Level</th>
                <th>Profession</th>
                <th>Week</th>
                <th>Record</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="tab-pane fade in" id="tpk">
    <div class="row">
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-striped table-hover table-bordered" data-page-length="25">
            <thead>
              <tr>
                <th>Username</th>
                <th>Level</th>
                <th>Profession</th>
                <th>Week</th>
                <th>Record</th>
              </tr>
            </thead>
            <tbody>
              {% for result in tpk_winners %}
                <tr>
                  <td>{{ link_to('profile/view/' ~ result.p.player_id, result.p.username) }}</td>
                  <td>{{ result.d.level }}</td>
                  <td>{{ result.d.profession }}</td>
                  <td>{{ result.d.date_start|format_date }} - {{ result.d.date_end|format_date }}</td>
                  <td>{{ result.d.record|number_format }}</td>
                </tr>
              {% elsefor %}
                <tr>
                  <td scope="row" colspan="5">Nothing found...</td>
                </tr>
              {% endfor %}
            </tbody>
            <tfoot>
              <tr>
                <th>Username</th>
                <th>Level</th>
                <th>Profession</th>
                <th>Week</th>
                <th>Record</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>