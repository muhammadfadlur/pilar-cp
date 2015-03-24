<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class M_Gallery extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	function get() {
		$sql = 'SELECT a.*,b.album  FROM gallery a left join album b on a.id_album=b.id_album';
		return $sql;
	}

	function get_cari($keyword='') {
		$sql = 'SELECT a.*,b.album  FROM gallery a left join album b on a.id_album=b.id_album
			WHERE a.judul like "%'.$keyword.'%"';
		return $sql;
	}

	function save($dataInsert) {
		$query = $this->db->insert('gallery', $dataInsert);
		return $query;
	}
	
	

	function get_by($params) {
		$sql = 'SELECT a.*,b.album  FROM gallery a left join album b on a.id_album=b.id_album
				WHERE a.id_gallery = ?';
		$query = $this->db->query($sql, $params);
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
			$query->free_result();
		} else {
			$result = array();
		}
		return $result;
	}

	function update($id_gallery, $dataUpdate) {
		$this->db->where('id_gallery', $id_gallery);
		$update = $this->db->update('gallery', $dataUpdate);
		return $update;
	}

	function delete($id_gallery) {
		$this->db->where('id_gallery', $id_gallery);
		$delete = $this->db->delete('gallery');
		return $delete;
	}
}
