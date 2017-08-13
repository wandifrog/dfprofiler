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

$(document).ready(function() {
  var options = {
    url: function(query) {
      return "profile/autocomplete/" + query;
    },

    getValue: function(element) {
      return element.username;
    },

    list: {
      match: {
        enabled: true
      },
      maxNumberOfElements: 10
    },

    ajaxSettings: {
      dataType: "json",
      method: "POST",
      data: {
        dataType: "json"
      }
    },

    template: {
      type: "custom",
      method: function(value, player) {
        return value + ' <span class="label label-default">ID ' + player.player_id + '</span> ' +
          '<span class="label label-info">' + player.profession + '</span> ' +
          '<span class="label label-success">Level ' + player.level + '</span>';
      }
    },

    preparePostData: function(data) {
      data.query = $("#username").val();
      return data;
    },

    requestDelay: 400
  };

  $("#username").easyAutocomplete(options);

  for(i = 1; i <= 5; i++) {
    $("#username" + i).easyAutocomplete(options);
  }
});
