<div class="main-content">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="ik ik-inbox bg-blue"></i>
                                        <div class="d-inline">
                                            <h5>Master Data Employee</h5>
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
                                    <li><a href="<?php echo base_url('Mst_employee/insert'); ?>"><i class="fa fa-plus"></i>New Employee</a></li>
                                    </ol>
                                        <table id="complex-dt" class="table">
                                            <thead>
                                                <tr>
                                                <th>No</th>
                                                <th>Nik</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Departement</th>
                                                <th>Password</th>
                                                <th>Status</th>
                                                <th>Allow WFH</th>
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
                                                    <td><?php echo $key->Nik;?></td>
                                                    <td><?php echo $key->Nama;?></td>
                                                    <td><?php echo $key->Email;?></td>
                                                    <td><?php echo $key->DeptName;?></td>
                                                    <td><?php echo $key->Password;?></td>
                                                    <td><?php echo $key->status;?></td>
                                                    <td><?php echo $key->wfh;?></td>
                                                    <td>
                                                        <div class="table-actions">
                                                            <a href="<?php echo base_url('Mst_employee/Ganti_pass/'.$key->id); ?>"><i class="fa fa-key"></i></a>
                                                            <a href="<?php echo base_url('Mst_employee/Edit/'.$key->id); ?>"><i class="ik ik-edit-2"></i></a>
                                                            <a href="<?php echo base_url('Mst_employee/Delete/'.$key->id); ?>"><i class="ik ik-trash-2"></i></a>
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