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

use DRLP\Library\Utils;
use DRLP\Models\Profiles;
use Phalcon\Mvc\Url as UrlResolver;

/**
 * Theme functions are used to display bits of HTML
 */
class Theme
{
  /**
   * Formats the username
   */
  public static function username($id, $username)
  {
    $base_url = 'http://fairview.deadfrontier.com/onlinezombiemmo/?action=profile;u=';
    return '<a class="profiler-username" target="_blank" href="' . $base_url . $id  . '">' . $username . '</a> (User ID: ' . $id . ')';
  }

  /**
   * Similar to above, but used in the header for the profile pages
   */
  public static function username_header($id, $username)
  {
    $base_url = 'http://fairview.deadfrontier.com/onlinezombiemmo/?action=profile;u=';
    return '<a class="profiler-username-header" target="_blank" href="' . $base_url . $id  . '">' . $username . '</a><br>ID: ' . $id;
  }

  /**
   * Displays the exp per level
   */
  public static function experience($experience, $level)
  {
    $output = '';

    if ($experience > 0)
    {
      $output .= 'Exp: ' . number_format($experience) . ' / ';
      if ($level == 325)
      {
        $output .= Utils::exp_level($level);
      }
      else
      {
        $output .= number_format(Utils::exp_level($level));
      }
      if ($level != 325)
      {
        $output .= ' (' . number_format($experience * 100 / Utils::exp_level($level), 2) . '%)';
      }
    }
    else
    {
      $output .= 'Exp: 0 / 0 (0.00%)';
    }

    return $output;
  }

  /**
   * Displays the clan
   */
  public static function get_clan($clan_id, $clan_name, $clan_rank)
  {
    $url = new UrlResolver();

    $output = '';

    if ($clan_name && $clan_id && $clan_rank)
    {
      $clan_link = '<a href="' . $url->get('clan/view/' . $clan_id) . '">' . $clan_name . '</a>';
      $output = $clan_link . ' (Rank: ' . $clan_rank . ')';
    }

    return $output;
  }

  /**
   * Displays the usage of drugs
   */
  public static function drug($time)
  {
    $output = '';

    if (microtime(true) - $time < microtime())
    {
      $seconds = $time - REQUEST_TIME;

      $time_left = '';

      $years = floor($seconds / 31536000);
      $seconds %= 31536000;

      if ($years > 0)
      {
        $time_left .= $years . ' years, ';
      }

      $months = floor($seconds / 2592000);
      $seconds %= 2592000;

      if ($months > 0)
      {
        if ($months == 1)
        {
          $str = ' month, ';
        }
        else
        {
          $str = ' months, ';
        }

        $time_left .= $months . $str;
      }

      $weeks = floor($seconds / 604800);
      $seconds %= 604800;

      if ($weeks > 0)
      {
        if ($weeks == 1)
        {
          $str = ' week, ';
        }
        else
        {
          $str = ' weeks, ';
        }

        $time_left .= $weeks . $str;
      }

      $days = floor($seconds / 86400);
      $seconds %= 86400;

      if ($days > 0)
      {
        if ($days == 1)
        {
          $str = ' day, ';
        }
        else
        {
          $str = ' days, ';
        }

        $time_left .= $days . $str;
      }

      $hours = floor($seconds / 3600);
      $seconds %= 3600;

      if ($hours > 0)
      {
        if ($hours == 1)
        {
          $str = ' hour, ';
        }
        else
        {
          $str = ' hours, ';
        }

        $time_left .= $hours . $str;
      }

      $minutes = floor($seconds / 60);
      $seconds %= 60;

      if ($minutes > 0)
      {
        if ($minutes == 1)
        {
          $str = ' minute, ';
        }
        else
        {
          $str = ' minutes, ';
        }

        $time_left .= $minutes . $str;
      }

      $time_left .= floor($seconds) . ' seconds';

      $output .= '<i class="glyphicon glyphicon-play-circle"></i> In use: ' . $time_left . ' left';
    }
    elseif ($time == 0)
    {
      $output .= '<i class="glyphicon glyphicon-remove"></i> Never used';
    }
    else
    {
      $output .= '<i class="glyphicon glyphicon-off"></i> Last time being used was on ' . date('m/d/Y', $time);
    }

    return $output;
  }

  /**
   * Displays the GM status
   */
  public static function gm_end($gm_time, $server_time)
  {
    $output = '';

    if (empty($gm_time) || $gm_time == 0)
    {
      $output .= 'Never been a GM';
    }
    else
    {
      $output .= date('m/d/Y', (REQUEST_TIME - $server_time) + $gm_time);
    }

    return $output;
  }

  /**
   * Displays the implants
   */
  public static function implants($used, $max)
  {
    $_max = ($max == 0) ? 1 : $max;
    $percent = number_format(($used * 100) / $_max, 0);

    $output = '';

    $output .= '<div class="progress">';
    $output .= '<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="' . $percent . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . $percent . '%;">';
    $output .=  $used .'/' . $max;
    $output .= '</div>';
    $output .= '</div>';

    return $output;
  }

