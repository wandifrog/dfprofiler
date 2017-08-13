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

/**
 * Util functions. These mostly calculate stuff.
 */
class Utils
{
  /**
   * Calculates the exp by level
   */
  public static function exp_level($level)
  {
    $level_exp = [
      '125' => '1',
      '250' => '2',
      '500' => '3',
      '1000' => '4',
      '1750' => '5',
      '2500' => '6',
      '3250' => '7',
      '4000' => '8',
      '5000' => '9',
      '6000' => '10',
      '8000' => '11',
      '10000' => '12',
      '12000' => '13',
      '14000' => '14',
      '16000' => '15',
      '20000' => '16',
      '24000' => '17',
      '28000' => '18',
      '32000' => '19',
      '36000' => '20',
      '40000' => '21',
      '45000' => '22',
      '50000' => '23',
      '55000' => '24',
      '60000' => '25',
      '65000' => '26',
      '70000' => '27',
      '75000' => '28',
      '100000' => '29',
      '120000' => '30',
      '140000' => '31',
      '160000' => '32',
      '180000' => '33',
      '200000' => '34',
      '220000' => '35',
      '260000' => '36',
      '300000' => '37',
      '350000' => '38',
      '400000' => '39',
      '450000' => '40',
      '500000' => '41',
      '550000' => '42',
      '600000' => '43',
      '650000' => '44',
      '700000' => '45',
      '750000' => '46',
      '800000' => '47',
      '900000' => '48',
      '1000000' => '49',
      '1100000' => '50',
      '1200000' => '51',
      '1300000' => '52',
      '1400000' => '53',
      '1500000' => '54',
      '1600000' => '55',
      '1700000' => '56',
      '1800000' => '57',
      '1900000' => '58',
      '2000000' => '59',
      '2100000' => '60',
      '2200000' => '61',
      '2300000' => '62',
      '2400000' => '63',
      '2500000' => '64',
      '2600000' => '65',
      '2700000' => '66',
      '2800000' => '67',
      '2900000' => '68',
      '3000000' => '69',
      '3100000' => '70',
      '3200000' => '71',
      '3300000' => '72',
      '3400000' => '73',
      '3500000' => '74',
      '3600000' => '75',
      '3700000' => '76',
      '3800000' => '77',
      '3900000' => '78',
      '4000000' => '79',
      '4100000' => '80',
      '4200000' => '81',
      '4300000' => '82',
      '4400000' => '83',
      '4500000' => '84',
      '4600000' => '85',
      '4700000' => '86',
      '4800000' => '87',
      '4900000' => '88',
      '5000000' => '89',
      '5100000' => '90',
      '5200000' => '91',
      '5300000' => '92',
      '5400000' => '93',
      '5500000' => '94',
      '5600000' => '95',
      '5700000' => '96',
      '5800000' => '97',
      '5900000' => '98',
      '6000000' => '99',
      '6100000' => '100',
      '6200000' => '101',
      '6300000' => '102',
      '6400000' => '103',
      '6500000' => '104',
      '6600000' => '105',
      '6700000' => '106',
      '6800000' => '107',
      '6900000' => '108',
      '7000000' => 'max',
      '15000000' => '200to219',
      '60000000' => '220to325',
      'I have no life' => '325',
    ];

    if($level >= 109 && $level <= 199)
    {
      $level_exp_search = array_search('max', $level_exp);
    }
    elseif($level >= 200 && $level <= 219)
    {
      $level_exp_search = array_search('200to219', $level_exp);
    }
    elseif($level >= 220 && $level < 325)
    {
      $level_exp_search = array_search('220to325', $level_exp);
    }
    elseif($level == 325)
    {
      $level_exp_search = array_search('325', $level_exp);
    }
    else
    {
      $level_exp_search = array_search($level, $level_exp);
    }

    return $level_exp_search;
  }

