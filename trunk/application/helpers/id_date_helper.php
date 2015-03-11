<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

if (!function_exists('id_date')) {
	function id_date($date, $option = NULL, $delimiter = NULL) {

		$theDate = explode(",", date("w,d,n,Y", strtotime($date)));
		$wday = $theDate[0];
		$date = $theDate[1];
		$month = $theDate[2];
		$year = $theDate[3];

		$months = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Okotober", "November", "Desember");
		$month2 = intval($month) - 1;
		$days = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");

		if (isset($date) && (!isset($option) || $option == 'short')) {
			return $date . '/' . $month . '/' . $year;
			//02/2/2015

		} elseif (isset($date) && (!isset($option) || $option == 'short') && isset($delimiter)) {
			return $date . $delimiter . $month . $delimiter . $year;
			// 02-2-2015

		} elseif (isset($date) && $option !== 'short' && $option !== 'long' && $option !== 'longday' && $option !== 'bulan') {
			return $date . $option . $month . $option . $year;
			// 02-2-2015

		} elseif (isset($date) && $option == 'long' && !isset($delimiter)) {
			return $date . ' ' . $months[$month2] . ' ' . $year;
			// 02 Februari 2015

		} elseif (isset($date) && $option == 'long' && isset($delimiter)) {
			return $date . $delimiter . $months[$month2] . $delimiter . $year;
			// 02-Februari-2015

		} elseif (isset($date) && $option == 'longday') {
			return $days[$wday] . ', ' . $date . ' ' . $months[$month2] . ' ' . $year;
			// Senin, 02 Februari 2015

		} elseif (isset($date) && isset($option) && $option == 'bulan') {
			return $months[$month2];
			//  Februari

		} else {
			return 'Aduh, coba baca panduan id_date()';
		}
	}
}

if (!function_exists('jam')) {
	function bulanDropdown($name = "month", $selected = null, $class = null) {
		$dd = '<select name="' . $name . '" class="' . $class . '" id="' . $name . '">';
		$months = array(1 => 'Januari', 2 => 'Fabruari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember');

		/*** the current month ***/
		$selected = is_null($selected) ? date('n', time()) : $selected;
		for ($i = 1; $i <= 12; $i++) {
			$dd .= '<option value="' . $i . '"';
			if ($i == $selected) {
				$dd .= ' selected';
			}

			/*** get the month ***/
			$dd .= '>' . $months[$i] . '</option>';
		}
		$dd .= '</select>';
		return $dd;
	}
}

if (!function_exists('iddate2dbdate')) {
	function iddate2dbdate($tgl = null) {
		if (isset($tgl)) {
			$tanggal = substr($tgl, 0, 2);
			$bulan = substr($tgl, 3, 2);
			$tahun = substr($tgl, 6, 4);
			$date = $tahun . "-" . $bulan . "-" . $tanggal;
		} else {
			$date = 'Aduh masih salah';
		}
		return $date;
	}
}

if (!function_exists('jam')) {
	function jam($datetime) {
		return substr($datetime, 11, 8);
	}
}
