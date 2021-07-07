<div class="main-content">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="ik ik-inbox bg-blue"></i>
                                        <div class="d-inline">
                                            <h5>Article</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header"><h3>Data Table</h3></div>
                                    <div class="card-body">
                                    <?php if($this->create == 1){ ?>
                                        <ol class="breadcrumb">
                                            <li><a href="<?php echo base_url('Article/Insert'); ?>"><i class="fa fa-plus"></i>New Article</a></li>
                                        </ol>
                                    <?php } ?>
                                        <table id="complex-dt" class="table">
                                            <thead>
                                                <tr>
                                                <th>No</th>
                                                <th>Judul</th>
                                                <th>Gambar</th>
                                                <th>Status</th>
                                                <th class="nosort">&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                $no = 1;
                                                foreach($dataPic as $key){
                                            ?>
                                                <tr>
                                                    <td><?php echo $no++;?></td>
                                                    <td><?php echo $key->judul;?></td>
                                                    <td>
                                                        <!-- <?php echo $key->gambar;?> -->
                                                        <?php if($key->gambar){ ?>
                                                            <img style="display:block;" width="70px" src="<?php echo $key->gambar;?>">
                                                        <?php } ?>
                                                    </td>
                                                    <td><?php echo $key->status;?></td>
                                                    <td>
                                                        <div class="table-actions">
                                                            <?php if($this->update == 1){ ?>
                                                                <a href="<?php echo base_url('Article/Edit/'.$key->id); ?>"><i class="ik ik-edit-2"></i></a>
                                                            <?php } ?>
                                                            <?php if($this->delete == 1){ ?>
                                                                <a href="<?php echo base_url('Article/Delete/'.$key->id); ?>"><i class="ik ik-trash-2"></i></a>
                                                            <?php } ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php }?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div>
                                        <?php echo $this->session->flashdata('pesan'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>