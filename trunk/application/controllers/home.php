<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Home extends CI_Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		$this->load->helper('options');
		// lebih jelasnya liat helper options
		$this->load->helper('id_date');
		// lebih jelasnya liat helper options
		$this->layout->set_title(site_title() . ' &bull; ' . site_tagline());
		$this->layout->set_desc('Made with love by Raksa Abadi Informatika');
		$this->layout->theme('front','home/index');
	}
}

/* End of file welcome.php */

/* Location: ./application/controllers/home.php */
