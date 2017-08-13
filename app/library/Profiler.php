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

namespace DRLP\Library;

use GuzzleHttp\Pool;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\ConnectException;
use DRLP\Models\Profiles;

define('GET_VALUES', 'http://fairview.deadfrontier.com/onlinezombiemmo/');

class Profiler
{
  public $ids = NULL;
  public $data = NULL;
  public $success = FALSE;
  public $error_messages = array();
  public $result = FALSE;

  public function __construct($ids)
  {
    $this->ids = $ids;
  }

  public function load()
  {
    if (is_numeric($this->ids))
    {
      $client = new Client(['base_uri' => GET_VALUES]);

      try
      {
        $response = $client->request('GET', 'get_values.php', [
          'query' => ['userID' => $this->ids]
        ]);

        if ($response)
        {
          $body = trim(substr($response->getBody(), 3));
          $http_code = $response->getStatusCode();
          parse_str($body, $data);

          $this->data = $data;
          $this->http_code = $http_code;

          if ($this->http_code == 200 && !empty($this->data['id_member']))
          {
            $this->result = TRUE;
          }
          else
          {
            $this->result = FALSE;
          }

          return $this;
        }
      }
      catch (ConnectException $e)
      {
        return FALSE;
      }
    }
  }

  public function register()
  {
    if ($this->result)
    {
      try
      {
        $profile = new Profiles();

        $profile->setPlayerId($this->data['id_member']);
        $profile->setUsername($this->data['account_name']);
        $profile->setProfession($this->data['df_profession']);
        $profile->setLevel($this->data['df_level']);
        $profile->setExpSinceDeath($this->data['df_expdeath']);
        $profile->setWeeklyTs($this->data['df_expdeathrecord_weekly']);
        $profile->setAllTimeTs($this->data['df_expdeathrecord']);
        $profile->setTotalExp($this->data['df_exptotal']);
        $profile->setWeeklyTpk($this->data['df_playerkills_weekly']);
        $profile->setAllTimeTpk($this->data['df_playerkills']);
        $profile->setOutpost($this->data['df_minioutpostname']);
        $profile->setMoney($this->data['df_bankcash'] + $this->data['df_cash']);
        $profile->setWeapon1($this->data['df_weapon1type']);
        $profile->setWeapon2($this->data['df_weapon2type']);
        $profile->setWeapon3($this->data['df_weapon3type']);
        $profile->setArmor($this->data['df_armourtype']);
        $profile->setGm($this->data['df_goldmember']);
        $profile->setGmEnd($this->data['df_goldmembertime']);
        $profile->setClanId($this->data['df_clan_id']);
        $profile->setClanName($this->data['df_clan_name']);
        $profile->setClanRank($this->data['df_clan_rank']);

        if($profile->create() == FALSE)
        {
          $this->success = FALSE;

          foreach ($profile->getMessages() as $message)
          {
            $this->error_messages[] = $message;
          }
        }

        $this->success = TRUE;
        $this->result = TRUE;

        return $this;
      }
      catch (\InvalidArgumentException $e)
      {
        $message = '[' . __METHOD__ . '] ' . $e->getMessage();
      }
    }
  }

  public function update()
  {
    if ($this->result)
    {
      try
      {
        $profile = Profiles::findFirstNoCache([
          'player_id = ?0',
          'bind' => [$this->ids]
        ]);

        if ($profile)
        {
          $profile->setUsername($this->data['account_name']);
          $profile->setProfession($this->data['df_profession']);
          $profile->setLevel($this->data['df_level']);
          $profile->setExpSinceDeath($this->data['df_expdeath']);
          $profile->setWeeklyTs($this->data['df_expdeathrecord_weekly']);
          $profile->setAllTimeTs($this->data['df_expdeathrecord']);
          $profile->setTotalExp($this->data['df_exptotal']);
          $profile->setWeeklyTpk($this->data['df_playerkills_weekly']);
          $profile->setAllTimeTpk($this->data['df_playerkills']);
          $profile->setOutpost($this->data['df_minioutpostname']);
          $profile->setMoney($this->data['df_bankcash'] + $this->data['df_cash']);
          $profile->setWeapon1($this->data['df_weapon1type']);
          $profile->setWeapon2($this->data['df_weapon2type']);
          $profile->setWeapon3($this->data['df_weapon3type']);
          $profile->setArmor($this->data['df_armourtype']);
          $profile->setGm($this->data['df_goldmember']);
          $profile->setGmEnd($this->data['df_goldmembertime']);
          $profile->setClanId($this->data['df_clan_id']);
          $profile->setClanName($this->data['df_clan_name']);
          $profile->setClanRank($this->data['df_clan_rank']);

          if($profile->update() == FALSE)
          {
            $this->success = FALSE;

            foreach ($profile->getMessages() as $message)
            {
              $this->error_messages[] = $message;
            }
          }

          $this->success = TRUE;
          $this->result = TRUE;

          return $this;
        }

        $this->result = FALSE;
      }
      catch (\InvalidArgumentException $e)
      {
        $message = '[' . __METHOD__ . '] ' . $e->getMessage();
      }
    }
  }

