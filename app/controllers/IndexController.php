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

use DRLP\Forms\SimpleSearchForm;
use DRLP\Forms\MultipleSearchForm;
use DRLP\Models\Profiles;
use DRLP\Models\Damage;

/**
 * Homepage
 */

class IndexController extends ControllerBase
{

  public function indexAction()
  {
    $this->setTitle('Home');

    $this->view->meta_description = 'The Ultimate Dead Frontier Profiler Homepage';

    $this->assets->addJs('js/search.js');

    // This is the homepage
    $this->view->is_home = TRUE;

    // Forms Token
    $this->view->form_token = $this->security->getSessionToken();

    // Simple Search Form
    $this->view->form_simple = new SimpleSearchForm();

    // Multiple Search Form
    $this->view->form_multiple = new MultipleSearchForm();

    // top survivor data
    $this->view->top_survivor = Profiles::find([
      'columns' => 'username, player_id, weekly_ts',
      'order' => 'weekly_ts DESC',
      'limit' => 5
    ]);

    // top player killer data
    $this->view->top_player_killer = Profiles::find([
      'columns' => 'username, player_id, weekly_tpk',
      'order' => 'weekly_tpk DESC',
      'limit' => 5
    ]);

    // clan top survivor data
    $this->view->clan_top_survivor = Profiles::find([
      'columns' => 'clan_id, clan_name, SUM(weekly_ts) AS clan_weekly_ts',
      'conditions' => 'clan_id <> 0',
      'group' => 'clan_id',
      'order' => 'clan_weekly_ts DESC',
      'limit' => 5
    ]);

    // clan top player killer data
    $this->view->clan_top_player_killer = Profiles::find([
      'columns' => 'clan_id, clan_name, SUM(weekly_tpk) AS clan_weekly_tpk',
      'conditions' => 'clan_id <> 0',
      'group' => 'clan_id',
      'order' => 'clan_weekly_tpk DESC',
      'limit' => 5
    ]);

    // latest players
    $this->view->latest_players = Profiles::find([
      'columns' => 'username, player_id, created_at',
      'order' => 'created_at DESC',
      'limit' => 5
    ]);

    // guns
    $this->view->weapons = Damage::find([
      'order' => 'damage DESC',
      'limit' => 10
    ]);
  }

  public function simpleSearchAction()
  {
    if ($this->request->isPost())
    {
      $form = new SimpleSearchForm();

      if ($form->isValid($this->request->getPost()) != FALSE)
      {
        $player = $this->request->getPost('username', 'striptags');

        $id = NULL;

        if (isset($player) && is_numeric($player))
        {
          $id = $player;
        }
        else
        {
          $profile = Profiles::findFirstNoCache([
            "username = ?0",
            "bind" => [$player]
          ]);

          if($profile) $id = $profile->player_id;
        }

        if ($id)
        {
          return $this->response->redirect('profile/view/' . $id);
        }

        $this->flash->error('This username is not valid, try searching using the User ID');

        return $this->response->redirect('/');
      }
    }
  }

  public function multipleSearchAction()
  {
    if ($this->request->isPost())
    {
      $form = new MultipleSearchForm();

      if ($form->isValid($this->request->getPost()) != FALSE)
      {
        $player1 = $this->request->getPost('username1', 'striptags');
        $player2 = $this->request->getPost('username2', 'striptags');
        $player3 = $this->request->getPost('username3', 'striptags');
        $player4 = $this->request->getPost('username4', 'striptags');

        $players = [];

        if (isset($player1) && is_numeric($player1))
        {
          $players[] = $player1;
        }
        else
        {
          $profile1 = Profiles::findFirstNoCache([
            "username = ?0",
            "bind" => [$player1]
          ]);

          if($profile1) $players[] = $profile1->player_id;
        }

        if (isset($player2) && is_numeric($player2))
        {
          $players[] = $player2;
        }
        else
        {
          $profile2 = Profiles::findFirstNoCache([
            "username = ?0",
            "bind" => [$player2]
          ]);

          if($profile2) $players[] = $profile2->player_id;
        }

        if (isset($player3) && is_numeric($player3))
        {
          $players[] = $player3;
        }
        else
        {
          $profile3 = Profiles::findFirstNoCache([
            "username = ?0",
            "bind" => [$player3]
          ]);

          if($profile3) $players[] = $profile3->player_id;
        }

        if (isset($player4) && is_numeric($player4))
        {
          $players[] = $player4;
        }
        else
        {
          $profile4 = Profiles::findFirstNoCache([
            "username = ?0",
            "bind" => [$player4]
          ]);

          if($profile4) $players[] = $profile4->player_id;
        }

        $id_list = implode(':', $players);

        if (count($players) > 1)
        {
          return $this->response->redirect('/multiple/view/' . $id_list);
        }

        if (empty($players))
        {
          $this->flash->error("Please enter some valid usernames");

          return $this->response->redirect('/');
        }

        return $this->response->redirect('/profile/view/' . $id_list);
      }
    }
  }

}
