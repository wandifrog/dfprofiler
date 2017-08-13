<div id="profiles">
    <div data-bind="foreach: { data: players, as: 'player' }">
      <h2 class="bigusername" data-bind="html: player.username"></h2>
        <div class="row profiler equal">
          <div class="col-md-3">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Basic Info</h3>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-sm-4 col-md-12">
                    <h4>Cash</h4>
                    <div class="pdata">
                      <div data-bind="text: player.cash"></div>
                    </div>
                  </div>
                  <div class="col-sm-8 col-md-12">
                    <h4>Bank</h4>
                    <div class="pdata">
                      <div data-bind="text: player.bank"></div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4 col-md-12">
                    <h4>Account Creation</h4>
                    <div class="pdata">
                      <div data-bind="text: player.creation_date"></div>
                    </div>
                  </div>
                  <div class="col-sm-4 col-md-12">
                    <h4>Last Outpost</h4>
                    <div class="pdata">
                      <div data-bind="text: player.outpost"></div>
                    </div>
                  </div>
                  <div class="col-sm-4 col-md-12">
                    <h4>Trade Zone</h4>
                    <div class="pdata">
                      <div data-bind="text: player.tradezone"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Weapons</h3>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-sm-4 col-md-12">
                    <h4>Primary Weapon</h4>
                    <div class="pdata">
                      <div class="weapon-image" data-bind="html: player.weapon_image_1, visible: player.weapon_image_1"></div>
                      <div class="weapon-name" data-bind="text: player.weapon_name_1, visible: player.weapon_name_1"></div>
                      <div class="weapon-info" data-bind="text: player.weapon_info_1, visible: player.weapon_info_1"></div>
                    </div>
                    <div class="pdata" data-bind="visible: player.no_weapon_name_1">No Weapon</div>
                  </div>
                  <div class="col-sm-4 col-md-12">
                    <h4>Secondary Weapon</h4>
                    <div class="pdata">
                      <div class="weapon-image" data-bind="html: player.weapon_image_2, visible: player.weapon_image_2"></div>
                      <div class="weapon-name" data-bind="text: player.weapon_name_2, visible: player.weapon_name_2"></div>
                      <div class="weapon-info" data-bind="text: player.weapon_info_2, visible: player.weapon_info_2"></div>
                    </div>
                    <div class="pdata" data-bind="visible: player.no_weapon_name_2">No Weapon</div>
                  </div>
                  <div class="col-sm-4 col-md-12">
                    <h4>Tertiary Weapon</h4>
                    <div class="pdata">
                      <div class="weapon-image" data-bind="html: player.weapon_image_3, visible: player.weapon_image_3"></div>
                      <div class="weapon-name" data-bind="text: player.weapon_name_3, visible: player.weapon_name_3"></div>
                      <div class="weapon-info" data-bind="text: player.weapon_info_3, visible: player.weapon_info_3"></div>
                    </div>
                    <div class="pdata" data-bind="visible: player.no_weapon_name_3">No Weapon</div>
                  </div>
                  <div class="col-sm-4 col-md-12" data-bind="visible: player.no_weapons">
                    <h4>Bare Fists</h4>
                    <div class="pdata"><img src="/images/weapons/fist.png"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Records</h3>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-sm-4 col-md-12">
                    <h4>Weekly TS</h4>
                    <div class="pdata">
                      <div data-bind="text: player.weekly_ts"></div>
                    </div>
                  </div>
                  <div class="col-sm-4 col-md-12">
                    <h4>Exp Since Death</h4>
                    <div class="pdata">
                      <div data-bind="text: player.exp_since_death"></div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-2 col-md-12">
                    <h4>Weekly TPK</h4>
                    <div class="pdata">
                      <div data-bind="text: player.weekly_tpk"></div>
                    </div>
                  </div>
                  <div class="col-sm-2 col-md-12">
                    <h4>All Time TPK</h4>
                    <div class="pdata">
                      <div data-bind="text: player.all_time_tpk"></div>
                    </div>
                  </div>
                  <div class="col-sm-4 col-md-12">
                    <h4>Last Players Killed</h4>
                    <div class="pdata">
                      <div data-bind="html: player.last_players_killed"></div>
                    </div>
                  </div>
                  <div class="col-sm-4 col-md-12">
                    <h4>Last Hit By</h4>
                    <div class="pdata">
                      <div data-bind="html: player.pvp_last_hit"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Extra Info</h3>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-sm-4 col-md-12">
                    <h4>Health</h4>
                    <div class="pdata">
                      <div data-bind="html: player.health"></div>
                    </div>
                  </div>
                  <div class="col-sm-4 col-md-12">
                    <h4>Nourishment</h4>
                    <div class="pdata">
                      <div data-bind="html: player.nourishment"></div>
                    </div>
                  </div>
                  <div class="col-sm-4 col-md-12">
                    <h4>Armor</h4>
                    <div class="pdata">
                      <div data-bind="html: player.armor"></div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4 col-md-12">
                    <h4>Exp Bonus</h4>
                    <div class="pdata">
                      <div data-bind="text: player.exp_bonus"></div>
                    </div>
                  </div>
                  <div class="col-sm-4 col-md-12">
                    <h4>Inventory</h4>
                    <div class="pdata">
                      <div data-bind="html: player.inventory"></div>
                    </div>
                  </div>
                  <div class="col-sm-4 col-md-12">
                    <h4>Implants</h4>
                    <div class="pdata">
                      <div data-bind="html: player.implants"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>