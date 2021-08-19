<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class M_transaksi extends CI_Model
    {
        public function tampil() {
            $this->db->order_by('WT_no', 'ASC');
            return $this->db->get('tr_workticket')->result();
        }

        public function kode() {
            $this->db->select('RIGHT(tr_workticket.WT_no,3) as WT_no', FALSE);
            $this->db->order_by('WT_no','DESC');    
            $this->db->limit(1);    
            $query = $this->db->get('tr_workticket');  //cek dulu apakah sudah ada kode di tabel.    
            if($query->num_rows() <> 0) {      
                //cek kode jika telah tersedia    
                $data = $query->row();      
                $kode = intval($data->WT_no) + 1; 
            }
            else {      
                $kode = 1;  //cek jika kode belum terdapat pada table
            }
                $tgl=date('Y-m-d-'); 
                $batas = str_pad($kode, 4, "0", STR_PAD_LEFT);    
                $kodetampil = "WK-".$tgl.$batas;  //format kode
                return $kodetampil;
        }

        public function getMoByProses($FItemID)
        {
            $this->db->select('*');
            $this->db->from('icmo');
            $this->db->where('status', '1');
            $this->db->where('source', $FItemID);
            return $this->db->get()->result();
        }

        public function getDatabyMo($id)
        {
            $this->db->select('icmo.*, material.FNumber');
            $this->db->from('icmo');
            $this->db->join('material', 'icmo.FItemID = material.FItemID', 'LEFT');
            $this->db->where('icmo.FBillNo', $id);
            return $this->db->get()->result();
        }

        function getStatus($id)
        {
            $this->db->select('*');
            $this->db->from('');
            $this->db->where('FBillNo', $id);
            return $this->db->get('icmo')->result();
        }

        function getTanggal($tanggal)
        {
            $this->db->select('*');
            $this->db->from('tr_workticket');
            $this->db->where('MO_date', $tanggal);
            $this->db->order_by('id', 'ASC');

            return $this->db->get()->result();
        }

        function getMinggu($tgl1,$tgl2)
        {
            $this->db->select('*');
            $this->db->from('tr_workticket');
            $this->db->where('MO_date >=',$tgl1);
            $this->db->where('MO_date <=',$tgl2);
            $this->db->order_by('id', 'ASC');

            return $this->db->get()->result();
        }

        function getBulan($bulan,$tahun)
        {
            $this->db->select('*');
            $this->db->from('tr_workticket');
            $this->db->where('MONTH(MO_date)', $bulan);
            $this->db->where('YEAR(MO_date)', $tahun);
            $this->db->order_by('id', 'ASC');
            
            return $this->db->get()->result();
        }

        function getWaktu($periode)
        {
            $this->db->where('id', $periode);
            return $this->db->get('periode')->result();
        }

        function getPeriode($tgl_periode1, $tgl_periode2)
        {
            $this->db->select('*');
            $this->db->from('tr_workticket');
            $this->db->where('MO_date >=',$tgl_periode1);
            $this->db->where('MO_date <=',$tgl_periode2);
            $this->db->order_by('id', 'ASC');

            return $this->db->get()->result();
        }

        function getParts($parts)
        {
            $this->db->select('*');
            $this->db->from('tr_workticket');
            $this->db->where('part_no', $parts);
            $this->db->order_by('id', 'ASC');

            return $this->db->get()->result();
        }

        function getProses($proses)
        {
            $this->db->select('*');
            $this->db->from('tr_workticket');
            $this->db->where('proses_name', $proses);
            $this->db->order_by('id', 'ASC');

            return $this->db->get()->result();
        }

        function getOperator($operator)
        {
            $this->db->select('*');
            $this->db->from('tr_workticket');
            $this->db->where('operator_name', $operator);
            $this->db->order_by('id', 'ASC');

            return $this->db->get()->result();
        }

        function getHarianParts($tanggal, $parts)
        {
            $this->db->select('*');
            $this->db->from('tr_workticket');
            $this->db->where('MO_date', $tanggal);
            $this->db->where('part_no', $parts);
            $this->db->order_by('id', 'ASC');

            return $this->db->get()->result();
        }

        function getHarianProses($tanggal, $proses)
        {
            $this->db->select('*');
            $this->db->from('tr_workticket');
            $this->db->where('MO_date', $tanggal);
            $this->db->where('proses_name', $proses);
            $this->db->order_by('id', 'ASC');

            return $this->db->get()->result();
        }

        function getHarianOperator($tanggal, $operator)
        {
            $this->db->select('*');
            $this->db->from('tr_workticket');
            $this->db->where('MO_date', $tanggal);
            $this->db->where('operator_name', $operator);
            $this->db->order_by('id', 'ASC');

            return $this->db->get()->result();
        }

        function getMingguParts($tgl1,$tgl2, $parts)
        {
            $this->db->select('*');
            $this->db->from('tr_workticket');
            $this->db->where('MO_date >=',$tgl1);
            $this->db->where('MO_date <=',$tgl2);
            $this->db->where('part_no', $parts);
            $this->db->order_by('id', 'ASC');

            return $this->db->get()->result();
        }

        function getMingguProses($tgl1,$tgl2, $proses)
        {
            $this->db->select('*');
            $this->db->from('tr_workticket');
            $this->db->where('MO_date >=',$tgl1);
            $this->db->where('MO_date <=',$tgl2);
            $this->db->where('proses_name', $proses);
            $this->db->order_by('id', 'ASC');

            return $this->db->get()->result();
        }

        function getMingguOperator($tgl1,$tgl2, $operator)
        {
            $this->db->select('*');
            $this->db->from('tr_workticket');
            $this->db->where('MO_date >=',$tgl1);
            $this->db->where('MO_date <=',$tgl2);
            $this->db->where('operator_name', $operator);
            $this->db->order_by('id', 'ASC');

            return $this->db->get()->result();
        }

        function getBulanParts($bulan,$tahun, $parts)
        {
            $this->db->select('*');
            $this->db->from('tr_workticket');
            $this->db->where('MONTH(MO_date)', $bulan);
            $this->db->where('YEAR(MO_date)', $tahun);
            $this->db->where('part_no', $parts);
            $this->db->order_by('id', 'ASC');
            
            return $this->db->get()->result();
        }

        function getBulanProses($bulan,$tahun, $proses)
        {
            $this->db->select('*');
            $this->db->from('tr_workticket');
            $this->db->where('MONTH(MO_date)', $bulan);
            $this->db->where('YEAR(MO_date)', $tahun);
            $this->db->where('proses_name', $proses);
            $this->db->order_by('id', 'ASC');
            
            return $this->db->get()->result();
        }

        function getBulanOperator($bulan,$tahun, $operator)
        {
            $this->db->select('*');
            $this->db->from('tr_workticket');
            $this->db->where('MONTH(MO_date)', $bulan);
            $this->db->where('YEAR(MO_date)', $tahun);
            $this->db->where('operator_name', $operator);
            $this->db->order_by('id', 'ASC');
            
            return $this->db->get()->result();
        }

        function getPeriodeParts($tgl_periode1, $tgl_periode2, $parts)
        {
            $this->db->select('*');
            $this->db->from('tr_workticket');
            $this->db->where('MO_date >=',$tgl_periode1);
            $this->db->where('MO_date <=',$tgl_periode2);
            $this->db->where('part_no', $parts);
            $this->db->order_by('id', 'ASC');

            return $this->db->get()->result();
        }
        
        function getPeriodeProses($tgl_periode1, $tgl_periode2, $proses)
        {
            $this->db->select('*');
            $this->db->from('tr_workticket');
            $this->db->where('MO_date >=',$tgl_periode1);
            $this->db->where('MO_date <=',$tgl_periode2);
            $this->db->where('proses_name', $proses);
            $this->db->order_by('id', 'ASC');

            return $this->db->get()->result();
        }

        function getPeriodeOperator($tgl_periode1, $tgl_periode2, $operator)
        {
            $this->db->select('*');
            $this->db->from('tr_workticket');
            $this->db->where('MO_date >=',$tgl_periode1);
            $this->db->where('MO_date <=',$tgl_periode2);
            $this->db->where('operator_name', $operator);
            $this->db->order_by('id', 'ASC');

            return $this->db->get()->result();
        }

        function getCountProses($proses, $tanggal)
        {
            $data = $this->db->query("SELECT A.proses_name, A.part_no, IFNULL(COUNT(A.proses_name),0) as 'Semua', ( SELECT IFNULL(COUNT(B.proses_name),0) FROM tr_workticket AS B WHERE B.status ='1' AND proses_name = '$proses' AND MO_date <= '$tanggal' AND(B.proses_name = A.proses_name AND B.part_no = A.part_no) GROUP BY B.proses_name, B.part_no ) AS 'Open', ( SELECT IFNULL(COUNT(C.proses_name),0) FROM tr_workticket AS C WHERE C.status ='0' AND proses_name = '$proses' AND MO_date <= '$tanggal' AND(C.proses_name = A.proses_name AND C.part_no = A.part_no) GROUP BY C.proses_name, C.part_no ) AS 'Close' FROM tr_workticket AS A WHERE proses_name = '$proses' AND MO_date <= '$tanggal' GROUP BY A.proses_name, A.part_no");
            $hasil = $data->result();
            return $hasil;
        }

        function getGrafik($proses, $tanggal)
        {
            $data = $this->db->query("SELECT A.proses_name, A.part_no, IFNULL(COUNT(A.proses_name),0) as 'Semua', ( SELECT IFNULL(COUNT(B.proses_name),0) FROM tr_workticket AS B WHERE B.status ='1' AND proses_name = '$proses' AND MO_date <= '$tanggal' AND(B.proses_name = A.proses_name AND B.part_no = A.part_no) GROUP BY B.proses_name, B.part_no ) AS 'Open', ( SELECT IFNULL(COUNT(C.proses_name),0) FROM tr_workticket AS C WHERE C.status ='0' AND proses_name = '$proses' AND MO_date <= '$tanggal' AND(C.proses_name = A.proses_name AND C.part_no = A.part_no) GROUP BY C.proses_name, C.part_no ) AS 'Close' FROM tr_workticket AS A WHERE proses_name = '$proses' AND MO_date <= '$tanggal' GROUP BY A.proses_name, A.part_no");
            $hasil = $data->result();
            return $hasil;
        }

        function loadWorking($tgl_awal, $tgl_akhir)
        {
            $data = $this->db->query("SELECT operator_name, theoretic, actual, (actual-theoretic) as balance FROM tr_workticket WHERE MO_date BETWEEN '$tgl_awal' AND '$tgl_akhir' GROUP BY operator_name");
            $hasil = $data->result();
            return $hasil;
        }

        function cekTemp($userid, $ip_address, $tanggal)
        {   
            $this->db->where('userid', $userid);
            $this->db->where('rpt_date', $tanggal);
            $this->db->where('ip_address', $ip_address);

            $this->db->order_by('NIK', 'ASC');
            $this->db->order_by('tanggal', 'ASC');

            return $this->db->get('tmp_wk_hour')->result();
        }

        function loadTanggal($tgl_awal, $tgl_akhir)
		{
			$this->db->select('*');
			$this->db->from('tmp_wk_hour');
			$this->db->where('tanggal >=', $tgl_awal);
			$this->db->where('tanggal <=', $tgl_akhir);
			$this->db->group_by('tanggal');
			$this->db->order_by('tanggal', 'ASC');

			return $this->db->get()->result();
		}

        function loadDataTmp($tgl_awal, $tgl_akhir,$userid, $ip_address, $tanggal)
        {
            $this->db->select('nik');
            $this->db->where('tanggal >=', $tgl_awal);
            $this->db->where('tanggal <=', $tgl_akhir);
            $this->db->where('userid', $userid);
            $this->db->where('rpt_date', $tanggal);
            $this->db->where('ip_address', $ip_address);

            $this->db->group_by('nik');
            $this->db->order_by('nik', 'ASC');

            return $this->db->get('tmp_wk_hour')->result();

            // $data = $this->db->query("SELECT nik FROM tmp_wk_hour WHERE tanggal >= '$tgl_awal' AND tanggal <= '$tgl_akhir' AND userid='$userid' AND rpt_date='$tanggal' AND ip_address = '$ip_address' GROUP BY nik ORDER BY nik ASC");
            // $result = $data->result();
            // return $result;            
        }

        function getDataHour($nik, $tanggal)
        {
            return $this->db->query("SELECT operator_name, MO_date, SUM(theoretic) as teori, SUM(actual) as aktual, (SUM(actual) - SUM(theoretic)) as balance FROM tr_workticket WHERE operator_name='$nik' AND MO_date='$tanggal' GROUP BY operator_name, MO_date")->result();
        }
    }
    