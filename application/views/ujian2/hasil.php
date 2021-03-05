  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Project Detail</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Project Detail</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
	
	
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
		  
<div class="card">
	 <div class="card-header">
          <h3 class="card-title">Projects Detail</h3>

          <div class="card-tools">
  
            <button type="button" onclick="reload_ajax()" class="btn bg-purple btn-flat btn-sm"><i class="fa fa-refresh"></i> Reload</button>
			<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
                </div>

        </div>
	
    <div class="card-body">
        <table id="hasil" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Ujian</th>
                <th>Mata Kuliah</th>
                <th>guru</th>
                <th>Jumlah Soal</th>
                <th>Waktu</th>
                <th>Tanggal</th>
                <th class="text-center">
                    <i class="fa fa-search"></i>
                </th>
            </tr>        
        </thead>
	
        <tfoot>
            <tr>
                <th>No.</th>
                <th>Nama Ujian</th>
                <th>Mata Kuliah</th>
                <th>guru</th>
                <th>Jumlah Soal</th>
                <th>Waktu</th>
                <th>Tanggal</th>
                <th class="text-center">
                    <i class="fa fa-search"></i>
                </th>
            </tr>
        </tfoot>
        </table>
    </div>
	
	
	
</div>
 </div>
</div>
</div>
</section>
<script src="<?=base_url()?>assets/dist/js/app/ujian/hasil.js"></script>