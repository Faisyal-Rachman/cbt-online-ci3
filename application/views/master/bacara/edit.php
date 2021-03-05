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
           <div class="col-md-8">
                <div class="my-2">
                    <div class="form-horizontal form-inline">
                        <a href="<?=base_url('manager/data_bacara')?>" class="btn btn-sm btn-flat btn-success">
                            <i class="fa fa-arrow-left"></i> Batal
                        </a>
                       
                    </div>
                </div>
                <?=form_open('manager/data_bacara/simpan', array('id'=>'bacara'), array('mode'=>'edit'))?>
                <table id="form-table" class="table text-center table-condensed">
                    <thead>
                        <tr>
                          
                            <th>Pengawas</th>
                            <th>Catatan</th>
                            
                        </tr>
                    </thead>
                    <tbody>
					
                        <?php 
                        $no = 1;
						// pemanggilan bukan $data tapi matpel
                        foreach ($bacara as $row) : ?>
						<?=form_hidden('bacara_id', $row->bacara_id)?>
                        <tr>
                           
                            <td>
                                <div class="form-group">
                                <select name="bacara_pengawas" class="form-control select2" style="width: 100%!important">
                        <option value="" disabled selected></option>
                        <?php foreach ($pengawas as $m) : ?>
                            <option value="<?=$m->guru_nama?>"><?=$m->guru_nama?></option>
                        <?php endforeach; ?>
                    </select> <small class="help-block text-right"></small>
                                </div>
								
                            </td>
                            <td>
                            <div class="form-group">
                            <textarea class="form-control" name="bacara_catatan" placeholder="Catatan"></textarea>
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
<script src="<?=base_url()?>assets/dist/js/app/master/bacara/edit.js"></script>