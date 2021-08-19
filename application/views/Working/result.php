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
                            <form method="POST" action="Working/result">
                                <div class="card-header">
                                    <strong>.:: Filter Data ::.</strong>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="control-label"><i class="fa fa-calendar fa-fw"></i>From Date :</label>
                                            <input type="date" name="tgl_awal" class="form-control">
                                        </div>
                                        <div class="col-6">
                                            <label class="control-label">To Date :</label>
                                            <input type="date" name="tgl_akhir" class="form-control">
                                        </div>
                                    </div>
                                </div>      
                                <div class="card-footer">
                                    <button type="submit" id="tampil" class="btn btn-success btn-flat">Cari <i class="fa fa-search fa-fw"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                    <div class="card">
								<div class="card-header">
									<h5 class="card-title">Working Hours</h5>
								</div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover table-bordered" id="data1">
                                            <thead>
                                                <th>No.</th>
                                                <th>NIK</th>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <?php 
                                                // echo $tgl_awal."<br>".$tgl_akhir;
                                                    foreach($tanggal as $cols)
                                                    {
                                                        ?>
                                                            <th><?php echo $cols->tanggal; ?></th>
                                                        <?php
                                                    }
                                                ?>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $no= 1;
                                                    $tgl1 = $tgl_awal;
                                                    $tgl2 = $tgl_akhir;
                                                    foreach($data as $row)
                                                    {
                                                        ?>
                                                            <tr>
                                                                <td rowspan="3"><?php echo $no++; ?></td>
                                                                <td rowspan="3"><?php echo $row->nik; ?></td>
                                                                <td rowspan="3"></td>
                                                                <td>Teori</td>
                                                                <?php
                                                                    $teori = $this->db->query("SELECT * FROM tmp_wk_hour WHERE (tanggal >= '$tgl1' AND tanggal <= '$tgl2') AND nik='$row->nik'")->result_array();
                                                                    foreach($teori as $teori)
                                                                    {
                                                                        ?>
                                                                            <td><?php echo $teori['teori']; ?></td>
                                                                        <?php
                                                                    }
                                                                ?>
                                                                <tr>
                                                                    <td>Aktual</td>
                                                                    <?php
                                                                        $aktual = $this->db->query("SELECT * FROM tmp_wk_hour WHERE (tanggal >= '$tgl1' AND tanggal <= '$tgl2') AND nik='$row->nik'")->result_array();
                                                                        foreach($aktual as $aktual)
                                                                        {
                                                                            ?>
                                                                                <td><?php echo $aktual['aktual']; ?></td>
                                                                            <?php
                                                                        }
                                                                    ?>
                                                                </tr>
                                                                <tr>
                                                                    <td>Balance</td>
                                                                    <?php
                                                                        $balance = $this->db->query("SELECT * FROM tmp_wk_hour WHERE (tanggal >= '$tgl1' AND tanggal <= '$tgl2') AND nik='$row->nik'")->result_array();
                                                                        foreach($balance as $balance)
                                                                        {
                                                                            ?>
                                                                                <td><?php echo $balance['balance']; ?></td>
                                                                            <?php
                                                                        }
                                                                    ?>
                                                                </tr>
                                                            </tr>
                                                        <?php
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>    
                                </div>

                                <div class="card-footer" style="text-align: center; font-size:x-large;">

                                </div>
                            </div>
                    </div>
                </div>
            </section>
        </div>