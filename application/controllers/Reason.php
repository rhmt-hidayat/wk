<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

    class Reason extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model(array('M_crud', 'M_master'));
            $cookie = get_cookie('recruitment');
        }

        function index()
        {
            $data['judul'] = "S-INA | Working Ticket | Master Process";
            $data['reason'] = $this->M_master->loadData('reason');
            $this->load->view('Include/header', $data);
            $this->load->view('Include/sidebar');
            $this->load->view('Reason/index', $data);
            $this->load->view('Include/footer');
        }

        function insert()
        {
            $kode = htmlspecialchars(htmlentities(html_escape(strtoupper($this->input->post('kode')))));
            $nama = htmlspecialchars(htmlentities(html_escape(ucwords($this->input->post('nama')))));
            $deskripsi = htmlspecialchars(htmlentities(html_escape(ucwords($this->input->post('deskripsi')))));

            $result = $this->M_master->cekDatabyCode('reason', $kode);
            if(count($result) > 0)
            {
                $this->session->set_flashdata('error', 'Kode Reason <strong><b>'.$kode.'</b></strong> Sudah Digunakan, Silahkan Gunakan Kode Reason Lain');
                redirect('Reason', 'refresh');
            }
            else
            {
                $data = array(
                    'kode'          => $kode,
                    'nama'          => $nama,
                    'deskripsi'   => $deskripsi,
                    'status'        => '1',
                    'created_date' => date('Y-m-d H:i:s'),
                    'created_by' => $this->session->userdata('level')
                );

                $insert = $this->M_crud->insert('reason', $data);
                if($insert)
                {
                    $this->session->set_flashdata('sukses', 'Berhasil Menambahkan Data Reason Baru');
                    redirect('Reason', 'refresh');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Gagal Menambahkan Data Proses Baru');
                    redirect('Proses', 'refresh');
                }
            }
        }

        function edit($id)
        {
            $result = $this->M_master->cekDatabyID('reason', $id);
            // var_dump($result);
            if(count($result) > 0)
            {
                foreach($result as $row)
                {
                    $kode           = $row->kode;
                    $nama           = $row->nama;
                    $deskripsi      = $row->deskripsi;
                }

                $data['edit'] = array(
                    'id'            => $id,
                    'kode'          => $kode,
                    'nama'          => $nama,
                    'deskripsi'     => $deskripsi,
                );

                $data['judul'] = "S-INA | Working Ticket | Master Reason";
                $data['reason'] = $this->M_master->loadData('reason');
                $this->load->view('Include/header', $data);
                $this->load->view('Include/sidebar');
                $this->load->view('Reason/edit', $data);
                $this->load->view('Include/footer');
            }
            else
            {
                $this->session->set_flashdata('error', 'Data Tidak Ditemukan');
                redirect('Reason', 'refresh');
            }
        }

        function update()
        {
            $id = $this->input->post('id');
            $kode = htmlspecialchars(htmlentities(html_escape(strtoupper($this->input->post('kode')))));
            $nama = htmlspecialchars(htmlentities(html_escape(ucwords($this->input->post('nama')))));
            $deskripsi = $this->input->post('deskripsi');

            $data = array(
                'kode'          => $kode,
                'nama'          => $nama,
                'deskripsi'     => $deskripsi,
                'last_date' => date('Y-m-d H:i:s'),
                'update_by' => $this->session->userdata('level')
            );

            $where = array('id' => $id);
            $update = $this->M_crud->update('reason', $data, $where);
            if($update)
            {
                $this->session->set_flashdata('sukses', 'Berhasil Merubah Data');
                redirect('Reason', 'refresh');
            }
            else
            {
                $this->session->set_flashdata('error', 'Gagal Merubah Data');
                redirect('Reason', 'refresh');
            }
        }

        function delete()
        {
            $id = $this->input->post('id');

            // $data = array('status'=> '1');
            $where = array('id' => $id);

            $update = $this->M_crud->delete('reason', $where);
            if($update)
            {
                $this->session->set_flashdata('sukses', 'Berhasil Menghapus Data');
                redirect('Reason', 'refresh');
            }
            else
            {
                $this->session->set_flashdata('error', 'Gagal Menghapus Data');
                redirect('Reason', 'refresh');
            }
        }
    }