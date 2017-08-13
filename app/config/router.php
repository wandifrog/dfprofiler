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

use Phalcon\Mvc\Router;

// Create the router without default routes
$router = new Router(FALSE);

// Remove trailing slashes automatically
$router->removeExtraSlashes(TRUE);

// set default route
$router->setDefaults([
  'controller' => 'index',
  'action'     => 'index'
]);

// Error pages
$router->notFound([
  'controller' => 'error',
  'action'     => 'index'
]);

// routes
$router->add('/', [
  'controller' => 'index',
  'action'     => 'index'
]);

$router->add('/profile/json/:int', [
  "controller" => 'profile',
  "action"     => 'json',
  "player_id"  => 1
]);

$router->add('/profile/view/:int', [
  "controller" => 'profile',
  "action"     => 'view',
  "player_id"  => 1
]);

$router->add('/profile/gpsdata/:int', [
  "controller" => 'profile',
  "action"     => 'gpsdata',
  "player_id"  => 1
]);

$router->add('/profile/autocomplete/([a-zA-Z0-9\_\-]+)', [
  "controller" => 'profile',
  "action"     => 'autocomplete',
  "query"      => 1
]);

$router->add('/clan/view/:int', [
  "controller" => 'clan',
  "action"     => 'view',
  "clan_id"    => 1
]);

$router->add('/multiple/json/([0-9\:]+)', [
  "controller" => 'multiple',
  "action"     => 'json',
  "id_list"    => 1
]);

$router->add('/multiple/view/([0-9\:]+)', [
  "controller" => 'multiple',
  "action"     => 'view',
  "id_list"    => 1
]);

// Search Forms
$router->add('/search/simple', 'Index::simplesearch');
$router->add('/search/multiple', 'Index::multiplesearch');

// DPS Table
$router->add('/damage', 'Damage::index');

// Statistics
$router->add('/statistics', 'Statistics::index');

// Static Pages
$router->add('/donate', 'StaticPages::donate');
$router->add('/help', 'StaticPages::help');

// Player Records
$router->add('/player', 'Player::index');
$router->add('/player/weekly-ts', 'Player::weeklyts');
$router->add('/player/all-time-ts', 'Player::alltimets');
$router->add('/player/weekly-tpk', 'Player::weeklytpk');
$router->add('/player/all-time-tpk', 'Player::alltimetpk');
$router->add('/player/top-strongest', 'Player::topstrongest');
$router->add('/player/top-richest', 'Player::toprichest');
$router->add('/player/top-hardcore', 'Player::tophardcore');
$router->add('/player/level-325', 'Player::level325');
$router->add('/player/dusk-winners', 'Player::duskwinners');

// Clan Records
$router->add('/clan', 'Clan::index');
$router->add('/clan/weekly-ts', 'Clan::weeklyts');
$router->add('/clan/all-time-ts', 'Clan::alltimets');
$router->add('/clan/weekly-tpk', 'Clan::weeklytpk');
$router->add('/clan/all-time-tpk', 'Clan::alltimetpk');
$router->add('/clan/top-strongest', 'Clan::topstrongest');
$router->add('/clan/top-richest', 'Clan::toprichest');

return $router;
