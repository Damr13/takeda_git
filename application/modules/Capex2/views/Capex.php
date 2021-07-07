<div class="main-content">
  <div class="container-fluid">
    <!-- HEADER FOR TITLE --ir -->
    <div class="page-header" style="margin-bottom:10px;">
      <div class="row align-items-end">
        <div class="col-lg-12">
          <div class="page-header-title" style="text-align: center;">
            <!-- <i class="ik ik-file-text bg-blue"></i> -->
            <div class="d-inline">
              <h5>Capex In Million IDR <div id="tahun_name"></div> </h5>
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
              <label for="month">Tahun : </label>
              <input id="tahun" name="tahun" readonly="" class="form-control"> 
          </div>
        </div>
        <div class="col-lg-2">
            <div class='form-group' style='width:100% !important'>
              <label class='font-noraml' style='font-weight:bold'>Compare :</label>
              <div class='input-group'>
                <select class='select2_demo_1 form-control' id='compare'>
                    <option value='plan'>PLAN</option>
                    <option value='myc'>MYC</option>
                    <option value='leb'>LBE</option>
                </select>
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

        <div class="col-lg-2"></div>

        <div class="col-lg-2" style="display: none;" id="div_fyb">
          <div class='form-group' style='width:100% !important'>
              <label for="month">Full Year Budget : </label>
              <input id="fyb" name="fyb" class="form-control" onkeypress="return hanyaAngka(event)"> 
          </div>
        </div>
        <div class="col-lg-2 pull-left" style="display: none;" id="div_btn_upd">
          <div class='form-group' style='width:100% !important'>
              <button id="btn_upd" class='btn btn-danger btn-lg' onclick="upd_fyb()">Update FYB <i class='ik ik-search'></i></button>
              <div class="spinner-border" role="status" style="display: none" id="spinner_upd">
                <span class="sr-only">Loading...</span>
            </div>
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
                      <th rowspan="2" class="align-middle"><center><b>Period</b></center></th>
                      <th colspan="3"><center><b>Month to Date</b></center></th>
                      <th colspan="3"><center><b>Year to Date</b></center></th>
                      <th rowspan="2" class="align-middle"><center><b>Full Year Budget</b></center></th>
                      <th rowspan="2" class="align-middle"><center><b>Remaining <br/>Budget</b></center></th>
                      <th rowspan="2" class="align-middle"><center><b>Run Rate for <br/>Next year to go</b></center></th>
                      <th rowspan="2" class="align-middle"><center><b></b></center></th>
                    </tr>
                    <tr>
                      <th><center><b id="th_compare"></b></center></th>
                      <th><center><b>Actual</b></center></th>
                      <th><center><b>Variance</b></center></th>
                      <th><center><b id="th_compare_ytd"></b></center></th>
                      <th><center><b>Actual</b></center></th>
                      <th><center><b>Variance</b></center></th>
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
                  <!-- <h3>OEE FY<?php echo $tahun; ?></h3> -->
              </div>
              <div class="card-block text-center">
                  <div id="line_chart" class="chart-shadow" style="height:400px"></div>
              </div>
          </div>
      </div>   

    </div>
  </div>
</div>

<div class="modal" id="Modal_update">
  <div class="modal-dialog">
    <div class="modal-content">
          
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title" id="header_modal_op"></h4>
      </div>
          
      <!-- Modal body -->
      <div class="modal-body form-group">
        <input type="hidden" id="id_det" name="id_det" readonly="" class="form-control"> 
        <input type="hidden" id="f_det" name="f_det" readonly="" class="form-control">

        <label for="month">Value : </label>
        <input type="text" id="val_det" name="val_det" class="form-control" onkeypress="return hanyaAngka(event)"> 
      </div>
          
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" onclick="close_modal()">Close</button>
        <button type="button" class="btn btn-success" onclick="update()">Save</button>
      </div>
          
    </div>
  </div>
</div>