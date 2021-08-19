<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <h1 class="m-0"><?php echo $judul; ?></h1>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form method="POST" action="Report">
                            <div class="card-header">
                                <strong>.:: Filter Data ::.</strong>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="control-label">Filter By :</label>
                                            <select name="filter" class="form-control select2bs4" id="filter">
                                                <option value="">---Pilih Filter---</option>
                                                <option value="1">Harian</option>
                                                <option value="2">Mingguan</option>
                                                <option value="3">Bulanan</option>
                                                <option value="4">Periode </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <a id="form-tanggal" >
                                                <label class="control-label"><i class="fa fa-calendar fa-fw"></i> Select Date</label>
                                                <input type="date" name="tanggal" class="form-control">
                                            </a>
                                            <a id="form-minggu" >
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label class="control-label"><i class="fa fa-calendar fa-fw"></i>From Date :</label>
                                                        <input type="date" name="tgl1" class="form-control">
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="control-label">To Date :</label>
                                                        <input type="date" name="tgl2" class="form-control">
                                                    </div>
                                                </div>
                                            </a>
                                            <a id="form-bulan">
                                                <label class="control-label"><i class="fa fa-calendar fa-fw"></i> Select Month</label>
                                                <!-- <input type="month" name="bulan"> -->
                                                <select name="bulan" class="form-control select2bs4">
                                                    <option value="">---Pilih Bulan---</option>
                                                    <option value="01">Januari</option>
                                                    <option value="02">Februari</option>
                                                    <option value="03">Maret</option>
                                                    <option value="04">April</option>
                                                    <option value="05">Mei</option>
                                                    <option value="06">Juni</option>
                                                    <option value="07">Juli</option>
                                                    <option value="08">Agustus</option>
                                                    <option value="09">September</option>
                                                    <option value="10">Oktober</option>
                                                    <option value="11">November</option>
                                                    <option value="12">Desember</option>
                                                </select>
                                            </a>
                                            <a id="form-periode">
                                                <label class="control-label"><i class="fa fa-calendar fa-fw"></i> Select Period</label>
                                                <select name="periode" class="form-control select2bs4">
                                                    <option value="">---Pilih Periode---</option>
                                                    <?php
                                                        foreach($periode as $pd)
                                                        {
                                                            ?>
                                                                <option value="<?php echo $pd->id; ?>"><?php echo $pd->nama_periode; ?></option>
                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="control-label">Criteria :</label>
                                            <select name="kriteria" class="form-control select2bs4" id="kriteria">
                                                    <option value="">---Pilih Kriteria---</option>
                                                    <option value="1">Part</option>
                                                    <option value="2">Proses</option>
                                                    <option value="3">Operator</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <a id="form-parts">
                                            <label class="control-label"><i class="fas fa-project-diagram fas-fw"></i> Select Parts Criteria</label>
                                                <select name="form_parts" class="form-control select2bs4">
                                                    <option value="">---Pilih Part Name---</option>
                                                    <?php
                                                        foreach($part as $p)
                                                        {
                                                            ?>
                                                                <option value="<?php echo $p->FNumber; ?>"><?php echo $p->FNumber; ?></option>
                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                        </a>
                                        <a id="form-proses">
                                            <label class="control-label"><i class="fas fa-tasks fas-fw"></i> Select Proses Criteria</label>
                                                <select name="form_proses" class="form-control select2bs4">
                                                    <option value="">---Pilih Proses Name---</option>
                                                    <?php
                                                        foreach($dept as $pr)
                                                        {
                                                            ?>
                                                                <option value="<?php echo $pr->FItemID; ?>"><?php echo $pr->FName; ?></option>
                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                        </a>
                                        <a id="form-operator">
                                            <label class="control-label"><i class="fas fa-industry fas-fw"></i> Select Operator Criteria</label>
                                                <select name="form_operator" class="form-control select2bs4">
                                                    <option value="">---Pilih Operator Name---</option>
                                                    <?php
                                                        foreach($karyawan as $kry)
                                                        {
                                                            ?>
                                                                <option value="<?php echo $kry->NIK; ?>"><?php echo $kry->nama; ?></option>
                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" id="tampil" class="btn btn-success btn-flat" onclick="tampilkan">Cari <i class="fa fa-search fa-fw"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
                <br>
                <div class="container-fluid">
                    <?php
                        $this->load->view('Include/error');
                    ?>
                    
                    <!-- <?php
                        if(count($laporan) > 0)
                        {
                            ?> -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-hover table-bordered" id="example">
                                                    <thead>
                                                        <th style="vertical-align: middle; text-align: center;">No</th>
                                                        <th style="vertical-align: middle; text-align: center;">设备 <br> Machine</th>
                                                        <th style="vertical-align: middle; text-align: center;">工号 <br> Work No.</th>
                                                        <th style="vertical-align: middle; text-align: center;">工号 <br> Work Date.</th>
                                                        <th style="vertical-align: middle; text-align: center;">姓名 <br> Name</th>
                                                        <th style="vertical-align: middle; text-align: center;">日期 <br> Date</th>
                                                        <th style="vertical-align: middle; text-align: center;">班次 <br> Shift No.</th>
                                                        <th style="vertical-align: middle; text-align: center;">产品名称 <br> Product Code</th>
                                                        <th style="vertical-align: middle; text-align: center;">工序名称 <br> Process name</th>
                                                        <th style="vertical-align: middle; text-align: center;">批次 <br> Batch</th>
                                                        <th style="vertical-align: middle; text-align: center;">额定班产 <br> Class production</th>
                                                        <th style="vertical-align: middle; text-align: center;">批次 <br> Qty Planed</th>
                                                        <th style="vertical-align: middle; text-align: center;">完工数量 <br> (合格品数) <br> Finished Qty. <br> (Qualified Qty.)</th>
                                                        <th style="vertical-align: middle; text-align: center;">理论工时(K=J/I*8) <br> Theoretic working hour</th>
                                                        <th style="vertical-align: middle; text-align: center;">实际所用 工时 <br> Actual working hour</th>
                                                        <th style="vertical-align: middle; text-align: center;">MO No.</th>
                                                        <th style="vertical-align: middle; text-align: center;">差额工时 <br> (M=L-K) Balance working hour</th>
                                                        <th style="vertical-align: middle; text-align: center;">补工时的原因 <br> Reason for additional working hour</th>
                                                        <th style="vertical-align: middle; text-align: center;">Status</th>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $no=1;
                                                            foreach($laporan as $row)
                                                            {
                                                                ?>
                                                                    <tr>
                                                                        <td><?php echo $no++; ?></td>
                                                                        <td><?php echo $row->machine_no; ?></td>
                                                                        <td><?php echo $row->WT_no; ?></td>
                                                                        <td><?php echo date("d/M/Y",strtotime($row->WT_date)); ?></td>
                                                                        <td>
                                                                            <?php 
                                                                                foreach($karyawan as $kry)
                                                                                {
                                                                                    $nik = $kry->NIK;
                                                                                    $namaKry = $kry->nama;
                                                                                    if($row->operator_name == $nik)
                                                                                    {
                                                                                        echo $namaKry;
                                                                                    }
                                                                                } 
                                                                            ?>
                                                                        </td>
                                                                        <td><?php echo date("d/M/Y", strtotime($row->MO_date)); ?></td>
                                                                        <td><?php echo $row->shift; ?></td>
                                                                        <td><?php echo $row->part_no; ?></td>
                                                                        <td>
                                                                            <?php 
                                                                                foreach($dept as $dp)
                                                                                {
                                                                                    $item = $dp->FItemID;
                                                                                    $namaProses = $dp->FName;
                                                                                    if($row->proses_name == $item)
                                                                                    {
                                                                                        echo $namaProses;
                                                                                    }
                                                                                } 
                                                                            ?>
                                                                        </td>
                                                                        <td><?php echo $row->batch_no; ?></td>
                                                                        <td><?php echo number_format($row->shiftcapacity); ?></td>
                                                                        <td><?php echo number_format($row->qty_planed); ?></td>
                                                                        <td><?php echo number_format($row->qty_qualified); ?></td>
                                                                        <td><?php echo $row->theoretic; ?></td>
                                                                        <td><?php echo $row->actual; ?></td>
                                                                        <td><?php echo $row->MO_no; ?></td>
                                                                        <td><?php echo $row->actual - $row->theoretic; ?></td>
                                                                        <td>
                                                                            <?php
                                                                            $data = str_replace('"','',$row->reason);
                                                                            $data1 = explode(",", $data);
                                                                            if(count($data1))
                                                                            {
                                                                                foreach($alasan as $s)
                                                                                {
                                                                                    $idReason = $s->id;

                                                                                    foreach($data1 as $d)
                                                                                    {
                                                                                        if($d == $idReason)
                                                                                        {
                                                                                            echo $s->nama.",";
                                                                                        }
                                                                                    }
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php 
                                                                                if($row->status == '0')
                                                                                {
                                                                                    echo "<span class=\"badge badge-success\">Close</span>";
                                                                                }
                                                                                elseif($row->status == '1')
                                                                                {
                                                                                    echo "<span class=\"badge badge-dark\">Open</success>";
                                                                                }
                                                                                elseif($row->status == '2')
                                                                                {
                                                                                    echo "<span class=\"badge badge-warning\">On Progress</success>";
                                                                                }
                                                                                elseif($row->status == '3')
                                                                                {
                                                                                    echo "<span class=\"badge badge-info\">Monitoring</success>";
                                                                                }
                                                                            ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php
                                                            }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- <?php
                        }else{
                            $laporan = array();
                        }
                    ?> -->
                </div>
            </section>
        </div>

        <script>
        $(document).ready(function() {
            $('#example').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel'
                ]
            } );
        } );
        $(document).ready(function(){
            $('.datepicker').datepicker({
                format: 'yyyy/dd/mm'
            });
            $('#form-tanggal, #form-bulan, #form-minggu, #form-periode').hide();
            $('#filter').change(function(){
                if($(this).val() == '1'){
                    $('#form-bulan, #form-minggu, #form-periode').hide();
                    $('#form-tanggal').show();
                }else if($(this).val() == '2'){
                    $('#form-tanggal, #form-bulan, #form-periode').hide();
                    $('#form-minggu').show();
                }else if($(this).val() == '3'){
                    $('#form-tanggal, #form-minggu, #form-periode').hide();
                    $('#form-bulan').show();
                }else{
                    $('#form-tanggal, #form-minggu, #form-bulan').hide();
                    $('#form-periode').show();
                }  
            })
            $('#form-parts, #form-proses, #form-operator').hide();
            $('#kriteria').change(function(){
                if($(this).val() == '1'){
                    $('#form-proses, #form-operator').hide();
                    $('#form-parts').show();
                }else if($(this).val() == '2'){
                    $('#form-parts, #form-operator').hide();
                    $('#form-proses').show();
                }else if($(this).val() == '3'){
                    $('#form-parts, #form-proses').hide();
                    $('#form-operator').show();
                }
            })
        })
        </script>
