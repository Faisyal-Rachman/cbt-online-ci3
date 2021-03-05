<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

class Data_jenis extends Member_Controller {
	private $kode_menu = 'jenis';
	private $kelompok = 'master';
	private $url = 'manager/data_jenis';
	
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
			'judul'	=> 'Data jenis',
			'subjudul' => 'Jenis Ujian'
		];
        $data['kode_menu'] = $this->kode_menu;
        $data['url'] = $this->url;
       
        $this->template->display_admin($this->kelompok.'/jenis/data', 'Data jenis ujian', $data);
	}
	
	public function data()
	{
		$this->output_json($this->master->getDataJenis(), false);
	}
	
	

	public function import($import_data = null)
	{
		$data = [
			//'user' => $this->ion_auth->user()->row(),
			'judul'	=> 'jenis Keahlian',
			'subjudul' => 'Import jenis',
			'jenis' => $this->master->getAlljenis()
		];
		if ($import_data != null) $data['import'] = $import_data;

		$this->template->display_admin($this->kelompok.'/jenis/import', 'Daftar jenis', $data);
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
			$jenis = [];
			for ($i = 1; $i < count($sheetData); $i++) {
				$jenis[] = [
					'jenis_nama' => $sheetData[$i][0],
					'jenis_kode' => $sheetData[$i][1]
				];
				
			}

			unlink($file);

			$this->import($jenis);
		}
	}
	public function do_import()
	{
		$data = json_decode($this->input->post('jenis', true));
		$jenis = [];
		foreach ($data as $d) {
		$jenis[] = [
				'jenis_nama' => $d->jenis_nama,
				'jenis_kode' => $d->jenis_kode
			];
		}

		$save = $this->master->create('cbt_jenis_ujian', $jenis, true);
		if ($save) {
			redirect('manager/data_jenis');
		} else {
			redirect('manager/data_jenis/import');
		}
	}


public function simpan(){
		
			$kkm = $this->input->post("jenis_kkm");
		//$ket = $this->input->post("ket");
		$nm = $this->input->post("jenis_nama");
		$aktif = $this->input->post("jenis_aktif");
		
   $data = array(
		
		 'jenis_nama'=>$nm,
		 'status'=>$aktif,
		 'kode_jenis'=>$kkm
		 );

			    $this->db->insert('cbt_jenis_ujian',$data);
			$status['status'] = 1;
		    $status['pesan'] = 'Data berhasil disimpan';
				
				$this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Sejarah Sukses Disimpan !</h4> </div>');
			   
	 echo json_encode($status);
		}
public function simpanedit(){
		
		$id = $this->input->post("edit-id");
		$kkm = $this->input->post("ejenis_kkm");
		//$ket = $this->input->post("ket");
		$nm = $this->input->post("ejenis_nama");
		$aktif = $this->input->post("ejenis_aktif");
		
			    $data = array(
		 'jenis_id'=>$id,
		 'jenis_nama'=>$nm,
		 'status'=>$aktif,
		 'kode_jenis'=>$kkm
		 );
           $this->db->where('jenis_id',$id);
		   $this->db->update('cbt_jenis_ujian',$data);
			$status['status'] = 1;
		    $status['pesan'] = 'Data berhasil diubah';
				
				$this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Sejarah Sukses Disimpan !</h4> </div>');
			   
	 echo json_encode($status);
		}


	
    
    function get_by_id($id){
    	$data['data'] = 1;
		if(!empty($id)){
			$query = $this->master->getjenisId($id);
				$query = $query->result();
	           foreach ($query as $temp) {		
				$data['data'] = 1;
				$data['id'] = $temp->jenis_id;
				$data['jenis'] = $temp->jenis_nama;
				$data['stat'] = $temp->status;
				$data['kkm'] = $temp->kode_jenis;
				echo json_encode($data);
			}
			
		}
		
    }

	
   function hapus(){
		$nik = $this->input->post("id3");
		$lokasi = $this->input->post("lokasi3");
		$warna = "success";
		    $st="1";
			$kata = "Data Sukses Di Hapus";
		 $data = array(
		 'jenis_id'=>$nik
		 
		 );

		   $this->db->where('jenis_id',$nik);
		   $this->db->delete('cbt_jenis_ujian',$data);
		   $status['status'] = 1;
		    $status['pesan'] = 'Data telah dihapus';
		  $this->session->set_flashdata('info', '<div class="alert alert-'.$warna.' alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> '.$kata.' !</h4> </div>');
		
	
	 echo json_encode($status);
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
		$query = $this->master->getJenisUjian($start, $rows);
		$iFilteredTotal = $query->num_rows();
		
		$iTotal= $this->master->get_datatable_jenis_count()->row()->hasil;
	    
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
	        "iTotalRecords" => $iTotal,
	        "iTotalDisplayRecords" => $iTotal,
	        "aaData" => array()
	    );

	    // get result after running query and put it in array
		$i=$start;
		
			  foreach ($query->result() as $temp) {		
			  if($temp->status==1){
			  	$status =  'Aktif';
			  }else{
			  	$status =  'Tidak Aktif';
			  }
			$record = array();
            
			$record[] = ++$i.'.';
			$record[] = $temp->jenis_nama;
			$record[] = $status;
			$record[] = '<div style="text-align: center;">
	            	<a onclick="edit(\''.$temp->jenis_id.'\')" title="Edit Data" style="cursor: pointer;"><i class="icon fa fa-edit fa-1x"></i></a> - 
 <a href="#" class="fa fa-trash delete-user" style="color:red"  title="Hapus"
            data-toggle="modal" data-target="#delete" 
            data-id3="'.$temp->jenis_id.'"
            data-stts="'.$temp->jenis_nama.'"
            data-user_name="'.$temp->jenis_nama.'"
            data-alrt="'.$temp->jenis_nama.'">
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