<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Admin_Slider extends CI_Controller {

	function __construct() {
		parent::__construct();

		//jika digunakan di mayoritas function, panggil disini
		//model
		$this->load->model('m_slider');

		//library breadcrum/untuk navigasi
		$this->load->library('breadcrumb');
		$this->path = './foto_slider/';
	}

	function index() {

		//rule type pada function ini: Read
		$this->rule->type('R');

		//Layout
		//title
		$this->layout->set_title('Data Slider');

		//meta description jika perlu
		$this->layout->set_desc('Data Slider');

		//css tambahan bila perlu
		$this->layout->set_include('css', 'themes/back/css/datatables/dataTables.bootstrap.css');

		//breadcrumb/untuk navigasi
		$this->breadcrumb->clear();
		$this->breadcrumb->add_crumb('Beranda', site_url());
		$this->breadcrumb->add_crumb('Slider', site_url('admin_slider'));
		

		//paging dan ambil data dari model
		$this->load->library('paging');                         		//Load library "paging"
		$config['sql']      				= $this->m_slider->get();//Query SQL - bukan array lho ya...
		$config['per_page'] 				= 3;                            //jumlah item tiap halaman
		$data = $this->paging->create_pagination($config);   				//Load fungsi di library "paging" untuk membuat pagination. 

		//judul besar
		$data['primary_title'] 			= '<i class="ion-android-note"></i> Master';
		$data['sub_primary_title'] 	= 'Data Slider';

		//menghilangka session jika ada
		$this->session->unset_userdata('keyword');

		//menggunakan theme back
		$this->layout->theme('back','admin_slider/index', $data);
	}

	function cari() {

		//rule type pada function ini: Read
		$this->rule->type('R');

		//Layout
		//title
		$this->layout->set_title('Cari Data Slider');

		//meta description jika perlu
		$this->layout->set_desc('Data Slider');

		//css tambahan bila perlu
		$this->layout->set_include('css', 'themes/back/css/datatables/dataTables.bootstrap.css');

		//js tambahan jika perlu
		$this->layout->set_include('js', 'themes/back/js/plugins/datatables/jquery.dataTables.js');
		$this->layout->set_include('js', 'themes/back/js/plugins/datatables/dataTables.bootstrap.js');

		//breadcrumb/untuk navigasi
		$this->breadcrumb->clear();
		$this->breadcrumb->add_crumb('Beranda', site_url());
		$this->breadcrumb->add_crumb('Slider', site_url('admin_slider'));
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
		$config['sql']      				= $this->m_slider->get_cari($data['keyword']);//your SQL - bukan array lho ya...
		$config['per_page'] 				= 3;                            //Display items per page
		$data = $this->paging->create_pagination($config);   				//Load function in "paging" libraryfor create pagination. 

		//judul besar
		$data['primary_title'] 			= '<i class="ion-android-note"></i> Master';
		$data['sub_primary_title'] 		= 'Data Slider';

		//menggunakan theme back
		$this->layout->theme('back','admin_slider/index', $data);
	}

	function detail($id_slider = '') {

		//rule type pada function ini: Read
		$this->rule->type('R');

		//parameter yang dipelukan query
		$params = array($id_slider);

		//Layout
		//title
		$this->layout->set_title('Detail Slider');

		//meta description jika perlu
		//$this->layout->set_desc($this->m_master_barang->get_ket($params));

		//breadcrumb/untuk navigasi
		$this->breadcrumb->clear();
		$this->breadcrumb->add_crumb('Beranda', site_url());
		$this->breadcrumb->add_crumb('Slider', site_url('admin_slider'));
		$this->breadcrumb->add_crumb('Detail Slider');

		//judul besar
		$data['primary_title'] = '<i class="ion-android-note"></i> Master';
		$data['sub_primary_title'] = 'Data Slider';

		//ambil data dari model dengan berdasarkan parameter diatas
		$data['list'] = $this->m_slider->get_by($params);

		//menggunakan theme back
		$this->layout->theme('back','admin_slider/detail', $data);
	}

	function add() {

		//rule type pada function ini: Create
		$this->rule->type('C');

		//Layout
		//title
		$this->layout->set_title('Tambah Data Slider');

		//js tambahan
		$this->layout->set_include('js', 'themes/general/bundle/jquery_validation/jquery.validate.min.js', 'header');
		$this->layout->set_include('js', 'themes/general/bundle/jquery_validation/localization/messages_id.min.js', 'header');

		//breadcrumb/untuk navigasi
		$this->breadcrumb->clear();
		$this->breadcrumb->add_crumb('Beranda', site_url());
		$this->breadcrumb->add_crumb('Slider', site_url('admin_slider'));
		$this->breadcrumb->add_crumb('Tambah Slider');

		//judul besar
		$data['primary_title'] = 'Data Master';
		$data['sub_primary_title'] = 'Tambah Data Slider';

		//menggunakan theme back
		$this->layout->theme('back','admin_slider/add', $data);
	}

	function save() {

		//rule type pada function ini: Create
		$this->rule->type('C');

		//ambil data dari form
		$judul=$this->input->post('judul');
		
		
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
						'judul' => $judul,
						'gambar' => $nama_gambar
					);

		if(!$this->m_slider->save($dataInsert)){
			$this->session->set_flashdata('gagal', 'Data <b>'.$this->input->post('judul').'</b> gagal ditambahkan.');
			redirect('admin_slider','refresh');
		}else{
			$this->session->set_flashdata('sukses', 'Data <b>'.$this->input->post('judul').'</b> berhasil ditambahkan.');
			redirect('admin_slider','refresh');
		}

		
	}

	function edit($id_slider = '') {

		//rule type pada function ini: Update
		$this->rule->type('U');

		//parameter yang dipelukan query
		$params = array($id_slider);

		//layout
		//title
		$this->layout->set_title('Edit Data Slider');

		//js tambahan
		$this->layout->set_include('js', 'themes/general/bundle/jquery_validation/jquery.validate.min.js', 'header');
		$this->layout->set_include('js', 'themes/general/bundle/jquery_validation/localization/messages_id.min.js', 'header');

		//breadcrumb/untuk navigasi
		$this->breadcrumb->clear();
		$this->breadcrumb->add_crumb('Beranda', site_url());
		$this->breadcrumb->add_crumb('Slider', site_url('admin_slider'));
		$this->breadcrumb->add_crumb('Edit Slider');

		//judul besar
		$data['primary_title'] = 'Data Slider';
		$data['sub_primary_title'] = 'Master Data Slider';

		//ambil data dari model dengan berdasarkan parameter diatas
		$data['list'] = $this->m_slider->get_by($params);

		//menggunakan theme back
		$this->layout->theme('back','admin_slider/edit', $data);
	}

	function update() {

		//rule type pada function ini: Update
		$this->rule->type('U');
		$judul=$this->input->post('judul');
		//ambil data dari form
		
		
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
						'judul' => $judul,
						'gambar' => $nama_gambar
					);
		$id_slider = $this->input->post('id_slider');
		

		if(!$this->m_slider->update($id_slider, $dataUpdate)){
			$this->session->set_flashdata('gagal', 'Data <b>'.$this->input->post('judul').'</b> gagal diperbaharui.');
			redirect($this->input->post('redirurl'),'refresh');
		}else{
			$this->session->set_flashdata('sukses', 'Data <b>'.$this->input->post('judul').'</b> berhasil diperbaharui.');
			redirect($this->input->post('redirurl'),'refresh');
		}
	}

	function delete($id_slider = '') {

		//rule type pada function ini: Delete
		$this->rule->type('D');

		if(!$this->m_slider->delete($id_slider)){
			$this->session->set_flashdata('gagal', 'Data gagal dihapus.');
			redirect($_SERVER['HTTP_REFERER'],'refresh');
		}else{
			$this->session->set_flashdata('sukses', 'Data berhasil dihapus.');
			redirect($_SERVER['HTTP_REFERER'],'refresh');
		}
	}

	



}
