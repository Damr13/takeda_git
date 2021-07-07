<div class="main-content">
  <div class="container-fluid">
    <!-- HEADER FOR TITLE --ir -->
    <div class="page-header" style="margin-bottom:10px;">
      <div class="row align-items-end">
        <div class="col-lg-12">
          <div class="page-header-title" style="text-align: center;">
            <!-- <i class="ik ik-file-text bg-blue"></i> -->
            <div class="d-inline">
              <h5>DEPARTEMENT PRODUKSI - STRIPPING <div id="bulan_name"></div> </h5>
              <span>LOGBOOK Primary Packaging LINE <b id="machineTitle"></b></span>
              <hr />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <!-- HEADER FOR DATE, MACHINE, AND SPEED TAB --ir -->
      <!-- LOOGBOOK --ir -->
      <div class="col-md-6">   
        <div class="col-lg-5">
            <div class="form-group">
              <label for="date">Date : </label>
              <input id="date_1" name="date" readonly="" class="form-control"> 

            </div>
        </div>
        <div class="col-lg-5">
          <div class='form-group' style='width:100% !important'>
            <label class='font-noraml' style='font-weight:bold'>Machine :</label>
            <div class='input-group'>
              <select class='select2_demo_1 form-control' id='id_machine'>
                  <option value=''></option>
                  <?php foreach ($machine as $machine) { ?>
                    <option value='<?php echo $machine->id; ?>'><?php echo $machine->machineName; ?></option>
                  <?php } ?>
              </select>
            </div>
          </div>
        </div>
        <div class="col-lg-2">
          <label class='font-noraml'></label>
          <button id="btn_cari" class='lock-shft' style='width:100%;color: white;font-weight: bold;background-color: #404E68;' onclick="cari_by_bulan()">Search <i class='ik ik-search'></i></button>
          <div class="spinner-border" role="status" style="display: none" id="spinner">
            <span class="sr-only">Loading...</span>
          </div>
        </div>
        <div class="ibox">
            <div class="ibox-content">
                
                <div class="clients-list">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-1"></i> Shift 1</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-2"></i> Shift 2</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-3"></i> Shift 3</a></li>
                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                      <div class="full-height-scroll" id="tabel_tab_1">

                      </div>
                    </div>


                    <div id="tab-2" class="tab-pane">
                        <div class="full-height-scroll" id="tabel_tab_2">
                            
                        </div>
                    </div>


                    <div id="tab-3" class="tab-pane"> 
                        <div class="full-height-scroll" id="tabel_tab_3">
                            
                        </div>
                    </div>

                </div>

                </div>
            </div>
        </div>

      </div>

      <div class="col-md-6">
        <!-- <center><h5>Mesin : <span id="name_machine"></span>, Speed (tab/mnt) : 1000 tablet/menit ~ <span id="speedRpm">250</span> rpm</h5></center>   -->
        <div class="ibox">
            <div class="ibox-content">
                
                <div class="clients-list">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-report-1" style="font-size: 70% !important;padding: 5px 5px 10px 5px !important;"></i>Run Time</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-report-2" style="font-size: 70% !important;padding: 5px 5px 10px 5px !important;"></i>Planned Down Time</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-report-3" style="font-size: 70% !important;padding: 5px 5px 10px 5px !important;"></i>Unplanned Down Time</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-report-4" style="font-size: 70% !important;padding: 5px 5px 10px 5px !important;"></i>Idle Time</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-report-5" style="font-size: 70% !important;padding: 5px 5px 10px 5px !important;"></i>Utility</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-report-6" style="font-size: 70% !important;padding: 5px 5px 10px 5px !important;"></i>Result</a></li>
                </ul>
                <div class="tab-content">
                    <div id="tab-report-1" class="tab-pane active">
                        <div class="full-height-scroll">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="id_report_1">

                                </table>
                            </div>
                        </div>
                    </div>


                    <div id="tab-report-2" class="tab-pane">
                        <div class="full-height-scroll">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="id_report_2">
                                    
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="tab-report-3" class="tab-pane">
                        <div class="full-height-scroll">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="id_report_3">
                                    
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="tab-report-4" class="tab-pane">
                        <div class="full-height-scroll">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="id_report_4">
                                    
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="tab-report-5" class="tab-pane">
                        <div class="full-height-scroll">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="id_report_5">
                                    
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="tab-report-6" class="tab-pane">
                        <div class="full-height-scroll">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="id_report_6">

                                </table>
                            </div>
                        </div>
                    </div>

                </div>

                </div>
            </div>
        </div>
      </div>

      <!-- End Tab Shift -->
      <!-- MODAL FOR INPUT CODE BASED ON RANGE TIME -->
      <div class="modal" id="modalRangeInput">
        <div class="modal-dialog">
          <div class="modal-content">
                
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title" id="header_modal_range"></h4>
            </div>
                
            <!-- Modal body -->
            <div class="modal-body form-group">
              <input type="hidden" id="idLBRange" name="idLBRange" readonly=""> 
              <input type="hidden" id="shiftRange" name="shiftRange" readonly=""> 
              <label for="">From</label>
              <input type='text' name="startTime" id='startTime' value="" class="form-control" /><br>
              <label for="">To</label>
              <input type='text' name="endTime" id='endTime' value="" class="form-control" /><br>
              <label for="">Downtime Lists</label>
              <select name="" id="id_down_range" class='form-control'>
                <option value=''></option>
                <?php
                  $dtOpt = '';
                  foreach ($dtGroup as $dtGroup2) {
                    $dtOpt .= "<option value='$dtGroup2->id'>($dtGroup2->downtimeCode) $dtGroup2->downtimeName</option>";
                  }
                  echo $dtOpt;
                ?>
              </select><br>
              <label for="">Technician</label>
              <input type="text" id="technicianRange" name="technicianRange" class='form-control'> 
            </div>
                
            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" onclick="closeModalRange()">Close</button>
              <button type="button" class="btn btn-success" onclick="updateDTRange()">Save</button>
            </div>
                
          </div>
        </div>
      </div>

      <!-- MODAL FOR INPUT CODE PER TIME -->
      <div class="modal" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">
                
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title" id="header_modal"></h4>
            </div>
                
            <!-- Modal body -->
            <div class="modal-body form-group">
              <input type="hidden" id="idLb" name="idLb" readonly=""> 
              <input type="hidden" id="shift" name="shift" readonly=""> 
              <input type="hidden" id="id_det_time" name="id_det_time" readonly=""> 
              <label for="">Downtime Lists</label>
              <select name="" id="id_down" class='form-control'>
                <option value=''></option>
                <?php
                  $dtOpt = '';
                  foreach ($dtGroup as $dtGroup) {
                    $dtOpt .= "<option value='$dtGroup->id'>($dtGroup->downtimeCode) $dtGroup->downtimeName</option>";
                  }
                  echo $dtOpt;
                ?>
              </select><br>
              <label for="">Technician</label>
              <input type="text" id="technician" name="technician" class='form-control'> 
            </div>
                
            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" onclick="close_modal()">Close</button>
              <button type="button" class="btn btn-success" onclick="update_time()">Save</button>
            </div>
                
          </div>
        </div>
      </div>

      <!-- MODAL FOR INPUT OPERATORE -->
      <div class="modal" id="modalProduct">
        <div class="modal-dialog">
          <div class="modal-content">
                
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title" id="header_modal_pr"></h4>
            </div>
                
            <!-- Modal body -->
            <div class="modal-body form-group">
              <label>Product</label>
              <input type="hidden" id="id_lb_pr" name="id_lb_pr" readonly=""> 
              <select name="idProduct" id="idProduct" class='form-control'>
                <option value=''></option>
              </select><br>
              <label>Batch</label>
              <input class='form-control' type="text" id="productBatch" name="productBatch"> <br>
              <label>Good (Box)</label>
              <input class='form-control' type="text" id="productGood" name="productGood"> <br>
              <label>Reject(Tablet)</label>
              <input class='form-control' type="text" id="productReject" name="productReject"> <br>
            </div>
                
            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" onclick="closeModalProduct()">Close</button>
              <button type="button" class="btn btn-success" onclick="addProduct()">Save</button>
            </div>
                
          </div>
        </div>
      </div>

      <!-- MODAL FOR INPUT OPERATORE -->
      <div class="modal" id="Modal_operator">
        <div class="modal-dialog">
          <div class="modal-content">
                
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title" id="header_modal_op"></h4>
            </div>
                
            <!-- Modal body -->
            <div class="modal-body form-group">
              <input type="hidden" id="id_lb_op" name="id_lb_op" readonly=""> 
              <select name="" id="id_op" class='form-control'>
                <option value=''></option>
              </select>
            </div>
                
            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" onclick="close_modal_op()">Close</button>
              <button type="button" class="btn btn-success" onclick="tambah_op()">Save</button>
            </div>
                
          </div>
        </div>
      </div>
      
      <!-- Tab Legend Code -->
      <!-- <div class="col-md-6">
        <div class="wrapper">
          <div class="tabs2">
            <?php
              for ($i=0; $i < 5; $i++) { 
                $tab = 'tab2-'.$i;
                $dtGroup = "dtGroup".$i; 
                if($i == 0 ) {$dtName = "Run Time";}
                if($i == 1 ) {$dtName = "Planned Down Time";}
                if($i == 2 ) {$dtName = "Unplanned Down Time";}
                if($i == 3 ) {$dtName = "Idle Time";}
                if($i == 4 ) {$dtName = "Utility";}
            ?>
            <div class="tab2">
              <input type="radio" name="css-tabs2" id=<?php echo $tab; ?> checked class="tab-switch2">
              <label for=<?php echo $tab; ?> class="tab-label2" style="font-weight:bold;font-size:12px;padding-left:5px;padding-right:5px;"><?php echo $dtName ?></label>
              <div class="tab-content2">
                <table>
                  <tr>
                    <th rowspan="2">Legend Code</th>
                    <th colspan="3">Shift</th>
                  </tr>
                  <tr>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                  </tr>
                  <?php
                    $listDt = $$dtGroup;
                    $list   = "list".$i;
                    $alfa   = range('a', 'z');
                    $a = 0;
                    $no = $i+1;
                    $group = '';
                    foreach ($listDt as $list) {  
                      if($i == 0) {
                        $group .= "
                          <tr>
                            <td class='lgcd'><strong>$no. $list->downtimeName</strong></td>
                        ";
                        $group .= "
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                          </tr>
                        ";
                      }else{
                        if($a == 0){
                          $group .= "
                            <tr>
                              <td class='lgcd'><strong>$no. $dtName</strong></td>
                          ";
                          $group .= "
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                          ";
                        }

                        $group .= "
                          <tr>
                            <td class='lgcd'><strong>$alfa[$a]. $list->downtimeName</strong></td>
                        ";
                        $group .= "
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                          </tr>
                        ";
                      }
                      $a++;
                    }
                    echo $group;
                    ?>
                  <tr>
                    <td style='text-align:right;'>SUB TOTAL :</td>
                    <td><strong>0</strong></td>
                    <td><strong>0</strong></td>
                    <td><strong>0</strong></td>
                  </tr>
                </table>
              </div>
            </div>
            <?php } ?>
            <div class="tab2">
              <input type="radio" name="css-tabs2" id="tab2-5" class="tab-switch2">
              <label for="tab2-5" class="tab-label2" style="font-weight:bold;font-size:12px;padding-left:5px;padding-right:5px;">Result</label>
              <div class="tab-content2">
                <table class="rslt">
                  <tr>
                    <th rowspan="2" class="rslt">Shift</th>
                    <th rowspan="2" class="rslt">Produk</th>
                    <th rowspan="2" class="rslt">No. Batch</th>
                    <th colspan="2" class="rslt">Jumlah Tablet</th>
                  </tr>
                  <tr>
                    <th class="rslt">Baik(Box)</th>
                    <th class="rslt">Reject(Tablet)</th>
                  </tr>
                  <tr>
                    <td class="rslt">1</td>
                    <td class="rslt">Vitacimin 100T</td>
                    <td class="rslt">11712546</td>
                    <td class="rslt">920</td>
                    <td class="rslt">160</td>
                  </tr>
                  <tr>
                    <td class="rslt">1</td>
                    <td class="rslt">Vitacimin 100T</td>
                    <td class="rslt">11712546</td>
                    <td class="rslt">920</td>
                    <td class="rslt">160</td>
                  </tr>
                  <tr>
                    <td class="rslt">1</td>
                    <td class="rslt">Vitacimin 100T</td>
                    <td class="rslt">11712546</td>
                    <td class="rslt">920</td>
                    <td class="rslt">160</td>
                  </tr>
                </table>
              </div>
            </div>

          </div>
        </div>
      </div> -->
      <!-- End Tab Legend Code -->
    </div>
  </div>
</div>