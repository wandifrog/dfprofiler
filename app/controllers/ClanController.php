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

/**
 * Clan Controller, functions should be self explanatory.
 */

class ClanController extends ControllerBase
{

  public function _TopSurvivor($total)
  {
    return Profiles::find([
      'columns' => 'clan_id, clan_name, SUM(weekly_ts) AS clan_weekly_ts',
      'conditions' => 'clan_id <> 0 AND weekly_ts > 0',
      'group' => 'clan_id',
      'order' => 'clan_weekly_ts DESC',
      'limit' => $total
    ]);
  }

  public function _TopPlayerKiller($total)
  {
    return Profiles::find([
      'columns' => 'clan_id, clan_name, SUM(weekly_tpk) AS clan_weekly_tpk',
      'conditions' => 'clan_id <> 0 AND weekly_tpk > 0',
      'group' => 'clan_id',
      'order' => 'clan_weekly_tpk DESC',
      'limit' => $total
    ]);
  }

  public function _AllTimeTs($total)
  {
    return Profiles::find([
      'columns' => 'clan_id, clan_name, SUM(all_time_ts) AS clan_all_time_ts',
      'conditions' => 'clan_id <> 0 AND all_time_ts > 0',
      'group' => 'clan_id',
      'order' => 'clan_all_time_ts DESC',
      'limit' => $total
    ]);
  }

  public function _AllTimeTpk($total)
  {
    return Profiles::find([
      'columns' => 'clan_id, clan_name, SUM(all_time_tpk) AS clan_all_time_tpk',
      'conditions' => 'clan_id <> 0 AND all_time_tpk > 0',
      'group' => 'clan_id',
      'order' => 'clan_all_time_tpk DESC',
      'limit' => $total
    ]);
  }

  public function _TopStrongest($total)
  {
    return Profiles::find([
      'columns' => 'clan_id, clan_name, SUM(total_exp) AS clan_total_exp',
      'conditions' => 'clan_id <> 0 AND total_exp > 0',
      'group' => 'clan_id',
      'order' => 'clan_total_exp DESC',
      'limit' => $total
    ]);
  }

  public function _TopRichest($total)
  {
    return Profiles::find([
      'columns' => 'clan_id, clan_name, SUM(money) AS clan_money',
      'conditions' => 'clan_id <> 0 AND money > 0',
      'group' => 'clan_id',
      'order' => 'clan_money DESC',
      'limit' => $total
    ]);
  }

  /**
   * Clans Overview Page
   */
  public function indexAction()
  {
    $this->setTitle('Clans Overview');

    $this->view->meta_description = 'This page provides an overview of the clan records';

    // clan top survivor data
    $this->view->clan_top_survivor = $this->_TopSurvivor(5);

    // clan top player killer data
    $this->view->clan_top_player_killer = $this->_TopPlayerKiller(5);

    // clan all time ts data
    $this->view->clan_all_time_ts = $this->_AllTimeTs(5);

    // clan all time tpk data
    $this->view->clan_all_time_tpk = $this->_AllTimeTpk(5);

    // clan top strongest data
    $this->view->clan_top_strongest = $this->_TopStrongest(5);

    // clan top richest data
    $this->view->clan_top_richest = $this->_TopRichest(5);
  }

  public function WeeklyTsAction()
  {
    $this->setTitle('Clan Top Survivor');

    $this->view->meta_description = 'This page contains the list of clans with the highest weekly Top Survivor records';

    $this->assets->addJs('js/clan.records.datatables.js');

    $this->view->results = $this->_TopSurvivor(200);
  }

  public function WeeklyTpkAction()
  {
    $this->setTitle('Clan Top Player Killer');

    $this->view->meta_description = 'This page contains the list of clans with the highest weekly Top Player Killer records';

    $this->assets->addJs('js/clan.records.datatables.js');

    $this->view->results = $this->_TopPlayerKiller(200);
  }

  public function AllTimeTsAction()
  {
    $this->setTitle('Clan All Time TS');

    $this->view->meta_description = 'This page contains the list of clans with the highest All Time TS records';

    $this->assets->addJs('js/clan.records.datatables.js');

    $this->view->results = $this->_AllTimeTs(200);
  }

  public function AllTimeTpkAction()
  {
    $this->setTitle('Clan All Time TPK');

    $this->view->meta_description = 'This page contains the list of clans with the highest All Time TPK records';

    $this->assets->addJs('js/clan.records.datatables.js');

    $this->view->results = $this->_AllTimeTpk(200);
  }

  public function TopStrongestAction()
  {
    $this->setTitle('Clan Top Strongest');

    $this->view->meta_description = 'This page contains the list of the Top Strongest clans in the game';

    $this->assets->addJs('js/clan.records.datatables.js');

    $this->view->results = $this->_TopStrongest(200);
  }

  public function TopRichestAction()
  {
    $this->setTitle('Clan Top Richest');

    $this->view->meta_description = 'This page contains the list of the Top Richest clans in the game';

    $this->assets->addJs('js/clan.records.datatables.js');

    $this->view->results = $this->_TopRichest(200);
  }

  public function viewAction()
  {
    $clan_id = $this->dispatcher->getParam("clan_id");

    $this->assets->addJs('js/clan.view.datatables.js');

    $clan = Profiles::findFirst([
      'columns' => 'clan_id, clan_name,
            SUM(weekly_ts) AS clan_weekly_ts,
            SUM(weekly_tpk) AS clan_weekly_tpk,
            SUM(all_time_ts) AS clan_all_time_ts,
            SUM(all_time_tpk) AS clan_all_time_tpk,
            SUM(total_exp) AS clan_total_exp',
      'conditions' => 'clan_id = ?0 AND clan_id <> 0',
      'group' => 'clan_id',
      'bind' => [$clan_id]
    ]);

    $members = Profiles::find([
      'columns' => 'username, player_id,
        clan_rank, level, profession,
        weekly_ts, weekly_tpk, all_time_ts,
        all_time_tpk, total_exp, gm, outpost,
        armor, weapon1, weapon2, weapon3',
      'conditions' => 'clan_id = ?0 AND clan_id <> 0',
      'order' => 'username ASC',
      'bind' => [$clan_id]
    ]);

    \Phalcon\Tag::setTitle(' :: Clan - DRLP Profiler');
    $this->setTitle($clan->clan_name);

    $this->view->clan_id = $clan_id;
    $this->view->clan = $clan;
    $this->view->members = $members;
    $this->view->meta_description = $clan->clan_name . '\'s clan page - Beware that the information in this page might not be 100% accurate all the time';
  }

}
