<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="min-height: 484px;">
                    <div class="card-header"><h3>Input New Article</h3></div>
                    <div class="card-body">
                        <form role="form" action="<?php echo base_url('Article/insert');?>" method="post" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Judul</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="judul" placeholder="Judul">
                                    <p class="text-red"><?php echo form_error('judul');?></p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Gambar</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" name="gambar" accept="image/*" placeholder="Gambar">
                                    <p class="text-red"><?php echo form_error('gambar');?></p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Isi</label>
                                <div class="col-sm-9">
                                    <!-- <input type="text" class="form-control" name="isi" placeholder="Isi"> -->
                                    <textarea id="isi" name="isi" class="summernote"></textarea>
                                    <p class="text-red"><?php echo form_error('isi');?></p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <select class='select2_demo_1 form-control' name="status">
                                        <option value='Draft'>Draft</option>
                                        <option value='Publish'>Publish</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="<?php echo base_url('Article'); ?>" class="btn btn-light">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                            