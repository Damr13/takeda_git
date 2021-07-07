<div class="main-content">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="ik ik-inbox bg-blue"></i>
                                        <div class="d-inline">
                                            <h5>Data Table Shift</h5>
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
                                            <li><a href="<?php echo base_url('MstPic/Insert'); ?>"><i class="fa fa-plus"></i>New PIC</a></li>
                                        </ol>
                                    <?php } ?>
                                        <table id="complex-dt" class="table">
                                            <thead>
                                                <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Role</th>
                                                <th>Shift</th>
                                                <th class="nosort">&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                $no = 1;
                                                foreach($dataPic as $key){
                                            ?>
                                                <tr>
                                                    <td><?php echo $no++;?></td>
                                                    <td><?php echo $key->name;?></td>
                                                    <td><?php echo $key->role;?></td>
                                                    <td><?php echo $key->shift;?></td>
                                                    <td>
                                                        <div class="table-actions">
                                                            <?php if($this->update == 1){ ?>
                                                                <a href="<?php echo base_url('MstPic/Edit/'.$key->id); ?>"><i class="ik ik-edit-2"></i></a>
                                                            <?php } ?>
                                                            <?php if($this->delete == 1){ ?>
                                                                <a href="<?php echo base_url('MstPic/Delete/'.$key->id); ?>"><i class="ik ik-trash-2"></i></a>
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