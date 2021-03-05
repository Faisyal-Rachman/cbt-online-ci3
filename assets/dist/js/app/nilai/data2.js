$(document).ready(function () {

    var table = $('#nilaiujian').DataTable({
          'dom':
          "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
          "<'row'<'col-sm-12'tr>>" +
          "<'row'<'col-sm-5'i><'col-sm-7'p>>",
          'ajax': 'http://localhost/ujiancbt/manager/modul_nilai/data',
          
          
          'buttons': [ 
          
                   {
          extend: 'copy',
          exportOptions: { columns: [':visible'], rows: [':visible'] }
          //copies currently displayed columns and rows
          },
         
          'csv', {
             'text': '<i class="fa fa-id-badge fa-fw" aria-hidden="true"></i>',
             'action': function (e, dt, node) {
 
                $(dt.table().node()).toggleClass('cards');
                $('.fa', node).toggleClass(['fa-table', 'fa-id-badge']);
 
                dt.draw('page');
             },
             'className': 'btn-sm',
             'attr': {
                'title': 'Change views',
             }
          }],
          'select': 'single',
          'columns': [
           
             {
                'data': 'user_birthdate'
             },
             {
                'data': 'user_firstname'
             },
             {
                'data': 'tes_jenis',
               
             },
             {
               'data': 'grup_nama',
              
            },
             {
               'data': 'tes_duration_time',
              
            },
            {
               'data': 'sesi_nama',
              
            },
             {
                'data': 'tset_pg',
               
             },
             {
                'data': 'nilai'
             }             
          ],
          'drawCallback': function (settings) {
             var api = this.api();
             var $table = $(api.table().node());
             
             if ($table.hasClass('cards')) {
 
                // Create an array of labels containing all table headers
                var labels = [];
                $('thead th', $table).each(function () {
                   labels.push($(this).text());
                });
 
                // Add data-label attribute to each cell
                $('tbody tr', $table).each(function () {
                   $(this).find('td').each(function (column) {
                      $(this).attr('data-label', labels[column]);
                   });
                });
 
                var max = 0;
                $('tbody tr', $table).each(function () {
                   max = Math.max($(this).height(), max);
                }).height(max);
 
             } else {
                // Remove data-label attribute from each cell
                $('tbody td', $table).each(function () {
                   $(this).removeAttr('data-label');
                });
 
                $('tbody tr', $table).each(function () {
                   $(this).height('auto');
                });
             }
          }
       })
       .on('select', function (e, dt, type, indexes) {
          var rowData = table.rows(indexes).data().toArray()
          $('#row-data').html(JSON.stringify(rowData));
       })
       .on('deselect', function () {
          $('#row-data').empty();
       })
 });