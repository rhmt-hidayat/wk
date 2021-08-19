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
                                <form method="POST" action="<?php echo base_url().'Sync/uploadData'; ?>" >
                                    <div class="card-header">
                                        <a href="<?php echo base_url().'Sync'; ?>" class="btn btn-flat btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>                                        
                                        <button type="submit" class="btn btn-flat btn-success"><i class="fas fa-upload"></i> Upload Data</button>
                                        <a href="" data-toggle="modal" data-target="#kriteria" class="btn btn-flat btn-info"><i class="fas fa-calendar-alt"></i> Change Criteria</a>
                                        <input type="hidden" readonly name="tgl_mulai" class="form-control" placeholder="First name" value="<?php echo $tgl_1; ?>">
                                        <input type="hidden" readonly name="tgl_selesai" class="form-control" placeholder="Last name" value="<?php echo $tgl_2 ?>">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    Query result from date : <b>
                                    <?php 
                                        echo date("d/M/Y", strtotime($tgl_1));
                                    ?>
                                    </b>to date :<b>
                                    <?php
                                        echo date("d/M/Y", strtotime($tgl_2));
                                    ?>
                                    </b>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover table-bordered" id="data1">
                                            <thead>
                                                <th>No.</th>
                                                <th>MO No</th>
                                                <th>MO Planned Date</th>
                                                <th>MO Status</th>
                                                <th>Material Code</th>
                                                <th>Drawing Number</th>
                                                <th>Material Name</th>
                                                <th>Spesification</th>
                                                <th>Production Source</th>
                                                <th>Planned Qty</th>
                                                <th>Machine No</th>
                                                <th>Lot No.</th>
                                                <th>Shift Capacity</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $no = 1 ;
                                                    foreach($data as $data)
                                                    {
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $no++; ?></td>
                                                                <td><?php echo $data->FBillNo; ?></td>
                                                                <td><?php echo date("d-M-Y", strtotime($data->FCheckDate)); ?></td>
                                                                <td><?php echo $data->FStatus; ?></td>
                                                                <td><?php echo $data->PartNo; ?></td>
                                                                <td><?php echo $data->FHeadSelfJ0198; ?></td>
                                                                <td><?php echo $data->PartName; ?></td>
                                                                <td><?php echo $data->spec; ?></td>
                                                                <td><?php echo $data->source; ?></td>
                                                                <td><?php echo number_format($data->FQty); ?></td>
                                                                <td><?php echo $data->FHeadSelfJ01114; ?></td>
                                                                <td><?php echo $data->FGMPBatchNo; ?></td>
                                                                <td></td>
                                                            </tr>
                                                        <?php
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="card-footer">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <?php
            $this->load->view('Sync/modal');
        ?>