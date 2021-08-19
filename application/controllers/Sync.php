<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Sync extends CI_Controller
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
            $data['judul'] = "S-INA | Working Ticket | Synchronize Data";
            $this->load->view('Include/header', $data);
            $this->load->view('Include/sidebar');
            $this->load->view('Sync/index', $data);
            $this->load->view('Include/footer');
        }

        function getData()
        {
            $tgl_awal   = $this->input->post('tgl_mulai');
            $tgl_akhir  = $this->input->post('tgl_selesai');

            $result = $this->M_master->loadMOK3($tgl_awal, $tgl_akhir);
            if(count($result) > 0)
            {
                echo count($result);
                foreach($result as $data)
                {
                    // echo str_replace(",","",$data->shiftCapacity);
                    // echo "<br>";
                    $cekData = $this->M_master->cekMO($data->FBillNo);
                    if(count($cekData) > 0)
                    {
                        $dataUpdate = array(
                            'FItemID'       => $data->FItemID,
                            'tanggal'       => date("Y-m-d",strtotime($data->FCheckDate)),
                            'mo_status'     => $data->FStatus,
                            'lot'           => $data->FGMPBatchNo,
                            'qty'           => $data->FQty,
                            'mesin'         => $data->FHeadSelfJ01114,
                            'source'        => $data->source,
                            'shiftcapacity' => str_replace(",","",$data->shiftCapacity)
                        );

                        $where = array('FBillNo' => $data->FBillNo);
                        $update = $this->M_crud->update('icmo', $dataUpdate, $where);
                        if($update)
                        {
                            $this->session->set_flashdata('sukses', 'Successfully sync data from K3');
                            redirect('Sync', 'refresh');
                        }
                        else
                        {
                            $this->session->set_flashdata('error', 'Failed to sync data from K3');
                            redirect('Sync', 'refresh');
                        }  
                    }
                    else
                    {
                        $dataInsert = array(
                            'FBillNo'           => $data->FBillNo,
                            'mo_status'         => $data->FStatus,
                            'FitemID'           => $data->FItemID,
                            'tanggal'           => date("Y-m-d", strtotime($data->FCheckDate)),
                            'lot'               => $data->FGMPBatchNo,
                            'qty'               => $data->FQty,
                            'mesin'             => $data->FHeadSelfJ01114,
                            'source'            => $data->source,
                            'shiftcapacity'     => str_replace(",","",$data->shiftCapacity),
                            'status'            => '1'
                        );

                        $insert = $this->M_crud->insert('icmo', $dataInsert);
                        
                    }
                }
                if($update)
                {
                    $this->session->set_flashdata('sukses', 'Successfully sync data from K3');
                    redirect('Sync', 'refresh');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Failed to sync data from K3');
                    redirect('Sync', 'refresh');
                }
                if($insert)
                {
                    $this->session->set_flashdata('sukses', 'Successfully sync data from K3');
                    redirect('Sync', 'refresh');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Failed to sync data from K3');
                    redirect('Sync', 'refresh');
                }
            }
            else
            {
                $this->session->set_flashdata('error', 'Failed to sync data from K3');
                redirect('Sync', 'refresh');
            }   
        }

        function loadMaterial()
        {
            $result = $this->M_master->loadMaterial();
            if(count($result) > 0)
            {
                foreach($result as $data)
                {
                    $id = $data->FItemID;
                    $cekMaterial = $this->M_master->cekMaterial($id);
                    if(count($cekMaterial) > 0)
                    {
                        $dataUpdate = array(
                            'FNumber'   => $data->FNumber,
                            'FName'     => $data->FName,
                            'FModel'    => $data->FModel,
                            'FSource'   => $data->FSource
                        );

                        $where = array('FItemID' => $data->FItemID);
                        $update = $this->M_crud->update('material', $dataUpdate, $where);
                        if($update)
                        {
                            $this->session->set_flashdata('sukses', 'Successfully sync data from K3');
                            redirect('Sync', 'refresh');
                        }
                        else
                        {
                            $this->session->set_flashdata('error', 'Failed to sync data from K3');
                            redirect('Sync', 'refresh');
                        }
                    }
                    else
                    {
                        $dataInsert = array(
                            'FItemID'   => $data->FItemID,
                            'FNumber'   => $data->FNumber,
                            'FName'     => $data->FName,
                            'FModel'    => $data->FModel,
                            'FSource'   => $data->FSource
                        );

                        $insert = $this->M_crud->insert('material', $dataInsert);
                        if($insert)
                        {
                            $this->session->set_flashdata('sukses', 'Successfully sync data from K3');
                            redirect('Sync', 'refresh');
                        }
                        else
                        {
                            $this->session->set_flashdata('error', 'Failed to sync data from K3');
                            redirect('Sync', 'refresh');
                        }
                    }
                }      
            }
            else
            {
                $this->session->set_flashdata('error', 'Failed to sync data from K3');
                redirect('Sync', 'refresh');
            }
        }

        function loadDept()
        {
            $result = $this->M_master->loadDeptK3();
            if(count($result) > 0)
            {
                foreach($result as $data)
                {
                    $id = $data->FItemID;
                    $cekDept = $this->M_master->cekDeptK3($id);
                    if(count($cekDept) > 0)
                    {
                        $dataUpdate = array(
                            'FNumber' => $data->FNumber,
                            'FName'   => $data->FName
                        );

                        $where = array('FItemID', $id);

                        $update = $this->M_crud->update('department', $dataUpdate, $where);
                    }
                    else
                    {
                        $dataInsert = array(
                            'FItemID'   => $data->FItemID,
                            'FNumber'   => $data->FNumber,
                            'FName'     => $data->FName
                        );

                        $insert = $this->M_crud->insert('department', $dataInsert);
                    }
                }

                if($update)
                {
                    $this->session->set_flashdata('sukses', 'Successfully sync data from K3');
                    redirect('Sync', 'refresh');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Failed to sync data from K3');
                    redirect('Sync', 'refresh');
                }

                if($insert)
                {
                    $this->session->set_flashdata('sukses', 'Successfully sync data from K3');
                    redirect('Sync', 'refresh');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Failed to sync data from K3');
                    redirect('Sync', 'refresh');
                }
            }
            else
            {
                $this->session->set_flashdata('error', 'Failed to sync data from K3');
                redirect('Sync', 'refresh');
            }
        }
    }