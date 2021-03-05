<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cbt_jawaban_model extends CI_Model{
	public $table = 'cbt_jawaban';
	
	function __construct(){
        parent::__construct();
    }
	
    function save($data){
        $this->db->insert($this->table, $data);
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
	
    function get_all(){
        $this->db->from($this->table)
                 ->order_by('jawaban_soal_id', 'ASC');
        return $this->db->get();
    }

	function get_by_kolom($kolom, $isi){
        $this->db->where($kolom, $isi)
                 ->from($this->table);
        return $this->db->get();
    }
    
    function get_jwbkelas($pilihan){
        $this->db->select('jawaban_id,jawaban_soal_id,modul_nama,cbt_user_grup.grup_nama,level_kode_kelas, soal_detail,jawaban_detail,jawaban_benar,soaljawaban_selected,soaljawaban_abjad')
         ->where('modul_id',$pilihan)
        ->from('cbt_jawaban')
        ->join('cbt_tes_soal_jawaban', 'cbt_tes_soal_jawaban.soaljawaban_jawaban_id = cbt_jawaban.jawaban_id')
        ->join('cbt_soal', 'cbt_soal.soal_id = cbt_jawaban.jawaban_soal_id')
        ->join('cbt_tes_topik_set', 'cbt_tes_topik_set.tset_topik_id = cbt_soal.soal_topik_id')
        ->join('cbt_modul', 'cbt_modul.modul_id = cbt_tes_topik_set.tset_modul')
        ->join('cbt_tesgrup', 'cbt_tesgrup.tstgrp_tes_id = cbt_tes_topik_set.tset_tes_id')
        ->join('cbt_user_grup', 'cbt_user_grup.grup_id = cbt_tesgrup.tstgrp_grup_id')
         ->group_by('grup_nama');
        return $this->db->get();
    }
    function get_jwbtkt($pilihan){
        $this->db->select('jawaban_id,jawaban_soal_id,modul_id,modul_nama,cbt_user_grup.grup_nama,level_kode_kelas, soal_detail,jawaban_detail,jawaban_benar,soaljawaban_selected,soaljawaban_abjad')
         ->where('modul_id',$pilihan)
        ->from('cbt_jawaban')
        ->join('cbt_tes_soal_jawaban', 'cbt_tes_soal_jawaban.soaljawaban_jawaban_id = cbt_jawaban.jawaban_id')
        ->join('cbt_soal', 'cbt_soal.soal_id = cbt_jawaban.jawaban_soal_id')
        ->join('cbt_tes_topik_set', 'cbt_tes_topik_set.tset_topik_id = cbt_soal.soal_topik_id')
        ->join('cbt_modul', 'cbt_modul.modul_id = cbt_tes_topik_set.tset_modul')
        ->join('cbt_tesgrup', 'cbt_tesgrup.tstgrp_tes_id = cbt_tes_topik_set.tset_tes_id')
        ->join('cbt_user_grup', 'cbt_user_grup.grup_id = cbt_tesgrup.tstgrp_grup_id')
         ->group_by('level_kode_kelas');
        return $this->db->get();
    }
    function get_jwbsoal($pilihan){
        $this->db->select('jawaban_id,jawaban_soal_id,modul_id,modul_nama,soal_detail,jawaban_detail,jawaban_benar,soaljawaban_selected,soaljawaban_abjad')
         ->where('(jawaban_benar="1" AND modul_id ="'.$pilihan.'")')
         ->from('cbt_jawaban')
        ->join('cbt_tes_soal_jawaban', 'cbt_tes_soal_jawaban.soaljawaban_jawaban_id = cbt_jawaban.jawaban_id')
        ->join('cbt_soal', 'cbt_soal.soal_id = cbt_jawaban.jawaban_soal_id')
        ->join('cbt_tes_topik_set', 'cbt_tes_topik_set.tset_topik_id = cbt_soal.soal_topik_id')
        ->join('cbt_modul', 'cbt_modul.modul_id = cbt_tes_topik_set.tset_modul')
         ->group_by('jawaban_soal_id');
        return $this->db->get();
    } 
     function get_jwbrespon($pilihan,$jwbsoalid){
        $this->db->select('COUNT(*) AS hasil')
         ->where('(soaljawaban_selected="1" AND modul_id ="'.$pilihan.'" AND jawaban_soal_id ="'.$jwbsoalid.'")')
         ->from('cbt_jawaban')
        ->join('cbt_tes_soal_jawaban', 'cbt_tes_soal_jawaban.soaljawaban_jawaban_id = cbt_jawaban.jawaban_id')
        ->join('cbt_soal', 'cbt_soal.soal_id = cbt_jawaban.jawaban_soal_id')
        ->join('cbt_tes_topik_set', 'cbt_tes_topik_set.tset_topik_id = cbt_soal.soal_topik_id')
        ->join('cbt_modul', 'cbt_modul.modul_id = cbt_tes_topik_set.tset_modul');
        return $this->db->get();
    } 
    function get_jwbbenar($pilihan,$jwbsoalid){
        $this->db->select('COUNT(*) AS hasil')
         ->where('(soaljawaban_selected="1" AND modul_id ="'.$pilihan.'" AND jawaban_soal_id ="'.$jwbsoalid.'" AND jawaban_benar ="1")')
         ->from('cbt_jawaban')
        ->join('cbt_tes_soal_jawaban', 'cbt_tes_soal_jawaban.soaljawaban_jawaban_id = cbt_jawaban.jawaban_id')
        ->join('cbt_soal', 'cbt_soal.soal_id = cbt_jawaban.jawaban_soal_id')
        ->join('cbt_tes_topik_set', 'cbt_tes_topik_set.tset_topik_id = cbt_soal.soal_topik_id')
        ->join('cbt_modul', 'cbt_modul.modul_id = cbt_tes_topik_set.tset_modul');
        return $this->db->get();
    } 
    function get_jwbsalah($pilihan,$jwbsoalid){
        $this->db->select('COUNT(*) AS hasil')
         ->where('(soaljawaban_selected="1" AND modul_id ="'.$pilihan.'" AND jawaban_soal_id ="'.$jwbsoalid.'" AND jawaban_benar ="0")')
         ->from('cbt_jawaban')
        ->join('cbt_tes_soal_jawaban', 'cbt_tes_soal_jawaban.soaljawaban_jawaban_id = cbt_jawaban.jawaban_id')
        ->join('cbt_soal', 'cbt_soal.soal_id = cbt_jawaban.jawaban_soal_id')
        ->join('cbt_tes_topik_set', 'cbt_tes_topik_set.tset_topik_id = cbt_soal.soal_topik_id')
        ->join('cbt_modul', 'cbt_modul.modul_id = cbt_tes_topik_set.tset_modul');
        return $this->db->get();
    } 
     function get_jwbrangking($pilihan,$jwbsoalid){
        $this->db->select('COUNT(*) AS hasil')
         ->where('(soaljawaban_selected="1" AND modul_id ="'.$pilihan.'" AND jawaban_soal_id ="'.$jwbsoalid.'" AND jawaban_benar ="0")')
         ->from('cbt_jawaban')
        ->join('cbt_tes_soal_jawaban', 'cbt_tes_soal_jawaban.soaljawaban_jawaban_id = cbt_jawaban.jawaban_id')
        ->join('cbt_soal', 'cbt_soal.soal_id = cbt_jawaban.jawaban_soal_id')
        ->join('cbt_tes_topik_set', 'cbt_tes_topik_set.tset_topik_id = cbt_soal.soal_topik_id')
        ->join('cbt_modul', 'cbt_modul.modul_id = cbt_tes_topik_set.tset_modul');
        return $this->db->get();
    } 
    function get_countjwbsoal($pilihan){
        $this->db->select('COUNT(*) AS hasil')
        ->where('(jawaban_benar="1" AND modul_id ="'.$pilihan.'")')
        ->from('cbt_jawaban')
        ->join('cbt_tes_soal_jawaban', 'cbt_tes_soal_jawaban.soaljawaban_jawaban_id = cbt_jawaban.jawaban_id')
        ->join('cbt_soal', 'cbt_soal.soal_id = cbt_jawaban.jawaban_soal_id')
        ->join('cbt_tes_topik_set', 'cbt_tes_topik_set.tset_topik_id = cbt_soal.soal_topik_id')
        ->join('cbt_modul', 'cbt_modul.modul_id = cbt_tes_topik_set.tset_modul');
       
        return $this->db->get();
    }
    function get_by_soal_limit($soal, $limit){
        $sql = '(SELECT jawaban_id FROM cbt_jawaban WHERE cbt_jawaban.jawaban_soal_id='.$soal.' AND cbt_jawaban.jawaban_benar=1 LIMIT 1) UNION (SELECT jawaban_id FROM cbt_jawaban WHERE cbt_jawaban.jawaban_soal_id='.$soal.' AND cbt_jawaban.jawaban_benar=0 LIMIT '.($limit-1).') ORDER BY RAND();';

        return $this->db->query($sql);
    }

    /**
     *Cek
     *
     * @param      <type>  $soal   The soal
     *
     * @return     <type>  The by soal tanpa acak.
     */
    function get_by_soal_tanpa_acak($soal){
        $this->db->select('jawaban_id')
                 ->where('jawaban_soal_id', $soal)
                 ->from($this->table)
                 ->order_by('jawaban_id', 'ASC');

        return $this->db->get();
    }

	function get_by_kolom_limit($kolom, $isi, $limit){
        $this->db->where($kolom, $isi)
                 ->from($this->table)
				 ->limit($limit);
        return $this->db->get();
    }

    function get_by_soal($soal){
        $this->db->where('jawaban_soal_id', $soal)
                 ->order_by('jawaban_id', 'ASC')
                 ->from($this->table);
        return $this->db->get();
    }
	
	function get_datatable($start, $rows, $kolom, $isi, $soal){
		$this->db->where('('.$kolom.' LIKE "%'.$isi.'%" AND jawaban_soal_id="'.$soal.'")')
                 ->from($this->table)
				 ->order_by('jawaban_id', 'ASC')
                 ->limit($rows, $start);
        return $this->db->get();
	}
    
    function get_datatable_count($kolom, $isi, $soal){
		$this->db->select('COUNT(*) AS hasil')
                 ->where('('.$kolom.' LIKE "%'.$isi.'%" AND jawaban_soal_id="'.$soal.'")')
                 ->from($this->table);
        return $this->db->get();
	}
}