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
  var t = $('.datatable').DataTable({
    "columns": [
      { "data": '' },
      { "data": "position" },
      { "data": "username" },
      { "data": "profession" },
      { "data": "total_exp" },
      { "data": "all_time_ts" },
      { "data": "all_time_tpk" },
      { "data": "membership" },
      { "data": "outpost" },
      { "data": "armor" },
      { "data": "clan" },
      { "data": "weapon1" },
      { "data": "weapon2" },
      { "data": "weapon3" },
    ],
    "columnDefs": [
      {
        "orderable": false,
        "targets": 0,
      }
    ],
    "order": [[ 4, "desc" ]],
    "stateSave": true,
    //"searching": false,
    "scrollY": '55vh',
    "scrollCollapse": true,
  });

  // Array to track the ids of the details displayed rows
  var detailRows = [];

  $('.datatable tbody').on('click', 'tr td.details-control', function() {
    var tr = $(this).closest('tr');
    var row = t.row(tr);
    var idx = $.inArray(tr.attr('id'), detailRows);

    if (row.child.isShown()) {
      tr.removeClass('details');
      row.child.hide();

      // Remove from the 'open' array
      detailRows.splice(idx, 1);
    }
    else {
      tr.addClass('details');
      row.child(format(row.data())).show();

      // Add to the 'open' array
      if (idx === -1) {
        detailRows.push(tr.attr('id'));
      }
    }
  });

  // On each draw, loop over the `detailRows` array and show any child rows
  t.on('draw', function() {
    $.each(detailRows, function(i, id) {
      $('#' + id + ' td.details-control').trigger('click');
    });
  });

  function format(data) {
    return '' +
      '<div class="col-sm-5">' +
        '<strong>Outpost:</strong> ' + data.outpost + '<br>' +
        '<strong>Armor:</strong> ' + data.armor + '<br>' +
        '<strong>Clan:</strong> ' + data.clan + '<br>' +
      '</div>' +
      '<div class="col-sm-7">' +
        '<div class="row">' +
          '<div class="col-sm-4 text-center">' +
            '<strong>Primary Weapon</strong><br>' + data.weapon1 +
          '</div>' +
          '<div class="col-sm-4 text-center">' +
            '<strong>Secondary Weapon</strong><br>' + data.weapon2 +
          '</div>' +
          '<div class="col-sm-4 text-center">' +
            '<strong>Tertiary Weapon</strong><br>' + data.weapon3 +
          '</div>' +
        '</div>';
  }
});
