<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Smartytest extends CI_Controller {

	public function __construct() {
		parent::__construct();

		// Ideally you would autoload the parser
		$this->load->library('parser');
	}

	public function index() {
		// tetapkan title
		$this->parser->set_title('Ini judul layout');

		// tambahkan css
		$this->parser->set_include('css', 'path/to/file1.css');
		$this->parser->set_include('css', 'path/to/file2.css');

		// tambahkan js
		$this->parser->set_include('js', 'path/to/file1.js', 'header');
		$this->parser->set_include('js', 'path/to/file2.js');

		// contoh data
		$data['konten'] = "Ini contoh konten";

		// Load the template from the views directory
		$this->parser->theme('front','smartytest/smartytest', $data);
	}
}
