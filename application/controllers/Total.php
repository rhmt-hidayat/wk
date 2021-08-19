<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Total extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model(array('M_crud', 'M_master', 'M_transaksi'));
            $cookie = get_cookie('recruitment');
            if($this->session->userdata('logged') == FALSE)
            {
                delete_cookie('dokumen');
                redirect('Login', 'refresh');
            }
        }

        function index()
        {
            $tanggal = $this->input->post('tanggal');
            $proses = $this->input->post('form_proses');

            // if($proses == '')
            // {
            //     $data['grafik'] = $this->tampilGrafik($proses, $tanggal);
            //     $data['judul'] = "S-INA | Contact List | Total Report";
            //     $data['proses'] = $this->M_master->loadData('proses');
            //     $this->load->view('Include/header', $data);
            //     $this->load->view('Include/sidebar');
            //     $this->load->view('Total/index');
            //     $this->load->view('Include/footer'); 
            // }else{
                // $data['grafik'] = $this->tampilGrafik($proses, $tanggal);
                // $data['laporan'] = $this->laporanCountProses($proses, $tanggal);
                $data['judul'] = "S-INA | Contact List | Total Report";
                $data['proses'] = $this->M_master->loadData('proses');
                $this->load->view('Include/header', $data);
                $this->load->view('Include/sidebar');
                $this->load->view('Total/index');
                $this->load->view('Include/footer'); 
            // } 
        }

        function laporanCountProses($proses, $tanggal)
        {
            $result = $this->M_transaksi->getCountProses($proses, $tanggal);
            if(count($result) > 0)
            {
                return $result;
            }else
            {
                $this->session->set_flashdata('error', 'Data Tidak Ada');
                redirect('Total', 'refresh');
            }
        }

        function tampilGrafik($proses, $tanggal)
        {
            $result = $this->M_transaksi->getGrafik($proses, $tanggal);
            if(count($result) > 0)
            {
                return $result;
            }else
            {
                $this->session->set_flashdata('error', 'Data Tidak Ada');
                redirect('Total', 'refresh');
            }
        }
    }