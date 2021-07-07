<div class="main-content">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="ik ik-inbox bg-blue"></i>
                                        <div class="d-inline">
                                            <h5>Data Table Machine</h5>
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
                                        <li><a href="<?php echo base_url('MstMachine/insert'); ?>"><i class="fa fa-plus"></i>New Machine</a></li>
                                        </ol>
                                    <?php } ?>
                                        <table id="complex-dt" class="table">
                                            <thead>
                                                <tr>
                                                <th>No</th>
                                                <th>Machine Code</th>
                                                <th>Machine Name</th>
                                                <th>Line Id</th>
                                                <th class="nosort">&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                $no = 1;
                                                foreach($dataMachine as $key){
                                            ?>
                                                <tr>
                                                    <td><?php echo $no++;?></td>
                                                    <td><?php echo $key->machineCode;?></td>
                                                    <td><?php echo $key->machineName;?></td>
                                                    <td><?php echo $key->lineId;?></td>
                                                    <td>
                                                        <div class="table-actions">
                                                            <?php if($this->update == 1){ ?>
                                                                <a href="<?php echo base_url('MstMachine/edit/'.$key->id); ?>"><i class="ik ik-edit-2"></i></a>
                                                            <?php } ?>
                                                            <?php if($this->delete == 1){ ?>
                                                                <a href="<?php echo base_url('MstMachine/delete/'.$key->id); ?>"><i class="ik ik-trash-2"></i></a>
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