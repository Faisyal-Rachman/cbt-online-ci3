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

<div class="card">
    <div class="card-header with-border">
        <h3 class="card-title"><?= $subjudul ?></h3>
        <div class="card-tools pull-right">
           <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
        </div>
    </div>
    <div class="card-body"><div class="row justify-content-center"><div class="col-4">
	<div class="alert alert-info alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-info"></i> Catatan!</h5>
                  Untuk import data dari file excel, silahkan download templatenya terlebih dahulu.
                </div>
        <div class="text-center">
            <a href="<?= base_url('uploads/import/format/mata_kuliah.xlsx') ?>" class="btn-default btn">Download Template Data</a>
        </div>
        <br> 
		<section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">

                  <!-- Main content -->
           
              <!-- title row -->
                      <?= form_open_multipart('matpel/preview'); ?>
           
            <div class="col-6 mx-auto">
                <div class="form-group">
                   <label for="file">Pilih File</label>  <input type="file" name="upload_file">
                </div>
            </div>
            <div class="col-3">
                <button name="preview" type="submit" class="btn btn-sm btn-success">Preview</button>
            </div>
            <?= form_close(); ?>
         <br>
			            <div class="col-12">
			 <?php if (isset($_POST['preview'])) : ?>
                    <br>
                    <h4>Preview Data</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Mata Kuliah</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if (empty($import)) {
                                    echo '<tr><td colspan="2" class="text-center">Data kosong! pastikan anda menggunakan format yang telah disediakan.</td></tr>';
                                } else {
                                    $no = 1;
                                    foreach ($import as $matpel) :
                                        ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $matpel; ?></td>
                                    </tr>
                            <?php
                                    endforeach;
                                }
                                ?>
                        </tbody>
                    </table>
                    <?php if (!empty($import)) : ?>

                        <?= form_open('matpel/do_import', null, ['matpel' => json_encode($import)]); ?>
                        <button type='submit' class='btn btn-block btn-flat bg-purple'>Import</button>
                        <?= form_close(); ?>

                    <?php endif; ?>
                    <br>
                <?php endif; ?>
				</div>
            
			
			
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
		<section class="content">
		      <div class="container-fluid">
        <div class="row">
		
            <div class="col-sm-6 col-sm-offset-3">
               
        </div>
		</div>
		</section>
    </div>
</div>