<div class="main-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card" style="min-height: 484px;">
                                    <div class="card-header"><h3>Edit Dept</h3></div>
                                    <div class="card-body">
                                        <form role="form" action="<?php echo base_url('MstDept/edit/'.$mstDept[0]->id);?>" method="post">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">DeptCode</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="DeptCode" placeholder="DeptCode" value="<?php echo $mstDept[0]->DeptCode ?>">
                                                    <p class="text-red"><?php echo form_error('DeptCode');?></p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Departement</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="DeptName" placeholder="DeptName" value="<?php echo $mstDept[0]->DeptName ?>">
                                                    <p class="text-red"><?php echo form_error('DeptName');?></p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Dept Category</label>
                                                <div class="col-sm-9">
                                                    <div class="radio radio-outline radio-inline">
                                                            <label>
                                                                <input type="radio" name="DeptCategory" value="1" <?php if($mstDept[0]->DeptCategory == '1') echo 'checked' ?>>
                                                                Employee
                                                            </label>
                                                    </div>
                                                    <div class="radio radio-outline radio-inline">
                                                            <label>
                                                                <input type="radio" name="DeptCategory" value="2" <?php if($mstDept[0]->DeptCategory == '2') echo 'checked'?>>
                                                                Outsourcing
                                                            </label>
                                                    </div>
                                                </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a href="<?php echo base_url('MstDept'); ?>" class="btn btn-light">Cancel</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                            