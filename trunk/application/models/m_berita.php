<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class M_Berita extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	function get() {
		$sql = 'SELECT * FROM berita';
		return $sql;
	}

	function get_cari($keyword='') {
		$sql = 'SELECT * FROM berita WHERE judul like "%'.$keyword.'%"';
		return $sql;
	}

	


	function save($dataInsert) {
		$query = $this->db->insert('berita', $dataInsert);
		return $query;
	}
	
	function create_slug($title){
		$url_title=url_title($title);
		$sql="SELECT * from berita where slug='".$url_title."'";
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
		$sql = 'SELECT * FROM berita WHERE id_berita = ?';
		$query = $this->db->query($sql, $params);
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
			$query->free_result();
		} else {
			$result = array();
		}
		return $result;
	}

	function update($id_berita, $dataUpdate) {
		$this->db->where('id_berita', $id_berita);
		$update = $this->db->update('berita', $dataUpdate);
		return $update;
	}

	function delete($id_berita) {
		$this->db->where('id_berita', $id_berita);
		$delete = $this->db->delete('berita');
		return $delete;
	}
}
