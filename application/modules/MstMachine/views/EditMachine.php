<div class="main-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card" style="min-height: 484px;">
                                    <div class="card-header"><h3>Edit Machine</h3></div>
                                    <div class="card-body">
                                        <form role="form" action="<?php echo base_url('MstMachine/edit/'.$mstMachine[0]->id);?>" method="post">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Machine Code</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="machineCode" placeholder="Machine Code" value="<?php echo $mstMachine[0]->machineCode ?>">
                                                    <p class="text-red"><?php echo form_error('machineCode');?></p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Machine Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="machineName" placeholder="Machine Name" value="<?php echo $mstMachine[0]->machineName ?>">
                                                    <p class="text-red"><?php echo form_error('machineName');?></p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Line ID</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="lineId" placeholder="Line ID" value="<?php echo $mstMachine[0]->lineId ?>">
                                                    <p class="text-red"><?php echo form_error('lineId');?></p>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a href="<?php echo base_url('MstMachine'); ?>" class="btn btn-light">Cancel</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                            