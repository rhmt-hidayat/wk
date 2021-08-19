<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Dashboard extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model(array('M_crud', 'M_master'));
            $cookie = get_cookie('recruitment');
            if($this->session->userdata('logged') == FALSE)
            {
                delete_cookie('dokumen');
                redirect('Login', 'refresh');
            }
        }

        function index()
        {
            $data['judul'] = "S-INA | Working Ticket | Dashboard";
            $this->load->view('Include/header', $data);
            $this->load->view('Include/sidebar');
            $this->load->view('Dashboard', $data);
            $this->load->view('Include/footer');
        }
    }