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

define('APP_PATH', realpath('..'));
define('REQUEST_TIME', (int) $_SERVER['REQUEST_TIME']);

try {

  /**
   * Read the configuration
   */
  $config = include APP_PATH . "/app/config/config.php";

  /**
   * Read auto-loader
   */
  include APP_PATH . "/app/config/loader.php";

  /**
   * Read services
   */
  include APP_PATH . "/app/config/services.php";

  /**
   * Handle the request
   */
  $application = new \Phalcon\Mvc\Application($di);

  echo $application->handle()->getContent();

} catch (\Exception $e) {
  $exception = $e->getMessage();
  echo $exception;
}
