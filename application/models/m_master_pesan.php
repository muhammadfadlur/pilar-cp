<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class M_master_pesan extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	function get() {
		$sql = 'SELECT * FROM master_pesan';
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			$query->free_result();
		} else {
			$result = array();
		}
		return $result;
	}

	function totalPesan(){
	  return $this->db->count_all_results('master_pesan');
	}

	function save($dataInsert) {
		$query = $this->db->insert('master_pesan', $dataInsert);
		return $query;
	}

	function get_by($id) {
		$sql = 'SELECT * FROM master_pesan WHERE id = ?';
		$query = $this->db->query($sql, $id);
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
			$query->free_result();
		} else {
			$result = array();
		}
		return $result;
	}

	function update($id, $dataUpdate) {
		$this->db->where('id', $id);
		$update = $this->db->update('master_pesan', $dataUpdate);
		return $update;
	}

	function delete($id) {
		$this->db->where('id', $id);
		$delete = $this->db->delete('master_pesan');
		return $delete;
	}
}
