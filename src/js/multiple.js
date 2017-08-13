$(document).ready(function() {
  //=include timer.js

  var data = [];

  var ViewModel = {
    players: ko.observableArray(data)
  };

  ko.applyBindings(ViewModel);

  var showProfiles = function() {
    $.ajax({
      type: 'GET',
      url: '/multiple/json/' + id_list,
      dataType: "json",
      global: false,
      data: {},
      success: function(data, textStatus, jqXHR) {
        ViewModel.players(data);
        $('#placeholder').hide();
        $("#ajax-loader").hide();
      },
      error: function(xhr, textStatus, error) {
        var err = textStatus + ", " + error;
        console.log( "Request Failed: " + err );
      }
    });
  };

  var profiles_timer = new DeltaTimer(function(time) {
    showProfiles();
    console.log('Updated Profiles: ' + id_list);
  }, 20000);

  var start_profiles = profiles_timer.start();
});