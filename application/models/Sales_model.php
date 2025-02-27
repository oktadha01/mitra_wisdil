<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_model extends CI_Model
{
    var $column_ordertrx = array(null, 'transaksi.code_bayar','saldo.tanggal', 'saldo.nominal');
    var $column_searchtrx = array('transaksi.code_bayar','saldo.tanggal', 'saldo.nominal');
    var $ordertrx = array('transaksi.id_transaksi' => 'ASC');

    private function _get_datatables($id_event)
    {
            $this->db->select('*');
            $this->db->from('transaksi');
            $this->db->join('customer', 'customer.id_customer = transaksi.id_customer');
            $this->db->where('transaksi.id_event', $id_event);
            $this->db->order_by('transaksi.id_transaksi', 'DESC');

            $i = 0;
            foreach ($this->column_searchtrx as $trx) {
                if(@$_POST['search']['value']) {
                    if($i===0) {
                        $this->db->group_start();
                        $this->db->like($trx, $_POST['search']['value']);
                    } else {
                        $this->db->or_like($trx, $_POST['search']['value']);
                    }
                    if(count($this->column_searchtrx) - 1 == $i)
                        $this->db->group_end();
                }
                $i++;
            }

            if(isset($_POST['order'])) {
                $this->db->order_by($this->column_ordertrx[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            }  else if(isset($this->order)) {
                $order = $this->order;
                $this->db->order_by(key($order), $order[key($order)]);
            }
        }

    function get_datatablest($id_event) {
        $this->_get_datatables($id_event);
        if(@$_POST['length'] != -1)
        $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtereds($id_event) {
        $this->_get_datatables($id_event);
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_all($id_event) {
        $this->_get_datatables($id_event);
        return $this->db->count_all_results();
    }

    public function get_event_menu($limit, $start, $id_user,$search = '')
    {
        $this->db->select('event.*, user.id_user, user.agency');
        $this->db->from('event');
        $this->db->join('user', 'user.id_user = event.id_user');
        $this->db->where('event.id_user', $id_user);

        if (!empty($search)) {
            $this->db->like('nm_event', $search);
        }

        $this->db->order_by("id_event", "ASC");
        $this->db->limit($limit, $start);
        $query = $this->db->get();

        return $query;
    }

    public function get_tiket_terjual($id_event)
    {
        $this->db->select('COUNT(*) as total_tiket');
        $this->db->from('tiket');

        $this->db->join('transaksi', 'transaksi.code_bayar = tiket.code_bayar');
        $this->db->where('tiket.id_event', $id_event);
        $this->db->where('transaksi.status_transaksi', '1');

        $query = $this->db->get();
        return $query->row()->total_tiket ? $query->row()->total_tiket : 0;
    }

}