<div class="main-content">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="ik ik-inbox bg-blue"></i>
                                        <div class="d-inline">
                                            <h5>Audit Trail</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>Audit Trail</h3>
                                    </div>
                                    <div class="card-body">
                                        <table id="complex-dt" class="table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>User</th>
                                                    <th>Shift</th>
                                                    <th>Down Time Code</th>
                                                    <th>Down Time Name</th>
                                                    <th>Down Time Group</th>
                                                    <th class="nosort">&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $no = 1;
                                                    foreach($AuditTrail as $getData){
                                                ?>
                                                <tr>
                                                    <td><?php echo $no++;?></td>
                                                    <td><?php echo $getData->date;?></td>
                                                    <td><?php echo $getData->time;?></td>
                                                    <td><?php echo $getData->full_name;?></td>
                                                    <td><?php echo $getData->shift;?></td>
                                                    <td><?php echo $getData->downtimeCode;?></td>
                                                    <td><?php echo $getData->downtimeName;?></td>
                                                    <td><?php echo $getData->downtimeGroup;?></td>
                                                    <td>
                                                        
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