  /**
   * Displays the player stats
   */
  public static function stats($params)
  {
    $params += [
      'stat' => NULL,
      'type' => NULL,
      'armor_endurance' => NULL,
      'armor_agility' => NULL,
      'weapon_accuracy1' => NULL,
      'weapon_accuracy2' => NULL,
      'weapon_accuracy3' => NULL,
      'weapon_criticalhit1' => NULL,
      'weapon_criticalhit2' => NULL,
      'weapon_criticalhit3' => NULL,
      'weapon_reloading1' => NULL,
      'weapon_reloading2' => NULL,
      'weapon_reloading3' => NULL,
    ];

    extract($params);

    $output = '';

    switch ($type)
    {
      case 'endurance':
        $mc = Utils::armor_endurance($armor_endurance) / 2;
        break;
      case 'agility':
        $mc = Utils::armor_agility($armor_agility) / 2;
        break;
      case 'accuracy':
        $accuracy1 = Utils::weapon_accuracy($weapon_accuracy1);
        $accuracy2 = Utils::weapon_accuracy($weapon_accuracy2);
        $accuracy3 = Utils::weapon_accuracy($weapon_accuracy3);
        $mc = $accuracy1 + $accuracy2 + $accuracy3;
        break;
      case 'criticalhit':
        $crithit1 = Utils::weapon_criticalhit($weapon_criticalhit1);
        $crithit2 = Utils::weapon_criticalhit($weapon_criticalhit2);
        $crithit3 = Utils::weapon_criticalhit($weapon_criticalhit3);
        $mc = $crithit1 + $crithit2 + $crithit3;
        break;
      case 'reloading':
        $reloading1 = Utils::weapon_reloading($weapon_reloading1);
        $reloading2 = Utils::weapon_reloading($weapon_reloading2);
        $reloading3 = Utils::weapon_reloading($weapon_reloading3);
        $mc = $reloading1 + $reloading2 + $reloading3;
        break;
    }

    $output .= $stat;
    if ($mc > 0)
    {
      $output .= ' <span class="mc-value">+ ' . $mc . '</span>';
      $output .= ' = ';
      $output .= ' <span class="total-mc-value">' . ($stat + $mc) . '</span>';
    }

    return $output;
  }

  /**
   * Displays the weapons info
   */
  public static function weapon_info($weapon_type)
  {
    if ($weapon_type) {
      $weapon_info = explode('_', $weapon_type);
      return '[' . $weapon_info['0'] . ' ' . Utils::weapon_stats($weapon_type) . ']';
    }
    else {
      return false;
    }
  }

  /**
   * Displays the weapon image
   */
  public static function weapon_image($weapon_type)
  {
    if ($weapon_type)
    {
      $weapon_info = explode('_', $weapon_type);
      return '<img src="/images/weapons/' . $weapon_info['0'] . '.png" class="img-responsive">';
    }
    else
    {
      return false;
    }
  }

  /**
   * Displays the inventory
   */
  public static function inventory($used, $max)
  {
    $percent = number_format(($used * 100) / $max, 0);

    $output = '';

    $output .= '<div class="progress">';
    $output .= '<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="' . $percent . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . $percent . '%;">';
    $output .=  $used .'/'. $max;
    $output .= '</div>';
    $output .= '</div>';

    return $output;
  }

  /**
   * Displays the trade zone
   */
  public static function tradezone($zone_id)
  {
    switch($zone_id)
    {
  		case 3:
  			$zone = 'NE Zone';
  			break;
  		case 4:
  			$zone = 'Holdout Zone';
  			break;
  		case 5:
  		  $zone = 'Central Zone';
  			break;
  		case 9:
  			$zone = 'SE Zone';
  			break;
  		case 10:
  			$zone = 'Stockade Zone';
  			break;
  		case 11:
  			$zone = 'Prescint Zone';
  			break;
  		case 12:
  			$zone = 'Fort Zone';
  			break;
  		case 13:
  			$zone = 'Bunker Zone';
  			break;
  		default:
  		  $zone = 'Unknown';
  	}

  	return $zone;
  }

  /**
   * Displays the player health
   */
  public static function health($hp_current, $hp_max, $armor_type)
  {
    $output = '';

    $mc_endurance = Utils::armor_endurance($armor_type);
    $current_endurance = $hp_current + $mc_endurance;
    $max_endurance = $hp_max + $mc_endurance;
    $percent = number_format(($hp_current * 100) / $hp_max, 0);

    if ($percent >= 75)
    {
      $class = 'profiler-100';
    }
    elseif ($percent <= 74 && $percent >= 50)
    {
      $class = 'profiler-75';
    }
    elseif ($percent <= 49 && $percent >= 25)
    {
      $class = 'profiler-50';
    }
    elseif ($percent <= 24 && $percent >= 1)
    {
      $class = 'profiler-25';
    }
    elseif ($percent == 0)
    {
      $class = 'profiler-0';
    }

    if ($mc_endurance > 0)
    {
      $mc = ' <span class="mc-value">+' . $mc_endurance . '</span>';
    }
    else
    {
      $mc = '';
    }

    $output .= '<div class="' . $class . '">';
    $output .= $hp_current . $mc;
    $output .= ' / ';
    $output .= $hp_max . $mc;
    $output .= ' (' . $percent . '%)';
    $output .= '</div>';

    return $output;
  }

