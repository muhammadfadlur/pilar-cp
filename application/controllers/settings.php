<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Settings extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('breadcrumb');
		$this->load->model('m_auth');
	}

	function index() {
		if (!$this->ion_auth->logged_in()) {
			redirect('login', 'refresh');
		} elseif (!$this->ion_auth->in_group(array($this->config->item('super_admin_group', 'ion_auth')))) {
			show_404();
		} elseif (isset($_POST) && !empty($_POST)) {
			$this->load->model('m_auth');

			$site_title = array('value' => $this->input->post('site_title'));
			$this->m_auth->site_titleUpdate($site_title);

			$site_tagline = array('value' => $this->input->post('site_tagline'));
			$this->m_auth->site_taglineUpdate($site_tagline);

			$site_desc = array('value' => $this->input->post('site_desc'));
			$this->m_auth->site_descUpdate($site_desc);

			$site_email = array('value' => $this->input->post('site_email'));
			$this->m_auth->site_emailUpdate($site_email);

			$group1 = array('value' => $this->input->post('group1'));
			$this->m_auth->group1Update($group1);

			$group2 = array('value' => $this->input->post('group2'));
			$this->m_auth->group2Update($group2);

			$group3 = array('value' => $this->input->post('group3'));
			$this->m_auth->group3Update($group3);

			$identity = array('value' => $this->input->post('identity'));
			$this->m_auth->identityUpdate($identity);

			redirect('settings', 'refresh');
		} else {
			$this->layout->set_title('Settings');
			$this->load->helper('options');

			$this->breadcrumb->clear();
			$this->breadcrumb->add_crumb('Dashboard', site_url('admin'));
			$this->breadcrumb->add_crumb('Settings');

			$this->layout->set_include('js', 'themes/general/bundle/jquery_validation/jquery.validate.min.js', 'header');

			$data['primary_title'] = "<i class='fa fa-gear'></i> Settings";
			$data['sub_primary_title'] = "General site settings";

			$data['groups'] = $this->ion_auth->groups()->result_array();

			$this->layout->theme('back','settings/index', $data);
		}
	}
}
