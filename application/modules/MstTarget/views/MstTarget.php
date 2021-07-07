<div class="main-content">
                    <div class="container-fluid">
                        <div class="page-header">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="ik ik-inbox bg-blue"></i>
                                        <div class="d-inline">
                                            <h5>Data Table Target</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header"><h3>Monthly Target</h3></div>
                                    <div class="card-body">
                                    <?php if($this->create == 1){ ?>
                                        <ol class="breadcrumb">
                                        <li><button class='btn btn-outline btn-info' onClick='addYear()'><i class='fa fa-plus'> Add Year Target</i></button></li>
                                        </ol>
                                    <?php } ?>
                                    
                                        <table id="complex-dt" class="table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Year</th>
                                                    <th>Jan</th>
                                                    <th>Feb</th>
                                                    <th>Mar</th>
                                                    <th>Apr</th>
                                                    <th>May</th>
                                                    <th>Jun</th>
                                                    <th>Jul</th>
                                                    <th>Aug</th>
                                                    <th>Sep</th>
                                                    <th>Oct</th>
                                                    <th>Nov</th>
                                                    <th>Dec</th>
                                                    <th class="nosort">&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $no = 1;
                                                    foreach($dataTarget as $getData){
                                                ?>
                                                <tr>
                                                    <td><?php echo $no++;?></td>
                                                    <td><?php echo $getData->year;?></td>
                                                    <td><?php echo $getData->jan;?></td>
                                                    <td><?php echo $getData->feb;?></td>
                                                    <td><?php echo $getData->mar;?></td>
                                                    <td><?php echo $getData->apr;?></td>
                                                    <td><?php echo $getData->may;?></td>
                                                    <td><?php echo $getData->jun;?></td>
                                                    <td><?php echo $getData->jul;?></td>
                                                    <td><?php echo $getData->aug;?></td>
                                                    <td><?php echo $getData->sep;?></td>
                                                    <td><?php echo $getData->oct;?></td>
                                                    <td><?php echo $getData->nov;?></td>
                                                    <td><?php echo $getData->dec;?></td>
                                                    <td>
                                                        <div class="table-actions">
                                                            <?php if($this->update == 1){ ?>
                                                                <button type='button' class='btn btn-success btn-rounded btn-block' onClick='modalEditTarget(<?php echo '
                                                                "'.$getData->id.'",
                                                                "'.$getData->year.'",
                                                                "'.$getData->jan.'",
                                                                "'.$getData->feb.'",
                                                                "'.$getData->mar.'",
                                                                "'.$getData->apr.'",
                                                                "'.$getData->may.'",
                                                                "'.$getData->jun.'",
                                                                "'.$getData->jul.'",
                                                                "'.$getData->aug.'",
                                                                "'.$getData->sep.'",
                                                                "'.$getData->oct.'",
                                                                "'.$getData->nov.'",
                                                                "'.$getData->dec.'"
                                                                ' ?>)'><i class='fa fa-plus'> Edit</i></button>
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
                         <!-- MODAL FOR INPUT OPERATORE -->
                        <div class="modal" id="editTarget">
                          <div class="modal-dialog">
                            <div class="modal-content">

                              <!-- Modal Header -->
                              <div class="modal-header">
                                <h4 class="modal-title" id="headerYear"></h4>
                              </div>

                              <!-- Modal body -->
                              <div class="modal-body form-group">
                                <input type="hidden" id="idTarget" name="idTarget" readonly=""> 
                                <div class='row'>
                                    <div class='col-lg-6'>
                                        <label>Januari</label>
                                        <input class='form-control' type="number" id="jan" name="jan" > <br>
                                        <label>Februari</label>
                                        <input class='form-control' type="number" id="feb" name="feb"> <br>
                                        <label>Maret</label>
                                        <input class='form-control' type="number" id="mar" name="mar"> <br>
                                        <label>April</label>
                                        <input class='form-control' type="number" id="apr" name="apr"> <br>
                                        <label>May</label>
                                        <input class='form-control' type="number" id="may" name="may"> <br>
                                        <label>June</label>
                                        <input class='form-control' type="number" id="jun" name="jun"> <br>
                                    </div>
                                    <div class='col-lg-6'>
                                        <label>July</label>
                                        <input class='form-control' type="number" id="jul" name="jul"> <br>
                                        <label>August</label>
                                        <input class='form-control' type="number" id="aug" name="aug"> <br>
                                        <label>September</label>
                                        <input class='form-control' type="number" id="sep" name="sep"> <br>
                                        <label>October</label>
                                        <input class='form-control' type="number" id="oct" name="oct"> <br>
                                        <label>November</label>
                                        <input class='form-control' type="number" id="nov" name="nov"> <br>
                                        <label>December</label>
                                        <input class='form-control' type="number" id="dec" name="dec"> <br>
                                    </div>
                                </div>
                              </div>

                              <!-- Modal footer -->
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger" onclick="closeModal()">Close</button>
                                <button type="button" class="btn btn-success" onclick="editTarget()">Save</button>
                              </div>

                            </div>
                          </div>
                        </div>