<div class="main-content">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="ik ik-inbox bg-blue"></i>
                                        <div class="d-inline">
                                            <h5>Data Table Downtime</h5>
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
                                        <li><a href="<?php echo base_url('MstDowntime/insert'); ?>"><i class="fa fa-plus"></i>New Downtime</a></li>
                                        </ol>
                                    <?php } ?>

                                        <table id="complex-dt" class="table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Downtime Code</th>
                                                    <th>Downtime Name</th>
                                                    <th>Downtime Group</th>
                                                    <th class="nosort">&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $no = 1;
                                                    foreach($dataDowntime as $getData){
                                                ?>
                                                <tr>
                                                    <td><?php echo $no++;?></td>
                                                    <td><?php echo $getData->downtimeCode;?></td>
                                                    <td><?php echo $getData->downtimeName;?></td>
                                                    <td><?php echo $getData->downtimeGroup;?></td>
                                                    <td>
                                                        <div class="table-actions">
                                                            <?php if($this->update == 1){ ?>
                                                                <a href="<?php echo base_url('MstDowntime/edit/'.$getData->id); ?>"><i class="ik ik-edit-2"></i></a>
                                                            <?php } ?>
                                                            <?php if($this->delete == 1){ ?>
                                                                <a href="<?php echo base_url('MstDowntime/delete/'.$getData->id); ?>"><i class="ik ik-trash-2"></i></a>
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