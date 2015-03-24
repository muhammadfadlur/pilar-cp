<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class M_Klien extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	function get() {
		$sql = 'SELECT * FROM klien';
		return $sql;
	}

	function get_cari($keyword='') {
		$sql = 'SELECT * FROM klien WHERE nama_klien like "%'.$keyword.'%"';
		return $sql;
	}

	function save($dataInsert) {
		$query = $this->db->insert('klien', $dataInsert);
		return $query;
	}
	
	

	function get_by($params) {
		$sql = 'SELECT * FROM klien WHERE id_klien = ?';
		$query = $this->db->query($sql, $params);
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
			$query->free_result();
		} else {
			$result = array();
		}
		return $result;
	}

	function update($id_klien, $dataUpdate) {
		$this->db->where('id_klien', $id_klien);
		$update = $this->db->update('klien', $dataUpdate);
		return $update;
	}

	function delete($id_klien) {
		$this->db->where('id_klien', $id_klien);
		$delete = $this->db->delete('klien');
		return $delete;
	}
}
