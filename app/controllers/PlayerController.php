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
use DRLP\Models\DuskWinners;

/**
 * Players Overview Page
 */

class PlayerController extends ControllerBase
{

  public function indexAction()
  {
    $this->setTitle('Players Overview');

    $this->view->meta_description = 'This page provides an overview of the player records';

    // top survivor data
    $this->view->top_survivor = Profiles::find([
      'columns' => 'username, player_id, level, profession, weekly_ts',
      'order' => 'weekly_ts DESC',
      'limit' => 5
    ]);

    // top player killer data
    $this->view->top_player_killer = Profiles::find([
      'columns' => 'username, player_id, level, profession, weekly_tpk',
      'order' => 'weekly_tpk DESC',
      'limit' => 5
    ]);

    // all time ts data
    $this->view->all_time_ts = Profiles::find([
      'columns' => 'username, player_id, level, profession, all_time_ts',
      'order' => 'all_time_ts DESC',
      'limit' => 5
    ]);

    // all time ts data
    $this->view->all_time_tpk = Profiles::find([
      'columns' => 'username, player_id, level, profession, all_time_tpk',
      'order' => 'all_time_tpk DESC',
      'limit' => 5
    ]);

    // top strongest data
    $this->view->top_strongest = Profiles::find([
      'columns' => 'username, player_id, level, profession, total_exp',
      'order' => 'total_exp DESC',
      'limit' => 5
    ]);

    // top richest data
    $this->view->top_richest = Profiles::find([
      'columns' => 'username, player_id, level, profession, money',
      'order' => 'money DESC',
      'limit' => 5
    ]);

    // top hardcore data
    $this->view->top_hardcore = Profiles::find([
      'columns' => 'username, player_id, level, profession, total_exp, exp_since_death',
      'conditions' => 'total_exp = exp_since_death AND total_exp != 0',
      'order' => 'total_exp DESC',
      'limit' => 5
    ]);

    // level 325 data
    $this->view->level_325 = Profiles::find([
      'columns' => 'username, player_id, level, profession, total_exp, all_time_ts, all_time_tpk',
      'conditions' => 'level = 325',
      'order' => 'total_exp DESC',
      'limit' => 5
    ]);

    // latest ts winners data
    $phql = 'SELECT p.*, d.*
    FROM DRLP\Models\DuskWinners d, DRLP\Models\Profiles p
    WHERE d.profile_id = p.player_id AND d.competition = "ts"
    ORDER BY d.date_end DESC LIMIT 5';
    $this->view->ts_winners = $this->modelsManager->executeQuery($phql);

    // latest tpk winners data
    $phql = 'SELECT p.*, d.*
    FROM DRLP\Models\DuskWinners d, DRLP\Models\Profiles p
    WHERE d.profile_id = p.player_id AND d.competition = "tpk"
    ORDER BY d.date_end DESC LIMIT 5';
    $this->view->tpk_winners = $this->modelsManager->executeQuery($phql);
  }

  public function weeklyTsAction() {
    $this->setTitle('Weekly TS');

    $this->view->meta_description = 'This page contains the Weekly TS records';

    $this->assets->addJs('js/player.records.datatables.js');

    $this->view->results = Profiles::find([
      'columns' => 'player_id, username, level, profession, weekly_ts, gm, outpost, armor, weapon1, weapon2, weapon3, clan_name, clan_id',
      'conditions' => 'weekly_ts > 0',
      'order' => 'weekly_ts DESC',
      'limit' => 200
    ]);
  }

  public function allTimeTsAction() {
    $this->setTitle('All Time TS');

    $this->view->meta_description = 'This page contains the All Time TS records';

    $this->assets->addJs('js/player.records.datatables.js');

    $this->view->results = Profiles::find([
      'columns' => 'player_id, username, level, profession, all_time_ts, gm, outpost, armor, weapon1, weapon2, weapon3, clan_name, clan_id',
      'conditions' => 'all_time_ts > 0',
      'order' => 'all_time_ts DESC',
      'limit' => 200
    ]);
  }

