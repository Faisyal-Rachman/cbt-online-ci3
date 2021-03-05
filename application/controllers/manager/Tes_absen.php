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
        $this->load->library('Pdf_report');
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

function export($grup_id=null, $tes_id=null) {
$pdf = new Pdf_report(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
 $queryabs = $this->cbt_tes_user_model->get_absendatatable('cbt_tes.tes_id', $tes_id);
 $totalsiswa = $queryabs->num_rows();
 $querytbl = $this->cbt_tes_user_model->get_absendatatable_tbl('cbt_tes.tes_id', $tes_id);
 //$queryket = $this->cbt_tes_user_model->get_absendatatable_ket('cbt_tes.tes_id', $tes_id);
  $data['gambar'] =  $this->cbt_konfigurasi_model->get_by_kolom('konfigurasi_id', 5);
        $data['gambar2'] =  $this->cbt_konfigurasi_model->get_by_kolom('konfigurasi_id', 9);
          $query = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_nama', 1);
        $query2 = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_tahun', 7);
        $data['site_name']=$query->row()->konfigurasi_isi;
        $data['thn_sekolah']=$query2->row()->konfigurasi_isi;
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Daftar Hadir Peserta Ujian '.$data['site_name']);
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');


 $isi_header="<table align=\"right\">
          <tr>
            <td>tess</td><td>tess</td><td>tess</td>
          </tr>
        </table>";
    $pdf->write($isi_header, true, false, false, false, '');

$PDF_HEADER_LOGO = "logo.png";//any image file. check correct path.
$PDF_HEADER_LOGO_WIDTH = "20";
$PDF_HEADER_TITLE = "This is my Title";
$PDF_HEADER_STRING = "Tel 5555 Fax 987654321\n"
. "E abc@gmail.com\n"
. "www.abc.com";
$img1 = base_url().'assets/img/'.$data['gambar']->row()->konfigurasi_isi;
$img2 = base_url().'assets/img/'.$data['gambar2']->row()->konfigurasi_isi;


  if($queryabs->num_rows()>0){
                $queryabs = $queryabs->result();
                $row = 11;
                $i=1;
                 
                foreach ($queryabs as $temp) {
                  
           $tglb = strtotime($temp->tct);
           $tm = date('h:i:s',$tglb);
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
        
$pdf->setHeaderData($ln='', $lw=0, $ht='', $hs='
<table border="0" align="center">
<tbody>
<tr>
<td style="width: 120px;"><img src="'.$img1.'" width="60px"></td>
<td style="width: 380px;" colspan="2">DAFTAR HADIR PESERTA<br>UJIAN ONLINE BERBASIS KOMPUTER<br>'.$data['site_name'].'<br>'.$data['thn_sekolah'].'</td>
<td style="width: 135px;"><img src="'.$img2.'" width="60px"></td>
</tr>
<tr>
<td style="width: 120px;"></td>
<td style="width: 190px;"></td>
<td style="width: 190px;"></td>
<td style="width: 135px;"></td>
</tr>
<tr>
<td style="width: 120px;" align="right">Mapel :</td>
<td style="width: 190px;" align="left"> '.$temp->mn.'</td>
<td style="width: 190px;" align="right">Sesi :</td>
<td style="width: 135px;" align="left"> '.$temp->td.'/'.$temp->tr.'</td>
</tr>
<tr>
<td style="width: 120px;" align="right">Tanggal :</td>
<td style="width: 190px;" align="left">'.$d.''.date('m Y').'</td>
<td style="width: 190px;" align="right">Waktu :</td>
<td style="width: 135px;" align="left"> '.$tm.'</td>
</tr>
</tbody>
</table>
', $tc=array(0,0,0), $lc=array(0,0,0));
 $row++;

}
}
//$pdf->SetHeaderData($PDF_HEADER_LOGO, $PDF_HEADER_LOGO_WIDTH, $PDF_HEADER_TITLE, $PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica ', 'B', 11);

// add a page
$pdf->AddPage();

$i=0;
            $html='<br><br><br><br>
                    <table cellspacing="1" bgcolor="#666666" border="1" cellpadding="2">
                        <tr bgcolor="#996622">
                            <th width="15%" align="center">No. Peserta</th>
                            <th width="40%" align="center">Nama</th>
                            <th width="23%" align="center">Tanda Tangan</th>
                            <th width="23%" align="center">Keterangan</th>
                        </tr>';
                  foreach ($querytbl as $row) 
                {

   if($row['absen'] == 4){
             $absen = "Hadir";
             $absen2 = "Selesai tes";
            }else{
          $absen = "Tidak hadir";
           $absen2 = "Tidak login";
           }
                    $i++;
                    $html.='<tr bgcolor="#ffffff">
                            <td align="center">'.$row['np'].'</td>
                            <td>'.$row['nl'].'</td>
                            <td align="center">'.$absen.'</td>
                             <td align="center">'.$absen2.'</td>
                        </tr>';
                }
                
            $html.='</table>';
            $html.='<br><br><br><table border="0">
<tbody>
<tr>
<td width="35%" style="font-size:11px;">* Daftar hadir rangkap 2<br>* Pengawas mencatat perseta tidak hadir<br></td>
<td width="20%">&nbsp;</td>
<td width="40%" style="font-size:12px;">Jumlah Peserta yang Seharusnya :&nbsp;'.$totalsiswa.'&nbsp;orang<br>Jumlah Peserta yang Tidak Hadir :&nbsp;&nbsp;&nbsp;&nbsp;orang<br>Jumlah Peserta Hadir :&nbsp;&nbsp;&nbsp;&nbsp;orang</td>
</tr>
<tr>
<td width="35%" style="font-size:11px;"></td>
<td width="20%">&nbsp;</td>
<td width="40%" style="font-size:12px;"></td>
</tr>
<tr>
<td align="center"><b>Proktor</b></td>
<td>&nbsp;</td>
<td align="center"><b>Pengawas</b></td>
</tr>
<tr>
<td align="center"> <br><br><br> <u>'.$row['bacara_operator'].' - NIP : '.$row['bacara_nip_operator'].'</u></td>
<td></td>
<td align="center"> <br><br><br> <u>'.$row['bacara_pengawas'].' - NIP : '.$row['bacara_nip_pengawas'].'</u></td>
</tr>
</tbody>
</table>';
            $pdf->writeHTML($html, true, false, true, false, '');



// ---------------------------------------------------------
ob_end_clean();
//Close and output PDF document
$pdf->Output('example_003.pdf', 'I');
    }
 

   function export2($grup_id=null, $tes_id=null){
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