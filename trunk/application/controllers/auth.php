<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Auth extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->lang->load('auth');
		$this->load->helper('language');
	}

	function index() {

		//jika tidak login, redirect ke halaman login
		if (!$this->ion_auth->logged_in()) {
			redirect('login', 'refresh');

			//jika tidak termasuk grup admin atau super_admin

		} elseif (!$this->ion_auth->in_group(array($this->config->item('super_admin_group', 'ion_auth'), $this->config->item('admin_group', 'ion_auth')))) {
			show_404();

			//jika syarat terpenuhi, menuju ke halaman auth

		} else {

			//web title
			$this->layout->set_title('Authentication');

			//judul halaman
			$this->data['primary_title'] = "<i class='fa fa-fw fa-key'></i> Authentication";
			$this->data['sub_primary_title'] = "Access control settings";

			//breadcrumb
			$this->load->library('breadcrumb');
			$this->breadcrumb->clear();
			$this->breadcrumb->add_crumb('Dashboard', site_url('admin'));
			$this->breadcrumb->add_crumb('Authentication');

			//menggunakan theme back
			$this->layout->theme('back','auth/index', $this->data);
		}
	}

	//log the user in
	function login() {

		//validate form input
		$this->form_validation->set_rules('identity', 'Identity', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == true) {

			//check to see if the user is logging in
			//check for "remember me"
			$remember = (bool) $this->input->post('remember');

			if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)) {

				//if the login is successful
				//redirect them back to the home page
				$this->session->set_flashdata('message', $this->ion_auth->messages());

				//mengambil url sebelum ke halaman login (kecuali halaman logout)
				if (isset($_REQUEST['redirurl']) && $_REQUEST['redirurl'] != site_url('logout')) {
					$url = $_REQUEST['redirurl'];
				} else {
					if (!$this->ion_auth->in_group(array($this->config->item('super_admin_group', 'ion_auth'), $this->config->item('admin_group', 'ion_auth')))) {
						$url = site_url();
					} else {
						$url = site_url('admin');
					}
				}

				//dikembalikan ke halaman sebelum mengakses halaman login
				redirect($url, 'refresh');
			} else {

				//if the login was un-successful
				//redirect them back to the login page
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('login', 'refresh');

				//use redirects instead of loading views for compatibility with MY_Controller libraries

			}
		} else {

			//the user is not logging in so display the login page
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['identity'] = array('name' => 'identity', 'id' => 'identity', 'type' => 'text', 'value' => $this->form_validation->set_value('identity'), 'class' => 'form-control', 'placeholder' => 'Namapengguna');
			$this->data['password'] = array('name' => 'password', 'id' => 'password', 'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Kata Sandi');
			$this->load->view('back/layouts/auth/login', $this->data);
		}
	}

	//log the user out
	function logout() {

		//log the user out
		$logout = $this->ion_auth->logout();

		//redirect them to the login page
		$this->session->set_flashdata('message', $this->ion_auth->messages());
		redirect('login', 'refresh');
	}

	//change password
	function change_password() {
		$this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
		$this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
		$this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

		if (!$this->ion_auth->logged_in()) {
			redirect('login', 'refresh');
		}

		$user = $this->ion_auth->user()->row();

		if ($this->form_validation->run() == false) {

			//web title
			$this->layout->set_title('Ganti Kata Sandi');

			//judul halaman
			$this->data['primary_title'] = "<i class='fa fa-fw fa-key'></i> User Settings";
			$this->data['sub_primary_title'] = "Change password";

			//breadcrumb
			$this->load->library('breadcrumb');
			$this->breadcrumb->clear();
			$this->breadcrumb->add_crumb('Dashboard', site_url('admin'));
			$this->breadcrumb->add_crumb('User Profile', site_url('me'));
			$this->breadcrumb->add_crumb('Change Password');

			//display the form
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
			$this->data['old_password'] = array('name' => 'old', 'id' => 'old', 'type' => 'password', 'class' => 'form-control input-sm', 'placeholder' => 'Kata Sandi Lama');
			$this->data['new_password'] = array('name' => 'new', 'id' => 'new', 'type' => 'password', 'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$', 'class' => 'form-control input-sm', 'placeholder' => 'Kata Sandi baru, minimal ' . $this->data['min_password_length'] . ' karakter');
			$this->data['new_password_confirm'] = array('name' => 'new_confirm', 'id' => 'new_confirm', 'type' => 'password', 'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$', 'class' => 'form-control input-sm', 'placeholder' => 'Konfirmasi Kata Sandi Baru');
			$this->data['user_id'] = array('name' => 'user_id', 'id' => 'user_id', 'type' => 'hidden', 'value' => $user->id);

			$this->layout->theme('back','auth/change_password', $this->data);
		} else {
			$identity = $this->session->userdata('identity');
			$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

			if ($change) {

				//if the password was successfully changed
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect('me', 'refresh');
			} else {
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('change_password', 'refresh');
			}
		}
	}

	//forgot password
	function forgot_password() {

		//setting validation rules by checking wheather identity is username or email
		if ($this->config->item('identity', 'ion_auth') == 'username') {
			$this->form_validation->set_rules('email', $this->lang->line('forgot_password_username_identity_label'), 'required');
		} else {
			$this->form_validation->set_rules('email', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');
		}

		if ($this->form_validation->run() == false) {

			//setup the input
			$this->data['email'] = array('name' => 'email', 'id' => 'email', 'class' => 'form-control', 'placeholder' => 'Namapengguna');

			if ($this->config->item('identity', 'ion_auth') == 'username') {
				$this->data['identity_label'] = $this->lang->line('forgot_password_username_identity_label');
			} else {
				$this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
			}

			//set any errors and display the form
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->load->view('back/layouts/auth/forgot_password', $this->data);
		} else {

			// get identity from username or email
			if ($this->config->item('identity', 'ion_auth') == 'username') {
				$identity = $this->ion_auth->where('username', strtolower($this->input->post('email')))->users()->row();
			} else {
				$identity = $this->ion_auth->where('email', strtolower($this->input->post('email')))->users()->row();
			}
			if (empty($identity)) {

				if ($this->config->item('identity', 'ion_auth') == 'username') {
					$this->ion_auth->set_message('Namapengguna tidak terdaftar');
				} else {
					$this->ion_auth->set_message('Email tidak terdaftar');
				}

				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("auth/forgot_password", 'refresh');
			}

			//run the forgotten password method to email an activation code to the user
			$forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

			if ($forgotten) {

				//if there were no errors
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("login", 'refresh');

				//we should display a confirmation page here instead of the login page

			} else {
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("auth/forgot_password", 'refresh');
			}
		}
	}

	//reset password - final step for forgotten password
	public function reset_password($code = NULL) {
		if (!$code) {
			show_404();
		}

		$user = $this->ion_auth->forgotten_password_check($code);

		if ($user) {

			//if the code is valid then display the password reset form

			$this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
			$this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

			if ($this->form_validation->run() == false) {

				//display the form

				//set the flash data error message if there is one
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

				$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
				$this->data['new_password'] = array('name' => 'new', 'id' => 'new', 'type' => 'password', 'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$', 'class' => 'form-control', 'placeholder' => 'Kata Sandi baru, minimal ' . $this->data['min_password_length'] . ' karakter');
				$this->data['new_password_confirm'] = array('name' => 'new_confirm', 'id' => 'new_confirm', 'type' => 'password', 'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$', 'class' => 'form-control', 'placeholder' => 'Konfirmasi Kata Sandi');
				$this->data['user_id'] = array('name' => 'user_id', 'id' => 'user_id', 'type' => 'hidden', 'value' => $user->id);
				$this->data['code'] = $code;

				//render
				$this->load->view('back/layouts/auth/reset_password', $this->data);
			} else {

				// do we have a valid request?
				if ($user->id != $this->input->post('user_id')) {

					//something fishy might be up
					$this->ion_auth->clear_forgotten_password_code($code);
					show_404();
				} else {

					// finally change the password
					$identity = $user->{$this->config->item('identity', 'ion_auth')};

					$change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

					if ($change) {

						//if the password was successfully changed
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						$this->logout();
					} else {
						$this->session->set_flashdata('message', $this->ion_auth->errors());
						redirect('auth/reset_password/' . $code, 'refresh');
					}
				}
			}
		} else {

			//if the code is invalid then send them back to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}

	//activate the user
	function activate($id, $code = false) {
		if ($code !== false) {
			$activation = $this->ion_auth->activate($id, $code);
		} else if ($this->ion_auth->in_group(array($this->config->item('super_admin_group', 'ion_auth'), $this->config->item('admin_group', 'ion_auth')))) {
			$activation = $this->ion_auth->activate($id);
		}

		if ($activation) {

			//redirect them to the auth page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("auth/users", 'refresh');
		} else {

			//redirect them to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}

	//deactivate the user
	function deactivate($id = NULL) {

		//layout
		$this->layout->set_title('Nonaktifkan Pengguna');

		//judul
		$this->data['primary_title'] = "<i class='fa fa-fw fa-key'></i> Authentication";
		$this->data['sub_primary_title'] = "Access control settings";

		//breadcrumb
		$this->load->library('breadcrumb');
		$this->breadcrumb->clear();
		$this->breadcrumb->add_crumb('Dashboard', site_url('admin'));
		$this->breadcrumb->add_crumb('Authentication', site_url('auth'));
		$this->breadcrumb->add_crumb('Deactivate User', site_url('auth/deactivate/' . $id . ''));

		$id = (int) $id;

		$this->load->library('form_validation');
		$this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
		$this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

		if ($this->form_validation->run() == FALSE) {
			$this->data['user'] = $this->ion_auth->user($id)->row();
			$this->layout->theme('back','auth/deactivate_user', $this->data);
		} else {

			// do we really want to deactivate?
			if ($this->input->post('confirm') == 'yes') {

				// do we have a valid request?
				if ($id != $this->input->post('id')) {
					show_404();
				}

				// do we have the right userlevel?
				if ($this->ion_auth->logged_in() && $this->ion_auth->in_group(array($this->config->item('super_admin_group', 'ion_auth'), $this->config->item('admin_group', 'ion_auth')))) {
					$this->ion_auth->deactivate($id);
				}
			}

			//redirect them back to the auth page
			redirect('auth/users', 'refresh');
		}
	}

	//create a new user
	function create_user() {

		//jika tidak login, redirect ke halaman login
		if (!$this->ion_auth->logged_in()) {
			redirect('login', 'refresh');

			//jika tidak termasuk grup admin atau super_admin

		} elseif (!$this->ion_auth->in_group(array($this->config->item('super_admin_group', 'ion_auth'), $this->config->item('admin_group', 'ion_auth')))) {
			show_404();
		}

		$tables = $this->config->item('tables', 'ion_auth');

		//validate form input
		$this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required|xss_clean');
		$this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required|xss_clean');
		$this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
		$this->form_validation->set_rules('username', 'Namapengguna', 'required|is_unique[' . $tables['users'] . '.username]');
		$this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

		if ($this->form_validation->run() == true) {
			$username = strtolower($this->input->post('username'));
			$email = strtolower($this->input->post('email'));
			$password = $this->input->post('password');

			$additional_data = array('first_name' => $this->input->post('first_name'), 'last_name' => $this->input->post('last_name'), 'company' => '-', 'phone' => '-');
		}
		if ($this->form_validation->run() == true && $this->ion_auth->register($username, $password, $email, $additional_data)) {

			//check to see if we are creating the user
			//redirect them back to the admin page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("auth/users", 'refresh');
		} else {

			//layout
			$this->layout->set_title('Authentication');

			//judul
			$this->data['primary_title'] = "<i class='fa fa-fw fa-key'></i> Authentication";
			$this->data['sub_primary_title'] = "Access control settings";

			//breadcrumb
			$this->load->library('breadcrumb');
			$this->breadcrumb->clear();
			$this->breadcrumb->add_crumb('Dashboard', site_url('admin'));
			$this->breadcrumb->add_crumb('Authentication', site_url('auth'));
			$this->breadcrumb->add_crumb('Users', site_url('auth/users'));
			$this->breadcrumb->add_crumb('Create User');

			//display the create user form
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$this->data['first_name'] = array('name' => 'first_name', 'id' => 'first_name', 'type' => 'text', 'value' => $this->form_validation->set_value('first_name'), 'class' => 'form-control input-sm', 'placeholder' => 'Nama Lengkap');
			$this->data['last_name'] = array('name' => 'last_name', 'id' => 'last_name', 'type' => 'text', 'value' => $this->form_validation->set_value('last_name'), 'class' => 'form-control input-sm', 'placeholder' => 'Nama Panggilan');
			$this->data['email'] = array('name' => 'email', 'id' => 'email', 'type' => 'text', 'value' => $this->form_validation->set_value('email'), 'class' => 'form-control input-sm', 'placeholder' => 'Email');
			$this->data['username'] = array('name' => 'username', 'id' => 'username', 'type' => 'text', 'value' => $this->form_validation->set_value('username'), 'class' => 'form-control input-sm', 'placeholder' => 'Namapengguna');
			$this->data['password'] = array('name' => 'password', 'id' => 'password', 'type' => 'password', 'value' => $this->form_validation->set_value('password'), 'class' => 'form-control input-sm', 'placeholder' => 'Kata Sandi');
			$this->data['password_confirm'] = array('name' => 'password_confirm', 'id' => 'password_confirm', 'type' => 'password', 'value' => $this->form_validation->set_value('password_confirm'), 'class' => 'form-control input-sm', 'placeholder' => 'Konfirmasi Kata Sandi');

			$this->layout->theme('back','auth/create_user', $this->data);
		}
	}

	public function email_update_check_b($email) {

		//ambil id
		$id = $this->security->xss_clean($this->uri->segment(3));

		//untuk cek username unique update
		$Eparams = array($id, $email);
		$Esql = 'SELECT email FROM ' . $this->tables['users'] . ' WHERE id != ? AND email = ?';
		$Equery = $this->db->query($Esql, $Eparams);

		if ($Equery->num_rows() > 0) {
			$this->form_validation->set_message('email_update_check_b', 'Email ' . $email . ' telah digunakan, coba ganti yang lain.');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function username_update_check_b($uname) {

		//ambil id
		$id = $this->security->xss_clean($this->uri->segment(3));

		//untuk cek username unique update
		$Uparams = array($id, $uname);
		$Usql = 'SELECT username FROM ' . $this->tables['users'] . ' WHERE id != ? AND username = ?';
		$Uquery = $this->db->query($Usql, $Uparams);

		if ($Uquery->num_rows() > 0) {
			$this->form_validation->set_message('username_update_check_b', 'Namapengguna ' . $uname . ' telah digunakan, coba ganti yang lain.');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	//edit a user
	function edit_user($id) {
		if (!$this->ion_auth->logged_in()) {
			redirect('login', 'refresh');

			//jika tidak termasuk grup admin atau super_admin

		} elseif (!$this->ion_auth->in_group(array($this->config->item('super_admin_group', 'ion_auth'), $this->config->item('admin_group', 'ion_auth'))) && !($this->ion_auth->user()->row()->id == $id)) {
			show_404();
		}

		$this->load->model('m_auth');

		$user = $this->ion_auth->user($id)->row();
		if (!$this->ion_auth->in_group($this->config->item('super_admin_group', 'ion_auth'))) {
			$groups = $this->m_auth->get_groups_only_and_where_not_sa()->result_array();
		} else {
			$groups = $this->ion_auth->groups()->result_array();
		}
		$currentGroups = $this->ion_auth->get_users_groups($id)->result();

		//validate form input
		$this->form_validation->set_rules('first_name', 'Nama Lengkap', 'required|xss_clean');
		$this->form_validation->set_rules('last_name', 'Nama Panggilan', 'required|xss_clean');
		$this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'required|xss_clean');
		$this->form_validation->set_rules('username', 'Namapengguna', 'required|callback_username_update_check_b|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'callback_email_update_check_b|xss_clean');
		$this->form_validation->set_rules('company', $this->lang->line('edit_user_validation_company_label'), 'required|xss_clean');
		$this->form_validation->set_rules('groups', $this->lang->line('edit_user_validation_groups_label'), 'xss_clean');

		if (isset($_POST) && !empty($_POST)) {

			//update the password if it was posted
			if ($this->input->post('password')) {
				$this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
				$this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
			}

			if ($this->form_validation->run() === TRUE) {
				$data = array('first_name' => $this->input->post('first_name'), 'last_name' => $this->input->post('last_name'), 'username' => strtolower($this->input->post('username')), 'email' => strtolower($this->input->post('email')), 'company' => $this->input->post('company'), 'phone' => $this->input->post('phone'));

				//update the password if it was posted
				if ($this->input->post('password')) {
					$data['password'] = $this->input->post('password');
				}

				// Only allow updating groups if user is admin or super_admin
				if ($this->ion_auth->in_group(array($this->config->item('super_admin_group', 'ion_auth'), $this->config->item('admin_group', 'ion_auth')))) {

					//Update the groups user belongs to
					$groupData = $this->input->post('groups');

					if (isset($groupData) && !empty($groupData)) {

						$this->ion_auth->remove_from_group('', $id);

						foreach ($groupData as $grp) {
							$this->ion_auth->add_to_group($grp, $id);
						}
						$ok = 'okeh';
					} else {
						$ok = 'noh';
					}
				}

				//check to see if we are updating the user
				if ($this->ion_auth->update($user->id, $data) && $ok == 'okeh') {

					//redirect them back to the admin page if admin, or to the base url if non admin
					$this->session->set_flashdata('message', $this->ion_auth->messages());
					if ($this->ion_auth->in_group(array($this->config->item('super_admin_group', 'ion_auth'), $this->config->item('admin_group', 'ion_auth')))) {
						redirect('auth/users', 'refresh');
					} else {
						redirect('/', 'refresh');
					}
				} else {

					//redirect them back to the admin page if admin, or to the base url if non admin
					$this->session->set_flashdata('message', $this->ion_auth->errors());
					if ($this->ion_auth->in_group(array($this->config->item('super_admin_group', 'ion_auth'), $this->config->item('admin_group', 'ion_auth')))) {
						redirect('auth/users', 'refresh');
					} else {
						redirect('/', 'refresh');
					}
				}
			}
		}

		//layout
		$this->layout->set_title('Edit Pengguna');

		//judul
		$this->data['primary_title'] = "<i class='fa fa-fw fa-key'></i> Authentication";
		$this->data['sub_primary_title'] = "Access control settings";

		//breadcrumb
		$this->load->library('breadcrumb');
		$this->breadcrumb->clear();
		$this->breadcrumb->add_crumb('Dashboard', site_url('admin'));
		$this->breadcrumb->add_crumb('Authentication', site_url('auth'));
		$this->breadcrumb->add_crumb('Users', site_url('auth/users'));
		$this->breadcrumb->add_crumb('Edit User');

		//display the edit user form
		//set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		//pass the user to the view
		$this->data['user'] = $user;
		$this->data['groups'] = $groups;
		$this->data['currentGroups'] = $currentGroups;

		$this->data['first_name'] = array('name' => 'first_name', 'id' => 'first_name', 'type' => 'text', 'value' => $this->form_validation->set_value('first_name', $user->first_name), 'class' => 'form-control input-sm', 'placeholder' => 'Nama Lengkap');
		$this->data['last_name'] = array('name' => 'last_name', 'id' => 'last_name', 'type' => 'text', 'value' => $this->form_validation->set_value('last_name', $user->last_name), 'class' => 'form-control input-sm', 'placeholder' => 'Nama Panggilan');
		$this->data['username'] = array('name' => 'username', 'id' => 'username', 'type' => 'text', 'value' => $this->form_validation->set_value('username', $user->username), 'class' => 'form-control input-sm', 'placeholder' => 'Namapengguna');
		$this->data['email'] = array('name' => 'email', 'id' => 'email', 'type' => 'text', 'value' => $this->form_validation->set_value('email', $user->email), 'class' => 'form-control input-sm', 'placeholder' => 'Belum ada');
		$this->data['company'] = array('name' => 'company', 'id' => 'company', 'type' => 'hidden', 'value' => '-', 'class' => 'form-control input-sm', 'placeholder' => 'Nama Perusahaan');
		$this->data['phone'] = array('name' => 'phone', 'id' => 'phone', 'type' => 'hidden', 'value' => '-', 'class' => 'form-control input-sm', 'placeholder' => 'Telepon');
		$this->data['password'] = array('name' => 'password', 'id' => 'password', 'type' => 'password', 'class' => 'form-control input-sm', 'placeholder' => 'Sandi, tetap kosongkan jika tidak diganti');
		$this->data['password_confirm'] = array('name' => 'password_confirm', 'id' => 'password_confirm', 'type' => 'password', 'class' => 'form-control input-sm', 'placeholder' => 'Konfirmasi Sandi');

		$this->layout->theme('back','auth/edit_user', $this->data);
	}

	//delete a user
	function delete_user($id) {
		if (!$this->ion_auth->logged_in()) {
			redirect('login', 'refresh');

			//jika tidak termasuk grup admin atau super_admin

		} elseif (!$this->ion_auth->in_group(array($this->config->item('super_admin_group', 'ion_auth'), $this->config->item('admin_group', 'ion_auth'))) && !($this->ion_auth->user()->row()->id == $id)) {
			show_404();
		}

		$this->load->model('m_auth');
		if ($this->m_auth->delete_user($id)) {
			$this->session->set_flashdata('message', 'Pengguna berhasil dihapus');
		} else {
			$this->session->set_flashdata('message', 'Pengguna gagal dihapus');
		}
		redirect('auth/users');
	}

	// create a new group
	function create_group() {

		//jika tidak login, redirect ke halaman login
		if (!$this->ion_auth->logged_in()) {
			redirect('login', 'refresh');

			//jika tidak termasuk grup admin atau super_admin

		} elseif (!$this->ion_auth->in_group(array($this->config->item('super_admin_group', 'ion_auth'), $this->config->item('admin_group', 'ion_auth')))) {
			show_404();
		}

		//validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'required|alpha_dash|xss_clean');
		$this->form_validation->set_rules('description', $this->lang->line('create_group_validation_desc_label'), 'xss_clean');

		if ($this->form_validation->run() == TRUE) {
			$new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));

			$role_ids = $this->input->post('roles');
			if ($new_group_id) {
				$id = $this->db->insert_id();
				if (isset($role_ids) && !empty($role_ids)) {
					foreach ($role_ids as $role_id) {
						$dataInsert = array('group_id' => $id, 'role_id' => $role_id);
						$this->load->model('m_auth');
						$this->m_auth->insert_groups_role($dataInsert);
					}
				}
			}
			if ($new_group_id) {

				// check to see if we are creating the group
				// redirect them back to the admin page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("auth/groups", 'refresh');
			}
		} else {

			//layout
			$this->layout->set_title('Tambah Grup Baru');

			//judul
			$this->data['primary_title'] = "<i class='fa fa-fw fa-key'></i> Authentication";
			$this->data['sub_primary_title'] = "Access control settings";

			//breadcrumb
			$this->load->library('breadcrumb');
			$this->breadcrumb->clear();
			$this->breadcrumb->add_crumb('Dashboard', site_url('admin'));
			$this->breadcrumb->add_crumb('Authentication', site_url('auth'));
			$this->breadcrumb->add_crumb('Users Groups', site_url('auth/groups'));
			$this->breadcrumb->add_crumb('Create Users Groups');

			//display the create group form
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$this->load->model('m_auth');
			$this->data['roles'] = $this->m_auth->get_roles();

			$this->data['group_name'] = array('name' => 'group_name', 'id' => 'group_name', 'type' => 'text', 'value' => $this->form_validation->set_value('group_name'), 'class' => 'form-control input-sm', 'placeholder' => 'Nama Grup');
			$this->data['description'] = array('name' => 'description', 'id' => 'description', 'type' => 'text', 'value' => $this->form_validation->set_value('description'), 'class' => 'form-control input-sm', 'placeholder' => 'Deskripsi Grup');

			$this->layout->theme('back','auth/create_group', $this->data);
		}
	}

	//edit a group
	function edit_group($id) {

		//jika tidak login, redirect ke halaman login
		if (!$this->ion_auth->logged_in()) {
			redirect('login', 'refresh');

			//jika tidak termasuk grup admin atau super_admin

		} elseif (!$this->ion_auth->in_group(array($this->config->item('super_admin_group', 'ion_auth'), $this->config->item('admin_group', 'ion_auth'))) || !$id || empty($id)) {
			show_404();
		}

		$this->load->model('m_auth');
		$group = $this->ion_auth->group($id)->row();
		$roles = $this->m_auth->get_roles();
		$currentRoles = $this->m_auth->get_permissions_by_group_id($id);

		//validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'required|alpha_dash|xss_clean');
		$this->form_validation->set_rules('group_description', $this->lang->line('edit_group_validation_desc_label'), 'xss_clean');
		$this->form_validation->set_rules('roles', 'Role Grup', 'xss_clean');

		if (isset($_POST) && !empty($_POST)) {
			if ($this->form_validation->run() === TRUE) {

				//update grup
				$dataUpdate = array('name' => $this->input->post('group_name'), 'description' => $this->input->post('group_description'));
				$group_update = $this->m_auth->update_group($id, $dataUpdate);

				if ($group_update) {
					$delete_groups_role = $this->m_auth->delete_groups_role($id);
				}

				// echo "<pre>";
				$roles = $this->input->post('roles');
				$c = $this->input->post('c');
				$r = $this->input->post('r');
				$u = $this->input->post('u');
				$d = $this->input->post('d');

				if ($roles > 0) {
					foreach ($roles as $key => $value) {
						$roles_rules[$key] = array('role_id' => $value, 'c' => $c[$key], 'r' => $r[$key], 'd' => $d[$key], 'u' => $u[$key]);
					}
				}

				if (isset($roles_rules) && !empty($roles_rules)) {
					if ($delete_groups_role) {
						foreach ($roles_rules as $role_and_rule) {
							$dataInsert = array('group_id' => $id, 'role_id' => $role_and_rule['role_id'], 'rule' => $role_and_rule['c'] . $role_and_rule['r'] . $role_and_rule['u'] . $role_and_rule['d']);
							$sukses = $this->m_auth->insert_groups_role($dataInsert);
						}
					}
				} else {
					$sukses = $group_update;
				}

				if ($sukses) {
					$this->session->set_flashdata('message', $this->lang->line('edit_group_saved'));
				} else {
					$this->session->set_flashdata('message', 'Belum berhasil diupdate');
				}
				redirect("auth/groups", 'refresh');
			}
		}

		//layout
		$this->layout->set_title('Edit Grup Pengguna');

		//judul
		$this->data['primary_title'] = "<i class='fa fa-fw fa-key'></i> Authentication";
		$this->data['sub_primary_title'] = "Access control settings";

		//breadcrumb
		$this->load->library('breadcrumb');
		$this->breadcrumb->clear();
		$this->breadcrumb->add_crumb('Dashboard', site_url('admin'));
		$this->breadcrumb->add_crumb('Authentication', site_url('auth'));
		$this->breadcrumb->add_crumb('Users Groups', site_url('auth/groups'));
		$this->breadcrumb->add_crumb('Edit Users Groups');

		//set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		//pass the user to the view
		$this->data['group'] = $group;
		$this->data['roles'] = $roles;
		$this->data['currentRoles'] = $currentRoles;

		$this->data['group_name'] = array('name' => 'name', 'id' => 'name', 'type' => 'text', 'value' => $this->form_validation->set_value('group_name', ucwords(str_replace('_', ' ', $group->name))), 'class' => 'form-control input-sm', 'placeholder' => 'Nama Grup', 'readonly' => 'readonly');
		$this->data['group_name_hide'] = array('name' => 'group_name', 'id' => 'group_name', 'type' => 'hidden', 'value' => $this->form_validation->set_value('group_name', $group->name), 'class' => 'form-control input-sm', 'placeholder' => 'Nama Grup', 'readonly' => 'readonly');
		$this->data['group_description'] = array('name' => 'group_description', 'id' => 'group_description', 'type' => 'text', 'value' => $this->form_validation->set_value('group_description', $group->description), 'class' => 'form-control input-sm', 'placeholder' => 'Deskripsi Grup');

		$this->layout->theme('back','auth/edit_group', $this->data);
	}

	//delete a group
	function delete_group($id) {

		//jika tidak login, redirect ke halaman login
		if (!$this->ion_auth->logged_in()) {
			redirect('login', 'refresh');

			//jika tidak termasuk grup admin atau super_admin

		} elseif (!$this->ion_auth->in_group(array($this->config->item('super_admin_group', 'ion_auth'), $this->config->item('admin_group', 'ion_auth'))) || !$id || empty($id)) {
			show_404();
		}
		$this->load->model('m_auth');
		if ($this->m_auth->delete_group($id)) {
			$this->session->set_flashdata('message', 'Grup berhasil dihapus');
		} else {
			$this->session->set_flashdata('message', 'Grup gagal dihapus');
		}
		redirect('auth/groups');
	}

	function users() {

		if (!$this->ion_auth->logged_in()) {
			redirect('login', 'refresh');

			//jika tidak termasuk grup admin atau super_admin

		} elseif (!$this->ion_auth->in_group(array($this->config->item('super_admin_group', 'ion_auth'), $this->config->item('admin_group', 'ion_auth')))) {
			show_404();
		} else {

			//$this->load->model('m_auth');
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->load->model('m_auth');

			//list the users
			if (!$this->ion_auth->in_group($this->config->item('super_admin_group', 'ion_auth'))) {
				$this->data['users'] = $this->m_auth->get_users_not_sa()->result();
				foreach ($this->data['users'] as $k => $user) {
					$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
				}
			} else {
				$this->data['users'] = $this->ion_auth->users()->result();
				foreach ($this->data['users'] as $k => $user) {
					$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
				}
			}

			//layout
			$this->layout->set_title('Pengguna');

			//judul
			$this->data['primary_title'] = "<i class='fa fa-fw fa-key'></i> Authentication";
			$this->data['sub_primary_title'] = "Access control settings";

			//breadcrumb
			$this->load->library('breadcrumb');
			$this->breadcrumb->clear();
			$this->breadcrumb->add_crumb('Dashboard', site_url('admin'));
			$this->breadcrumb->add_crumb('Authentication', site_url('auth'));
			$this->breadcrumb->add_crumb('Users');

			$this->layout->theme('back','auth/users', $this->data);
		}
	}

	//grup pengguna
	function groups() {

		if (!$this->ion_auth->logged_in()) {
			redirect('login', 'refresh');

			//jika tidak termasuk grup admin atau super_admin

		} elseif (!$this->ion_auth->in_group(array($this->config->item('super_admin_group', 'ion_auth'), $this->config->item('admin_group', 'ion_auth')))) {
			show_404();
		} else {

			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->load->model('m_auth');
			$this->load->helper('multi_in_array');
			if (!$this->ion_auth->in_group($this->config->item('super_admin_group', 'ion_auth'))) {
				$this->data['list'] = $this->m_auth->get_groups_not_sa();
			} else {
				$this->data['list'] = $this->m_auth->get_groups_all();
			}

			//layout
			$this->layout->set_title('Grup Pengguna');

			//judul
			$this->data['primary_title'] = "<i class='fa fa-fw fa-key'></i> Authentication";
			$this->data['sub_primary_title'] = "Access control settings";

			//breadcrumb
			$this->load->library('breadcrumb');
			$this->breadcrumb->clear();
			$this->breadcrumb->add_crumb('Dashboard', site_url('admin'));
			$this->breadcrumb->add_crumb('Authentication', site_url('auth'));
			$this->breadcrumb->add_crumb('Users Groups');

			$this->layout->theme('back','auth/groups', $this->data);
		}
	}

	//role
	function roles() {

		if (!$this->ion_auth->logged_in()) {
			redirect('login', 'refresh');

			//jika tidak termasuk grup admin atau super_admin

		} elseif (!$this->ion_auth->in_group(array($this->config->item('super_admin_group', 'ion_auth')))) {
			show_404();
		} else {

			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->load->model('m_auth');
			$this->data['list'] = $this->m_auth->get_roles();

			//layout
			$this->layout->set_title('Role Grup');

			//judul
			$this->data['primary_title'] = "<i class='fa fa-fw fa-key'></i> Authentication";
			$this->data['sub_primary_title'] = "Access control settings";

			//breadcrumb
			$this->load->library('breadcrumb');
			$this->breadcrumb->clear();
			$this->breadcrumb->add_crumb('Dashboard', site_url('admin'));
			$this->breadcrumb->add_crumb('Authentication', site_url('auth'));
			$this->breadcrumb->add_crumb('Roles Groups');

			$this->layout->theme('back','auth/roles', $this->data);
		}
	}

	// create a new role
	function create_role() {
		if (!$this->ion_auth->logged_in()) {
			redirect('login', 'refresh');

			//jika tidak termasuk grup admin atau super_admin

		} elseif (!$this->ion_auth->in_group(array($this->config->item('super_admin_group', 'ion_auth')))) {
			show_404();
		} else {
			$this->load->model('m_auth');

			//validate form input
			$this->form_validation->set_rules('role_name', 'Nama Role Grup', 'required|xss_clean');
			$this->form_validation->set_rules('role_url', 'URL Role Grup', 'is_unique[' . $this->tables['roles'] . '.url]|required|xss_clean');
			$this->form_validation->set_rules('role_desc', 'Deskripsi Role Grup', 'xss_clean');

			if ($this->form_validation->run() == TRUE) {
				$dataInsert = array('name' => $this->input->post('role_name'), 'category_id' => $this->input->post('kat'), 'url' => strtolower($this->input->post('role_url')), 'desc' => $this->input->post('role_desc'), 'parent' => $this->input->post('parent'));
				$new_role_id = $this->m_auth->create_role($dataInsert);

				if ($new_role_id) {
					$this->session->set_flashdata('message', 'Role Grup berhasil ditambahkan');
					redirect("auth/roles", 'refresh');
				}
			} else {

				//layout
				$this->layout->set_title('Tambah Role Grup Baru');

				//judul
				$this->data['primary_title'] = "<i class='fa fa-fw fa-key'></i> Authentication";
				$this->data['sub_primary_title'] = "Access control settings";

				//breadcrumb
				$this->load->library('breadcrumb');
				$this->breadcrumb->clear();
				$this->breadcrumb->add_crumb('Dashboard', site_url('admin'));
				$this->breadcrumb->add_crumb('Authentication', site_url('auth'));
				$this->breadcrumb->add_crumb('Roles Groups', site_url('auth/roles'));
				$this->breadcrumb->add_crumb('Create Roles Groups');

				//roles category
				$this->data['list_cat'] = $this->m_auth->get_roles_category();

				$this->layout->theme('back','auth/create_role', $this->data);
			}
		}
	}

	function edit_role($id = '') {
		if (!$this->ion_auth->logged_in()) {
			redirect('login', 'refresh');

			//jika tidak termasuk grup admin atau super_admin

		} elseif (!$this->ion_auth->in_group(array($this->config->item('super_admin_group', 'ion_auth'))) || !$id || empty($id)) {
			show_404();
		} else {
			$this->load->model('m_auth');
			$this->layout->set_title('Edit Data Role');

			$this->load->library('breadcrumb');
			$this->breadcrumb->clear();
			$this->breadcrumb->add_crumb('Dashboard', site_url('admin'));
			$this->breadcrumb->add_crumb('Authentication', site_url('auth'));
			$this->breadcrumb->add_crumb('Roles Groups', site_url('auth/roles'));
			$this->breadcrumb->add_crumb('Edit Roles Groups');

			$data['primary_title'] = "<i class='fa fa-fw fa-key'></i> Authentication";
			$data['sub_primary_title'] = "Access control settings";

			$data['list'] = $this->m_auth->get_role_by_id($id);

			$this->layout->theme('back','auth/edit_role', $data);
		}
	}

	function update_role() {
		if (!$this->ion_auth->logged_in()) {
			redirect('login', 'refresh');

			//jika tidak termasuk grup admin atau super_admin

		} elseif (!$this->ion_auth->in_group(array($this->config->item('super_admin_group', 'ion_auth')))) {
			show_404();
		} else {

			//load model
			$this->load->model('m_auth');

			//untuk cek unique update
			$params = array($id = $this->input->post('id'), $url = $this->input->post('role_url'));
			$sql = 'SELECT url FROM ' . $this->tables['roles'] . ' WHERE id != ? AND url = ?';
			$query = $this->db->query($sql, $params);

			//validate form input
			$this->form_validation->set_rules('role_name', 'Nama Role Grup', 'required|xss_clean');
			$this->form_validation->set_rules('role_url', 'URL Role Grup', 'required|xss_clean');
			$this->form_validation->set_rules('role_desc', 'Deskripsi Role Grup', 'xss_clean');

			//jika validasi berjalan
			if ($this->form_validation->run() == FALSE) {

				//semua error validasi ditampung kedalam flashdata
				$errors = validation_errors();
				$this->session->set_flashdata('message', $errors);
				redirect('auth/edit_role/' . $id);

				//jika dalam tabel roles terdapat url yang sama dengan url yang ber-id selian dengan id role ini

			} elseif ($query->num_rows() > 0) {
				$url_exist = $this->input->post('role_url');
				$this->session->set_flashdata('message', 'URL Role Grup ' . $url_exist . ' telah digunakan, coba ganti yang lain.');
				redirect('auth/edit_role/' . $id);

				//jika tidak ada masalah, update data

			} else {
				$dataUpdate = array('name' => $this->input->post('role_name'), 'url' => $this->input->post('role_url'), 'desc' => $this->input->post('role_desc'), 'parent' => $this->input->post('parent'));
				$updateRole = $this->m_auth->update_role($id, $dataUpdate);

				//jika berhasil update
				if ($updateRole) {
					$this->session->set_flashdata('message', 'Role Grup berhasil diupdate');
					redirect("auth/roles", 'refresh');

					//jika gagal update

				} else {
					$this->session->set_flashdata('message', 'Role Grup gagal diupdate');
					redirect('auth/roles');
				}
			}
		}
	}

	//delete a role
	function delete_role($id) {
		if (!$this->ion_auth->logged_in()) {
			redirect('login', 'refresh');

			//jika tidak termasuk grup admin atau super_admin

		} elseif (!$this->ion_auth->in_group(array($this->config->item('super_admin_group', 'ion_auth'))) || !$id || empty($id)) {
			show_404();
		}
		$this->load->model('m_auth');
		if ($this->m_auth->delete_role($id)) {
			$this->session->set_flashdata('message', 'Role berhasil dihapus');
		} else {
			$this->session->set_flashdata('message', 'Role gagal dihapus');
		}
		redirect('auth/roles');
	}

	//roles category
	function roles_cat() {
		if (!$this->ion_auth->logged_in()) {
			redirect('login', 'refresh');

			//jika tidak termasuk grup admin atau super_admin

		} elseif (!$this->ion_auth->in_group(array($this->config->item('super_admin_group', 'ion_auth')))) {
			show_404();
		} else {

			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->load->model('m_auth');
			$this->data['list'] = $this->m_auth->get_roles_category();
			$this->data['roles_cat_id'] = $this->m_auth->get_roles_cat_id_at_roles();

			$this->load->helper('multi_in_array');

			//layout
			$this->layout->set_title('Kategori Role');

			//judul
			$this->data['primary_title'] = "<i class='fa fa-fw fa-key'></i> Authentication";
			$this->data['sub_primary_title'] = "Access control settings";

			//breadcrumb
			$this->load->library('breadcrumb');
			$this->breadcrumb->clear();
			$this->breadcrumb->add_crumb('Dashboard', site_url('admin'));
			$this->breadcrumb->add_crumb('Authentication', site_url('auth'));
			$this->breadcrumb->add_crumb('Roles Categories');

			$this->layout->theme('back','auth/roles_cat', $this->data);
		}
	}

	// create role category
	function create_roles_cat() {
		if (!$this->ion_auth->logged_in()) {
			redirect('login', 'refresh');

			//jika tidak termasuk grup admin atau super_admin

		} elseif (!$this->ion_auth->in_group(array($this->config->item('super_admin_group', 'ion_auth')))) {
			show_404();
		} else {
			$this->load->model('m_auth');

			//validate form input
			$this->form_validation->set_rules('category', 'Kategori Role', 'is_unique[' . $this->tables['roles_category'] . '.category]|required|xss_clean');

			if ($this->form_validation->run() == TRUE) {
				$dataInsert = array('category' => $this->input->post('category'), 'icon_code' => $this->input->post('icon_code'), 'order_number' => $this->input->post('order_number'));
				$new_cat_id = $this->m_auth->create_roles_cat($dataInsert);

				if ($new_cat_id) {
					$this->session->set_flashdata('message', 'Kategori Role berhasil ditambahkan');
					redirect("auth/roles_cat", 'refresh');
				}
			} else {

				//layout
				$this->layout->set_title('Tambah Kategori Role Baru');

				//judul
				$this->data['primary_title'] = "<i class='fa fa-fw fa-key'></i> Authentication";
				$this->data['sub_primary_title'] = "Access control settings";

				//breadcrumb
				$this->load->library('breadcrumb');
				$this->breadcrumb->clear();
				$this->breadcrumb->add_crumb('Dashboard', site_url('admin'));
				$this->breadcrumb->add_crumb('Authentication', site_url('auth'));
				$this->breadcrumb->add_crumb('Roles Categories', site_url('auth/roles_cat'));
				$this->breadcrumb->add_crumb('Create Roles Category');

				$this->layout->theme('back','auth/create_roles_cat', $this->data);
			}
		}
	}

	//edit role category
	function edit_roles_cat($id = '') {
		if (!$this->ion_auth->logged_in()) {
			redirect('login', 'refresh');

			//jika tidak termasuk grup admin atau super_admin

		} elseif (!$this->ion_auth->in_group(array($this->config->item('super_admin_group', 'ion_auth'))) || !$id || empty($id)) {
			show_404();
		} else {
			$this->load->model('m_auth');
			$this->layout->set_title('Edit Kategori Role');

			$this->load->library('breadcrumb');
			$this->breadcrumb->clear();
			$this->breadcrumb->add_crumb('Dashboard', site_url('admin'));
			$this->breadcrumb->add_crumb('Authentication', site_url('auth'));
			$this->breadcrumb->add_crumb('Roles Categories', site_url('auth/roles_cat'));
			$this->breadcrumb->add_crumb('Edit Roles Category');

			$data['primary_title'] = "<i class='fa fa-fw fa-key'></i> Authentication";
			$data['sub_primary_title'] = "Access control settings";

			$data['list'] = $this->m_auth->get_role_cat_by($id);

			$this->layout->theme('back','auth/edit_roles_cat', $data);
		}
	}

	//edit kategori role
	function update_roles_cat() {
		if (!$this->ion_auth->logged_in()) {
			redirect('login', 'refresh');

			//jika tidak termasuk grup admin atau super_admin

		} elseif (!$this->ion_auth->in_group(array($this->config->item('super_admin_group', 'ion_auth')))) {
			show_404();
		} else {

			//load model
			$this->load->model('m_auth');

			//untuk cek unique update
			$params = array($id = $this->input->post('id'), $url = $this->input->post('category'));
			$sql = 'SELECT category FROM ' . $this->tables['roles_category'] . ' WHERE id != ? AND category = ?';
			$query = $this->db->query($sql, $params);
			if (!$id || empty($id)) {
				redirect('auth/roles', 'refresh');
			} else {

				//validate form input
				$this->form_validation->set_rules('category', 'Kategori Role', 'required|xss_clean');

				//jika validasi berjalan
				if ($this->form_validation->run() == FALSE) {

					//semua error validasi ditampung kedalam flashdata
					$errors = validation_errors();
					$this->session->set_flashdata('message', $errors);
					redirect('auth/edit_roles_cat/' . $id);

					//jika dalam tabel roles terdapat url yang sama dengan url yang ber-id selian dengan id role ini

				} elseif ($query->num_rows() > 0) {
					$cat_exist = $this->input->post('category');
					$this->session->set_flashdata('message', 'Kategori Role ' . $cat_exist . ' telah digunakan, coba ganti yang lain.');
					redirect('auth/edit_roles_cat/' . $id);

					//jika tidak ada masalah, update data

				} else {
					$dataUpdate = array('category' => $this->input->post('category'), 'icon_code' => $this->input->post('icon_code'), 'order_number' => $this->input->post('order_number'));
					$updateCatRole = $this->m_auth->update_roles_cat($id, $dataUpdate);

					//jika berhasil update
					if ($updateCatRole) {
						$this->session->set_flashdata('message', 'Kategori Role berhasil diupdate');
						redirect("auth/roles_cat", 'refresh');

						//jika gagal update

					} else {
						$this->session->set_flashdata('message', 'Kategori Role gagal diupdate');
						redirect('auth/roles_cat');
					}
				}
			}
		}
	}

	//delete a roles category
	function delete_roles_cat($id) {
		if (!$this->ion_auth->logged_in()) {
			redirect('login', 'refresh');

			//jika tidak termasuk grup admin atau super_admin

		} elseif (!$this->ion_auth->in_group(array($this->config->item('super_admin_group', 'ion_auth'))) || !$id || empty($id)) {
			show_404();
		}
		$this->load->model('m_auth');
		if ($this->m_auth->delete_roles_cat($id)) {
			$this->session->set_flashdata('message', 'Kategori Role berhasil dihapus');
		} else {
			$this->session->set_flashdata('message', 'Role gagal dihapus');
		}
		redirect('auth/roles_cat');
	}

	public function email_update_check($email) {

		//ambil data user aktif
		$user = $this->ion_auth->user()->row();

		//untuk cek username unique update
		$Eparams = array($id = $user->id, $email);
		$Esql = 'SELECT email FROM ' . $this->tables['users'] . ' WHERE id != ? AND email = ?';
		$Equery = $this->db->query($Esql, $Eparams);

		if ($Equery->num_rows() > 0) {
			$this->form_validation->set_message('email_update_check', 'Email ' . $email . ' telah digunakan, coba ganti yang lain.');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function username_update_check($uname) {

		//ambil data user aktif
		$user = $this->ion_auth->user()->row();

		//untuk cek username unique update
		$Uparams = array($id = $user->id, $url = $uname);
		$Usql = 'SELECT username FROM ' . $this->tables['users'] . ' WHERE id != ? AND username = ?';
		$Uquery = $this->db->query($Usql, $Uparams);

		if ($Uquery->num_rows() > 0) {
			$this->form_validation->set_message('username_update_check', 'Namapengguna ' . $uname . ' telah digunakan, coba ganti yang lain.');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	function me() {
		if (!$this->ion_auth->logged_in()) {
			redirect('auth', 'refresh');
		} else {
			$this->load->model('m_auth');

			//validate form input
			$this->form_validation->set_rules('first_name', 'Nama Depan', 'required|xss_clean');
			$this->form_validation->set_rules('last_name', 'Panggilan', 'required|xss_clean');
			$this->form_validation->set_rules('username', 'Namapengguna', 'required|alpha_numeric|xss_clean|callback_username_update_check');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|xss_clean|callback_email_update_check');
			$this->form_validation->set_rules('phone', 'Telepon', 'required|xss_clean');

			//ambil data user aktif
			$user = $this->ion_auth->user()->row();
			$id = $user->id;

			//jika update
			if (isset($_POST) && !empty($_POST)) {

				// do we have a valid request?
				if ($id != $this->input->post('id')) {
					show_404();
				}

				if ($this->form_validation->run() === TRUE) {
					$data = array('first_name' => $this->input->post('first_name'), 'last_name' => $this->input->post('last_name'), 'username' => strtolower($this->input->post('username')), 'email' => strtolower($this->input->post('email')), 'phone' => $this->input->post('phone'));

					if ($this->ion_auth->update($user->id, $data)) {
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						redirect('me', 'refresh');
					} else {

						//redirect them back to the admin page if admin, or to the base url if non admin
						$this->session->set_flashdata('message', $this->ion_auth->errors());
						redirect('me', 'refresh');
					}
				}
			}

			//title
			$this->layout->set_title('Profil Pengguna');

			//breadcrumb/untuk navigasi
			$this->load->library('breadcrumb');
			$this->breadcrumb->clear();
			$this->breadcrumb->add_crumb('Dashboard', site_url('admin'));
			$this->breadcrumb->add_crumb('Profil Pengguna');

			//judul besar
			$data['primary_title'] = '<i class="ion-person"></i> Pengaturan Pengguna';
			$data['sub_primary_title'] = 'Halaman Pengaturan Pengguna';

			//belum tau buat apa kok pake ini segala
			//display the edit user form
			//set the flash data error message if there is one
			$data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			//ambil data pengguna aktif
			$data['user'] = $user;

			$data['first_name'] = array('name' => 'first_name', 'id' => 'first_name', 'type' => 'text', 'value' => $this->form_validation->set_value('first_name', $user->first_name), 'class' => 'form-control input-sm', 'placeholder' => 'Nama Lengkap');
			$data['last_name'] = array('name' => 'last_name', 'id' => 'last_name', 'type' => 'text', 'value' => $this->form_validation->set_value('last_name', $user->last_name), 'class' => 'form-control input-sm', 'placeholder' => 'Nama Panggilan');
			$data['username'] = array('name' => 'username', 'id' => 'username', 'type' => 'text', 'value' => $this->form_validation->set_value('username', $user->username), 'class' => 'form-control input-sm', 'placeholder' => 'Namapengguna');
			$data['email'] = array('name' => 'email', 'id' => 'email', 'type' => 'text', 'value' => $this->form_validation->set_value('email', $user->email), 'class' => 'form-control input-sm', 'placeholder' => 'Email');
			$data['phone'] = array('name' => 'phone', 'id' => 'phone', 'type' => 'hidden', 'value' => $this->form_validation->set_value('phone', $user->phone), 'class' => 'form-control input-sm', 'placeholder' => 'Telepon');

			//menggunakan theme back
			$this->layout->theme('back','auth/me', $data);
		}
	}
}
