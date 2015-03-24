<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class M_Album extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	function get() {
		$sql = 'SELECT * FROM album';
		return $sql;
	}

	function get_cari($keyword='') {
		$sql = 'SELECT * FROM album WHERE album like "%'.$keyword.'%"';
		return $sql;
	}

	function save($dataInsert) {
		$query = $this->db->insert('album', $dataInsert);
		return $query;
	}
	
	function get_all_combo(){
		$sql = 'SELECT * FROM album';
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			$query->free_result();
		} else {
			$result = array();
		}
		return $result;
	}
	
	function create_slug($title){
		$url_title=url_title($title);
		$sql="SELECT * from album where slug='".$url_title."'";
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
		$sql = 'SELECT * FROM album WHERE id_album = ?';
		$query = $this->db->query($sql, $params);
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
			$query->free_result();
		} else {
			$result = array();
		}
		return $result;
	}

	function update($id_album, $dataUpdate) {
		$this->db->where('id_album', $id_album);
		$update = $this->db->update('album', $dataUpdate);
		return $update;
	}

	function delete($id_album) {
		$this->db->where('id_album', $id_album);
		$delete = $this->db->delete('album');
		return $delete;
	}
}
