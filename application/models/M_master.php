<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class M_master extends CI_Model
    {
        //private $db2 = $this->load->database('hris', TRUE);
        
        function __construct()
        {   
            parent::__construct();
        }

        function cekDatabyCode($table, $kode)
        {
            $this->db->where('kode', $kode);
            $this->db->where('status', '1');
            
            return $this->db->get($table)->result();
        }

        function cekDatabyCode2($table, $kode)
        {
            $db2 = $this->load->database('hris', TRUE);

            $db2->where('kode', $kode);
            $db2->where('status', '1');
            
            return $db2->get($table)->result();
        }

        function cekDatabyID($table, $id)
        {
            $this->db->where('id', $id);

            return $this->db->get($table)->result();
        }

        function cekUserbyID($table, $id)
        {
            $this->db->where('userid', $id);

            return $this->db->get($table)->result();
        }

        function cekDatabyID2($table, $id)
        {
            $db2 = $this->load->database('hris', TRUE);

            $db2->where('id', $id);

            return $db2->get($table)->result();
        }

        function loadData($table)
        {
            $this->db->where('status', '1');
            $this->db->order_by('kode', 'ASC');

            return $this->db->get($table)->result();
        }


        function loadReason()
        {
            return $this->db->get('reason')->result();
        }

        // function loadPeriode()
        // {
        //     return $this->db->get()->result();
        // }

        function loadTabel($table)
        {
            return $this->db->get($table)->result();
        }

        //update 2021-06-19
        function loadTransaksi()
        {
            $this->db->select('tr_workticket.*, department.FName as namaProses');
            $this->db->join('department', 'tr_workticket.proses_name = department.FItemID');
            $this->db->order_by('WT_no', 'ASC');
            return $this->db->get('tr_workticket')->result();
        }

        function loadKabinet()
        {
            $this->db->select('kabinet.*, lokasi.nama as nama_lokasi');
            $this->db->join('lokasi', 'kabinet.lokasi = lokasi.id', 'LEFT');
            $this->db->where('kabinet.status', '1');
            $this->db->order_by('kode', 'ASC');

            return $this->db->get('kabinet')->result();
        }

        function loadBIN()
        {
            $this->db->select('bin.*, kabinet.nama as nama_kabinet, lokasi.nama as nama_lokasi');
            $this->db->join('kabinet', 'bin.kabinet = kabinet.id', 'LEFT');
            $this->db->join('lokasi', 'kabinet.lokasi = lokasi.id', 'LEFT');
            $this->db->where('bin.status', '1');
            $this->db->order_by('bin.kode', 'ASC');

            return $this->db->get('bin')->result();
        }

        function loadDept()
        {
            // $db2 = $this->load->database('hris', TRUE);

            // $db2->where('status', '1');
            // $db2->order_by('kode', 'ASC');

            // return $db2->get('department')->result();
            return $this->db->get('department')->result();
        }

        function loadMo()
        {
            return $this->db->get('icmo')->result();
        }

        function loadKaryawan()
        {
            $db2 = $this->load->database('hris', TRUE);
            
            $db2->select('*');
            $db2->where('status', '1');
            $db2->order_by('NIK', 'ASC');

            return $db2->get('karyawan')->result();
        }

        function loadKabinetbyLokasi($lokasi)
        {
            $this->db->where('lokasi', $lokasi);
            $this->db->where('status', '1');
            $this->db->order_by('kode', 'ASC');

            return $this->db->get('kabinet')->result();
        }

        function loadBinbyKabinet($lemari)
        {
            $this->db->where('kabinet', $lemari);
            $this->db->where('status', '1');
            $this->db->order_by('kode', 'ASC');

            return $this->db->get('bin')->result();
        }

        function loadDokumen()
        {
            $this->db->select('dokumen.*, lokasi.nama as nama_lokasi, kabinet.nama as nama_kabinet, bin.nama as nama_bin, folder.nama as nama_folder');

            $this->db->join('lokasi', 'dokumen.lokasi = lokasi.id', 'LEFT');
            $this->db->join('kabinet', 'dokumen.kabinet = kabinet.id', 'LEFT');
            $this->db->join('bin', 'dokumen.bin = bin.id', 'LEFT');
            $this->db->join('folder', 'dokumen.folder = folder.id', 'LEFT');
            $this->db->where('dokumen.status', '1');

            return $this->db->get('dokumen')->result();
        }

        function cekMO($noMO)
        {
            $this->db->where('FBillNo', $noMO);
            return $this->db->get('icmo')->result();
        }

        function loadMaterial()
        {
            $db3 = $this->load->database('mssql', TRUE);

            $db3->where('FDeleted', '0');

            return $db3->get('t_ICItem')->result();
        }

        function cekMaterial($id)
        {
            $this->db->where('FItemID', $id);

            return $this->db->get('material')->result();
        }

        function loadDeptK3()
        {
            $db3 = $this->load->database('mssql', TRUE);

            return $db3->get('t_Department')->result();
        }

        function cekDeptK3($id)
        {
            $this->db->where('FitemID', $id);

            return $this->db->get('department')->result();
        }


        function loadMOK3($tgl_awal, $tgl_akhir)
        {
            $db3 = $this->load->database('mssql', TRUE);

            $db3->select('icmo.FBillNo, icmo.FStatus, icmo.FCheckDate, icmo.FGMPBatchNo, icmo.FItemID, icmo.FQty, icmo.FHeadSelfJ01114, t_ICItem.F_112 as shiftCapacity, t_ICItem.FSource as source');
            $db3->join('t_ICItem', 'icmo.FitemID = t_ICItem.FItemID', 'LEFT');
            $db3->join('t_Department', 't_ICItem.FSource = t_Department.FItemID');
            $db3->where('icmo.FCheckDate >=', $tgl_awal);
            $db3->where('icmo.FCheckDate <=', $tgl_akhir);
            $db3->order_by('icmo.FBillNo', 'ASSC');

            return $db3->get('icmo')->result();
        }

        function loadPeriode()
        {
            $this->db->order_by('id', 'ASC');
            return $this->db->get('periode')->result();
        }
    }