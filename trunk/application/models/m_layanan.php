<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class M_Layanan extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	function get() {
		$sql = 'SELECT * FROM layanan';
		return $sql;
	}
	
	function get_all_combo(){
		$sql = 'SELECT * FROM layanan';
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			$query->free_result();
		} else {
			$result = array();
		}
		return $result;
	}

	function get_cari($keyword='') {
		$sql = 'SELECT * FROM layanan WHERE layanan like "%'.$keyword.'%"';
		return $sql;
	}

	function save($dataInsert) {
		$query = $this->db->insert('layanan', $dataInsert);
		return $query;
	}
	
	function create_slug($title){
		$url_title=url_title($title);
		$sql="SELECT * from layanan where slug='".$url_title."'";
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
		$sql = 'SELECT * FROM layanan WHERE id_layanan = ?';
		$query = $this->db->query($sql, $params);
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
			$query->free_result();
		} else {
			$result = array();
		}
		return $result;
	}

	function update($id_layanan, $dataUpdate) {
		$this->db->where('id_layanan', $id_layanan);
		$update = $this->db->update('layanan', $dataUpdate);
		return $update;
	}

	function delete($id_layanan) {
		$this->db->where('id_layanan', $id_layanan);
		$delete = $this->db->delete('layanan');
		return $delete;
	}
}
