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

namespace DRLP\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Submit;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Identical;
use DRLP\Validators\ProfileExists;

class MultipleSearchForm extends Form
{
  public function initialize()
  {
    $username1 = new Text('username1', array(
      'placeholder' => 'Start typing...',
      'class' => 'form-control',
      'required' => TRUE,
    ));
    $username1->addValidator(new PresenceOf(array(
      'message' => 'Username 1 field is required'
    )));

    $username2 = new Text('username2', array(
      'placeholder' => 'Start typing...',
      'class' => 'form-control',
      'required' => TRUE,
    ));
    $username2->addValidator(new PresenceOf(array(
      'message' => 'Username 2 field is required'
    )));

    $username3 = new Text('username3', array(
      'placeholder' => 'Start typing...',
      'class' => 'form-control',
    ));

    $username4 = new Text('username4', array(
      'placeholder' => 'Start typing...',
      'class' => 'form-control',
    ));

    $username5 = new Text('username5', array(
      'placeholder' => 'Start typing...',
      'class' => 'form-control',
    ));

    $this->add($username1);
    $this->add($username2);
    $this->add($username3);
    $this->add($username4);
    $this->add($username5);

    // CSRF
    $csrf = new Hidden('csrfmulti');
    $csrf->addValidator(new Identical(array(
      'value' => $this->security->getSessionToken(),
      'message' => 'CSRF validation failed'
    )));

    $csrf->clear();

    $this->add($csrf);

    $this->add(new Submit('Submit', array(
      'class' => 'btn btn-success'
    )));
  }

  /**
   * Prints messages for a specific element
   */
  public function messages($name)
  {
    if ($this->hasMessagesFor($name)) {
      foreach ($this->getMessagesFor($name) as $message) {
        $this->flash->error($message);
      }
    }
  }

  /**
   * Render decorated
   */
  public function _render($name)
  {
    $element  = $this->get($name);

    print '<div class="form-group">';
    echo $element;
    print '</div>';
  }
}
