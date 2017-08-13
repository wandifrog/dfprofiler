<div class="table-responsive">
  <table class="table table-striped table-hover table-bordered datatable" data-page-length="25">
    <thead>
      <tr>
        <th data-orderable="false" width="5"></th>
        <th data-orderable="false" width="5">#</th>
        <th data-orderable="false">Username</th>
        <th data-orderable="false">Level</th>
        <th data-orderable="false">Profession</th>
        <th>Money</th>
        <th data-orderable="false">Membership</th>
        <th class="hide">Outpost</th>
        <th class="hide">Armor</th>
        <th class="hide">Clan</th>
        <th class="hide">Weapon 1</th>
        <th class="hide">Weapon 2</th>
        <th class="hide">Weapon 3</th>
      </tr>
    </thead>
    <tbody>
      {% for index, result in results %}
        <tr>
          <td class="details-control"><i class="glyphicon"></i></td>
          <td>{{ index + 1 }}</td>
          <td data-search="{{ result.username }}">
            {{ link_to('profile/view/' ~ result.player_id, result.username) }}
          </td>
          <td>{{ result.level }}</td>
          <td>{{ result.profession }}</td>
          <td data-order="{{ result.money }}">$ {{ result.money|number_format }}</td>
          <td>{{ (result.gm == 1) ? 'GM' : 'Non-GM' }}</td>
          <td class="hide">{{ result.outpost }}</td>
          <td class="hide">
            {% if result.armor is not empty %}
              {{ result.armor|armor_info }}
            {% else %}
              No Armor
            {% endif %}
          </td>
          <td class="hide">
            {% if result.clan_id is not empty and result.clan_name is not empty %}
              {{ link_to('clan/view/' ~ result.clan_id, result.clan_name) }}
            {% else %}
              No Clan
            {% endif %}
          </td>
          <td class="hide">
            {% if result.weapon1 is not empty %}
              {{ result.weapon1|weapon_image }}<br>
              {{ result.weapon1|weapon_info }}
            {% else %}
              No Weapon
            {% endif %}
          </td>
          <td class="hide">
            {% if result.weapon2 is not empty %}
              {{ result.weapon2|weapon_image }}<br>
              {{ result.weapon2|weapon_info }}
            {% else %}
              No Weapon
            {% endif %}
          </td>
          <td class="hide">
            {% if result.weapon3 is not empty %}
              {{ result.weapon3|weapon_image }}<br>
              {{ result.weapon3|weapon_info }}
            {% else %}
              No Weapon
            {% endif %}
          </td>
        </tr>
      {% elsefor %}
        <tr>
          <td scope="row" colspan="7">Nothing found...</td>
        </tr>
      {% endfor %}
    </tbody>
    <tfoot>
      <tr>
        <th></th>
        <th>#</th>
        <th>Username</th>
        <th>Level</th>
        <th>Profession</th>
        <th>Record</th>
        <th>Membership</th>
        <th class="hide">Outpost</th>
        <th class="hide">Armor</th>
        <th class="hide">Clan</th>
        <th class="hide">Weapon 1</th>
        <th class="hide">Weapon 2</th>
        <th class="hide">Weapon 3</th>
      </tr>
    </tfoot>
  </table>
</div>