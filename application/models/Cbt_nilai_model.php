<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cbt_nilai_model extends CI_Model{
	public $table = 'cbt_remidi';
	
	function __construct(){
        parent::__construct();
    }
	
    function save($data){
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    function delete($kolom, $isi){
        $this->db->where($kolom, $isi)
                 ->delete($this->table);
    }
    
    function update($kolom, $isi, $data){
        $this->db->where($kolom, $isi)
                 ->update($this->table, $data);
    }

    function update_menit($tesuser_id, $waktu){
        $sql = 'UPDATE cbt_tes_user SET tesuser_creation_time=TIMESTAMPADD(MINUTE, '.$waktu.', tesuser_creation_time) WHERE tesuser_id="'.$tesuser_id.'"';
        $this->db->query($sql);
    }
    
    function count_by_kolom($kolom, $isi){
        $this->db->select('COUNT(*) AS hasil')
                 ->where($kolom, $isi)
                 ->from($this->table);
        return $this->db->get();
    }
function gettes(){
       $this->db->select('*')
                 ->from('tes');
                
        return $this->db->get();
    }
    /**
     * 
     *
     * @param      string  Cek
     *
     * @return     <type>  Number of by status waktu.
     */
    function count_by_status_waktu($tesuser_id){
        $this->db->select('COUNT(tesuser_id) AS hasil')
                 ->where('(tesuser_id="'.$tesuser_id.'" AND tesuser_status="1" AND TIMESTAMPADD(MINUTE, tes_duration_time, tesuser_creation_time)>NOW())')
                 ->from($this->table)
                 ->join('cbt_tes', 'cbt_tes_user.tesuser_tes_id = cbt_tes.tes_id');
        return $this->db->get();
    }

    /**
     * 
     * @param      string  Cek
     *
     * @return     <type>  Number of by status waktu.
     */
    function count_by_status_waktuuser($tesuser_id, $waktuuser){
        $this->db->select('COUNT(tesuser_id) AS hasil')
                 ->where('(tesuser_id="'.$tesuser_id.'" AND tesuser_status="1" AND TIMESTAMPADD(MINUTE, tes_duration_time, tesuser_creation_time)>"'.$waktuuser.'")')
                 ->from($this->table)
                 ->join('cbt_tes', 'cbt_tes_user.tesuser_tes_id = cbt_tes.tes_id');
        return $this->db->get();
    }

    function get_by_user_status($user_id){
        $this->db->where('tesuser_user_id="'.$user_id.'" AND tesuser_status!=4')
                 ->from($this->table)
                 ->join('cbt_tes', 'cbt_tes_user.tesuser_tes_id = cbt_tes.tes_id');
        return $this->db->get();
    }

    function get_by_user_tes_limit($user_id, $tes_id){
        $this->db->where('tesuser_user_id="'.$user_id.'" AND tesuser_tes_id="'.$tes_id.'" AND tesuser_status=1')
                 ->from($this->table)
                 ->join('cbt_tes', 'cbt_tes_user.tesuser_tes_id = cbt_tes.tes_id')
                 ->limit(1);
        return $this->db->get();
    }

    function count_by_user_tes($user_id, $tes_id){
        $this->db->select('COUNT(*) AS hasil')
                 ->where('tesuser_user_id="'.$user_id.'" AND tesuser_tes_id="'.$tes_id.'"')
                 ->from($this->table);
        return $this->db->get();
    }

    function count_by_user_tes_selesai($user_id, $tes_id){
        $this->db->select('COUNT(*) AS hasil')
                 ->where('tesuser_user_id="'.$user_id.'" AND tesuser_tes_id="'.$tes_id.'" AND tesuser_status=4')
                 ->from($this->table);
        return $this->db->get();
    }
	
    function get_by_user_tes($user_id, $tes_id){
        $this->db->where('tesuser_user_id="'.$user_id.'" AND tesuser_tes_id="'.$tes_id.'"')
                 ->from($this->table)
                 ->limit(1);
        return $this->db->get();
    }

	function get_by_kolom($kolom, $isi){
        $this->db->where($kolom, $isi)
                 ->from($this->table);
        return $this->db->get();
    }

    function get_by_group(){
        $this->db->from($this->table)
                 ->join('cbt_tes', 'cbt_tes_user.tesuser_tes_id = cbt_tes.tes_id')
                 ->order_by('tes_nama', 'ASC')
                 ->group_by('tesuser_tes_id');
        return $this->db->get();
    }
	
	function get_by_kolom_limit($kolom, $isi, $limit){
        $this->db->where($kolom, $isi)
                 ->from($this->table)
				 ->limit($limit);
        return $this->db->get();
    }

    function get_by_tes_group_urut_tanggal($tes_id, $grup_id, $urutkan, $tanggal, $keterangan){
        $sql = 'tesuser_creation_time>="'.$tanggal[0].'" AND tesuser_creation_time<="'.$tanggal[1].'"';
		
        if($tes_id!='semua'){
            $sql = $sql.' AND tes_id="'.$tes_id.'"';
        }
        if($grup_id!='semua'){
            $sql = $sql.' AND user_grup_id="'.$grup_id.'"';
        }
        $order = '';
        if($urutkan=='tertinggi'){
            $order = 'nilai DESC';
        }else if($urutkan=='terendah'){
            $order = 'nilai ASC';
        }else if($urutkan=='nama'){
            $order = 'user_firstname ASC';
        }else if($urutkan=='waktu'){
            $order = 'tesuser_creation_time DESC';
        }else{
            $order = 'tesuser_tes_id ASC';
        }
		
		if(!empty($keterangan)){
			$sql = $sql.' AND user_detail LIKE "%'.$keterangan.'%"';
		}

        $this->db->select('cbt_tes_user.*, cbt_tes.*, cbt_user.*, cbt_user_grup.grup_nama, SUM(`cbt_tes_soal`.`tessoal_nilai`) AS nilai ')
                 ->where('( '.$sql.' )')
                 ->from($this->table)
                 ->join('cbt_user', 'cbt_tes_user.tesuser_user_id = cbt_user.user_id', 'right')
                 ->join('cbt_user_grup', 'cbt_user.user_grup_id = cbt_user_grup.grup_id')
                 ->join('cbt_tes', 'cbt_tes_user.tesuser_tes_id = cbt_tes.tes_id', 'left')
                 ->join('cbt_tes_soal', 'cbt_tes_soal.tessoal_tesuser_id = cbt_tes_user.tesuser_id', 'left')
                 ->group_by('cbt_tes_user.tesuser_id')
                 ->order_by($order);
        return $this->db->get();
    }

    function get_nilai_by_tes_user($tes_id, $user_id){
        $this->db->select('SUM(`cbt_tes_soal`.`tessoal_nilai`) AS nilai')
                 ->where('(tesuser_tes_id="'.$tes_id.'" AND tesuser_user_id="'.$user_id.'")')
                 ->from($this->table)
                 ->join('cbt_tes_soal', 'cbt_tes_soal.tessoal_tesuser_id = cbt_tes_user.tesuser_id');
        return $this->db->get();
    }
	
	/**
	* datatable untuk hasil tes yang sudah mengerjakan
	*
	*/
    function get_datatable($start, $rows, $tes_id, $grup_id,$user_id){
       $sql = '';
      if($tes_id!='semua'){
            $sql = $sql.' AND cbt_modul.modul_id="'.$tes_id.'"';
        }
       
            $sql = $sql.' AND user_birthdate="'.$user_id.'"';
        
 		$this->db->select('user_birthdate,grup_nama,modul_nama,nilai,tesuser_id,user_firstname,user_birthdate,cbt_tes.tes_id,cbt_tes.tes_nama,cbt_tes.tes_jenis')
                 ->where('(user_grup_id ="'.$grup_id.'" '.$sql.' )')
                 ->join('cbt_remidi', 'cbt_remidi.tes_id = cbt_tes.tes_id')
                 ->join('cbt_tes_topik_set', 'cbt_tes_topik_set.tset_tes_id = cbt_tes.tes_id')
                 ->join('cbt_modul', 'cbt_modul.modul_id = cbt_tes_topik_set.tset_modul')
                 ->from('cbt_tes')
                // ->order_by($order)
                 ->limit($rows, $start);
        return $this->db->get();
	}
     function get_nama_siswa($start, $rows, $tes_id, $grup_id){
       $sql = '';
      if($tes_id!='semua'){
            $sql = $sql.' AND cbt_modul.modul_id="'.$tes_id.'"';
        }
       
          $this->db->select('*')
                 ->where('(user_grup_id ="'.$grup_id.'" '.$sql.' )')
                 ->join('cbt_remidi', 'cbt_remidi.tes_id = cbt_tes.tes_id')
                 ->join('cbt_tes_topik_set', 'cbt_tes_topik_set.tset_tes_id = cbt_tes.tes_id')
                 ->join('cbt_modul', 'cbt_modul.modul_id = cbt_tes_topik_set.tset_modul')
                 ->from('cbt_tes')
                 ->group_by('user_birthdate');
        return $this->db->get();
    }
     function get_nama_rangking($grup_id){
       $sql = 'user_jurusan="'.$grup_id.'"';
                  $this->db->select('*')
                 ->where($sql)
                 ->join('cbt_remidi', 'cbt_remidi.tes_id = cbt_tes.tes_id')
                 ->join('cbt_tes_topik_set', 'cbt_tes_topik_set.tset_tes_id = cbt_tes.tes_id')
                 ->join('cbt_modul', 'cbt_modul.modul_id = cbt_tes_topik_set.tset_modul')
                 ->from('cbt_tes');
               //  ->group_by('user_birthdate');
        return $this->db->get();
    }
     function get_datatable_countrang($grup_id){
        $sql = 'user_jurusan="'.$grup_id.'"';
        
 $this->db->select('COUNT(*) AS hasil')
                  ->where($sql)
                 ->join('cbt_remidi', 'cbt_remidi.tes_id = cbt_tes.tes_id')
                 ->join('cbt_tes_topik_set', 'cbt_tes_topik_set.tset_tes_id = cbt_tes.tes_id')
                 ->join('cbt_modul', 'cbt_modul.modul_id = cbt_tes_topik_set.tset_modul')
                 ->from('cbt_tes');
                   return $this->db->get();
    }
     function get_datatable_count($tes_id, $grup_id){
         $sql = '';
        
       
        if($tes_id!='semua'){
            $sql = $sql.' AND cbt_modul.modul_id="'.$tes_id.'"';
        }
       
        
    
        $this->db->select('COUNT(*) AS hasil')
                  ->where('(user_grup_id ="'.$grup_id.'" '.$sql.' )')
                 ->join('cbt_remidi', 'cbt_remidi.tes_id = cbt_tes.tes_id')
                 ->join('cbt_tes_topik_set', 'cbt_tes_topik_set.tset_tes_id = cbt_tes.tes_id')
                 ->join('cbt_modul', 'cbt_modul.modul_id = cbt_tes_topik_set.tset_modul')
                 ->from('cbt_tes');
                   return $this->db->get();
    }
     function get_ratarangking($grup_id,$user_id){
         $sql = 'user_jurusan="'.$grup_id.'"';
     $sql = $sql.' AND user_birthdate="'.$user_id.'"';
  
        $this->db->select('AVG(nilai) AS rata')
                 ->where($sql)
                 ->join('cbt_remidi', 'cbt_remidi.tes_id = cbt_tes.tes_id')
                 ->join('cbt_tes_topik_set', 'cbt_tes_topik_set.tset_tes_id = cbt_tes.tes_id')
                 ->join('cbt_modul', 'cbt_modul.modul_id = cbt_tes_topik_set.tset_modul')
                 ->from('cbt_tes');
          
                   return $this->db->get();
    }

    function get_rata($start, $rows, $tes_id, $grup_id,$user_id){
         $sql = '';
      if($tes_id!='semua'){
            $sql = $sql.' AND cbt_modul.modul_id="'.$tes_id.'"';
        }
	$sql = $sql.' AND user_birthdate="'.$user_id.'"';
		$this->db->select('AVG(nilai) AS rata')
                 ->where('(user_grup_id ="'.$grup_id.'" '.$sql.' )')
                 ->join('cbt_remidi', 'cbt_remidi.tes_id = cbt_tes.tes_id')
                 ->join('cbt_tes_topik_set', 'cbt_tes_topik_set.tset_tes_id = cbt_tes.tes_id')
                 ->join('cbt_modul', 'cbt_modul.modul_id = cbt_tes_topik_set.tset_modul')
                 ->from('cbt_tes')
                //->order_by($order)
                 ->limit($rows, $start);
                   return $this->db->get();
    }

    /**
     *
     *
     * @param      <type>  $start   The start
     * @param      <type>  $rows    The rows
     * @param      string  $tes_id  The tes identifier
     * @param      string  $order   The order
     *
     * @return     <type>  The datatable evaluasi.
     */
    function get_datatable_evaluasi($start, $rows, $tes_id){
        $sql = '';
        if(!empty($tes_id)){
            $sql = ' AND tesuser_tes_id="'.$tes_id.'"';
        }
        $order = '';
        if($urutkan=='soal'){
            $order = 'tessoal_soal_id ASC';
        }else{
            $order = 'tesuser_id ASC';
        }

        $this->db->select('cbt_tes_soal.tessoal_id, cbt_tes_soal.tessoal_jawaban_text, cbt_tes.*, cbt_soal.*')
                 ->where('(soal_tipe="2" AND tessoal_jawaban_text IS NOT NULL AND tessoal_comment IS NULL '.$sql.' )')
                 ->from($this->table)
                 ->join('cbt_tes', 'cbt_tes_user.tesuser_tes_id = cbt_tes.tes_id')
                 ->join('cbt_tes_soal', 'cbt_tes_soal.tessoal_tesuser_id = cbt_tes_user.tesuser_id')
                 ->join('cbt_soal', 'cbt_tes_soal.tessoal_soal_id = cbt_soal.soal_id')
                 ->order_by($order)
                 ->limit($rows, $start);
        return $this->db->get();
    }
    
    function get_datatable_evaluasi_count($tes_id, $order){
        $sql = '';
        if(!empty($tes_id)){
            $sql = ' AND tesuser_tes_id="'.$tes_id.'"';
        }

        $this->db->select('COUNT(*) AS hasil')
                 ->where('(soal_tipe="2" AND tessoal_jawaban_text IS NOT NULL AND tessoal_comment IS NULL '.$sql.' )')
                 ->join('cbt_tes_soal', 'cbt_tes_soal.tessoal_tesuser_id = cbt_tes_user.tesuser_id')
                 ->join('cbt_soal', 'cbt_tes_soal.tessoal_soal_id = cbt_soal.soal_id')
                 ->from($this->table);
        return $this->db->get();
    }

    /**
     * Datatable untuk hasil tes operator
     *
     * @param      <type>  $start  The start
     * @param      <type>  $rows   The rows
     * @param      <type>  $token  The token
     *
     * @return     <type>  The datatable.
     */
    function get_datatable_operator($start, $rows, $token){
        $this->db->select('cbt_tes_user.*,cbt_user_grup.grup_nama, cbt_tes.*, cbt_user.*, SUM(`cbt_tes_soal`.`tessoal_nilai`) AS nilai ')
                 ->where('(tesuser_token IN ('.$token.'))')
                 ->from($this->table)
                 ->join('cbt_user', 'cbt_tes_user.tesuser_user_id = cbt_user.user_id')
                 ->join('cbt_user_grup', 'cbt_user.user_grup_id = cbt_user_grup.grup_id')
                 ->join('cbt_tes', 'cbt_tes_user.tesuser_tes_id = cbt_tes.tes_id')
                 ->join('cbt_tes_soal', 'cbt_tes_soal.tessoal_tesuser_id = cbt_tes_user.tesuser_id')
                 ->group_by('cbt_tes_user.tesuser_id')
                 ->order_by('tesuser_creation_time DESC')
                 ->limit($rows, $start);
        return $this->db->get();
    }
    
    function get_datatable_operator_count($token){
        $this->db->select('COUNT(*) AS hasil')
                 ->where('(tesuser_token IN ('.$token.'))')
                 ->from($this->table);
        return $this->db->get();
    }
}