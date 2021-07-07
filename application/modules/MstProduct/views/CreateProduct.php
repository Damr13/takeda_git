<div class="main-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card" style="min-height: 484px;">
                                    <div class="card-header"><h3>Input New Product</h3></div>
                                    <div class="card-body">
                                        <form role="form" action="<?php echo base_url('MstProduct/insert');?>" method="post">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Product Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="product_name" placeholder="Product Name">
                                                    <p class="text-red"><?php echo form_error('product_name');?></p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Satuan</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="uom" placeholder="Satuan">
                                                    <p class="text-red"><?php echo form_error('uom');?></p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">SPQ</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="spq" placeholder="SPQ">
                                                    <p class="text-red"><?php echo form_error('spq');?></p>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a href="<?php echo base_url('MstProduct'); ?>" class="btn btn-light">Cancel</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                            