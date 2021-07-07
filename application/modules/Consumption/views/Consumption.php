<div class="main-content">
  <div class="container-fluid">
    <!-- HEADER FOR TITLE --ir -->
    <div class="page-header" style="margin-bottom:10px;">
      <div class="row align-items-end">
        <div class="col-lg-12">
          <div class="page-header-title" style="text-align: center;">
            <!-- <i class="ik ik-file-text bg-blue"></i> -->
            <div class="d-inline">
              <h5 id="title">CONSUMPTION </h5><h5><div id="tahun_name"></div> </h5>
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
                <label class='font-noraml' style='font-weight:bold'>Type :</label>
                <div class='input-group'>
                  <select class='select2_demo_1 form-control' id='type'>
                      <option value='CONS_CAR'>CONS FUEL</option>
                      <option value='CONS_WATER'>CONS WATER</option>
                      <option value='CONS_ELECTRICITY'>CONS ELECTRICITY</option>
                  </select>
                </div>
              </div>
          </div>
        </div>
        <div class="col-lg-2 pull-left">
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
                      <th scope="col" class="fixed-side" scope="col"><center><b>Info</b></center></th>
                      <th><center><b>Apr</b></center></th> <th><center><b>May</b></center></th> <th><center><b>Jun</b></center></th> 
                      <th><center><b>Jul</b></center></th> <th><center><b>Aug</b></center></th><th><center><b>Sep</b></center></th> 
                      <th><center><b>Oct</b></center></th> <th><center><b>Nov</b></center></th> <th><center><b>Des</b></center></th> 
                      <th><center><b>Jan</b></center></th><th><center><b>Feb</b></center></th> <th><center><b>Mar</b></center></th>
                      <th scope="col"><b>TOTAL</b></th>
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
        <div class="page-header" style="margin-bottom:10px;">
          <div class="row align-items-end">
            <div class="col-lg-12">
              <div class="page-header-title" style="text-align: center;">
                <!-- <i class="ik ik-file-text bg-blue"></i> -->
                <div class="d-inline">
                  <h5 id="titleChart"></h5>
                  <hr />
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
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
        <input type="hidden" id="month_det" name="month_det" readonly="" class="form-control"> 

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