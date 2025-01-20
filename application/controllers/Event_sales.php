<?php

// use GuzzleHttp\Psr7\Response;

defined('BASEPATH') or exit('No direct script access allowed');

class Event_sales extends AUTH_Controller
{
    var $template = 'tmpt_mitra/index';
    public $userdata;
    public $session;
    public $db;
    public $input;
    public $email;
    public $upload;
    public $M_event_sales;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_event_sales');
    }

    public function index()
    {
        $data['userdata']        = $this->userdata;
        $data['tittle']          = 'Event Sales';
        $data['bread']           = 'Event';
        $data['content']         = 'page_sales/event_sales/event_sales';
        $data['script']          = 'page_sales/event_sales/event_sales_js';
        $this->load->view($this->template, $data);
    }

    function get_data_event()
    {
        $id_sales = $this->userdata['id_sales'];
        $list = $this->M_event_sales->get_datatablest($id_sales);
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $prfm) {


            // Kalimat input
            $kalimat = $prfm->nm_event;

            // Pisahkan kalimat menjadi array kata
            $kata = explode(" ", $kalimat);

            // Ambil huruf pertama dari setiap kata dan gabungkan
            $singkatan = "";
            foreach ($kata as $k) {
                $singkatan .= strtoupper($k[0]); // Gunakan strtoupper untuk memastikan huruf besar
            }

            // Ambil hanya dua huruf pertama
            $singkatan = substr($singkatan, 0, 2);

            if ($prfm->status_event == 0) {
                $status_event = 'Terkirim';
            } else if ($prfm->status_event == 1) {
                $status_event = 'Progress';
            } else if ($prfm->status_event == 2) {
                $status_event = 'Diterima';
            }
            $status_tiket = 'free';
            if ($prfm->url_payment !== 'free') {
                $status_tiket = '';
            }
            $no++;
            $row = [
                'no' => $no . ".",
                'id_event' => $prfm->id_event,
                'inisial' => $singkatan,
                'event' => $prfm->nm_event,
                'tgl_event' => $prfm->tgl_event,
                'status_event' => $status_event,
                'status_event_no' => $prfm->status_event,
                'status_tiket' => $status_tiket,
            ];
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->M_event_sales->count_all_trx($id_sales),
            "recordsFiltered" => $this->M_event_sales->count_filtereds($id_sales),
            "data" => $data, // Ubah menjadi array meskipun hanya satu entri
        );

        echo json_encode($output);
    }

    public function simpan_data_event()
    {
        $agency = $this->input->post('agency');
        if (is_numeric($agency)) {
            // return "Value is a number: $agency";
            $this->db->select('*');
            $this->db->from('user');
            $this->db->where('id_user', $agency);
            $query = $this->db->get();
            foreach ($query->result() as $rows) { // Split the rfid_nm field by commas
                $id_user = $rows->id_user;
                if ($rows->privilage == '') {
                    $this->db->set('email', $this->input->post('email'))
                        ->set('kontak', $this->input->post('kontak'))
                        ->set('alamat', $this->input->post('alamat'))
                        ->where('id_user', $id_user)
                        ->update('user');
                }
            }
        } elseif (is_string($agency)) {
            // return "Value is a text: $agency";
            // Prepare data for the `user` table
            $data_agancy = [
                'agency' => $this->input->post('agency'),
                'email' => $this->input->post('email'),
                'kontak' => $this->input->post('kontak'),
                'alamat' => $this->input->post('alamat_agency'),
            ];

            // Insert agency data and get the `id_user`
            $id_user = $this->M_event_sales->M_simpan_data_agency($data_agancy);
        }

        // Load the Upload library
        $config['upload_path'] = './upload/proposals/'; // Ensure this folder exists and is writable
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 2048; // Limit to 2MB
        $config['file_name'] = 'proposal_' . time(); // Unique file name

        $this->load->library('upload', $config);

        $id_sales = $this->userdata['id_sales'];

        // Prepare data for the `event` table
        $data_event = [
            'id_user' => $id_user,
            'id_sales_event' => $id_sales,
            'nm_event' => $this->input->post('nm_event'),
            'id_kategori_event' => $this->input->post('kategori_event'),
            'tgl_event' => $this->input->post('tgl_event'),
            'jam_event' => $this->input->post('jam_event'),
            'batas_pesan' => $this->input->post('tgl_event'),
            'mc_by' => $this->input->post('mc'),
            'lokasi' => $this->input->post('lokasi'),
            'kota' => $this->input->post('kota'),
            'alamat' => $this->input->post('alamat'),
            'desc_event' => $this->input->post('deskripsi'),
        ];

        // Insert event data and get the `id_event`
        $id_event = $this->M_event_sales->M_simpan_data_event($data_event);

        // Check if the file is uploaded
        if (!$this->upload->do_upload('proposal_file')) { // Ensure the input name in the form is `proposal_file`
            $error = $this->upload->display_errors();
            echo json_encode(['status' => 'error', 'message' => $error]);
            return;
        }

        // File uploaded successfully, get file data
        $file_data = $this->upload->data();

        // Prepare data for the `proposal` table
        $data_proposal = [
            'id_event_proposal' => $id_event,
            'proposal_event' => $file_data['file_name'],
        ];

        // Insert proposal data
        $this->M_event_sales->M_simpan_data_proposal($data_proposal);

        // Return success response
        echo json_encode(['status' => 'success', 'message' => 'Data and proposal uploaded successfully']);

        $send_agancy = [
            'agency' => $this->input->post('agency'),
            'email' => $this->input->post('email'),
            'kontak' => $this->input->post('kontak'),
            'alamat' => $this->input->post('alamat_agency'),
        ];
        $send_event = [
            'nm_event' => $this->input->post('nm_event'),
            'kategori_event' => $this->input->post('text_kategori_event'),
            'tgl_event' => $this->input->post('tgl_event'),
            'jam_event' => $this->input->post('jam_event'),
            'batas_pesan' => $this->input->post('tgl_event'),
            'mc_by' => $this->input->post('mc'),
            'lokasi' => $this->input->post('lokasi'),
            'kota' => $this->input->post('text_kota'),
            'alamat' => $this->input->post('alamat'),
            'desc_event' => $this->input->post('deskripsi'),
        ];

        // Send email
        $data_email = [
            'agency' => $send_agancy,
            'event' => $send_event,
        ];
        $this->send_email($data_email);
    }


    function edit_data_event() {}

    function send_email($data)
    {
        // Setup konfigurasi email
        $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'talang.iixcp.rumahweb.net',
            'smtp_user' => 'no-reply@wisdil.com',
            'smtp_pass' => 'no-reply@wisdil',
            'smtp_crypto' => 'ssl',
            'smtp_port'   => 465,
            'crlf'    => "\r\n",
            'newline' => "\r\n"
        ];

        $email_to_user = 'oktadha01@gmail.com'; // Pastikan variabel $email sudah memiliki nilai

        // Validasi email
        if (!filter_var($email_to_user, FILTER_VALIDATE_EMAIL)) {
            log_message('error', 'Email tidak valid: ' . $email_to_user);
            return false; // Keluar dari fungsi jika email tidak valid
        }

        $this->load->library('email', $config);
        $this->email->from('tiket@wisdil.com', 'Wisdil.com');
        $this->email->to($email_to_user);
        $this->email->subject('Penajuan event telah kami terima');

        // Load email template
        $body = $this->load->view('page_sales/event_sales/temp_sendemail.php', $data, true);
        $this->email->message($body);

        // Kirim email dan cek hasilnya
        if ($this->email->send()) {
            log_message('info', 'Email berhasil dikirim ke: ' . $email_to_user);
            return true;
        } else {
            log_message('error', 'Email gagal dikirim: ' . $this->email->print_debugger());
            return false;
        }
    }


    function get_detail_data_event()
    {
        // $id_event = '56';
        $id_event = $this->input->post('id_event');

        $data['event'] = $this->M_event_sales->m_get_detail_data_event($id_event);

        $response = [];
        foreach ($data['event'] as $event) {
            $response[] = [
                'id_user' => $event->iduser,
                'agency' => $event->agency,
                'email' => $event->email,
                'kontak' => $event->kontak,
                'alamatuser' => $event->alamatuser,
                'id_event' => $event->id_event,
                'nm_event' => $event->nm_event,
                'nm_kategori_event' => $event->nm_kategori_event,
                'tgl_event' => $event->tgl_event,
                'jam_event' => $event->jam_event,
                'mc_by' => $event->mc_by,
                'lokasi' => $event->lokasi,
                'nm_kota' => $event->nm_kota,
                'alamatevent' => $event->alamatevent,
                'desc_event' => $event->desc_event,
                'status_event' => $event->status_event,
                'id_proposal' => $event->id_proposal,
                'proposal_event' => $event->proposal_event,
            ];
        }
        echo json_encode($response);
    }

    function get_agency()
    {
        $query = $this->M_event_sales->m_get_agency();
        $data = "<option value=''>- Pilih Agency -</option>
        <option class='bg-warning' value='add'>Tambah Agency</option>";
        foreach ($query as $value) {
            $data .= "<option data-status='" . $value->privilage . "' value='" . $value->id_user . "'>" . $value->agency . "</option>";
        }
        echo $data;
    }
    function get_data_select_agency()
    {
        $id_user = $this->input->post('id_user');

        $data['user'] = $this->M_event_sales->m_get_data_select_agency($id_user);

        $response = [];
        foreach ($data['user'] as $user) {
            $response[] = [
                'agency' => $user->agency,
                'email' => $user->email,
                'kontak' => $user->kontak,
                'alamat' => $user->alamat,
                'privilage' => $user->privilage,
            ];
        }
        echo json_encode($response);
    }

    function get_ajax_kab()
    {
        $query = $this->M_event_sales->get_kabupaten();
        $data = "<option value=''>- Pilih Kota -</option>";
        foreach ($query as $value) {
            $data .= "<option value='" . $value->id . "'>" . $value->nama . "</option>";
        }
        echo $data;
    }

    function get_kategori_event()
    {
        $query = $this->M_event_sales->get_kategori();
        $data = "<option value=''>- Pilih Kategori -</option>";
        foreach ($query as $value) {
            $data .= "<option value='" . $value->id_kategori_event . "'>" . $value->nm_kategori_event . "</option>";
        }
        echo $data;
    }
}
