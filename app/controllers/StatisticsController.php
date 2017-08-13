<?php
/*
 * MIT License
 *
 * Copyright (c) 2017 Juan Timaná
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace DRLP\Controllers;

use DRLP\Models\Profiles;
use DRLP\Library\Utils;

class StatisticsController extends ControllerBase
{

  public function indexAction()
  {
    $this->setTitle('Statistics');

    $this->view->meta_description = 'These statistics are based on the DRLP database, not the game itself.';

    $js = [];

    /*
     * Population
     */
    $populationQuery = function($outpost) {
      return Profiles::find([
        'columns' => 'player_id',
        'conditions' => 'outpost = ?0',
        'bind' => [$outpost]
      ]);
    };

    $population_data = json_encode([
      [
        'label' => 'Secronom Bunker',
        'data' => $populationQuery('Secronom Bunker')->count()
      ],
      [
        'label' => 'Fort Pastor',
        'data' => $populationQuery('Fort Pastor')->count()
      ],
      [
        'label' => 'Nastya`s Holdout',
        'data' => $populationQuery('Nastya`s Holdout')->count()
      ],
      [
        'label' => 'Dogg`s Stockade',
        'data' => $populationQuery('Dogg`s Stockade')->count()
      ],
      [
        'label' => 'Precinct 13',
        'data' => $populationQuery('Precinct 13')->count()
      ],
    ]);

    $js[] = Utils::flot('population', $population_data, 'pie');

    /*
     * Levels
     */
    $levelsQuery = function($level1, $level2) {
      return Profiles::find([
        'columns' => 'player_id',
        'conditions' => 'level BETWEEN ?0 AND ?1',
        'bind' => [$level1, $level2]
      ]);
    };

    $levels_data = json_encode([
      [
        'label' => 'Level 300 - 325',
        'data' => $levelsQuery(300, 325)->count()
      ],
      [
        'label' => 'Level 200 - 299',
        'data' => $levelsQuery(200, 299)->count()
      ],
      [
        'label' => 'Level 100 - 199',
        'data' => $levelsQuery(100, 199)->count()
      ],
      [
        'label' => 'Level 1 - 99',
        'data' => $levelsQuery(1, 99)->count()
      ],
    ]);

    $js[] = Utils::flot('levels', $levels_data, 'pie');

    /*
     * Dusk, X-Dusk, Corpse, Rest
     */
    $weapon = function($type, $weapon) {
      $params = [
        'columns' => 'player_id',
        'conditions' => $weapon . ' LIKE ?0',
        'bind' => [$type . '%']
      ];

      return Profiles::find($params);
    };

    $weapon1 = $weapon('xdusk', 'weapon1')->count();
    $weapon2 = $weapon('xdusk', 'weapon2')->count();
    $weapon3 = $weapon('xdusk', 'weapon3')->count();
    $xdusk = $weapon1 + $weapon2 + $weapon3;

    $weapon1 = $weapon('dusk', 'weapon1')->count();
    $weapon2 = $weapon('dusk', 'weapon2')->count();
    $weapon3 = $weapon('dusk', 'weapon3')->count();
    $dusk = $weapon1 + $weapon2 + $weapon3;

    $weapon1 = $weapon('corpse', 'weapon1')->count();
    $weapon2 = $weapon('corpse', 'weapon2')->count();
    $weapon3 = $weapon('corpse', 'weapon3')->count();
    $corpse = $weapon1 + $weapon2 + $weapon3;

    $weapons_data = json_encode([
      [
        'label' => 'X-Dusk',
        'data' => [[0, $xdusk]]
      ],
      [
        'label' => 'Dusk',
        'data' => [[2, $dusk]]
      ],
      [
        'label' => 'Corpse',
        'data' => [[4, $corpse]]
      ],
    ]);

    $js[] = Utils::flot('weapons', $weapons_data, 'bars');

    /*
     * Unlimited Wraith Cannon, Unlimited GAU-19, X-Dusk Mag
     */

    $hmg = function($weapon, $hmg) {
      $params = [
        'columns' => 'player_id',
        'conditions' => $weapon . ' LIKE ?0',
        'bind' => [$hmg . '%']
      ];

      return Profiles::find($params);
    };

    $weapon1 = $hmg('weapon1', 'uwraithcannon')->count();
    $weapon2 = $hmg('weapon2', 'uwraithcannon')->count();
    $weapon3 = $hmg('weapon3', 'uwraithcannon')->count();
    $uwraithcannon = $weapon1 + $weapon2 + $weapon3;

    $weapon1 = $hmg('weapon1', 'unlimitedg19')->count();
    $weapon2 = $hmg('weapon2', 'unlimitedg19')->count();
    $weapon3 = $hmg('weapon3', 'unlimitedg19')->count();
    $unlimitedg19 = $weapon1 + $weapon2 + $weapon3;

    $weapon1 = $hmg('weapon1', 'xduskmag')->count();
    $weapon2 = $hmg('weapon2', 'xduskmag')->count();
    $weapon3 = $hmg('weapon3', 'xduskmag')->count();
    $xduskmag = $weapon1 + $weapon2 + $weapon3;

    $hmgs_data = json_encode([
      [
        'label' => 'Unlimited Wraith Cannon',
        'data' => [[0, $uwraithcannon]]
      ],
      [
        'label' => 'Unlimited GAU-19',
        'data' => [[2, $unlimitedg19]]
      ],
      [
        'label' => 'X-Dusk Mag',
        'data' => [[4, $xduskmag]]
      ],
    ]);

    $js[] = Utils::flot('hmgs', $hmgs_data, 'bars');

    /*
     * Membership
     */

    $membership = function($membership) {
      $params = [
        'columns' => 'player_id',
        'conditions' => 'gm = ?0',
        'bind' => [$membership . '%']
      ];

      return Profiles::find($params);
    };

    $membership_data = json_encode([
      [
        'label' => 'GM',
        'data' => $membership(1)->count()
      ],
      [
        'label' => 'Non-GM',
        'data' => $membership(0)->count()
      ],
    ]);

    $js[] = Utils::flot('membership', $membership_data, 'pie');

    /*
     * Professions
     */

    $production = function() {
      $params = [
        'columns' => 'player_id',
        'conditions' => "profession = 'Farmer' OR profession = 'Scientist'"
      ];

      return Profiles::find($params);
    };

    $service = function() {
      $params = [
        'columns' => 'player_id',
        'conditions' => "profession = 'Doctor' OR profession = 'Chef'
                         OR profession = 'Engineer'"
      ];

      return Profiles::find($params);
    };

    $statboost = function() {
      $params = [
        'columns' => 'player_id',
        'conditions' => "profession = 'Boxer' OR profession = 'Soldier'
                         OR profession = 'Police Officer'
                         OR profession = 'Fireman' OR profession = 'Athlete'"
      ];

      return Profiles::find($params);
    };

    $rp = function() {
      $params = [
        'columns' => 'player_id',
        'conditions' => "profession = 'Teacher' OR profession = 'Priest'
                         OR profession = 'Lawyer' OR profession = 'Accountant'
                         OR profession = 'Journalist' OR profession = 'Actor'
                         OR profession = 'Stock Broker' OR profession = 'Architect'
                         OR profession = 'Entertainer' OR profession = 'Student'"
      ];

      return Profiles::find($params);
    };

    $professions_data = json_encode([
      ['label' => 'Production', 'data' => $production()->count()],
      ['label' => 'Service', 'data' => $service()->count()],
      ['label' => 'Stat-Booster', 'data' => $statboost()->count()],
      ['label' => 'Role Play', 'data' => $rp()->count()],
    ]);

    $js[] = Utils::flot('professions', $professions_data, 'pie');

    // The Javascript
    $this->view->js = $js;
  }

}
