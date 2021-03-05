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
           <div class="col-md-6">
                <div class="my-2">
                    <div class="form-horizontal form-inline">
                        <a href="<?=base_url('jenis')?>" class="btn btn-sm btn-flat btn-success">
                            <i class="fa fa-arrow-left"></i> Batal
                        </a>
                       
                    </div>
                </div>
                <?=form_open('manager/data_jenis/save', array('id'=>'jenis'), array('mode'=>'edit'))?>
                <table id="form-table" class="table text-center table-condensed">
                    <thead>
                        <tr>
                             <th>Jenis Ujian</th>
                             <th>Kode Jenis</th>
                             <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
					
                        <?php 
                        $i = 1;
						// pemanggilan bukan $data tapi jenis
                        foreach ($jenis as $row) : ?>
						<?=form_hidden('jenis_id['.$i.']', $row->jenis_id)?>
                        <tr>
                            <td><div class="form-group">
                                    <input autofocus="autofocus" onfocus="this.select()" autocomplete="off" value="<?=$row->jenis_nama?>" type="text" name="jenis_nama[<?=$i?>]" class="input-sm form-control">
                                    <small class="help-block text-right"></small>
                                </div></td>
                            <td>
                                <div class="form-group">
                                    <input autofocus="autofocus" onfocus="this.select()" autocomplete="off" value="<?=$row->kode_jenis?>" type="text" name="kode_jenis[<?=$i?>]" class="input-sm form-control">
                                    <small class="help-block text-right"></small>
                                </div>
								
                            </td>
                            <td>
                                <div class="form-group">
                                    <input autofocus="autofocus" onfocus="this.select()" autocomplete="off" value="<?=$row->status?>" type="text" name="status" class="input-sm form-control">
                                    <small class="help-block text-right"></small>
                                </div>
								
                            </td>
                        </tr>
                        <?php 
                        $i++;
                        endforeach; 
                        ?>
                    </tbody>
                </table>
                <button type="submit" class="mb-4 btn btn-block btn-flat bg-purple">
                    <i class="fa fa-save"></i> Simpan Perubahan
                </button>
                <?=form_close()?>
            </div>
        </div>
    </div>
</div>
</section>
<script src="<?=base_url()?>assets/dist/js/app/master/jenis/edit.js"></script>