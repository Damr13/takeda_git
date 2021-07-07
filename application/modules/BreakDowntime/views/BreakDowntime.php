<div class="main-content">
  <div class="container-fluid">
    <!-- HEADER FOR TITLE --ir -->
    <div class="page-header" style="margin-bottom:10px;">
      <div class="row align-items-end">
        <div class="col-lg-12">
          <div class="page-header-title" style="text-align: center;">
            <!-- <i class="ik ik-file-text bg-blue"></i> -->
            <div class="d-inline">
              <h5>DOWNTIME CATEGORY <div id="tahun_name"></div> </h5>
              <hr />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <!-- HEADER FOR DATE, MACHINE, AND SPEED TAB --ir -->
      <div class="col-lg-12 row align-items-end" style="margin-bottom:10px;">
        <div class="col-lg-2">
          <div class='form-group' style='width:100% !important'>
              <label for="month">Year : </label>
              <input id="tahun" name="tahun" readonly="" class="form-control"> 
          </div>
        </div>
        <div class="col-lg-3">
          <div>
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
        </div>
        <div class="col-lg-3">
          <div>
              <div class='form-group' style='width:100% !important'>
                <label class='font-noraml' style='font-weight:bold'>Downtime :</label>
                <div class='input-group'>
                  <select class='select2_demo_1 form-control' id='group_downtime'>
                      <option value='PDT'>Planned Down Time</option>
                      <option value='UDT'>Unplanned Down Time</option>
                      <option value='IT'>Idle Time</option>
                      <option value='UT'>Utility</option>
                  </select>
                </div>
              </div>
          </div>
        </div>
        <div class="col-lg-2">
          <div class='form-group' style='width:100% !important'>
              <button id="btn_cari" class='btn btn-success btn-lg' onclick="cari()">Search <i class='ik ik-search'></i></button>
              <div class="spinner-border" role="status" style="display: none" id="spinner">
                <span class="sr-only">Loading...</span>
            </div>
          </div>        
        </div>
        <div class="col-lg-2">
          <div class='form-group' style='width:100% !important'>
              <button class='btn btn-success btn-lg' onclick="d_excel()"><i class='fa fa-file-excel-o'></i></button>
              <button class='btn btn-danger btn-lg' onclick="d_pdf()"><i class='fa fa-file-pdf-o'></i></button>
          </div>        
        </div>
      </div>
      
      <div class="col-md-12">
        <div class="card">
          <div class="content">

            <div class="table-scroll table-responsive">
              <div class="table-wrap">
                <table class="main-table table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <th scope="col" class="fixed-side" scope="col"><center><b>Downtime</b></center></th>
                      <th><center><b>1</b></center></th> <th><center><b>2</b></center></th> <th><center><b>3</b></center></th> 
                      <th><center><b>4</b></center></th> <th><center><b>5</b></center></th><th><center><b>6</b></center></th> 
                      <th><center><b>7</b></center></th> <th><center><b>8</b></center></th> <th><center><b>9</b></center></th> 
                      <th><center><b>10</b></center></th><th><center><b>11</b></center></th> <th><center><b>12</b></center></th>
                      <th scope="col"><b>TOTAL HOUR</b></th>
                    </tr>
                  </thead>
                  <tbody id="t_body">
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>    
      <div class="col-md-12">
          <div class="card">
              <div class="card-header">
                  <h3 id="id_jdl"></h3>
              </div>
              <div class="card-block text-center">
                  <!-- <div id="bar_chart" class="chart-shadow" style="height:400px"></div> -->
                  <div id="capa_chart" class="chart-shadow" style="height:400px"></div>
              </div>
          </div>
      </div>

    </div>
  </div>
</div>