  /**
   * Displays the player nourishment
   */
  public static function nourishment($hunger)
  {
    $output = '';

    if ($hunger >= 75)
    {
      $class = 'profiler-100';
    }
    elseif ($hunger <= 74 && $hunger >= 50)
    {
      $class = 'profiler-75';
    }
    elseif ($hunger <= 49 && $hunger >= 25)
    {
      $class = 'profiler-50';
    }
    elseif ($hunger <= 24 && $hunger >= 1)
    {
      $class = 'profiler-25';
    }
    elseif ($hunger == 0)
    {
      $class = 'profiler-0';
    }

    $output .= '<div class="' . $class . '">';
    $output .= $hunger . '%';
    $output .= '</div>';

    return $output;
  }

  /**
   * Displays the armor status
   */
  public static function armor($armor, $current, $max, $name='')
  {
    $output = '';

    if ($armor)
    {
      $armor_info = explode('_', $armor);

      $percent = number_format(($current * 100) / $max, 0);
      if ($percent >= 75)
      {
        $class = 'profiler-armor-normal';
      }
      elseif ($percent <= 74 && $percent >= 40)
      {
        $class = 'profiler-armor-scratched';
      }
      elseif ($percent <= 39 && $percent >= 1)
      {
        $class = 'profiler-armor-damaged';
      }
      elseif ($percent == 0)
      {
        $class = 'profiler-armor-broken';
      }

      $output .= '<div class="' . $class . '">';
      $armor_name =  $name . '  ' . $current . '/' . $max . ' (' . $percent . '%)<br>';
      $output .= $armor_name . ' [' . $armor_info[0] . ' ' . Utils::armor_stats($armor) . ']';
      $output .= '</div>';
    }
    else
    {
      $output .= 'No Armor';
    }

    return $output;
  }

  /**
   * Displays the last hit
   */
  public static function last_hit_by($user_id)
  {
    $output = '';

    $url = new UrlResolver();

    if ($user_id != 0)
    {
      $player = Profiles::findFirst([
        'columns' => 'player_id, username',
        'player_id = ?0',
        'bind' => [$user_id]
      ]);

      // if the player doesn't exist then add it to the database
      if (!$player)
      {
        $profiler = new Profiler($user_id);
        $_player = $profiler->load();

        if (Profiles::profileExists($user_id) === FALSE)
        {
          $_player->register();
        }

        if (!$_player->result)
        {
          $output .= 'Error';
        }
        else
        {
          $output .= '<a href="' . $url->get('profile/view/' . $_player->data['id_member']) . '">' . $_player->data['account_name'] . '</a>';
        }
      }
      else
      {
        $output .= '<a href="' . $url->get('profile/view/' . $player->player_id) . '">' . $player->username . '</a>';
      }
    }
    else
    {
      $output .= 'Nobody';
    }

    return $output;
  }

  /**
   * Displays the last players killed
   */
  public static function pvp_last($player1, $player2)
  {
    $output = '';

    $url = new UrlResolver();

    if ($player1 != 0)
    {
      $player1_result = Profiles::findFirst([
        'columns' => 'player_id, username',
        'player_id = ?0',
        'bind' => [$player1]
      ]);

      // if the player doesn't exist then add it to the database
      if (!$player1_result)
      {

        $profiler1 = new Profiler($player1);
        $_player1 = $profiler1->load();

        if (Profiles::profileExists($player1) === FALSE)
        {
          $_player1->register();
        }

        if (!$_player1->result)
        {
          $output .= 'Error';
        }
        else
        {
          $output .= '<a href="' . $url->get('profile/view/' . $_player1->data['id_member']) . '">' . $_player1->data['account_name'] . '</a>';
        }
      }
      else
      {
        $output .= '<a href="' . $url->get('profile/view/' . $player1_result->player_id) . '">' . $player1_result->username . '</a>';
      }
    }

    if ($player2 != 0)
    {
      $output .= ' & ';

      $player2_result = Profiles::findFirst([
        'columns' => 'player_id, username',
        'player_id = ?0',
        'bind' => [$player2]
      ]);

      // if the player doesn't exist then add it to the database
      if (!$player2_result)
      {
        $profiler2 = new Profiler($player2);
        $_player2 = $profiler2->load();

        if (Profiles::profileExists($player2) === FALSE)
        {
          $_player2->register();
        }

        if (!$_player2->result)
        {
          $output .= 'Error';
        }
        else
        {
          $output .= '<a href="' . $url->get('profile/view/' . $_player2->data['id_member']) . '">' . $_player2->data['account_name'] . '</a>';
        }
      }
      else
      {
        $output .= '<a href="' . $url->get('profile/view/' . $player2_result->player_id) . '">' . $player2_result->username . '</a>';
      }
    }

    if (!$player1 && !$player2)
    {
      $output .= 'Nobody';
    }

    return $output;
  }
}
