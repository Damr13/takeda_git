<div class="main-content">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="ik ik-inbox bg-blue"></i>
                                        <div class="d-inline">
                                            <h5>Data Table Departement</h5>
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
                                    <?php if($this->create == 1){ ?>
                                        <ol class="breadcrumb">
                                            <li><a href="<?php echo base_url('MstDept/Insert'); ?>"><i class="fa fa-plus"></i>New Dept</a></li>
                                        </ol>
                                    <?php } ?>
                                        <table id="complex-dt" class="table">
                                            <thead>
                                                <tr>
                                                <th>No</th>
                                                <th>DeptCode</th>
                                                <th>Departement</th>
                                                <th>Dept Category</th>
                                                <th class="nosort">&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                $no = 1;
                                                foreach($dataDept as $key){
                                            ?>
                                                <tr>
                                                    <td><?php echo $no++;?></td>
                                                    <td><?php echo $key->DeptCode;?></td>
                                                    <td><?php echo $key->DeptName;?></td>
                                                    <td><?php echo $key->Category;?></td>
                                                    <td>
                                                        <div class="table-actions">
                                                            <?php if($this->update == 1){ ?>
                                                                <a href="<?php echo base_url('MstDept/Edit/'.$key->id); ?>"><i class="ik ik-edit-2"></i></a>
                                                            <?php } ?>
                                                            <?php if($this->delete == 1){ ?>
                                                                <a href="<?php echo base_url('MstDept/Delete/'.$key->id); ?>"><i class="ik ik-trash-2"></i></a>
                                                            <?php } ?>
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