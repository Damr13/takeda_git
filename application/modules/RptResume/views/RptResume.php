<div class="main-content">
  <div class="container-fluid">
    <!-- HEADER FOR TITLE --ir -->
    <div class="page-header" style="margin-bottom:10px;">
      <div class="row align-items-end">
        <div class="col-lg-12">
          <div class="page-header-title" style="text-align: center;">
            <!-- <i class="ik ik-file-text bg-blue"></i> -->
            <div class="d-inline">
              <h5>REPORT RESUME <div id="bulan_name"></div> </h5>
              <!-- <span>LOGBOOK Primary Packaging LINE SIEBLER</span> -->
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
        <div class="col-lg-3">
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
        <div class="col-lg-3">
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
              <div id="div_tabel_rptResume" class="table-scroll table-responsive">
              <div class="table-wrap">
                <table class="main-table table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <th scope="col" class="fixed-side" scope="col" rowspan="2"><center><b>LEGEND CODE</b></center></th>
                      <th scope="col" colspan="31"><center><b>TANGGAL</b></center></th>
                      <th scope="col" rowspan="2"><b>TOTAL MINUTES</b></th>
                    </tr>
                    <tr> 
                        <th><b>1</b></th> <th><b>2</b></th> <th><b>3</b></th> <th><b>4</b></th> <th><b>5</b></th>
                        <th><b>6</b></th> <th><b>7</b></th> <th><b>8</b></th> <th><b>9</b></th> <th><b>10</b></th>
                        <th><b>11</b></th> <th><b>12</b></th> <th><b>13</b></th> <th><b>14</b></th> <th><b>15</b></th>
                        <th><b>16</b></th> <th><b>17</b></th> <th><b>18</b></th> <th><b>19</b></th> <th><b>20</b></th>
                        <th><b>21</b></th> <th><b>22</b></th> <th><b>23</b></th> <th><b>24</b></th> <th><b>25</b></th>
                        <th><b>26</b></th> <th><b>27</b></th> <th><b>28</b></th> <th><b>29</b></th> <th><b>30</b></th> 
                        <th><b>31</b></th> 
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
</div>