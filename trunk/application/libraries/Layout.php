<?php

//  Diambil dari https://github.com/rattrap/codeigniter-layout
// * Khoiruddin *

class Layout {
	private $ci;

	// the title for the layout
	private $layout_title;

	// the meta description for the layout
	private $meta_desc;

	// title separator
	// you can change this in the construct
	public $title_separator;

	// holds the css and js files
	private $includes;
	public function __construct() {
		$this->ci = &get_instance();
		$this->layout_title = NULL;
		$this->meta_desc = NULL;
		$this->title_separator = ' &bull; ';
		$this->includes = array();
	}

	public function set_title($title = NULL) {
		$this->layout_title = $title;
	}

	public function set_desc($meta = NULL) {
		$this->meta_desc = $meta;
	}

	public function set_include($type, $file, $options = NULL, $prepend_base_url = TRUE) {

		if ($prepend_base_url) {
			$this->ci->load->helper('url');
			$file = base_url() . $file;
		}

		$this->includes[$type][] = array('file' => $file, 'options' => $options);

		// allows chaining
		return $this;
	}

	public function theme($theme_folder, $layout, $data = array()) {

		// get the contents of the view and store it
		$view = $this->ci->load->view($theme_folder . '/layouts/' . $layout, $data, TRUE);

		// set the title
		$title = '';
		// jika bukan home
		if ($this->layout_title !== NULL && $this->ci->uri->segment(1)) {
			$title = $this->layout_title . $this->title_separator;

			// jika home

		} elseif ($this->layout_title !== NULL && !$this->ci->uri->segment(1)) {
			$title = $this->layout_title;
		}

		// set the meta
		$meta = '';
		if ($this->meta_desc !== NULL) {
			$meta = $this->meta_desc;
		} else {
			$meta = 'Made with love by Raksa Abadi Informatika';
		}

		$this->ci->load->view($theme_folder . '/base', array('layout_title' => $title, 'meta_desc' => $meta, 'layout_includes' => $this->includes, 'layout_content' => $view));
	}
}

/* End of file layout.php */

/* Location: ./application/libraries/layout.php */