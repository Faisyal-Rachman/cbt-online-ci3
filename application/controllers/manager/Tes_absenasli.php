<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tes_absen extends Member_Controller {
    private $kode_menu = 'tes-absen';
    private $kelompok = 'peserta';
    private $url = 'manager/tes_absen';
    
    function __construct(){
        parent:: __construct();
        $this->load->model('cbt_user_model');
        $this->load->model('cbt_user_grup_model');
        $this->load->model('cbt_tes_model');
        $this->load->model('cbt_tes_token_model');
        $this->load->model('cbt_tes_topik_set_model');
        $this->load->model('cbt_tes_user_model');
        $this->load->model('cbt_tesgrup_model');
        $this->load->model('cbt_soal_model');
        $this->load->model('cbt_jawaban_model');
        $this->load->model('cbt_tes_soal_model');
        $this->load->model('cbt_tes_soal_jawaban_model');
        $this->load->model('cbt_konfigurasi_model');
        $this->load->model('Master_model', 'master');

        parent::cek_akses($this->kode_menu);
    }
    
    public function index($page=null, $id=null){
        $data['kode_menu'] = $this->kode_menu;
        $data['url'] = $this->url;
        $data['nama_ujian'] = $this->master->getUjian();
        $tanggal_awal = date('Y-m-d H:i', strtotime('- 1 days'));
        $tanggal_akhir = date('Y-m-d H:i', strtotime('+ 1 days'));
        
        $data['rentang_waktu'] = $tanggal_awal.' - '.$tanggal_akhir;

        $query_group = $this->cbt_user_grup_model->get_group();
        $select = '<option value="semua">Semua Group</option>';
        if($query_group->num_rows()>0){
            $query_group = $query_group->result();
            foreach ($query_group as $temp) {
                $select = $select.'<option value="'.$temp->grup_id.'">'.$temp->grup_nama.'</option>';
            }

        }else{
            $select = '<option value="0">Tidak Ada Group</option>';
        }
        $data['select_group'] = $select;

        $query_tes = $this->cbt_tes_user_model->get_by_group();
        $select = '<option value="semua">Semua Tes</option>';
        if($query_tes->num_rows()>0){
            $query_tes = $query_tes->result();
            foreach ($query_tes as $temp) {
                $select = $select.'<option value="'.$temp->tes_id.'">'.$temp->tes_nama.'</option>';
            }
        }
        $data['select_tes'] = $select;
        
        $this->template->display_admin($this->kelompok.'/tes_absen_view', 'Absensi Peserta', $data);
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

    function export($grup_id=null, $tes_id=null){
        $data['gambar'] =  $this->cbt_konfigurasi_model->get_by_kolom('konfigurasi_id', 5);
        $data['gambar2'] =  $this->cbt_konfigurasi_model->get_by_kolom('konfigurasi_id', 9);
        $query = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_nama', 1);
        $query2 = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_tahun', 7);
        $data['site_name']=$query->row()->konfigurasi_isi;
        $data['thn_sekolah']=$query2->row()->konfigurasi_isi;
        if(!empty($tes_id) AND !empty($grup_id)){
            $this->load->library('excel');
                
                $query = $this->cbt_tes_user_model->get_absendatatable('cbt_tes.tes_id', $tes_id);
            
            $inputFileName = './public/form/form-data-ujian-tes.xls';
            $excel = PHPExcel_IOFactory::load($inputFileName);
            $worksht = $excel->getSheet(0);
            $worksht->setCellValueByColumnAndRow(2, 4, $data['site_name']);
             $worksht->setCellValueByColumnAndRow(2, 5, $data['thn_sekolah']);

            $worksheet = $excel->getSheet(0);

            if($query->num_rows()>0){
                $query = $query->result();
                $row = 11;
                $i=1;
                 
                foreach ($query as $temp) {
                     if($temp->absen == 4){
             $absen = "Hadir";
             $absen2 = "Selesai tes";
            }else{
          $absen = "Tidak hadir";
           $absen2 = "Tidak login";
           }
           $tglb = strtotime($temp->tct);
           $tm = date('h:i',$tglb);
           $d = date('Y-m-d',$tglb);
                if(function_exists ('date_default_timezone_set'))
        date_default_timezone_set('Asia/Jakarta');
$d = date("l");
 
        if ($d=='Monday'){
            $d =' Senin  ';
        }elseif($d=='Tuesday'){
            $d =' Selasa';
        }elseif($d=='Wednesday'){
           $d =' Rabu ';
        }elseif($d=='Thursday'){
           $d =' Kamis ';
        }elseif($d=='Friday'){
           $d =' Jumat ';
        }elseif($d=='Saturday'){
           $d =' Sabtu ';
        }elseif($d=='Sunday'){
           $d =' Minggu ';
        }else{
            echo 'ERROR!';
        }
        
$worksht->setCellValueByColumnAndRow(2, 7, $temp->mn);
$worksht->setCellValueByColumnAndRow(2, 8, $d.''.date('m Y'));
$worksht->setCellValueByColumnAndRow(4, 7, $temp->td.'/'.$temp->tr);
$worksht->setCellValueByColumnAndRow(4, 8, $tm);

                    $worksheet->setCellValueByColumnAndRow(0, $row,  $i++);
                    $worksheet->setCellValueByColumnAndRow(1, $row, $temp->np);
                    $worksheet->setCellValueByColumnAndRow(2, $row, $temp->nl);
                    $worksheet->setCellValueByColumnAndRow(3, $row, $absen);
                    $worksheet->setCellValueByColumnAndRow(4, $row, $absen2);
                

                    $row++;
                    // $worksheet->setCellValueByColumnAndRow(1, ++$row, 'Daftar hadir dibuat rangkap 2');
                      
                }  
        $worksheet->setCellValueByColumnAndRow(1, $row+2, 'Daftar hadir rangkap 2');
        $worksheet->setCellValueByColumnAndRow(1, $row+5, 'Proktor');  
        $worksheet->setCellValueByColumnAndRow(2, $row+8, 'Jumlah Peserta yang Seharusnya :');                
    
      $worksht->setCellValueByColumnAndRow(3,$row+2, 'Pengawas mencatat perseta tidak hadir');
      $worksht->setCellValueByColumnAndRow(3,$row+5, 'Pengawas');

        $objDrawing = new PHPExcel_Worksheet_Drawing;
        // $objDrawing->setPath('assets/img/smkbisa.png');
        $objDrawing->setPath('assets/img/'.$data['gambar']->row()->konfigurasi_isi);
        $objDrawing->setWidth(100)->setHeight(100); //your image path
        $objDrawing->setCoordinates('B1');
        $objDrawing->setWorksheet($worksheet);
 
 $objDrawing2 = new PHPExcel_Worksheet_Drawing;
        // $objDrawing->setPath('assets/img/smkbisa.png');
        $objDrawing2->setPath('assets/img/'.$data['gambar2']->row()->konfigurasi_isi);
        $objDrawing2->setWidth(100)->setHeight(100); //your image path
        $objDrawing2->setCoordinates('E1');
        $objDrawing2->setWorksheet($worksheet);
 
            }
            $filename='Absensi Ujian '.date('Y-m-d H:i').'.xls'; //save our workbook as this file name
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
        $urutkan = $this->input->get('urutkan');
        $waktu = $this->input->get('waktu');
        $keterangan = $this->input->get('keterangan');
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
    
            $query = $this->cbt_tes_user_model->get_absendatatable('cbt_tes.tes_id',$tes_id);
            $iTotal= $this->cbt_tes_user_model->get_count_absendatatable('cbt_tes.tes_id',$tes_id)->row()->hasil;
        
        
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
            $record = array();
           
            $record[] = ++$i;
        
        /*
            $query2 =  $this->cbt_user_model->get_bacara_kolom($temp->tes_id);
            foreach ($query2->result() as $row)
{
           $r[] = array($row->grup_nama);
       
       
}

            $record[] = ($r);

*/
            $record[] = $temp->np;
            $record[] = $temp->nl;
           if($temp->absen == 4){
             $absen = "Hadir";
             $absen2 = "Selesai tes";
            }else{
          $absen = "Tidak hadir";
           $absen2 = "Tidak login";
           }
            $record[] = $absen;
                        
            $record[] = $absen2;
            

            $output['aaData'][] = $record;
        }
        // format it to JSON, this output will be displayed in datatable
       
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