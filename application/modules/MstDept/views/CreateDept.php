<div class="main-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card" style="min-height: 484px;">
                                    <div class="card-header"><h3>Input New Dept</h3></div>
                                    <div class="card-body">
                                        <form role="form" action="<?php echo base_url('MstDept/insert');?>" method="post">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">DeptCode</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="DeptCode" placeholder="DeptCode">
                                                    <p class="text-red"><?php echo form_error('DeptCode');?></p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Departement</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="DeptName" placeholder="DeptName">
                                                    <p class="text-red"><?php echo form_error('DeptName');?></p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">DeptCategory</label>
                                                <div class="col-sm-9">
                                                    <div class="radio radio-outline radio-inline">
                                                            <label>
                                                                <input type="radio" name="DeptCategory" value="1">
                                                                Employee
                                                            </label>
                                                    </div>
                                                    <div class="radio radio-outline radio-inline">
                                                            <label>
                                                                <input type="radio" name="DeptCategory" value="2">
                                                                Outsourcing
                                                            </label>
                                                    </div>
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
                            