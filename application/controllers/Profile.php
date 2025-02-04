<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends AUTH_Controller
{
    var $template = 'tmpt_mitra/index';
    public $M_profile;
    public $input;
    public $userdata;
    public $upload;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_profile');
    }

    function index()
    {
        $email = $this->userdata['email'];

        $data['tittle']          = 'Profil';
        // $data['absen']        = $this->M_dashboard->m_absen();
        $data['sales']        = $this->M_profile->m_sales($email);
        $data['content']         = 'page_sales/profil/profil';
        $data['script']         = 'page_sales/profil/profil_js';
        $this->load->view($this->template, $data);
    }
    public function upload_ktp()
    {
        header('Content-Type: application/json');

        if (!isset($_FILES['file_ktp']) || $_FILES['file_ktp']['error'] != 0) {
            echo json_encode(['status' => 'error', 'message' => 'File tidak ditemukan atau terjadi kesalahan.']);
            return;
        }

        $id_sales = $this->userdata['id_sales'];
        $email = $this->userdata['email'];

        // Cek data KTP lama di database
        $old_ktp = $this->M_profile->getOldKtp($id_sales);

        // Generate nama file baru
        $hashed_name = substr(md5($email . date('YmdHis')), 0, 8);
        $file_ext = pathinfo($_FILES['file_ktp']['name'], PATHINFO_EXTENSION);
        $file_ktp = $hashed_name . '.' . $file_ext;

        // Konfigurasi Upload
        $config['upload_path']   = './upload/ktp/'; // Pastikan path benar
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size']      = 2048; // Maksimal 2MB
        $config['file_name']     = $file_ktp;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file_ktp')) {
            // Hapus file lama jika ada
            if ($old_ktp && !empty($old_ktp->ktp)) {
                $old_file_path = './upload/ktp/' . $old_ktp->ktp;
                if (file_exists($old_file_path)) {
                    unlink($old_file_path);
                }
            }

            // Simpan file baru ke database
            $update = $this->M_profile->updateKtp($id_sales, $file_ktp);

            if ($update) {
                echo json_encode([
                    'status' => 'success',
                    'file_url' => base_url('upload/ktp/' . $file_ktp),
                    'file_name' => $file_ktp
                ]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data ke database.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => strip_tags($this->upload->display_errors())]);
        }
    }

    function update_profil()
    {
        $email = $this->userdata['email'];
        $kota = $this->input->post('kota');
        $kontak = $this->input->post('kontak');
        $this->M_profile->m_update_profil($email, $kota, $kontak);
    }

    function insert_payment()
    {
        $data = array(
            'id_sales' => $this->userdata['id_sales'],
            'bank' => $this->input->post('bank'),
            'no_rekening' => $this->input->post('no_rekening'),
            'nama_pemilik' => $this->input->post('nama_pemilik'),
        );
        $this->M_profile->m_insert_payment($data);
    }

    function update_payment()
    {
        $id_sales = $this->userdata['id_sales'];

        $data = array(
            'bank' => $this->input->post('bank'),
            'no_rekening' => $this->input->post('no_rekening'),
            'nama_pemilik' => $this->input->post('nama_pemilik'),
        );
        $this->M_profile->m_update_payment($id_sales, $data);
    }

    function update_email()
    {
        $email_lama = $this->userdata['email'];
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        if ($this->userdata['email'] == $this->input->post('email')) {
            echo 'Email berhasil diubah';
            // Data untuk cookie baru
            $data_sales = [
                'id_sales' => $this->userdata['id_sales'],
                'email' => $this->input->post('email'),
            ];
            // Simpan ke cookie
            $cookie_data = array(
                'userdata' => $data_sales,
                'status' => 'Logged in',
                'privilage' => ''
            );

            // Set cookie
            setcookie('userdata', json_encode($cookie_data), time() + (7 * 24 * 60 * 60), '/'); // 7 hari
        } else {
            $cek_email = $this->M_profile->m_cek_email($email);
            $num_rows_mangkir = $cek_email['num_rows'];
            if ($num_rows_mangkir > 0) {
                echo 'Sorry !! Email sudah di gunakan..';
            } else {
                $data = $this->M_profile->m_validasi_pass($email_lama, $password);
                if ($data == false) {
                    echo 'Sorry !! Password akun salah';
                } else {
                    $this->M_profile->m_update_email($email_lama, $email);
                    echo 'Email berhasil diubah';
                    $data_sales = [
                        'id_sales' => $this->userdata['id_sales'],
                        'email' => $this->input->post('email'),
                    ];
                    // Simpan ke cookie
                    $cookie_data = array(
                        'userdata' => $data_sales,
                        'status' => 'Logged in',
                        'privilage' => ''
                    );
                    // Set cookie
                    setcookie('userdata', json_encode($cookie_data), time() + (7 * 24 * 60 * 60), '/'); // 7 hari
                }
            }
        }
    }
    function cek_password()
    {
        $email_lama = $this->userdata['email'];
        $password = $this->input->post('password');

        $data = $this->M_profile->m_validasi_pass($email_lama, $password);
        if ($data == false) {
            echo 'invalid';
        } else {
            echo 'valid';
        }
    }

    function update_password()
    {
        $email_lama = $this->userdata['email'];
        $password = $this->input->post('pass-lama');
        $pass_baru = $this->input->post('pass-baru');
        if ($password == $pass_baru) {
            echo 'Passswor tidak boleh sama dengan password sebelumnya!';
        } else {
            $data = $this->M_profile->m_validasi_pass($email_lama, $password);
            if ($data == false) {
                echo 'Validasi password salah!';
            } else {
                $this->M_profile->m_update_password($email_lama, $pass_baru);
                echo 'valid';
            }
        }
    }

    function get_ajax_kab()
    {
        $query = $this->M_profile->get_kabupaten();
        $data = "<option value=''>- Domisili Kota/Kabupaten -</option>";
        foreach ($query as $value) {
            $data .= "<option value='" . $value->id . "'>" . $value->nama . "</option>";
        }
        echo $data;
    }
}
