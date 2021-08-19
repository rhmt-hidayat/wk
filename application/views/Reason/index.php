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
                        <div class="col-4">
                            <div class="card">
								<form method="POST" action="<?php echo base_url().'Reason/insert' ?>">
									<div class="card-header">
										<h5 class="card-title">Add New Reason</h5>
									</div>
									<div class="card-body">
										<div class="form-group">
											<label class="control-label">Reason Code</label>
											<input type="text" name="kode" class="form-control" required maxlength="10" placeholder="Reason Code" autofocus autocomplete="off" style="text-transform:uppercase;" data-tooltip="tooltip" data-placement="top" title="Reason Code">
										</div>
										<div class="form-group">
											<label class="control-label">Reason Name</label>
											<input type="text" name="nama" class="form-control" required maxlength="150" placeholder="Reason Name" autocomplete="off" style="text-transform:capitalize;" data-tooltip="tooltip" data-placement="top" title="Reason Name">
										</div>
										<div class="form-group">
											<label class="control-label">Description</label>
											<textarea class="form-control" name="deskripsi" placeholder="Description" data-tooltip="tooltip" data-placement="top" title="Description"></textarea>
										</div>
									</div>
									<div class="card-footer">
										<button type="reset" class="btn btn-flat btn-secondary" data-tooltip="tooltip" data-placement="top" title="Cancel"><i class="fas fa-times"></i> Cancel</button>
										<button type="submit" class="btn btn-flat float-right btn-success" data-tooltip="tooltip" data-placement="top" title="Save Data"><i class="fas fa-save"></i> Save Data</button>
									</div>
								</form>
                            </div>
                        </div>

                        <div class="col-8">
                            <div class="card">
								<div class="card-header">
									<h5 class="card-title">List Reason</h5>
								</div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover table-bordered" id="data1">
                                            <thead>
                                                <th>No.</th>
                                                <th>Reason Code</th>
                                                <th>Reason Name</th>
                                                <th>Description</th>
                                                <th>#</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $no=1;
                                                    foreach($reason as $row)
                                                    {
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $no++; ?></td>
                                                                <td><?php echo $row->kode; ?></td>
                                                                <td><?php echo $row->nama; ?></td>
                                                                <td><?php echo $row->deskripsi; ?></td>
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <a href="<?php echo base_url().'Reason/edit/'.$row->id; ?>" class="btn btn-xs btn-warning"><i class="fas fa-edit"></i></a>
                                                                        <button type="button" data-toggle="modal" data-target="#hapusReason" data-id="<?php echo $row->id; ?>" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></button>
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
                                        $this->load->view('Reason/modal');
                                    ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </div>