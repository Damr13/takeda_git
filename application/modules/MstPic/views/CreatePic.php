<div class="main-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card" style="min-height: 484px;">
                                    <div class="card-header"><h3>Input New PIC</h3></div>
                                    <div class="card-body">
                                        <form role="form" action="<?php echo base_url('MstPic/insert');?>" method="post">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="name" placeholder="Name">
                                                    <p class="text-red"><?php echo form_error('name');?></p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Role</label>
                                                <div class="col-sm-9">
                                                    <div class="radio radio-outline radio-inline">
                                                            <label>
                                                                <input type="radio" name="role" value="LEADER">
                                                                LEADER
                                                            </label>
                                                    </div>
                                                    <div class="radio radio-outline radio-inline">
                                                            <label>
                                                                <input type="radio" name="role" value="OPERATOR">
                                                                OPERATOR
                                                            </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Shift</label>
                                                <div class="col-sm-9">
                                                    <div class="radio radio-outline radio-inline">
                                                            <label>
                                                                <input type="radio" name="shift" value="1">
                                                                SHIFT 1
                                                            </label>
                                                    </div>
                                                    <div class="radio radio-outline radio-inline">
                                                            <label>
                                                                <input type="radio" name="shift" value="2">
                                                                SHIFT 2
                                                            </label>
                                                    </div>
                                                    <div class="radio radio-outline radio-inline">
                                                            <label>
                                                                <input type="radio" name="shift" value="3">
                                                                SHIFT 3
                                                            </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a href="<?php echo base_url('MstPic'); ?>" class="btn btn-light">Cancel</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                            