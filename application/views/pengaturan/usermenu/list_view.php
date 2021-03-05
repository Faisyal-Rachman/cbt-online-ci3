<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Menu Web User
		
	</h1>
	
</section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
        <div class="col-xs-12">
                <div class="card">
                    <div class="card-header with-border">
    						<div class="card-title">Data Menu Web</div>
    						<div class="card-tools pull-right">
    							<div class="dropdown pull-right">
								
          <a class="btn btn-primary" href="<?php echo current_url(); ?>/index/add"" role="menuitem"  aria-haspopup="true" aria-expanded="false">
          Tambah Menu Web
          </a>
     
    							</div>
    						</div>
                    </div><!-- /.card-header -->

                    <div class="card-body">
                        <table id="table-menu" class="w-100 table table-striped table-bordered table-hover table-sm">
                            <thead class="table table-primary">
                                <tr>
                                    <th>No.</th>
                                    <th>Tipe</th>
                                    <th>Parent</th>
                                    <th>Kode Menu</th>
                                    <th>Nama Menu</th>
                                    <th>URL</th>
                                    <th>Icon</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                </tr>
                            </tbody>
                        </table>                        
                    </div>
                </div>
        </div>
    </div>
</section><!-- /.content -->

<script lang="javascript">
    $(function(){
        $('#table-menu').DataTable({
                  "paging": true,
                  "iDisplayLength":10,
                  "bProcessing": false,
                  "bServerSide": true, 
                  "searching": true,
                  "aoColumns": [
    					{"bSearchable": false, "bSortable": false, "sWidth":"20px"},
    					{"bSearchable": false, "bSortable": false, "sWidth":"40px"},
    					{"bSearchable": false, "bSortable": false, "sWidth":"150px"},
                        {"bSearchable": false, "bSortable": false},
                        {"bSearchable": false, "bSortable": false},
                        {"bSearchable": false, "bSortable": false},
                        {"bSearchable": false, "bSortable": false},
                        {"bSearchable": false, "bSortable": false, "sWidth":"30px"}],
                  "sAjaxSource": "<?php echo current_url();?>/get_all_menu/",
                  "autoWidth": false
         });          
    });
</script>