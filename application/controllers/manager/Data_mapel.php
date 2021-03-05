<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

class Data_mapel extends Member_Controller {
	private $kode_menu = 'mapel';
	private $kelompok = 'master';
	private $url = 'manager/data_mapel';
	
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
			'judul'	=> 'Mata Pelajaran',
			'subjudul' => 'List Mata Pelajaran'
		];
        $data['kode_menu'] = $this->kode_menu;
        $data['url'] = $this->url;
       
        $this->template->display_admin($this->kelompok.'/matpel/data', 'Daftar Group', $data);
	}
	
	public function data()
	{
		$this->output_json($this->master->getDataMapel(), false);
	}
	
	
public function simpan(){
		
			$kkm = $this->input->post("modul_kkm");
		$kode = $this->input->post("modul_kode");
		$nm = $this->input->post("modul_nama");
		$aktif = $this->input->post("modul_aktif");
		
   $data = array(
		
		 'modul_nama'=>$nm,
		 'modul_aktif'=>$aktif,
		 'modul_kode'=>$kode,
		 'modul_kkm'=>$kkm
		 );

			    $this->db->insert('cbt_modul',$data);
			$status['status'] = 1;
		    $status['pesan'] = 'Data berhasil disimpan';
				
				$this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Sejarah Sukses Disimpan !</h4> </div>');
			   
	 echo json_encode($status);
		}
public function simpanedit(){
		
		$id = $this->input->post("edit-id");
		$kkm = $this->input->post("modul_kkm");
		$kode = $this->input->post("modul_kode");
		$nm = $this->input->post("modul_nama");
		$aktif = $this->input->post("modul_aktif");
		
			    $data = array(
		 'modul_id'=>$id,
		 'modul_nama'=>$nm,
		 'modul_aktif'=>$aktif,
		 'modul_kode'=>$kode,
		 'modul_kkm'=>$kkm
		 );
           $this->db->where('modul_id',$id);
		   $this->db->update('cbt_modul',$data);
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
		 'modul_id'=>$nik
		 
		 );

		   $this->db->where('modul_id',$nik);
		   $this->db->delete('cbt_modul',$data);
		   $status['status'] = 1;
		    $status['pesan'] = 'Data telah dihapus';
		  $this->session->set_flashdata('info', '<div class="alert alert-'.$warna.' alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> '.$kata.' !</h4> </div>');
		
	
	 echo json_encode($status);
		}
  
   
    function get_by_id($id){
    	$data['data'] = 1;
		if(!empty($id)){
			$query = $this->master->getmatpelById($id);
				$query = $query->result();
	           foreach ($query as $temp) {		
				$data['data'] = 1;
				$data['id'] = $temp->modul_id;
				$data['modul'] = $temp->modul_nama;
				$data['stat'] = $temp->modul_aktif;
				$data['kode'] = $temp->modul_kode;
				$data['kkm'] = $temp->modul_kkm;
				echo json_encode($data);
			}
			
		}
		
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


	public function import($import_data = null)
	{
		$data = [
			//'user' => $this->ion_auth->user()->row(),
			'judul'	=> 'Mata Pelajaran',
			'subjudul' => 'Import Matpel',
			'matpel' => $this->master->getAllMatpel()
		];
		if ($import_data != null) $data['import'] = $import_data;

		$this->template->display_admin($this->kelompok.'/matpel/import', 'Daftar Group', $data);
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
			$matpel = [];
			for ($i = 1; $i < count($sheetData); $i++) {
				$matpel[] = [
					'modul_nama' => $sheetData[$i][0],
					'modul_aktif' => $sheetData[$i][1]
				];
				
			}

			unlink($file);

			$this->import($matpel);
		}
	}
	public function do_import()
	{
		$data = json_decode($this->input->post('matpel', true));
		$matpel = [];
		foreach ($data as $d) {
		$matpel[] = [
				//'modul_id' => $d->modul_id,
				'modul_nama' => $d->modul_nama,
				'modul_aktif' => $d->modul_aktif
			];
		}

		$save = $this->master->create('cbt_modul', $matpel, true);
		if ($save) {
			redirect('manager/data_mapel');
		} else {
			redirect('manager/data_mapel/import');
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
		$query = $this->master->getDataMapel($start, $rows);
		$iFilteredTotal = $query->num_rows();
		
		$iTotal= $this->master->get_datatable_mapel_count()->row()->hasil;
	    
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
	        "iTotalRecords" => $iTotal,
	        "iTotalDisplayRecords" => $iTotal,
	        "aaData" => array()
	    );

	    // get result after running query and put it in array
		$i=$start;
		
			  foreach ($query->result() as $temp) {		
			  if($temp->modul_aktif==1){
			  	$status =  'Aktif';
			  }else{
			  	$status =  'Tidak Aktif';
			  }
			$record = array();
            
			$record[] = ++$i.'.';
			$record[] = $temp->modul_nama;
			$record[] = $status;
			$record[] = $temp->modul_kkm;
			$record[] = $temp->modul_kode;
         	$record[] = '<div style="text-align: center;">
	            	<a onclick="edit(\''.$temp->modul_id.'\')" title="Edit Data" style="cursor: pointer;"><i class="icon fa fa-edit fa-1x"></i></a> - 
 <a href="#" class="fa fa-trash delete-user" style="color:red"  title="Hapus"
            data-toggle="modal" data-target="#delete" 
            data-id3="'.$temp->modul_id.'"
            data-stts="'.$temp->modul_nama.'"
            data-user_name="'.$temp->modul_nama.'"
            data-alrt="'.$temp->modul_nama.'">
                    </a>';


			$output['aaData'][] = $record;
		}
		// format it to JSON, this output will be displayed in datatable
        
		echo json_encode($output);
	}
	

}