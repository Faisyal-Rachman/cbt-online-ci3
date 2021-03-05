<div class="container">

	<!-- Main content -->
    <section class="content">
       <br><br>
        <div class="card card-success card-solid">
         
            <div class="card-body">
                <table id="table-tes" class="table table-hover table-sm">
                <thead class="table table-primary">
                        <tr>
                           
                            <th class="all">Ujian</th>
                            
                            <th>Nilai</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                           
                           
                            <td> </td>
                            <td> </td>
                            <td> </td>
                        </tr>
                    </tbody>
                </table>   
            </div><!-- /.card-body -->
        </div><!-- /.card -->
    </section><!-- /.content -->
</div><!-- /.container -->

<script type="text/javascript">
    $(function () {
        $('#btn-hentikan').addClass('hide');
        $('#table-tes').DataTable({
                  "paging": true,
                  "iDisplayLength":10,
                  "bProcessing": false,
                  "bServerSide": true, 
                  "searching": false,
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