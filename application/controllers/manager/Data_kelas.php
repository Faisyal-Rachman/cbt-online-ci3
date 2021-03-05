<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

class Data_kelas extends Member_Controller {
	private $kode_menu = 'kelas';
	private $kelompok = 'master';
	private $url = 'manager/data_kelas';
	
    function __construct(){
		parent:: __construct();
		$this->load->model('cbt_user_grup_model');
		$this->load->model('cbt_tesgrup_model');
		$this->load->model('Master_model', 'master');
		$this->load->library(['datatables', 'form_validation']); // Load Library Ignited-Datatables
		parent::cek_akses($this->kode_menu);
	}
	
	public function output_json($data, $encode = true)
	{
		if ($encode) $data = json_encode($data);
		$this->output->set_content_type('application/json')->set_output($data);
	}

    public function index(){
		
		$data = [
			//'user' => $this->ion_auth->user()->row(),
			'judul'	=> 'Group Kelas',
			'subjudul' => 'Data Kelas',
			'levelkelas'	=> $this->master->get_level()
		];
        $data['kode_menu'] = $this->kode_menu;
        $data['url'] = $this->url;
       
        $query_group = $this->master->get_levelInput();

        if($query_group->num_rows()>0){
        	$select = '';
        	$query_group = $query_group->result();
        	foreach ($query_group as $temp) {
        		$select = $select.'<option value="'.$temp->level_kode.'">'.$temp->level_nama.'</option>';
        	}

        }else{
        	$select = '<option value="100000">KOSONG</option>';
        }
        $data['select_group'] = $select;
        $this->template->display_admin($this->kelompok.'/kelas/data', 'Daftar Group Kelas', $data);
	}
	
	public function data()
	{
		$this->output_json($this->master->getDataKelas(), false);
	}
	
	public function simpan(){
		
			$nr = $this->input->post("nama_kelas");
		//$ket = $this->input->post("ket");
		$kr = $this->input->post("group");
	
		
   $data = array(
		
		 'grup_nama'=>$nr,
		 'level_kode_kelas'=>$kr,
		
		 );

			    $this->db->insert('cbt_user_grup',$data);
			$status['status'] = 1;
		    $status['pesan'] = 'Data berhasil disimpan';
				
				$this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Sejarah Sukses Disimpan !</h4> </div>');
			   
	 echo json_encode($status);
		}
public function simpanedit(){
		
		$id = $this->input->post("edit-id");
		$enr = $this->input->post("enama_kelas");
		//$ket = $this->input->post("ket");
		$ekr = $this->input->post("ekode_kelas");
	
		
			    $data = array(
		 'grup_id'=>$id,
		 'grup_nama'=>$enr,
		 'level_kode_kelas'=>$ekr
		 );
           $this->db->where('grup_id',$id);
		   $this->db->update('cbt_user_grup',$data);
			$status['status'] = 1;
		    $status['pesan'] = 'Data berhasil disimpan';
				
				$this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Sejarah Sukses Disimpan !</h4> </div>');
			   
	 echo json_encode($status);
		}
	 function hapus(){
		$nik = $this->input->post("id3");
		$lokasi = $this->input->post("lokasi3");
		$warna = "success";
		    $st="1";
			$kata = "Data Sukses Di Hapus";
		 $data = array(
		 'grup_id'=>$nik
		 
		 );

		   $this->db->where('grup_id',$nik);
		   $this->db->delete('cbt_user_grup',$data);
   $status['status'] = 1;
		    $status['pesan'] = 'Data telah dihapus';
		  $this->session->set_flashdata('info', '<div class="alert alert-'.$warna.' alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> '.$kata.' !</h4> </div>');
		
	
	 echo json_encode($status);
		}
 
	public function save()
	{
		$rows = count($this->input->post('grup_nama', true));
		$mode = $this->input->post('mode', true);
		for ($i = 1; $i <= $rows; $i++) {
			//ini inisialisasi var
			$grup_nama = 'grup_nama[' . $i . ']';
			$level_kode_kelas = 'level_kode_kelas[' . $i . ']';
			$this->form_validation->set_rules($grup_nama, 'Nama Kelas', 'required');
			$this->form_validation->set_message('required', '{field} Wajib diisi');

			if ($this->form_validation->run() === FALSE) {
				$error[] = [
					$grup_nama => form_error($grup_nama),
					$level_kode_kelas => form_error($level_kode_kelas),
				];
				$status = FALSE;
			} else {
				if ($mode == 'add') {
					$insert[] = [
						'grup_nama' => $this->input->post($grup_nama, true),
						'level_kode_kelas' => $this->input->post($level_kode_kelas, true)
					];
					
				} else if ($mode == 'edit') {
					$update[] = array(
						'grup_id'	=> $this->input->post('grup_id[' . $i . ']', true),
						'grup_nama' 	=> $this->input->post($grup_nama, true),
						'level_kode_kelas' => $this->input->post($level_kode_kelas, true)
					
					);
				}
				$status = TRUE;
			}
		}
		if ($status) {
			if ($mode == 'add') {
				$this->master->create('cbt_user_grup', $insert, true);
				$data['insert']	= $insert;
			} else if ($mode == 'edit') {
				$this->master->update('cbt_user_grup', $update, 'grup_id', null, true);
				$data['update'] = $update;
			}
		} else {
			if (isset($error)) {
				$data['errors'] = $error;
			}
		}
		$data['status'] = $status;
		$this->output_json($data);
		//redirect('mssssatpel');
	}

	public function import($import_data = null)
	{
		$data = [
			//'user' => $this->ion_auth->user()->row(),
			'judul'	=> 'Mata Pelajaran',
			'subjudul' => 'Import kelas',
			'kelas' => $this->master->getAllKelas()
		];
		if ($import_data != null) $data['import'] = $import_data;

		$this->template->display_admin($this->kelompok.'/kelas/import', 'Daftar Group Kelas', $data);
	}

