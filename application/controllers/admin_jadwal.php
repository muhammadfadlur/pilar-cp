<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Admin_Jadwal extends CI_Controller {

	function __construct() {
		parent::__construct();

		//jika digunakan di mayoritas function, panggil disini
		//model
		$this->load->model('m_jadwal');

		//library breadcrum/untuk navigasi
		$this->load->library('breadcrumb');
	}

	function index() {

		//rule type pada function ini: Read
		$this->rule->type('R');

		//Layout
		//title
		$this->layout->set_title('Data Jadwal');

		//meta description jika perlu
		$this->layout->set_desc('Data Jadwal');

		//css tambahan bila perlu
		$this->layout->set_include('css', 'themes/back/css/datatables/dataTables.bootstrap.css');

		//breadcrumb/untuk navigasi
		$this->breadcrumb->clear();
		$this->breadcrumb->add_crumb('Beranda', site_url());
		$this->breadcrumb->add_crumb('Jadwal', site_url('admin_jadwal'));
		

		//paging dan ambil data dari model
		$this->load->library('paging');                         		//Load library "paging"
		$config['sql']      				= $this->m_jadwal->get();//Query SQL - bukan array lho ya...
		$config['per_page'] 				= 3;                            //jumlah item tiap halaman
		$data = $this->paging->create_pagination($config);   				//Load fungsi di library "paging" untuk membuat pagination. 

		//judul besar
		$data['primary_title'] 			= '<i class="ion-android-note"></i> Master';
		$data['sub_primary_title'] 	= 'Data Jadwal';

		//menghilangka session jika ada
		$this->session->unset_userdata('keyword');

		//menggunakan theme back
		$this->layout->theme('back','admin_jadwal/index', $data);
	}

	function cari() {

		//rule type pada function ini: Read
		$this->rule->type('R');

		//Layout
		//title
		$this->layout->set_title('Cari Data Jadwal');

		//meta description jika perlu
		$this->layout->set_desc('Data Jadwal');

		//css tambahan bila perlu
		$this->layout->set_include('css', 'themes/back/css/datatables/dataTables.bootstrap.css');

		//js tambahan jika perlu
		$this->layout->set_include('js', 'themes/back/js/plugins/datatables/jquery.dataTables.js');
		$this->layout->set_include('js', 'themes/back/js/plugins/datatables/dataTables.bootstrap.js');

		//breadcrumb/untuk navigasi
		$this->breadcrumb->clear();
		$this->breadcrumb->add_crumb('Beranda', site_url());
		$this->breadcrumb->add_crumb('Jadwal', site_url('admin_jadwal'));
		//$this->breadcrumb->add_crumb('Barang');	

		//buat cari
		if(isset($_POST['keyword'])){
			$data['keyword'] = $this->input->post('keyword');
			$this->session->set_userdata('keyword', $data['keyword']);
		} else {
			$data['keyword'] = $this->session->userdata('keyword');
		}	

		//paging dan ambil data dari model
		$this->load->library('paging');                         		//Load the "paging" library
		$config['sql']      				= $this->m_jadwal->get_cari($data['keyword']);//your SQL - bukan array lho ya...
		$config['per_page'] 				= 3;                            //Display items per page
		$data = $this->paging->create_pagination($config);   				//Load function in "paging" libraryfor create pagination. 

		//judul besar
		$data['primary_title'] 			= '<i class="ion-android-note"></i> Master';
		$data['sub_primary_title'] 		= 'Data Jadwal';

		//menggunakan theme back
		$this->layout->theme('back','admin_jadwal/index', $data);
	}

	function detail($id_jadwal = '') {

		//rule type pada function ini: Read
		$this->rule->type('R');

		//parameter yang dipelukan query
		$params = array($id_jadwal);

		//Layout
		//title
		$this->layout->set_title('Detail Jadwal');

		//meta description jika perlu
		//$this->layout->set_desc($this->m_master_barang->get_ket($params));

		//breadcrumb/untuk navigasi
		$this->breadcrumb->clear();
		$this->breadcrumb->add_crumb('Beranda', site_url());
		$this->breadcrumb->add_crumb('Jadwal', site_url('admin_jadwal'));
		$this->breadcrumb->add_crumb('Detail Jadwal');

		//judul besar
		$data['primary_title'] = '<i class="ion-android-note"></i> Master';
		$data['sub_primary_title'] = 'Data Jadwal';

		//ambil data dari model dengan berdasarkan parameter diatas
		$data['list'] = $this->m_jadwal->get_by($params);

		//menggunakan theme back
		$this->layout->theme('back','admin_jadwal/detail', $data);
	}

	function add() {

		//rule type pada function ini: Create
		$this->rule->type('C');

		//Layout
		//title
		$this->layout->set_title('Tambah Data Jadwal');

		//js tambahan
		$this->layout->set_include('js', 'themes/general/bundle/jquery_validation/jquery.validate.min.js', 'header');
		$this->layout->set_include('js', 'themes/general/bundle/jquery_validation/localization/messages_id.min.js', 'header');

		//breadcrumb/untuk navigasi
		$this->breadcrumb->clear();
		$this->breadcrumb->add_crumb('Beranda', site_url());
		$this->breadcrumb->add_crumb('Jadwal', site_url('admin_jadwal'));
		$this->breadcrumb->add_crumb('Tambah Jadwal');

		//judul besar
		$data['primary_title'] = 'Data Master';
		$data['sub_primary_title'] = 'Tambah Data Jadwal';

		//menggunakan theme back
		$this->layout->theme('back','admin_jadwal/add', $data);
	}

	function save() {

		//rule type pada function ini: Create
		$this->rule->type('C');

		//ambil data dari form
		$nama_kegiatan=$this->input->post('nama_kegiatan');
		$slug=$this->m_jadwal->create_slug($nama_kegiatan);
		$dataInsert = array(
			'nama_kegiatan' => $nama_kegiatan, 
			'tgl_mulai' => $this->input->post('tgl_mulai'), 
			'tgl_selesai' => $this->input->post('tgl_selesai'), 
			'konten' => $this->input->post('konten'), 
			'slug' => $slug
		);

		if(!$this->m_jadwal->save($dataInsert)){
			$this->session->set_flashdata('gagal', 'Data <b>'.$this->input->post('nama_kegiatan').'</b> gagal ditambahkan.');
			redirect('admin_jadwal','refresh');
		}else{
			$this->session->set_flashdata('sukses', 'Data <b>'.$this->input->post('nama_kegiatan').'</b> berhasil ditambahkan.');
			redirect('admin_jadwal','refresh');
		}

		
	}

	function edit($id_jadwal = '') {

		//rule type pada function ini: Update
		$this->rule->type('U');

		//parameter yang dipelukan query
		$params = array($id_jadwal);

		//layout
		//title
		$this->layout->set_title('Edit Data Jadwal');

		//js tambahan
		$this->layout->set_include('js', 'themes/general/bundle/jquery_validation/jquery.validate.min.js', 'header');
		$this->layout->set_include('js', 'themes/general/bundle/jquery_validation/localization/messages_id.min.js', 'header');

		//breadcrumb/untuk navigasi
		$this->breadcrumb->clear();
		$this->breadcrumb->add_crumb('Beranda', site_url());
		$this->breadcrumb->add_crumb('Jadwal', site_url('admin_jadwal'));
		$this->breadcrumb->add_crumb('Edit Jadwal');

		//judul besar
		$data['primary_title'] = 'Data Jadwal';
		$data['sub_primary_title'] = 'Master Data Jadwal';

		//ambil data dari model dengan berdasarkan parameter diatas
		$data['list'] = $this->m_jadwal->get_by($params);

		//menggunakan theme back
		$this->layout->theme('back','admin_jadwal/edit', $data);
	}

	function update() {

		//rule type pada function ini: Update
		$this->rule->type('U');

		//ambil data dari form
		$id_jadwal = $this->input->post('id_jadwal');
		$nama_kegiatan = $this->input->post('nama_kegiatan');
		$dataUpdate = array(
			'nama_kegiatan' => $nama_kegiatan, 
			'tgl_mulai' => $this->input->post('tgl_mulai'), 
			'tgl_selesai' => $this->input->post('tgl_selesai'), 
			'konten' => $this->input->post('konten')
		);

		if(!$this->m_jadwal->update($id_jadwal, $dataUpdate)){
			$this->session->set_flashdata('gagal', 'Data <b>'.$this->input->post('nama_kegiatan').'</b> gagal diperbaharui.');
			redirect($this->input->post('redirurl'),'refresh');
		}else{
			$this->session->set_flashdata('sukses', 'Data <b>'.$this->input->post('nama_kegiatan').'</b> berhasil diperbaharui.');
			redirect($this->input->post('redirurl'),'refresh');
		}
	}

	function delete($id_jadwal = '') {

		//rule type pada function ini: Delete
		$this->rule->type('D');

		if(!$this->m_jadwal->delete($id_jadwal)){
			$this->session->set_flashdata('gagal', 'Data gagal dihapus.');
			redirect($_SERVER['HTTP_REFERER'],'refresh');
		}else{
			$this->session->set_flashdata('sukses', 'Data berhasil dihapus.');
			redirect($_SERVER['HTTP_REFERER'],'refresh');
		}
	}

	



}
