<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class M_Slider extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	function get() {
		$sql = 'SELECT * FROM slider';
		return $sql;
	}

	function get_cari($keyword='') {
		$sql = 'SELECT * FROM slider WHERE judul like "%'.$keyword.'%"';
		return $sql;
	}

	function save($dataInsert) {
		$query = $this->db->insert('slider', $dataInsert);
		return $query;
	}
	
	

	function get_by($params) {
		$sql = 'SELECT * FROM slider WHERE id_slider = ?';
		$query = $this->db->query($sql, $params);
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
			$query->free_result();
		} else {
			$result = array();
		}
		return $result;
	}

	function update($id_slider, $dataUpdate) {
		$this->db->where('id_slider', $id_slider);
		$update = $this->db->update('slider', $dataUpdate);
		return $update;
	}

	function delete($id_slider) {
		$this->db->where('id_slider', $id_slider);
		$delete = $this->db->delete('slider');
		return $delete;
	}
}
