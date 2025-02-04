<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_event_sales extends AUTH_Controller
{
    var $template = 'tmpt_mitra/index';
    public $userdata;
    public $db;
    public $M_transaksi_event_sales;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_transaksi_event_sales');
    }

    public function index()
    {
        $data['userdata']        = $this->userdata;
        $data['tittle']          = 'Event Sales';
        $data['bread']           = 'Event';
        // $data['option']          = $this->Banner_kat_model->get_agency();
        $data['content']         = 'page_sales/transaksi_event_sales/transaksi_event_sales';
        $data['script']          = 'page_sales/transaksi_event_sales/transaksi_event_sales_js';
        $this->load->view($this->template, $data);
    }

    function get_datatransaksi()
    {
        $id_sales = $this->userdata['id_sales'];
        // $privilage = $this->session->userdata('userdata')->privilage;

        $list = $this->M_transaksi_event_sales->get_datatablest($id_sales);
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $prfm) {


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

            // echo "Singkatan: " . $singkatan; // Output: RE
            $no++;
            $row = [
                'no' => $no . ".",
                'inisial' => $singkatan,
                'event' => $prfm->nm_event,
                'tgl_event' => $prfm->tgl_event,
                'count' => $prfm->count,
                'profit' => number_format($prfm->count * 1000, 0, ',', '.'),
                'status_profit' => $prfm->status_profit,
            ];
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->M_transaksi_event_sales->count_all_trx($id_sales),
            "recordsFiltered" => $this->M_transaksi_event_sales->count_filtereds($id_sales),
            "data" => $data, // Ubah menjadi array meskipun hanya satu entri
        );

        echo json_encode($output);
    }
}
