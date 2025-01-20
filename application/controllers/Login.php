<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
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
        $cookies = $this->input->cookie('userdata');

        if ($cookies == '') {
            $data['script']             = 'login';
            $this->load->view('page_sales/login/login', $data);
        } else {
            redirect('Dash_sales');
        }
    }

    public function login()
    {
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == TRUE) {
            $email = trim($this->input->post('email', TRUE));
            $password = trim($this->input->post('password', TRUE));

            $data = $this->M_auth->login_sales($email, $password);

            if ($data == false) {
                $this->session->set_flashdata('result_login', '<br>Email atau Password yang Anda masukkan salah.');
                redirect('Login');
            } else {
                // Simpan ke session
                // $this->session->set_userdata('userdata', $data);

                // Simpan ke cookie
                $cookie_data = array(
                    'userdata' => $data,
                    'status' => 'Logged in',
                    'privilage' => ''
                );

                // Serialisasi data agar dapat disimpan sebagai string
                setcookie('userdata', json_encode($cookie_data), time() + (7 * 24 * 60 * 60), '/'); // 7 hari
                setcookie('userdaftar', '', 1, '/');

                redirect(''); // Redirect ke halaman utama
            }
        } else {
            $this->session->set_flashdata('result_login', '<br>Email dan Password harus diisi.');
            redirect('Login');
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

    function ins_token_pass()
    {
        // $email = 'oktadha01@gmail.com';
        $email = $_POST['email'];
        $token = md5($email . date("dmYHis"));
        $this->M_auth->update_token_customer($email, $token);

        $data['token'] = base_url('ResetPassword/token/') . $token;
        $this->db->select("*");
        $this->db->where("email", $email);
        $query_ = $this->db->get('customer');
        $data_cust = $query_->result();
        foreach ($data_cust as $customer) {
            $data['nm_customer'] = $customer->nm_customer;
        }
        $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'mail.wisdil.com',
            'smtp_user' => 'tiket@wisdil.com',  // Email gmail
            'smtp_pass'   => 'tiket123!',  // Password gmail
            // 'smtp_host' => 'smtp.gmail.com',
            // 'smtp_user' => 'Oktadha01@gmail.com',  // Email gmail
            // 'smtp_pass'   => 'rvcw cvny ibav czbh',  // Password gmail
            'smtp_crypto' => 'ssl',
            'smtp_port'   => 465,
            'crlf'    => "\r\n",
            'newline' => "\r\n"
        ];

        $email_to_user = $email;
        $this->load->library('email', $config);
        $this->email->from('tiket@wisdil.com', 'Wisdil.com');
        $this->email->to($email_to_user);
        $this->email->subject('Reset Password. Halo ' . $customer->nm_customer . ' Kami mendengar Anda memerlukan pengaturan ulang kata sandi. Klik tautan di bawah dan Anda akan diarahkan ke situs aman tempat Anda dapat menyetel password baru');

        $body = $this->load->view('client/email/temp_rest_pass.php', $data, true);

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
        setcookie('userdata', '', 1, '/');
        redirect('Login');

        // }
    }
}


/* End of file Login.php */
/* Location: ./application/controllers/Login.php */