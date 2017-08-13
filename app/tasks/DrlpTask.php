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

use DRLP\Models\Profiles;
use DRLP\Models\Damage;
use DRLP\Models\DuskWinners;
use DRLP\Library\Profiler;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;

define('REQUEST_TIME', (int) $_SERVER['REQUEST_TIME']);

class DrlpTask extends \Phalcon\CLI\Task
{

  public function initialize()
  {
    // insert your own code here if you need to
  }

  public function mainAction()
  {
      echo "\nThis is the default task and the default action \n";
  }

  /**
   * @param array $params
   */
  public function updateAction(array $params)
  {
    switch ($params[0])
    {
      /**
       * Syncs all profiles
       */
      case 'profiles':
        $profiles = Profiles::findNoCache();

        if ($profiles)
        {
          echo "There are " . count($profiles) . " profiles..." . PHP_EOL;

          $ids = [];

          foreach($profiles as $p)
          {
            $update_time = REQUEST_TIME - strtotime($p->updated_at);

            // only update profiles that were not updated recently
            if ($update_time >= 7200)
            {
              $ids[] = $p->player_id;
            }
          }

          if (!empty($ids))
          {
            echo 'We will update ' . count($ids) . ' profiles...' . PHP_EOL;

            $profiler = new Profiler($ids);
            $profiler->update_multiple();
          }
          else
          {
            echo 'Hooray! Nothing to update!';
          }
        }

        break;
      /**
       * Update weapons data
       */
      case 'weapons':
        $url = 'http://fairview.deadfrontier.com/onlinezombiemmo/dfdata/';

        $client = new Client(['base_uri' => $url]);

        try {
          $response = $client->request('GET', 'damagepersec.php');

          if ($response)
          {
            $http_code = $response->getStatusCode();

            if ($http_code == 200)
            {
              echo "Deleting old records... ";
              $weapons = Damage::find();
              $weapons->delete();
              echo "done" . PHP_EOL;

              $output = str_replace('<b>', '', trim($response->getBody()));
              $output = str_replace('</b>', '', $output);
              $output = str_replace('<br>', '|', $output);
              $output = str_replace('(', '', $output);
              $output = str_replace(')', '', $output);
              $output = trim($output);

              $list = explode('|', $output);

              $regexp = "/^(.*)\:\s(.*)\s(.*)$/i";

              foreach ($list as $item) {
                if (preg_match($regexp, $item, $matches)) {
                  $weapon = new Damage();
                  $weapon->name = $matches[1];
                  $weapon->damage = $matches[2];
                  $weapon->critical = $matches[3];

                  if ($weapon->save()) {
                    echo 'Adding: ' . $weapon->name . PHP_EOL;
                  }
                }
              }
            }
          }
        } catch (ConnectException $e) {
          return FALSE;
        }

        break;

    }
  }

  /**
   * @param array $params
   */
  public function importAction(array $params)
  {
    switch ($params[0])
    {
      /**
       * This is a helper function to help you migrate data from another site
       * or database. I used this to migrate the data from the old site into this one.
       * It only needs the DF Player ID and username, after you get all the IDs then just update
       * the profiles and all the rest of the data will be pulled from the DF server.
       */
      case 'data':
        echo 'Attempting to connect to the server...' . PHP_EOL;

        $url = 'http://www.domain.com/my-json-data-url';
        $client = new Client();
        $response = $client->get($url);

        if ($response)
        {
          $http_code = $response->getStatusCode();

          if ($http_code == 200)
          {
            echo "Connected to server!" . PHP_EOL;

            $data = json_decode($response->getBody());

            foreach($data as $id => $username)
            {
              $ids[] = $id;
            }

            $profiler = new Profiler($ids);
            $profiler->register_multiple();
          }
        }
      break;
    }
  }

  /**
   * @param array $params
   */
  public function duskwinnerAction(array $params)
  {
    $date_start = date("Y-m-d H:i:s", mktime(0, 0, 0, date("m"), date("d") - 6, date("Y")));
    $date_end = date("Y-m-d H:i:s", REQUEST_TIME);

    switch ($params[0])
    {
      /**
       * Update TS winners
       */
      case 'ts':
        $query = Profiles::findFirstNoCache([
          'columns' => 'player_id',
          'order' => 'weekly_ts DESC',
        ]);

        $profiler = new Profiler($query->player_id);
        $player = $profiler->load();

        if ($player->result)
        {
          $winner = new DuskWinners();

          $winner->profile_id = $player->data['id_member'];
          $winner->level = $player->data['df_level'];
          $winner->profession = $player->data['df_profession'];
          $winner->date_start = $date_start;
          $winner->date_end = $date_end;
          $winner->competition = 'ts';
          $winner->record = $player->data['df_expdeathrecord_weekly'];

          if($winner->create())
          {
            echo 'Username: ' . $player->data['account_name'] . PHP_EOL .
                 'ID: ' . $player->data['id_member'] . PHP_EOL .
                 'Level: ' . $player->data['df_level'] . PHP_EOL .
                 'Profession: ' . $player->data['df_profession'] . PHP_EOL .
                 'Date Start: ' . $date_start . PHP_EOL .
                 'Date End: ' . $date_end . PHP_EOL .
                 'TS Record: ' . number_format($player->data['df_expdeathrecord_weekly']) . PHP_EOL;
          }
          else
          {
            $message = 'Error: Cannot save Dusk Winner...' . PHP_EOL;

            foreach ($winner->getMessages() as $message) {
              $message .= ' - ' . $message . PHP_EOL;
            }

            echo $message;
          }
        }
        break;
      /**
       * Update TPK winners
       */
      case 'tpk':
        $query = Profiles::findFirstNoCache([
          'columns' => 'player_id',
          'order' => 'weekly_tpk DESC',
        ]);

        $profiler = new Profiler($query->player_id);
        $player = $profiler->load();

        if ($player->result)
        {
          $winner = new DuskWinners();

          $winner->profile_id = $player->data['id_member'];
          $winner->level = $player->data['df_level'];
          $winner->profession = $player->data['df_profession'];
          $winner->date_start = $date_start;
          $winner->date_end = $date_end;
          $winner->competition = 'tpk';
          $winner->record = $player->data['df_playerkills_weekly'];

          if($winner->create())
          {
            echo 'Username: ' . $player->data['account_name'] . PHP_EOL .
                 'ID: ' . $player->data['id_member'] . PHP_EOL .
                 'Level: ' . $player->data['df_level'] . PHP_EOL .
                 'Profession: ' . $player->data['df_profession'] . PHP_EOL .
                 'Date Start: ' . $date_start . PHP_EOL .
                 'Date End: ' . $date_end . PHP_EOL .
                 'TPK Record: ' . number_format($player->data['df_playerkills_weekly']) . PHP_EOL;
          }
          else
          {
            $message = 'Error: Cannot save Dusk Winner...' . PHP_EOL;

            foreach ($winner->getMessages() as $message) {
              $message .= ' - ' . $message . PHP_EOL;
            }

            echo $message;
          }
        }
      break;
    }
  }
}
