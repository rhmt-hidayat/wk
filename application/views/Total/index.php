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
                            <form method="POST" action="Total">
                                <div class="card-header">
                                    <strong>.:: Filter Data ::.</strong>
                                </div>
                                <div class="card-body">    
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="control-label">Report Date :</label>
                                                <input type="date" name="tanggal" style="background-color:#DCDCDC;" class="form-control datepicker-days" required value="<?php echo date("Y-m-d"); ?>">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="control-label">Kriteria Berdasarkan :</label>
                                                <select name="form_proses" class="form-control select2bs4">
                                                    <option value="">---Pilih Proses---</option>
                                                    <?php
                                                        foreach($proses as $p)
                                                        {
                                                            ?>
                                                                <option value="<?php echo $p->kode; ?>"><?php echo $p->deskripsi; ?></option>
                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
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
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-bordered" style="width:100%" id="example1">
                                    <thead>
                                        <th style="vertical-align: middle; text-align: center;">No.</th>
                                        <th style="vertical-align: middle; text-align: center;">Nama Proses</th>
                                        <th style="vertical-align: middle; text-align: center;">Part No.</th>
                                        <th style="vertical-align: middle; text-align: center;">Total Case</th>
                                        <th style="vertical-align: middle; text-align: center;">Open Case</th>
                                        <th style="vertical-align: middle; text-align: center;">Close Case</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $no = 1;
                                                foreach($grafik as $row)
                                                {
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $no++; ?></td>
                                                            <td>
                                                                <?php 
                                                                    foreach($proses as $p)
                                                                    {
                                                                        $id = $p->kode;
                                                                        $namaProses = $p->deskripsi;
                                                                        if($row->proses_name == $id)
                                                                        {
                                                                            echo $namaProses;
                                                                        }
                                                                    }   
                                                                ?>
                                                            </td>
                                                            <td><?php echo $row->part_no; ?></td>
                                                            <td><?php echo $row->Semua; ?></td>
                                                            <td><?php echo $row->Open; ?></td>
                                                            <td><?php echo $row->Close; ?></td>
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
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Report on Chart</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="MyChart"></canvas>
                                <?php
                                    $partNo = "";
                                    $openCase = "";
                                    $onGoing = "";
                                    $closeCase = "";
                                    $totalCase = "";

                                    foreach($result as $baris)
                                    {
                                        $drawing = $baris->product_drawing;
                                        $total = $baris->Semua;
                                        $open = $baris->Open;
                                        $proses = $baris->OnGoing;
                                        $close = $baris->Close;

                                        $partNo .= "'$drawing'". ", ";
                                        $openCase .= "$open". ", ";
                                        $onGoing .= "$proses". ", ";
                                        $closeCase .= "$close". ", ";
                                        $totalCase .= "$total". ", ";
                                    }
                                ?>
                            </div>
                            <div class="card-footer">

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>