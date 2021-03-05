<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

class Data_level extends Member_Controller {
	private $kode_menu = 'level';
	private $kelompok = 'master';
	private $url = 'manager/data_level';
	
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
			'judul'	=> 'Level Kelas',
			'subjudul' => 'Daftar Level'
		];
        $data['kode_menu'] = $this->kode_menu;
        $data['url'] = $this->url;
       
        $this->template->display_admin($this->kelompok.'/level/data', 'Daftar level Ujian', $data);
	}
	 function hapus(){
		$nik = $this->input->post("id3");
		$lokasi = $this->input->post("lokasi3");
		$warna = "success";
		    $st="1";
			$kata = "Data Sukses Di Hapus";
		 $data = array(
		 'level_id'=>$nik
		 
		 );

		   $this->db->where('level_id',$nik);
		   $this->db->delete('cbt_level',$data);
   $status['status'] = 1;
		    $status['pesan'] = 'Data telah dihapus';
		  $this->session->set_flashdata('info', '<div class="alert alert-'.$warna.' alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> '.$kata.' !</h4> </div>');
		
	
	 echo json_encode($status);
		}
	public function data()
	{
		$this->output_json($this->master->getDataLevel(), false);
	}
	
	public function simpan(){
		
			$nr = $this->input->post("nama_level");
		//$ket = $this->input->post("ket");
		$kr = $this->input->post("kode_level");
	
		
   $data = array(
		
		 'level_nama'=>$nr,
		 'level_kode'=>$kr,
		
		 );

			    $this->db->insert('cbt_level',$data);
			$status['status'] = 1;
		    $status['pesan'] = 'Data berhasil disimpan';
				
				$this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Sejarah Sukses Disimpan !</h4> </div>');
			   
	 echo json_encode($status);
		}
public function simpanedit(){
		
		$id = $this->input->post("edit-id");
		$enr = $this->input->post("enama_level");
		//$ket = $this->input->post("ket");
		$ekr = $this->input->post("ekode_level");
	
		
			    $data = array(
		 'level_id'=>$id,
		 'level_nama'=>$enr,
		 'level_kode'=>$ekr
		 );
           $this->db->where('level_id',$id);
		   $this->db->update('cbt_level',$data);
			$status['status'] = 1;
		    $status['pesan'] = 'Data berhasil disimpan';
				
				$this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Sejarah Sukses Disimpan !</h4> </div>');
			   
	 echo json_encode($status);
		}

	

	public function import($import_data = null)
	{
		$data = [
			//'user' => $this->ion_auth->user()->row(),
			'judul'	=> 'level Ujian',
			'subjudul' => 'Import level',
			'level' => $this->master->getAlllevel()
		];
		if ($import_data != null) $data['import'] = $import_data;

		$this->template->display_admin($this->kelompok.'/level/import', 'Daftar Group level', $data);
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
			$level = [];
			for ($i = 1; $i < count($sheetData); $i++) {
				$level[] = [
					'level_nama' => $sheetData[$i][0],
					'level_kode' => $sheetData[$i][1]
				];
				
			}

			unlink($file);

			$this->import($level);
		}
	}
	public function do_import()
	{
		$data = json_decode($this->input->post('level', true));
		$level = [];
		foreach ($data as $d) {
		$level[] = [
				'level_nama' => $d->level_nama,
				'level_kode' => $d->level_kode
			];
		}

		$save = $this->master->create('cbt_level', $level, true);
		if ($save) {
			redirect('manager/data_level');
		} else {
			redirect('manager/data_level/import');
		}
	}



	public function delete()
	{
		$chk = $this->input->post('checked', true);
		if (!$chk) {
			$this->output_json(['status' => false]);
		} else {
			if ($this->master->delete('cbt_level', $chk, 'level_id')) {
				$this->output_json(['status' => true, 'total' => count($chk)]);
			}
		}
	}

    function tambah(){
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('tambah-group', 'Nama Group','required|strip_tags');
        
        if($this->form_validation->run() == TRUE){
            $data['level_nama'] = $this->input->post('tambah-group', true);

            if($this->cbt_user_grup_model->count_by_kolom('level_nama', $data['level_nama'])->row()->hasil>0){
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
    
    function get_by_id($id){
    	$data['data'] = 1;
		if(!empty($id)){
			$query = $this->master->getlevelId($id);
				$query = $query->result();
	           foreach ($query as $temp) {		
				$data['data'] = 1;
				$data['id'] = $temp->level_id;
				$data['nr'] = $temp->level_nama;
				$data['kr'] = $temp->level_kode;
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
		$query = $this->master->getLevel($start, $rows);
		$iFilteredTotal = $query->num_rows();
		
		$iTotal= $this->master->get_datatable_level_count()->row()->hasil;
	    
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
			$record[] = $temp->level_nama;
			$record[] = $temp->level_kode;
         	$record[] = '<div style="text-align: center;">
	            	<a onclick="edit(\''.$temp->level_id.'\')" title="Edit Data" style="cursor: pointer;"><i class="icon fa fa-edit fa-1x"></i></a> - 
 <a href="#" class="fa fa-trash delete-user" style="color:red"  title="Hapus"
            data-toggle="modal" data-target="#delete" 
            data-id3="'.$temp->level_id.'"
            data-stts="'.$temp->level_nama.'"
            data-user_name="'.$temp->level_nama.'"
            data-alrt="'.$temp->level_nama.'">
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