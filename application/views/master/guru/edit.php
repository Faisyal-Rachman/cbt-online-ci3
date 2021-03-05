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
                        <a href="<?=base_url('manager/data_guru')?>" class="btn btn-sm btn-flat btn-success">
                            <i class="fa fa-arrow-left"></i> Batal
                        </a>
                       
                    </div>
                </div>
                <?=form_open('manager/data_guru/save', array('id'=>'guru'), array('mode'=>'edit'))?>
                <table id="form-table" class="table text-center table-condensed">
                    <thead>
                        <tr>
                            <th>Nama Guru</th>
                            <th>Kode Guru</th>
                        </tr>
                    </thead>
                    <tbody>
					
                        <?php 
                        $no = 1;
						// pemanggilan bukan $data tapi matpel
                        foreach ($guru as $row) : ?>
						<?=form_hidden('guru_id', $row->guru_id)?>
                        <tr>
                           
                            <td>
                                <div class="form-group">
                                    <input autofocus="autofocus" onfocus="this.select()" autocomplete="off" value="<?=$row->guru_nama?>" type="text" name="guru_nama" class="input-sm form-control">
                                    <small class="help-block text-right"></small>
                                </div>
								
                            </td>
                            <td>
                                <div class="form-group">
                                    <input autofocus="autofocus" onfocus="this.select()" autocomplete="off" value="<?=$row->guru_kode?>" type="text" name="guru_kode" class="input-sm form-control">
                                    <small class="help-block text-right"></small>
                                </div>
								
                            </td>
                        </tr>
                        <?php 
                        $no++;
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
<script src="<?=base_url()?>assets/dist/js/app/master/guru/edit.js"></script>