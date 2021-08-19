<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Report extends CI_Controller
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
            if($this->input->post('filter') && $this->input->post('kriteria') == '')
            {
                $filter = $this->input->post('filter');
                $tanggal = $this->input->post('tanggal');
                $tgl1 = $this->input->post('tgl1');
                $tgl2 = $this->input->post('tgl2');
                $bulan = $this->input->post('bulan');
                $tahun = date("Y");
                $periode = $this->input->post('periode');
                if ($periode !== ''){
                    $result = $this->M_transaksi->getWaktu($periode);
                    foreach ($result as $row){
                        $tgl_awal = $row->tgl_periode1;
                        $tgl_akhir = $row->tgl_periode2;
                    }
                }

                if($filter == '1')
                {
                    $data['laporan'] = $this->laporanHarian($tanggal);
                }
                elseif($filter == '2')
                {
                    $data['laporan'] = $this->laporanMingguan($tgl1, $tgl2);
                }
                elseif($filter == '3')
                {
                    $data['laporan'] = $this->laporanBulan($bulan, $tahun);
                }
                elseif($filter == '4')
                {
                    $data['laporan'] = $this->laporanPeriode($tgl_awal, $tgl_akhir);
                }
                else
                {
                    $this->session->set_flashdata('error', 'Pilih Filter');
                    redirect('Report', 'refresh');
                }

                $data['judul'] = "S-INA | Working Ticket | Report";
                $data['dept'] = $this->M_master->loadDept();
                $data['periode'] = $this->M_master->loadPeriode();
                $data['karyawan'] = $this->M_master->loadKaryawan();
                $data['alasan'] = $this->M_master->loadReason();
                $data['part'] = $this->M_master->loadTabel('material');
                $this->load->view('Include/header', $data);
                $this->load->view('Include/sidebar');
                $this->load->view('Report/index');
                $this->load->view('Include/footer');
            }
            elseif($this->input->post('kriteria') && $this->input->post('filter') == '')
            {
                $kriteria = $this->input->post('kriteria');
                $parts = $this->input->post('form_parts');
                $proses = $this->input->post('form_proses');
                $operator = $this->input->post('form_operator');

                if($kriteria == '1')
                {
                    $data['laporan'] = $this->laporanParts($parts);
                }
                elseif($kriteria == '2')
                {
                    $data['laporan'] = $this->laporanProses($proses);
                }
                elseif($kriteria == '3')
                {
                    $data['laporan'] = $this->laporanOperator($operator);
                }
                else
                {
                    $this->session->set_flashdata('error', 'Pilih Kriteria');
                    redirect('Report', 'refresh');
                }

                $data['judul'] = "S-INA | Working Ticket | Report";
                $data['dept'] = $this->M_master->loadDept();
                $data['periode'] = $this->M_master->loadPeriode();
                $data['karyawan'] = $this->M_master->loadKaryawan();
                $data['alasan'] = $this->M_master->loadReason();
                $data['part'] = $this->M_master->loadTabel('material');
                $this->load->view('Include/header', $data);
                $this->load->view('Include/sidebar');
                $this->load->view('Report/index');
                $this->load->view('Include/footer');
            }
            elseif($this->input->post('filter') && ($this->input->post('kriteria')))
            {
                $filter = $this->input->post('filter');
                $tanggal = $this->input->post('tanggal');
                $tgl1 = $this->input->post('tgl1');
                $tgl2 = $this->input->post('tgl2');
                $bulan = $this->input->post('bulan');
                $tahun = date("Y");
                $periode = $this->input->post('periode');
                if ($periode !== ''){
                    $result = $this->M_transaksi->getWaktu($periode);
                    foreach ($result as $row){
                        $tgl_awal = $row->tgl_periode1;
                        $tgl_akhir = $row->tgl_periode2;
                    }
                }
                $kriteria = $this->input->post('kriteria');
                $parts = $this->input->post('form_parts');
                $proses = $this->input->post('form_proses');
                $operator = $this->input->post('form_operator');

                if($filter == '1' && $kriteria == '1') {
                    $data['laporan'] = $this->laporanHarianParts($tanggal, $parts);
                }elseif($filter == '1' && $kriteria == '2') {
                    $data['laporan'] = $this->laporanHarianProses($tanggal, $proses);
                }elseif($filter == '1' && $kriteria == '3') {
                    $data['laporan'] = $this->laporanHarianOperator($tanggal, $operator);
                }elseif($filter == '2' && $kriteria == '1'){
                    $data['laporan'] = $this->laporanMingguanParts($tgl1, $tgl2, $parts);
                }elseif($filter == '2' && $kriteria == '2'){
                    $data['laporan'] = $this->laporanMingguanProses($tgl1, $tgl2, $proses);
                }elseif($filter == '2' && $kriteria == '3'){
                    $data['laporan'] = $this->laporanMingguanOperator($tgl1, $tgl2, $operator);
                }elseif($filter == '3' && $kriteria == '1'){
                    $data['laporan'] = $data['laporan'] = $this->laporanBulanParts($bulan, $tahun, $parts);
                }elseif($filter == '3' && $kriteria == '2'){
                    $data['laporan'] = $data['laporan'] = $this->laporanBulanProses($bulan, $tahun, $proses);
                }elseif($filter == '3' && $kriteria == '3'){
                    $data['laporan'] = $data['laporan'] = $this->laporanBulanOperator($bulan, $tahun, $operator);
                }elseif($filter == '4' && $kriteria == '1'){
                    $data['laporan'] = $this->laporanPeriodeParts($tgl_awal, $tgl_akhir, $parts);
                }elseif($filter == '4' && $kriteria == '2'){
                    $data['laporan'] = $this->laporanPeriodeProses($tgl_awal, $tgl_akhir, $proses);
                }elseif($filter == '4' && $kriteria == '3'){
                    $data['laporan'] = $this->laporanPeriodeOperator($tgl_awal, $tgl_akhir, $operator);
                }else{
                    $this->session->set_flashdata('error', 'Pilih Filter');
                    redirect('Report', 'refresh');
                }
                
                $data['judul'] = "S-INA | Working Ticket | Report";
                $data['dept'] = $this->M_master->loadDept();
                $data['karyawan'] = $this->M_master->loadKaryawan();
                $data['periode'] = $this->M_master->loadPeriode();
                $data['alasan'] = $this->M_master->loadReason();
                $data['part'] = $this->M_master->loadTabel('material');
                $this->load->view('Include/header', $data);
                $this->load->view('Include/sidebar');
                $this->load->view('Report/index');
                $this->load->view('Include/footer');
            }
            else
            {
                $data['judul'] = "S-INA | Working Ticket | Report";
                $data['dept'] = $this->M_master->loadDept();
                $data['karyawan'] = $this->M_master->loadKaryawan();
                $data['periode'] = $this->M_master->loadPeriode();
                $data['alasan'] = $this->M_master->loadReason();
                $data['part'] = $this->M_master->loadTabel('material');
                $this->load->view('Include/header', $data);
                $this->load->view('Include/sidebar');
                $this->load->view('Report/index');
                $this->load->view('Include/footer');
            }
        }

        function laporanHarian($tanggal)
        {
            $result = $this->M_transaksi->getTanggal($tanggal);
            if(count($result) > 0)
            {
                return $result;
            }else
            {
                $this->session->set_flashdata('error', 'Data Tidak Ada');
                redirect('Report', 'refresh');
            }
        }

        function laporanMingguan($tgl1, $tgl2)
        {
            $tanggal_1 = new DateTime(date('Y-m-d', strtotime($tgl1)));
            $tanggal_2 = new DateTime(date('Y-m-d', strtotime($tgl2)));
            $minggu = $tanggal_2 ->diff($tanggal_1);
            $selisih = $minggu->d;
            //return $selisih;
            
            if($selisih <= 7){
                $result = $this->M_transaksi->getMinggu($tgl1, $tgl2);
                if(count($result) > 0)
                {
                    return $result;
                }else
                {
                    $this->session->set_flashdata('error', 'Data Tidak Ada');
                    redirect('Report', 'refresh');
                } 
            }else{
                    $this->session->set_flashdata('error', 'Input tanggal tidak lebih dari satu minggu');
                    redirect('Report', 'refresh'); 
                }
        }

        function laporanBulan($bulan, $tahun)
        {
            $result = $this->M_transaksi->getBulan($bulan, $tahun);
            if(count($result) > 0)
            {
                return $result;
            }else
            {
                $this->session->set_flashdata('error', 'Data Tidak Ada');
                redirect('Report', 'refresh');
            }
        }

        function laporanPeriode($tgl_periode1, $tgl_periode2)
        {
            $result = $this->M_transaksi->getPeriode($tgl_periode1, $tgl_periode2);
            if(count($result) > 0)
            {
                return $result;
            }else
            {
                $this->session->set_flashdata('error', 'Data Tidak Ada');
                redirect('Report', 'refresh');
            }
        }

        function laporanParts($parts)
        {
            $result = $this->M_transaksi->getParts($parts);
            if(count($result) > 0)
            {
                return $result;
            }else
            {
                $this->session->set_flashdata('error', 'Data Tidak Ada');
                redirect('Report', 'refresh');
            }
        }

        function laporanProses($proses)
        {
            $result = $this->M_transaksi->getProses($proses);
            if(count($result) > 0)
            {
                return $result;
            }else
            {
                $this->session->set_flashdata('error', 'Data Tidak Ada');
                redirect('Report', 'refresh');
            }
        }

        function laporanOperator($operator)
        {
            $result = $this->M_transaksi->getOperator($operator);
            if(count($result) > 0)
            {
                return $result;
            }else
            {
                $this->session->set_flashdata('error', 'Data Tidak Ada');
                redirect('Report', 'refresh');
            }
        }

        function laporanHarianParts($tanggal, $parts)
        {
            $result = $this->M_transaksi->getHarianParts($tanggal, $parts);
            if(count($result) > 0)
            {
                return $result;
            }else
            {
                $this->session->set_flashdata('error', 'Data Tidak Ada');
                redirect('Report', 'refresh');
            }
        }

        function laporanHarianProses($tanggal, $proses)
        {
            $result = $this->M_transaksi->getHarianProses($tanggal, $proses);
            if(count($result) > 0)
            {
                return $result;
            }else
            {
                $this->session->set_flashdata('error', 'Data Tidak Ada');
                redirect('Report', 'refresh');
            }
        }

        function laporanHarianOperator($tanggal, $operator)
        {
            $result = $this->M_transaksi->getHarianOperator($tanggal, $operator);
            if(count($result) > 0)
            {
                return $result;
            }else
            {
                $this->session->set_flashdata('error', 'Data Tidak Ada');
                redirect('Report', 'refresh');
            }
        }

        function laporanMingguanParts($tgl1, $tgl2, $parts)
        {
            $tanggal_1 = new DateTime(date('Y-m-d', strtotime($tgl1)));
            $tanggal_2 = new DateTime(date('Y-m-d', strtotime($tgl2)));
            $minggu = $tanggal_2 ->diff($tanggal_1);
            $selisih = $minggu->d;
            //return $selisih;
            
            if($selisih <= 7){
                $result = $this->M_transaksi->getMingguParts($tgl1, $tgl2, $parts);
                if(count($result) > 0)
                {
                    return $result;
                }else
                {
                    $this->session->set_flashdata('error', 'Data Tidak Ada');
                    redirect('Report', 'refresh');
                } 
            }else{
                    $this->session->set_flashdata('error', 'Input tanggal tidak lebih dari satu minggu');
                    redirect('Report', 'refresh'); 
                }
        }

        function laporanMingguanProses($tgl1, $tgl2, $proses)
        {
            $tanggal_1 = new DateTime(date('Y-m-d', strtotime($tgl1)));
            $tanggal_2 = new DateTime(date('Y-m-d', strtotime($tgl2)));
            $minggu = $tanggal_2 ->diff($tanggal_1);
            $selisih = $minggu->d;
            //return $selisih;
            
            if($selisih <= 7){
                $result = $this->M_transaksi->getMingguProses($tgl1, $tgl2, $proses);
                if(count($result) > 0)
                {
                    return $result;
                }else
                {
                    $this->session->set_flashdata('error', 'Data Tidak Ada');
                    redirect('Report', 'refresh');
                } 
            }else{
                    $this->session->set_flashdata('error', 'Input tanggal tidak lebih dari satu minggu');
                    redirect('Report', 'refresh'); 
                }
        }

        function laporanMingguanOperator($tgl1, $tgl2, $operator)
        {
            $tanggal_1 = new DateTime(date('Y-m-d', strtotime($tgl1)));
            $tanggal_2 = new DateTime(date('Y-m-d', strtotime($tgl2)));
            $minggu = $tanggal_2 ->diff($tanggal_1);
            $selisih = $minggu->d;
            //return $selisih;
            
            if($selisih <= 7){
                $result = $this->M_transaksi->getMingguOperator($tgl1, $tgl2, $operator);
                if(count($result) > 0)
                {
                    return $result;
                }else
                {
                    $this->session->set_flashdata('error', 'Data Tidak Ada');
                    redirect('Report', 'refresh');
                } 
            }else{
                    $this->session->set_flashdata('error', 'Input tanggal tidak lebih dari satu minggu');
                    redirect('Report', 'refresh'); 
                }
        }

        function laporanBulanParts($bulan, $tahun, $parts)
        {
            $result = $this->M_transaksi->getBulanParts($bulan, $tahun, $parts);
            if(count($result) > 0)
            {
                return $result;
            }else
            {
                $this->session->set_flashdata('error', 'Data Tidak Ada');
                redirect('Report', 'refresh');
            }
        }

        function laporanBulanProses($bulan, $tahun, $proses)
        {
            $result = $this->M_transaksi->getBulanProses($bulan, $tahun, $proses);
            if(count($result) > 0)
            {
                return $result;
            }else
            {
                $this->session->set_flashdata('error', 'Data Tidak Ada');
                redirect('Report', 'refresh');
            }
        }

        function laporanBulanOperator($bulan, $tahun, $operator)
        {
            $result = $this->M_transaksi->getBulanOperator($bulan, $tahun, $operator);
            if(count($result) > 0)
            {
                return $result;
            }else
            {
                $this->session->set_flashdata('error', 'Data Tidak Ada');
                redirect('Report', 'refresh');
            }
        }

        function laporanPeriodeParts($tgl_periode1, $tgl_periode2, $parts)
        {
            $result = $this->M_transaksi->getPeriodeParts($tgl_periode1, $tgl_periode2, $parts);
            if(count($result) > 0)
            {
                return $result;
            }else
            {
                $this->session->set_flashdata('error', 'Data Tidak Ada');
                redirect('Report', 'refresh');
            }
        }

        function laporanPeriodeProses($tgl_periode1, $tgl_periode2, $proses)
        {
            $result = $this->M_transaksi->getPeriodeProses($tgl_periode1, $tgl_periode2, $proses);
            if(count($result) > 0)
            {
                return $result;
            }else
            {
                $this->session->set_flashdata('error', 'Data Tidak Ada');
                redirect('Report', 'refresh');
            }
        }

        function laporanPeriodeOperator($tgl_periode1, $tgl_periode2, $operator)
        {
            $result = $this->M_transaksi->getPeriodeOperator($tgl_periode1, $tgl_periode2, $operator);
            if(count($result) > 0)
            {
                return $result;
            }else
            {
                $this->session->set_flashdata('error', 'Data Tidak Ada');
                redirect('Report', 'refresh');
            }
        }
    }