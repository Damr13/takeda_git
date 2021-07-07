    <body>
        <div class="wrapper">
            <header class="header-top" header-theme="light">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between">
                        <div class="top-menu d-flex align-items-center">
                            <button type="button" class="btn-icon mobile-nav-toggle d-lg-none"><span></span></button>
                            <div class="header-search">
                                <div class="input-group">
                                    <span class="input-group-addon search-close"><i class="ik ik-x"></i></span>
                                    <input type="text" class="form-control">
                                    <span class="input-group-addon search-btn"><i class="ik ik-search"></i></span>
                                </div>
                            </div>
                            <button type="button" id="navbar-fullscreen" class="nav-link"><i class="ik ik-maximize"></i></button>
                        </div>
                        <div class="top-menu d-flex align-items-center">
                            <div class="dropdown">
                                <a class="dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><h5><b><?php echo $this->session->userdata('full_name'); ?></b></h5></a>
                                 <!-- <a class="dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="avatar" src="<?php echo base_url('assets/img/user.jpg');?>" alt=""></a> -->
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="#"><i class="ik ik-power dropdown-icon"></i> <?php echo $this->session->userdata('full_name'); ?></a>
                                    <a class="dropdown-item" href="<?php echo base_url('Login/logout');?>"><i class="ik ik-power dropdown-icon"></i> Logout</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </header>

            <div class="page-wrap">
                <div class="app-sidebar colored">
                    <div class="sidebar-header">
                        <a class="header-brand" href="<?php echo base_url('Main');?>">
                            <div class="logo-img">
                               <img src="<?php echo base_url('assets/'); ?>src/img/ogol.png" class="header-brand-img"> 
                            </div>
                            <span class="text"></span>
                        </a>
                        <!-- <button type="button" class="nav-toggle"><i data-toggle="expanded" class="ik ik-toggle-right toggle-icon"></i></button> -->
                        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
                    </div>
                    
                    <div class="sidebar-content">
                        <div class="nav-container">
                            <nav id="main-menu-navigation" class="navigation-main">
                                <!-- <div class="nav-lavel">Navigation</div> -->
                                <div class="nav-item">
                                    <a href="<?php echo base_url('Main');?>"><i class="ion-ios-speedometer"></i><span>Dashboard</span></a>
                                </div>
                                <?php echo $menu; ?>
                                
                                <!-- <div class="nav-item has-sub">
                                    <a href="javascript:void(0)"><i class="ik ik-folder"></i><span>Master Data</span></a>
                                    <div class="submenu-content">
                                        <a href="<?php echo base_url('MstPic');?>" class="menu-item">Master PIC</a>
                                        <a href="<?php echo base_url('MstDowntime');?>" class="menu-item">Master Downtime</a>
                                        <a href="<?php echo base_url('MstProduct');?>" class="menu-item">Master Product</a>
                                        <a href="<?php echo base_url('MstMachine');?>" class="menu-item">Master Machine</a>
                                        <a href="<?php echo base_url('MstLine');?>" class="menu-item">Master Line</a>
                                        <a href="<?php echo base_url('MstShift');?>" class="menu-item">Master Shift Time</a>
                                        <a href="<?php echo base_url('MstTarget');?>" class="menu-item">Master Target</a>
                                        <a href="<?php echo base_url('MstTargetOEE');?>" class="menu-item">Master Target OEE</a>
                                    </div>
                                </div>
                                <div class="nav-item has-sub">
                                    <a href="javascript:void(0)"><i class="ik ik-layers"></i><span>Data Entry</span></a>
                                    <div class="submenu-content">
                                        <a href="<?php echo base_url('Log');?>" class="menu-item">Input Form OEE</a>
                                        <a href="<?php echo base_url('Pm_cal');?>" class="menu-item">PM & Cal</a>
                                        <a href="<?php echo base_url('Consumption');?>" class="menu-item">Energy Consumption</a>
                                        <a href="<?php echo base_url('Capability');?>" class="menu-item">CAPA</a>
                                    </div>
                                </div>
                                <div class="nav-item has-sub">
                                    <a href="javascript:void(0)"><i class="ik ik-layers"></i><span>Budget</span></a>
                                    <div class="submenu-content">
                                        <a href="<?php echo base_url('Capex');?>" class="menu-item">Capex</a>
                                        <a href="<?php echo base_url('Opex');?>" class="menu-item">Opex</a>
                                    </div>
                                </div>
                                <div class="nav-item has-sub">
                                    <a href="javascript:void(0)"><i class="ik ik-file-text"></i><span>Report</span></a>
                                    <div class="submenu-content">
                                        <a href="<?php echo base_url('RptResume');?>"  class="menu-item">Resume</a>
                                        <a href="<?php echo base_url('BreakDowntime');?>" class="menu-item">Breakdown DownTime</a>
                                        <a href="<?php echo base_url('RptOEE');?>" class="menu-item">OEE</a>
                                    </div>
                                </div> -->

                                <?php if($this->session->userdata('id_user_level') == 1){ ?>
                                    <div class="nav-item has-sub">
                                        <a href="javascript:void(0)"><i class="ik ik-user"></i><span>User Administration</span></a>
                                        <div class="submenu-content">
                                            <a href="<?php echo base_url('User');?>" class="menu-item">User</a>
                                            <a href="<?php echo base_url('UserLevel');?>" class="menu-item">User Level</a>
                                            <a href="<?php echo base_url('MstMenu');?>" class="menu-item">Menu</a>
                                            <a href="<?php echo base_url('Menu_akses');?>" class="menu-item">Menu Akses</a>
                                            <a href="<?php echo base_url('AuditTrail');?>" class="menu-item">Audit Trail</a>
                                        </div>
                                    </div>
                                <?php } ?>

                                <div class="nav-item">
                                <a href="<?php echo base_url('Login/logout');?>"><i class="ik ik-power"></i><span>Logout</span></a>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
                
                <?php
                echo $contents;
                ?>
               
                <div class="ft">
                <footer class="footer">
                    <div class="w-100 clearfix">
                        <span class="text-center text-sm-left d-md-inline-block">Copyright © 2020 Takeda Indonesia v1.0. All Rights Reserved.</span>
                        <span class="float-none float-sm-right mt-1 mt-sm-0 text-center"> Developed  <i class="fa fa-heart text-danger"></i><a href="http://digitaloptima.id/" class="text-dark" target="_blank"> By Digital Optima Integra</a></span>
                    </div>
                </footer>
                </div>
            </div>
        </div>