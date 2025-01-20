<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Mitra extends AUTH_Controller
{
    var $template = 'tmpt_mitra/index';
    public $userdata;
    public $session;
    public $db;
    public $input;
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
        $data['content']         = 'page_marketing/mitra/mitra';
        $data['script']          = 'page_marketing/mitra/mitra_js';
        $this->load->view($this->template, $data);
    }
}
