<div class="main-content">
  <div class="container-fluid">
    <!-- HEADER FOR TITLE --ir -->
    <div class="page-header" style="margin-bottom:10px;">
      <div class="row align-items-end">
        <div class="col-lg-12">
          <div class="page-header-title" style="text-align: center;">
            <!-- <i class="ik ik-file-text bg-blue"></i> -->
            <div class="d-inline">
              <h5>DEPARTEMEN PRODUKSI - STRIPPING - September 2019 </h5>
              <span>LOGBOOK Primary Packaging LINE SIEBLER</span>
              <hr />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <!-- HEADER FOR DATE, MACHINE, AND SPEED TAB --ir -->
      <div class="col-lg-12 row align-items-end" style="margin-bottom:10px;">
        <div class="col-lg-4">
          <form action="">
              <label for="date">Tanggal : </label>
              <!-- <input type="datetime-local" id="date" name="date"> -->
              <input id="date_1" name="date" readonly=""> 
          </form>
        </div>
        <div class="col-lg-4">
          <h5 style="font-size: 15px;">Mesin : Striping Siebler</h5>
        </div>
        <div class="col-lg-4">
          <h5 style="font-size: 15px;">Speed (tab/mnt) : 1000 tablet/menit ~ 250 rpm</h5>
        </div>
      </div>
      <!-- LOOGBOOK --ir -->
      <div class="col-md-6">
        <div class="wrapper">
          <div class="tabs" id="tabs">
          <?php
            $tab = '';
            $i = 1;
            foreach ($shiftLists as $shiftLists) { 
              // TAB SHIFTS --ir -->
              $idTab      = 'tab-'.$i;
              $shift      = "Shift ".$i;
              $tab .= "
              <div class='tab'>
                <input type='radio' name='css-tabs' id='$idTab' checked class='tab-switch'>
                <label for='$idTab' class='tab-label' style='font-weight:bold'>$shift</label>
                <div class='tab-content'>
                  <div class='container-fluid'>
              ";
              // INITIATE DATA LOGBOOKS BY SHIFT --ir 
              $logbook        = "logbook".$i;
              $logbook       = $$logbook;

              // INITIATE PIC NAME, ROLE, ID AND CLASS --ir
              $role       = 'shift-ld'.$i.'[]';
              $role1      = 'shift-ld'.$i;
              $roleShift  = "Leader";
              $namePic = ''; $operator='';
              if(isset($logbook)){$namePic = $logbook->leader; $operator = $logbook->operator;}
              
              // SELECT OPERATOR AND LEADER --ir-->
              for ($l=0; $l < 2; $l++) { 
                if($l==1) {$role = 'shift-op'.$i.'[]'; $role1 = 'shift-op'.$i; $roleShift = "Operator"; $namePic = $operator;}
                $tab .= "
                    <div class='row'>
                      <div class='col-md-4'>
                        <label for='$role1' style='font-weight:bold;font-size: 15px;'>$roleShift $shift:</label>
                      </div>
                      <div class='col-md-5'>
                        <div class='form-group'>
                          <select id='$role1' name='$role' class='form-control' multiple='multiple'>
                            <option value=''></option>
                ";
                
                foreach ($pic as $picLists) {
                  $rolePic  = $picLists->role;
                  // GET VALUE OPTION BASED ON ROLE --ir
                  if($rolePic == $roleShift){
                    // SET SELECTED LEADER OR OPERATOR ON OPTION --ir
                    $selected = 'selected';
                    if($namePic != $picLists->name) {$selected = "";}
                    $tab .= "
                            <option value='$picLists->name' $selected>$picLists->name</option>
                    ";
                  }else continue;
                }

                $tab .= "
                          </select>
                        </div>
                      </div>
                      <div class='col-md-3'>
                        <button class='lock-shft' style='width:100%;color: white;font-weight: bold;background-color: #404E68;'>LOCK <i class='ik ik-lock'></i></button>
                      </div>
                    </div>
                ";
              }

              //  FORM LOGBOOK -->
              $tab .= "
                  </div>
                  <div>
                    <input type='hidden' name='".$shiftLists->codeShift."' id='".$shiftLists->codeShift."' value='".$shiftLists->codeShift."'>
                  </div>
                  <div class='grid-container' id='grid_".$shiftLists->codeShift."'>
                    <div class='activity' style='background-color: #404E67;color: white;'>Activity Shift $i</div>
              ";

              // CHOOSE WHICH TIME LIST TO SET UP--ir
              // FROM MASTER SHIFT --ir
              if(empty($logbook)){
                // INITIATE START AND END TIME SHIFT FROM MASTER SHIFT --ir
                $startTimeShift = $shiftLists->startShift;
                $endTimeShift   = date("H:i", strtotime($shiftLists->endShift));
  
                // GET HOUR AND MINUTES --ir
                $hour           = date("H", strtotime($startTimeShift));
                $minutes        = date("i", strtotime($startTimeShift));
                $time           = $hour.":".$minutes;
                $code           = "1";
                $empty          = "yes"; 
              // FROM LOGBOOKS --ir
              }else{
                // CONVERT LOG DATA FROM MASTER INTO ARRAY
                $list   = explode(", ",$logbook->log);
                $count	= count($list);

                // INITIATE START AND END TIME SHIFT FROM MASTER SHIFT --ir
                $startTimeShift = $list[0];
                $endTimeShift   = $list[($count-3)];
                $time           = $startTimeShift;
                $code           = $list[1];
                $timeCount      = 0;
                $codeCount      = 1;
                $empty          = "no"; 
              }

              // LOOP THE TIME --ir
              for ($j=0; $j < 4; $j++) { 
                $tab .= "
                      <table>
                        <tr>
                          <th style='background-color: #404E67;color: white;'>Time</th>
                          <th style='background-color: #404E67;color: white;'>Code</th>
                        </tr>
                ";
                for ($k=0; $k < 24; $k++) {
                  $tab .= "
                        <tr>
                          <td>$time</td>
                          <td class='tdModal'>
                            <button type='button' class='btnModal' id='$time' data-toggle='modal' data-target='#myModal'>
                              $code
                            </button>
                          </td>
                        </tr>
                  ";
                  // IF TIME MEET END TIME SHIFT, THEN END IT --ir
                  if($endTimeShift == $time) {$tab .= "</table>"; break 2;};

                  // IF TIME STAMP IS OBTAINED FROM MASTER SHIFT THEN CALCULATE BY ADDING THE MINUTES --ir 
                  if($empty == "yes"){
                    $minutes    = date('i', strtotime("+5 minutes", strtotime($time)));
                    if($minutes == 00) {
                      $hour     = date('H', strtotime("+1 hour", strtotime($time))); 
                      $minutes  = date("i",strtotime($hour.":00"));
                    };
                    $time = $hour.":".$minutes;
                  // IF TIME STAMP IS OBTAINED FROM LOGBOOKS DATA THEN CALCULATE BY THROUGH TO THE ARRAY --ir 
                  }else{
                    $timeCount = $timeCount + 2;
                    $codeCount = $codeCount + 2;
                    $time      = $list[$timeCount];
                    $code      = $list[$codeCount];
                  }
                }
                
                $tab .= "
                      </table>  
                ";
              }


              $tab .= "
                  </div>
                </div>
              </div>";
              $i++;
            }
            echo $tab;
          ?>
          </div>
        </div>
      </div>
      <!-- End Tab Shift -->

      <div class="modal" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">
                
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Modal Heading</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
                
            <!-- Modal body -->
            <div class="modal-body form-group">
              <select name="" id="select2" class='form-control'>
                <option value=''></option>
                <?php
                  $dtOpt = '';
                  foreach ($dtGroup as $dtGroup) {
                    $dtOpt .= "<option value='$dtGroup->downtimeCode'>($dtGroup->downtimeCode) $dtGroup->downtimeName</option>";
                  }
                  echo $dtOpt;
                ?>
              </select>
            </div>
                
            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
                
          </div>
        </div>
      </div>
      
      <!-- Tab Legend Code -->
      <div class="col-md-6">
        <div class="wrapper">
          <div class="tabs2">
            <!-- Run Mesin -->
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
            <!-- End Run Mesin -->
            <!-- RESULT -->
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
                    <th class="rslt">Baik</th>
                    <th class="rslt">Reject</th>
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
            <!-- END RESULT -->
          </div>
        </div>
      </div>
      <!-- End Tab Legend Code -->
    </div>
  </div>
</div>