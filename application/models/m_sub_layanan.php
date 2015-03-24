<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class M_Sub_layanan extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	function get() {
		$sql = 'SELECT a.*,b.layanan FROM sub_layanan a left join layanan b on a.id_layanan=b.id_layanan';
		return $sql;
	}

	function get_cari($keyword='') {
		$sql = 'SELECT a.*,b.layanan FROM sub_layanan a left join layanan b on a.id_layanan=b.id_layanan WHERE a.judul like "%'.$keyword.'%"';
		return $sql;
	}

	function save($dataInsert) {
		$query = $this->db->insert('sub_layanan', $dataInsert);
		return $query;
	}
	
	function create_slug($title){
		$url_title=url_title($title);
		$sql="SELECT * from sub_layanan where slug='".$url_title."'";
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
		$sql = 'SELECT a.*,b.layanan FROM sub_layanan a left join layanan b on a.id_layanan=b.id_layanan WHERE id_sub_layanan = ?';
		$query = $this->db->query($sql, $params);
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
			$query->free_result();
		} else {
			$result = array();
		}
		return $result;
	}

	function update($id_sub_layanan, $dataUpdate) {
		$this->db->where('id_sub_layanan', $id_sub_layanan);
		$update = $this->db->update('sub_layanan', $dataUpdate);
		return $update;
	}

	function delete($id_sub_layanan) {
		$this->db->where('id_sub_layanan', $id_sub_layanan);
		$delete = $this->db->delete('sub_layanan');
		return $delete;
	}
}
