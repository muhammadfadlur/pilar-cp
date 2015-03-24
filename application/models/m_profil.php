<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class M_Profil extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	function get() {
		$sql = 'SELECT * FROM profil';
		return $sql;
	}

	function get_cari($keyword='') {
		$sql = 'SELECT * FROM profil WHERE judul like "%'.$keyword.'%"';
		return $sql;
	}

	


	function save($dataInsert) {
		$query = $this->db->insert('profil', $dataInsert);
		return $query;
	}
	
	function create_slug($title){
		$url_title=url_title($title);
		$sql="SELECT * from profil where slug='".$url_title."'";
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
		$sql = 'SELECT * FROM profil WHERE id_profil = ?';
		$query = $this->db->query($sql, $params);
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
			$query->free_result();
		} else {
			$result = array();
		}
		return $result;
	}

	function update($id_profil, $dataUpdate) {
		$this->db->where('id_profil', $id_profil);
		$update = $this->db->update('profil', $dataUpdate);
		return $update;
	}

	function delete($id_profil) {
		$this->db->where('id_profil', $id_profil);
		$delete = $this->db->delete('profil');
		return $delete;
	}
}
