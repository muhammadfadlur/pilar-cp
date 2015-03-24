<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class M_Jadwal extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	function get() {
		$sql = 'SELECT * FROM jadwal';
		return $sql;
	}

	function get_cari($keyword='') {
		$sql = 'SELECT * FROM jadwal WHERE nama_kegiatan like "%'.$keyword.'%"';
		return $sql;
	}

	function get_export() {
		$sql = 'SELECT * FROM master_barang';
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			$query->free_result();
		} else {
			$result = array();
		}
		return $result;
	}


	function save($dataInsert) {
		$query = $this->db->insert('jadwal', $dataInsert);
		return $query;
	}
	
	function create_slug($title){
		$url_title=url_title($title);
		$sql="SELECT * from jadwal where slug='".$url_title."'";
		//echo $sql;
		$query=$this->db->query($sql);
		if ($query->num_rows()>0){
			$acak=rand(0000,9999);
			return strtolower($url_title."-".$acak);
		}else{
			return strtolower($url_title);
		}
	}

	function get_by($params) {
		$sql = 'SELECT * FROM jadwal WHERE id_jadwal = ?';
		$query = $this->db->query($sql, $params);
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
			$query->free_result();
		} else {
			$result = array();
		}
		return $result;
	}

	function update($id_jadwal, $dataUpdate) {
		$this->db->where('id_jadwal', $id_jadwal);
		$update = $this->db->update('jadwal', $dataUpdate);
		return $update;
	}

	function delete($id_jadwal) {
		$this->db->where('id_jadwal', $id_jadwal);
		$delete = $this->db->delete('jadwal');
		return $delete;
	}
}
