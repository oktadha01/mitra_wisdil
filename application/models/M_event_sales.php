<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_event_sales extends CI_Model
{
    var $column_ordertrx = array(null, 'event.nm_event', 'event.tgl_event', null);
    var $column_searchtrx = array('event.nm_event');
    var $ordertrx = array('event.id_event' => 'asc');

    private function _get_datatables_trx($id_sales)
    {
        $this->db->select('event.*, transaksi.url_payment');
        $this->db->from('event');
        $this->db->join('transaksi', 'event.id_event = transaksi.id_event', 'LEFT');
        $this->db->where('event.id_sales_event', $id_sales);
        $this->db->group_by('event.id_event');
        $i = 0;
        foreach ($this->column_searchtrx as $trx) {
            if (@$_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($trx, $_POST['search']['value']);
                } else {
                    $this->db->or_like($trx, $_POST['search']['value']);
                }
                if (count($this->column_searchtrx) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_ordertrx[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }



    function get_datatablest($id_sales)
    {
        $this->_get_datatables_trx($id_sales);
        if (@$_POST['length'] != -1)
            $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtereds($id_sales)
    {
        $this->_get_datatables_trx($id_sales);
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_all_trx($id_sales)
    {
        $this->_get_datatables_trx($id_sales);
        return $this->db->count_all_results();
    }

    // Insert agency data into the `user` table and return the `id_user`
    public function M_simpan_data_agency($data_agancy)
    {
        $this->db->insert('user', $data_agancy);
        return $this->db->insert_id(); // Return the last inserted id_user
    }

    // Insert event data into the `event` table
    public function M_simpan_data_event($data_event)
    {
        $this->db->insert('event', $data_event);
        return $this->db->insert_id(); // Optional: Return the inserted id_event if needed
    }
    // Insert proposal data into the `proposal` table
    public function M_simpan_data_proposal($data_proposal)
    {
        $this->db->insert('proposal', $data_proposal);
        return $this->db->insert_id(); // Optional: Return the inserted id_event if needed
    }

    function m_get_detail_data_event($id_event)
    {
        $this->db->select('
        user.agency, 
        user.email, 
        user.kontak, 
        user.alamat as alamatuser,
        kategori_event.nm_kategori_event,
        wilayah_kabupaten.nama as nm_kota,
        event.id_user as iduser, 
        event.id_event, 
        event.nm_event, 
        event.tgl_event, 
        event.jam_event, 
        event.mc_by, 
        event.lokasi, 
        event.alamat as alamatevent, 
        event.desc_event, 
        event.status_event, 
        proposal.id_proposal, 
        proposal.proposal_event, 
        ');
        $this->db->from('user');
        $this->db->join('event', 'user.id_user = event.id_user'); // Pastikan hubungan tabel benar
        $this->db->join('kategori_event', 'kategori_event.id_kategori_event = event.id_kategori_event'); // Pastikan hubungan tabel benar
        $this->db->join('wilayah_kabupaten', 'wilayah_kabupaten.id = event.kota'); // Pastikan hubungan tabel benar
        $this->db->join('proposal', 'proposal.id_event_proposal = event.id_event', 'left'); // Pastikan hubungan tabel benar
        $this->db->where("event.id_event", $id_event);
        $query = $this->db->get();

        return $query->result(); // Mengembalikan hasil sebagai array objek
    }

    function m_get_agency()
    {
        $this->db->select('user.id_user, user.agency, user.privilage');
        $this->db->from('user');
        $this->db->where_in('user.privilage', array('User', ''));
        $query = $this->db->get();

        return $query->result();
    }

    function m_get_data_select_agency($id_user)
    {

        $this->db->select('user.agency, user.email, user.kontak, user.alamat, user.privilage');
        $this->db->from('user');
        $this->db->where('id_user', $id_user);
        $query = $this->db->get();

        return $query->result();
    }
    function get_kabupaten()
    {
        $this->db->select('*');
        $this->db->from('wilayah_kabupaten');
        $query = $this->db->get();

        return $query->result();
    }

    function get_kategori()
    {
        $this->db->select('*');
        $this->db->from('kategori_event');
        $query = $this->db->get();

        return $query->result();
    }
}
