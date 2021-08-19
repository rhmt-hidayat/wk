<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Transaksi extends CI_Controller
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
            $data['judul'] = "S-INA | Working Ticket | Transaction";
            $data['transaksi'] = $this->M_master->loadTransaksi();
            $data['kode'] = $this->M_transaksi->kode();
            $data['tampil'] = $this->M_transaksi->tampil();
            $data['dept'] = $this->M_master->loadDept();
            $data['karyawan'] = $this->M_master->loadKaryawan();
            $data['alasan'] = $this->M_master->loadReason();
            $this->load->view('Include/header', $data);
            $this->load->view('Include/sidebar');
            $this->load->view('Transaksi/index', $data);
            $this->load->view('Include/footer');
        }

        function add()
        {
            $data['judul'] = "S-INA | Working Ticket | Transaction";
            $data['kode'] = $this->M_transaksi->kode();
            $data['tampil'] = $this->M_transaksi->tampil();
            $data['dept'] = $this->M_master->loadDept();
            $data['karyawan'] = $this->M_master->loadKaryawan();
            $this->load->view('Include/header', $data);
            $this->load->view('Include/sidebar');
            $this->load->view('Transaksi/add', $data);
            $this->load->view('Include/footer');
        }   

        public function getMo()
        {
            $FItemID = $this->input->post('FItemID');
            $dataMo = $this->M_transaksi->getMoByProses($FItemID);
            echo json_encode($dataMo);
        }

        public function getDataMo()
        {
            $id = $this->input->post('id');
            $result = $this->M_transaksi->getDatabyMo($id);
            if(count($result) > 0)
            {
                foreach($result as $r)
                {
                    $batch      = $r->lot;
                    $planed     = $r->tanggal;
                    $part       = $r->FNumber;
                    $qty_planed = $r->qty;
                    $capacity   = $r->shiftcapacity;
                    $machine    = $r->mesin;
                }

                $data = array(
                    'lot'           => $batch,
                    'tanggal'       => $planed,
                    'FNumber'       => $part,
                    'qty'           => $qty_planed,
                    'shiftcapacity' => $capacity,
                    'mesin'         => $machine,
                );
                echo json_encode($data);
            }
        }

        function getReason()
        {
            $dataReason = $this->M_master->loadData('reason');
            echo json_encode($dataReason);
        }

        function insert()
        {
            $kode = $this->input->post('kode');
            $tanggal = $this->input->post('tanggal');
            $proses = $this->input->post('proses');
            $mo = $this->input->post('mo');
            $batch = $this->input->post('batch');
            $planed = $this->input->post('planed');
            $part = $this->input->post('part');
            $qty_planed = $this->input->post('qty_planed');
            $capacity = $this->input->post('capacity');
            $machine = $this->input->post('machine');
            $operator = $this->input->post('operator');
            $shift = $this->input->post('shift');
            $qty_qualified = $this->input->post('qty_qualified');
            $theoretic = $this->input->post('theoretic');
            $actual = $this->input->post('actual');
            $status = $this->input->post('status');
            $alasan = $this->input->post('reason');
            if($alasan == '')
            {
                $reason = '';
            }
            else
            {
                $reason = implode(",", $this->input->post('reason'));
            }
            
            
            
            $data = array(
                'WT_no'         => $kode,
                'WT_date'       => $tanggal,
                'proses_name'   => $proses,
                'MO_no'         => $mo,
                'batch_no'      => $batch,
                'MO_date'       => $planed,
                'part_no'       => $part,
                'qty_planed'    => $qty_planed,
                'shiftcapacity' => $capacity,
                'machine_no'    => $machine,
                'operator_name' => $operator,
                'shift'         => $shift,
                'qty_qualified' => $qty_qualified,
                'theoretic'     => $theoretic,
                'actual'        => $actual,
                'reason'        => json_encode($reason),
                'status'        => $status,
                'created_date'  => date('Y-m-d H:i:s'),
                'created_by'    => $this->session->userdata('userid')
            );
            // var_dump($status);
            $insert = $this->db->insert('tr_workticket', $data);
            // $result = $this->M_transaksi->updateStatus($status,$mo);
            // var_dump($result);
            if($insert)
            {
                $submit = $this->input->post('submit');
                $id = $this->input->post('mo');
                $qty_planed = $this->input->post('qty_planed');
                $qty_qualified = $this->input->post('qty_qualified');
                if($this->input->post('qty_planed') == $this->input->post('qty_qualified')){
                    $status = '0';
                } else {
                    $status = '1';
                }
                //echo $status;

                $dataUpdate = array('status' => $status);
                $where = array('FBillNo' => $id);

                $result = $this->M_crud->update('icmo', $dataUpdate, $where);
                if($result)
                {
                    if ($submit == 1) {
                        $this->session->set_flashdata('sukses', 'Berhasil Menambahkan Data Proses Baru');
                        redirect('Transaksi', 'refresh');
                    }
                    if ($submit == 0) {
                        $this->session->set_flashdata('sukses', 'Berhasil Menambahkan Data Proses Baru');
                        redirect('Transaksi/add', 'refresh');
                    }
                }
                else
                {
                    $this->session->set_flashdata('error', 'Error');
                    redirect('Transaksi', 'refresh');
                }
                
            }
            else
            {
                $this->session->set_flashdata('error', 'Gagal Menambahkan Data Proses Baru');
                redirect('Transaksi', 'refresh');
            }
        }

        function edit($id)
        {
            $result = $this->M_master->cekDatabyID('tr_workticket', $id);
            // var_dump($result);
            foreach($result as $row)
            {
                $kode          = $row->WT_no;
                $tanggal       = $row->WT_date;
                $proses        = $row->proses_name;
                $mo            = $row->MO_no;
                $batch         = $row->batch_no;
                $planed        = $row->MO_date;
                $part          = $row->part_no;
                $qty_planed    = $row->qty_planed;
                $capacity      = $row->shiftcapacity;
                $machine       = $row->machine_no;
                $operator      = $row->operator_name;
                $shift         = $row->shift;
                $qty_qualified = $row->qty_qualified;
                $theoretic     = $row->theoretic;
                $actual        = $row->actual;
                $status        = $row->status;
                $reason        = $row->reason;
            }

            $data['edit'] = array(
                'id'            => $id,
                'WT_no'         => $kode,
                'WT_date'       => $tanggal,
                'proses_name'   => $proses,
                'MO_no'         => $mo,
                'batch_no'      => $batch,
                'MO_date'       => $planed,
                'part_no'       => $part,
                'qty_planed'    => $qty_planed,
                'shiftcapacity' => $capacity,
                'machine_no'    => $machine,
                'operator_name' => $operator,
                'shift'         => $shift,
                'qty_qualified' => $qty_qualified,
                'theoretic'     => $theoretic,
                'actual'        => $actual,
                'status'        => $status,
                'reason'        => json_encode($reason),
            );

            $data['judul'] = "S-INA | Working Ticket | Master Transaction";
            $data['dept'] = $this->M_master->loadDept();
            $data['icmo'] = $this->M_master->loadMo();
            $data['alasan'] = $this->M_master->loadReason();
            $data['karyawan'] = $this->M_master->loadKaryawan();
            $this->load->view('Include/header', $data);
            $this->load->view('Include/sidebar');
            $this->load->view('Transaksi/edit', $data);
            $this->load->view('Include/footer');
        }

        function update()
        {
            $id = $this->input->post('id');
            $kode = $this->input->post('kode');
            $tanggal = $this->input->post('tanggal');
            $proses = $this->input->post('proses');
            $mo = $this->input->post('mo');
            $batch = $this->input->post('batch');
            $planed = $this->input->post('planed');
            $part = $this->input->post('part');
            $qty_planed = $this->input->post('qty_planed');
            $capacity = $this->input->post('capacity');
            $machine = $this->input->post('machine');
            $operator = $this->input->post('operator');
            $shift = $this->input->post('shift');
            $qty_qualified = $this->input->post('qty_qualified');
            $theoretic = $this->input->post('theoretic');
            $actual = $this->input->post('actual');
            $status = $this->input->post('status');
            $alasan = $this->input->post('reason');
            if($alasan == '')
            {
                $reason = '';
            }
            else
            {
                $reason = implode(",", $this->input->post('reason'));
            }
            
            $data = array(
                'id'            => $id,
                'WT_no'         => $kode,
                'WT_date'       => $tanggal,
                'proses_name'   => $proses,
                'MO_no'         => $mo,
                'batch_no'      => $batch,
                'MO_date'       => $planed,
                'part_no'       => $part,
                'qty_planed'    => $qty_planed,
                'shiftcapacity' => $capacity,
                'machine_no'    => $machine,
                'operator_name' => $operator,
                'shift'         => $shift,
                'qty_qualified' => $qty_qualified,
                'theoretic'     => $theoretic,
                'actual'        => $actual,
                'status'        => $status,
                'reason'        => json_encode($reason),
                'last_date'     => date('Y-m-d H:i:s'),
                'update_by'     => $this->session->userdata('userid')
            );

            $where = array('id' => $id);
            $update = $this->M_crud->update('tr_workticket', $data, $where);
            if($update)
            {
                $id = $this->input->post('mo');
                $qty_planed = $this->input->post('qty_planed');
                $qty_qualified = $this->input->post('qty_qualified');
                if($this->input->post('qty_planed') == $this->input->post('qty_qualified')){
                    $status = '0';
                } else {
                    $status = '1';
                }
                //echo $status;

                $dataUpdate = array('status' => $status);
                $where = array('FBillNo' => $id);

                $result = $this->M_crud->update('icmo', $dataUpdate, $where);
                if($result)
                {
                    $this->session->set_flashdata('sukses', 'Berhasil Menambahkan Data Proses Baru');
                    redirect('Transaksi', 'refresh');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Error');
                    redirect('Transaksi', 'refresh');
                }
            }
            else
            {
                $this->session->set_flashdata('error', 'Gagal Merubah Data');
                redirect('Transaksi', 'refresh');
            }         
        }

        function delete()
        {
            $id = $this->input->post('id');
            $result = $this->M_master->cekDatabyID('tr_workticket', $id);
            foreach($result as $rs){
                $mo = $rs->MO_no;
            }
            $dataUpdate = array ('status' => '1');
            
            $whereUpdate = array(
                'FBillNo' => $mo,
            );
            $update = $this->M_crud->update('icmo', $dataUpdate, $whereUpdate);
            if($update){
                $where = array('id' => $id);
                $delete = $this->M_crud->delete('tr_workticket', $where);
                if($delete)
                {
                    $this->session->set_flashdata('sukses', 'Berhasil Menghapus Data transaksi Baru');
                    redirect('Transaksi', 'refresh');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Error');
                    redirect('Transaksi', 'refresh');
                }
            }else {
                $this->session->set_flashdata('error', 'Error');
                redirect('Transaksi', 'refresh');
            }
        }
    }