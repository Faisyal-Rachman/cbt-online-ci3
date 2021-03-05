<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?=$subjudul?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><?=$judul?></a></li>
              <li class="breadcrumb-item active"><?=$subjudul?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
	
	 <section class="content">
	  <div class="card">
	  	 <div class="card-header">
      <h3 class="card-title"><?=$subjudul?></h3>

          <div class="card-tools">
  
			 <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
                </div>

        </div>
	 <div class="card-header">
              <a href="<?=base_url()?>hasilujian" class="btn btn-flat btn-sm btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                <button type="button" onclick="reload_ajax()" class="btn btn-flat btn-sm bg-purple"><i class="fa fa-refresh"></i> Reload</button>
          

          <div class="card-tools">
  
         
			 <a target="_blank" href="<?=base_url()?>hasilujian/cetak_detail/<?=$this->uri->segment(3)?>" class="btn bg-maroon btn-flat btn-sm">
                        <i class="fa fa-print"></i> Print
                    </a>
                </div>

        </div>

    
    <div class="card-body">
        <div class="row">
           
            <div class="col-sm-6">
                <table class="table w-100">
                    <tr>
                        <th>Nama Ujian</th>
                        <td><?=$ujian->nama_ujian?></td>
                    </tr>
                    <tr>
                        <th>Jumlah Soal</th>
                        <td><?=$ujian->jumlah_soal?></td>
                    </tr>
                    <tr>
                        <th>Waktu</th>
                        <td><?=$ujian->waktu?> Menit</td>
                    </tr>
                    <tr>
                        <th>Tanggal Mulai</th>
                        <td><?=strftime('%A, %d %B %Y', strtotime($ujian->tgl_mulai))?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Selasi</th>
                        <td><?=strftime('%A, %d %B %Y', strtotime($ujian->terlambat))?></td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-6">
                <table class="table w-100">
                    <tr>
                        <th>Mata Kuliah</th>
                        <td><?=$ujian->nama_matpel?></td>
                    </tr>
                    <tr>
                        <th>guru</th>
                        <td><?=$ujian->nama_guru?></td>
                    </tr>
                    <tr>
                        <th>Nilai Terendah</th>
                        <td><?=$nilai->min_nilai?></td>
                    </tr>
                    <tr>
                        <th>Nilai Tertinggi</th>
                        <td><?=$nilai->max_nilai?></td>
                    </tr>
                    <tr>
                        <th>Rata-rata Nilai</th>
                        <td><?=$nilai->avg_nilai?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="table-responsive px-4 pb-3" style="border: 0">
        <table id="detail_hasil" class="w-100 table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Jurusan</th>
                <th>Jumlah Benar</th>
                <th>Nilai</th>
            </tr>        
        </thead>
        <tfoot>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Jurusan</th>
                <th>Jumlah Benar</th>
                <th>Nilai</th>
            </tr>
        </tfoot>
        </table>
    </div>

</div>
</section>
<script type="text/javascript">
    var id = '<?=$this->uri->segment(3)?>';
</script>

<script src="<?=base_url()?>assets/dist/js/app/ujian/detail_hasil.js"></script>