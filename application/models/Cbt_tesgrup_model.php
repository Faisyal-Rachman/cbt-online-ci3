<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cbt_tesgrup_model extends CI_Model{
	public $table = 'cbt_tesgrup';
	
	function __construct(){
        parent::__construct();
    }
	
    function save($data){
        $this->db->insert($this->table, $data);
    }
    function saveabsen($data){
        $this->db->insert('cbt_absengrup', $data);
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

    function count_by_tes_and_group($tes, $group){
        $this->db->select('COUNT(*) AS hasil')
                 ->where('(tstgrp_tes_id="'.$tes.'" AND tstgrp_grup_id="'.$group.'" )')
                 ->from($this->table);
        return $this->db->get();
    }
	function count_by_sesi($tes, $group){
        $this->db->select('COUNT(*) AS hasil')
                 ->where('(tstgrp_tes_id="'.$tes.'" AND tstgrp_grup_id="'.$group.'" )')
                 ->from($this->table);
        return $this->db->get();
    }
    
	function get_by_kolom($kolom, $isi){
        $this->db->where($kolom, $isi)
                 ->from($this->table);
        return $this->db->get();
    }
	
	function get_by_kolom_limit($kolom, $isi, $limit){
        $this->db->where($kolom, $isi)
                 ->from($this->table)
				 ->limit($limit);
        return $this->db->get();
    }

    function get_by_tanggal($tglawal, $tglakhir){
        $this->db->where('(DATE(tes_begin_time)>="'.$tglawal.'" AND DATE(tes_begin_time)<="'.$tglakhir.'")')
                 ->join('cbt_tes', 'cbt_tesgrup.tstgrp_tes_id = cbt_tes.tes_id')
                 ->order_by('tes_begin_time ASC, tes_nama ASC')
                 ->from($this->table);
        return $this->db->get();
    }
	
	function get_by_tanggal_and_grup($tglawal, $tglakhir, $grup_id){
        $this->db->where('(DATE(tes_begin_time)>="'.$tglawal.'" AND DATE(tes_begin_time)<="'.$tglakhir.'" AND tstgrp_grup_id="'.$grup_id.'")')
                 ->join('cbt_tes', 'cbt_tesgrup.tstgrp_tes_id = cbt_tes.tes_id')
                 ->order_by('tes_begin_time ASC, tes_nama ASC')
                 ->from($this->table);
        return $this->db->get();
    }
	
	function get_datatable($start, $rows, $grup_id){
		$this->db->where('(tstgrp_grup_id="'.$grup_id.'" AND tes_begin_time<=NOW() AND tes_end_time>=NOW())')
                 ->from($this->table)
                 ->join('cbt_tes', 'cbt_tesgrup.tstgrp_tes_id = cbt_tes.tes_id')
                 ->join('cbt_user_grup', 'cbt_user_grup.grup_id = cbt_tesgrup.tstgrp_grup_id')
                ->join('cbt_tes_topik_set', 'cbt_tes_topik_set.tset_tes_id = cbt_tes.tes_id')
                ->join('cbt_modul', 'cbt_modul.modul_id = cbt_tes_topik_set.tset_modul')
                ->group_by('cbt_tes.tes_id')
                 ->order_by('tes_begin_time ASC, tes_nama ASC')
                 ->limit($rows, $start);
        return $this->db->get();
	}
    function get_datatable2($start, $rows, $grup_id){
        $this->db->where('(tstgrp_grup_id="'.$grup_id.'" AND tes_begin_time<=NOW() AND tes_end_time>=NOW()) AND cbt_tes.tes_status = 1')
                 ->from('cbt_user')
                  ->join('cbt_tesgrup', 'cbt_user.user_grup_id = cbt_tesgrup.tstgrp_grup_id')
                 ->join('cbt_tes', 'cbt_tes.tes_id = cbt_tesgrup.tstgrp_tes_id')
                ->join('cbt_user_grup', 'cbt_user_grup.grup_id = cbt_user.user_grup_id')
                ->join('cbt_tes_topik_set', 'cbt_tes_topik_set.tset_tes_id = cbt_tes.tes_id')
                ->join('cbt_modul', 'cbt_modul.modul_id = cbt_tes_topik_set.tset_modul')
                ->group_by('cbt_tes.tes_id')
                 ->order_by('tes_begin_time ASC, tes_nama ASC')
                 ->limit($rows, $start);
        return $this->db->get();
    }
    function get_datatable_count($grup_id){
		$this->db->select('COUNT(*) AS hasil')
                 ->where('(tstgrp_grup_id="'.$grup_id.'" AND tes_begin_time<=NOW() AND tes_end_time>=NOW())')
                 ->join('cbt_tes', 'cbt_tesgrup.tstgrp_tes_id = cbt_tes.tes_id')
                 ->from($this->table);
        return $this->db->get();
	}
}