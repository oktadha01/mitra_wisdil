<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dash_sales extends AUTH_Controller
{
    var $template = 'tmpt_mitra/index';
    public $userdata;
    public $db;
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['userdata']        = $this->userdata;
        $data['tittle']          = 'Dashboard Sales';
        $data['bread']           = 'Dashboard';
        $data['total_event'] = $this->total_event();
        $data['total_transaksi'] = $this->total_transaksi();
        $data['total_profit'] = $this->total_profit();
        $data['dalam_proses_penarikan'] = $this->dalam_proses_penarikan();
        // $data['option']          = $this->Banner_kat_model->get_agency();
        $data['content']         = 'page_sales/dashboard/dashboard';
        $data['script']          = 'page_sales/dashboard/dashboard_js';
        $this->load->view($this->template, $data);
    }

    function total_event()
    {
        $id_sales = $this->userdata['id_sales'];
        $this->db->select('COUNT(*) as count');
        $this->db->from('event');
        $this->db->join('sales', 'event.id_sales_event = sales.id_sales');
        $this->db->where('sales.id_sales', $id_sales);
        $this->db->where('event.status_profit', 0);
        $this->db->where('event.status_event', 2);

        $query = $this->db->get();
        $count = $query->row()->count;

        return $count; // Return the count instead of echoing it
    }
    function total_transaksi()
    {
        $id_sales = $this->userdata['id_sales'];
        $this->db->select('COUNT(*) as count');
        $this->db->from('transaksi');
        $this->db->join('event', 'event.id_event = transaksi.id_event');
        $this->db->join('sales', 'event.id_sales_event = sales.id_sales');
        $this->db->where('sales.id_sales', $id_sales);
        $this->db->where('event.status_profit', 0);

        $query = $this->db->get();
        $count = $query->row()->count;

        return $count; // Return the count instead of echoing it
    }
    function total_profit()
    {
        $id_sales = $this->userdata['id_sales'];
        $this->db->select('COUNT(*) as count');
        $this->db->from('transaksi');
        $this->db->join('event', 'event.id_event = transaksi.id_event');
        $this->db->join('sales', 'event.id_sales_event = sales.id_sales');
        $this->db->where('sales.id_sales', $id_sales);
        $this->db->where('event.status_profit', 0);

        $query = $this->db->get();
        $count = $query->row()->count;

        return $count * 1000; // Return the count instead of echoing it
    }
    function dalam_proses_penarikan()
    {
        $id_sales = $this->userdata['id_sales'];

        // Use SQL aggregation to calculate the total count directly in the query
        $this->db->select('SUM(transaksi_sales.total_transaksi) AS total_transaksi');
        $this->db->from('transaksi_sales');
        $this->db->join('sales', 'transaksi_sales.sales_id = sales.id_sales', 'right');
        $this->db->where('sales.id_sales', $id_sales);
        $this->db->where('transaksi_sales.tgl_pembayaran', '');

        $query = $this->db->get();

        // Safely retrieve the total count or return 0 if no result is found
        $result = $query->row();
        $total_transaksi = $result ? (int)$result->total_transaksi : 0;

        return $total_transaksi; // Return the calculated total count
    }
}