  public function weeklyTpkAction() {
    $this->setTitle('Weekly TPK');

    $this->view->meta_description = 'This page contains the Weekly TPK records';

    $this->assets->addJs('js/player.records.datatables.js');

    $this->view->results = Profiles::find([
      'columns' => 'player_id, username, level, profession, weekly_tpk, gm, outpost, armor, weapon1, weapon2, weapon3, clan_name, clan_id',
      'conditions' => 'weekly_tpk > 0',
      'order' => 'weekly_tpk DESC',
      'limit' => 200
    ]);
  }

  public function allTimeTpkAction() {
    $this->setTitle('All Time TPK');

    $this->view->meta_description = 'This page contains the All Time TSPK records';

    $this->assets->addJs('js/player.records.datatables.js');

    $this->view->results = Profiles::find([
      'columns' => 'player_id, username, level, profession, all_time_tpk, gm, outpost, armor, weapon1, weapon2, weapon3, clan_name, clan_id',
      'conditions' => 'all_time_tpk > 0',
      'order' => 'all_time_tpk DESC',
      'limit' => 200
    ]);
  }

  public function topStrongestAction() {
    $this->setTitle('Top Strongest');

    $this->view->meta_description = 'This page contains a list of the Top Strongest players in the entire game';

    $this->assets->addJs('js/player.records.datatables.js');

    $this->view->results = Profiles::find([
      'columns' => 'player_id, username, level, profession, total_exp, gm, outpost, armor, weapon1, weapon2, weapon3, clan_name, clan_id',
      'conditions' => 'total_exp > 0',
      'order' => 'total_exp DESC',
      'limit' => 200
    ]);
  }

  public function topRichestAction() {
    $this->setTitle('Top Richest');

    $this->view->meta_description = 'This page contains a list of the Top Richest players in the entire game';

    $this->assets->addJs('js/player.records.datatables.js');

    $this->view->results = Profiles::find([
      'columns' => 'player_id, username, level, profession, money, gm, outpost, armor, weapon1, weapon2, weapon3, clan_name, clan_id',
      'conditions' => 'money > 0',
      'order' => 'total_exp DESC',
      'limit' => 200
    ]);
  }

  public function topHardcoreAction() {
    $this->setTitle('Top Hardcore');

    $this->view->meta_description = 'This page contains a list of the Top Hardcore players in the entire game';

    $this->assets->addJs('js/player.records.datatables.js');

    $this->view->results = Profiles::find([
      'columns' => 'player_id, username, level, profession, total_exp, exp_since_death, gm, outpost, armor, weapon1, weapon2, weapon3, clan_name, clan_id',
      'conditions' => 'total_exp = exp_since_death AND total_exp != 0',
      'order' => 'total_exp DESC',
      'limit' => 200
    ]);
  }

  public function level325Action() {
    $this->setTitle('Level 325');

    $this->assets->addJs('js/player.records.level220.datatables.js');

    $this->view->meta_description = 'This page contains a list of the Level 325s in the game';

    $this->view->results = Profiles::find([
      'columns' => 'player_id, username, level, profession, total_exp, all_time_ts, all_time_tpk, gm, outpost, armor, weapon1, weapon2, weapon3, clan_name, clan_id',
      'conditions' => 'level = 325',
      'order' => 'total_exp DESC',
      'limit' => 200
    ]);
  }

  public function duskWinnersAction() {
    $this->setTitle('Dusk Winners');

    $this->view->meta_description = 'This page contains a list of Dusk winners for Top Survivor and Top Player Killer.' .
    'This page is updated every Monday @ 7:00 AM.';

    // latest ts winners data
    $phql = 'SELECT p.*, d.*
    FROM DRLP\Models\DuskWinners d, DRLP\Models\Profiles p
    WHERE d.profile_id = p.player_id AND d.competition = "ts"
    ORDER BY d.date_end DESC LIMIT 50';
    $this->view->ts_winners = $this->modelsManager->executeQuery($phql);

    // latest tpk winners data
    $phql = 'SELECT p.*, d.*
    FROM DRLP\Models\DuskWinners d, DRLP\Models\Profiles p
    WHERE d.profile_id = p.player_id AND d.competition = "tpk"
    ORDER BY d.date_end DESC LIMIT 50';
    $this->view->tpk_winners = $this->modelsManager->executeQuery($phql);
  }

}
