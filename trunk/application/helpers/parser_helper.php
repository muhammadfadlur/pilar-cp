<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

// theme url
if (!function_exists('theme_url')) {
	function theme_url($location = '') {
		$CI = &get_instance();

		return $CI->parser->theme_url($location);
	}
}

if (!function_exists('front_theme_url')) {
	function front_theme_url($location = '') {
		$CI = &get_instance();

		return $CI->parser->front_theme_url($location);
	}
}

if (!function_exists('back_theme_url')) {
	function back_theme_url($location = '') {
		$CI = &get_instance();

		return $CI->parser->back_theme_url($location);
	}
}

// css
if (!function_exists('css')) {
	function css($file_path, $attributes = array()) {
		$CI = &get_instance();

		echo $CI->parser->css($file_path, $attributes);
	}
}

if (!function_exists('front_css')) {
	function front_css($file_path, $attributes = array()) {
		$CI = &get_instance();

		echo $CI->parser->front_css($file_path, $attributes);
	}
}

if (!function_exists('back_css')) {
	function back_css($file_path, $attributes = array()) {
		$CI = &get_instance();

		echo $CI->parser->back_css($file_path, $attributes);
	}
}

// js
if (!function_exists('js')) {
	function js($file_path, $attributes = array()) {
		$CI = &get_instance();

		echo $CI->parser->js($file_path, $attributes);
	}
}

if (!function_exists('front_js')) {
	function front_js($file_path, $attributes = array()) {
		$CI = &get_instance();

		echo $CI->parser->front_js($file_path, $attributes);
	}
}

if (!function_exists('back_js')) {
	function back_js($file_path, $attributes = array()) {
		$CI = &get_instance();

		echo $CI->parser->back_js($file_path, $attributes);
	}
}

// image
if (!function_exists('image')) {
	function image($file_path, $attributes = array()) {
		$CI = &get_instance();

		echo $CI->parser->image($file_path, $attributes);
	}
}

if (!function_exists('front_image')) {
	function front_image($file_path, $attributes = array()) {
		$CI = &get_instance();

		echo $CI->parser->front_image($file_path, $attributes);
	}
}

if (!function_exists('back_image')) {
	function back_image($file_path, $attributes = array()) {
		$CI = &get_instance();

		echo $CI->parser->back_image($file_path, $attributes);
	}
}

if (!function_exists('userdata')) {
	function userdata($name) {
		$CI = &get_instance();

		return $CI->session->userdata($name);
	}
}

if (!function_exists('uriseg')) {
	function uriseg($segnum) {
		$CI = &get_instance();

		return $CI->uri->segment($segnum);
	}
}

if (!function_exists('flashdata')) {
	function flashdata($name) {
		$CI = &get_instance();

		return $CI->session->flashdata($name);
	}
}
