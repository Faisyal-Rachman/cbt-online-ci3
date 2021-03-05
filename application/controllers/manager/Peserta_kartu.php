<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Peserta_kartu extends Member_Controller {
	private $kode_menu = 'peserta-kartu';
	private $kelompok = 'peserta';
	private $url = 'manager/peserta_kartu';
	
    function __construct(){
		parent:: __construct();
		$this->load->model('cbt_user_grup_model');
		$this->load->model('cbt_user_model');
		$this->load->model('cbt_konfigurasi_model');

        parent::cek_akses($this->kode_menu);
	}
	
    public function index(){
		$data['kode_menu'] = $this->kode_menu;
        $data['url'] = $this->url;
		
		$query_group = $this->cbt_user_grup_model->get_group();

        if($query_group->num_rows()>0){
        	$select = '';
        	$query_group = $query_group->result();
        	foreach ($query_group as $temp) {
        		$select = $select.'<option value="'.$temp->grup_id.'">'.$temp->grup_nama.'</option>';
        	}

        }else{
        	$select = '<option value="0">KOSONG</option>';
        }
        $data['select_group'] = $select;
		
        $this->template->display_admin($this->kelompok.'/peserta_kartu_view', 'Cetak Kartu Peserta', $data);
    }


    public function cetak_kartu($grup_id=null){
		$data['kode_menu'] = $this->kode_menu;
		 $data['gambar'] =  $this->cbt_konfigurasi_model->get_by_kolom('konfigurasi_id', 5);
        $data['gambar2'] =  $this->cbt_konfigurasi_model->get_by_kolom('konfigurasi_id', 9);
         $data['gambar3'] =  $this->cbt_konfigurasi_model->get_by_kolom('konfigurasi_id', 12);
         $data['kepalasekolah'] =  $this->cbt_konfigurasi_model->get_by_kolom('konfigurasi_id', 10);
       $data['linklogin'] =  $this->cbt_konfigurasi_model->get_by_kolom('konfigurasi_id', 8);
         $loginujian = $data['linklogin']->row()->konfigurasi_isi;
        $kepsekolah = $data['kepalasekolah']->row()->konfigurasi_isi;
          $query = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_nama', 1);
        $query2 = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_tahun', 7);
        $data['site_name']=$query->row()->konfigurasi_isi;
        $data['thn_sekolah']=$query2->row()->konfigurasi_isi;
		$kartu = '<h3>Data Peserta Kosong</h3>';
		if(!empty($grup_id)){
			$query_user = $this->cbt_user_model->get_by_kolomkartu('user_grup_id', $grup_id);
			if($query_user->num_rows()>0){
				$kartu = '';
				$query_user = $query_user->result();
				
				$query_konfig = $this->cbt_konfigurasi_model->get_by_kolom_limit('konfigurasi_kode', 'cbt_nama', 1);
				$cbt_nama = 'Computer Based-ddTest';
				if($query_konfig->num_rows()>0){
					$cbt_nama = $query_konfig->row()->konfigurasi_isi;
				}
				
				$query_group = $this->cbt_user_grup_model->get_by_kolom_limit('grup_id', $grup_id, 1);
				$group = 'NULL';
				if($query_group->num_rows()>0){
					$group = $query_group->row()->grup_nama;
				}
				
			
				$img1 = base_url().'assets/img/'.$data['gambar']->row()->konfigurasi_isi;
$img2 = base_url().'assets/img/'.$data['gambar2']->row()->konfigurasi_isi;
$img3 = base_url().'assets/img/'.$data['gambar3']->row()->konfigurasi_isi;
				foreach($query_user AS $temp){
					$kp = base_url().'assets/img/kartupeserta.png';
					$kartu = $kartu.'
					<div class="kartu">

<table style="width: 300px;" class="responsive">
<tbody>
<tr>
<td style="width: 119px;" rowspan="2"><center><img src="'.$img1.'" width="45px" /></center></td>
<td style="width: 290px;" colspan="3"><center>
<div style="font-size: 11px; font-weight: bold;">'.$temp->tes_jenis.' <br /> '.$data['thn_sekolah'].'</div>
</center></td>
<td style="width: 165px;" rowspan="2"><center><img src="'.$img2.'" width="45px" /></center></td>
</tr>

<tr>
<td style="width: 290px;" colspan="3"><center>
<div style="font-size: 11px; font-weight: bold;">'.$cbt_nama.'</div>
</center></td>

</tr>
<tr>
<td style="width: 668px;" colspan="5"><hr></td>
</tr>
<tr>
<td style="width: 668px;" colspan="5"><center><font style="font-size:11px;font-family:courier"> '.$loginujian.'</font></center></td>
</tr>
<tr>
<td style="width: 668px;" colspan="5"><center><strong>'.$temp->user_birthdate.'</strong></center></td>
</tr>
<tr>
<td style="width: 119px;">No.Peserta</td>
<td style="width: 10px;">:</td>
<td style="width: 353px;">'.$temp->user_firstname.'</td>
<td style="width: 21px;">&nbsp;</td>
<td style="width: 165px;">&nbsp;</td>
</tr>
<tr>
<td style="width: 119px;">Username</td>
<td style="width: 10px;">:</td>
<td style="width: 353px;">'.$temp->user_name.'</td>
<td style="width: 21px;">&nbsp;</td>
<td style="width: 165px;">&nbsp;</td>
</tr>
<tr>
<td style="width: 119px;">Password</td>
<td style="width: 10px;">:</td>
<td style="width: 353px;">'.$temp->user_password.'</td>
<td style="width: 21px;">&nbsp;</td>
<td style="width: 165px;">&nbsp;</td>
</tr>
<tr>
<td style="width: 119px;">Kelas</td>
<td style="width: 10px;">:</td>
<td style="width: 353px;">'.$group.'</td>
<td style="width: 21px;">&nbsp;</td>
<td style="width: 165px;">&nbsp;</td>
</tr>
<tr>
<td style="width: 119px;">Ruang</td>
<td style="width: 10px;">:</td>
<td style="width: 353px;">'.$temp->user_detail.'</td>
<td style="width: 21px;">&nbsp;</td>
<td style="width: 165px;">&nbsp;</td>
</tr>
<tr>
<td style="width: 119px;">&nbsp;</td>
<td style="width: 10px;">&nbsp;</td>
<td style="width: 353px;">&nbsp;</td>
<td style="width: 21px;">&nbsp;</td>
<td style="width: 165px;">&nbsp;</td>
</tr>
<tr>
<td style="width: 119px;">&nbsp;</td>
<td style="width: 10px;">&nbsp;</td>
<td style="width: 539px; text-align: center;" colspan="3"><b>Kepala Sekolah</b></td>
</tr>
<tr>
<td style="width: 119px;">&nbsp;</td>
<td style="width: 10px;">&nbsp;</td>
<td style="width: 539px;" colspan="3" rowspan="2"><center><img src="'.$img3.'" width="40px" /></center></td>
</tr>
<tr>
<td style="width: 119px;">&nbsp;</td>
<td style="width: 10px;">&nbsp;</td>
</tr>
<tr>
<td style="width: 119px;">&nbsp;</td>
<td style="width: 10px;">&nbsp;</td>
<td style="width: 539px;" colspan="3"><center><font style="font-size:11px;font-family:courier">'.$kepsekolah.' <br> NIP:123123123192312</font></center></td>
</tr>
</tbody>
</table>
</div>';
				}
			}
		}
		
		$data['kartu'] = $kartu;
		
		$this->load->view($this->kelompok.'/peserta_cetak_kartu_view', $data);
	}
}