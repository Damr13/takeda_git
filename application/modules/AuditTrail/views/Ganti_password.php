<div class="main-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card" style="min-height: 484px;">
                                    <div class="card-header"><h3>Ganti Password User : <?php echo $dataUser[0]->full_name ?></h3></div>
                                    <div class="card-body">
                                        <form role="form" action="<?php echo base_url('User/Ganti_pass/'.$dataUser[0]->id_users);?>" method="post">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">New Password</label>
                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control" name="new_password" placeholder="New Password"">
                                                    <p class="text-red"><?php echo form_error('new_password');?></p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Confirm Password</label>
                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password"">
                                                    <p class="text-red"><?php echo form_error('confirm_password');?></p>
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
                            