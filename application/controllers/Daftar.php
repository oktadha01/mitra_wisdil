<?php

use Illuminate\Support\Facades\Password;

defined('BASEPATH') or exit('No direct script access allowed');

class Daftar extends CI_Controller
{
    var $template = 'templates/index';

    public $session;
    public $M_auth;
    public $uri;
    public $input;
    public $db;
    public $email;
    public $userdaftar;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_auth');
    }

    public function index()
    {
        $data['script']             = 'daftar';
        $this->load->view('page_sales/login/login', $data);
        // $cookies = $this->input->cookie('userdata');

        // if ($cookies == '') {
        // } else {
        //     redirect('Dash_sales');
        // }
    }

    public function pengajuan_akun_mitra()
    {
        $code_referral = $this->input->post('code_referral');
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $no_wa = $this->input->post('no_wa');
        $domisili = $this->input->post('domisili');
        $password = $this->input->post('password');

        // Check if email exists
        $this->db->select("email,password");
        $this->db->where("email", $email);
        $query_ = $this->db->get('sales');

        if ($query_->num_rows() == 0) {

            $data = [
                'code_referral' => $code_referral,
                'nama' => $nama,
                'email' => $email,
                'no_wa' => $no_wa,
                'domisili' => $domisili,
                'password' => $password,
            ];

            $cookie_data = array(
                'userdaftar' => $data,
                'status' => '',
            );

            // Serialisasi data agar dapat disimpan sebagai string
            setcookie('userdaftar', json_encode($cookie_data), time() + (24 * 60 * 60), '/'); // 1 hari
            $this->load->helper('encryption'); // Pastikan helper dimuat
            $key = "wisdilindonesia24";
            $plaintext = $nama . "/" . $email . "/" . $no_wa . "/" . $domisili . "/" . $code_referral . "/" . $password . "/" . date('d/m/Y');
            $encrypted = encrypt_data($plaintext, $key);

            $url = "URL:" . base_url('Daftar/konfirmasi/') . $encrypted;

            // Optionally send email
            $send_email = [
                'subject' => 'Aktivasi Akun Mitra Wisdil',
                'temp' => 'temp_sendaktivasi',
                'nama' => $nama,
                'email' => $email,
                'url' => $url,
            ];
            $this->send_email($send_email);
            // Respond with success
            $response = [
                'status' => 'success',
                'message' => 'Pengajuan akun mitra berhasil',
            ];
        } else {
            // Respond Email sudah terdaftar
            $response = [
                'status' => 'error',
                'message' => 'Email sudah terdaftar',
            ];
        }
        echo json_encode($response);
    }

    function send_ulang_aktivasi()
    {
        $email = $_POST['email'];
        if (isset($_COOKIE['userdaftar'])) {
            // Decode the JSON cookie data
            $userdaftar = json_decode($_COOKIE['userdaftar'], true);

            // Assign the 'userdaftar' array to the class property
            $this->userdaftar = $userdaftar['userdaftar'];

            $code_referral = $this->userdaftar['code_referral'];
            $nama = $this->userdaftar['nama'];
            $no_wa = $this->userdaftar['no_wa'];
            $domisili = $this->userdaftar['domisili'];
            $password = $this->userdaftar['password'];

            $data = [

                'code_referral' => $code_referral,
                'nama' => $nama,
                'email' => $email,
                'no_wa' => $no_wa,
                'domisili' => $domisili,
                'password' => $password,
            ];

            $cookie_data = array(
                'userdaftar' => $data,
                'status' => '',
            );

            // Serialisasi data agar dapat disimpan sebagai string
            setcookie('userdaftar', json_encode($cookie_data), time() + (24 * 60 * 60), '/'); // 1 hari

            $this->load->helper('encryption'); // Pastikan helper dimuat
            $key = "wisdilindonesia24";
            $plaintext = $nama . "/" . $email . "/" . $no_wa . "/" . $domisili . "/" . $code_referral . "/" . $password . "/" . date('d/m/Y');
            $encrypted = encrypt_data($plaintext, $key);

            $url = "URL:" . base_url('Daftar/konfirmasi/') . $encrypted;
            $send_email = [
                'subject' => 'Aktivasi Akun Mitra Wisdil',
                'temp' => 'temp_sendaktivasi',
                'nama' => $nama,
                'email' => $email,
                'url' => $url,
            ];
            $this->send_email($send_email);
        }
    }

    function konfirmasi()
    {

        $this->load->helper('encryption'); // Pastikan helper dimuat

        $key = "wisdilindonesia24";
        $ciphertext = $this->uri->segment(3); // Ambil dari URL

        // echo "Data terenkripsi: " . $ciphertext . "<br>";

        $decrypted_data = decrypt_data($ciphertext, $key);
        // echo "Data terdekripsi: " . ($decrypted_data ? $decrypted_data : "Gagal") . "<br>";

        if ($decrypted_data) {
            list($nama, $email, $no_wa, $domisili, $referral, $password) = explode("/", $decrypted_data);
            $this->db->select('*');
            $this->db->from('sales');
            $this->db->where('email', $email);
            $query = $this->db->get();
            $sales_data = $query->row();
            if (empty($sales_data)) {
                $data = [
                    'nama' => $nama,
                    'code_referral' => $referral,
                    'email' => $email,
                    'no_wa' => $no_wa,
                    'domisili' => $domisili,
                    'status' => '0',
                    'date_join' => date('d-m-Y'),
                    'password' => md5($password)
                ];
                if ($this->M_auth->m_insert_regist($data)) {
                    $id_sales = $this->db->insert_id();

                    $this->db->select('nama');
                    $this->db->from('wilayah_kabupaten');
                    $this->db->where('id', $domisili);
                    $query = $this->db->get();
                    $kabupaten = $query->row();
                    $nm_domisili = $kabupaten->nama;

                    $send_email = [
                        'subject' => 'Selamat, Aktivasi Akun Mitra Anda Telah Berhasil',
                        'temp' => 'tempemail_success',
                        'nama' => $nama,
                        'email' => $email,
                        'no_wa' => substr($no_wa, 0, 4) . str_repeat('*', strlen($no_wa) - 7) . substr($no_wa, -3),
                        'domisili' => $nm_domisili,
                        'referral' => $referral,
                        'date' => date('d-m-Y H:i:s'),
                    ];
                    $this->send_email($send_email);

                    // Get the inserted ID

                    $data_sales = [
                        'id_sales' => $id_sales,
                        'email' => $email,
                    ];
                    // Simpan ke cookie
                    $cookie_data = array(
                        'userdata' => $data_sales,
                        'status' => 'Logged in',
                        'privilage' => ''
                    );

                    // Set cookie
                    setcookie('userdata', json_encode($cookie_data), time() + (7 * 24 * 60 * 60), '/'); // 7 hari
                    setcookie('userdaftar', '', 1, '/'); // Hapus cookie userdaftar
                    // Redirect to success page
                    $response = [
                        'status' => 'Akun berhasil diaktivasi',
                        'message' => 'Silahkan lengkapi data diri Anda',
                    ];
                    $this->session->set_flashdata('response', $response);
                    redirect('Profile');
                } else {
                    // Handle error
                    echo "Failed to insert data.";
                }
            } else {
                $response = [
                    'status' => 'Akun sudah terdaftar',
                    'message' => 'Akun Mitra sudah berhasil diaktivasi silahkan login dengan akun anda!!',
                ];
                $this->session->set_flashdata('response', $response);
                redirect('Login');
            }
        } else {
            echo "Not Found !!";
        }
    }

    function send_email($data)
    {
        $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'talang.iixcp.rumahweb.net',
            'smtp_user' => 'tiket@wisdil.com',
            'smtp_pass' => 'tiket123!',
            'smtp_crypto' => 'ssl',
            'smtp_port'   => 465,
            'crlf'    => "\r\n",
            'newline' => "\r\n"
        ];

        $this->load->library('email', $config);
        $this->email->from('tiket@wisdil.com', 'Wisdil.com');
        $this->email->to($data['email']);
        $this->email->subject($data['subject'] . ' - ' . $data['email']);
        $body = $this->load->view('page_sales/login/' . $data['temp'], $data, true);
        $this->email->message($body);

        if (!$this->email->send()) {
            // log_message('error', 'Email failed: ' . $this->email->print_debugger());
            // return false;
        }
        // 
        // return true;
    }
    public function cek_kodereferral()
    {
        $code = $this->input->post('code_referral');

        // Query ke database untuk mencari marketing dengan code_referral
        $this->db->select("*");
        $this->db->where("code_referral", $code);
        $query_ = $this->db->get('marketing');
        $data_marketing = $query_->result();

        // Pastikan untuk mengirimkan header JSON
        // header('Content-Type: application/json');

        if ($query_->num_rows() > 0) {
            // Jika ada data, kirimkan nama marketing
            foreach ($data_marketing as $user) {
                echo json_encode([
                    'nama' => $user->nm_marketing,
                ]);
            }
        } else {
            // Jika tidak ada data, kirimkan nama kosong
            echo json_encode([
                'nama' => '',
            ]);
        }
    }


    function cek_statusdaftar()
    {

        $email = $_POST['email'];
        // $email = 'oktadha01@gmail.com';
        $this->db->select("status,code_referral,ktp,password");
        $this->db->where("email", $email);
        $query_ = $this->db->get('sales');
        $data_sales = $query_->result();
        if ($query_->num_rows() > 0) {
            foreach ($data_sales as $rows) {
                setcookie('userdaftar', '', 1, '/'); // Hapus cookie userdaftar

            }
        } else {
            echo json_encode([
                'status' => 'notfound',
            ]);
        }
    }
    function cek_email_rest_pass()
    {
        $email = $_POST['email'];
        $this->db->select("email");
        $this->db->where("email", $email);
        $query_ = $this->db->get('customer');
        if ($query_->num_rows() > 0) {
            echo $query_->num_rows();
        }
    }


    function logout()
    {
        // if (isset($_POST['hapus_cookie'])) {
        setcookie('session', '', 1, '/');
        redirect('Home');

        // }
    }

    function get_ajax_kab()
    {
        $query = $this->M_auth->get_kabupaten();
        $data = "<option value=''>- Domisili Kota/Kabupaten -</option>";
        foreach ($query as $value) {
            $data .= "<option value='" . $value->id . "'>" . $value->nama . "</option>";
        }
        echo $data;
    }

    // function konfirmasi_akun()
    // {
    //     // First, check if the 'userdaftar' cookie is set
    //     if (isset($_COOKIE['userdaftar'])) {
    //         // Decode the JSON cookie data
    //         $userdaftar = json_decode($_COOKIE['userdaftar'], true);

    //         // Assign the 'userdaftar' array to the class property
    //         $this->userdaftar = $userdaftar['userdaftar'];

    //         $code_referral = $this->userdaftar['code_referral'];
    //         $nama = $this->userdaftar['nama'];
    //         $email = $this->userdaftar['email'];
    //         $no_wa = $this->userdaftar['no_wa'];
    //         $domisili = $this->userdaftar['domisili'];

    //         // Direktori upload
    //         $upload_dir = './upload/ktp/';

    //         $ktp_file_name = '';
    //         if (isset($_FILES['ktp']) && $_FILES['ktp']['error'] === UPLOAD_ERR_OK) {
    //             // Validasi tipe file
    //             $file_type = mime_content_type($_FILES['ktp']['tmp_name']);
    //             $allowed_types = ['image/jpeg', 'image/png', 'image/jpg']; // Hanya file gambar yang diizinkan

    //             // Validasi jenis file
    //             if (!in_array($file_type, $allowed_types)) {
    //                 echo "File harus berupa gambar (JPG/PNG).";
    //                 exit;
    //             }

    //             // Mendapatkan ekstensi file
    //             $file_extension = pathinfo($_FILES['ktp']['name'], PATHINFO_EXTENSION);

    //             // Nama file baru untuk diupload
    //             $data = $nama . $email . $no_wa; // Variabel $nama, $email, $no_wa harus didefinisikan sebelumnya
    //             $ktp_file_name = 'ktp-' . substr(md5($data), 0, 8) . '.' . $file_extension;

    //             // Path lengkap untuk menyimpan file
    //             $upload_path = $upload_dir . $ktp_file_name;


    //             // Proses upload file
    //             if (!move_uploaded_file($_FILES['ktp']['tmp_name'], $upload_path)) {
    //                 echo "Gagal mengunggah file. Pastikan direktori memiliki izin yang sesuai.";
    //                 exit;
    //             }
    //         } else {
    //             echo "Tidak ada file yang diunggah atau terjadi kesalahan saat mengunggah.";
    //             exit;
    //         }

    //         $data = [
    //             'code_referral' => $code_referral,
    //             'nama' => $nama,
    //             'email' => $email,
    //             'no_wa' => $no_wa,
    //             'domisili' => $domisili,
    //             'ktp' => $ktp_file_name, // Simpan nama file ke database
    //             'status' => '0', // Simpan nama file ke database
    //         ];
    //         // Setelah data berhasil diproses
    //         if ($this->M_auth->m_insert_regist($data)) {
    //             // Jika data berhasil disimpan
    //             $response = [
    //                 'status' => 'success',
    //             ];
    //         } else {
    //             // Jika terjadi kesalahan saat menyimpan data
    //             $response = [
    //                 'status' => 'error',
    //             ];
    //         }
    //         echo json_encode($response);
    //     } else {
    //         // Handle case when cookie is not set or empty
    //         echo "Cookie 'userdaftar' not found!";
    //     }
    // }
}


/* End of file Login.php */
/* Location: ./application/controllers/Login.php */