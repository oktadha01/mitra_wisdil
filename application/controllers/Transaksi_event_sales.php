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
        // $id_user = $this->session->userdata('userdata')->id_user;
        // $privilage = $this->session->userdata('userdata')->privilage;

        $list = $this->M_transaksi_event_sales->get_datatablest();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $prfm) {

            // // tombol edit
            // $editButton = '<a data-toggle="modal" data-target="#ubah-perform" class="btn btn-outline-warning btn-xs btn-edit" title="Ubah"
            // data-id_event="' . $prfm->id_event . '"><i class="fa fa-edit"></i></a>';


            // // tombol Hapus
            // $hapusButton = ' &nbsp; <a href="#" onclick="confirmDelete(' . $prfm->id_event . ');"  class="btn btn-outline-danger btn-xs" title="Hapus"><i class="fa fa-trash-o"></i></a>';

            // label
            // $status_profit = '';
            // $profit = '';
            // if ($prfm->status_profit == '0') {
            //     $profit = '<span class="text-success font-weight-bold">Rp. ' . number_format($prfm->count * 1000, 0, ',', '.') . '</span>';
            //     $status_profit = '<span class="blm-ditarik">Belum Ditarik</span>';
            // } elseif ($prfm->status_profit == '1') {
            //     $profit = '<span class="font-weight-bold">Rp. ' . number_format($prfm->count * 1000, 0, ',', '.') . '</span>';
            //     $status_profit = '<span class="diproses">Diproses</span>';
            // } elseif ($prfm->status_profit == '2') {
            //     $profit = '<span class="font-weight-bold">Rp. ' . number_format($prfm->count * 1000, 0, ',', '.') . '</span>';
            //     $status_profit = '<span class="dibayar">Dibayar</span>';
            // }
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

            // echo "Singkatan: " . $singkatan; // Output: RE
            $no++;
            // $row = array();
            // $row[] = $no . ".";
            // $row[] = ' &nbsp; ' . '<td class="font-weight-medium"><div class="badge badge-dark shadow-lg rounded">' . $prfm->nm_event . '</div></td>';
            // $row[] = $prfm->tgl_event;
            // $row[] = $prfm->count;
            // $row[] = $profit;
            // $row[] = $status_profit;
            // $data[] = $row;
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
        // $output = array(
        //     "draw" => @$_POST['draw'],
        //     "recordsTotal" => $this->M_transaksi_event_sales->count_all_trx(),
        //     "recordsFiltered" => $this->M_transaksi_event_sales->count_filtereds(),
        //     "data" => $row,
        // );
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->M_transaksi_event_sales->count_all_trx(),
            "recordsFiltered" => $this->M_transaksi_event_sales->count_filtereds(),
            "data" => $data, // Ubah menjadi array meskipun hanya satu entri
        );

        echo json_encode($output);
    }
}