  /**
   * Calculates the used inventory
   */
  public static function used_inv($items)
  {
    $slot[1] = $items['slot1'];
    $slot[2] = $items['slot2'];
    $slot[3] = $items['slot3'];
    $slot[4] = $items['slot4'];
    $slot[5] = $items['slot5'];
    $slot[6] = $items['slot6'];
    $slot[7] = $items['slot7'];
    $slot[8] = $items['slot8'];
    $slot[9] = $items['slot9'];
    $slot[10] = $items['slot10'];
    $slot[11] = $items['slot11'];
    $slot[12] = $items['slot12'];
    $slot[13] = $items['slot13'];
    $slot[14] = $items['slot14'];
    $slot[15] = $items['slot15'];
    $slot[16] = $items['slot16'];
    $slot[17] = $items['slot17'];
    $slot[18] = $items['slot18'];
    $slot[19] = $items['slot19'];
    $slot[20] = $items['slot20'];
    $slot[21] = $items['slot21'];
    $slot[22] = $items['slot22'];
    $slot[23] = $items['slot23'];
    $slot[24] = $items['slot24'];
    $slot[25] = $items['slot25'];
    $slot[26] = $items['slot26'];
    $slot[27] = $items['slot27'];
    $slot[28] = $items['slot28'];
    $slot[29] = $items['slot29'];
    $slot[30] = $items['slot30'];
    $total = $items['total'];

    $used_inv_slots = array();

    for ($i=1;$i<=$total;$i++)
    {
      if (!empty($slot[$i]))
      {
        $used_inv_slots[$i] = $i;
      }
    }

    return count($used_inv_slots);
  }

  /**
   * Formats the info
   */
  public static function armor_info($armor='')
  {
    if ($armor)
    {
      $armor_info = explode('_', $armor);
      $armor_type = $armor_info[0];

      if (!empty($armor_info[3]))
      {
        $armor_name = str_replace('name', '', $armor_info[3]);
      }
      else
      {
        $armor_name = '';
      }

      return $armor_name . ' [' .$armor_type . ' ' . self::armor_stats($armor) . ']';
    }
  }

  /**
   * Calculates the armor stats
   */
  public static function armor_stats($armor='')
  {
    if ($armor)
    {
      $armor = preg_replace("/_name(.*)/", "", $armor);
      if (preg_match("/stats/", $armor))
      {
        $stats = substr_replace(substr($armor, -4), '/', -2, -2);
      }
      else
      {
        $stats = '00/00';
      }
    }
    else
    {
      return NULL;
    }

    return $stats;
  }

  /**
   * Calculates the armor endurance stats
   */
  public static function armor_endurance($armor='')
  {
    if ($armor)
    {
      $armor = preg_replace("/_name(.*)/", "", $armor);
      if (preg_match("/stats/", $armor))
      {
        $stats = substr($armor, -4);
        $stats = substr($stats, strlen($stats)-2, 2);
      }
      else
      {
        $stats = 0;
      }
    }
    else
    {
      return NULL;
    }

    return $stats * 2;
  }

  /**
   * Calculates the armor agility stats
   */
  public static function armor_agility($armor='')
  {
    if ($armor)
    {
      $armor = preg_replace("/_name(.*)/", "", $armor);
      if (preg_match("/stats/", $armor))
      {
        $stats = substr($armor, -4);
        $stats = substr($stats, 0, -2);
      }
      else
      {
        $stats = 0;
      }
    }
    else
    {
      return NULL;
    }

    return $stats * 2;
  }

  /**
   * Calculates the weapon stats
   */
  public static function weapon_stats($weapon='')
  {
    if ($weapon)
    {
      $weapon_stats = explode('_', $weapon);

      if (!isset($weapon_stats[1]))
      {
         $stats = '0/0/0';
      }
      elseif (preg_match("/stats/", $weapon_stats[1]))
      {
        $stats = substr($weapon_stats[1], -3);
        $stats = substr_replace($stats, '/', -1, -1);
        $stats = substr_replace($stats, '/', -3, -3);
      }
    }
    else
    {
      return NULL;
    }

    return $stats;
  }