  function register_multiple()
  {
    if (is_array($this->ids))
    {
      $client = new Client();

      $requests = function()
      {
        foreach($this->ids as $id)
        {
          $uri = GET_VALUES . 'get_values.php?userID=' . $id;
          yield new Request('GET', $uri);
        }
      };

      $config = \Phalcon\DI\FactoryDefault::getDefault()->getShared('config');

      $pool = new Pool($client, $requests(), [
        'concurrency' => $config->application->concurrency,
        'fulfilled' => function ($response, $index)
        {
          $body = trim(substr($response->getBody(), 3));
          $http_code = $response->getStatusCode();
          parse_str($body, $data);

          if ($http_code == 200 && !empty($data['id_member']))
          {
            try
            {
              $profile = new Profiles();

              $profile->setPlayerId($data['id_member']);
              $profile->setUsername($data['account_name']);
              $profile->setProfession($data['df_profession']);
              $profile->setLevel($data['df_level']);
              $profile->setExpSinceDeath($data['df_expdeath']);
              $profile->setWeeklyTs($data['df_expdeathrecord_weekly']);
              $profile->setAllTimeTs($data['df_expdeathrecord']);
              $profile->setTotalExp($data['df_exptotal']);
              $profile->setWeeklyTpk($data['df_playerkills_weekly']);
              $profile->setAllTimeTpk($data['df_playerkills']);
              $profile->setOutpost($data['df_minioutpostname']);
              $profile->setMoney($data['df_bankcash'] + $data['df_cash']);
              $profile->setWeapon1($data['df_weapon1type']);
              $profile->setWeapon2($data['df_weapon2type']);
              $profile->setWeapon3($data['df_weapon3type']);
              $profile->setArmor($data['df_armourtype']);
              $profile->setGm($data['df_goldmember']);
              $profile->setGmEnd($data['df_goldmembertime']);
              $profile->setClanId($data['df_clan_id']);
              $profile->setClanName($data['df_clan_name']);
              $profile->setClanRank($data['df_clan_rank']);

              if($profile->create())
              {
                echo $index . ' - Importing: ' . $data['account_name'] . ' (' . $data['id_member'] . ')' . PHP_EOL;
              }
              else
              {
                $error_msg = $index . ' - Error: Cannot save ' . $data['account_name'] . ' (' . $data['id_member'] . '): ';

                echo $error_msg . PHP_EOL;

                foreach ($profile->getMessages() as $message)
                {
                  echo '  - ' . $message . PHP_EOL;
                  $err_messages[] = $message;
                }
              }
            }
            catch (\InvalidArgumentException $e)
            {
              $message = '[' . __METHOD__ . '] ' . $e->getMessage();
            }
          }
        },
        'rejected' => function ($reason, $index)
        {
          $rejected_msg = $index . ' - Error: ' . $reason;

          echo $rejected_msg  . PHP_EOL;
        },
      ]);

      // Initiate the transfers and create a promise
      $promise = $pool->promise();

      // Force the pool of requests to complete.
      $promise->wait();
    }
  }

  function update_multiple()
  {
    if (is_array($this->ids))
    {
      $client = new Client();

      $requests = function()
      {
        foreach($this->ids as $id)
        {
          $uri = GET_VALUES . 'get_values.php?userID=' . $id;
          yield new Request('GET', $uri);
        }
      };

      $config = \Phalcon\DI\FactoryDefault::getDefault()->getShared('config');

      $pool = new Pool($client, $requests(), [
        'concurrency' => $config->application->concurrency,
        'fulfilled' => function ($response, $index)
        {
          $body = trim(substr($response->getBody(), 3));
          $http_code = $response->getStatusCode();
          parse_str($body, $data);

          if ($http_code == 200 && !empty($data['id_member']))
          {
            try
            {
              $profile = Profiles::findFirstNoCache([
                'player_id = ?0',
                'bind' => [$data['id_member']]
              ]);

              if ($profile)
              {
                $profile->setUsername($data['account_name']);
                $profile->setProfession($data['df_profession']);
                $profile->setLevel($data['df_level']);
                $profile->setExpSinceDeath($data['df_expdeath']);
                $profile->setWeeklyTs($data['df_expdeathrecord_weekly']);
                $profile->setAllTimeTs($data['df_expdeathrecord']);
                $profile->setTotalExp($data['df_exptotal']);
                $profile->setWeeklyTpk($data['df_playerkills_weekly']);
                $profile->setAllTimeTpk($data['df_playerkills']);
                $profile->setOutpost($data['df_minioutpostname']);
                $profile->setMoney($data['df_bankcash'] + $data['df_cash']);
                $profile->setWeapon1($data['df_weapon1type']);
                $profile->setWeapon2($data['df_weapon2type']);
                $profile->setWeapon3($data['df_weapon3type']);
                $profile->setArmor($data['df_armourtype']);
                $profile->setGm($data['df_goldmember']);
                $profile->setGmEnd($data['df_goldmembertime']);
                $profile->setClanId($data['df_clan_id']);
                $profile->setClanName($data['df_clan_name']);
                $profile->setClanRank($data['df_clan_rank']);

                if($profile->update() == FALSE)
                {
                  $error_msg = $index . ' - Error: Cannot update ' . $data['account_name'] . ' (' . $data['id_member'] . '): ';

                  echo $error_msg . PHP_EOL;

                  foreach ($profile->getMessages() as $message)
                  {
                    echo $message . PHP_EOL;
                    $err_messages[] = $message;
                  }
                }
                else
                {
                  echo $index . ' - Updating: ' . $data['account_name'] . ' (' . $data['id_member'] . ')' . PHP_EOL;
                }
              }
            }
            catch (\InvalidArgumentException $e)
            {
              $message = '[' . __METHOD__ . '] ' . $e->getMessage();
            }
          }
        },
        'rejected' => function ($reason, $index)
        {
          $rejected_msg = $index . ' - Error: ' . $reason;

          echo $rejected_msg  . PHP_EOL;
        },
      ]);

      // Initiate the transfers and create a promise
      $promise = $pool->promise();

      // Force the pool of requests to complete.
      $promise->wait();
    }
  }

}
