<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

    class Dept extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model(array('M_crud', 'M_master'));
            $cookie = get_cookie('recruitment');
        }

        function index()
        {
            $data['judul'] = "S-INA | Working Ticket | Master Users";
            $data['users'] = $this->M_master->loadTabel('user_admin');
            $this->load->view('Include/header', $data);
            $this->load->view('Include/sidebar');
            $this->load->view('Users/index', $data);
            $this->load->view('Include/footer');
        }

        function insert()
        {
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $md5 = md5($password);
            $level = $this->input->post('level');

            $data = array(
                'nama'           => $nama,
                'email'          => $email,
                'password'       => $md5,
                'level'          => $level
            );

            // var_dump($data);
            $insert = $this->M_crud->insert('user_admin', $data);
            if($insert)
            {
                $this->session->set_flashdata('sukses', 'Berhasil Menambahkan Data User Baru');
                redirect('Dept', 'refresh');
            }
            else
            {
                $this->session->set_flashdata('error', 'Gagal Menambahkan Data User Baru');
                redirect('Dept', 'refresh');
            }
        }

        function edit($id)
        {
            $result = $this->M_master->cekUserbyID('user_admin', $id);
            if(count($result) > 0)
            {
                foreach($result as $row)
                {
                    $nama     = $row->nama;
                    $email    = $row->email;
                    $md5      = $row->password;
                    $level    = $row->level;
                }

                $data['edit'] = array(
                    'userid'        => $id,
                    'nama'          => $nama,
                    'email'         => $email,
                    'password'      => $md5,
                    'level'         => $level
                );

                $data['judul'] = "S-INA | Working Ticket | Master Process";
                $data['users'] = $this->M_master->loadTabel('user_admin');
                $this->load->view('Include/header', $data);
                $this->load->view('Include/sidebar');
                $this->load->view('Users/edit', $data);
                $this->load->view('Include/footer');
            }
            else
            {
                $this->session->set_flashdata('error', 'Data Tidak Ditemukan');
                redirect('Users', 'refresh');
            }
        }

        function update()
        {
            $id = $this->input->post('id');
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $md5 = md5($password);
            $level = $this->input->post('level');

            $data = array(
                'nama'           => $nama,
                'email'          => $email,
                'password'       => $md5,
                'level'          => $level
            );

            $where = array('userid' => $id);
            // var_dump($data);
            $update = $this->M_crud->update('user_admin', $data, $where);
            if($update)
            {
                $this->session->set_flashdata('sukses', 'Berhasil Merubah Data');
                redirect('Dept', 'refresh');
            }
            else
            {
                $this->session->set_flashdata('error', 'Gagal Merubah Data');
                redirect('Dept', 'refresh');
            }
        }

        function delete()
        {
            $id = $this->input->post('id');

            // $data = array('status'=> '1');
            $where = array('userid' => $id);

            $update = $this->M_crud->delete('user_admin', $where);
            if($update)
            {
                $this->session->set_flashdata('sukses', 'Berhasil Menghapus Data');
                redirect('Dept', 'refresh');
            }
            else
            {
                $this->session->set_flashdata('error', 'Gagal Menghapus Data');
                redirect('Dept', 'refresh');
            }
        }
    }