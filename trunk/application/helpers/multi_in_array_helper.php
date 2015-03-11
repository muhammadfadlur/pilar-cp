<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

//in_array for multidimensional array
if (!function_exists('multi_in_array')) {

	function multi_in_array($value, $arr2ay) {
		foreach ($arr2ay AS $item) {
			if (!is_array($item)) {
				if ($item == $value) {
					return true;
				}
				continue;
			}

			if (in_array($value, $item)) {
				return true;
			} else if (multi_in_array($value, $item)) {
				return true;
			}
		}
		return false;
	}
}
