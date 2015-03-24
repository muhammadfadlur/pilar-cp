<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Admin_Album extends CI_Controller {

	function __construct() {
		parent::__construct();

		//jika digunakan di mayoritas function, panggil disini
		//model
		$this->load->model('m_album');

		//library breadcrum/untuk navigasi
		$this->load->library('breadcrumb');
		$this->path = './foto_album/';
	}

	function index() {

		//rule type pada function ini: Read
		$this->rule->type('R');

		//Layout
		//title
		$this->layout->set_title('Data Album');

		//meta description jika perlu
		$this->layout->set_desc('Data Album');

		//css tambahan bila perlu
		$this->layout->set_include('css', 'themes/back/css/datatables/dataTables.bootstrap.css');

		//breadcrumb/untuk navigasi
		$this->breadcrumb->clear();
		$this->breadcrumb->add_crumb('Beranda', site_url());
		$this->breadcrumb->add_crumb('Album', site_url('admin_album'));
		

		//paging dan ambil data dari model
		$this->load->library('paging');                         		//Load library "paging"
		$config['sql']      				= $this->m_album->get();//Query SQL - bukan array lho ya...
		$config['per_page'] 				= 3;                            //jumlah item tiap halaman
		$data = $this->paging->create_pagination($config);   				//Load fungsi di library "paging" untuk membuat pagination. 

		//judul besar
		$data['primary_title'] 			= '<i class="ion-android-note"></i> Master';
		$data['sub_primary_title'] 	= 'Data Album';

		//menghilangka session jika ada
		$this->session->unset_userdata('keyword');

		//menggunakan theme back
		$this->layout->theme('back','admin_album/index', $data);
	}

	function cari() {

		//rule type pada function ini: Read
		$this->rule->type('R');

		//Layout
		//title
		$this->layout->set_title('Cari Data Album');

		//meta description jika perlu
		$this->layout->set_desc('Data Album');

		//css tambahan bila perlu
		$this->layout->set_include('css', 'themes/back/css/datatables/dataTables.bootstrap.css');

		//js tambahan jika perlu
		$this->layout->set_include('js', 'themes/back/js/plugins/datatables/jquery.dataTables.js');
		$this->layout->set_include('js', 'themes/back/js/plugins/datatables/dataTables.bootstrap.js');

		//breadcrumb/untuk navigasi
		$this->breadcrumb->clear();
		$this->breadcrumb->add_crumb('Beranda', site_url());
		$this->breadcrumb->add_crumb('Album', site_url('admin_album'));
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
		$config['sql']      				= $this->m_album->get_cari($data['keyword']);//your SQL - bukan array lho ya...
		$config['per_page'] 				= 3;                            //Display items per page
		$data = $this->paging->create_pagination($config);   				//Load function in "paging" libraryfor create pagination. 

		//judul besar
		$data['primary_title'] 			= '<i class="ion-android-note"></i> Master';
		$data['sub_primary_title'] 		= 'Data Album';

		//menggunakan theme back
		$this->layout->theme('back','admin_album/index', $data);
	}

	function detail($id_album = '') {

		//rule type pada function ini: Read
		$this->rule->type('R');

		//parameter yang dipelukan query
		$params = array($id_album);

		//Layout
		//title
		$this->layout->set_title('Detail Album');

		//meta description jika perlu
		//$this->layout->set_desc($this->m_master_barang->get_ket($params));

		//breadcrumb/untuk navigasi
		$this->breadcrumb->clear();
		$this->breadcrumb->add_crumb('Beranda', site_url());
		$this->breadcrumb->add_crumb('Album', site_url('admin_album'));
		$this->breadcrumb->add_crumb('Detail Album');

		//judul besar
		$data['primary_title'] = '<i class="ion-android-note"></i> Master';
		$data['sub_primary_title'] = 'Data Album';

		//ambil data dari model dengan berdasarkan parameter diatas
		$data['list'] = $this->m_album->get_by($params);

		//menggunakan theme back
		$this->layout->theme('back','admin_album/detail', $data);
	}

	function add() {

		//rule type pada function ini: Create
		$this->rule->type('C');

		//Layout
		//title
		$this->layout->set_title('Tambah Data Album');

		//js tambahan
		$this->layout->set_include('js', 'themes/general/bundle/jquery_validation/jquery.validate.min.js', 'header');
		$this->layout->set_include('js', 'themes/general/bundle/jquery_validation/localization/messages_id.min.js', 'header');

		//breadcrumb/untuk navigasi
		$this->breadcrumb->clear();
		$this->breadcrumb->add_crumb('Beranda', site_url());
		$this->breadcrumb->add_crumb('Album', site_url('admin_album'));
		$this->breadcrumb->add_crumb('Tambah Album');

		//judul besar
		$data['primary_title'] = 'Data Master';
		$data['sub_primary_title'] = 'Tambah Data Album';

		//menggunakan theme back
		$this->layout->theme('back','admin_album/add', $data);
	}

	function save() {

		//rule type pada function ini: Create
		$this->rule->type('C');

		//ambil data dari form
		$album=$this->input->post('album');
		$slug=$this->m_album->create_slug($album);
		
		
		$dataInsert = array(
						'album' => $album,
						
						'slug' => $slug
					);

		if(!$this->m_album->save($dataInsert)){
			$this->session->set_flashdata('gagal', 'Data <b>'.$this->input->post('album').'</b> gagal ditambahkan.');
			redirect('admin_album','refresh');
		}else{
			$this->session->set_flashdata('sukses', 'Data <b>'.$this->input->post('album').'</b> berhasil ditambahkan.');
			redirect('admin_album','refresh');
		}

		
	}

	function edit($id_album = '') {

		//rule type pada function ini: Update
		$this->rule->type('U');

		//parameter yang dipelukan query
		$params = array($id_album);

		//layout
		//title
		$this->layout->set_title('Edit Data Album');

		//js tambahan
		$this->layout->set_include('js', 'themes/general/bundle/jquery_validation/jquery.validate.min.js', 'header');
		$this->layout->set_include('js', 'themes/general/bundle/jquery_validation/localization/messages_id.min.js', 'header');

		//breadcrumb/untuk navigasi
		$this->breadcrumb->clear();
		$this->breadcrumb->add_crumb('Beranda', site_url());
		$this->breadcrumb->add_crumb('Album', site_url('admin_album'));
		$this->breadcrumb->add_crumb('Edit Album');

		//judul besar
		$data['primary_title'] = 'Data Album';
		$data['sub_primary_title'] = 'Master Data Album';

		//ambil data dari model dengan berdasarkan parameter diatas
		$data['list'] = $this->m_album->get_by($params);

		//menggunakan theme back
		$this->layout->theme('back','admin_album/edit', $data);
	}

	function update() {

		//rule type pada function ini: Update
		$this->rule->type('U');
		$album=$this->input->post('album');
		//ambil data dari form
		$tmp_slug=strtolower($this->input->post('tmp_slug'));
		if(strtolower(url_title($album)) != $tmp_slug){
			$slug=$this->m_album->create_slug($album);
		}else{
			$slug=$tmp_slug;
		}
		
		
		$dataUpdate = array(
						'album' => $album,
						'slug' => $slug
					);
		$id_album = $this->input->post('id_album');
		

		if(!$this->m_album->update($id_album, $dataUpdate)){
			$this->session->set_flashdata('gagal', 'Data <b>'.$this->input->post('album').'</b> gagal diperbaharui.');
			redirect($this->input->post('redirurl'),'refresh');
		}else{
			$this->session->set_flashdata('sukses', 'Data <b>'.$this->input->post('album').'</b> berhasil diperbaharui.');
			redirect($this->input->post('redirurl'),'refresh');
		}
	}

	function delete($id_album = '') {

		//rule type pada function ini: Delete
		$this->rule->type('D');

		if(!$this->m_album->delete($id_album)){
			$this->session->set_flashdata('gagal', 'Data gagal dihapus.');
			redirect($_SERVER['HTTP_REFERER'],'refresh');
		}else{
			$this->session->set_flashdata('sukses', 'Data berhasil dihapus.');
			redirect($_SERVER['HTTP_REFERER'],'refresh');
		}
	}

	



}
