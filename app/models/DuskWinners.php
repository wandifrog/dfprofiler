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

class DuskWinners extends CacheableModel
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
  public $profile_id;

  /**
   *
   * @var integer
   */
  public $level;

  /**
   *
   * @var string
   */
  public $profession;

  /**
   *
   * @var string
   */
  public $date_start;

  /**
   *
   * @var string
   */
  public $date_end;

  /**
   *
   * @var string
   */
  public $competition;

  /**
   *
   * @var string
   */
  public $record;

  /**
   * Initialize method for model.
   */
  public function initialize()
  {
    $this->belongsTo(
      'profile_id',
      'Profiles',
      'player_id', [
        'alias' => 'Profiles'
      ]
    );
  }

  /**
   * Returns table name mapped in the model.
   *
   * @return string
   */
  public function getSource()
  {
    return 'dusk_winners';
  }

}
