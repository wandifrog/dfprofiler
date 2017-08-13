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

namespace DRLP\Models;

use Phalcon\Mvc\Model\Behavior\Timestampable;

class Profiles extends CacheableModel
{

  /**
   *
   * @var integer
   */
  public $id;

  /**
   *
   * @var integer
   */
  public $player_id;

  /**
   *
   * @var string
   */
  public $username;

  /**
   *
   * @var string
   */
  public $profession;

  /**
   *
   * @var integer
   */
  public $level;

  /**
   *
   * @var integer
   */
  public $exp_since_death;

  /**
   *
   * @var integer
   */
  public $weekly_ts;

  /**
   *
   * @var string
   */
  public $all_time_ts;

  /**
   *
   * @var string
   */
  public $total_exp;

  /**
   *
   * @var integer
   */
  public $weekly_tpk;

  /**
   *
   * @var string
   */
  public $all_time_tpk;

  /**
   *
   * @var string
   */
  public $outpost;

  /**
   *
   * @var string
   */
  public $money;

  /**
   *
   * @var string
   */
  public $weapon1;

  /**
   *
   * @var string
   */
  public $weapon2;

  /**
   *
   * @var string
   */
  public $weapon3;

  /**
   *
   * @var string
   */
  public $armor;

  /**
   *
   * @var integer
   */
  public $gm;

  /**
   *
   * @var string
   */
  public $gm_end;

  /**
   *
   * @var integer
   */
  public $clan_id;

  /**
   *
   * @var string
   */
  public $clan_name;

  /**
   *
   * @var string
   */
  public $clan_rank;

  /**
   *
   * @var string
   */
  public $created_at;

  /**
   *
   * @var string
   */
  public $updated_at;

  /**
   * Initialize method for model.
   */
  public function initialize()
  {
    $this->hasMany(
      'player_id',
      'DuskWinners', 'profile_id', [
        'alias' => 'DuskWinners'
      ]
    );

    $this->addBehavior(
      new Timestampable([
        'beforeCreate' => [
          'field'  => 'created_at',
          'format' => 'Y-m-d H:i:s',
        ],
        'beforeUpdate' => [
          'field'  => 'updated_at',
          'format' => 'Y-m-d H:i:s'
        ],
      ])
    );
  }

  /**
   * Returns table name mapped in the model.
   *
   * @return string
   */
  public function getSource()
  {
    return 'profiles';
  }

  public static function profileExists($player_id='')
  {
    $exists = parent::findFirstNoCache([
      'player_id = ?0',
      'bind' => [$player_id]
    ]);

    if ($exists)
    {
      return TRUE;
    }

    return FALSE;
  }

  public function getId()
  {
    return $this->id;
  }

  public function setPlayerId($player_id)
  {
    if (!is_numeric($player_id) && $player_id <= 0)
    {
      throw new \InvalidArgumentException('The Player ID needs to be a number higher than 0');
    }

    if (self::profileExists($player_id))
    {
      throw new \InvalidArgumentException('The Player ID must be unique');
    }

    $this->player_id = $player_id;
  }

  public function getPlayerId()
  {
    return $this->player_id;
  }

  public function setUsername($username)
  {
    $this->username = $username;
  }

  public function getUsername()
  {
    return $this->username;
  }

  public function setProfession($profession)
  {
    if (strlen($profession) > 32)
    {
      throw new \InvalidArgumentException('The profession name is too long');
    }

    $this->profession = $profession;
  }

  public function getProfession()
  {
    return $this->profession;
  }

  public function setLevel($level)
  {
    if (isset($level) && !is_numeric($level))
    {
      throw new \InvalidArgumentException('The level must be a number');
    }

    $this->level = $level;
  }

  public function getLevel()
  {
    return $this->level;
  }

  public function setExpSinceDeath($record)
  {
    if ($record > 0)
    {
      $this->exp_since_death = $record;
    }
    else
    {
      $this->exp_since_death = 0;
    }
  }

  public function getExpSinceDeath()
  {
    return $this->exp_since_death;
  }

  public function setWeeklyTs($record)
  {
    if ($record > 0)
    {
      $this->weekly_ts = $record;
    }
    else
    {
      $this->weekly_ts = 0;
    }
  }

  public function getWeeklyTs()
  {
    return $this->weekly_ts;
  }

  public function setAllTimeTs($record)
  {
    if ($record > 0)
    {
      $this->all_time_ts = $record;
    }
    else
    {
      $this->all_time_ts = 0;
    }
  }

  public function getAllTimeTs()
  {
    return $this->all_time_ts;
  }

  public function setTotalExp($record)
  {
    if ($record > 0)
    {
      $this->total_exp = $record;
    }
    else
    {
      $this->total_exp = 0;
    }
  }

  public function getTotalExp()
  {
    return $this->total_exp;
  }

  public function setWeeklyTpk($record)
  {
    if ($record > 0)
    {
      $this->weekly_tpk = $record;
    }
    else
    {
      $this->weekly_tpk = 0;
    }
  }

  public function getWeeklyTpk()
  {
    return $this->weekly_tpk;
  }

  public function setAllTimeTpk($record)
  {
    if ($record > 0)
    {
      $this->all_time_tpk = $record;
    }
    else
    {
      $this->all_time_tpk = 0;
    }
  }

  public function getAllTimeTpk()
  {
    return $this->all_time_tpk;
  }

  public function setOutpost($outpost)
  {
    if (isset($outpost) && !is_string($outpost))
    {
      throw new \InvalidArgumentException('The outpost name must be a string');
    }

    $this->outpost = $outpost;
  }

  public function getOutpost()
  {
    return $this->outpost;
  }

  public function setMoney($money)
  {
    if (isset($money) && !is_numeric($money))
    {
      throw new \InvalidArgumentException('The money amount must be a number');
    }

    $this->money = $money;
  }

  public function getMoney()
  {
    return $this->money;
  }

  public function setWeapon1($weapon)
  {
    $this->weapon1 = $weapon;
  }

  public function getWeapon1()
  {
    return $this->weapon1;
  }

  public function setWeapon2($weapon)
  {
    $this->weapon2 = $weapon;
  }

  public function getWeapon2()
  {
    return $this->weapon2;
  }

  public function setWeapon3($weapon)
  {
    $this->weapon3 = $weapon;
  }

  public function getWeapon3()
  {
    return $this->weapon3;
  }

  public function setArmor($armor)
  {
    $this->armor = $armor;
  }

  public function getArmor()
  {
    return $this->armor;
  }

  public function setGm($gm)
  {
    if ($gm == '1')
    {
      $this->gm = 1;
    }
    elseif ($gm == '0')
    {
      $this->gm = 0;
    }
  }

  public function getGm()
  {
    return $this->gm;
  }

  public function setGmEnd($gm_end)
  {
    if ($gm_end > 0)
    {
      $this->gm_end = $gm_end;
    }
    else
    {
      $this->gm_end = 0;
    }
  }

  public function getGmEnd()
  {
    return $this->gm_end;
  }

  public function setClanId($clan_id)
  {
    if ($clan_id == '-1')
    {
      $this->clan_id = 0;
    }
    else
    {
      $this->clan_id = $clan_id;
    }
  }

  public function getClanId()
  {
    return $this->clan_id;
  }

  public function setClanName($clan_name)
  {
    $this->clan_name = $clan_name;
  }

  public function getClanName()
  {
    return $this->clan_name;
  }

  public function setClanRank($clan_rank)
  {
    $this->clan_rank = $clan_rank;
  }

  public function getClanRank()
  {
    return $this->clan_rank;
  }

}
