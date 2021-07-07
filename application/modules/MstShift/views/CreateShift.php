<div class="main-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card" style="min-height: 484px;">
                                    <div class="card-header"><h3>Input New Shift Time</h3></div>
                                    <div class="card-body">
                                        <form role="form" action="<?php echo base_url('MstShift/insert');?>" method="post">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Code Shift</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="codeShift" placeholder="Code Shift">
                                                    <p class="text-red"><?php echo form_error('codeShift');?></p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Start Shift</label>
                                                <div class="col-sm-9">
                                                    <div class='input-group date'>
                                                        <input type='text' name="startShift" id='startShift' class="form-control" />
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-time"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">End Shift</label>
                                                <div class="col-sm-9">
                                                    <div class='input-group date'>
                                                        <input type='text' name="endShift" id='endShift' class="form-control" />
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-time"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a href="<?php echo base_url('MstShift'); ?>" class="btn btn-light">Cancel</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                            