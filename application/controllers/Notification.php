<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notification extends CI_Controller
{
    public function index()
    {
        // Load the view
        $this->load->view('page_sales/notif/notification_view');
    }

    public function send_notification()
    {
        // Example data to send to the frontend
        $data = [
            'title' => 'Notifikasi Baru!',
            'body' => 'Ini adalah notifikasi dari server CodeIgniter.',
            'icon' => base_url('assets/images/icon/hijau.png') // Path ke ikon
        ];

        // Kirimkan data dalam format JSON
        echo json_encode($data);
    }
}
