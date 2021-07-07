<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<body>
  <!--[if lt IE 8]>
      <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->

  <div class="main-content" style="padding-left:15px; margin-top:0px;">
      <div class="container-fluid">
        <!-- SELECT PERIODE AND RANGE DATE FOR PRODUCTIONS, OEE AND MACHINE AVAILABILITY --ir  -->
        <div class="row" style="display:none">
          <div class="col-lg-6 col-md-12 col-sm-12">
            <label class='font-noraml' style='font-weight:bold; display:none;'>Periode :</label>
            <div class='input-group'>
              <select class='select2_demo_1 form-control' id='periodeProd' onchange='changePeriodeProd("periode")'>
                <option value='year' selected>Yearly</option>
                <option value='month'>Monthly</option>
                <option value='week'>Weekly</option>
              </select>
            </div>
          </div>
          <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="row clearfix">
              <div class="col-lg-4 col-md-4 col-sm-12">
                <label class='font-noraml' style='font-weight:bold'>Start Date :</label>
                <div class='input-group'>
                  <input id="dateStart" name="date" readonly="" class="form-control"> 
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-12">
                <label class='font-noraml' style='font-weight:bold'>Finish Date :</label>
                <div class='input-group'>
                  <input id="dateFinish" name="date" readonly="" class="form-control"> 
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-12">
                <label class='font-noraml' style='font-weight:bold'>&nbsp;</label>
                <div class='input-group'>
                  <button class="btn btn-primary btn-rounded btn-block" onclick="changeDateProd()">Submit</button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- CARD FOR PRODUCTIONS, OEE AND MACHINE AVAILABILITY --ir -->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">

                <div class="row">
                  
                  <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="widget">
                      <div class="widget-body">
                        <div class="row">
                          <div class="d-flex justify-content-between align-items-center">
                            <div class="state col-md-8">
                              <h6>Visitor Today</h6>
                              <?php
                              foreach ($visitor as $r); ?>
                              <h2>
                                <?php echo $r->vstr;?>
                              </h2>
                              <?php ?>
                              <span>&nbsp;</span>
                            </div>
                            <div class="img-visit col-md-4">
                              <img src="assets/img/visitors.png" style="max-width:50%;float:right">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="<?php echo $bar_p_good ?>" aria-valuemin="0" aria-valuemax="<?php echo $bar_tt_prd ?>" style="width: 78%;"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="widget">
                      <div class="widget-body">
                        <div class="row">
                          <div class="d-flex justify-content-between align-items-center">
                            <div class="state col-md-8">
                              <h6>Contractor Today</h6>
                              <?php
                              foreach ($contractor as $r); ?>
                              <h2>
                                <?php echo $r->con; ?>
                              </h2>
                              <?php ?>
                              <span>&nbsp;</span>
                            </div>
                            <div class="img-visit col-md-4">
                              <img src="assets/img/construction-worker.png" style="max-width:50%;float:right">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="<?php echo $bar_p_good ?>" aria-valuemin="0" aria-valuemax="<?php echo $bar_tt_prd ?>" style="width: 78%;"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="widget">
                      <div class="widget-body">
                        <div class="row">
                          <div class="d-flex justify-content-between align-items-center">
                            <div class="state col-md-8">
                              <h6>Employee Today</h6><?php
                              foreach ($employee as $r); ?>
                              <h2>
                                <?php echo $r->emp; ?>
                              </h2>
                              <?php ?>
                              <span>&nbsp;</span>
                            </div>
                            <div class="img-visit col-md-4">
                              <img src="assets/img/workers.png" style="max-width:50%;float:right">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="<?php echo $bar_p_reject ?>" aria-valuemin="0" aria-valuemax="<?php echo $bar_tt_prd ?>" style="width: 31%;"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="widget">
                      <div class="widget-body">
                        <div class="row">
                          <div class="d-flex justify-content-between align-items-center">
                            <div class="state col-md-8">
                              <h6>Outsourcing Today</h6>
                              <?php
                              foreach ($outsourcing as $r); ?>
                              <h2>
                                <?php echo $r->outs; ?>
                              </h2>
                              <?php ?>
                              <span>&nbsp;</span>
                            </div>
                            <div class="img-visit col-md-4">
                              <img src="assets/img/outsourcing.png" style="max-width:50%;float:right">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"></div>
                      </div>
                    </div>
                  </div>
                </div>

                
              </div>
            </div>
          </div>
        </div>

        <!-- SELECT PERIODE AND RANGE DATE FOR PM, CAL, CONSUMPTIONS AND CAPA --ir  -->
        <div class="row">
          <div class="col-lg-6 col-md-12 col-sm-12" style="display:none;">
            <label class='font-noraml' style='font-weight:bold; display:none;'>Periode :</label>
            <div class='input-group'>
              <select class='select2_demo_1 form-control' id='periodeProd2' onchange='changePeriodeProd2()'>
                <option value='year' selected>Yearly</option>
                <option value='month'>Monthly</option>
              </select>
            </div>
          </div>
          <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="row clearfix">
              <div class="col-lg-4 col-md-4 col-sm-12">
                <label class='font-noraml' style='font-weight:bold'>Start Date :</label>
                <div class='input-group'>
                  <input id="dateStart2" name="date" readonly="" class="form-control"> 
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-12">
                <label class='font-noraml' style='font-weight:bold'>Finish Date :</label>
                <div class='input-group'>
                  <input id="dateFinish2" name="date" readonly="" class="form-control"> 
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-12">
                <label class='font-noraml' style='font-weight:bold'>&nbsp;</label>
                <div class='input-group'>
                  <button class="btn btn-primary btn-rounded btn-block" onchange="changeDateProd2()">Submit</button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- CARD FOR PM, CAL, CONSUMPTIONS AND CAPA --ir -->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">

                <div class="row">
                  
                  <div class="col-md-3" id="cardPieTamu">
                    <div class="card">
                      <div class="card-header">
                        <h3>Visitor</h3>
                      </div>
                      <div class="card-block text-center">
                        <div id="c3-donut-chart_Tamu" style="height:400px"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3" id="cardPieContractor">
                    <div class="card">
                      <div class="card-header">
                        <h3>Contractor</h3>
                      </div>
                      <div class="card-block text-center">
                        <div id="c3-donut-chart_Contractor" style="height:400px"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3" id="cardPieKaryawan">
                    <div class="card">
                      <div class="card-header">
                        <h3>Employee</h3>
                      </div>
                      <div class="card-block text-center">
                        <div id="c3-donut-chart_Karyawan"style="height:400px"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3" id="cardPieOutsourcing">
                    <div class="card">
                      <div class="card-header">
                        <h3>Outsourcing</h3>
                      </div>
                      <div class="card-block text-center">
                        <div id="c3-donut-chart_Outsourcing"style="height:400px"></div>
                      </div>
                    </div>
                  </div>
                  
                </div>

                <div class="row">
                  
                  <div class="col-md-12">
                    <div class="card">
                      <div class="card-header">
                        <h3>Judgement</h3>
                      </div>
                      <div class="card-block text-center">
                        <!-- <div id="capa_chart" class="chart-shadow" style="height:400px"></div> -->
                        <div id="judgement" class="chart-shadow" style="height:400px"></div>
                      </div>
                    </div>
                  </div>
                  
                </div>    
              </div>
            </div>
          </div>
        </div>

        

      <div class="modal" id="modalDetail">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title"></h4>
            </div>

            <!-- Modal body -->
            <div class="modal-body form-group">
              <table class="main-table table table-striped table-bordered table-hover"></table>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" onclick="close_modal()">Close</button>
            </div>

          </div>
        </div>
      </div>

      </div>
  </div>