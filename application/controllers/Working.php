<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Working extends CI_Controller
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
            // $data['tgl_awal'] =  date("Y-m-d", strtotime($this->input->post('tgl_awal')));
            // $data['tgl_akhir'] =  date("Y-m-d", strtotime($this->input->post('tgl_akhir')));

            $data['judul'] = "S-INA | Contact List | Working Hours";
            $this->load->view('Include/header', $data);
            $this->load->view('Include/sidebar');
            $this->load->view('Working/index');
            $this->load->view('Include/footer');
        }

        function result()
        {
            $tgl_awal = $this->input->post('tgl_awal');
            $tgl_akhir = $this->input->post('tgl_akhir');
            $userid = $this->session->userdata('userid');
            $ip_address = $this->input->ip_address();
            $tanggal = date("Y-m-d");

            if(strtotime($tgl_awal) > strtotime($tgl_akhir))
            {
                $this->session->set_flashdata('error', 'Incorrect date range selected');
                redirect('Working', 'refresh');
            }
            else
            {
                $result = $this->M_transaksi->cekTemp($userid, $ip_address, $tanggal);
                if(count($result) > 0)
                {
                    $where = array(
                        'userid'        => $userid,
                        'rpt_date'      => $tanggal,
                        'ip_address'    => $ip_address
                    );

                    $delete = $this->M_crud->delete('tmp_wk_hour', $where);
                    if($delete)
                    {
                        while(strtotime($tgl_awal) <= strtotime($tgl_akhir))
                        {
                            $getKaryawan = $this->M_master->loadKaryawan();
                            if($getKaryawan)
                            {
                                foreach($getKaryawan as $kry)
                                {
                                    $data = array(
                                        'userid'        => $userid,
                                        'rpt_date'      => $tanggal,
                                        'tanggal'       => $tgl_awal,
                                        'ip_address'    => $ip_address,
                                        'NIK'           => $kry->NIK
                                    );
                                    
                                    $insert = $this->M_crud->insert('tmp_wk_hour', $data);
                                    if($insert)
                                    {
                                        $ambilData = $this->M_transaksi->getDataHour($kry->NIK, $tgl_awal);
                                        if(count($ambilData) > 0)
                                        {
                                            foreach($ambilData as $ad)
                                            {
                                                $teori      = $ad->teori;
                                                $aktual     = $ad->aktual;
                                                $balance    = $ad->balance;

                                                $dataUpdate = array(
                                                    'teori'     => $teori,
                                                    'aktual'    => $aktual,
                                                    'balance'   => $balance
                                                );

                                                $where = array(
                                                    'userid'    => $this->session->userdata('userid'),
                                                    'rpt_date'  => date("Y-m-d"),
                                                    'ip_address'    => $this->input->ip_address(),
                                                    'nik'       => $kry->NIK,
                                                    'tanggal'   => $tgl_awal
                                                );

                                                $updateData = $this->M_crud->update('tmp_wk_hour', $dataUpdate, $where);
                                            }
                                            
                                        }
                                        else
                                        {
                                            foreach($ambilData as $ad)
                                            {
                                                $teori      = 0;
                                                $aktual     = 0;
                                                $balance    = 0;

                                                $dataUpdate = array(
                                                    'teori'     => $teori,
                                                    'aktual'    => $aktual,
                                                    'balance'   => $balance
                                                );

                                                $where = array(
                                                    'userid'    => $this->session->userdata('userid'),
                                                    'rpt_date'  => date("Y-m-d"),
                                                    'ip_address'    => $this->input->ip_address(),
                                                    'nik'       => $kry->NIK,
                                                    'tanggal'   => $tgl_awal
                                                );

                                                $updateData = $this->M_crud->update('tmp_wk_hour', $dataUpdate, $where);
                                            }
                                        }
                                    }
                                }
                            }
                            else
                            {
                                $this->session->set_flashdata('error', 'Failed Generate Report');
                                redirect('Working', 'refresh');
                            }
                            $tgl_awal = date("Y-m-d", strtotime("+1 day", strtotime($tgl_awal)));
                        }

                        if($updateData)
                        {
                            $data['tgl_awal'] =  date("Y-m-d", strtotime($this->input->post('tgl_awal')));
                            $data['tgl_akhir'] =  date("Y-m-d", strtotime($this->input->post('tgl_akhir')));   
                            $data['judul'] = "S-INA | Contact List | Working Hours";
                            $data['karyawan'] = $this->M_master->loadKaryawan();
                            $data['tanggal'] = $this->M_transaksi->loadTanggal($this->input->post('tgl_awal'), $this->input->post('tgl_akhir'));
                            $data['data'] = $this->M_transaksi->loadDataTmp($this->input->post('tgl_awal'), $this->input->post('tgl_akhir'), $userid, $ip_address, $tanggal);
                            $this->load->view('Include/header', $data);
                            $this->load->view('Include/sidebar');
                            $this->load->view('Working/result', $data);
                            $this->load->view('Include/footer');
                        }
                        else
                        {
                            $this->session->set_flashdata('error', 'Failed Generate Report');
                            
                        }
                    }
                    else
                    {
                        $this->session->set_flashdata('error', 'Failed Generated Report');
                        redirect('Working', 'refresh');
                    }
                }
                else
                {  
                    while(strtotime($tgl_awal) <= strtotime($tgl_akhir))
                    {
                        $getKaryawan = $this->M_master->loadKaryawan();
                        if($getKaryawan)
                        {
                            foreach($getKaryawan as $kry)
                            {
                                $data = array(
                                    'userid'        => $userid,
                                    'rpt_date'      => $tanggal,
                                    'tanggal'       => $tgl_awal,
                                    'ip_address'    => $ip_address,
                                    'NIK'           => $kry->NIK
                                );
                                
                                $insert = $this->M_crud->insert('tmp_wk_hour', $data);
                                if($insert)
                                {
                                    $ambilData = $this->M_transaksi->getDataHour($kry->NIK, $tgl_awal);
                                    if(count($ambilData) > 0)
                                    {
                                        foreach($ambilData as $ad)
                                        {
                                            $teori      = $ad->teori;
                                            $aktual     = $ad->aktual;
                                            $balance    = $ad->balance;

                                            $dataUpdate = array(
                                                'teori'     => $teori,
                                                'aktual'    => $aktual,
                                                'balance'   => $balance
                                            );

                                            $where = array(
                                                'userid'    => $this->session->userdata('userid'),
                                                'rpt_date'  => date("Y-m-d"),
                                                'ip_address'    => $this->input->ip_address(),
                                                'nik'       => $kry->NIK,
                                                'tanggal'   => $tgl_awal
                                            );

                                            $updateData = $this->M_crud->update('tmp_wk_hour', $dataUpdate, $where);
                                        }
                                        
                                    }
                                    else
                                    {
                                        foreach($ambilData as $ad)
                                        {
                                            $teori      = 0;
                                            $aktual     = 0;
                                            $balance    = 0;

                                            $dataUpdate = array(
                                                'teori'     => $teori,
                                                'aktual'    => $aktual,
                                                'balance'   => $balance
                                            );

                                            $where = array(
                                                'userid'    => $this->session->userdata('userid'),
                                                'rpt_date'  => date("Y-m-d"),
                                                'ip_address'    => $this->input->ip_address(),
                                                'nik'       => $kry->nik,
                                                'tanggal'   => $tgl_awal
                                            );

                                            $updateData = $this->M_crud->update('tmp_wk_hour', $dataUpdate, $where);
                                        }
                                    }
                                }
                            }
                        }
                        else
                        {
                            $this->session->set_flashdata('error', 'Failed Generated Data');
                            redirect('Working', 'refresh');
                        }
                        
                        $tgl_awal = date("Y-m-d", strtotime("+1 day", strtotime($tgl_awal)));
                    }

                    if($updateData)
                    {
                        //$ambilData = $this->
                        $data['tgl_awal'] =  date("Y-m-d", strtotime($this->input->post('tgl_awal')));
                        $data['tgl_akhir'] =  date("Y-m-d", strtotime($this->input->post('tgl_akhir')));   
                        $data['judul'] = "S-INA | Contact List | Working Hours";
                        $data['karyawan'] = $this->M_master->loadKaryawan();
                        $data['tanggal'] = $this->M_transaksi->loadTanggal($tgl_awal, $tgl_akhir);
                        $data['data'] = $this->M_transaksi->loadDataTmp($this->input->post('tgl_awal'), $this->input->post('tgl_akhir'), $userid, $ip_address, $tanggal);
                        $this->load->view('Include/header', $data);
                        $this->load->view('Include/sidebar');
                        $this->load->view('Working/result', $data);
                        $this->load->view('Include/footer');
                    }
                    else
                    {
                        $this->session->set_flashdata('error', 'Failed Generate Report');
                            
                    }
                }
                
            }
        }

        function laporanWorking()
        {
            $result = $this->M_transaksi->loadWorking();
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