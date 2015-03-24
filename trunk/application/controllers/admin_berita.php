<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Admin_Berita extends CI_Controller {

	function __construct() {
		parent::__construct();

		//jika digunakan di mayoritas function, panggil disini
		//model
		$this->load->model('m_berita');

		//library breadcrum/untuk navigasi
		$this->load->library('breadcrumb');
	}

	function index() {

		//rule type pada function ini: Read
		$this->rule->type('R');

		//Layout
		//title
		$this->layout->set_title('Data Berita');

		//meta description jika perlu
		$this->layout->set_desc('Data Berita');

		//css tambahan bila perlu
		$this->layout->set_include('css', 'themes/back/css/datatables/dataTables.bootstrap.css');

		//breadcrumb/untuk navigasi
		$this->breadcrumb->clear();
		$this->breadcrumb->add_crumb('Beranda', site_url());
		$this->breadcrumb->add_crumb('Berita', site_url('admin_berita'));
		

		//paging dan ambil data dari model
		$this->load->library('paging');                         		//Load library "paging"
		$config['sql']      				= $this->m_berita->get();//Query SQL - bukan array lho ya...
		$config['per_page'] 				= 3;                            //jumlah item tiap halaman
		$data = $this->paging->create_pagination($config);   				//Load fungsi di library "paging" untuk membuat pagination. 

		//judul besar
		$data['primary_title'] 			= '<i class="ion-android-note"></i> Master';
		$data['sub_primary_title'] 	= 'Data Berita';

		//menghilangka session jika ada
		$this->session->unset_userdata('keyword');

		//menggunakan theme back
		$this->layout->theme('back','admin_berita/index', $data);
	}

	function cari() {

		//rule type pada function ini: Read
		$this->rule->type('R');

		//Layout
		//title
		$this->layout->set_title('Cari Data Berita');

		//meta description jika perlu
		$this->layout->set_desc('Data Berita');

		//css tambahan bila perlu
		$this->layout->set_include('css', 'themes/back/css/datatables/dataTables.bootstrap.css');

		//js tambahan jika perlu
		$this->layout->set_include('js', 'themes/back/js/plugins/datatables/jquery.dataTables.js');
		$this->layout->set_include('js', 'themes/back/js/plugins/datatables/dataTables.bootstrap.js');

		//breadcrumb/untuk navigasi
		$this->breadcrumb->clear();
		$this->breadcrumb->add_crumb('Beranda', site_url());
		$this->breadcrumb->add_crumb('Berita', site_url('admin_berita'));
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
		$config['sql']      				= $this->m_berita->get_cari($data['keyword']);//your SQL - bukan array lho ya...
		$config['per_page'] 				= 3;                            //Display items per page
		$data = $this->paging->create_pagination($config);   				//Load function in "paging" libraryfor create pagination. 

		//judul besar
		$data['primary_title'] 			= '<i class="ion-android-note"></i> Master';
		$data['sub_primary_title'] 		= 'Data berita';

		//menggunakan theme back
		$this->layout->theme('back','admin_berita/index', $data);
	}

	function detail($id_berita = '') {

		//rule type pada function ini: Read
		$this->rule->type('R');

		//parameter yang dipelukan query
		$params = array($id_berita);

		//Layout
		//title
		$this->layout->set_title('Detail Berita');

		//meta description jika perlu
		//$this->layout->set_desc($this->m_master_barang->get_ket($params));

		//breadcrumb/untuk navigasi
		$this->breadcrumb->clear();
		$this->breadcrumb->add_crumb('Beranda', site_url());
		$this->breadcrumb->add_crumb('Berita', site_url('admin_berita'));
		$this->breadcrumb->add_crumb('Detail Berita');

		//judul besar
		$data['primary_title'] = '<i class="ion-android-note"></i> Master';
		$data['sub_primary_title'] = 'Data Berita';

		//ambil data dari model dengan berdasarkan parameter diatas
		$data['list'] = $this->m_berita->get_by($params);

		//menggunakan theme back
		$this->layout->theme('back','admin_berita/detail', $data);
	}

	function add() {

		//rule type pada function ini: Create
		$this->rule->type('C');

		//Layout
		//title
		$this->layout->set_title('Tambah Data Berita');

		//js tambahan
		$this->layout->set_include('js', 'themes/general/bundle/jquery_validation/jquery.validate.min.js', 'header');
		$this->layout->set_include('js', 'themes/general/bundle/jquery_validation/localization/messages_id.min.js', 'header');

		//breadcrumb/untuk navigasi
		$this->breadcrumb->clear();
		$this->breadcrumb->add_crumb('Beranda', site_url());
		$this->breadcrumb->add_crumb('Berita', site_url('admin_berita'));
		$this->breadcrumb->add_crumb('Tambah Berita');

		//judul besar
		$data['primary_title'] = 'Data Master';
		$data['sub_primary_title'] = 'Tambah Data Berita';

		//menggunakan theme back
		$this->layout->theme('back','admin_berita/add', $data);
	}

	function save() {

		//rule type pada function ini: Create
		$this->rule->type('C');

		//ambil data dari form
		$judul=$this->input->post('judul');
		$slug=$this->m_berita->create_slug($judul);
		$dataInsert = array(
			'judul' => $judul, 
			'keyword' => $this->input->post('keyword'), 
			'konten' => $this->input->post('konten'), 
			'slug' => $slug
		);

		if(!$this->m_berita->save($dataInsert)){
			$this->session->set_flashdata('gagal', 'Data <b>'.$this->input->post('judul').'</b> gagal ditambahkan.');
			redirect('admin_berita','refresh');
		}else{
			$this->session->set_flashdata('sukses', 'Data <b>'.$this->input->post('judul').'</b> berhasil ditambahkan.');
			redirect('admin_berita','refresh');
		}

		
	}

	function edit($id_berita = '') {

		//rule type pada function ini: Update
		$this->rule->type('U');

		//parameter yang dipelukan query
		$params = array($id_berita);

		//layout
		//title
		$this->layout->set_title('Edit Data Berita');

		//js tambahan
		$this->layout->set_include('js', 'themes/general/bundle/jquery_validation/jquery.validate.min.js', 'header');
		$this->layout->set_include('js', 'themes/general/bundle/jquery_validation/localization/messages_id.min.js', 'header');

		//breadcrumb/untuk navigasi
		$this->breadcrumb->clear();
		$this->breadcrumb->add_crumb('Beranda', site_url());
		$this->breadcrumb->add_crumb('Berita', site_url('admin_berita'));
		$this->breadcrumb->add_crumb('Edit Berita');

		//judul besar
		$data['primary_title'] = 'Data Berita';
		$data['sub_primary_title'] = 'Master Data Berita';

		//ambil data dari model dengan berdasarkan parameter diatas
		$data['list'] = $this->m_berita->get_by($params);

		//menggunakan theme back
		$this->layout->theme('back','admin_berita/edit', $data);
	}

	function update() {

		//rule type pada function ini: Update
		$this->rule->type('U');

		//ambil data dari form
		$id_berita = $this->input->post('id_berita');
		$judul=$this->input->post('judul');
		//ambil data dari form
		$tmp_slug=strtolower($this->input->post('tmp_slug'));
		if(strtolower(url_title($judul)) != $tmp_slug){
			$slug=$this->m_berita->create_slug($judul);
		}else{
			$slug=$tmp_slug;
		}
		$dataUpdate = array(
			'judul' => $judul, 
			'keyword' => $this->input->post('keyword'), 
			'slug' => $slug, 
			'konten' => $this->input->post('konten')
		);

		if(!$this->m_berita->update($id_berita, $dataUpdate)){
			$this->session->set_flashdata('gagal', 'Data <b>'.$this->input->post('judul').'</b> gagal diperbaharui.');
			redirect($this->input->post('redirurl'),'refresh');
		}else{
			$this->session->set_flashdata('sukses', 'Data <b>'.$this->input->post('judul').'</b> berhasil diperbaharui.');
			redirect($this->input->post('redirurl'),'refresh');
		}
	}

	function delete($id_berita = '') {

		//rule type pada function ini: Delete
		$this->rule->type('D');

		if(!$this->m_berita->delete($id_berita)){
			$this->session->set_flashdata('gagal', 'Data gagal dihapus.');
			redirect($_SERVER['HTTP_REFERER'],'refresh');
		}else{
			$this->session->set_flashdata('sukses', 'Data berhasil dihapus.');
			redirect($_SERVER['HTTP_REFERER'],'refresh');
		}
	}

	



}
