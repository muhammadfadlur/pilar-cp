<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Tables extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('breadcrumb');
	}

	function index() {

		//rule type pada function ini: Read
		$this->rule->type('R');

		//Layout
		//title
		$this->layout->set_title('Tables');

		//meta description jika perlu
		$this->layout->set_desc('Made with love by Raksa Abadi Informatika');

		//breadcrumb/untuk navigasi
		$this->breadcrumb->clear();
		$this->breadcrumb->add_crumb('Beranda', site_url());
		$this->breadcrumb->add_crumb('Designs', site_url('dessigns'));
		$this->breadcrumb->add_crumb('Tables');

		//judul kategori
		$data['primary_title'] = '<i class="fa fa-edit"></i> Designs';
		$data['sub_primary_title'] = 'Variety of table design';

		//menggunakan theme back
		$this->layout->theme('back','designs/tables', $data);
	}
}
