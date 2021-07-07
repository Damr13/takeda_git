<div class="main-content">
  <div class="container-fluid">
    <!-- HEADER FOR TITLE --ir -->
    <div class="page-header" style="margin-bottom:10px;">
      <div class="row align-items-end">
        <div class="col-lg-12">
          <div class="page-header-title" style="text-align: center;">
            <!-- <i class="ik ik-file-text bg-blue"></i> -->
            <div class="d-inline">
              <h5>OEE MACHINE<div id="bulan_name"></div> </h5>
              <span></span>
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
              <label for="month">Bulan : </label>
              <input id="bulan" name="bulan" readonly="" class="form-control"> 
          </div>
        </div>
        <div class="col-lg-2">
          <div>
              <div class='form-group' style='width:100% !important'>
                <label class='font-noraml' style='font-weight:bold'>Mesin :</label>
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
        <div class="col-lg-2">
          <div class='form-group' style='width:100% !important'>
              <button id="btn_cari" class='btn btn-success btn-lg' onclick="cari_by_bulan()">Search <i class='ik ik-search'></i></button>
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

              <div id="div_tabel_rptResume" class="table-scroll table-responsive">
              <div class="table-wrap">
                <table class="main-table table table-striped table-bordered table-hover">
                  <thead id="t_head">
                    <tr>
                      <th scope="col" class="fixed-side"><b>NO</b></th>
                      <th scope="col" class="fixed-side"><b>KATEGORI</b></th>
                      <th scope="col" class="fixed-side"><b>SATUAN</b></th>
                      <th scope="col" class="fixed-side" scope="col"><b>KALKULASI</b></th>

                      <?php for ($i=1; $i <= 31; $i++) {  ?>

                      <th colspan="3"><center><b><?php echo $i ?></b></center></th>  

                      <?php } ?>

                      <th scope="col" rowspan="2"><center><b>TOTAL</b></center></th>
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
        <div class="col-md-1" style="background-color: green;"><center><b style="color: black;">Excellent</b></center></div>
        <div class="col-md-1" style="background-color: yellow;"><center><b style="color: black;">Good</b></center></div>
        <div class="col-md-1" style="background-color: red;"><center><b style="color: black;">Not Good</b></center></div>
      </div>    
    </div>
  </div>
</div>