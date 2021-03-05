<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cbt_tes_user_model extends CI_Model{
	public $table = 'cbt_tes_user';
	
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
    function updateuser2($user_id){
        $data = array(
            'tesuser_creation_time' => date("Y-m-d H:i:s", STRTOTIME(date('h:i:sa'))),
            'tesuser_user_id' => $user_id);

 $this->db->where('tesuser_user_id', $user_id);
 $this->db->update('cbt_tes_user', $data); 
       
    }
    function tampilstatusbyid($id){
     
       $this->db->select('*,COUNT(cbt_tes_soal.tessoal_id) as hasil, COUNT(cbt_tes_soal.tessoal_display_time) as jawab')
       ->join('cbt_tes_user', 'cbt_tes_user.tesuser_id = cbt_tes_soal.tessoal_tesuser_id')
       ->join('cbt_user','cbt_user.user_id = cbt_tes_user.tesuser_user_id')
       ->where('cbt_tes_user.tesuser_tes_id',$id)
      // ->where('cbt_tes_soal.tessoal_id', 389)
      ->group_by('cbt_tes_soal.tessoal_tesuser_id');
        $hasil = $this->db->get('cbt_tes_soal');
        return $hasil;
    }
    function tampilstatus(){
     
       $this->db->select('*,COUNT(cbt_tes_soal.tessoal_id) as hasil, COUNT(cbt_tes_soal.tessoal_display_time) as jawab')
       ->join('cbt_tes_user', 'cbt_tes_user.tesuser_id = cbt_tes_soal.tessoal_tesuser_id')
       ->join('cbt_user','cbt_user.user_id = cbt_tes_user.tesuser_user_id')
       ->where('DATE(cbt_tes_user.tesuser_creation_time) = DATE(CURRENT_DATE())')
      // ->where('cbt_tes_soal.tessoal_id', 389)
      ->group_by('cbt_tes_soal.tessoal_tesuser_id');
        $hasil = $this->db->get('cbt_tes_soal');
        return $hasil;
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
    function get_by_kolom_aktif($kolom, $isi, $nilai){
     $nilai = 17777;
        $this->db->select('*')
      
         ->where('(topik_aktif="1" AND '.$kolom.'='.$isi.')')
                   ->from($this->table);
        return $this->db->get();
    }
    public function getTdkHadir($kolom, $isi, $nilai)
    {
    $nilai = 17777;
     $this->db->select('cbt_tes.tes_nama,cbt_tes.tes_detail,cbt_tes.tes_ruang,cbt_user.user_id as uid,cbt_user.user_birthdate as nl,cbt_user.user_firstname as np,cbt_remidi.tes_jenis,
cbt_remidi.tesuser_status,cbt_remidi.modul_id
')
      ->where('('.$kolom.'='.$isi.' AND cbt_remidi.tes_jenis IS NULL)')
   // ->join('cbt_remidi', 'cbt_remidi.user_id = cbt_user.user_id')
     ->from('cbt_user')
     //->join('cbt_tes_user', 'cbt_tes_user.tesuser_user_id = cbt_user.user_id','left')
     ->join('cbt_remidi', 'cbt_remidi.user_id = cbt_user.user_id','left')
    ->join('cbt_tesgrup', 'cbt_user.user_grup_id = cbt_tesgrup.tstgrp_grup_id','left')
    ->join('cbt_tes_topik_set', 'cbt_tes_topik_set.tset_tes_id = cbt_tesgrup.tstgrp_tes_id','left')
    ->join('cbt_modul', 'cbt_modul.modul_id = cbt_tes_topik_set.tset_modul','left')
    ->join('cbt_tes', 'cbt_tes.tes_id = cbt_tes_topik_set.tset_tes_id','left');
   
    return $this->db->get();
    }

 public function getTdkHadir2($kolom, $isi, $nilai)
    {
        $nilai = 17777;
     $this->db->select('cbt_tes.tes_id,cbt_tes.tes_nama,cbt_tes.tes_detail,cbt_tes.tes_ruang, cbt_user.*,cbt_remidi.tes_jenis,
cbt_remidi.tesuser_status,cbt_remidi.modul_id')

     ->where('('.$kolom.'='.$isi.' AND cbt_remidi.tes_jenis IS NULL)')
   ->from('cbt_user')
    ->join('cbt_remidi', 'cbt_remidi.user_id = cbt_user.user_id')
    ->join('cbt_tesgrup', 'cbt_user.user_grup_id = cbt_tesgrup.tstgrp_grup_id')
    ->join('cbt_tes_topik_set', 'cbt_tes_topik_set.tset_tes_id = cbt_tesgrup.tstgrp_tes_id')
    ->join('cbt_modul', 'cbt_modul.modul_id = cbt_tes_topik_set.tset_modul')
    ->join('cbt_tes', 'cbt_tes.tes_id = cbt_tes_topik_set.tset_tes_id');
  return $this->db->get();
// $query = $this->db->get('cbt_user')->result();
    }
    /**
     * menghitung testuser yang masih aktif dengan status==1 dan waktu masih belum habis
     *
     * @param      string  $tesuser_id  The tesuser identifier
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
     * menghitung testuser yang masih aktif dengan status==1 dan waktu masih belum habis
     * berdasarkan waktu yang php, bukan waktu mysql
     * revisi 2018-11-15
     * @param      string  $tesuser_id  The tesuser identifier
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
 function get_by_user_status_cek($user_id){
        $this->db->where('tesuser_user_id="'.$user_id.'" AND tesuser_status=4')
                 ->from($this->table)
                 ->join('cbt_tes', 'cbt_tes_user.tesuser_tes_id = cbt_tes.tes_id');
        return $this->db->get()->result();
    }
    function get_by_user_id_cek($user_id){
        $this->db->where('tesuser_user_id="'.$user_id.'" AND tesuser_status=4')
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
    function get_by_user_tes_pg($tes_id){
        $this->db->where('tes_id="'.$tes_id.'"')
                 ->from('cbt_tes')
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
    function get_userujian(){
        $this->db->from($this->table)
                 ->join('cbt_tes', 'cbt_tes_user.tesuser_tes_id = cbt_tes.tes_id')
                 ->join('cbt_user', 'cbt_user.user_id = cbt_tes_user.tesuser_user_id')
                 ->order_by('tes_nama', 'ASC')
                 ->group_by('tesuser_tes_id');
        return $this->db->get();
    }
	function get_by_kelas(){
        $this->db->from('cbt_modul');
                // ->join('cbt_tes', 'cbt_tes_user.tesuser_tes_id = cbt_tes.tes_id')
                // ->order_by('tes_nama', 'ASC')
              //  ->group_by('tesuser_tes_id');
        return $this->db->get();
    }
      function get_by_jurusan(){
        $this->db->from('cbt_jurusan');
                // ->join('cbt_tes', 'cbt_tes_user.tesuser_tes_id = cbt_tes.tes_id')
                // ->order_by('tes_nama', 'ASC')
              //  ->group_by('tesuser_tes_id');
        return $this->db->get();
    }
	function get_by_kolom_limit($kolom, $isi, $limit){
        $this->db->where($kolom, $isi)
                 ->from($this->table)
				 ->limit($limit);
        return $this->db->get();
    }
    function get_by_tes_group_urut_tanggal_nilai($tes_id, $grup_id, $urutkan){
      //  $sql = 'tesuser_creation_time>="'.$tanggal[0].'" AND tesuser_creation_time<="'.$tanggal[1].'"';
		
      
        //$sql = $sql.' AND nilai<=tset_pg';
        $this->db->select('*')
             //->where('('.$sql.' )')
             ->from('cbt_remidi');
           
    return $this->db->get();
    }
    function get_by_tes_group_urut_tanggal_absen($tes_id, $grup_id, $urutkan, $tanggal){
        $sql = 'tesuser_creation_time>="'.$tanggal[0].'" AND tesuser_creation_time<="'.$tanggal[1].'"';
          
        
          //$sql = $sql.' AND nilai<=tset_pg';
          $this->db->select('*')
               //->where('('.$sql.' )')
               ->from('cbt_remidi');
             
      return $this->db->get();
      }
    function get_by_tes_group_urut_tanggal($tes_id, $grup_id, $urutkan, $tanggal){
        $sql = 'tesuser_creation_time>="'.$tanggal[0].'" AND tesuser_creation_time<="'.$tanggal[1].'"';
		
      
        $sql = $sql.' AND nilai<=cbt_remidi.tes_pg';
        $this->db->select('*')
             ->where('('.$sql.' )')
             ->from('cbt_remidi')
             ->join('cbt_tes', 'cbt_tes.tes_id = cbt_remidi.tes_id');
           
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
    function get_datatableinfo(){
       

		$this->db->select('cbt_tes_user.*, cbt_tes.*, cbt_user.*')
                 ->where('cbt_tes_user.tesuser_creation_time > DATE_SUB(CURDATE(), INTERVAL 5 SECOND)')
                 ->from($this->table)
                 ->join('cbt_user', 'cbt_tes_user.tesuser_user_id = cbt_user.user_id')
               
                 ->join('cbt_tes', 'cbt_tes_user.tesuser_tes_id = cbt_tes.tes_id');
                
				 
        return $this->db->get();
	}
	function get_datatable($start, $rows, $tes_id, $grup_id, $urutkan, $tanggal){
        $sql = 'tesuser_creation_time>="'.$tanggal[0].'" AND tesuser_creation_time<="'.$tanggal[1].'"';
		
       
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
		
	

		$this->db->select('cbt_tes_user.*,cbt_user_grup.grup_nama, cbt_tes.*, cbt_user.*, SUM(`cbt_tes_soal`.`tessoal_nilai`) AS nilai ')
                 ->where('( '.$sql.' )')
                 ->from($this->table)
                 ->join('cbt_user', 'cbt_tes_user.tesuser_user_id = cbt_user.user_id')
                 ->join('cbt_user_grup', 'cbt_user.user_grup_id = cbt_user_grup.grup_id')
                 ->join('cbt_tes', 'cbt_tes_user.tesuser_tes_id = cbt_tes.tes_id')
                 ->join('cbt_tes_soal', 'cbt_tes_soal.tessoal_tesuser_id = cbt_tes_user.tesuser_id')
                 ->group_by('cbt_tes_user.tesuser_id')
				 ->order_by($order)
                 ->limit($rows, $start);
        return $this->db->get();
	}
    
    function get_datatable_count($tes_id, $grup_id, $urutkan, $tanggal){
        $sql = 'tesuser_creation_time>="'.$tanggal[0].'" AND tesuser_creation_time<="'.$tanggal[1].'"';
		
        if($tes_id!='semua'){
            $sql = $sql.' AND tesuser_tes_id="'.$tes_id.'"';
        }
        if($grup_id!='semua'){
            $sql = $sql.' AND user_grup_id="'.$grup_id.'"';
        }
		
	
		$this->db->select('COUNT(*) AS hasil')
                 ->where('( '.$sql.' )')
                 ->join('cbt_user', 'cbt_tes_user.tesuser_user_id = cbt_user.user_id', 'right')
                 ->from($this->table);
        return $this->db->get();
    }
    function get_absendatatable2($start, $rows, $tes_id, $grup_id, $urutkan, $tanggal){
        $sql = 'tes_begin_time>="'.$tanggal[0].'" AND tes_begin_time<="'.$tanggal[1].'"';
        
        $order = '';
        if($urutkan=='tertinggi'){
            $order = 'nilai DESC';
        
        }else{
            $order = 'tes_id ASC';
        }
        $this->db->select('cbt_user.user_firstname,user_birthdate,cbt_tes.tes_detail,cbt_tes.tes_ruang, cbt_modul.modul_nama, 
cbt_tes.tes_begin_time, cbt_user.user_name,cbt_absengrup.absen_user_id, cbt_tes.tes_nama, 
cbt_absengrup.absen_bacara_id, IFNULL(absen_bacara_id, "Hadir")as tandatangan')
                 ->where('( '.$sql.' )')
                 ->from('cbt_user')
                 ->join('cbt_absengrup', 'cbt_absengrup.absen_user_id = cbt_user.user_id','left')
                 ->join('cbt_bacara', 'cbt_bacara.bacara_id = cbt_absengrup.absen_bacara_id','left')
                 ->join('cbt_tes', ' cbt_tes.tes_id = cbt_bacara.bacaraujian_id','right')
                 ->join('cbt_tes_topik_set', 'cbt_tes_topik_set.tset_tes_id = cbt_tes.tes_id','left')
                 ->join('cbt_modul', 'cbt_modul.modul_id = cbt_tes_topik_set.tset_modul','right')
               //  ->join('cbt_remidi', 'cbt_remidi.user_id = cbt_user.user_id','left')
                
                 ->limit($rows, $start);
        return $this->db->get();
    }
     function get_count_absendatatable2($tes_id, $grup_id, $urutkan, $tanggal){
         $sql = 'tes_begin_time>="'.$tanggal[0].'" AND tes_begin_time<="'.$tanggal[1].'"';
        
        if($tes_id!='semua'){
            $sql = $sql.' AND tes_id="'.$tes_id.'"';
        }
        if($grup_id!='semua'){
            $sql = $sql.' AND user_grup_id="'.$grup_id.'"';
        }
    
            $this->db->select('COUNT(*) AS hasil')
                ->where('( '.$sql.' )')
                ->join('cbt_absengrup', 'cbt_absengrup.absen_user_id = cbt_user.user_id','left')
                 ->join('cbt_bacara', 'cbt_bacara.bacara_id = cbt_absengrup.absen_bacara_id','left')
                 ->join('cbt_tes', ' cbt_tes.tes_id = cbt_bacara.bacaraujian_id','right')
                 ->join('cbt_tes_topik_set', 'cbt_tes_topik_set.tset_tes_id = cbt_tes.tes_id','left')
                 ->join('cbt_modul', 'cbt_modul.modul_id = cbt_tes_topik_set.tset_modul','right')
                // ->join('cbt_remidi', 'cbt_remidi.user_id = cbt_user.user_id','left')
                  ->from('cbt_user');
        return $this->db->get();
    }
    function get_absendatatable($grup_id,$tes_id){
        $nilai = 17777;
     $this->db->select('cbt_tes.tes_begin_time as tct,cbt_tes.tes_detail as td,cbt_tes.tes_ruang as tr, cbt_tes.tes_nama as tn,cbt_tes.tes_detail,cbt_tes.tes_ruang,modul_nama as mn,cbt_user.user_id as uid,cbt_user.user_birthdate as nl,cbt_user.user_firstname as np,cbt_remidi.tes_jenis,
cbt_remidi.tesuser_status,cbt_remidi.modul_id,IFNULL(tesuser_status,"Tidak hadir") AS absen,IFNULL(cbt_tes.tes_jenis,"Tidak login") AS stat
')
      ->where($grup_id,$tes_id)
   // ->join('cbt_remidi', 'cbt_remidi.user_id = cbt_user.user_id')
     ->from('cbt_user')
     //->join('cbt_tes_user', 'cbt_tes_user.tesuser_user_id = cbt_user.user_id','left')
     ->join('cbt_remidi', 'cbt_remidi.user_id = cbt_user.user_id','left')
    ->join('cbt_tesgrup', 'cbt_user.user_grup_id = cbt_tesgrup.tstgrp_grup_id','left')
    ->join('cbt_tes_topik_set', 'cbt_tes_topik_set.tset_tes_id = cbt_tesgrup.tstgrp_tes_id','left')
    ->join('cbt_modul', 'cbt_modul.modul_id = cbt_tes_topik_set.tset_modul','left')
    ->join('cbt_tes', 'cbt_tes.tes_id = cbt_tes_topik_set.tset_tes_id','left');
   
    return $this->db->get();
    }
     function get_absendatatable_tbl($grup_id,$tes_id){
        $nilai = 17777;
     $this->db->select('cbt_tes.tes_begin_time as tct,cbt_tes.tes_detail as td,cbt_tes.tes_ruang as tr, cbt_tes.tes_nama as tn,cbt_tes.tes_detail,cbt_tes.tes_ruang,modul_nama as mn,cbt_user.user_id as uid,cbt_user.user_birthdate as nl,cbt_user.user_firstname as np,cbt_remidi.tes_jenis,cbt_bacara.*,
cbt_remidi.tesuser_status,cbt_remidi.modul_id,IFNULL(tesuser_status,"Tidak hadir") AS absen,IFNULL(cbt_tes.tes_jenis,"Tidak login") AS stat
');
      $this->db->where($grup_id,$tes_id);
   // ->join('cbt_remidi', 'cbt_remidi.user_id = cbt_user.user_id')
    // ->from('cbt_user')
     //->join('cbt_tes_user', 'cbt_tes_user.tesuser_user_id = cbt_user.user_id','left')
     $this->db->join('cbt_remidi', 'cbt_remidi.user_id = cbt_user.user_id','left');
    $this->db->join('cbt_tesgrup', 'cbt_user.user_grup_id = cbt_tesgrup.tstgrp_grup_id','left');
    $this->db->join('cbt_tes_topik_set', 'cbt_tes_topik_set.tset_tes_id = cbt_tesgrup.tstgrp_tes_id','left');
    $this->db->join('cbt_modul', 'cbt_modul.modul_id = cbt_tes_topik_set.tset_modul','left');
    $this->db->join('cbt_tes', 'cbt_tes.tes_id = cbt_tes_topik_set.tset_tes_id','left');
    $this->db->join('cbt_bacara', 'cbt_bacara.bacaraujian_id = cbt_tes.tes_id','left');
      $query = $this->db->get('cbt_user');
        return $query->result_array();
    }
     function get_count_absendatatable($grup_id,$tes_id){
         $nilai = 17777;
     $this->db->select('COUNT(*) as hasil')
       ->where($grup_id,$tes_id)
   // ->join('cbt_remidi', 'cbt_remidi.user_id = cbt_user.user_id')
     ->from('cbt_user')
     //->join('cbt_tes_user', 'cbt_tes_user.tesuser_user_id = cbt_user.user_id','left')
     ->join('cbt_remidi', 'cbt_remidi.user_id = cbt_user.user_id','left')
    ->join('cbt_tesgrup', 'cbt_user.user_grup_id = cbt_tesgrup.tstgrp_grup_id','left')
    ->join('cbt_tes_topik_set', 'cbt_tes_topik_set.tset_tes_id = cbt_tesgrup.tstgrp_tes_id','left')
    ->join('cbt_modul', 'cbt_modul.modul_id = cbt_tes_topik_set.tset_modul','left')
    ->join('cbt_tes', 'cbt_tes.tes_id = cbt_tes_topik_set.tset_tes_id','left');
   
    return $this->db->get();
    }
    
    function get_datatable_remidi($start, $rows, $tes_id, $grup_id, $urutkan, $tanggal, $keterangan){
        
        $sql = 'tesuser_creation_time>="'.$tanggal[0].'" AND tesuser_creation_time<="'.$tanggal[1].'"';
        $sql = $sql.' AND nilai < tes_pg';
			$this->db->select('*')
                 ->where('('.$sql.' )')
                 ->from('cbt_remidi')
                
               
               
				 //->order_by($order)
                 ->limit($rows, $start);
        return $this->db->get();
    }

    function get_datatable_count_remidi($tes_id, $grup_id, $urutkan, $tanggal, $keterangan){
        $sql = 'tesuser_creation_time>="'.$tanggal[0].'" AND tesuser_creation_time<="'.$tanggal[1].'"';
        $sql = $sql.' AND nilai < tes_pg';
		$this->db->select('COUNT(*) AS hasil')
                 ->where('( '.$sql.' )')
                // ->join('cbt_user', 'cbt_tes_user.tesuser_user_id = cbt_user.user_id', 'right')
                 ->from('cbt_remidi');
               
        return $this->db->get();
	}
    /**
     * Question Type
     * 1 = ganda
     * 2 = essay
     *
     * @param      <type>  $start   The start
     * @param      <type>  $rows    The rows
     * @param      string  $tes_id  The tes identifier
     * @param      string  $order   The order
     *
     * @return     <type>  The datatable evaluasi.
     */
    function get_datatable_evaluasi($start, $rows, $tes_id, $urutkan){
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

        $this->db->select('cbt_tes_soal.tessoal_id, cbt_tes_soal.tessoal_nilai, cbt_tes_soal.tessoal_jawaban_text, cbt_tes.*, cbt_soal.*')
                 ->where('(soal_tipe="2" AND tessoal_jawaban_text IS NOT NULL '.$sql.' )')
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
                 ->where('(soal_tipe="2" AND tessoal_jawaban_text IS NOT NULL '.$sql.' )')
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