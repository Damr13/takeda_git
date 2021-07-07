<div class="main-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card" style="min-height: 484px;">
                                    <div class="card-header"><h3>Edit Employee</h3></div>
                                    <div class="card-body">
                                        <form role="form" action="<?php echo base_url('Mst_employee/edit/'.$dataUser[0]->id);?>" method="post">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Nik</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="Nik" placeholder="Nik" value="<?php echo $dataUser[0]->Nik?>">
                                                    <p class="text-red"><?php echo form_error('Nik');?></p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="Nama" placeholder="Full Name" value="<?php echo $dataUser[0]->Nama?>">
                                                    <p class="text-red"><?php echo form_error('Nama');?></p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Email</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="Email" placeholder="Email" value="<?php echo $dataUser[0]->Email ?>">
                                                    <p class="text-red"><?php echo form_error('Email');?></p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Status</label>
                                                <div class="col-sm-9">
                                                <div class="radio radio-outline radio-inline">
                                                            <label>
                                                                <input type="radio" name="status" value="Aktif" <?php if($dataUser[0]->status == 'Aktif') echo 'checked' ?>>
                                                                AKTIF
                                                            </label>
                                                    </div>
                                                    <div class="radio radio-outline radio-inline">
                                                            <label>
                                                                <input type="radio" name="status" value="Tidak Aktif" <?php if($dataUser[0]->status == 'Tidak Aktif') echo 'checked' ?>>
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
                                                                <input type="radio" name="wfh" value="Y" <?php if($dataUser[0]->wfh == 'Y') echo 'checked' ?>>
                                                                YES
                                                            </label>
                                                    </div>
                                                    <div class="radio radio-outline radio-inline">
                                                            <label>
                                                                <input type="radio" name="wfh" value="N" <?php if($dataUser[0]->wfh == 'N') echo 'checked' ?>>
                                                                NO
                                                            </label>
                                                    </div>
                                                </div>
                                            </div>
                                           <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Departement</label>
                                                <div class="col-sm-9">
                                                <select class="form-control" name="idDept" id="idDept">
                                                    <?php
                                                    foreach ($dataUserLevel as $value) {
                                                        echo "<option value='$value->id'";
                                                    echo $dataUser[0]->idDept==$value->id?'selected':'';
                                                    echo ">$value->DeptName</option>";
                                                    }
                                                    ?>
                                                </select>
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
                            