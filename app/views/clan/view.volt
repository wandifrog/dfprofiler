<ul class="clan-records">
  <li>
    <div class="record">
      <h4>Weekly TS</h4>
      <span>{{ clan.clan_weekly_ts|number_format }}</span>
    </div>
  </li>
  <li>
    <div class="record">
      <h4>Weekly TPK</h4>
      <span>{{ clan.clan_weekly_tpk|number_format }}</span>
    </div>
  </li>
  <li>
    <div class="record">
      <h4>All Time TS</h4>
      <span>{{ clan.clan_all_time_ts|number_format }}</span>
    </div>
  </li>
  <li>
    <div class="record">
      <h4>All Time TPK</h4>
      <span>{{ clan.clan_all_time_tpk|number_format }}</span>
    </div>
  </li>
  <li>
    <div class="record">
      <h4>Total Exp</h4>
      <span>{{ clan.clan_total_exp|number_format }}</span>
    </div>
  </li>
</ul>
<h2>Members</h2>
<table class="table table-striped table-hover table-bordered datatable" data-page-length="25">
  <thead>
      <tr>
        <th data-orderable="false" width="5"></th>
        <th>Username</th>
        <th>Level</th>
        <th data-orderable="false">Rank</th>
        <th data-orderable="false">Profession</th>
        <th>Weekly TS</th>
        <th>Weekly TPK</th>
        <th>All Time TS</th>
        <th>All Time TPK</th>
        <th>Total Exp</th>
        <th data-orderable="false">Membership</th>
        <th class="hide">Outpost</th>
        <th class="hide">Armor</th>
        <th class="hide">Weapon 1</th>
        <th class="hide">Weapon 2</th>
        <th class="hide">Weapon 3</th>
      </tr>
    </thead>
  <tbody>
    {% for member in members %}
      <tr>
        <td class="details-control"><i class="glyphicon"></i></td>
        <td>{{ link_to('profile/view/' ~ member.player_id, member.username) }}</td>
        <td>{{ member.level }}</td>
        <td>{{ member.clan_rank }}</td>
        <td>{{ member.profession }}</td>
        <td data-order="{{ member.weekly_ts }}">{{ member.weekly_ts|number_format }}</td>
        <td data-order="{{ member.weekly_tpk }}">{{ member.weekly_tpk|number_format }}</td>
        <td data-order="{{ member.all_time_ts }}">{{ member.all_time_ts|number_format }}</td>
        <td data-order="{{ member.all_time_tpk }}">{{ member.all_time_tpk|number_format }}</td>
        <td data-order="{{ member.total_exp }}">{{ member.total_exp|number_format }}</td>
        <td>{{ (member.gm == 1) ? 'GM' : 'Non-GM' }}</td>
        <td class="hide">{{ member.outpost }}</td>
        <td class="hide">
          {% if member.armor is not empty %}
            {{ member.armor|armor_info }}
          {% else %}
            No Armor
          {% endif %}
        </td>
        <td class="hide">
          {% if member.weapon1 is not empty %}
            {{ member.weapon1|weapon_image }}<br>
            {{ member.weapon1|weapon_info }}
          {% else %}
            No Weapon
          {% endif %}
        </td>
        <td class="hide">
          {% if member.weapon2 is not empty %}
            {{ member.weapon2|weapon_image }}<br>
            {{ member.weapon2|weapon_info }}
          {% else %}
            No Weapon
          {% endif %}
        </td>
        <td class="hide">
          {% if member.weapon3 is not empty %}
            {{ member.weapon3|weapon_image }}<br>
            {{ member.weapon3|weapon_info }}
          {% else %}
            No Weapon
          {% endif %}
        </td>
      </tr>
    {% endfor %}
  </tbody>
</table>
<div class="panel panel-default">
  <div class="panel-heading"><h3 class="panel-title">Disclaimer</h3></div>
    <div class="panel-body">
      <p>The list of members and the information on this page may not be 100% accurate all the time.
      <a href="http://fairview.deadfrontier.com/onlinezombiemmo/index.php?page=56&clanID={{ clan_id }}" target="_blank" class="btn btn-primary pull-right">Official Clan Page at deadfrontier.com <i class="fa fa-external-link"></i></a></p>
  </div>
</div>