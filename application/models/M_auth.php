<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_auth extends CI_Model
{
	public function login($email, $password)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('email', $email);
		$this->db->where(
			'password',
			md5($password)
		);

		$data = $this->db->get();

		if ($data->num_rows() == 1) {
			return $data->row();
		} else {
			return false;
		}
	}

	public function login_sales($email, $password)
	{
		$this->db->select('*, nama AS agency');
		$this->db->from('sales');
		$this->db->where('email', $email);
		$this->db->where('status', '1');
		$this->db->where(
			'password',
			md5($password)
		);

		$data = $this->db->get();

		if ($data->num_rows() == 1) {
			return $data->row();
		} else {
			return false;
		}
	}

	function login_customer($post_email, $post_pass)
	{
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('email', $post_email);
		$this->db->where(
			'password',
			md5($post_pass)
		);

		$data = $this->db->get();

		if ($data->num_rows() == 1) {
			return $data->row();
		} else {
			return false;
		}
	}
	function m_insert_password($password, $email)
	{
		$update = $this->db->set('password', md5($password))
			->where('email', $email)
			->update('customer');
		return $update;
	}
	function m_insert_regist($data)
	{
		$this->db->insert('sales', $data);
		return $this->db->affected_rows();
	}

	public function get_ktp($email)
	{
		$this->db->select('ktp');
		$this->db->from('sales');
		$this->db->where('email', $email);
		$query = $this->db->get();
		$result = $query->row();
		return $result ? $result->ktp : null;  // Return the KTP file path
	}

	public function update_konfir_data($email, $data) {
		$this->db->where('email', $email);
		$this->db->update('sales', $data);  // Assuming the table name is 'users'
	}
	public function update_konfirpass_data($email, $data) {
		$this->db->where('email', $email);
		$this->db->update('sales', $data);  // Assuming the table name is 'users'
	}

	function update_token_customer($email, $token)
	{
		$update = $this->db->set('token_password', $token)
			->where('email', $email)
			->update('customer');
		return $update;
	}

	function get_kabupaten()
	{
		$this->db->select('*');
		$this->db->from('wilayah_kabupaten');
		$query = $this->db->get();

		return $query->result();
	}
}

/* End of file M_auth.php */
/* Location: ./application/models/M_auth.php */