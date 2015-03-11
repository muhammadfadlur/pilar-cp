<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

if (!function_exists('site_title')) {
	function site_title($value = '') {
		$CI = &get_instance();
		$CI->load->database();

		$sql = 'SELECT value FROM ' . $CI->tables['options'] . ' WHERE name = "site_title"';
		$CI->db->cache_on();
		$query = $CI->db->query($sql)->result_array();
		foreach ($query as $kolom) {
			$val = $kolom['value'];
		}
		return $val;
	}
}

if (!function_exists('site_tagline')) {
	function site_tagline($value = '') {
		$CI = &get_instance();
		$CI->load->database();

		$sql = 'SELECT value FROM ' . $CI->tables['options'] . ' WHERE name = "site_tagline"';
		$CI->db->cache_on();
		$query = $CI->db->query($sql)->result_array();
		foreach ($query as $kolom) {
			$val = $kolom['value'];
		}
		return $val;
	}
}

if (!function_exists('site_desc')) {
	function site_desc($value = '') {
		$CI = &get_instance();
		$CI->load->database();

		$sql = 'SELECT value FROM ' . $CI->tables['options'] . ' WHERE name = "site_desc"';
		$CI->db->cache_on();
		$query = $CI->db->query($sql)->result_array();
		foreach ($query as $kolom) {
			$val = $kolom['value'];
		}
		return $val;
	}
}

if (!function_exists('site_email')) {
	function site_email($value = '') {
		$CI = &get_instance();
		$CI->load->database();

		$sql = 'SELECT value FROM ' . $CI->tables['options'] . ' WHERE name = "admin_email"';
		$CI->db->cache_on();
		$query = $CI->db->query($sql)->result_array();
		foreach ($query as $kolom) {
			$val = $kolom['value'];
		}
		return $val;
	}
}

if (!function_exists('super_admin_group')) {
	function super_admin_group($value = '') {
		$CI = &get_instance();
		$CI->load->database();

		$sql = 'SELECT value FROM ' . $CI->tables['options'] . ' WHERE name = "super_admin_group"';
		$CI->db->cache_on();
		$query = $CI->db->query($sql)->result_array();
		foreach ($query as $kolom) {
			$val = $kolom['value'];
		}
		return $val;
	}
}

if (!function_exists('admin_group')) {
	function admin_group($value = '') {
		$CI = &get_instance();
		$CI->load->database();

		$sql = 'SELECT value FROM ' . $CI->tables['options'] . ' WHERE name = "admin_group"';
		$CI->db->cache_on();
		$query = $CI->db->query($sql)->result_array();
		foreach ($query as $kolom) {
			$val = $kolom['value'];
		}
		return $val;
	}
}

if (!function_exists('default_group')) {
	function default_group($value = '') {
		$CI = &get_instance();
		$CI->load->database();

		$sql = 'SELECT value FROM ' . $CI->tables['options'] . ' WHERE name = "default_group"';
		$CI->db->cache_on();
		$query = $CI->db->query($sql)->result_array();
		foreach ($query as $kolom) {
			$val = $kolom['value'];
		}
		return $val;
	}
}

if (!function_exists('identity')) {
	function identity($value = '') {
		$CI = &get_instance();
		$CI->load->database();

		$sql = 'SELECT value FROM ' . $CI->tables['options'] . ' WHERE name = "identity"';
		$CI->db->cache_on();
		$query = $CI->db->query($sql)->result_array();
		foreach ($query as $kolom) {
			$val = $kolom['value'];
		}
		return $val;
	}
}
