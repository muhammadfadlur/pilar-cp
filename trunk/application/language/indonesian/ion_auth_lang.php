<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Ion Auth Lang - Indonesian
* 
* Author: Toni Haryanto
* 		  toha.samba@gmail.com
*         @yllumi
* 
* Author: Daeng Muhammad Feisal
*         daengdoang@gmail.com
*         @daengdoang
* 
* Location: https://github.com/yllumi/CodeIgniter-Ion-Auth
*          
* Created:  11.15.2011
* Edited:   June 21st 2014 :D
* 
* Description:  Indonesian language file for Ion Auth messages and errors
* 
*/

// Account Creation
$lang['account_creation_successful'] 	  	 	= 'Akun berhasil dibuat';
$lang['account_creation_unsuccessful'] 	 	 	= 'Tidak dapat membuat akun';
$lang['account_creation_duplicate_email'] 	 	= 'Email sudah digunakan atau tidak valid';
$lang['account_creation_duplicate_username'] 	= 'Namapengguna sudah digunakan atau tidak valid';

// TODO Please Translate
$lang['account_creation_missing_default_group'] = 'Default group is not set';
$lang['account_creation_invalid_default_group'] = 'Invalid default group name set';


// Password
$lang['password_change_successful'] 	 	 	= 'Kata Sandi berhasil diubah';
$lang['password_change_unsuccessful'] 	  	 	= 'Tidak dapat mengganti Kata Sandi';
$lang['forgot_password_successful'] 	 	 	= 'Instruksi untuk set ulang Kata Sandi telah dikirim ke email Anda';
$lang['forgot_password_unsuccessful'] 	 	 	= 'Tidak dapat set ulang Kata Sandi';

// Activation
$lang['activate_successful'] 		  	 		= 'Akun telah diaktifkan';
$lang['activate_unsuccessful'] 		 	 		= 'Tidak dapat mengaktifkan akun';
$lang['deactivate_successful'] 		  	 		= 'Akun telah dinonaktifkan';
$lang['deactivate_unsuccessful'] 	  	 		= 'Tidak dapat menonaktifkan akun';
$lang['activation_email_successful'] 	  	 	= 'Email untuk aktivasi telah dikirim';
$lang['activation_email_unsuccessful']   	 	= 'Tidak dapat mengirimkan email aktivasi';

// Login / Logout
$lang['login_successful'] 		  	 			= 'Berhasil masuk aplikasi';
$lang['login_unsuccessful'] 		 			= 'Gagal masuk aplikasi';
$lang['login_unsuccessful_not_active'] 			= 'Pengguna tidak aktif';
$lang['login_timeout'] 							= 'Login timeout';
$lang['logout_successful'] 		 	 			= 'Berhasil keluar aplikasi';
  
// Account Changes
$lang['update_successful'] 		 	 			= 'Informasi akun berhasil diperbaharui';
$lang['update_unsuccessful'] 		 	 		= 'tidak dapat memperbaharui informasi akun';
$lang['delete_successful'] 		 	 			= 'Pengguna telah dihapus';
$lang['delete_unsuccessful'] 		 	 		= 'Tidak dapat menghapus pengguna';

// Email Subjects
$lang['email_forgotten_password_subject']    	= 'Verifikasi Lupa Kata Sandi';
$lang['email_new_password_subject']          	= 'Kata Sandi Baru';
$lang['email_activation_subject']            	= 'Aktivasi Akun';
