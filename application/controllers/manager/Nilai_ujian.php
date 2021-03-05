<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nilai_ujian extends Member_Controller {
	private $kode_menu = 'nilai-ujian';
	private $kelompok = 'nilai';
	private $url = 'manager/nilai_ujian';
	
    function __construct(){
		parent:: __construct();
		$this->load->model('cbt_user_model');
		$this->load->model('cbt_user_grup_model');
		$this->load->model('cbt_tes_model');
		$this->load->model('cbt_tes_token_model');
		$this->load->model('cbt_nilai_model');
		$this->load->model('cbt_tes_topik_set_model');
		$this->load->model('cbt_tes_user_model');
		$this->load->model('cbt_tesgrup_model');
		$this->load->model('cbt_soal_model');
		$this->load->model('cbt_jawaban_model');
		$this->load->model('cbt_tes_soal_model');
		$this->load->model('cbt_konfigurasi_model');
		$this->load->model('cbt_tes_soal_jawaban_model');

        parent::cek_akses($this->kode_menu);
	}
	
    public function index($page=null, $id=null){
	
        $data['kode_menu'] = $this->kode_menu;
		$data['url'] = $this->url;
		$data['th'] ='no';
		if(!$this->db->table_exists('cbt_remidi')){
$data['pn'] = '<div class="modal-dialog">
	<div class="modal-content">
	<div class="modal-header bg-info">
	<h5 class="modal-title">Nilai Peserta Ujian!</h5>
   
		</div>
		<div class="modal-body">
			<div class="row-fluid">
				<div class="card-body">
				<strong>Informasi!</strong>
				   Nilai akan ditampilkan jika ujian sudah berjalan.
					<br /><br />
				   </div>
			</div>
		</div>
	   
	</div>
</div>';
$data['th'] ='no';
   }else{
	$data['pn'] = "";
	$data['th'] ='table-hasil';
   }
        $tanggal_awal = date('Y-m-d H:i', strtotime('- 1 days'));
        $tanggal_akhir = date('Y-m-d H:i', strtotime('+ 1 days'));
        
        $data['rentang_waktu'] = $tanggal_awal.' - '.$tanggal_akhir;

        $query_group = $this->cbt_user_grup_model->get_groupnilai();
        $select = '<option value="semua">Pilih Kelas</option>';
        if($query_group->num_rows()>0){
        	$query_group = $query_group->result();
        	foreach ($query_group as $temp) {
        		$select = $select.'<option value="'.$temp->grup_id.'">'.$temp->grup_nama.'</option>';
        	}

        }else{
        	$select = '<option value="0">Tidak Ada Group</option>';
        }
        $data['select_group'] = $select;

        $query_tes = $this->cbt_tes_user_model->get_by_kelas();
        $select = '<option value="semua">Semua Mapel</option>';
        if($query_tes->num_rows()>0){
        	$query_tes = $query_tes->result();
        	foreach ($query_tes as $temp) {
        		$select = $select.'<option value="'.$temp->modul_id.'">'.$temp->modul_nama.'</option>';
        	}
        }
        $data['select_tes'] = $select;
        
        $this->template->display_admin($this->kelompok.'/tes_hasil_view', 'Hasil Tes', $data);
    }

    function edit_tes(){
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('edit-testuser-id[]', 'Hasil Tes','required|strip_tags');
        $this->form_validation->set_rules('edit-pilihan', 'Pilihan','required|strip_tags');
        
        if($this->form_validation->run() == TRUE){
            $pilihan = $this->input->post('edit-pilihan', true);
            $tesuser_id = $this->input->post('edit-testuser-id', TRUE);

            if($pilihan=='hapus'){
                foreach( $tesuser_id as $kunci => $isi ) {
                    if($isi=="on"){
                        $this->cbt_tes_user_model->delete('tesuser_id', $kunci);
                    }
                }
            	$status['status'] = 1;
            	$status['pesan'] = 'Hasil tes berhasil dihapus';
            }else if($pilihan=='hentikan'){
            	foreach( $tesuser_id as $kunci => $isi ) {
                    if($isi=="on"){
                    	$data_tes['tesuser_status']=4;
            			$this->cbt_tes_user_model->update('tesuser_id', $kunci, $data_tes);
                    }
                }
            	$status['status'] = 1;
            	$status['pesan'] = 'Tes berhasil dihentikan';
            }else if($pilihan=='buka'){
            	foreach( $tesuser_id as $kunci => $isi ) {
                    if($isi=="on"){
                    	$data_tes['tesuser_status']=1;
            			$this->cbt_tes_user_model->update('tesuser_id', $kunci, $data_tes);
                    }
                }
            	$status['status'] = 1;
            	$status['pesan'] = 'Tes berhasil dibuka, user bisa mengerjakan kembali';
            }else if($pilihan=='waktu'){
            	foreach( $tesuser_id as $kunci => $isi ) {
                    if($isi=="on"){
                    	$waktu = intval($this->input->post('waktu-menit', TRUE));

            			$this->cbt_tes_user_model->update_menit($kunci, $waktu);
                    }
                }
            	$status['status'] = 1;
            	$status['pesan'] = 'Waktu Tes berhasil ditambah';
            }

        }else{
            $status['status'] = 0;
            $status['pesan'] = validation_errors();
        }
        
        echo json_encode($status);
    }

    function export($tes_id=null, $grup_id=null,$urutkan=null){
    	$data['gambar'] =  $this->cbt_konfigurasi_model->get_by_kolom('konfigurasi_id', 5);
    	$data['gambar2'] =  $this->cbt_konfigurasi_model->get_by_kolom('konfigurasi_id', 9);
    	$query = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_nama', 1);
    	$query2 = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_tahun', 7);
    	$data['site_name']=$query->row()->konfigurasi_isi;
    	$data['thn_sekolah']=$query2->row()->konfigurasi_isi;
        if(!empty($tes_id) AND !empty($grup_id) AND !empty($urutkan)){
            $this->load->library('excel');
         
       $search = "";
		$start = 0;
		$rows = 10;

          $query = $this->cbt_nilai_model->get_nama_siswa($start, $rows, $tes_id, $grup_id);
            $inputFileName = './public/form/form-data-hasil-tes.xls';
            $tt = array();	
            $excel = PHPExcel_IOFactory::load($inputFileName);
            $worksht = $excel->getSheet(0);
            $worksht->setCellValueByColumnAndRow(1, 1, $data['site_name']);
             $worksht->setCellValueByColumnAndRow(1, 2, $data['thn_sekolah']);
            //$worksht->setCellValueByColumnAndRow(2, 2, 'ini isi cell A2');
            $worksheet = $excel->getSheet(0);

            if($query->num_rows()>0){
                $query = $query->result();
                $row = 8;
                $i=1;
                foreach ($query as $temp) {
                	 $worksheet->setCellValueByColumnAndRow(0, $row, $i++);
                	 
	      $worksht->setCellValueByColumnAndRow(1, $row, $temp->user_birthdate);
	  

                      
$query2 = $this->cbt_nilai_model->get_datatable($start, $rows, $tes_id, $grup_id, $temp->user_birthdate);
			
	$brs = $query2->num_rows();
	$query2 = $query2->result();
    $cek = 'oke';
foreach ($query2 as $temp) {
	
	 $worksheet->setCellValueByColumnAndRow(2, $row++, $temp->modul_nama.' - '.$temp->nilai);
 $worksheet->setCellValueByColumnAndRow(1,3, 'Nilai Kelas : '.$temp->grup_nama);
}

       $query3 = $this->cbt_nilai_model->get_rata($start, $rows, $tes_id, $grup_id, $temp->user_birthdate);
			foreach ($query3->result() as $row2)
{
	$cnv = number_format($row2->rata,1,',',',');
	      $worksht->setCellValueByColumnAndRow(3, $row-$brs, $cnv);
	  
}
                    $row++;

                }
                
            }
            $filename='Data Hasil Tes - '.date('Y-m-d H:i').'.xls'; //save our workbook as this file name
            header('Content-Type: application/vnd.ms-excel'); //mime type
            header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
            header('Cache-Control: max-age=0'); //no cache
                 
            //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
            //if you want to save it as .XLSX Excel 2007 format
            $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
            //force user to download the Excel file without writing it to server's HD
            $objWriter->save('php://output');
        }
    }
    
	function get_datatable(){
		// variable initialization
		$tes_id = $this->input->get('tes');
		$grup_id = $this->input->get('group');
	//	$urutkan = $this->input->get('urutkan');
		$waktu = $this->input->get('waktu');
	//	$keterangan = $this->input->get('keterangan');
		$status = $this->input->get('status');
		$tanggal = explode(" - ", $waktu);

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
	
			$query = $this->cbt_nilai_model->get_nama_siswa($start, $rows, $tes_id, $grup_id);
			$iTotal= $this->cbt_nilai_model->get_datatable_count($tes_id, $grup_id)->row()->hasil;
		
		
		$iFilteredTotal = $query->num_rows();
	    
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
					$r = array();	
		$s = array();
		$t = array();	
		$record = array();
$record[] = '<a href="#" title="Klik untuk mengetahui Detail Tes" onclick="detail_tes(\''.$temp->tesuser_id.'\')"><b>'.stripslashes($temp->user_firstname).' - '.$temp->user_birthdate.'</b></a>';       
$query2 = $this->cbt_nilai_model->get_datatable($start, $rows, $tes_id, $grup_id,$temp->user_birthdate);
			foreach ($query2->result() as $row)
{
	       $r[] = array('<b>('.$row->modul_nama.' : '.$row->nilai.'</b>)');
	       
}
      $record[] = ($r);
$query3 = $this->cbt_nilai_model->get_rata($start, $rows, $tes_id, $grup_id,$temp->user_birthdate);
			foreach ($query3->result() as $row3)
{

	$cnv = number_format($row3->rata,1,',',',');
	        $record[] = $cnv;
	       
}
		  

			$output['aaData'][] = $record;
		}
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