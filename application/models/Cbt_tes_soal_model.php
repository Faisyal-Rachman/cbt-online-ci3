<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cbt_tes_soal_model extends CI_Model{
	public $table = 'cbt_tes_soal';
	
	function __construct(){
        parent::__construct();
    }
	
    function save($data){
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    function save_batch($data){
        //$this->db->query($sql);
        $this->db->insert_batch($this->table, $data);
    }
    
    function delete($kolom, $isi){
        $this->db->where($kolom, $isi)
                 ->delete($this->table);
    }
    
    function update($kolom, $isi, $data){
        $this->db->where($kolom, $isi)
                 ->update($this->table, $data);
    }
    
    function count_by_kolom($kolom, $isi){
        $this->db->select('COUNT(*) AS hasil')
                 ->where($kolom, $isi)
                 ->from($this->table);
        return $this->db->get();
    }
    function count_by_kolom_st($id){
        $this->db->select('COUNT(*) AS hasil')
             ->where('cbt_tes_soal.tessoal_display_time !=0 AND cbt_tes_user.tesuser_user_id="'.$id.'"')
             ->join('cbt_tes_user', 'cbt_tes_user.tesuser_id = cbt_tes_soal.tessoal_tesuser_id')          
                 ->from($this->table);
        return $this->db->get();
    }
    function count_soal($id){
        $this->db->select('COUNT(cbt_tes_soal.tessoal_id) as banyaksoal')
          ->join('cbt_tes_user', 'cbt_tes_user.tesuser_id = cbt_tes_soal.tessoal_tesuser_id')
        ->group_by('cbt_tes_soal.tessoal_tesuser_id')      
        ->from('cbt_tes_soal');
        return $this->db->get();
    }
    function count_by_tesuser_dijawab($tesuser_id){
        $this->db->select('COUNT(*) AS hasil')
                 ->where('tessoal_tesuser_id="'.$tesuser_id.'" AND tessoal_change_time!=""')
                 ->from($this->table);
        return $this->db->get();
    }

    function count_by_tesuser_blum_dijawab($tesuser_id){
        $this->db->select('COUNT(*) AS hasil')
                 ->where('tessoal_tesuser_id="'.$tesuser_id.'" AND tessoal_change_time IS NUlL')
                 ->from($this->table);
        return $this->db->get();
    }
	
	function get_by_kolom($kolom, $isi){
        $this->db->where($kolom, $isi)
                 ->from($this->table);
        return $this->db->get();
    }

    function get_by_testuser($tesuser_id){
        $this->db->where('tessoal_tesuser_id="'.$tesuser_id.'"')
                 ->join('cbt_soal', 'cbt_tes_soal.tessoal_soal_id = cbt_soal.soal_id')
                 ->from($this->table)
                 ->order_by('tessoal_order', 'ASC');
        return $this->db->get();
    }

    function get_by_testuser_select($tesuser_id, $topik, $select){
        $this->db->select($select)
                 ->where('tessoal_tesuser_id="'.$tesuser_id.'" AND soal_topik_id="'.$topik.'"')
                 ->join('cbt_soal', 'cbt_tes_soal.tessoal_soal_id = cbt_soal.soal_id')
                 ->from($this->table)
                 ->order_by('tessoal_order', 'ASC');
        return $this->db->get();
    }

    function get_by_testuser_limit($tesuser_id, $limit){
        $this->db->where('tessoal_tesuser_id="'.$tesuser_id.'"')
                 ->join('cbt_soal', 'cbt_tes_soal.tessoal_soal_id = cbt_soal.soal_id')
                 ->from($this->table)
                 ->order_by('tessoal_order', 'ASC')
                 ->limit($limit);
        return $this->db->get();
    }

    function get_by_tessoal_limit($tessoal_id, $limit){
        $this->db->select('tessoal_id,tessoal_tesuser_id,tessoal_user_ip,tessoal_soal_id,tessoal_jawaban_text,tessoal_nilai,tessoal_ragu,tessoal_creation_time,tessoal_display_time,tessoal_change_time,tessoal_reaction_time,tessoal_order,tessoal_num_answers,tessoal_comment,tessoal_audio_play,soal_id,soal_topik_id,soal_detail,soal_tipe,soal_kunci,soal_difficulty,soal_aktif,soal_audio,soal_audio_play,soal_timer,soal_inline_answers,soal_auto_next')
                 ->where('tessoal_id="'.$tessoal_id.'"')
                 ->join('cbt_soal', 'cbt_tes_soal.tessoal_soal_id = cbt_soal.soal_id')
                 ->from($this->table)
                 ->limit($limit);
        return $this->db->get();
    }
	 function get_by_soalaudio_limit($tes_id, $limit){
        $this->db->select('tset_tes_id,tes_audio_play')
                 ->where('tes_id="'.$tes_id.'"')
                 ->join('cbt_soal', 'cbt_tes_soal.tessoal_soal_id = cbt_soal.soal_id')
                 ->join('cbt_tes_topik_set', 'cbt_tes_topik_set.tset_topik_id = cbt_soal.soal_topik_id')
                 ->join('cbt_tes', 'cbt_tes.tes_id = cbt_tes_topik_set.tset_tes_id')
                 ->from($this->table)
                 ->limit($limit);
        return $this->db->get();
    }
    
	function get_by_kolom_limit($kolom, $isi, $limit){
        $this->db->where($kolom, $isi)
                 ->from($this->table)
				 ->limit($limit);
        return $this->db->get();
    }
    function stat_ujian($tessoal_id){
        $sql = 'SELECT COUNT(tessoal_nilai) AS nama_alias FROM cbt_tes_soal where tessoal_nilai !=0';
        return $this->db->query($sql);
    }
    function get_nilai($tessoal_id){
        $sql = 'SELECT SUM(tessoal_nilai) AS hasil, COUNT(CASE  WHEN tessoal_nilai=0 THEN 1 END) AS jawaban_salah, COUNT(*) AS total_soal FROM cbt_tes_soal WHERE tessoal_tesuser_id="'.$tessoal_id.'"';
        return $this->db->query($sql);
    }
    function get_statuspg($tessoal_id){
        $sql = 'SELECT SUM(tessoal_nilai) AS hasil, COUNT(CASE  WHEN tessoal_nilai=0 THEN 1 END) AS jawaban_salah, COUNT(*) AS total_soal FROM cbt_tes_soal WHERE tessoal_tesuser_id="'.$tessoal_id.'"';
        return $this->db->query($sql);
    }
	function get_rank($tessoal_id){
        $sql = 'SELECT SUM(tessoal_nilai) AS hasil, COUNT(CASE  WHEN tessoal_nilai=0 THEN 1 END) AS jawaban_salah, COUNT(*) AS total_soal,
        cbt_modul.modul_nama, cbt_user.user_name 
        FROM cbt_tes_soal
        JOIN cbt_tes_user on cbt_tes_user.tesuser_id = cbt_tes_soal.tessoal_tesuser_id 
        JOIN cbt_tes on cbt_tes.tes_id = cbt_tes_user.tesuser_tes_id 
        join cbt_tes_topik_set on cbt_tes_topik_set.tset_tes_id = cbt_tes.tes_id
        JOIN cbt_modul ON cbt_modul.modul_id = cbt_tes_topik_set.tset_modul
        JOIN cbt_user ON cbt_user.user_id = cbt_tes_user.tesuser_user_id WHERE tessoal_tesuser_id="'.$tessoal_id.'"';
        return $this->db->query($sql);
    }
    function get_peringkat(){
        $sql = 'SELECT user_birthdate, level_nama,nilai, COUNT(cbt_remidi.nilai), FIND_IN_SET( nilai, (
            SELECT GROUP_CONCAT( nilai
            ORDER BY nilai DESC ) 
            FROM cbt_remidi )
            ) AS rank  FROM cbt_remidi 
            join cbt_user_grup on cbt_user_grup.grup_nama = cbt_remidi.grup_nama 
            join cbt_level ON cbt_level.level_kode = cbt_user_grup.level_kode_kelas';
        return $this->db->query($sql);
    }
    /**
     * Datatable untuk hasil tes detail setiap user
     *
     * @param      <type>  $start  The start
     * @param      <type>  $rows   The rows
     * @param      string  $kolom  The kolom
     * @param      string  $isi    The isi
     *
     * @return     <type>  The datatable.
     */
	function get_datatable($start, $rows, $kolom, $isi, $tesuser_id){
		$this->db->where('('.$kolom.' LIKE "%'.$isi.'%" AND tessoal_tesuser_id="'.$tesuser_id.'")')
                 ->from($this->table)
                 ->join('cbt_soal', 'cbt_tes_soal.tessoal_soal_id = cbt_soal.soal_id')
				 ->order_by('tessoal_order', 'ASC')
                 ->limit($rows, $start);
        return $this->db->get();
	}
    function get_datatable1($start, $rows, $kolom, $isi, $tesuser_id){
		$this->db->where('('.$kolom.' LIKE "%'.$isi.'%" AND soal_topik_id="'.$tesuser_id.'")')
                 ->from($this->table)
                 ->join('cbt_soal', 'cbt_tes_soal.tessoal_soal_id = cbt_soal.soal_id')
				 ->order_by('tessoal_order', 'ASC')
                 ->limit($rows, $start);
        return $this->db->get();
	}
    function get_datatable_count($kolom, $isi, $tesuser_id){
		$this->db->select('COUNT(*) AS hasil')
                 ->where('('.$kolom.' LIKE "%'.$isi.'%" AND tessoal_tesuser_id="'.$tesuser_id.'")')
                 ->join('cbt_soal', 'cbt_tes_soal.tessoal_soal_id = cbt_soal.soal_id')
                 ->from($this->table);
        return $this->db->get();
    }
    function get_datatable_count1($kolom, $isi, $tesuser_id){
		$this->db->select('COUNT(*) AS hasil')
                 ->where('('.$kolom.' LIKE "%'.$isi.'%" AND soal_topik_id="'.$tesuser_id.'")')
                 ->join('cbt_soal', 'cbt_tes_soal.tessoal_soal_id = cbt_soal.soal_id')
                 ->from($this->table);
        return $this->db->get();
    } 
}