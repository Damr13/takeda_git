<div class="main-content">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="ik ik-inbox bg-blue"></i>
                                        <div class="d-inline">
                                            <h5>Data Table User</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header"><h3>Data Table</h3></div>
                                    <div class="card-body">
                                    <ol class="breadcrumb">
                                    <li><a href="<?php echo base_url('User/insert'); ?>"><i class="fa fa-plus"></i>New User</a></li>
                                    </ol>
                                        <table id="complex-dt" class="table">
                                            <thead>
                                                <tr>
                                                <th>No</th>
                                                <th>Full Name</th>
                                                <th>Email</th>
                                                <th>Nama Level</th>
                                                <th>Status</th>
                                                <th class="nosort">&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                $no = 1;
                                                foreach($dataUser as $key){
                                            ?>
                                                <tr>
                                                    <td><?php echo $no++;?></td>
                                                    <td><?php echo $key->full_name;?></td>
                                                    <td><?php echo $key->email;?></td>
                                                    <td><?php echo $key->id_user_level;?></td>
                                                    <td><?php echo $key->is_aktif;?></td>
                                                    <td>
                                                        <div class="table-actions">
                                                            <a href="<?php echo base_url('User/Ganti_pass/'.$key->id_users); ?>"><i class="fa fa-key"></i></a>
                                                            <a href="<?php echo base_url('User/Edit/'.$key->id_users); ?>"><i class="ik ik-edit-2"></i></a>
                                                            <a href="<?php echo base_url('User/Delete/'.$key->id_users); ?>"><i class="ik ik-trash-2"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php }?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div>
                                        <?php echo $this->session->flashdata('pesan'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>