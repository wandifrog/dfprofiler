<div id="profile-page">
  <div id="profile-header">
    <div id="ajax-loader"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="placeholder display username-header" data-bind="html: username_header"></div>
          <div class="placeholder display clan" data-bind="html: clan"></div>
          <div class="placeholder display" data-bind="text: profession_level"></div>
          <div class="placeholder display" data-bind="text: experience"></div>
          <a id="reload-profile" class="pull-right" href="#"><i class="fa fa-refresh"></i></a>
        </div>
      </div>
    </div>
  </div>
  <ul id="profiler-data-tabs" class="nav nav-tabs" role="tablist">
    <li class="active"><a href="#view-profile" role="tab" data-toggle="tab">Profile</a></li>
    <li><a href="#view-gps" role="tab" data-toggle="tab">GPS</a></li>
  </ul>
  {{ partial('partials/top-banner') }}
  <div class="container">
    <div class="tab-content">
      <div class="tab-pane fade in active" id="view-profile">
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
                      <div class="placeholder display" data-bind="text: cash"></div>
                    </div>
                  </div>
                  <div class="col-sm-8 col-md-12">
                    <h4>Bank</h4>
                    <div class="pdata">
                      <div class="placeholder display" data-bind="text: bank"></div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4 col-md-12">
                    <h4>Account Creation</h4>
                    <div class="pdata">
                      <div class="placeholder display" data-bind="text: creation_date"></div>
                    </div>
                  </div>
                  <div class="col-sm-4 col-md-12">
                    <h4>Last Outpost</h4>
                    <div class="pdata">
                      <div class="placeholder display" data-bind="text: outpost"></div>
                    </div>
                  </div>
                  <div class="col-sm-4 col-md-12">
                    <h4>Trade Zone</h4>
                    <div class="pdata">
                      <div class="placeholder display" data-bind="text: tradezone"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Weapons</h3>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-sm-4 col-md-12">
                    <h4>Primary Weapon</h4>
                    <div class="pdata">
                      <div class="weapon-image" data-bind="html: weapon_image_1, visible: weapon_image_1"></div>
                      <div class="weapon-name" data-bind="text: weapon_name_1, visible: weapon_name_1"></div>
                      <div class="weapon-info" data-bind="text: weapon_info_1, visible: weapon_info_1"></div>
                    </div>
                    <div class="pdata" data-bind="visible: no_weapon_name_1">No Weapon</div>
                  </div>
                  <div class="col-sm-4 col-md-12">
                    <h4>Secondary Weapon</h4>
                    <div class="pdata">
                      <div class="weapon-image" data-bind="html: weapon_image_2, visible: weapon_image_2"></div>
                      <div class="weapon-name" data-bind="text: weapon_name_2, visible: weapon_name_2"></div>
                      <div class="weapon-info" data-bind="text: weapon_info_2, visible: weapon_info_2"></div>
                    </div>
                    <div class="pdata" data-bind="visible: no_weapon_name_2">No Weapon</div>
                  </div>
                  <div class="col-sm-4 col-md-12">
                    <h4>Tertiary Weapon</h4>
                    <div class="pdata">
                      <div class="weapon-image" data-bind="html: weapon_image_3, visible: weapon_image_3"></div>
                      <div class="weapon-name" data-bind="text: weapon_name_3, visible: weapon_name_3"></div>
                      <div class="weapon-info" data-bind="text: weapon_info_3, visible: weapon_info_3"></div>
                    </div>
                    <div class="pdata" data-bind="visible: no_weapon_name_3">No Weapon</div>
                  </div>
                  <div class="col-sm-4 col-md-12" data-bind="visible: no_weapons">
                    <h4>Bare Fists</h4>
                    <div class="pdata"><img src="/images/weapons/fist.png"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-5">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Extra Info</h3>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-sm-4 col-md-12">
                    <h4>Health</h4>
                    <div class="pdata">
                      <div class="placeholder display" data-bind="html: health"></div>
                    </div>
                  </div>
                  <div class="col-sm-4 col-md-12">
                    <h4>Nourishment</h4>
                    <div class="pdata">
                      <div class="placeholder display" data-bind="html: nourishment"></div>
                    </div>
                  </div>
                  <div class="col-sm-4 col-md-12">
                    <h4>Armor</h4>
                    <div class="pdata">
                      <div class="placeholder display" data-bind="html: armor"></div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4 col-md-12">
                    <h4>Exp Bonus</h4>
                    <div class="pdata">
                      <div class="placeholder display" data-bind="text: exp_bonus"></div>
                    </div>
                  </div>
                  <div class="col-sm-4 col-md-12">
                    <h4>Inventory</h4>
                    <div class="pdata">
                      <div class="placeholder display" data-bind="html: inventory"></div>
                    </div>
                  </div>
                  <div class="col-sm-4 col-md-12">
                    <h4>Implants</h4>
                    <div class="pdata">
                      <div class="placeholder display" data-bind="html: implants"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row profiler equal">
          <div class="col-md-3">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">TS Records</h3>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-sm-3 col-md-12">
                    <h4>Weekly TS</h4>
                    <div class="pdata">
                      <div class="placeholder display" data-bind="text: weekly_ts"></div>
                    </div>
                  </div>
                  <div class="col-sm-3 col-md-12">
                    <h4>Exp Since Death</h4>
                    <div class="pdata">
                      <div class="placeholder display" data-bind="text: exp_since_death"></div>
                    </div>
                  </div>
                  <div class="col-sm-3 col-md-12">
                    <h4>All Time TS</h4>
                    <div class="pdata">
                      <div class="placeholder display" data-bind="text: all_time_ts"></div>
                    </div>
                  </div>
                  <div class="col-sm-3 col-md-12">
                    <h4>Total Exp</h4>
                    <div class="pdata">
                      <div class="placeholder display" data-bind="text: total_exp"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">TPK Records</h3>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-sm-2 col-md-12">
                    <h4>Weekly TPK</h4>
                    <div class="pdata">
                      <div class="placeholder display" data-bind="text: weekly_tpk"></div>
                    </div>
                  </div>
                  <div class="col-sm-2 col-md-12">
                    <h4>All Time TPK</h4>
                    <div class="pdata">
                      <div class="placeholder display" data-bind="text: all_time_tpk"></div>
                    </div>
                  </div>
                  <div class="col-sm-4 col-md-12">
                    <h4>Last Players Killed</h4>
                    <div class="pdata">
                      <div class="placeholder display" data-bind="html: last_players_killed"></div>
                    </div>
                  </div>
                  <div class="col-sm-4 col-md-12">
                    <h4>Last Hit By</h4>
                    <div class="pdata">
                      <div class="placeholder display" data-bind="html: pvp_last_hit"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="panel panel-default panel-stats">
              <div class="panel-heading">
                <h3 class="panel-title">Stats &amp; Proficiencies</h3>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-6 proficiencies-panel">
                    <div class="col-sm-2 col-md-12">
                      <h4>Strength</h4>
                      <div class="pdata stats">
                        <div class="placeholder display" data-bind="html: stat_strength"></div>
                      </div>
                    </div>
                    <div class="col-sm-2 col-md-12">
                      <h4>Endurance</h4>
                      <div class="pdata stats">
                        <div class="placeholder display" data-bind="html: stat_endurance"></div>
                      </div>
                    </div>
                    <div class="col-sm-2 col-md-12">
                      <h4>Agility</h4>
                      <div class="pdata stats">
                        <div class="placeholder display" data-bind="html: stat_agility"></div>
                      </div>
                    </div>
                    <div class="col-sm-2 col-md-12">
                      <h4>Accuracy</h4>
                      <div class="pdata stats">
                        <div class="placeholder display" data-bind="html: stat_accuracy"></div>
                      </div>
                    </div>
                    <div class="col-sm-2 col-md-12">
                      <h4>Critical Hit</h4>
                      <div class="pdata stats">
                        <div class="placeholder display" data-bind="html: stat_critical_hit"></div>
                      </div>
                    </div>
                    <div class="col-sm-2 col-md-12">
                      <h4>Reloading</h4>
                      <div class="pdata stats">
                        <div class="placeholder display" data-bind="html: stat_reloading"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 proficiencies-panel separator">
                    <div class="col-sm-2 col-md-12">
                      <h4>Melee</h4>
                      <div class="pdata stats">
                        <div class="placeholder display" data-bind="text: prof_melee"></div>
                      </div>
                    </div>
                    <div class="col-sm-2 col-md-12">
                      <h4>Pistols</h4>
                      <div class="pdata stats">
                        <div class="placeholder display" data-bind="text: prof_pistols"></div>
                      </div>
                    </div>
                    <div class="col-sm-2 col-md-12">
                      <h4>Rifles</h4>
                      <div class="pdata stats">
                        <div class="placeholder display" data-bind="text: prof_rifles"></div>
                      </div>
                    </div>
                    <div class="col-sm-2 col-md-12">
                      <h4>Shotguns</h4>
                      <div class="pdata stats">
                        <div class="placeholder display" data-bind="text: prof_shotguns"></div>
                      </div>
                    </div>
                    <div class="col-sm-2 col-md-12">
                      <h4>Machine Guns</h4>
                      <div class="pdata stats">
                        <div class="placeholder display" data-bind="text: prof_machine_guns"></div>
                      </div>
                    </div>
                    <div class="col-sm-2 col-md-12">
                      <h4>Explosives</h4>
                      <div class="pdata stats">
                        <div class="placeholder display" data-bind="text: prof_explosives"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row profiler equal">
          <div class="col-md-6">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Ammunition</h3>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-xs-4 col-sm-3 col-md-3">
                    <h4>.32</h4>
                    <div class="pdata">
                      <div class="placeholder display" data-bind="text: type32ammo"></div>
                    </div>
                  </div>
                  <div class="col-xs-4 col-sm-3 col-md-3">
                    <h4>.35</h4>
                    <div class="pdata">
                      <div class="placeholder display" data-bind="text: type35ammo"></div>
                    </div>
                  </div>
                  <div class="col-xs-4 col-sm-3 col-md-3">
                    <h4>.357</h4>
                    <div class="pdata">
                      <div class="placeholder display" data-bind="text: type357ammo"></div>
                    </div>
                  </div>
                  <div class="col-xs-4 col-sm-3 col-md-3">
                    <h4>.38</h4>
                    <div class="pdata">
                      <div class="placeholder display" data-bind="text: type38ammo"></div>
                    </div>
                  </div>
                  <div class="col-xs-4 col-sm-3 col-md-3">
                    <h4>.40</h4>
                    <div class="pdata">
                      <div class="placeholder display" data-bind="text: type40ammo"></div>
                    </div>
                  </div>
                  <div class="col-xs-4 col-sm-3 col-md-3">
                    <h4>.45</h4>
                    <div class="pdata">
                      <div class="placeholder display" data-bind="text: type45ammo"></div>
                    </div>
                  </div>
                  <div class="col-xs-4 col-sm-3 col-md-3">
                    <h4>.50</h4>
                    <div class="pdata">
                      <div class="placeholder display" data-bind="text: type50ammo"></div>
                    </div>
                  </div>
                  <div class="col-xs-4 col-sm-3 col-md-3">
                    <h4>.55</h4>
                    <div class="pdata">
                      <div class="placeholder display" data-bind="text: type55ammo"></div>
                    </div>
                  </div>
                  <div class="col-xs-4 col-sm-3 col-md-3">
                    <h4>5.5mm</h4>
                    <div class="pdata">
                      <div class="placeholder display" data-bind="text: type55rifleammo"></div>
                    </div>
                  </div>
                  <div class="col-xs-4 col-sm-3 col-md-3">
                    <h4>7.5mm</h4>
                    <div class="pdata">
                      <div class="placeholder display" data-bind="text: type75rifleammo"></div>
                    </div>
                  </div>
                  <div class="col-xs-4 col-sm-3 col-md-3">
                    <h4>9mm Rifle</h4>
                    <div class="pdata">
                      <div class="placeholder display" data-bind="text: type9rifleammo"></div>
                    </div>
                  </div>
                  <div class="col-xs-4 col-sm-3 col-md-3">
                    <h4>12.7mm</h4>
                    <div class="pdata">
                      <div class="placeholder display" data-bind="text: type127rifleammo"></div>
                    </div>
                  </div>
                  <div class="col-xs-4 col-sm-3 col-md-3">
                    <h4>14mm</h4>
                    <div class="pdata">
                      <div class="placeholder display" data-bind="text: type14rifleammo"></div>
                    </div>
                  </div>
                  <div class="col-xs-4 col-sm-3 col-md-3">
                    <h4>10g</h4>
                    <div class="pdata">
                      <div class="placeholder display" data-bind="text: type10gaugeammo"></div>
                    </div>
                  </div>
                  <div class="col-xs-4 col-sm-3 col-md-3">
                    <h4>12g</h4>
                    <div class="pdata">
                      <div class="placeholder display" data-bind="text: type12gaugeammo"></div>
                    </div>
                  </div>
                  <div class="col-xs-4 col-sm-3 col-md-3">
                    <h4>16g</h4>
                    <div class="pdata">
                      <div class="placeholder display" data-bind="text: type16gaugeammo"></div>
                    </div>
                  </div>
                  <div class="col-xs-4 col-sm-3 col-md-3">
                    <h4>20g</h4>
                    <div class="pdata">
                      <div class="placeholder display" data-bind="text: type20gaugeammo"></div>
                    </div>
                  </div>
                  <div class="col-xs-4 col-sm-3 col-md-3">
                    <h4>Grenades</h4>
                    <div class="pdata">
                      <div class="placeholder display" data-bind="text: grenadeammo"></div>
                    </div>
                  </div>
                  <div class="col-xs-4 col-sm-3 col-md-3">
                    <h4>Heavy Grenades</h4>
                    <div class="pdata">
                      <div class="placeholder display" data-bind="text: heavygrenadeammo"></div>
                    </div>
                  </div>
                  <div class="col-xs-4 col-sm-3 col-md-3 col-md-offset-3">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-3">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Drugs</h3>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-4 col-lg-12">
                    <h4>+50% Exp Boost</h4>
                    <div class="pdata">
                      <div class="placeholder display" data-bind="html: exp_boost"></div>
                    </div>
                  </div>
                  <div class="col-md-4 col-lg-12">
                    <h4>+35% Damage Boost</h4>
                    <div class="pdata">
                      <div class="placeholder display" data-bind="html: dmg_boost"></div>
                    </div>
                  </div>
                  <div class="col-md-4 col-lg-12">
                    <h4>+35% Speed Boost</h4>
                    <div class="pdata">
                      <div class="placeholder display" data-bind="html: speed_boost"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-3">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Misc</h3>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-4 col-lg-12">
                    <h4>Gold Membership</h4>
                    <div class="pdata">
                      <div class="placeholder display" data-bind="text: gold_member"></div>
                    </div>
                  </div>
                  <div class="col-md-4 col-lg-12">
                    <h4>GM End Date</h4>
                    <div class="pdata">
                      <div class="placeholder display" data-bind="text: gm_end"></div>
                    </div>
                  </div>
                  <div class="col-md-4 col-lg-12">
                    <h4>Last Spawn</h4>
                    <div class="pdata">
                      <div class="placeholder display" data-bind="text: last_spawn"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="view-gps">
        <div id="profiler-gps-data"></div>
      </div>
    </div>
  </div>
</div>