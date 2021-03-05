<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modul_soal extends Member_Controller {
	private $kode_menu = 'modul-soal';
	private $kelompok = 'modul';
	private $url = 'manager/modul_soal';
	
    function __construct(){
		parent:: __construct();
		$this->load->model('cbt_modul_model');
		$this->load->model('cbt_topik_model');
		$this->load->model('cbt_jawaban_model');
		$this->load->model('cbt_soal_model');
		$this->load->model('users_model');
		$this->load->model('cbt_konfigurasi_model');
		$this->load->model('cbt_tes_soal_model');
		$this->load->model('cbt_tes_topik_set_model');
		$this->load->model('cbt_tes_soal_jawaban_model');
		$this->load->model('Master_model', 'master');
		$this->load->helper('directory');
		$this->load->helper('file');

		//parent::cek_akses($this->kode_menu);
	}
	
    public function index($id_soal=null){
	
		$data['kode_menu'] = $this->kode_menu;
        $data['url'] = $this->url;
					
        $is_edit = 0;
			
        if($id_soal!=null){
        	$query_soal = $this->cbt_soal_model->get_by_kolom_limit('soal_id', $id_soal, 1);
        	if($query_soal->num_rows()>0){
        		$query_soal = $query_soal->row();
        		$data['data_id'] = $query_soal->soal_id;
        		$data['data_soal'] = $query_soal->soal_detail;
        		$data['data_audio'] = $query_soal->soal_audio;
        		$data['data_putar'] = $query_soal->soal_audio_play;
        		$data['data_tipe'] = $query_soal->soal_tipe;
        		$data['data_kesulitan'] = $query_soal->soal_difficulty;
        		$data['data_topik'] = $query_soal->soal_topik_id;

        		$is_edit = 1;
        	}
        }

        $query_user = $this->users_model->get_user_by_username($this->access->get_username());
        $select = '';
        $counter = 0;
        if($query_user->num_rows()>0){
        	$query_user = $query_user->row();

        	
        	if(!empty($query_user->opsi1)){
        		$user_topik = explode(',', $query_user->opsi1);
	        	foreach ($user_topik as $topik_id) {
	        		$query_topik = $this->cbt_topik_model->get_by_kolom_join_modul('topik_id', $topik_id);
	        		if($query_topik->num_rows()>0){
	        			$topik = $query_topik->row();
	        			$counter++;

	        			if(!empty($data['data_topik'])){
        					if($data['data_topik']==$topik->topik_id){
        						$select = $select.'<option value="'.$topik->topik_id.'" selected>'.$topik->modul_nama.' - '.$topik->topik_nama.'</option>';
        					}else{
        						$select = $select.'<option value="'.$topik->topik_id.'">'.$topik->modul_nama.' - '.$topik->topik_nama.'</option>';	
        					}
        				}else{
        					$select = $select.'<option value="'.$topik->topik_id.'">'.$topik->modul_nama.' - '.$topik->topik_nama.'</option>';
        				}
	        		}
	        	}
        	}else{
        		
        		$query_modul = $this->cbt_modul_model->get_modul();
		        if($query_modul->num_rows()>0){
					$select = '';
					$select2 = '';
		        	$query_modul = $query_modul->result();
		        	if(isset($_POST['idtopik'])){
							$data['topikid'] = $_POST['idtopik'];
							$topikid = $_POST['idtopik'];
							$topiknm = $_POST['nmtopik'];
					$mdl = $this->cbt_modul_model->get_modulset('topik_id', $topikid)->row()->hasil;
              $select2 = $select2.'<optgroup label="Pelajaran Auto">;
                <option value="'.$topikid.'" selected>'.$mdl.' - '.$topiknm.'</option>
                    </optgroup>';
						}else{
						$topikid = 0;
						$topiknm = 0;
						}
		        	foreach ($query_modul as $temp) {
						
		        		$query_topik = $this->cbt_topik_model->get_by_kolom_join_modul('topik_modul_id', $temp->modul_id);
		        		
		        		if($query_topik->num_rows()){
		        			$select = $select.'<optgroup label="Pelajaran '.$temp->modul_nama.'">';
							
		        			$query_topik = $query_topik->result();
		        			foreach ($query_topik as $topik) {
		        				$counter++;
		        				if(!empty($data['data_topik'])){
		        					if($data['data_topik']==$topik->topik_id){
		        						$select = $select.'<option value="'.$topik->topik_id.'" selected>'.$topik->modul_nama.' - '.$topik->topik_nama.'</option>';
										$select2 = $select2.'<option value="'.$topikid.'" selected>'.$topik->modul_nama.' - '.$topiknm.'</option>';
		        					
									}else{
		        						$select = $select.'<option value="'.$topik->topik_id.'">'.$topik->modul_nama.' - '.$topik->topik_nama.'</option>';	
										$select2 = $select2.'<option value="'.$topikid.'" selected>'.$topik->modul_nama.' - '.$topiknm.'</option>';
		        					
									}
		        				}else{
		        					$select = $select.'<option value="'.$topik->topik_id.'">'.$topik->modul_nama.' - '.$topik->topik_nama.'</option>';
									
		        					
								}
		        			}
							$select = $select.'</optgroup>';
		        			
		        		}

		        	}
		        }
        	}
        }

        if($counter==0){
        	$select = '<option value="kosong">Tidak Ada Data Topik</option>';
        }

        if($counter!=0 and $is_edit==1){
        	$data['data_soal'] = '
        		edit(\''.$id_soal.'\');
        	';
        }
        $query = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_jenjang_sekolah', 1);
		
		$data['jenjang'] = $query->row()->konfigurasi_isi;
		if($data['jenjang']= 'sma'){
       $data['isi'] = 'oke';

		}
		
	   $query = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_jenjang_sekolah', 1);
		$data['jenjang_pendidikan'] = 'sd';
		if($query->num_rows()>0){
			$data['jenjang_pendidikan'] = $query->row()->konfigurasi_isi;
		}
	
if($data['jenjang_pendidikan']=='sma'){
$data['op1'] = 5;
}else{
$data['op1'] = 4;
}
$isiopt = '';
$option = '';
$optinput = '';
$cisiopt = '';
$idinput = '';
  $option = $option.'<ol class="d">';
   for($i=1, $t=65; $i<=$data['op1'];){
     $option = $option.'<div class="bs-example">
    <div class="accordion" id="accordionExample">
        <div class="card text-white link-white">
            <div class="card-header" id="heading'.$i.'">
                <h2 class="mb-'.$i.'"><button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapse'.$i.'"><input type="checkbox" id="tambah-benar'.$i.'" class="radioCheck" onclick="check(this);" name="tambah_benar['.$i.']" value="1"> <b>JAWABAN</b></button>
                    <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapse'.$i.'"><b><li></li></b></button>									
                </h2>
            </div>
            <div id="collapse'.$i.'" class="collapse" aria-labelledby="heading'.$i.'" data-parent="#accordionExample">
                <div class="card-body">
                <textarea class="textarea form-control input-sm" id="jawaban_detail'.$i.'" name="jawaban_detail['.$i.']" style="width: 100%; height: 150px;"></textarea>
                                
                                     </div>
            </div>
        </div>
 </div>
</div>';
   
   $i++;
}
 $option = $option.'</ol>';

		 for($i=1, $t=65; $i<=$data['op1'];){
  $optinput = $optinput.'<input type="hidden" name="tambah-jawaban['.$i.']" id="tambah-jawaban'.$i.'" >';
  $idinput = $idinput.'<input type="hidden" name="jawaban-id['.$i.']" id="jawaban-id'.$i.'" >';
 $isiopt = $isiopt."$('#tambah-jawaban".$i."').val(CKEDITOR.instances.jawaban_detail".$i.".getData());";
  $cisiopt = $cisiopt."CKEDITOR.instances.jawaban_detail".$i.".setData('');";
     $i++;
}
		$data['select_topik'] = $select;
		$data['topikid'] = $topikid;
        $data['ctop'] = $select2;
        $data['option'] = $option;
        $data['isiopt'] = $isiopt;
        $data['optinput'] = $optinput;
        $data['cisiopt'] = $cisiopt;
        $data['idinput'] = $idinput;
         $this->template->display_admin($this->kelompok.'/modul_soal_view', 'Mengelola Soal', $data);
    }
	public function save()
	{
		$rows = count($this->input->post('jawaban_detail', true));
		$mode = $this->input->post('mode', true);
		$insert	= array();
		for ($i = 1; $i <= $rows; $i++) {
			$jawaban_detail = 'jawaban_detail[' . $i . ']';
		
		
					$insert[] = [
						'jawaban_detail' => $this->input->post($jawaban_detail, true),
						'jawaban_soal_id' => 4
					];
				
			//	$status = TRUE;
				//$this->master->create('cbt_jawaban', $mmm, true);
			
				
			//	echo $data;
				$cek = 3;
		
				}
		$cek = $insert;
			$this->master->create('cbt_jawaban', $cek, true);
				//var_dump($rows);
				
	}

    function tambah(){
    	$this->load->library('form_validation');
        $this->form_validation->set_rules('tambah-topik-id', 'Topik','required');
        $this->form_validation->set_rules('tambah-soal', 'Soal','required');
        $this->form_validation->set_rules('tambah-tipe', 'Tipe Soal','required|strip_tags');
        $this->form_validation->set_rules('tambah-kesulitan', 'Tingkat Kesulitan','required|strip_tags');
       
	    $getsoal = $this->cbt_soal_model->getidsoal()->row()->id;
        if($this->form_validation->run() == TRUE){
        	$id_soal = $this->input->post('tambah-soal-id', TRUE);
        	$id_topik = $this->input->post('tambah-topik-id', TRUE);
        	
        	$tm = $this->cbt_topik_model->get_by_kolom_join_modul('topik_id', $id_topik);
        	   $tm = $tm->result();
        	    foreach ($tm as $temp) {
$tmn = $temp->modul_nama;
$tmnt = $temp->topik_nama;
        	    }
//var_dump($tmn);
        	$soal = $this->input->post('tambah-soal', FALSE);
			$tipe = $this->input->post('tambah-tipe', TRUE);
			$kesulitan = $this->input->post('tambah-kesulitan', TRUE);
        	$audio = $_FILES['tambah-audio']['name'];
			$rows = count($this->input->post('tambah-jawaban', true));
        	$posisi = $this->config->item('upload_path').'/topik_'.$tmn.'_'.$tmnt;
			$insert	= array();
			$update	= array();
        	$doc = new DOMDocument();
			$doc->loadHTML($soal);
			$tags = $doc->getElementsByTagName('img');
			foreach ($tags as $tag) {
				$soal_image = $tag->getAttribute('src');
				if (strpos($soal_image, 'data:image/') !== false) {
					$soal_image_array = preg_split("@[:;,]+@", $soal_image);
					$extensi = explode('/', $soal_image_array[1]);

					$file_name = $posisi.'/'.uniqid().'.'.$extensi[1];

					if(!is_dir($posisi)){
			        	mkdir($posisi);
			        }

					
					file_put_contents($file_name, base64_decode($soal_image_array[3]));

					
					
					$soal = str_replace($soal_image, base_url().$file_name, $soal);
				}
			}

        	$soal = str_replace(base_url(),"[base_url]", $soal);

        	
        	$kunci_jawaban_singkat = '';
        	$status_jawaban_singkat = 1;
        	if($tipe==3){
        		$kunci_jawaban_singkat = $this->input->post('tambah-kunci-jawaban-singkat', TRUE);
        		if(empty($kunci_jawaban_singkat)){
        			$status_jawaban_singkat = 0;
        		}
        	}
			
			
        	if($id_topik=='kosong'){
        		$status['status'] = 0;
            	$status['pesan'] = 'Topik belum tersedia';
            }else if($status_jawaban_singkat==0){
            	$status['status'] = 0;
            	$status['pesan'] = 'Kunci Jawaban untuk Soal Jawaban Singkat tidak boleh kosong !';
        	}else{
        		$data['soal_topik_id'] = $id_topik;
	        	$data['soal_detail'] = $soal;
	        	$data['soal_tipe'] = $tipe;
	        	$data['soal_kunci'] = $kunci_jawaban_singkat;
	        	$data['soal_difficulty'] = $kesulitan;
	        	$data['soal_aktif'] = 1;
			//	$data['soal_audio_play'] = $this->input->post('tambah-putar', TRUE);
				$jwb = $this->input->post('tambah_benar', true);
				 $query = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_jenjang_sekolah', 1);
		          if($query->num_rows()>0){
			$jpendidikan = $query->row()->konfigurasi_isi;
		            }
				if($jpendidikan=='sma'){
                  $op1 = 5;
                    }else{
                 $op1 = 4;
                   }
				for ($i = 1; $i <= $op1; $i++) {
					//ini inisialisasi var
					$jawaban_detail = 'tambah-jawaban[' . $i . ']';
					$tambah_benar = 'tambah_benar[' . $i . ']';
					if(isset($jwb)){
						                   					
					$idsoal = $getsoal;
					$insert[] = [
						'jawaban_detail' => $this->input->post($jawaban_detail, true),
						'jawaban_soal_id' => $idsoal,
						'jawaban_aktif' => 1,
						'jawaban_benar' => $this->input->post($tambah_benar, TRUE)
					];
					
                  $ambiljwb = $this->cbt_jawaban_model->get_by_kolom('jawaban_soal_id',$id_soal);
                  $count = 1;
              $ambiljwb = $ambiljwb->result();
                    foreach ($ambiljwb as $value) {
        	      
				$update[] = array(
						'jawaban_id' => $this->input->post('jawaban-id[' . $i . ']', true),
					   	'jawaban_detail' => $this->input->post($jawaban_detail, true),
						'jawaban_soal_id' => $id_soal,
						'jawaban_aktif' => 1,
						'jawaban_benar' => $this->input->post($tambah_benar, TRUE)
					);
				}
					}			
				}
			
	        	$upload = 0;
	        	if(!empty($audio)){
	        		$upload = 1;

	        		if(!is_dir($posisi)){
	        			mkdir($posisi);
	        		}

	        		$field_name = 'tambah-audio';

	        		$config['upload_path'] = $posisi;
				    $config['allowed_types'] = 'mp3';
				    $config['max_size']	= '0';
				    $config['overwrite'] = true;
				    $config['file_name'] = strtolower($_FILES[$field_name]['name']);

				    $this->load->library('upload', $config);
				    if (!$this->upload->do_upload($field_name)){
			        	$status['status_upload'] = 0;
			            $status['pesan_upload'] = $this->upload->display_errors().'Tipe file yang di upload adalah '.$_FILES[$field_name]['type'];
			        }else{
			        	$upload_data = $this->upload->data();
			        	$data['soal_audio'] = $upload_data['file_name'];
						$status['status_upload'] = 1;
			            $status['pesan_upload'] = 'File '.$upload_data['file_name'].' BERHASIL di IMPORT';
			        }
	        	}

	        	if(!empty($id_soal)){
	        		$cekupdate = $update;
	        		$this->master->update('cbt_jawaban', $cekupdate, 'jawaban_id', null, true);
	        		$this->cbt_soal_model->update('soal_id', $id_soal, $data);
	        	}else if($tipe==1){
	        		$cek = $insert;
	        		
					$this->cbt_soal_model->save($data);	
					//$this->master->update('cbt_jawaban', $cek, 'jawaban_id', null, true);
			         $this->master->create('cbt_jawaban', $cek, true);
				 		
	        	}else{
					$this->cbt_soal_model->save($data);	
				}

	        	if($upload==0){
	        		$status['status'] = 1;
					$status['pesan'] = 'Soal tanpa upload berhasil disimpan';
				
				//var_dump($cek);
	        	}else{
	        		if($status['status_upload']==1){
		        		$status['status'] = 1;
		        		$status['pesan'] = 'Soal berhasil disimpan';
		        	}else{
		        		$status['status'] = 1;
		        		$status['pesan'] = 'Soal berhasil disimpan, tetapi Audio tidak tersimpan dengan kesalahan<br />Pesan : '.$status['pesan_upload'];
		        	}
	        	}
        	}
        }else{
            $status['status'] = 0;
            $status['pesan'] = 'JAWABAN';
		}
	
 echo json_encode($status);
		
    }

    function hapus_soal(){
    	$this->load->library('form_validation');
        
        $this->form_validation->set_rules('hapus-id', 'Soal','required');
        
        if($this->form_validation->run() == TRUE){
        	$id = $this->input->post('hapus-id', TRUE);

        	$query_soal = $this->cbt_soal_model->get_by_kolom_limit('soal_id', $id, 1);
        	if($query_soal->num_rows()>0){
        		$query_soal = $query_soal->row();

        		if($this->cbt_tes_topik_set_model->count_by_kolom('tset_topik_id', $query_soal->soal_topik_id)->row()->hasil>0){
	        		$status['status'] = 0;
	            	$status['pesan'] = 'Soal tidak bisa dihapus, Topik soal masih dipakai pada Tes.';
	        	}else{
	        		$this->cbt_soal_model->delete('soal_id', $id);
		        	$status['status'] = 1;
		        	$status['pesan'] = 'Soal berhasil dihapus';
	        	}
        	}else{
        		$status['status'] = 0;
            	$status['pesan'] = 'Terjadi kesalahan, silahkan cek terlebih dahulu data Soal.';
        	}
        }else{
			$status['status'] = 0;
            $status['pesan'] = validation_errors();
        }
        
        echo json_encode($status);
    }

    function get_by_id($id=null){
    	$data['data'] = 0;
		if(!empty($id)){
			$query = $this->cbt_soal_model->get_by_kolom('soal_id', $id);
			if($query->num_rows()>0){
				$query = $query->row();
				$data['data'] = 1;
				$data['id'] = $query->soal_id;
				$soal = $query->soal_detail;
				$soal = str_replace("[base_url]", base_url(), $soal);
				$data['soal'] = $soal;
				$data['tipe'] = $query->soal_tipe;
				$data['kunci'] = $query->soal_kunci;
				$data['kesulitan'] = $query->soal_difficulty;
				$data['audio'] = $query->soal_audio;
				$data['putar'] = $query->soal_audio_play;
				$data['id_topik'] = $query->soal_topik_id;
				// $data['pilganda'] = $query->jawaban_detail;

			$query = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_jenjang_sekolah', 1);
		          if($query->num_rows()>0){
			$jpendidikan = $query->row()->konfigurasi_isi;
		            }
				if($jpendidikan='sma'){
                  $op1 = 5;
                    } else {
                   $op1 = 4;
                   }
                   $ambiljwb = $this->cbt_jawaban_model->get_by_kolom('jawaban_soal_id',$data['id']);
                 
          $count = 1;
         $ambiljwb = $ambiljwb->result();
                    foreach ($ambiljwb as $value) {

 	
 	$data['pilganda'.$count.''] = $value->jawaban_detail;
    $data['jawaban_id'.$count.''] = $value->jawaban_id;
 	 	$count++;
 
                      }
		
			
			}
		}
				echo json_encode($data);

    }

    function upload_file(){
    	$this->load->library('form_validation');
        
        $this->form_validation->set_rules('image-topik-id', 'Topik','required');

        if($this->form_validation->run() == TRUE){
        	$id_topik = $this->input->post('image-topik-id', true);
        	$tm = $this->cbt_topik_model->get_by_kolom_join_modul('topik_id', $id_topik);
        	   $tm = $tm->result();
        	    foreach ($tm as $temp) {
$tmn = $temp->modul_nama;
$tmnt = $temp->topik_nama;
        	    }
	    	$posisi = $this->config->item('upload_path').'/topik_'.$tmn.'_'.$tmnt;

	    	if(!is_dir($posisi)){
	        	mkdir($posisi);
	        }

	    	$field_name = 'image-file';
	        if(!empty($_FILES[$field_name]['name'])){
		    	$config['upload_path'] = $posisi;
			    $config['allowed_types'] = 'jpg|png|jpeg';
			    $config['max_size']	= '0';
			    $config['overwrite'] = true;
			    $config['file_name'] = strtolower($_FILES[$field_name]['name']);

			    if(file_exists($posisi.'/'.$config['file_name'])){
	        		$status['status'] = 0;
	            	$status['pesan'] = 'Nama file sudah terdapat pada direktori, silahkan ubah nama file yang akan di upload';
		    	}else{
			        $this->load->library('upload', $config);
		            if (!$this->upload->do_upload($field_name)){
		            	$status['status'] = 0;
		            	$status['pesan'] = $this->upload->display_errors();
		            }else{
		            	$upload_data = $this->upload->data();

		            	$status['status'] = 1;
		                $status['pesan'] = 'File '.$upload_data['file_name'].' BERHASIL di IMPORT';
		                $status['image'] = '<img src="'.base_url().$posisi.'/'.$upload_data['file_name'].'" style="max-height: 110px;" />';
		                $status['image_isi'] = '<img src="'.base_url().$posisi.'/'.$upload_data['file_name'].'" style="max-width: 600px;" />';
		            }   	
		    	}     
	        }else{
	        	$status['status'] = 0;
	            $status['pesan'] = 'Pilih terlebih dahulu file yang akan di upload';
	        }
        }else{
        	$status['status'] = 0;
            $status['pesan'] = validation_errors();
        }
        echo json_encode($status);
    }
    
    function get_datatable(){
		// variable initialization
		$topik = $this->input->get('topik');

		$search = "";
		$start = 0;
		$rows = 10;

		// get search value (if any)
		if (isset($_GET['sSearch']) && $_GET['sSearch'] != "" ) {
			$search = $_GET['sSearch'];
		}

		// limit
		$start = $this->get_start();
		$rows = $this->get_rows();

		// run query to get user listing
		$query = $this->cbt_soal_model->get_datatable2($start, $rows, 'soal_detail', $search, $topik);
		$iFilteredTotal = $query->num_rows();
		
		$iTotal= $this->cbt_soal_model->get_datatable_count2('soal_detail', $search, $topik)->row()->hasil;
	    
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
	        "iTotalRecords" => $iTotal,
	        "iTotalDisplayRecords" => $iTotal,
	        "aaData" => array()
	    );

	    // get result after running query and put it in array
		$i=$start;
		$query = $query->result();
	    foreach ($query as $temp) {			
			$record = array();
            
			

			if($temp->soal_tipe==1){
				$record[] = '<b>[ Pilihan Ganda ]</b>';
			}else if($temp->soal_tipe==2){
				$record[] = '<b>[ Essay ]</b>';
			}else if($temp->soal_tipe==3){
				$record[] = '<b>[ Jawaban Singkat ]</b>';
			}

			$soal = $temp->soal_detail;
			$soal = str_replace("[base_url]", base_url(), $soal);
			if(!empty($temp->soal_audio)){
				
		$tm = $this->cbt_topik_model->get_by_kolom_join_modul('topik_id', $temp->soal_topik_id);
         $tm = $tm->result();
        	    foreach ($tm as $tmp) {
$tmn = $tmp->modul_nama;
$tmnt = $tmp->topik_nama;
        	    }
	    	$posisi = $this->config->item('upload_path').'/topik_'.$tmn.'_'.$tmnt;
				$soal = $soal.'<br />
					<audio controls>
					  <source src="'.base_url().$posisi.'/'.$temp->soal_audio.'" type="audio/mpeg">
					Your browser does not support the audio element.
					</audio>
				';
			}

            $jawaban_table = '
            	<table class="table" width="400px" border="0">
            		<tr><a onclick="edit(\''.$temp->soal_id.'\')" title="Edit Soal" style="cursor: pointer;"><i class="icon fa fa-edit fa-1x"></i></a>
              <td colspan="3">'.$soal.' </td>
                    </tr>
            ';

            
            if($temp->soal_tipe==1){
            	$query_jawaban = $this->cbt_tes_soal_jawaban_model->get_by_tessoal2($temp->soal_id);
	            if($query_jawaban->num_rows()>0){
	            	$query_jawaban = $query_jawaban->result();
	            	$a = 0;
	            	$jawaban_table = $jawaban_table.'
	            			<tr>
		                      	
		                      	<td width="5%"><b>Kunci</b></td>
		                       	<td width="30%"><b>Jawaban</b> </td>
		                       	<td width="100%"></td>
		                      
		                    </tr>
	            		';
	            	foreach ($query_jawaban as $jawaban) {
	            		$temp_jawaban = $jawaban->jawaban_detail;
						$temp_jawaban = str_replace("[base_url]", base_url(), $temp_jawaban);

						$temp_benar = '';
						if($jawaban->jawaban_benar==1){
							$temp_benar = '<b><i class="fa fa-check fa-lg text-success"></i></b>';
						}
						$temp_pilihan = '';
						if($jawaban->jawaban_aktif==1){
							$temp_pilihan = '<b><i class="fa fa-dot-circle fa-lg"></i></b>';
						}

	            		$jawaban_table = $jawaban_table.'
	            			<tr>
		                      	
		                      	<td width="5%">'.$temp_benar.'</td>
		                      
		                      	<td width="30%">'.$temp_jawaban.'</td>
		                    <td width="100%"></td>
		                    </tr>
	            		';
	            	}
	            }
            }else if($temp->soal_tipe==2){
            	// Jika soal adalah soal essay
            	$jawaban_table = $jawaban_table;
            }else if($temp->soal_tipe==3){
            	
            	$jawaban_table = $jawaban_table.'
            		<tr>
		            	<td width="5%"><b>Jawaban</b> '.$temp->soal_kunci.'</td>
		              
		            </tr>
	            	
	            ';
            }
            $jawaban_table = $jawaban_table.'</table>';

            $record[] = $jawaban_table;

			$output['aaData'][] = $record;
		}
		// format it to JSON, this output will be displayed in datatable
        
		echo json_encode($output);
	}

	function get_datatable_image(){
		$topik = $this->input->get('topik');
		if(!empty($topik)){
				$tm = $this->cbt_topik_model->get_by_kolom_join_modul('topik_id', $topik);
        	   $tm = $tm->result();
        	    foreach ($tm as $tmp) {
$tmn = $tmp->modul_nama;
$tmnt = $tmp->topik_nama;
        	    }
        	    $posisi = $this->config->item('upload_path').'/topik_'.$tmn.'_'.$tmnt;
		//	$posisi = $this->config->item('upload_path').'/topik_'.$topik;
		}else{
			$posisi = $this->config->item('upload_path');
		}

		// variable initialization
		$search = "";
		$start = 0;
		$rows = 10;

		// get search value (if any)
		if (isset($_GET['sSearch']) && $_GET['sSearch'] != "" ) {
			$search = $_GET['sSearch'];
		}

		// limit
		$start = $this->get_start();
		$rows = $this->get_rows();

		// run query to get user listing
		if(!is_dir($posisi)){
			mkdir($posisi);
	    }
		$query = directory_map($posisi, 1);

	    // get result after running query and put it in array
	    $iTotal = 0;
		$i=$start;

		$output = array(
			"sEcho" => intval($_GET['sEcho']),
	        "iTotalRecords" => $iTotal,
	        "iTotalDisplayRecords" => $iTotal,
	        "aaData" => array()
	    );
		
	    foreach ($query as $temp) {			
			$record = array();

			$temp = str_replace("\\","", $temp);
            
			//$record[] = ++$i;
			$is_dir=0;
			$is_image=0;
			$info = pathinfo($temp);

			if(!is_dir($posisi.'/'.$temp)){
            	if($info['extension']=='jpg' or $info['extension']=='png' or $info['extension']=='jpeg'){
            		$file_info = get_file_info($posisi.'/'.$temp);

            		
            		$record[] = '<a style="cursor:pointer;" onclick="image_preview(\''.$posisi.'\',\''.$temp.'\')"><img src="'.base_url().$posisi.'/'.$temp.'" height="40" /></a>';
            		//$record[] = date('Y-m-d H:i:s', $file_info['date']);
            		$record[] = '<center><a onclick="image_preview(\''.$posisi.'\',\''.$temp.'\')" style="cursor: pointer;" class="btn btn-primary btn-sm text-white">Pilih</a></center>';
            		$output['aaData'][] = $record;

					$iTotal++;
            	}
        	}
		}

		$output['iTotalRecords'] = $iTotal;
		$output['iTotalDisplayRecords'] = $iTotal;
        
		echo json_encode($output);
	}
	
	
	
	function get_start() {
		$start = 0;
		if (isset($_GET['iDisplayStart'])) {
			$start = intval($_GET['iDisplayStart']);

			if ($start < 0)
				$start = 0;
		}

		return $start;
	}

	function get_rows() {
		$rows = 10;
		if (isset($_GET['iDisplayLength'])) {
			$rows = intval($_GET['iDisplayLength']);
			if ($rows < 5 || $rows > 500) {
				$rows = 10;
			}
		}

		return $rows;
	}

	function get_sort_dir() {
		$sort_dir = "ASC";
		$sdir = strip_tags($_GET['sSortDir_0']);
		if (isset($sdir)) {
			if ($sdir != "asc" ) {
				$sort_dir = "DESC";
			}
		}

		return $sort_dir;
	}
}