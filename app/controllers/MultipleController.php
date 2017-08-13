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
use DRLP\Library\Profiler;
use DRLP\Library\Utils;
use DRLP\Library\Theme;

class MultipleController extends ControllerBase
{
  public function jsonAction()
  {
    $id_list = $this->dispatcher->getParam("id_list");

    if ($this->checkAjaxRequired()) {
      $ids = explode(':', $id_list);

      array_slice($ids, 0, 4); // take only 4 values

      $json_output = [];

      if (is_array($ids) && count($ids) > 1)
      {
        foreach($ids as $player_id)
        {
          $profiler = new Profiler($player_id);

          $player = $profiler->load();

          if (Profiles::profileExists($player_id) === FALSE)
          {
            $player->register();
          }

          if ($player->result)
          {
            $used_inventory = Utils::used_inv([
              'slot1' => $player->data['df_inv1_type'],
              'slot2' => $player->data['df_inv2_type'],
              'slot3' => $player->data['df_inv3_type'],
              'slot4' => $player->data['df_inv4_type'],
              'slot5' => $player->data['df_inv5_type'],
              'slot6' => $player->data['df_inv6_type'],
              'slot7' => $player->data['df_inv7_type'],
              'slot8' => $player->data['df_inv8_type'],
              'slot9' => $player->data['df_inv9_type'],
              'slot10' => $player->data['df_inv10_type'],
              'slot11' => $player->data['df_inv11_type'],
              'slot12' => $player->data['df_inv12_type'],
              'slot13' => $player->data['df_inv13_type'],
              'slot14' => $player->data['df_inv14_type'],
              'slot15' => $player->data['df_inv15_type'],
              'slot16' => $player->data['df_inv16_type'],
              'slot17' => $player->data['df_inv17_type'],
              'slot18' => $player->data['df_inv18_type'],
              'slot19' => $player->data['df_inv19_type'],
              'slot20' => $player->data['df_inv20_type'],
              'slot21' => $player->data['df_inv21_type'],
              'slot22' => $player->data['df_inv22_type'],
              'slot23' => $player->data['df_inv23_type'],
              'slot24' => $player->data['df_inv24_type'],
              'slot25' => $player->data['df_inv25_type'],
              'slot26' => $player->data['df_inv26_type'],
              'slot27' => $player->data['df_inv27_type'],
              'slot28' => $player->data['df_inv28_type'],
              'slot29' => $player->data['df_inv29_type'],
              'slot30' => $player->data['df_inv30_type'],
              'total' => $player->data['df_invslots'],
            ]);

            $implants = Utils::implant_count([
              'implant1' => $player->data['df_implant1_type'],
              'implant2' => $player->data['df_implant2_type'],
              'implant3' => $player->data['df_implant3_type'],
              'implant4' => $player->data['df_implant4_type'],
              'implant5' => $player->data['df_implant5_type'],
              'implant6' => $player->data['df_implant6_type'],
              'implant7' => $player->data['df_implant7_type'],
              'implant8' => $player->data['df_implant8_type'],
              'implant9' => $player->data['df_implant9_type'],
              'implant10' => $player->data['df_implant10_type'],
              'implant11' => $player->data['df_implant11_type'],
              'implant12' => $player->data['df_implant12_type'],
              'implant13' => $player->data['df_implant13_type'],
              'implant14' => $player->data['df_implant14_type'],
              'implant15' => $player->data['df_implant15_type'],
              'implant16' => $player->data['df_implant16_type'],
              'implant17' => $player->data['df_implant17_type'],
              'implant18' => $player->data['df_implant18_type'],
              'implant19' => $player->data['df_implant19_type'],
              'implant20' => $player->data['df_implant20_type'],
              'total' => $player->data['df_implantslots'],
            ]);

            $json_output[] = [
              'user_id' => $player->data['id_member'],
              'username' => Theme::username(
                $player->data['id_member'],
                $player->data['account_name']
              ),
              'profession_level' => $player->data['df_profession'] . ' Level ' . $player->data['df_level'],
              'experience' => Theme::experience(
                $player->data['df_exp'],
                $player->data['df_level']
              ),
              'cash' => '$' . number_format($player->data['df_cash']),
              'bank' => '$' . number_format($player->data['df_bankcash']),
              'creation_date' => Utils::account_creation(
                $player->data['df_servertime'],
                $player->data['df_creationtime']
              ),
              'clan' => Theme::get_clan(
                $player->data['df_clan_id'],
                $player->data['df_clan_name'],
                $player->data['df_clan_rank']
              ),
              'health' => Theme::health(
                $player->data['df_hpcurrent'],
                $player->data['df_hpmax'],
                $player->data['df_armourtype']
              ),
              'nourishment' => Theme::nourishment($player->data['df_hungerhp']),
              'armor' => Theme::armor(
                $player->data['df_armourtype'],
                $player->data['df_armourhp'],
                $player->data['df_armourhpmax'],
                $player->data['df_armourname']
              ),
              'exp_bonus' => Utils::exp_bonus(
                $player->data['df_profession'],
                $player->data['df_goldmember'],
                $player->data['df_boostexpuntil'],
                $player->data['df_hungerhp'],
                $this->config->site->event_bonus
              ),
              'inventory' => Theme::inventory(
                $used_inventory,
                $player->data['df_invslots']
              ),
              'outpost' => $player->data['df_minioutpostname'],
              'weapon_name_1' => $player->data['df_weapon1name'],
              'weapon_info_1' => Theme::weapon_info($player->data['df_weapon1type']),
              'weapon_image_1' => Theme::weapon_image($player->data['df_weapon1type']),
              'no_weapon_name_1' => Utils::weapon_check($player->data['df_weapon1type']),
              'weapon_name_2' => $player->data['df_weapon2name'],
              'weapon_info_2' => Theme::weapon_info($player->data['df_weapon2type']),
              'weapon_image_2' => Theme::weapon_image($player->data['df_weapon2type']),
              'no_weapon_name_2' => Utils::weapon_check($player->data['df_weapon2type']),
              'weapon_name_3' => $player->data['df_weapon3name'],
              'weapon_info_3' => Theme::weapon_info($player->data['df_weapon3type']),
              'weapon_image_3' => Theme::weapon_image($player->data['df_weapon3type']),
              'no_weapon_name_3' => Utils::weapon_check($player->data['df_weapon3type']),
              'no_weapons' => (Utils::weapon_check($player->data['df_weapon1type']) &&
                              Utils::weapon_check($player->data['df_weapon2type']) &&
                              Utils::weapon_check($player->data['df_weapon3type'])),
              'weekly_ts' => number_format($player->data['df_expdeathrecord_weekly']),
              'exp_since_death' => number_format($player->data['df_expdeath']),
              'all_time_ts' => number_format($player->data['df_expdeathrecord']),
              'total_exp' => number_format($player->data['df_exptotal']),
              'weekly_tpk' => number_format($player->data['df_playerkills_weekly']),
              'all_time_tpk' => number_format($player->data['df_playerkills']),
              'last_players_killed' => Theme::pvp_last(
                $player->data['df_lastpvp1'],
                $player->data['df_lastpvp2']
              ),
              'pvp_last_hit' => Theme::last_hit_by($player->data['df_lasthitby']),
              'exp_boost' => Theme::drug($player->data['df_boostexpuntil']),
              'dmg_boost' => Theme::drug($player->data['df_boostdamageuntil']),
              'speed_boost' => Theme::drug($player->data['df_boostspeeduntil']),
              'gold_member' => $player->data['df_goldmember'] ? 'Yes' : 'No',
              'gm_end' => Theme::gm_end(
                $player->data['df_goldmembertime'],
                $player->data['df_servertime']
              ),
              'tradezone' => Theme::tradezone($player->data['df_tradezone']),
              'last_spawn' => Utils::last_spawn(
                $player->data['df_lastspawntime'],
                $player->data['df_servertime']
              ),
              'implants' => Theme::implants($implants, $player->data['df_implantslots']),
            ];
          }
        }
      }

      $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
      $this->response->setContentType('application/json', 'utf8');
      $this->response->setJsonContent($json_output);
      $this->response->send();
    }
  }

  public function viewAction()
  {
    $id_list = $this->dispatcher->getParam("id_list");

    $ids = explode(':', $id_list);

    array_slice($ids, 0, 4);

    $this->assets->addJs('js/multiple.js');

    $title = '';

    if (is_array($ids) && count($ids) > 1)
    {
      foreach($ids as $player_id)
      {
        $profiler = new Profiler($player_id);

        $player_exists = $profiler->load();

        if (!empty($player_exists->data['id_member']))
        {
          $account_name = $player_exists->data['account_name'];

          if (!empty($account_name))
          {
            $player_names[] = $account_name;
          }
        }
        else
        {
          $this->response->setStatusCode(404, "Not Found");
          $this->dispatcher->forward([
            'controller' => 'error',
            'action'     => 'index',
          ]);

          return;
        }
      }

      $this->view->id_list = $id_list;

      if (count($player_names) > 0)
      {
        $names = implode(' | ', $player_names);

        $this->setTitle($names);
      }
      else
      {
        $this->setTitle('Dead Frontier Profile');
      }

      $this->view->meta_description = 'You are viewing ' . $account_name . '\'s Dead Frontier profile.';
    }
  }
}
