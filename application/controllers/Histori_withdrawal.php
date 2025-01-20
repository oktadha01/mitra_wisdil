<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Histori_withdrawal extends AUTH_Controller
{
    var $template = 'tmpt_mitra/index';
    public $userdata;
    public $db;
    public $input;
    public $M_histori_withdrawal;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_histori_withdrawal');
    }

    public function index()
    {
        $id_sales = $this->userdata['id_sales'];
        
        $data['sales'] = $this->M_histori_withdrawal->m_get_datasales($id_sales);
        $data['tittle']          = 'histori Withdrawal';
        $data['bread']           = 'histori Withdrawal';
        $data['content']         = 'page_sales/histori-withdrawal/histori';
        $data['script']          = 'page_sales/histori-withdrawal/histori_js';
        $this->load->view($this->template, $data);
    }
    function get_histori_withdrawal()
    {
        // $id_user = $this->session->userdata('userdata')->id_user;
        // $privilage = $this->session->userdata('userdata')->privilage;

        $list = $this->M_histori_withdrawal->get_datatablest();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $trans) {

            $no++;
            // $row = array();
            // $row[] = $no . ".";
            // $row[] = '<a href="javascript:void(0)" class="font-weight-bold btn-no-wd" data-id-event="' . $trans->event_id . '" data-nominal="' .  number_format($trans->nominal_transaksi, 0, ',', '.') . '" data-biaya="' .  number_format($trans->biaya_transaksi, 0, ',', '.') . '" data-total="' .  number_format($trans->total_transaksi, 0, ',', '.') . '" data-toggle="modal" data-target="#exampleModalCenter">' . $trans->no_wd . '</a>';
            // $row[] = $trans->tgl_pengajuan . ' - ' . $trans->tgl_pembayaran;
            // $row[] = '<span class="text-info">Rp. ' . number_format($trans->nominal_transaksi, 0, ',', '.') . '</span>';
            // $row[] = '<span class="text-danger">Rp. ' . number_format($trans->biaya_transaksi, 0, ',', '.') . '</span>';
            // $row[] = '<span class="text-success">Rp. ' . number_format($trans->total_transaksi, 0, ',', '.') . '</span>';
            // $data[] = $row;

            $row = [
                'no' => $no++,
                'event_id' => $trans->event_id,
                'no_wd' => $trans->no_wd,
                'tgl_pengajuan' => $trans->tgl_pengajuan,
                'tgl_pembayaran' => $trans->tgl_pembayaran,
                'nominal_transaksi' => number_format($trans->nominal_transaksi, 0, ',', '.'),
                'biaya_transaksi' => number_format($trans->biaya_transaksi, 0, ',', '.'),
                'total_transaksi' => number_format($trans->total_transaksi, 0, ',', '.'),
            ];

            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->M_histori_withdrawal->count_all_trx(),
            "recordsFiltered" => $this->M_histori_withdrawal->count_filtereds(),
            "data" => $data,
        );

        echo json_encode($output);
    }

    function detail_withdrawal_event()
    {
        $event_id = $this->input->post('event_id');
        $no_wd = $this->input->post('no_wd');

        // Fetch event and bank details
        $list = $this->M_histori_withdrawal->get_event_withdrawal($event_id);
        $rekening = $this->M_histori_withdrawal->get_rekening_withdrawal($no_wd);

        // Initialize variables for bank details
        $rekening_an = '';
        $bank_nm = '';
        $rekening_no = '';

        // Assign bank details if available
        if (!empty($rekening)) {
            $rekening_an = $rekening[0]->rekening_an;
            $bank_nm = $rekening[0]->bank_nm;
            $rekening_no = $rekening[0]->rekening_no;
        }

        // Build response array
        $response = [
            'events' => [], // Array of event details
            'rekening_an' => $rekening_an,
            'bank_nm' => $bank_nm,
            'rekening_no' => $rekening_no,
        ];

        foreach ($list as $event) {
            $response['events'][] = [
                'nm_event' => $event->nm_event,
                'count' => $event->count,
                'nominal' => number_format($event->count * 1000, 0, ',', '.'),
            ];
        }

        // Return JSON response
        echo json_encode($response);
    }
}
