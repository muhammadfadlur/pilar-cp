<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class MY_Parser extends CI_Parser {

	protected $CI;
	private $layout_title;
	private $meta_desc;
	public $title_separator;

	public function __construct() {

		// Codeigniter instance and other required libraries/files
		$this->CI = get_instance();
		$this->CI->load->library('smarty');
		$this->CI->load->helper('parser');
		$this->CI->load->helper('options');

		$this->layout_title = NULL;
		$this->meta_desc = NULL;
		$this->title_separator = ' &bull; ';
		$this->includes = array();
	}

	public function set_title($title = NULL) {
		$this->layout_title = $title;
	}

	public function set_desc($desc = NULL) {
		$this->meta_desc = $desc;
	}

	public function set_include($type, $file, $options = NULL, $prepend_base_url = TRUE) {
		if ($prepend_base_url) {
			$this->CI->load->helper('url');
			$file = base_url() . $file;
		}

		$this->includes[$type][] = array('file' => $file, 'options' => $options);

		// allows chaining
		return $this;
	}

	/**
	 * Call
	 * able to call native Smarty methods
	 * @returns mixed
	 */
	public function __call($method, $params = array()) {
		if (!method_exists($this, $method)) {
			return call_user_func_array(array($this->CI->smarty, $method), $params);
		}
	}

	protected function _add_paths() {

		// Iterate over our saved locations and find the file
		foreach ($this->_template_locations AS $location) {
			$this->CI->smarty->addTemplateDir($location);
		}
	}
	
	// mendaftarkan path theme ke Smarty
	protected function _set_theme_path($theme_folder) {

		// Store a whole heap of template locations
		$this->_template_locations = array(APPPATH . 'views/' . $theme_folder . '/', APPPATH . 'views/'. $theme_folder .'/layouts/');

		// Will add paths into Smarty for "smarter" inheritance and inclusion
		$this->_add_paths();
	}

	public function theme($theme_folder, $layout, $data = array(), $return = FALSE, $caching = TRUE, $base = 'base') {
		// jika tidak menghendaki caching, maka di disable
		if ($caching === FALSE) {
			$this->CI->smarty->disable_caching();
		}

		// jika tidak ada extensi maka menggunakan config extensi
		// base template
		if (!stripos($base, '.')) {
			$base = $base . '.' . $this->CI->smarty->template_ext;
		}

		// layout template
		if (!stripos($layout, '.')) {
			$layout = $layout . '.' . $this->CI->smarty->template_ext;
		}

		// mengambil dan mengeset theme path
		$this->_set_theme_path($theme_folder);

		// variabel-variabel yang mau di parsing dengan smarty (jika ada)
		if (!empty($data)) {
			foreach ($data AS $key => $val) {
				$this->CI->smarty->assign($key, $val);
			}
		}

		// set the title
		$title = '';
		// jika bukan home
		if ($this->layout_title !== NULL && $this->CI->uri->segment(1)) {
			$title = $this->layout_title . $this->title_separator . site_title();

			// jika home

		} elseif (base_url(uri_string()) == site_url()) {
			$title = site_title() . $this->title_separator . site_tagline();
		}

		// set the meta desc
		$desc = '';
		// jika meta desc diisi
		if ($this->meta_desc !== NULL) {
			$desc = $this->meta_desc;
		} else {
			$desc = 'Made with Love by Raksa Abadi Informatika';
		}

		// untuk title tiap layout
		$this->CI->smarty->assign('layout_title', $title);

		// untuk meta description tiap layout
		$this->CI->smarty->assign('meta_desc', $desc);

		// mengambil konten dari layout dan dijadikan variabel $layout_includes untuk dipanggil di base template
		$this->CI->smarty->assign('layout_includes', $this->includes);

		// mengambil konten dari layout dan dijadikan variabel $body untuk dipanggil di base template
		$this->CI->smarty->assign('body', $this->CI->smarty->fetch($layout));

		// Load our template into our string for judgement
		$base_string = $this->CI->smarty->fetch($base);

		// If we're returning the templates contents, we're displaying the template
		if ($return === FALSE) {
			$this->CI->output->append_output($base_string);
			return TRUE;
		}

		// We're returning the contents, fo' shizzle
		return $base_string;
	}

	public function no_theme($theme_folder, $layout, $data = array(), $return = FALSE, $caching = TRUE, $plain = 'plain') {
		// jika tidak menghendaki caching, maka di disable
		if ($caching === FALSE) {
			$this->CI->smarty->disable_caching();
		}

		// jika tidak ada extensi maka menggunakan config extensi
		// plain (polos) template
		if (!stripos($plain, '.')) {
			$plain = $plain . '.' . $this->CI->smarty->template_ext;
		}

		// layout template
		if (!stripos($layout, '.')) {
			$layout = $layout . '.' . $this->CI->smarty->template_ext;
		}

		// mengambil dan mengeset theme path
		$this->_set_theme_path($theme_folder);

		// variabel-variabel yang mau di parsing dengan smarty (jika ada)
		if (!empty($data)) {
			foreach ($data AS $key => $val) {
				$this->CI->smarty->assign($key, $val);
			}
		}

		// mengambil konten dari layout dan dijadikan variabel $body untuk dipanggil di base template
		$this->CI->smarty->assign('body', $this->CI->smarty->fetch($layout));

		// Load our template into our string for judgement
		$base_string = $this->CI->smarty->fetch($plain);

		// If we're returning the templates contents, we're displaying the template
		if ($return === FALSE) {
			$this->CI->output->append_output($base_string);
			return TRUE;
		}

		// We're returning the contents, fo' shizzle
		return $base_string;
	}

	public function css($file_path) {
		$return = '<link rel="stylesheet" href="' . base_url($file_path) . '">';
		return $return;
	}

	public function front_css($file_path) {
		$return = '<link rel="stylesheet" href="' . base_url('themes/front/' . $file_path) . '">';
		return $return;
	}

	public function back_css($file_path) {
		$return = '<link rel="stylesheet" href="' . base_url('themes/back/' . $file_path) . '">';
		return $return;
	}

	public function js($file_path) {
		$return = '<script src="' . base_url($file_path) . '"></script>';
		return $return;
	}

	public function front_js($file_path) {
		$return = '<script src="' . base_url('themes/front/' . $file_path) . '"></script>';
		return $return;
	}

	public function back_js($file_path) {
		$return = '<script src="' . base_url('themes/back/' . $file_path) . '"></script>';
		return $return;
	}

	public function image($file_path, $attributes = array()) {
		$defaults = array('alt' => '', 'title' => '');

		$attributes = array_merge($defaults, $attributes);

		$return = '<img src ="' . base_url($file_path) . '" alt="' . $attributes['alt'] . '" title="' . $attributes['title'] . '" />';

		return $return;
	}

	public function front_image($file_path, $attributes = array()) {
		$defaults = array('alt' => '', 'title' => '');

		$attributes = array_merge($defaults, $attributes);

		$return = '<img src ="' . base_url('themes/front/' . $file_path) . '" alt="' . $attributes['alt'] . '" title="' . $attributes['title'] . '" />';

		return $return;
	}

	public function back_image($file_path, $attributes = array()) {
		$defaults = array('alt' => '', 'title' => '');

		$attributes = array_merge($defaults, $attributes);

		$return = '<img src ="' . base_url('themes/back/' . $file_path) . '" alt="' . $attributes['alt'] . '" title="' . $attributes['title'] . '" />';

		return $return;
	}

	public function theme_url($location = '') {

		// The path to return
		$return = base_url('themes') . "/";

		// If we want to add something to the end of the theme URL
		if ($location !== '') {
			$return = $return . $location;
		}

		return trim($return);
	}

	public function front_theme_url($location = '') {

		// The path to return
		$return = base_url(config_item('smarty.front_theme_path')) . "/";

		// If we want to add something to the end of the theme URL
		if ($location !== '') {
			$return = $return . $location;
		}

		return trim($return);
	}

	public function back_theme_url($location = '') {

		// The path to return
		$return = base_url(config_item('smarty.back_theme_path')) . "/";

		// If we want to add something to the end of the theme URL
		if ($location !== '') {
			$return = $return . $location;
		}

		return trim($return);
	}
}