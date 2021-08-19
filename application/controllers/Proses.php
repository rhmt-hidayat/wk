<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

    class Proses extends CI_Controller
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
            $data['judul'] = "S-INA | Working Ticket | Master Process";
            $data['proses'] = $this->M_master->loadData('proses');
            $this->load->view('Include/header', $data);
            $this->load->view('Include/sidebar');
            $this->load->view('Proses/index', $data);
            $this->load->view('Include/footer');
        }

        function insert()
        {
            $kode = htmlspecialchars(htmlentities(html_escape(strtoupper($this->input->post('kode')))));
            $nama = htmlspecialchars(htmlentities(html_escape(ucwords($this->input->post('nama')))));
            $deskripsi = htmlspecialchars(htmlentities(html_escape(ucwords($this->input->post('deskripsi')))));

            $result = $this->M_master->cekDatabyCode('proses', $kode);
            if(count($result) > 0)
            {
                $this->session->set_flashdata('error', 'Kode Proses <strong><b>'.$kode.'</b></strong> Sudah Digunakan, Silahkan Gunakan Kode Proses Lain');
                redirect('Proses', 'refresh');
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

                $insert = $this->M_crud->insert('proses', $data);
                if($insert)
                {
                    $this->session->set_flashdata('sukses', 'Berhasil Menambahkan Data Proses Baru');
                    redirect('Proses', 'refresh');
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
            $result = $this->M_master->cekDatabyID('proses', $id);
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

                $data['judul'] = "S-INA | Working Ticket | Master Process";
                $data['proses'] = $this->M_master->loadData('proses');
                $this->load->view('Include/header', $data);
                $this->load->view('Include/sidebar');
                $this->load->view('Proses/edit', $data);
                $this->load->view('Include/footer');
            }
            else
            {
                $this->session->set_flashdata('error', 'Data Tidak Ditemukan');
                redirect('Proses', 'refresh');
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
            $update = $this->M_crud->update('proses', $data, $where);
            // var_dump($data);
            if($update)
            {
                $this->session->set_flashdata('sukses', 'Berhasil Merubah Data');
                redirect('Proses', 'refresh');
            }
            else
            {
                $this->session->set_flashdata('error', 'Gagal Merubah Data');
                redirect('Proses', 'refresh');
            }
        }

        function delete()
        {
            $id = $this->input->post('id');

            // $data = array('status'=> '1');
            $where = array('id' => $id);

            $update = $this->M_crud->delete('proses', $where);
            if($update)
            {
                $this->session->set_flashdata('sukses', 'Berhasil Menghapus Data');
                redirect('Proses', 'refresh');
            }
            else
            {
                $this->session->set_flashdata('error', 'Gagal Menghapus Data');
                redirect('Proses', 'refresh');
            }
        }
    }