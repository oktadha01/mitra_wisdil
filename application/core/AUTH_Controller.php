<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AUTH_Controller extends CI_Controller
{
	public $User_model;
	public $userdata;
	public $session;
	public $uri;

	public function __construct()
	{
		parent::__construct();

		// Ambil data cookie dan decode JSON-nya
		$cookie_data = isset($_COOKIE['userdata']) ? json_decode($_COOKIE['userdata'], true) : null;

		if ($cookie_data) {
			// Set userdata dari cookie
			$this->userdata = $cookie_data['userdata'];
		} else {
			$this->userdata = null;
		}

		$this->session->set_flashdata('segment', explode('/', $this->uri->uri_string()));

		// Cek status pengguna berdasarkan cookie
		if (empty($cookie_data) || $cookie_data['status'] !== 'Logged in') {
			redirect('Login');
		}
		// // Cek data sales di database
		// $this->db->select('*');
		// $this->db->from('sales');
		// $this->db->where('id_sales', $this->userdata['id_user']);
		// $query = $this->db->get();
		// $sales_data = $query->row();
		// if (empty($sales_data)) {
		// 	// Jika data sales kosong, redirect ke halaman login/logout
		// 	redirect('Login/logout');
		// }
	}


	// public function updateProfil() {
	// 	if ($this->userdata != '') {
	// 		$data = $this->User_model->select($this->userdata->id_user);

	// 		$this->session->set_userdata('userdata', $data);
	// 		$this->userdata = $this->session->userdata('userdata');
	// 	}
	// }
}

/* End of file MY_Auth.php */
/* Location: ./application/core/MY_Auth.php */