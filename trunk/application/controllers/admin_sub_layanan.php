<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Admin_Sub_Layanan extends CI_Controller {

	function __construct() {
		parent::__construct();

		//jika digunakan di mayoritas function, panggil disini
		//model
		$this->load->model('m_sub_layanan');
		$this->load->model('m_layanan');

		//library breadcrum/untuk navigasi
		$this->load->library('breadcrumb');
	}

	function index() {

		//rule type pada function ini: Read
		$this->rule->type('R');

		//Layout
		//title
		$this->layout->set_title('Data Sub Layanan');

		//meta description jika perlu
		$this->layout->set_desc('Data Sub Layanan');

		//css tambahan bila perlu
		$this->layout->set_include('css', 'themes/back/css/datatables/dataTables.bootstrap.css');

		//breadcrumb/untuk navigasi
		$this->breadcrumb->clear();
		$this->breadcrumb->add_crumb('Beranda', site_url());
		$this->breadcrumb->add_crumb('Sub Layanan', site_url('admin_sub_layanan'));
		

		//paging dan ambil data dari model
		$this->load->library('paging');                         		//Load library "paging"
		$config['sql']      				= $this->m_sub_layanan->get();//Query SQL - bukan array lho ya...
		$config['per_page'] 				= 3;                            //jumlah item tiap halaman
		$data = $this->paging->create_pagination($config);   				//Load fungsi di library "paging" untuk membuat pagination. 

		//judul besar
		$data['primary_title'] 			= '<i class="ion-android-note"></i> Master';
		$data['sub_primary_title'] 	= 'Data Sub Layanan';

		//menghilangka session jika ada
		$this->session->unset_userdata('keyword');

		//menggunakan theme back
		$this->layout->theme('back','admin_sub_layanan/index', $data);
	}

	function cari() {

		//rule type pada function ini: Read
		$this->rule->type('R');

		//Layout
		//title
		$this->layout->set_title('Cari Data Sub Layanan');

		//meta description jika perlu
		$this->layout->set_desc('Data Sub Layanan');

		//css tambahan bila perlu
		$this->layout->set_include('css', 'themes/back/css/datatables/dataTables.bootstrap.css');

		//js tambahan jika perlu
		$this->layout->set_include('js', 'themes/back/js/plugins/datatables/jquery.dataTables.js');
		$this->layout->set_include('js', 'themes/back/js/plugins/datatables/dataTables.bootstrap.js');

		//breadcrumb/untuk navigasi
		$this->breadcrumb->clear();
		$this->breadcrumb->add_crumb('Beranda', site_url());
		$this->breadcrumb->add_crumb('Sub Layanan', site_url('admin_sub_layanan'));
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
		$config['sql']      				= $this->m_sub_layanan->get_cari($data['keyword']);//your SQL - bukan array lho ya...
		$config['per_page'] 				= 3;                            //Display items per page
		$data = $this->paging->create_pagination($config);   				//Load function in "paging" libraryfor create pagination. 

		//judul besar
		$data['primary_title'] 			= '<i class="ion-android-note"></i> Master';
		$data['sub_primary_title'] 		= 'Data Sub Layanan';

		//menggunakan theme back
		$this->layout->theme('back','admin_sub_layanan/index', $data);
	}

	function detail($id_sub_layanan = '') {

		//rule type pada function ini: Read
		$this->rule->type('R');

		//parameter yang dipelukan query
		$params = array($id_sub_layanan);

		//Layout
		//title
		$this->layout->set_title('Detail Sub Layanan');

		//meta description jika perlu
		//$this->layout->set_desc($this->m_master_barang->get_ket($params));

		//breadcrumb/untuk navigasi
		$this->breadcrumb->clear();
		$this->breadcrumb->add_crumb('Beranda', site_url());
		$this->breadcrumb->add_crumb('Sub Layanan', site_url('admin_sub_layanan'));
		$this->breadcrumb->add_crumb('Detail Sub Layanan');

		//judul besar
		$data['primary_title'] = '<i class="ion-android-note"></i> Master';
		$data['sub_primary_title'] = 'Data Sub Layanan';

		//ambil data dari model dengan berdasarkan parameter diatas
		$data['list'] = $this->m_sub_layanan->get_by($params);

		//menggunakan theme back
		$this->layout->theme('back','admin_sub_layanan/detail', $data);
	}

	function add() {

		//rule type pada function ini: Create
		$this->rule->type('C');

		//Layout
		//title
		$this->layout->set_title('Tambah Data Sub Layanan');

		//js tambahan
		$this->layout->set_include('js', 'themes/general/bundle/jquery_validation/jquery.validate.min.js', 'header');
		$this->layout->set_include('js', 'themes/general/bundle/jquery_validation/localization/messages_id.min.js', 'header');

		//breadcrumb/untuk navigasi
		$this->breadcrumb->clear();
		$this->breadcrumb->add_crumb('Beranda', site_url());
		$this->breadcrumb->add_crumb('Sub Layanan', site_url('admin_sub_layanan'));
		$this->breadcrumb->add_crumb('Tambah Sub Layanan');
		
		$list_layanan=$this->m_layanan->get_all_combo();
		foreach($list_layanan as $val){
			$data['list_layanan'][$val['id_layanan']]=$val['layanan'];
		}
		
		//judul besar
		$data['primary_title'] = 'Data Master';
		$data['sub_primary_title'] = 'Tambah Data Sub Layanan';

		//menggunakan theme back
		$this->layout->theme('back','admin_sub_layanan/add', $data);
	}

	function save() {

		//rule type pada function ini: Create
		$this->rule->type('C');

		//ambil data dari form
		$judul=$this->input->post('judul');
		$slug=$this->m_sub_layanan->create_slug($judul);
		$dataInsert = array(
			'judul' => $judul, 
			'id_layanan' => $this->input->post('layanan'), 
			'konten' => $this->input->post('konten'), 
			'slug' => $slug
		);

		if(!$this->m_sub_layanan->save($dataInsert)){
			$this->session->set_flashdata('gagal', 'Data <b>'.$this->input->post('judul').'</b> gagal ditambahkan.');
			redirect('admin_sub_layanan','refresh');
		}else{
			$this->session->set_flashdata('sukses', 'Data <b>'.$this->input->post('judul').'</b> berhasil ditambahkan.');
			redirect('admin_sub_layanan','refresh');
		}

		
	}

	function edit($id_sub_layanan = '') {

		//rule type pada function ini: Update
		$this->rule->type('U');

		//parameter yang dipelukan query
		$params = array($id_sub_layanan);

		//layout
		//title
		$this->layout->set_title('Edit Data Sub Layanan');

		//js tambahan
		$this->layout->set_include('js', 'themes/general/bundle/jquery_validation/jquery.validate.min.js', 'header');
		$this->layout->set_include('js', 'themes/general/bundle/jquery_validation/localization/messages_id.min.js', 'header');

		//breadcrumb/untuk navigasi
		$this->breadcrumb->clear();
		$this->breadcrumb->add_crumb('Beranda', site_url());
		$this->breadcrumb->add_crumb('Sub Layanan', site_url('admin_sub_layanan'));
		$this->breadcrumb->add_crumb('Edit Sub Layanan');

		//judul besar
		$data['primary_title'] = 'Data Sub Layanan';
		$data['sub_primary_title'] = 'Master Data Sub Layanan';
		
		$list_layanan=$this->m_layanan->get_all_combo();
		foreach($list_layanan as $val){
			$data['list_layanan'][$val['id_layanan']]=$val['layanan'];
		}

		//ambil data dari model dengan berdasarkan parameter diatas
		$data['list'] = $this->m_sub_layanan->get_by($params);

		//menggunakan theme back
		$this->layout->theme('back','admin_sub_layanan/edit', $data);
	}

	function update() {

		//rule type pada function ini: Update
		$this->rule->type('U');

		//ambil data dari form
		$id_sub_layanan = $this->input->post('id_sub_layanan');
		$judul=$this->input->post('judul');
		//ambil data dari form
		$tmp_slug=strtolower($this->input->post('tmp_slug'));
		if(strtolower(url_title($judul)) != $tmp_slug){
			$slug=$this->m_sub_layanan->create_slug($judul);
		}else{
			$slug=$tmp_slug;
		}
		$dataUpdate = array(
			'judul' => $judul, 
			'id_layanan' => $this->input->post('layanan'), 
			'slug' => $slug, 
			'konten' => $this->input->post('konten')
		);

		if(!$this->m_sub_layanan->update($id_sub_layanan, $dataUpdate)){
			$this->session->set_flashdata('gagal', 'Data <b>'.$this->input->post('judul').'</b> gagal diperbaharui.');
			redirect($this->input->post('redirurl'),'refresh');
		}else{
			$this->session->set_flashdata('sukses', 'Data <b>'.$this->input->post('judul').'</b> berhasil diperbaharui.');
			redirect($this->input->post('redirurl'),'refresh');
		}
	}

	function delete($id_sub_layanan = '') {

		//rule type pada function ini: Delete
		$this->rule->type('D');

		if(!$this->m_sub_layanan->delete($id_sub_layanan)){
			$this->session->set_flashdata('gagal', 'Data gagal dihapus.');
			redirect($_SERVER['HTTP_REFERER'],'refresh');
		}else{
			$this->session->set_flashdata('sukses', 'Data berhasil dihapus.');
			redirect($_SERVER['HTTP_REFERER'],'refresh');
		}
	}

	



}
