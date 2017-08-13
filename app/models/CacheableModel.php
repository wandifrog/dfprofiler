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

class CacheableModel extends \Phalcon\Mvc\Model
{
  protected static $_cache = array();

  /**
   * Implement a method that returns a string key based
   * on the query parameters
   */
  protected static function _createKey($parameters)
  {
    // Create a cache key based on the parameters
    if ($parameters != NULL)
    {
      $uniqueKey = array();

      foreach ($parameters as $key => $value) {
          if (is_scalar($value)) {
              $uniqueKey[] = $key . ':' . $value;
          } else {
              if (is_array($value)) {
                  $uniqueKey[] = $key . ':[' . self::_createKey($value) .']';
              }
          }
      }

      return join(',', $uniqueKey);
    }
  }

  /**
   * Allows to query a set of records that match the specified conditions
   *
   * @param mixed $parameters
   * @return Profiles[]
   */
  public static function find($parameters = null)
  {
    $config =  \Phalcon\DI\FactoryDefault::getDefault()->getShared('config');

    if ($config->application->cache)
    {
      // Create an unique key based on the parameters
      $key = self::_createKey($parameters);

      if (!isset(self::$_cache[$key])) {

        // Convert the parameters to an array
        if (!is_array($parameters)) {
            $parameters = array($parameters);
        }

        // Check if a cache key wasn't passed
        // and create the cache parameters
        if (!isset($parameters['cache'])) {
          $parameters['cache'] = array(
            "key"      => $key,
            "lifetime" => $config->application->cacheTimeout
          );
        }

        // Store the result in the memory cache
        self::$_cache[$key] = parent::find($parameters);
      }

      // Return the result in the cache
      return self::$_cache[$key];
    }
    else
    {
      return parent::find($parameters);
    }
  }

  /**
   * Allows to query the first record that match the specified conditions
   *
   * @param mixed $parameters
   * @return Profiles
   */
  public static function findFirst($parameters = null)
  {
    $config = \Phalcon\DI\FactoryDefault::getDefault()->getShared('config');

    if ($config->application->cache)
    {
      // Create an unique key based on the parameters
      $key = self::_createKey($parameters);

      if (!isset(self::$_cache[$key]))
      {

        // Convert the parameters to an array
        if (!is_array($parameters)) {
          $parameters = array($parameters);
        }

        // Check if a cache key wasn't passed
        // and create the cache parameters
        if (!isset($parameters['cache']))
        {
          $parameters['cache'] = array(
            "key"      => $key,
            "lifetime" => $config->application->cacheTimeout
          );
        }

        // Store the result in the memory cache
        self::$_cache[$key] = parent::findFirst($parameters);
      }

      // Return the result in the cache
      return self::$_cache[$key];
    }
    else
    {
      return parent::findFirst($parameters);
    }
  }

  /**
   * Allows to query the first record that match the specified conditions (no cache version)
   *
   * @param mixed $parameters
   * @return Profiles
   */
  public static function findFirstNoCache($parameters = null)
  {
    return parent::findFirst($parameters);
  }

  /**
   * Allows to query a set of records that match the specified conditions
   *
   * @param mixed $parameters
   * @return Profiles[]
   */
  public static function findNoCache($parameters = null)
  {
    return parent::find($parameters);
  }
}
