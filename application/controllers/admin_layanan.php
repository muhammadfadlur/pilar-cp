<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Admin_Layanan extends CI_Controller {

	function __construct() {
		parent::__construct();

		//jika digunakan di mayoritas function, panggil disini
		//model
		$this->load->model('m_layanan');

		//library breadcrum/untuk navigasi
		$this->load->library('breadcrumb');
		$this->path = './foto_layanan/';
	}

	function index() {

		//rule type pada function ini: Read
		$this->rule->type('R');

		//Layout
		//title
		$this->layout->set_title('Data Layanan');

		//meta description jika perlu
		$this->layout->set_desc('Data Layanan');

		//css tambahan bila perlu
		$this->layout->set_include('css', 'themes/back/css/datatables/dataTables.bootstrap.css');

		//breadcrumb/untuk navigasi
		$this->breadcrumb->clear();
		$this->breadcrumb->add_crumb('Beranda', site_url());
		$this->breadcrumb->add_crumb('Layanan', site_url('admin_layanan'));
		

		//paging dan ambil data dari model
		$this->load->library('paging');                         		//Load library "paging"
		$config['sql']      				= $this->m_layanan->get();//Query SQL - bukan array lho ya...
		$config['per_page'] 				= 3;                            //jumlah item tiap halaman
		$data = $this->paging->create_pagination($config);   				//Load fungsi di library "paging" untuk membuat pagination. 

		//judul besar
		$data['primary_title'] 			= '<i class="ion-android-note"></i> Master';
		$data['sub_primary_title'] 	= 'Data Layanan';

		//menghilangka session jika ada
		$this->session->unset_userdata('keyword');

		//menggunakan theme back
		$this->layout->theme('back','admin_layanan/index', $data);
	}

	function cari() {

		//rule type pada function ini: Read
		$this->rule->type('R');

		//Layout
		//title
		$this->layout->set_title('Cari Data Layanan');

		//meta description jika perlu
		$this->layout->set_desc('Data Layanan');

		//css tambahan bila perlu
		$this->layout->set_include('css', 'themes/back/css/datatables/dataTables.bootstrap.css');

		//js tambahan jika perlu
		$this->layout->set_include('js', 'themes/back/js/plugins/datatables/jquery.dataTables.js');
		$this->layout->set_include('js', 'themes/back/js/plugins/datatables/dataTables.bootstrap.js');

		//breadcrumb/untuk navigasi
		$this->breadcrumb->clear();
		$this->breadcrumb->add_crumb('Beranda', site_url());
		$this->breadcrumb->add_crumb('Layanan', site_url('admin_layanan'));
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
		$config['sql']      				= $this->m_layanan->get_cari($data['keyword']);//your SQL - bukan array lho ya...
		$config['per_page'] 				= 3;                            //Display items per page
		$data = $this->paging->create_pagination($config);   				//Load function in "paging" libraryfor create pagination. 

		//judul besar
		$data['primary_title'] 			= '<i class="ion-android-note"></i> Master';
		$data['sub_primary_title'] 		= 'Data Layanan';

		//menggunakan theme back
		$this->layout->theme('back','admin_layanan/index', $data);
	}

	function detail($id_layanan = '') {

		//rule type pada function ini: Read
		$this->rule->type('R');

		//parameter yang dipelukan query
		$params = array($id_layanan);

		//Layout
		//title
		$this->layout->set_title('Detail Layanan');

		//meta description jika perlu
		//$this->layout->set_desc($this->m_master_barang->get_ket($params));

		//breadcrumb/untuk navigasi
		$this->breadcrumb->clear();
		$this->breadcrumb->add_crumb('Beranda', site_url());
		$this->breadcrumb->add_crumb('Layanan', site_url('admin_layanan'));
		$this->breadcrumb->add_crumb('Detail Layanan');

		//judul besar
		$data['primary_title'] = '<i class="ion-android-note"></i> Master';
		$data['sub_primary_title'] = 'Data Layanan';

		//ambil data dari model dengan berdasarkan parameter diatas
		$data['list'] = $this->m_layanan->get_by($params);

		//menggunakan theme back
		$this->layout->theme('back','admin_layanan/detail', $data);
	}

	function add() {

		//rule type pada function ini: Create
		$this->rule->type('C');

		//Layout
		//title
		$this->layout->set_title('Tambah Data Layanan');

		//js tambahan
		$this->layout->set_include('js', 'themes/general/bundle/jquery_validation/jquery.validate.min.js', 'header');
		$this->layout->set_include('js', 'themes/general/bundle/jquery_validation/localization/messages_id.min.js', 'header');

		//breadcrumb/untuk navigasi
		$this->breadcrumb->clear();
		$this->breadcrumb->add_crumb('Beranda', site_url());
		$this->breadcrumb->add_crumb('Layanan', site_url('admin_layanan'));
		$this->breadcrumb->add_crumb('Tambah Layanan');

		//judul besar
		$data['primary_title'] = 'Data Master';
		$data['sub_primary_title'] = 'Tambah Data Layanan';

		//menggunakan theme back
		$this->layout->theme('back','admin_layanan/add', $data);
	}

	function save() {

		//rule type pada function ini: Create
		$this->rule->type('C');

		//ambil data dari form
		$nama_layanan=$this->input->post('nama_layanan');
		$slug=$this->m_layanan->create_slug($nama_layanan);
		
		//upload gambar
		if(!empty($_FILES['gambar']['name'])){
			$config = array(
			'allowed_types'=>'jpg|jpeg|gif|png',
			'upload_path' => $this->path,
			'max_size' => 2000);

			$this->load->library('upload',$config);
			$status_upload=$this->upload->do_upload('gambar');
			$image_data = $this->upload->data();
			//resize gambar
			$config = array(
			'source_image'=> $image_data['full_path'],
			'new_image'=>$this->path . '/thumbs',
			'maintain_ration'=>true,
			'width'=>160,
			'height'=>120);
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			//print_r($image_data);
			$nama_gambar=$image_data['file_name'];
		}else{
			$nama_gambar="";
			
		}
		$dataInsert = array(
						'layanan' => $nama_layanan,
						'gambar' => $nama_gambar, 
						'deskripsi' => $this->input->post('deskripsi'), 
						'slug' => $slug
					);

		if(!$this->m_layanan->save($dataInsert)){
			$this->session->set_flashdata('gagal', 'Data <b>'.$this->input->post('nama_layanan').'</b> gagal ditambahkan.');
			redirect('admin_layanan','refresh');
		}else{
			$this->session->set_flashdata('sukses', 'Data <b>'.$this->input->post('nama_layanan').'</b> berhasil ditambahkan.');
			redirect('admin_layanan','refresh');
		}

		
	}

	function edit($id_layanan = '') {

		//rule type pada function ini: Update
		$this->rule->type('U');

		//parameter yang dipelukan query
		$params = array($id_layanan);

		//layout
		//title
		$this->layout->set_title('Edit Data Layanan');

		//js tambahan
		$this->layout->set_include('js', 'themes/general/bundle/jquery_validation/jquery.validate.min.js', 'header');
		$this->layout->set_include('js', 'themes/general/bundle/jquery_validation/localization/messages_id.min.js', 'header');

		//breadcrumb/untuk navigasi
		$this->breadcrumb->clear();
		$this->breadcrumb->add_crumb('Beranda', site_url());
		$this->breadcrumb->add_crumb('Layanan', site_url('admin_layanan'));
		$this->breadcrumb->add_crumb('Edit Layanan');

		//judul besar
		$data['primary_title'] = 'Data Layanan';
		$data['sub_primary_title'] = 'Master Data Layanan';

		//ambil data dari model dengan berdasarkan parameter diatas
		$data['list'] = $this->m_layanan->get_by($params);

		//menggunakan theme back
		$this->layout->theme('back','admin_layanan/edit', $data);
	}

	function update() {

		//rule type pada function ini: Update
		$this->rule->type('U');
		$nama_layanan=$this->input->post('nama_layanan');
		//ambil data dari form
		$tmp_slug=strtolower($this->input->post('tmp_slug'));
		if(strtolower(url_title($nama_layanan)) != $tmp_slug){
			$slug=$this->m_layanan->create_slug($nama_layanan);
		}else{
			$slug=$tmp_slug;
		}
		
		//upload gambar
		if(!empty($_FILES['gambar']['name'])){
			$config = array(
			'allowed_types'=>'jpg|jpeg|gif|png',
			'upload_path' => $this->path,
			'max_size' => 2000);

			$this->load->library('upload',$config);
			$status_upload=$this->upload->do_upload('gambar');
			$image_data = $this->upload->data();
			//resize gambar
			$config = array(
			'source_image'=> $image_data['full_path'],
			'new_image'=>$this->path . '/thumbs',
			'maintain_ration'=>true,
			'width'=>160,
			'height'=>120);
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			//print_r($image_data);
			$nama_gambar=$image_data['file_name'];
		}else{
			$nama_gambar=$this->input->post('tmp_gambar');
			
		}
		$dataUpdate = array(
						'layanan' => $nama_layanan,
						'gambar' => $nama_gambar, 
						'deskripsi' => $this->input->post('deskripsi'), 
						'slug' => $slug
					);
		$id_layanan = $this->input->post('id_layanan');
		

		if(!$this->m_layanan->update($id_layanan, $dataUpdate)){
			$this->session->set_flashdata('gagal', 'Data <b>'.$this->input->post('nama_layanan').'</b> gagal diperbaharui.');
			redirect($this->input->post('redirurl'),'refresh');
		}else{
			$this->session->set_flashdata('sukses', 'Data <b>'.$this->input->post('nama_layanan').'</b> berhasil diperbaharui.');
			redirect($this->input->post('redirurl'),'refresh');
		}
	}

	function delete($id_layanan = '') {

		//rule type pada function ini: Delete
		$this->rule->type('D');

		if(!$this->m_layanan->delete($id_layanan)){
			$this->session->set_flashdata('gagal', 'Data gagal dihapus.');
			redirect($_SERVER['HTTP_REFERER'],'refresh');
		}else{
			$this->session->set_flashdata('sukses', 'Data berhasil dihapus.');
			redirect($_SERVER['HTTP_REFERER'],'refresh');
		}
	}

	



}
