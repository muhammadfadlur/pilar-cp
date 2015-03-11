<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Admin extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('breadcrumb');
	}

	function index() {
		if (!$this->ion_auth->logged_in()) {
			redirect('login', 'refresh');
		} elseif (!$this->ion_auth->in_group(array($this->config->item('super_admin_group', 'ion_auth'), $this->config->item('admin_group', 'ion_auth')))) {
			redirect(site_url(), 'refresh');
		} else {
			$this->layout->set_title('Dashboard');

			$this->breadcrumb->clear();
			$this->breadcrumb->add_crumb('Dashboard');

			$data['primary_title'] = "<i class='ion-ios7-home'></i> Dashboard";
			$data['sub_primary_title'] = "Main page";

			$this->layout->theme('back','admin/index', $data);
		}
	}
}
