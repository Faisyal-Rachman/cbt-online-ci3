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
	<section>
<div class="card d-flex justify-content-center">
   
 <div class="card-body">
        <div class="row justify-content-center">
                  <div class="col-sm-offset-3 col-sm-6">
                <div class="alert bg-purple">
                    <strong>Catatan!</strong> untuk import data dari file excel, silahkan download templatenya terlebih dahulu.
                </div>
            </div>
        </div>
        <div class="text-center">
            <a href="<?= base_url('uploads/import/format/kelas.xlsx') ?>" class="btn-default btn">Download Format</a>
        </div>
        <br>
        
        <div class="row d-flex justify-content-center">
      
            <?= form_open_multipart('manager/data_kelas/preview'); ?>
            <label for="file" class="col-lg-10">Pilih File</label>
            <div class="col-lg-12">
                <div class="form-group">
                    <input type="file" name="upload_file">
                </div>
            </div>
            <div class="col-lg-10">
                <button name="preview" type="submit" class="btn btn-sm btn-success">Preview</button>
            </div>
            <?= form_close(); ?>
            <div class="col-lg-12 col-sm-offset-3">
                <?php if (isset($_POST['preview'])) : ?>
                    <br>
                    <h4>Preview Data</h4>
                    <table class="table table-bordered table-sm">
                        <thead class="table table-primary">
                            <tr>
                                <td>No</td>
                                <td>Nama Kelas</td>
						 </tr>
                        </thead>
                        <tbody>
                            <?php
                                if (empty($import)) {
                                    echo '<tr><td colspan="2" class="text-center">Data kosong! pastikan anda menggunakan format yang telah disediakan.</td></tr>';
                                } else {
                                    $no = 1;
                                    foreach ($import as $kelas) :
                                        ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                      <td><?= $kelas['grup_nama']; ?></td>
                                    </tr>
                            <?php
                                    endforeach;
                                }
                                ?>
                        </tbody>
                    </table>
                    <?php if (!empty($import)) : ?>

                        <?= form_open('manager/data_kelas/do_import', null, ['kelas' => json_encode($import)]); ?>
                        <button type='submit' class='btn btn-block btn-flat bg-purple'>Import</button>
                        <?= form_close(); ?>

                    <?php endif; ?>
                    <br>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
</section>