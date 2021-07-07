<div class="main-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card" style="min-height: 484px;">
                                    <div class="card-header"><h3>Edit Line</h3></div>
                                    <div class="card-body">
                                        <form role="form" action="<?php echo base_url('MstLine/edit/'.$mstLine[0]->id);?>" method="post">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Line ID</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="lineId" placeholder="Line ID" value="<?php echo $mstLine[0]->lineId ?>">
                                                    <p class="text-red"><?php echo form_error('lineId');?></p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Line Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="lineName" placeholder="Line Name" value="<?php echo $mstLine[0]->lineName ?>">
                                                    <p class="text-red"><?php echo form_error('lineName');?></p>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a href="<?php echo base_url('MstLine'); ?>" class="btn btn-light">Cancel</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                            