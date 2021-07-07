<div class="main-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card" style="min-height: 484px;">
                                    <div class="card-header"><h3>Edit Downtime</h3></div>
                                    <div class="card-body">
                                        <form role="form" action="<?php echo base_url('MstDowntime/edit/'.$mstDowntime[0]->id);?>" method="post">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Downtime Code</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="downtimeCode" placeholder="Downtime Code" value="<?php echo $mstDowntime[0]->downtimeCode ?>">
                                                    <p class="text-red"><?php echo form_error('downtimeCode');?></p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Downtime Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="downtimeName" placeholder="Downtime Name" value="<?php echo $mstDowntime[0]->downtimeName ?>">
                                                    <p class="text-red"><?php echo form_error('downtimeName');?></p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Downtime Group</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="downtimeGroup" placeholder="Downtime Group" value="<?php echo $mstDowntime[0]->downtimeGroup ?>">
                                                    <p class="text-red"><?php echo form_error('downtimeGroup');?></p>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a href="<?php echo base_url('MstDowntime'); ?>" class="btn btn-light">Cancel</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>