	public function preview()
	{
		$config['upload_path']		= './uploads/import/';
		$config['allowed_types']	= 'xls|xlsx|csv';
		$config['max_size']			= 2048;
		$config['encrypt_name']		= true;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('upload_file')) {
			$error = $this->upload->display_errors();
			echo $error;
			die;
		} else {
			$file = $this->upload->data('full_path');
			$ext = $this->upload->data('file_ext');

			switch ($ext) {
				case '.xlsx':
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
					break;
				case '.xls':
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
					break;
				case '.csv':
					$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
					break;
				default:
					echo "unknown file ext";
					die;
			}

			$spreadsheet = $reader->load($file);
			$sheetData = $spreadsheet->getActiveSheet()->toArray();
			$kelas = [];
			for ($i = 1; $i < count($sheetData); $i++) {
				$kelas[] = [
					'grup_nama' => $sheetData[$i][0],
					'level_kode_kelas' => $sheetData[$i][1]
				];
				
			}

			unlink($file);

			$this->import($kelas);
		}
	}
	public function do_import()
	{
		$data = json_decode($this->input->post('kelas', true));
		$kelas = [];
		foreach ($data as $d) {
		$kelas[] = [
				'grup_nama' => $d->grup_nama,
				'level_kode_kelas' => $d->level_kode_kelas
			];
		}

		$save = $this->master->create('cbt_user_grup', $kelas, true);
		if ($save) {
			redirect('manager/data_kelas');
		} else {
			redirect('manager/data_kelas/import');
		}
	}



	public function delete()
	{
		$chk = $this->input->post('checked', true);
		if (!$chk) {
			$this->output_json(['status' => false]);
		} else {
			if ($this->master->delete('cbt_user_grup', $chk, 'grup_id')) {
				$this->output_json(['status' => true, 'total' => count($chk)]);
			}
		}
	}

    function tambah(){
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('tambah-group', 'Nama Group','required|strip_tags');
        
        if($this->form_validation->run() == TRUE){
            $data['grup_nama'] = $this->input->post('tambah-group', true);

            if($this->cbt_user_grup_model->count_by_kolom('grup_nama', $data['grup_nama'])->row()->hasil>0){
                $status['status'] = 0;
                $status['pesan'] = 'Nama Group sudah terpakai !';
            }else{
				$this->cbt_user_grup_model->save($data);
                
                $status['status'] = 1;
                $status['pesan'] = 'Group berhasil disimpan ';
            }
        }else{
            $status['status'] = 0;
            $status['pesan'] = validation_errors();
        }
        
        echo json_encode($status);
    }
    
    

	public function edit()
	{
		$chk = $this->input->post('checked', true);
		if (!$chk) {
			redirect('kelas');
		} else {
			$kelas = $this->master->getKelasById($chk);
			$data = [
				//'user' 		=> $this->ion_auth->user()->row(),
				'judul'		=> 'Edit Group Kelas',
				'subjudul'	=> 'Edit Kelas',
				'kelas'	=> $kelas,
				'levelkelas'	=> $this->master->getEditLevel()
			];
		
			$this->template->display_admin($this->kelompok.'/kelas/edit', 'Daftar Group Kelas', $data);
			
			
		}
	}
    function get_by_id($id){
    	$data['data'] = 1;
		if(!empty($id)){
			$query = $this->master->getkelasId($id);
				$query = $query->result();
	           foreach ($query as $temp) {		
				$data['data'] = 1;
				$data['id'] = $temp->grup_id;
				$data['ng'] = $temp->grup_nama;
				$data['kg'] = $temp->level_kode_kelas;
				echo json_encode($data);
			}
			
		}
		
    }
   function get_datatable(){
		// variable initialization
		$search = "";
		$start = 0;
		$rows = 4;

		if (isset($_GET['sSearch']) && $_GET['sSearch'] != "" ) {
			$search = $_GET['sSearch'];
		}
		
		// limit
		$start = $this->get_start();
		$rows = $this->get_rows();

		// run query to get user listing
		//$query = $this->cbt_user_model->get_datatable($start, $rows, 'user_firstname', $search, $group);
		$query = $this->master->getKelasT($start, $rows);
		$iFilteredTotal = $query->num_rows();
		
		$iTotal= $this->master->get_datatable_kelas_count()->row()->hasil;
	    
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
	        "iTotalRecords" => $iTotal,
	        "iTotalDisplayRecords" => $iTotal,
	        "aaData" => array()
	    );

	    // get result after running query and put it in array
		$i=$start;
		
			  foreach ($query->result() as $temp) {		
			  
			$record = array();
            
			$record[] = ++$i.'.';
			$record[] = $temp->grup_nama;
			$record[] = $temp->level_kode_kelas;
         	$record[] = '<div style="text-align: center;">
	            	<a onclick="edit(\''.$temp->grup_id.'\')" title="Edit Data" style="cursor: pointer;"><i class="icon fa fa-edit fa-1x"></i></a> - 
 <a href="#" class="fa fa-trash delete-user" style="color:red"  title="Hapus"
            data-toggle="modal" data-target="#delete" 
            data-id3="'.$temp->grup_id.'"
            data-stts="'.$temp->grup_nama.'"
            data-user_name="'.$temp->grup_nama.'"
            data-alrt="'.$temp->grup_nama.'">
                    </a>';


			$output['aaData'][] = $record;
		}
		// format it to JSON, this output will be displayed in datatable
        
		echo json_encode($output);
	}
	
	/**
	* funsi tambahan 
	* 
	* 
*/
	
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