  /**
   * Calculates the weapon accuracy
   */
  public static function weapon_accuracy($weapon='')
  {
    if ($weapon)
    {
      $weapon_stats = explode('_', $weapon);

      if (!isset($weapon_stats[1]))
      {
        $accuracy = 0;
      }
      elseif (preg_match("/stats/", $weapon_stats[1]))
      {
        $accuracy = substr($weapon_stats[1], -3);
        $accuracy = substr($accuracy, 0, -2);
      }
    }
    else
    {
      return NULL;
    }

    return $accuracy;
  }

  /**
   * Calculates the weapon reloading
   */
  public static function weapon_reloading($weapon='')
  {
    if ($weapon)
    {
      $weapon_stats = explode('_', $weapon);

      if (!isset($weapon_stats[1]))
      {
        $reloading = 0;
      }
      elseif (preg_match("/stats/", $weapon_stats[1]))
      {
        $reloading = substr($weapon_stats[1], -3);
        $reloading = substr($reloading, 1, -1);
      }
    }
    else
    {
      return NULL;
    }

    return $reloading;
  }

  /**
   * Calculates the weapon critical hit
   */
  public static function weapon_criticalhit($weapon='')
  {
    if ($weapon)
    {
      $weapon_stats = explode('_', $weapon);

      if (!isset($weapon_stats[1]))
      {
        $criticalhit = 0;
      }
      elseif (preg_match("/stats/", $weapon_stats[1]))
      {
        $criticalhit = substr($weapon_stats[1], -3);
        $criticalhit = substr($criticalhit, -1);
      }
    }
    else
    {
      return NULL;
    }

    return $criticalhit;
  }

  /**
   * Calculates the coordinates of the player in the map
   */
  public static function gps_pos($x, $y)
  {
    if ($x == 2002 && $y == 2000)
    {
      $posx = 1042;
      $posy = 1010;
    }
    else {
      $posx = $x;
      $posy = $y;
    }

    return array($posx, $posy);
  }

  /**
   * Calculates the account creation date and formats it
   */
  public static function account_creation($server_time, $creation_time)
  {
    $creation_date = (REQUEST_TIME - $server_time) + $creation_time;

    return date('m/d/Y', $creation_date);
  }

  /**
   * Formats the last spawn date
   */
  public static function last_spawn($spawn_time, $server_time)
  {
    $output = '';

    if (empty($spawn_time) || $spawn_time == 0)
    {
      $output .= 'Unknown';
    }
    else
    {
      $output .= date('m/d/Y', (REQUEST_TIME - $server_time) + $spawn_time);
    }

    return $output;
  }

  /**
   * Calculates the amount of implants used
   */
  public static function implant_count($implants)
  {
    $slot[1] = $implants['implant1'];
    $slot[2] = $implants['implant2'];
    $slot[3] = $implants['implant3'];
    $slot[4] = $implants['implant4'];
    $slot[5] = $implants['implant5'];
    $slot[6] = $implants['implant6'];
    $slot[7] = $implants['implant7'];
    $slot[8] = $implants['implant8'];
    $slot[9] = $implants['implant9'];
    $slot[10] = $implants['implant10'];
    $slot[11] = $implants['implant11'];
    $slot[12] = $implants['implant12'];
    $slot[13] = $implants['implant13'];
    $slot[14] = $implants['implant14'];
    $slot[15] = $implants['implant15'];
    $slot[16] = $implants['implant16'];
    $slot[17] = $implants['implant17'];
    $slot[18] = $implants['implant18'];
    $slot[19] = $implants['implant19'];
    $slot[20] = $implants['implant20'];
    $total = $implants['total'];

    $implants_used = array();

    for ($i=1;$i<=$total;$i++)
    {
      if (!empty($slot[$i]))
      {
        $implants_used[$i] = $i;
      }
    }

    return count($implants_used);
  }

