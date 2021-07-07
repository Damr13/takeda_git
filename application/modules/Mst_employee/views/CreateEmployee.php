<div class="main-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card" style="min-height: 484px;">
                                    <div class="card-header"><h3>Input New Employee</h3></div>
                                    <div class="card-body">
                                        <form role="form" action="<?php echo base_url('Mst_employee/insert');?>" method="post">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Nik</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="Nik" placeholder="Nik">
                                                    <p class="text-red"><?php echo form_error('Nik');?></p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Full Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="Nama" placeholder="Full Name">
                                                    <p class="text-red"><?php echo form_error('Nama');?></p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Email</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="Email" placeholder="Email">
                                                    <p class="text-red"><?php echo form_error('Email');?></p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Password</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="password" placeholder="Password">
                                                    <p class="text-red"><?php echo form_error('password');?></p>
                                                </div>
                                            </div>
                                             <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Status</label>
                                                <div class="col-sm-9">
                                                <div class="radio radio-outline radio-inline">
                                                            <label>
                                                                <input type="radio" name="status" value="Aktif">
                                                                AKTIF
                                                            </label>
                                                    </div>
                                                    <div class="radio radio-outline radio-inline">
                                                            <label>
                                                                <input type="radio" name="status" value="Tidak Aktif">
                                                                NON AKTIF
                                                            </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Allow WFH</label>
                                                <div class="col-sm-9">
                                                <div class="radio radio-outline radio-inline">
                                                            <label>
                                                                <input type="radio" name="wfh" value="Y">
                                                                YES
                                                            </label>
                                                    </div>
                                                    <div class="radio radio-outline radio-inline">
                                                            <label>
                                                                <input type="radio" name="wfh" value="N">
                                                                NON
                                                            </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Departement</label>
                                                <div class="col-sm-9">
                                                <select class="form-control" name="idDept" id="idDept">
                                                    <?php
                                                    foreach ($dept as $value) {
                                                        echo "<option value='$value->id'>$value->DeptName</option>";
                                                    }
                                                    ?>
                                                </select>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-emp">Submit</button>
                                            <a href="<?php echo base_url('Mst_employee'); ?>" class="btn btn-light">Cancel</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                            