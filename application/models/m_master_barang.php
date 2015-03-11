<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class M_master_barang extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	function get() {
		$sql = 'SELECT * FROM master_barang';
		return $sql;
	}

	function get_cari($keyword='') {
		$sql = 'SELECT * FROM master_barang WHERE nama like "%'.$keyword.'%"';
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

	function get_ket($params) {
		$sql = 'SELECT ket FROM master_barang WHERE id_barang = ? AND id_produksi = ?';
		$query = $this->db->query($sql, $params);
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
			$query->free_result();
		} else {
			$result = array();
		}
		return $result['ket'];
	}

	function save($dataInsert) {
		$query = $this->db->insert('master_barang', $dataInsert);
		return $query;
	}

	function get_by($params) {
		$sql = 'SELECT * FROM master_barang WHERE id_barang = ? AND id_produksi = ?';
		$query = $this->db->query($sql, $params);
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
			$query->free_result();
		} else {
			$result = array();
		}
		return $result;
	}

	function update($id_barang, $dataUpdate) {
		$this->db->where('id_barang', $id_barang);
		$update = $this->db->update('master_barang', $dataUpdate);
		return $update;
	}

	function delete($id_barang) {
		$this->db->where('id_barang', $id_barang);
		$delete = $this->db->delete('master_barang');
		return $delete;
	}
}
