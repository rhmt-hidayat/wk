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
                <div class="container-fluid">
                    <?php
                        $this->load->view('Include/error');
                    ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <a href="<?php echo base_url().'Transaksi/add'; ?>" class="btn btn-flat btn-success"><i class="fas fa-plus-circle"></i> Add New Working Ticket</a>
                                </div>
                                
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
                                                <th style="vertical-align: middle; text-align: center;">#</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $no=1;
                                                    foreach($transaksi as $row)
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
                                                                <td><?php echo $row->namaProses; ?></td>
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
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <a href="<?php echo base_url().'Transaksi/edit/'.$row->id; ?>" class="btn btn-xs btn-warning"><i class="fas fa-edit"></i></a>
                                                                        <button type="button" data-toggle="modal" data-target="#hapusTransaksi" data-id="<?php echo $row->id; ?>" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                
                                <div class="card-footer" style="text-align: center; font-size:x-large;">
                                    <?php
                                        $this->load->view('Transaksi/modal');
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
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
        </script>