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

use Phalcon\DI\FactoryDefault\CLI as CliDI,
    Phalcon\CLI\Console as ConsoleApp,
    Phalcon\Cache\Frontend\Data as FrontendData,
    Phalcon\Cache\Backend\Redis as BackendRedis;

define('VERSION', '1.0.0');

// Using the CLI factory default services container
$di = new CliDI();

// Define path to application directory
defined('APPLICATION_PATH')
|| define('APPLICATION_PATH', realpath(dirname(__FILE__)));

/**
 * Register the autoloader and tell it to register the tasks directory
 */
$loader = new \Phalcon\Loader();
$loader->registerDirs([
  APPLICATION_PATH . '/tasks/',
  APPLICATION_PATH . '/models/',
  APPLICATION_PATH . '/library/',
]);
$loader->registerNamespaces([
  'DRLP\Tasks' => APPLICATION_PATH . '/tasks/',
  'DRLP\Models' => APPLICATION_PATH . '/models/',
  'DRLP\Library' => APPLICATION_PATH . '/library/',
]);
$loader->register();

// Use composer autoloader to load vendor classes
require_once APPLICATION_PATH . '/../vendor/autoload.php';

// Load the configuration file (if any)
if (is_readable(APPLICATION_PATH . '/config/config.php')) {
  $config = include APPLICATION_PATH . '/config/config.php';
  $di->set('config', $config);
}

//Setup the database service
$di->set('db', function() use ($config) {
  return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
    "host" => $config->database->host,
    "username" => $config->database->username,
    "password" => $config->database->password,
    "dbname" => $config->database->dbname
  ));
});

//  Set the models cache service
$di->set('modelsCache', function () {

  // Cache data for one day by default
  $frontCache = new FrontendData([
    "lifetime" => 300
  ]);

  // Redis connection settings
  $cache = new BackendRedis(
    $frontCache,
    [
      "host" => "localhost",
      "port" => "6379"
    ]
  );

  return $cache;
});

// Create a console application
$console = new ConsoleApp();
$console->setDI($di);

/**
 * Process the console arguments
 */
$arguments = array();
foreach ($argv as $k => $arg) {
  if ($k == 1) {
      $arguments['task'] = $arg;
  } elseif ($k == 2) {
      $arguments['action'] = $arg;
  } elseif ($k >= 3) {
      $arguments['params'][] = $arg;
  }
}

// Define global constants for the current task and action
define('CURRENT_TASK',   (isset($argv[1]) ? $argv[1] : null));
define('CURRENT_ACTION', (isset($argv[2]) ? $argv[2] : null));

try {
  // Handle incoming arguments
  $console->handle($arguments);
} catch (\Phalcon\Exception $e) {
  echo $e->getMessage();
  exit(255);
}
