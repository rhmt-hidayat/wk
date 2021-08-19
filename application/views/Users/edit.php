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
								<form method="POST" action="<?php echo base_url().'Dept/update' ?>">
									<div class="card-header">
										<h5 class="card-title">Add New Reason</h5>
									</div>
									<div class="card-body">
										<div class="form-group">
											<label class="control-label">Nama</label>
                                            <input type="hidden" name="id" value="<?php echo $edit['userid'] ?>">
											<input type="text" name="nama" value="<?php echo $edit['nama'] ?>" class="form-control" required placeholder="Nama User" autofocus autocomplete="off" data-tooltip="tooltip" data-placement="top" title="Name">
										</div>
										<div class="form-group">
											<label class="control-label">Email</label>
											<input type="text" name="email" value="<?php echo $edit['email'] ?>" class="form-control" required placeholder="Email User" autocomplete="off" data-tooltip="tooltip" data-placement="top" title="Email">
										</div>
										<div class="form-group">
											<label class="control-label">Password</label>
											<input class="form-control" name="password" value="<?php echo $edit['password'] ?>" placeholder="Password" autocomplete="off" data-tooltip="tooltip" data-placement="top" title="Password"></input>
										</div>
                                        <div class="form-group">
                                            <label class="control-label">Level</label>
                                            <select name="level" class="form-control select2bs4" style="width: 100%;" id="properties">
                                                <option value="">Level</option>
                                                <option value="1">Superadmin</option>
                                                <option value="2">Admin</option>
                                                <option value="3">User biasa</option>
                                            </select>
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
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Password</th>
                                                <th>Level</th>
                                                <th>#</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $no=1;
                                                    foreach($users as $row)
                                                    {
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $no++; ?></td>
                                                                <td><?php echo $row->nama; ?></td>
                                                                <td><?php echo $row->email; ?></td>
                                                                <td><?php echo $row->password; ?></td>
                                                                <td><?php echo $row->level; ?></td>
                                                                <td>
                                                                    <div class="btn-group">
                                                                    <?php if ($this->session->userdata('level') == '1') { ?>
                                                                        <?php if ($row->level == 1) { ?>
                                                                            <a href="<?php echo base_url().'Dept/edit/'.$row->userid; ?>" class="btn btn-xs btn-warning"><i class="fas fa-edit"></i></a>
                                                                            <button type="button" data-toggle="modal" data-target="#hapusUsers" data-id="<?php echo $row->userid; ?>" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></button>                                    
                                                                        <?php } else { ?>
                                                                            <button  href="#" type="button" disabled class="btn btn-xs btn-warning"><i class="fas fa-edit"></i></button>
                                                                            <button type="button" disabled data-toggle="modal" data-target="#hapusUsers" data-id="#" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></button>
                                                                        <?php } ?>
                                                                    <?php } elseif ($this->session->userdata('level') == '2') { ?>
                                                                        <?php if ($row->level == 2) { ?>
                                                                            <a href="<?php echo base_url().'Dept/edit/'.$row->userid; ?>" class="btn btn-xs btn-warning"><i class="fas fa-edit"></i></a>
                                                                            <button type="button" data-toggle="modal" data-target="#hapusUsers" data-id="<?php echo $row->userid; ?>" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></button>                                    
                                                                        <?php } else { ?>
                                                                            <button  href="#" type="button" disabled class="btn btn-xs btn-warning"><i class="fas fa-edit"></i></button>
                                                                            <button type="button" disabled data-toggle="modal" data-target="#hapusUsers" data-id="#" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></button>
                                                                        <?php } ?>
                                                                    <?php } elseif ($this->session->userdata('level') == '3') { ?>
                                                                        <?php if ($row->level == 3) { ?>
                                                                            <a href="<?php echo base_url().'Dept/edit/'.$row->userid; ?>" class="btn btn-xs btn-warning"><i class="fas fa-edit"></i></a>
                                                                            <button type="button" data-toggle="modal" data-target="#hapusUsers" data-id="<?php echo $row->userid; ?>" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></button>                                    
                                                                        <?php } else { ?>
                                                                            <button  href="#" type="button" disabled class="btn btn-xs btn-warning"><i class="fas fa-edit"></i></button>
                                                                            <button type="button" disabled data-toggle="modal" data-target="#hapusUsers" data-id="#" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></button>
                                                                        <?php } ?>
                                                                    <?php } ?>
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
                                        $this->load->view('Users/modal');
                                    ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </div>