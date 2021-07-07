<div class="main-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card" style="min-height: 484px;">
                                    <div class="card-header"><h3>Edit User Level</h3></div>
                                    <div class="card-body">
                                        <form role="form" action="<?php echo base_url('UserLevel/edit/'.$dataUserLevel[0]->id_user_level);?>" method="post">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Nama Level</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="nama_level" placeholder="Nama Level" value="<?php echo $dataUserLevel[0]->nama_level ?>">
                                                    <p class="text-red"><?php echo form_error('nama_level');?></p>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a href="<?php echo base_url('UserLevel'); ?>" class="btn btn-light">Cancel</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                            