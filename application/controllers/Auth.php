<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	var $template = 'templates/index';

	public $session;
	public $form_validation;
	public $M_auth;
	public $input;
	public $db;
	public $email;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_auth');
	}

	public function index()
	{
		$cookies = $this->input->cookie('session');

		if ($cookies == '') {
			$this->load->view('client/login/login');
		} else {
			redirect('Home');
		}
	}

	public function login_client()
	{
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == TRUE) {
			$post_email = trim($_POST['email']);
			$post_pass = trim($_POST['password']);
			$data = $this->M_auth->login_customer($post_email, $post_pass);

			if ($data == false) {
				$this->session->set_flashdata('result_login', '<br>Email atau Password yang anda masukkan salah.');

				redirect('Auth');
			} else {
				if ($_POST) {
					$id_customer = $data->email;
				} else {
					if (isset($_COOKIE['id-customer'])) {
						$data->email = $id_customer  = $_COOKIE['id-customer'];
					}
				}
				// Set Cookie 7  hari
				if (isset($_POST['remember'])) {
					setcookie('session', $data->email, strtotime('+7 days'), '/');
					$msg = 'Data cookie berhasil disimpan';
					redirect('Home');
				}
			}
		} else {
			$this->session->set_flashdata('result_login', '<br>email Dan Password Harus Diisi.');
			redirect('Auth');
		}
	}

	function insert_password()
	{
		$password = $_POST['password'];
		$email = $_POST['email'];

		if ($_POST) {
			$email = $_POST['email'];
		} else {
			if (isset($_COOKIE['id-customer'])) {
				$_POST['email'] = $email  = $_COOKIE['id-customer'];
			}
		}
		// Set Cookie 7  hari
		if (isset($_POST['remember'])) {
			setcookie('session', $_POST['email'], strtotime('+7 days'), '/');
			// $msg = 'Data cookie berhasil disimpan';
			// echo $msg . '--' . $email;
			$this->M_auth->m_insert_password($password, $email);
		}
	}
	function regist_akun()
	{
		$email = $_POST['email'];
		$this->db->select("email");
		$this->db->where("email", $email);
		$query_ = $this->db->get('customer');
		if ($query_->num_rows() == 0) {
			$data = [

				'email' => $_POST['email'],
				'nm_customer' => $_POST['nama'],
				'tgl_lahir' => $_POST['tgl_lahir'],
				'gender' => $_POST['gender'],
				'kontak' => $_POST['kontak'],
				'no_identitas' => $_POST['no_identitas'],
				'kota' => $_POST['kota'],
				'password' => md5($_POST['password']),
			];
			$this->M_auth->m_insert_regist($data);
			if ($_POST) {
				$email = $_POST['email'];
			} else {
				if (isset($_COOKIE['id-customer'])) {
					$_POST['email'] = $email  = $_COOKIE['id-customer'];
				}
			}
			// Set Cookie 7  hari
			if (isset($_POST['remember'])) {
				setcookie('session', $_POST['email'], strtotime('+7 days'), '/');
				redirect('Home');
			}
		} else {
			$this->session->set_flashdata('result_login', '<br>Email sudah terdaftar');
			redirect('Auth');
		}
	}

	function login()
	{
		$session_status = $this->session->userdata('status');
		$session_privilege = $this->session->userdata('privilage');
		if ($session_status == '') {
			$this->load->view('page_admin/login/login');
		} else {
			if ($session_privilege == 'scan') {
				redirect('Scan_tiket');
			} else if ($session_privilege == 'sales') {
				redirect('Dash_sales');
			} else {
				redirect('Dashboard');
			}
		}
	}

	public function login_adm()
	{
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == TRUE) {
			$email = trim($this->input->post('email'));
			$password = trim($this->input->post('password'));

			// Check login in both models
			$data_admin = $this->M_auth->login($email, $password);
			$data_sales = $this->M_auth->login_sales($email, $password);

			if ($data_admin) {
				// Admin user session setup
				$session = [
					'userdata' => $data_admin,
					'status' => "Logged in",
					'privilage' => strtolower($data_admin->privilage)
				];
				$this->session->set_userdata($session);
				redirect($session['privilage'] == 'scan' ? 'Scan_tiket' : 'Dashboard');
			} elseif ($data_sales) {
				// Sales user session setup
				// $data_sales->agency = $data_sales->agency ?? 'Default Agency';
				$session = [
					'userdata' => $data_sales,
					'status' => "Logged in",
					'privilage' => 'sales' // Assuming 'sales' privilege is set for sales users
				];
				$this->session->set_userdata($session);
				redirect('Dash_sales'); // Redirect to sales dashboard or desired page
			} else {
				// Login failed
				$this->session->set_flashdata('result_login', '<br>Email atau Password yang anda masukkan salah.');
				redirect('Auth/login');
			}
		} else {
			$this->session->set_flashdata('result_login', '<br>Email dan Password harus diisi.');
			redirect('Auth/login');
		}
	}

	function cek_email_rest_pass()
	{
		$email = $_POST['email'];
		$this->db->select("email");
		$this->db->where("email", $email);
		$query_ = $this->db->get('sales');
		if ($query_->num_rows() > 0) {
			echo $query_->num_rows();
		}
	}
	function ins_token_pass()
	{
		// $email = 'oktadha01@gmail.com';
		$email = $_POST['email'];
		$token = md5($email . date("dmYHis"));
		$this->M_auth->update_token_customer($email, $token);

		$data['token'] = base_url('ResetPassword/token/') . $token;
		$this->db->select("*");
		$this->db->where("email", $email);
		$query_ = $this->db->get('sales');
		$data_cust = $query_->result();
		foreach ($data_cust as $sales) {
			$data['nm_customer'] = $sales->nm_customer;
		}
		$config = [
			'mailtype'  => 'html',
			'charset'   => 'utf-8',
			'protocol'  => 'smtp',
			'smtp_host' => 'mail.wisdil.com',
			'smtp_user' => 'no-reply@wisdil.com',  // Email gmail
			'smtp_pass'   => 'noreply@123',  // Password gmail
			'smtp_crypto' => 'ssl',
			'smtp_port'   => 465,
			'crlf'    => "\r\n",
			'newline' => "\r\n"
		];

		$email_to_user = $email;
		$this->load->library('email', $config);
		$this->email->from('no-reply@wisdil.com', 'mitra.Wisdil.com');
		$this->email->to($email_to_user);
		$this->email->subject('Pengaturan ulang kata sandi Akun Mitra Wisdil');

		$body = $this->load->view('page_sales/login/temp_rest_pass.php', $data, true);

		$this->email->message($body);

		// $this->email->send();
		if ($this->email->send()) {
			// Email sent successfully
			echo "Email has been sent successfully.";
		} else {
			// Failed to send email
			// You can log the error message or display it for debugging
			echo "Failed to send email.";
			echo $this->email->print_debugger(); // This will print the error message
		}
	}
	// function logout()
	// {
	// 	$this->session->sess_destroy();
	// 	$this->session->set_flashdata('sukses', 'Anda Telah Keluar dari Aplikasi');
	// 	redirect('home');
	// }
	function logout()
	{
		// if (isset($_POST['hapus_cookie'])) {
		setcookie('session', '', 1, '/');
		redirect('Home');

		// }
	}
	function logout_adm()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata('sukses', 'Anda Telah Keluar dari Aplikasi');
		redirect('Auth/login');
	}
}


/* End of file Login.php */
/* Location: ./application/controllers/Login.php */