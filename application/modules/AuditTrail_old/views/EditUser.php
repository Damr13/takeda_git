<div class="main-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card" style="min-height: 484px;">
                                    <div class="card-header"><h3>Edit User</h3></div>
                                    <div class="card-body">
                                        <form role="form" action="<?php echo base_url('User/edit/'.$dataUser[0]->id_users);?>" method="post">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Full Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="full_name" placeholder="Full Name" value="<?php echo $dataUser[0]->full_name ?>">
                                                    <p class="text-red"><?php echo form_error('full_name');?></p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Email</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="email" placeholder="Email" value="<?php echo $dataUser[0]->email ?>">
                                                    <p class="text-red"><?php echo form_error('email');?></p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Level User</label>
                                                <div class="col-sm-9">
                                                <select class="form-control" name="id_user_level" id="id_user_level">
                                                    <?php
                                                    foreach ($dataUserLevel as $value) {
                                                        echo "<option value='$value->id_user_level'";
                                                    echo $dataUser[0]->id_user_level==$value->id_user_level?'selected':'';
                                                    echo ">$value->nama_level</option>";
                                                    }
                                                    ?>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Status</label>
                                                <div class="col-sm-9">
                                                <div class="radio radio-outline radio-inline">
                                                            <label>
                                                                <input type="radio" name="is_aktif" value="y" <?php if($dataUser[0]->is_aktif == 'y') echo 'checked' ?>>
                                                                AKTIF
                                                            </label>
                                                    </div>
                                                    <div class="radio radio-outline radio-inline">
                                                            <label>
                                                                <input type="radio" name="is_aktif" value="n" <?php if($dataUser[0]->is_aktif == 'n') echo 'checked' ?>>
                                                                TIDAK AKTIF
                                                            </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a href="<?php echo base_url('User'); ?>" class="btn btn-light">Cancel</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                            