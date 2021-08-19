<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class M_crud extends CI_Model
    {
        function insert($table, $data)
        {
            return  $this->db->insert($table, $data);
        }

        function update($table, $data, $where)
        {
            return $this->db->update($table, $data, $where);
        }

        function delete($table, $where)
        {
            return $this->db->delete($table, $where);
        }


        function insert2($table, $data)
        {
            $db2 = $this->load->database('hris', TRUE);
            return  $db2->insert($table, $data);
        }

        function update2($table, $data, $where)
        {
            $db2 = $this->load->database('hris', TRUE);
            return $db2->update($table, $data, $where);
        }

        function delete2($table, $where)
        {
            $db2 = $this->load->database('hris', TRUE);
            return $db2->delete($table, $where);
        }
    }