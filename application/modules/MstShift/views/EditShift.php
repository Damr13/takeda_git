<div class="main-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card" style="min-height: 484px;">
                                    <div class="card-header"><h3>Edit Shift Time</h3></div>
                                    <div class="card-body">
                                        <form role="form" action="<?php echo base_url('MstShift/edit/'.$mstShift[0]->codeShift);?>" method="post">
                                        <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Shift</label>
                                                <div class="col-sm-9">
                                                    <div class="radio radio-outline radio-inline">
                                                            <label>
                                                                <input type="radio" name="codeShift" value="S1" <?php if($mstShift[0]->codeShift == 'S1') echo 'checked' ?>>
                                                                Shift 1
                                                            </label>
                                                    </div>
                                                    <div class="radio radio-outline radio-inline">
                                                            <label>
                                                                <input type="radio" name="codeShift" value="S2" <?php if($mstShift[0]->codeShift == 'S2') echo 'checked' ?>>
                                                                Shift 2
                                                            </label>
                                                    </div>
                                                    <div class="radio radio-outline radio-inline">
                                                            <label>
                                                                <input type="radio" name="codeShift" value="S3" <?php if($mstShift[0]->codeShift == 'S3') echo 'checked' ?>>
                                                                Shift 3
                                                            </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Start Shift</label>
                                                <div class="col-sm-9">
                                                    <div class='input-group date'>
                                                        <input type='text' name="startShift" id='startShift' value="<?= $mstShift[0]->startShift; ?>" class="form-control" />
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
                                                        <input type='text' name="endShift" id='endShift' value="<?= $mstShift[0]->endShift; ?>" class="form-control" />
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
                            