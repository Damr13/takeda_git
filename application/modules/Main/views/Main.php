<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<body>
  <!--[if lt IE 8]>
      <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->

  <div class="main-content">
      <div class="container-fluid">
        <!-- SELECT PERIODE AND RANGE DATE FOR PRODUCTIONS, OEE AND MACHINE AVAILABILITY --ir  -->
        <div class="row">
          <div class="col-lg-6 col-md-12 col-sm-12">
            <label class='font-noraml' style='font-weight:bold'>Periode :</label>
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
                        <div class="d-flex justify-content-between align-items-center">
                          <div class="state">
                            <h6>Total Production(Tablet)</h6>
                            <h2 id="tt_prd"><?php echo $tt_prd." (".$percentageTarget."%)"; ?></h2>
                            <span id="target"><?php echo " (Target Production : ".$target.")" ?></span>
                          </div>
                          <div class="icon">
                            <i class="ik ik-award"></i>
                          </div>
                        </div>
                        <small class="text-small mt-10 d-block" id="note"><?php echo $note?></small>
                      </div>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-info" role="progressbar" aria-valuenow="<?php echo $bar_tt_prd ?>" aria-valuemin="0" aria-valuemax="<?php echo $bar_target ?>" style="width: 62%;"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="widget">
                      <div class="widget-body">
                        <div class="d-flex justify-content-between align-items-center">
                          <div class="state">
                            <h6>Finish Good(Tablet)</h6>
                            <h2 id="p_good"><?php echo $p_good; ?></h2>
                            <span>&nbsp;</span>
                          </div>
                          <div class="icon">
                            <i id="fGood" class="ik ik-thumbs-up"></i>
                          </div>
                        </div>
                        <small class="text-small mt-10 d-block" id="percentageFGood">Finish Good (<?php echo $percentageFGood ?>% From Total Production)</small>
                      </div>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="<?php echo $bar_p_good ?>" aria-valuemin="0" aria-valuemax="<?php echo $bar_tt_prd ?>" style="width: 78%;"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="widget">
                      <div class="widget-body">
                        <div class="d-flex justify-content-between align-items-center">
                          <div class="state">
                            <h6>NG Finish Good(Tablet)</h6>
                            <h2 id="p_reject"><?php echo $p_reject; ?></h2>
                            <span>&nbsp;</span>
                          </div>
                          <div class="icon">
                            <i class="ik ik-calendar"></i>
                          </div>
                        </div>
                        <small class="text-small mt-10 d-block" id="percentageFGoodNG">Reject (<?php echo $percentageFGoodNG ?>% From Total Production)</small>
                      </div>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="<?php echo $bar_p_reject ?>" aria-valuemin="0" aria-valuemax="<?php echo $bar_tt_prd ?>" style="width: 31%;"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="widget">
                      <div class="widget-body">
                        <div class="d-flex justify-content-between align-items-center">
                          <div class="state">
                            <h6>Running Hours</h6>
                            <h2 id="run_hour"><?php echo $run_hour; ?></h2>
                            <span>&nbsp;</span>
                          </div>
                          <div class="icon">
                            <i class="ik ik-message-square"></i>
                          </div>
                        </div>
                        <small class="text-small mt-10 d-block">Runnning Hour Machine(%)</small>
                      </div>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"></div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <label class='font-noraml' style='font-weight:bold'>Machine :</label>
                    <div class='input-group'>
                      <select class='select2_demo_1 form-control' id='id_machine' onchange='changeMachine("periode")'>
                        <?php 
                          $a = 0; 
                          foreach ($machine as $machine) { 
                            if($a == 0) $selected = "selected"; else $selected = '';?>
                          <option value='<?php echo $machine->id; ?>' style='width:100px;' <?php echo $selected ?> ><?php echo $machine->machineName; ?></option>
                        <?php $a++; } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="card">
                      <div class="card-header">
                        <h3>Machine Avalaibility(%)</h3>&nbsp;&nbsp;
                        <p class="maSubtitle"></p>
                      </div>
                      <div class="card-block text-center">
                        <div id="machineAvalaibility" class="chart-shadow" style="height:400px"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="card">
                      <div class="card-header">
                        <h3>Total Avalaibility Time(%)</h3>&nbsp;&nbsp;
                        <p class="availSubtitle"></p>
                      </div>
                      <div class="card-block text-center">
                        <div id="c3-donut-chart3"style="height:400px"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="card">
                      <div class="card-header">
                        <h3 id="h3_oee">OEE(%) FY</h3>&nbsp;&nbsp;
                        <p class="oeeSubtitle"></p>
                      </div>
                      <div class="card-block text-center">
                        <div id="line_chart" class="chart-shadow" style="height:400px"></div>
                      </div>
                    </div>
                  </div>
                  <!-- <div class="col-lg-6 col-xl-4">
                    <div class="card">
                      <div class="card-header">
                        <h3>Breakdown Hours</h3>
                      </div>
                      <div class="card-block text-center">
                        <div id="bar_chart" class="chart-shadow" style="height:400px"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-xl-4">
                    <div class="card">
                      <div class="card-header">
                        <h3>PM PERFORMANCE TAR 99%</h3>
                      </div>
                      <div class="card-block text-center">
                        <div id="bar_chart1" class="chart-shadow" style="height:400px"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-xl-4">
                    <div class="card">
                      <div class="card-header">
                        <h3>CAL PERFORMANCE TAR 100%</h3>
                      </div>
                      <div class="card-block text-center">
                        <div id="bar_chart2" class="chart-shadow" style="height:400px"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-xl-4">
                    <div class="card">
                      <div class="card-header">
                        <h3>Percentase Breakdown April 20</h3>
                      </div>
                      <div class="card-block text-center">
                        <div id="breakdown_chart" class="chart-shadow" style="height:400px"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 col-xl-4">
                    <div class="card">
                      <div class="card-header">
                        <h3>WORK ORDER TAR 90%</h3>
                      </div>
                      <div class="card-block text-center">
                        <div id="allocation-chart" class="chart-shadow" style="height:400px"></div>
                      </div>
                    </div>
                  </div> -->
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- SELECT PERIODE AND RANGE DATE FOR PM, CAL, CONSUMPTIONS AND CAPA --ir  -->
        <div class="row">
          <div class="col-lg-6 col-md-12 col-sm-12">
            <label class='font-noraml' style='font-weight:bold'>Periode :</label>
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
                  <div class="col-md-6">
                    <div class="card" style="min-height: 422px;">
                      <div class="card-header"><h3>CALIBRATION(%)</h3></div>
                      <div class="card-body">
                        <div id="c3-donut-chart"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="card" style="min-height: 422px;">
                      <div class="card-header"><h3>PREVENTIVE MAINTENANCE(%)</h3></div>
                      <div class="card-body">
                        <div id="c3-donut-chart2"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="card">
                      <div class="card-header">
                        <h3>CAPA QA</h3>
                      </div>
                      <div class="card-block text-center">
                        <!-- <div id="capa_chart" class="chart-shadow" style="height:400px"></div> -->
                        <div id="capa_qa_chart" class="chart-shadow" style="height:400px"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="card">
                      <div class="card-header">
                        <h3>CAPA EHS</h3>
                      </div>
                      <div class="card-block text-center">
                        <div id="capa_ehs_chart" class="chart-shadow" style="height:400px"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="card">
                      <div class="card-header">
                        <h3>FUEL CONSUMPTION (LITERS)</h3>
                      </div>
                      <div class="card-block text-center">
                        <div id="cons_car_chart" class="chart-shadow" style="height:400px"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="card">
                      <div class="card-header">
                        <h3>WATER CONSUMPTION (M3)</h3>
                      </div>
                      <div class="card-block text-center">
                        <div id="cons_water_chart" class="chart-shadow" style="height:400px"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="card">
                      <div class="card-header">
                        <h3>ELECTRICITY CONSUMPTION (KWH)</h3>
                      </div>
                      <div class="card-block text-center">
                        <div id="cons_elect_chart" class="chart-shadow" style="height:400px"></div>
                      </div>
                    </div>
                  </div>
                </div>    
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="row clearfix">
              <div class="col-lg-3 col-md-3 col-sm-12">
                <label class='font-noraml' style='font-weight:bold'>Year :</label>
                <div class='input-group'>
                  <input id="tahun_budget" name="tahun_budget" readonly="" class="form-control"> 
                </div>
              </div>

              <div class="col-lg-3 col-md-3 col-sm-12">
                <label class='font-noraml' style='font-weight:bold'>Compare :</label>
                <div class='input-group'>
                  <select class='select2_demo_1 form-control' id='compare'>
                      <option value='plan'>PLAN</option>
                      <option value='myc'>MYC</option>
                      <option value='leb'>LBE</option>
                  </select>
                </div>
              </div>

              <div class="col-lg-2 col-md-2 col-sm-12">
                <label class='font-noraml' style='font-weight:bold'>&nbsp;</label>
                <div class='input-group'>
                  <button class="btn btn-primary btn-rounded btn-block" onclick="cari_budget()">Search</button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">

                <div class="row">

                  <div class="col-md-6">
                    <div class="card" style="min-height: 422px;">
                      <div class="card-header"><h3>CAPEX(%)</h3></div>
                      <div class="card-body">
                        <div id="capex_chart"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="card" style="min-height: 422px;">
                      <div class="card-header"><h3>OPEX(%)</h3></div>
                      <div class="card-body">
                        <div id="opex_chart"></div>
                      </div>
                    </div>
                  </div>

                </div>    
              </div>
            </div>
          </div>

          <!-- <div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <h3 id="h3_oee">OEE(%) FY</h3>
                </div>
                <div class="card-block text-center">
                  <div id="c3-pie-chart" class="chart-shadow" style="height:400px"></div>
                </div>
              </div>
            </div> -->
            
        </div>

      </div>
  </div>