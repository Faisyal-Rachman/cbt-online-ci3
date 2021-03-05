<div class="container">

  <!-- Main content -->
    <section class="content">
       <br>        
         
                <table id="table-tems" class="table borderless">
               
                    <tbody>
                        <tr>
                           
                           
                            <td> </td>
                            <td> </td>
                            <td> </td>
                        </tr>
                    </tbody>
                </table>   
           
       
    </section><!-- /.content -->
</div><!-- /.container -->

<script type="text/javascript">
    $(function () {
      
        $('#table-tems').DataTable({
                  "paging": false,
                  "bProcessing": false,
                  "bServerSide": true, 
                  "searching": false,
                  "info": false,
                  "ordering": false,
                  "aoColumns": [
                        
                    {"bSearchable": false, "bSortable": false, "sWidth":"150px"},
                      
                        {"bSearchable": false, "bSortable": false, "sWidth":"100px"},
                        {"bSearchable": false, "bSortable": false,}],
                  "sAjaxSource": "<?php echo site_url().'/'.$url; ?>/get_datatable/",
                  "autoWidth": false,
                  "responsive": true
         });   
    });
</script>