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
  //=include timer.js

  var Profile = function(data) {
    ko.mapping.fromJS(data, {}, this);
  };

  var showProfile = function() {
    var request = $.getJSON("/profile/json/" + profile_id, function(data) {
      var profile_data;
      profile_data = new Profile(data);
      ko.applyBindings(profile_data, $('#profile-page')[0]);
    });

    request.done(function() {
      ko.cleanNode($('#profile-page')[0]);
      $('.placeholder').removeClass('display');
      $("#ajax-loader").hide();

      $("#reload-profile").click(function(event) {
        event.preventDefault();
        $("#ajax-loader").show();
        showProfile();
        console.log('Reloading Profile: ' + profile_id);
      });
    });

    request.fail(function(jqxhr, textStatus, error) {
      var err = textStatus + ", " + error;
      console.log( "Request Failed: " + err );
    });
  };

  var profile_timer = new DeltaTimer(function(time) {
    showProfile();
    console.log('Updated Profile: ' + profile_id);
  }, 20000);

  var start_profile = profile_timer.start();

  var gps_timer = new DeltaTimer(function(time) {
    $.ajax({
      url: "/profile/gpsdata/" + profile_id,
      success: function(result) {
        $("#profiler-gps-data").html(result);
        console.log('Updated GPS: ' + profile_id);
      }
    });
  }, 30000);

  var start_gps = gps_timer.start();
});
