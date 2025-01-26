<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Daftar extends CI_Controller
{
    var $template = 'templates/index';

    public $session;
    public $form_validation;
    public $M_auth;
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

    public function pengajuan_akun_mitra()
    {
        $code_referral = $this->input->post('code_referral');
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $no_wa = $this->input->post('no_wa');
        $domisili = $this->input->post('domisili');

        // Check if email exists
        $this->db->select("email");
        $this->db->where("email", $email);
        $query_ = $this->db->get('sales');

        if ($query_->num_rows() == 0) {
            $tokenCode = substr(md5($nama . $email . $no_wa), 0, 8); // Generate token

            $data = [
                'code_referral' => $code_referral,
                'nama' => $nama,
                'email' => $email,
                'no_wa' => $no_wa,
                'domisili' => $domisili,
                'token' => $tokenCode,
            ];

            $cookie_data = array(
                'userdaftar' => $data,
                'status' => '',
            );

            // Serialisasi data agar dapat disimpan sebagai string
            setcookie('userdaftar', json_encode($cookie_data), time() + (24 * 60 * 60), '/'); // 1 hari


            // Respond with success
            $response = [
                'status' => 'success',
                'message' => 'Pengajuan akun mitra berhasil',
            ];
        } else {
            // Respond with error
            $response = [
                'status' => 'error',
                'message' => 'Email sudah terdaftar',
            ];
        }
        // Optionally send email
        $send_email = [
            'nama' => $nama,
            'email' => $email,
            'token' => $tokenCode,
        ];
        $this->send_email($send_email);
        echo json_encode($response);
    }


    function send_ulang_token()
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
            $data = $nama . $email . $no_wa;

            // Menghasilkan kode referral dengan hash MD5 (atau bisa menggunakan SHA1, base64_encode, dsb.)
            $tokenCode = substr(md5($data), 0, 8); // Mengambil 8 karakter pertama dari hash
            // echo $tokenCode;
            $data = [

                'code_referral' => $code_referral,
                'nama' => $nama,
                'email' => $email,
                'no_wa' => $no_wa,
                'domisili' => $domisili,
                'token' => $tokenCode,
            ];

            $cookie_data = array(
                'userdaftar' => $data,
                'status' => '',
            );

            // Serialisasi data agar dapat disimpan sebagai string
            setcookie('userdaftar', json_encode($cookie_data), time() + (24 * 60 * 60), '/'); // 1 hari

            $send_email = [
                'nama' => $nama,
                'email' => $email,
                'token' => $tokenCode,
            ];
            $this->send_email($send_email);
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
        $this->email->subject('Konfirmasi Pendaftaran Akun Mitra Wisdil.com - ' . $data['email']);
        $body = $this->load->view('page_sales/login/temp_sendtoken', $data, true);
        $this->email->message($body);

        if (!$this->email->send()) {
            // log_message('error', 'Email failed: ' . $this->email->print_debugger());
            // return false;
        }
        // 
        // return true;
    }

    function konfirmasi_akun()
    {
        // First, check if the 'userdaftar' cookie is set
        if (isset($_COOKIE['userdaftar'])) {
            // Decode the JSON cookie data
            $userdaftar = json_decode($_COOKIE['userdaftar'], true);

            // Assign the 'userdaftar' array to the class property
            $this->userdaftar = $userdaftar['userdaftar'];

            $code_referral = $this->userdaftar['code_referral'];
            $nama = $this->userdaftar['nama'];
            $email = $this->userdaftar['email'];
            $no_wa = $this->userdaftar['no_wa'];
            $domisili = $this->userdaftar['domisili'];

            // Direktori upload
            $upload_dir = './upload/ktp/';

            $ktp_file_name = '';
            if (isset($_FILES['ktp']) && $_FILES['ktp']['error'] === UPLOAD_ERR_OK) {
                // Validasi tipe file
                $file_type = mime_content_type($_FILES['ktp']['tmp_name']);
                $allowed_types = ['image/jpeg', 'image/png', 'image/jpg']; // Hanya file gambar yang diizinkan

                // Validasi jenis file
                if (!in_array($file_type, $allowed_types)) {
                    echo "File harus berupa gambar (JPG/PNG).";
                    exit;
                }

                // Mendapatkan ekstensi file
                $file_extension = pathinfo($_FILES['ktp']['name'], PATHINFO_EXTENSION);

                // Nama file baru untuk diupload
                $data = $nama . $email . $no_wa; // Variabel $nama, $email, $no_wa harus didefinisikan sebelumnya
                $ktp_file_name = 'ktp-' . substr(md5($data), 0, 8) . '.' . $file_extension;

                // Path lengkap untuk menyimpan file
                $upload_path = $upload_dir . $ktp_file_name;


                // Proses upload file
                if (!move_uploaded_file($_FILES['ktp']['tmp_name'], $upload_path)) {
                    echo "Gagal mengunggah file. Pastikan direktori memiliki izin yang sesuai.";
                    exit;
                }
            } else {
                echo "Tidak ada file yang diunggah atau terjadi kesalahan saat mengunggah.";
                exit;
            }

            $data = [
                'code_referral' => $code_referral,
                'nama' => $nama,
                'email' => $email,
                'no_wa' => $no_wa,
                'domisili' => $domisili,
                'ktp' => $ktp_file_name, // Simpan nama file ke database
                'status' => '0', // Simpan nama file ke database
            ];
            // Setelah data berhasil diproses
            if ($this->M_auth->m_insert_regist($data)) {
                // Jika data berhasil disimpan
                $response = [
                    'status' => 'success',
                ];
            } else {
                // Jika terjadi kesalahan saat menyimpan data
                $response = [
                    'status' => 'error',
                ];
            }
            echo json_encode($response);
        } else {
            // Handle case when cookie is not set or empty
            echo "Cookie 'userdaftar' not found!";
        }
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

    public function konfirmasi_ulang_akun()
    {
        if (isset($_COOKIE['userdaftar'])) {
            $userdaftar = json_decode($_COOKIE['userdaftar'], true);
            $this->userdaftar = $userdaftar['userdaftar'];
            $email = $this->userdaftar['email'];
            $code_referral = $this->userdaftar['code_referral'];
            $domisili = $this->userdaftar['domisili'];
            $token = $this->userdaftar['token'];

            // Check if the new KTP file is uploaded
            if (isset($_FILES['ktp']) && $_FILES['ktp']['error'] == 0) {
                // Mendapatkan ekstensi file
                $file_extension = pathinfo($_FILES['ktp']['name'], PATHINFO_EXTENSION);

                // Nama file baru untuk diupload
                $data = $this->input->post('nama') . $email . $this->input->post('no_wa'); // Variabel $nama, $email, $no_wa
                $ktp_file_name = 'ktp-' . substr(md5($data), 0, 8) . '.' . $file_extension;  // Format nama file sesuai yang diinginkan

                // Path untuk menyimpan file di folder
                $upload_dir = './upload/ktp/';
                $upload_path = $upload_dir . $ktp_file_name;  // Path file yang akan disimpan di folder

                // Proses upload file
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0755, true); // Create the directory if it doesn't exist
                }

                // Mengambil file KTP lama dari database
                $old_ktp = $this->M_auth->get_ktp($email);

                // Hapus file KTP lama jika ada
                if ($old_ktp && file_exists($old_ktp)) {
                    unlink($old_ktp); // Hapus file KTP lama
                }

                // Pindahkan file ke folder upload
                if (move_uploaded_file($_FILES['ktp']['tmp_name'], $upload_path)) {
                    // Data untuk pembaruan
                    $nama = $this->input->post('nama');
                    $no_wa = $this->input->post('no_wa');

                    // Update data pengguna di database
                    $data = [
                        'status' => '0',
                        'nama' => $nama,
                        'no_wa' => $no_wa,
                        'ktp' => $ktp_file_name  // Menyimpan path file KTP yang sesuai ke database
                    ];
                    $this->M_auth->update_konfir_data($email, $data);

                    echo json_encode(['status' => 'berhasil', 'message' => 'Konfirmasi berhasil, KTP diperbarui']);

                    // Menyimpan data ke cookie
                    $data_sales = [
                        'code_referral' => $code_referral,
                        'nama' => $nama,
                        'email' => $email,
                        'no_wa' => $no_wa,
                        'domisili' => $domisili,
                        'token' => '',
                    ];
                    $cookie_data = array(
                        'userdaftar' => $data_sales,
                        'status' => '',
                    );
                    // Serialisasi data agar dapat disimpan sebagai string
                    setcookie('userdaftar', json_encode($cookie_data), time() + (24 * 60 * 60), '/'); // 1 hari

                } else {
                    echo json_encode(['status' => 'gagal', 'message' => 'Gagal mengunggah file KTP']);
                }
            } else {
                // Jika file KTP tidak diunggah, hanya update data lainnya
                $nama = $this->input->post('nama');
                $no_wa = $this->input->post('no_wa');

                // Update data pengguna tanpa mengubah KTP
                $data = [
                    'status' => '0',
                    'nama' => $nama,
                    'no_wa' => $no_wa
                ];
                $this->M_auth->update_konfir_data($email, $data);

                echo json_encode(['status' => 'berhasil', 'message' => 'Konfirmasi berhasil, tanpa perubahan KTP']);

                // Menyimpan data ke cookie
                $data_sales = [
                    'code_referral' => $code_referral,
                    'nama' => $nama,
                    'email' => $email,
                    'no_wa' => $no_wa,
                    'domisili' => $domisili,
                    'token' => '',
                ];
                $cookie_data = array(
                    'userdaftar' => $data_sales,
                    'status' => '',
                );
                // Serialisasi data agar dapat disimpan sebagai string
                setcookie('userdaftar', json_encode($cookie_data), time() + (24 * 60 * 60), '/'); // 1 hari

            }
        }
    }

    function konfirmasi_login()
    {
        // $password = $_POST['password'];
        // echo $password;
        if (isset($_COOKIE['userdaftar'])) {
            $userdaftar = json_decode($_COOKIE['userdaftar'], true);
            $this->userdaftar = $userdaftar['userdaftar'];
            $email = $this->userdaftar['email'];
            $password = $_POST['password'];

            // Update password dan data pengguna
            $data = [
                'password' => md5($password),
                'date_join' => date('d/m/Y'),
                'privilage' => 'sales'
            ];
            $this->M_auth->update_konfirpass_data($email, $data);

            $this->db->select("id_sales");
            $this->db->where("email", $email);
            $query_ = $this->db->get('sales');
            $data_sales = $query_->result();
            foreach ($data_sales as $row) {
                $id_sales = $row->id_sales;
            }

            // Data untuk cookie baru
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
                echo json_encode([
                    'status' => $rows->status,
                    'code_referral' => $rows->code_referral,
                    'ktp' => $rows->ktp,
                    'password' => $rows->password,
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'notfound',
                'code_referral' => '',
                'ktp' => '',
                'password' => '',
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

    // function ins_token_pass()
    // {
    //     // $email = 'oktadha01@gmail.com';
    //     $email = $_POST['email'];
    //     $token = md5($email . date("dmYHis"));
    //     $this->M_auth->update_token_customer($email, $token);

    //     $data['token'] = base_url('ResetPassword/token/') . $token;
    //     $this->db->select("*");
    //     $this->db->where("email", $email);
    //     $query_ = $this->db->get('customer');
    //     $data_cust = $query_->result();
    //     foreach ($data_cust as $customer) {
    //         $data['nm_customer'] = $customer->nm_customer;
    //     }
    //     $config = [
    //         'mailtype'  => 'html',
    //         'charset'   => 'utf-8',
    //         'protocol'  => 'smtp',
    //         'smtp_host' => 'mail.wisdil.com',
    //         'smtp_user' => 'tiket@wisdil.com',  // Email gmail
    //         'smtp_pass'   => 'tiket123!',  // Password gmail
    //         'smtp_crypto' => 'ssl',
    //         'smtp_port'   => 465,
    //         'crlf'    => "\r\n",
    //         'newline' => "\r\n"
    //     ];

    //     $email_to_user = $email;
    //     $this->load->library('email', $config);
    //     $this->email->from('tiket@wisdil.com', 'Wisdil.com');
    //     $this->email->to($email_to_user);
    //     $this->email->subject('Reset Password. Halo ' . $customer->nm_customer . ' Kami mendengar Anda memerlukan pengaturan ulang kata sandi. Klik tautan di bawah dan Anda akan diarahkan ke situs aman tempat Anda dapat menyetel password baru');

    //     $body = $this->load->view('client/email/temp_rest_pass.php', $data, true);

    //     $this->email->message($body);

    //     // $this->email->send();
    //     if ($this->email->send()) {
    //         // Email sent successfully
    //         echo "Email has been sent successfully.";
    //     } else {
    //         // Failed to send email
    //         // You can log the error message or display it for debugging
    //         echo "Failed to send email.";
    //         echo $this->email->print_debugger(); // This will print the error message
    //     }
    // }
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
}


/* End of file Login.php */
/* Location: ./application/controllers/Login.php */