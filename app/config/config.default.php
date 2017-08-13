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

defined('APP_PATH') || define('APP_PATH', realpath('.'));

return new \Phalcon\Config(array(
    'database' => [
        'adapter'     => 'Mysql',
        'host'        => 'localhost',
        'username'    => '',
        'password'    => '',
        'dbname'      => '',
        'charset'     => 'utf8',
    ],
    'application' => [
        'controllersDir'    => APP_PATH . '/app/controllers/',
        'modelsDir'         => APP_PATH . '/app/models/',
        'migrationsDir'     => APP_PATH . '/app/migrations/',
        'viewsDir'          => APP_PATH . '/app/views/',
        'pluginsDir'        => APP_PATH . '/app/plugins/',
        'libraryDir'        => APP_PATH . '/app/library/',
        'formsDir'          => APP_PATH . '/app/forms/',
        'validatorsDir'     => APP_PATH . '/app/validators/',
        'cacheDir'          => APP_PATH . '/app/cache/',
        'baseUri'           => '/',
        'cache'             => FALSE,
        'cacheTimeout'      => 1800,
        'cacheViewsTimeout' => 7200,
        'concurrency'       => 6,
    ],
    'redis' => [
      'host' => 'locahost',
      'port' => '6379',
    ],
    // event bonus % (decimal values only, for example 0.1 = 10%)
    'site' => [
      'event_bonus' => 0,
    ],
));
