<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Data_all_master extends Member_Controller {
	private $kode_menu = 'datamaster-import';
	private $kelompok = 'master';
	private $url = 'manager/data_all_master';
	
    function __construct(){
		parent:: __construct();
		$this->load->model('cbt_user_grup_model');
        $this->load->model('cbt_user_model');
        $this->load->model('Master_model', 'master');

        parent::cek_akses($this->kode_menu);
	}
	
    public function index(){
        $this->import();
      
    }

    public function import(){
        $data['kode_menu'] = $this->kode_menu;
        $data['url'] = $this->url;

        $this->load->library('form_validation');
        include_once ( APPPATH."libraries/excel_reader2.php"); 
        $data['error'] = '';
        $data['error_upload'] = '';

        if(!empty($_FILES['userfile']['name'])){
			$config['upload_path'] = './public/uploads/';
	        $config['allowed_types'] = 'xls|xlsx';
	        $config['max_size']	= '0';
	        $config['overwrite'] = true;
	        $config['file_name'] = $_FILES['userfile']['name'];
	            
	        $this->load->library('upload', $config);
            if (!$this->upload->do_upload()){
            	$data['error_upload'] = $this->upload->display_errors().'Tipe file yang di upload adalah '.$_FILES['userfile']['type'];
            }else{
            	$upload_data = $this->upload->data();
            
                $data['hasil'] = $this->import_file();
               
               
            }   
                    
        }else{
        	$data['error_upload'] = 'Pilih File yang akan di IMPORT';
        }
        
        $this->template->display_admin($this->kelompok.'/datamaster/datamaster_import', 'Import Data Master', $data);
    }
   
    function import_file(){
     // error_reporting(E_ALL ^ E_NOTICE);
   $this->db->query('TRUNCATE cbt_user_grup');
  // $this->db->query('TRUNCATE cbt_user');
   $this->db->query('TRUNCATE cbt_sesi_ujian');
   $this->db->query('TRUNCATE cbt_ruang');
   $this->db->query('TRUNCATE cbt_modul');
   $this->db->query('TRUNCATE cbt_level');
   $this->db->query('TRUNCATE cbt_jurusan');
   $this->db->query('TRUNCATE cbt_jenis_ujian');

        include_once ( APPPATH."libraries/excel_reader2.php");
      //  $inputFileName = './public/uploads/'.$inputfile;
       // $con = $this->load->database($dsn);
        $data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);

      $jmlbaris = $data->rowcount(0);
      for ($i=2; $i<=$jmlbaris; $i++)
      {
        $dat = $data->val($i, 1, 0);
        $dat1 = $data->val($i, 1, 1);
      }
      if($this->cbt_user_model->count_by_master2('modul_nama', $dat)->row()->hasil>0
      or $this->cbt_user_model->count_by_master4('jenis_nama', $dat1)->row()->hasil>0){
          $cek = "<div class='text-light'><h3><div class='text-warning'>ERROR</div> Pastikan tidak ada nama data yang sama!</h3></div>";
       
      }else{
for ($i=2; $i<=$jmlbaris; $i++)
{
    
    $datakolom = array(
        'modul_nama' => $data->val($i, 1, 0),
        'modul_aktif' =>  $data->val($i, 2, 0),
         'modul_kkm' =>  $data->val($i, 3, 0)

    );

$this->db->insert('cbt_modul',$datakolom);
$upload_data = $this->upload->data();
$cek='<div class="alert alert-info alert-dismissable">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<h4><i class="icon fa fa-info"></i> Informasi!</h4>File '.$upload_data['file_name'].' BERHASIL di IMPORT';
}
    


$jmlbaris = $data->rowcount(1);
 
for ($i=2; $i<=$jmlbaris; $i++)
{
    // baca data pada baris ke-i, kolom ke-1, pada sheet 2
   
    $datakolom = array(
        'jenis_nama' => $data->val($i, 1, 1),
        'kode_jenis' =>  $data->val($i, 2, 1),
        'status' =>  $data->val($i, 3, 1),


    );
    $this->db->insert('cbt_jenis_ujian',$datakolom);
    
}
 


//-------- import dari sheet 3 ----------

// baca jumlah baris dalam sheet 3
$jmlbaris = $data->rowcount(2);
 
for ($i=2; $i<=$jmlbaris; $i++)
{
 
    $datakolom = array(
        'jurusan_nama' => $data->val($i, 1, 2),
        'jurusan_kode' =>  $data->val($i, 2, 2)

    );

        // insert data ke tabel mhs
        $this->db->insert('cbt_jurusan',$datakolom);
       
}


$jmlbaris = $data->rowcount(3);
 
for ($i=2; $i<=$jmlbaris; $i++)
{
 
    $datakolom = array(
        'grup_nama' => $data->val($i, 2, 3),
        'level_kode_kelas' =>  $data->val($i, 3, 3)

    );

      //  $this->db->query('TRUNCATE cbt_user_grup');
        $this->db->insert('cbt_user_grup',$datakolom);
       
}

$jmlbaris = $data->rowcount(4);
 
for ($i=2; $i<=$jmlbaris; $i++)
{
 
    $datakolom = array(
        'level_nama' => $data->val($i, 1, 4),
        'level_kode' =>  $data->val($i, 2, 4)

    );

        // insert data ke tabel mhs
        $this->db->insert('cbt_level',$datakolom);
     
}
$jmlbaris = $data->rowcount(5);
 
for ($i=2; $i<=$jmlbaris; $i++)
{
 
    $datakolom = array(
        'ruang_nama' => $data->val($i, 1, 5),
        'ruang_kode' =>  $data->val($i, 2, 5)

    );

        // insert data ke tabel mhs
        $this->db->insert('cbt_ruang',$datakolom);
      
}
$jmlbaris = $data->rowcount(6);
 
for ($i=2; $i<=$jmlbaris; $i++)
{
 
    $datakolom = array(
        'sesi_nama' => $data->val($i, 1, 6),
        'sesi_kode' =>  $data->val($i, 2, 6)

    );

        // insert data ke tabel mhs
        $this->db->insert('cbt_sesi_ujian',$datakolom);
       
}
$jmlbaris = $data->rowcount(7);
 
for ($i=2; $i<=$jmlbaris; $i++)
{
 
    $datakolom = array(
        'user_grup_id' => $data->val($i, 1, 7),
        'user_name' => $data->val($i, 2, 7),
        'user_jurusan' =>  $data->val($i, 3, 7),
         'user_birthdate' => $data->val($i, 4, 7),
         'user_jkl' =>  $data->val($i, 5, 7),
        'user_agama' =>  $data->val($i, 6, 7),
        'user_firstname' =>  $data->val($i, 7, 7),
         'user_sesi' => $data->val($i, 8, 7),
         'user_password' => $data->val($i, 9, 7),
        'user_email' =>  $data->val($i, 10, 7),
        'user_level' => $data->val($i, 11, 7),
        'user_detail' => $data->val($i, 12, 7)

    );

        // insert data ke tabel mhs
        $this->db->insert('cbt_user',$datakolom);
       
}
      }
//var_dump($data->val(1, 0));
return $cek;
    }
}