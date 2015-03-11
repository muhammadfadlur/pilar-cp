<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Designs extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('breadcrumb');
	}

	function index() {
		$this->rule->type('R');
		$this->layout->set_title('Designs');
		$this->layout->set_meta('Made with love by Raksa Abadi Informatika');

		$this->breadcrumb->clear();
		$this->breadcrumb->add_crumb('Beranda', site_url());
		$this->breadcrumb->add_crumb('Designs');

		//judul kategori
		$data['primary_title'] = '<i class="fa fa-edit"></i> Designs';
		$data['sub_primary_title'] = 'Variety of design';

		//menggunakan theme back
		$this->layout->theme('back','designs/index', $data);
	}
}
