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

namespace DRLP\Controllers;

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{

  public function initialize()
  {
    // set the site title
    \Phalcon\Tag::setTitle(' - Profiler');

    // CSS
    $this->assets
            ->addCss('css/libraries.css')
            ->addCss('css/styles.css');

    // Javascript
    $this->assets->addJs('js/libraries.js');
  }

  protected function checkAjaxRequired()
  {
    if (!$this->request->isAjax())
    {
      $this->response->setStatusCode(404, "Not Found");
      $this->dispatcher->forward(array(
          'controller' => 'error',
          'action'     => 'index',
      ));

      return FALSE;
    }

    return TRUE;
  }

  protected function setTitle($title='')
  {
    \Phalcon\Tag::prependTitle($title);
    $this->view->title = $title;
  }
}