  /**
   * Check if the weapon is available
   */
  public static function weapon_check($weapon_type)
  {
    return ($weapon_type) ? FALSE : TRUE;
  }

  /**
   * Calculates the exp bonus.
   * It also takes into consideration the bonuses for events.
   */
  public static function exp_bonus($profession, $gm, $exp_boost, $hunger, $event_bonus)
  {
    switch ($profession)
    {
      case 'Farmer':
      case 'Scientist':
      case 'Doctor':
      case 'Chef':
      case 'Engineer':
      case 'Boxer':
      case 'Police Officer':
      case 'Fireman':
      case 'Athlete':
        $bonus = 1;
        break;
      case 'Soldier':
      case 'Special Forces':
        $bonus = 0.8;
        break;
      case 'Teacher':
      case 'Priest':
      case 'Lawyer':
      case 'Accountant':
      case 'Journalist':
      case 'Actor':
      case 'Stock Broker':
      case 'Architect':
      case 'Entertainer':
        $bonus = 1.3;
        break;
      case 'Student':
        $bonus = 1.22;
        break;
      default:
        $bonus = 0;
    }

    $bonus_gm = ($gm) ? 2 : 1;
    $bonus_exp = (microtime(true) - $exp_boost < microtime()) ? 1.5 : 1;

    $bonus_hunger = '';

    if (self::between($hunger, 75, 100))
    {
      $bonus_hunger = 1.25;
    }

    if (self::between($hunger, 74, 50))
    {
      $bonus_hunger = 1;
    }

    if (self::between($hunger, 25, 49))
    {
      $bonus_hunger = 0.75;
    }

    if (self::between($hunger, 0, 24))
    {
      $bonus_hunger = 0.50;
    }

    $output = '';

    if ($event_bonus > 0)
    {
      $output .= ($bonus * $bonus_gm * $bonus_exp * $bonus_hunger * $event_bonus) * 100 . '%';
    }
    else
    {
      $output .= ($bonus * $bonus_gm * $bonus_exp * $bonus_hunger) * 100 . '%';
    }

    return $output;
  }

  /**
   * Helper function to display the statistics
   */
  public static function flot($placeholder, $data, $type)
  {
    $output = '';
    $output = '
    <script type="text/javascript">
      jQuery(document).ready(function($) {
        var placeholder_' . $placeholder . ' = $("#' . $placeholder . '");
        var data_' . $placeholder . ' = ' . $data . ';

        $.plot(placeholder_' . $placeholder . ', data_' . $placeholder . ', {';

        switch ($type)
        {
          case 'pie':
            $output .= '
            series: {
              pie: {
                show: true,
                radius: 1,
                label: {
                  show: true,
                  radius: 3/4,
                  formatter: labelFormatter_' . $placeholder . ',
                  threshold: 0.03,
                }
              }
            }';
            break;
          case 'bars':
            $output .= '
            series: {
              bars: {
                show: true,
                label: {
                  show: true
                }
              }
            }';
            break;
        }

        $output .= ',
          grid: {
            hoverable: true,
            borderWidth: 0
          },
        });';

        if ($type == 'pie')
        {
          $output .= 'function labelFormatter_' . $placeholder . '(label, series) {
            return "<div style=\'font-size:7pt; text-align:center; padding:1px; color:white;\'>" + Math.round(series.percent) + "%</div>";
          }';
        }
      $output .= '});
    </script>';

    return $output;
  }

  /**
   * Helper function to format dates
   */
  public static function format_date($date)
  {
    $date = new \DateTime($date);

    echo $date->format('m/d/Y');
  }

  /**
   * Helper function to calculates values that are between other values
   */
  public static function between($val, $min, $max)
  {
    return ($val >= $min && $val <= $max);
  }

}
