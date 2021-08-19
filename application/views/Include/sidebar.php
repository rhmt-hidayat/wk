        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="index3.html" class="brand-link">
                <img src="<?php echo base_url().'assets/img/mini-bg.png'; ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Schlemmer Indonesia</span>
            </a>

            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?php echo base_url().'assets/admin/dist/img/user2-160x160.jpg'; ?>" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?php echo $this->session->userdata('nama'); ?></a>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="<?php echo base_url().'Dashboard'; ?>" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">TRANSAKSI</li>
                        <li class="nav-item">
                            <a href="<?php echo base_url().'Transaksi'; ?>" class="nav-link">
                                <i class="nav-icon fas fa-clipboard-list"></i>
                                <p>
                                    Working Ticket
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">REPORT</li>
                        <li class="nav-item">
                            <a href="<?php echo base_url().'Report'; ?>" class="nav-link">
                                <i class="nav-icon fas fa-box"></i>
                                <p>
                                    Report Transaksi
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url().'Total'; ?>" class="nav-link">
                                <i class="nav-icon fas fa-box"></i>
                                <p>
                                    Total Transaksi
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url().'Working'; ?>" class="nav-link">
                                <i class="nav-icon fas fa-box"></i>
                                <p>
                                    Working Hours
                                </p>
                            </a>
                        </li>
						<li class="nav-header">SYNCRONIZE</li>
						<li class="nav-item">
                            <a href="<?php echo base_url().'Sync'; ?>" class="nav-link">
                                <i class="nav-icon fas fa-sync"></i>
                                <p>
                                    Sync Data From K3
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">MASTER DATA</li>
                        <li class="nav-item">
                            <a href="<?php echo base_url().'Proses'; ?>" class="nav-link">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>
                                    Master Process
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url().'Reason'; ?>" class="nav-link">
                                <i class="nav-icon fas fa-check-double"></i>
                                <p>
                                    Master Additional Reason
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url().'Dept'; ?>" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Users
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url().'Login/logout'; ?>" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    Logout
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>