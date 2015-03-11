<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Master_pesan extends CI_Controller {

	function __construct() {
		parent::__construct();

		//jika digunakan di mayoritas function, panggil disini
		//model
		$this->load->model('m_master_pesan');

		//library breadcrum/untuk navigasi
		$this->load->library('breadcrumb');
	}

	function index() {

		//rule type pada function ini: Read
		$this->rule->type('R');

		//Layout
		//title
		$this->layout->set_title('Pesan');

		//breadcrumb/untuk navigasi
		$this->breadcrumb->clear();
		$this->breadcrumb->add_crumb('Beranda', site_url());
		$this->breadcrumb->add_crumb('Master', site_url('master'));
		$this->breadcrumb->add_crumb('Pesan');

		//judul besar
		$data['primary_title'] 			= '<i class="ion-android-note"></i> Master';
		$data['sub_primary_title'] 	= 'Merupakan induk dari semua data';

		//js tambahan
		$this->layout->set_include('js', 'themes/general/bundle/jquery_validation/jquery.validate.min.js', 'header');
		$this->layout->set_include('js', 'themes/general/bundle/jquery_validation/localization/messages_id.min.js', 'header');

		//ambil data dari model
		$data['list'] = $this->m_master_pesan->get();

		//menggunakan theme back
		$this->layout->theme('back','master_pesan/index', $data);
	}

	function save() {

		//rule type pada function ini: Create
		$this->rule->type('C');

		//ambil data dari form
		$dataInsert = array('nama' => $this->input->post('nama'), 'email' => $this->input->post('email'), 'pesan' => $this->input->post('pesan'));

		//simpan melalui model
		if ($this->m_master_pesan->save($dataInsert)) {
			$this->session->set_flashdata('sukses', 'Pesan ' . $this->input->post('nama') . ' berhasil ditambahkan.');
		} else {
			$this->session->set_flashdata('gagal', 'Pesan ' . $this->input->post('nama') . ' gagal ditambahkan.');
		}
	}

	function dynamic() {

		//rule type pada function ini: Read
		$this->rule->type('R');

		//ambil data dari model
		$data['list'] = $this->m_master_pesan->get();
		$this->load->view('back/layouts/master_pesan/dynamic', $data);
	}

	function detail($id = '') {

		//rule type pada function ini: Read
		$this->rule->type('R');

		//parameter yang dipelukan query
		$data['list'] = $this->m_master_pesan->get_by($id);
		$this->load->view('back/layouts/master_pesan/detail', $data);
	}

	function edit($id = '') {

		//rule type pada function ini: Read
		$this->rule->type('R');

		//parameter yang dipelukan query
		$data['list'] = $this->m_master_pesan->get_by($id);
		$this->load->view('back/layouts/master_pesan/edit', $data);
	}

	function update() {

		//rule type pada function ini: Update
		$this->rule->type('U');

		//ambil data dari form
		$id = $this->input->post('id');
		$dataUpdate = array('nama' => $this->input->post('nama'), 'email' => $this->input->post('email'), 'pesan' => $this->input->post('pesan'));

		//update melalui model
		if ($this->m_master_pesan->update($id, $dataUpdate)) {
			$this->session->set_flashdata('sukses', 'Pesan ' . $this->input->post('nama') . ' berhasil diperbaharui.');
		} else {
			$this->session->set_flashdata('gagal', 'Pesan ' . $this->input->post('nama') . ' gagal diperbaharui.');
		}
	}

	function delete_konfirm($id = '') {

		//rule type pada function ini: Read
		$this->rule->type('R');

		//parameter yang dipelukan query
		$data['list'] = $this->m_master_pesan->get_by($id);
		$this->load->view('back/layouts/master_pesan/delete_konfirm', $data);
	}

	function delete($id = '') {

		//rule type pada function ini: Delete
		$this->rule->type('D');

		//hapus melalui model berdasarkan id
		$id = $this->input->post('id');
		if ($this->m_master_pesan->delete($id)) {
			$this->session->set_flashdata('sukses', 'Pesan ' . $this->input->post('nama') . ' berhasil dihapus.');
		} else {
			$this->session->set_flashdata('gagal', 'Pesan ' . $this->input->post('nama') . ' gagal dihapus.');
		}
	}
}
