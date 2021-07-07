<div class="main-content">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="ik ik-inbox bg-blue"></i>
                                        <div class="d-inline">
                                            <h5>Data Table User Level</h5>
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
                                    <li><a href="<?php echo base_url('UserLevel/Insert'); ?>"><i class="fa fa-plus"></i>New User Level</a></li>
                                    </ol>
                                        <table id="complex-dt" class="table">
                                            <thead>
                                                <tr>
                                                <th>No</th>
                                                <th>Nama Level</th>
                                                <th class="nosort">&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                $no = 1;
                                                foreach($dataUserLevel as $key){
                                            ?>
                                                <tr>
                                                    <td><?php echo $no++;?></td>
                                                    <td><?php echo $key->nama_level;?></td>
                                                    <td>
                                                        <div class="table-actions">
                                                            <a href="<?php echo base_url('UserLevel/Edit/'.$key->id_user_level); ?>"><i class="ik ik-edit-2"></i></a>
                                                            <a href="<?php echo base_url('UserLevel/Delete/'.$key->id_user_level); ?>"><i class="ik ik-trash-2"></i></a>
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