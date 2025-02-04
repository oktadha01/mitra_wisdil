<?php

use Illuminate\Support\Arr;

defined('BASEPATH') or exit('No direct script access allowed');

class M_profile extends CI_Model
{
    function m_sales($email)
    {
        $this->db->select('*');
        $this->db->from('sales');
        $this->db->where('email', $email);
        $this->db->join('bank_account', 'sales.id_sales = bank_account.id_sales', 'left');
        $query = $this->db->get();
        return $query->result();
    }

    public function updateKtp($id_sales, $file_ktp)
    {
        $this->db->where('id_sales', $id_sales);
        return $this->db->update('sales', ['ktp' => $file_ktp]);
    }
    public function getOldKtp($id_sales)
    {
        return $this->db->select('ktp')
            ->from('sales')
            ->where('id_sales', $id_sales)
            ->get()
            ->row();
    }
    function M_update_profil($email, $kota, $kontak)
    {
        $update = $this->db->set('domisili', $kota)
            ->set('no_wa', $kontak)
            ->where('email', $email)
            ->update('sales');
        return $update;
    }

    function m_insert_payment($data)
    {
        $insert = $this->db->insert('bank_account', $data);
        return $insert;
    }

    function m_update_payment($id_sales, $data)
    {
        $this->db->where('id_sales', $id_sales);
        $update = $this->db->update('bank_account', $data);
        return $update;
    }

    function m_cek_email($email)
    {

        $this->db->select('*');
        $this->db->from('sales');
        $this->db->where('email', $email);
        $query = $this->db->get();
        $q['result'] = $query->result();
        $q['num_rows'] = $query->num_rows();
        return $q;
    }
    function m_validasi_pass($email_lama, $password)
    {
        $this->db->select('*');
        $this->db->from('sales');
        $this->db->where('email', $email_lama);
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
    function m_update_email($email_lama, $email)
    {
        $update = $this->db->set('email', $email)
            ->where('email', $email_lama)
            ->update('sales');

        setcookie('session', $email, strtotime('+7 days'), '/');
        return $update;
    }
    function m_update_password($email_lama, $pass_baru)
    {
        $update = $this->db->set('password', md5($pass_baru))
            ->where('email', $email_lama)
            ->update('sales');
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
