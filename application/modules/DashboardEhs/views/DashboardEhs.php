<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<body>
  <!--[if lt IE 8]>
      <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->

  <div class="main-content" style="padding-left:15px; margin-top:0px;">
    <div class="container-fluid">
      <!-- Filter Date Pie for chart list people, filled form, and judgement bar chart -->
      <div class="row" style="margin-bottom:15px;">
        <div class="col-md-4">
          <h3>
            <b>
              <span class="text-center text-sm-left d-md-inline-block" style="font-weight: 900;color:#ea4c62">EHS DASHBOARD</span>
            </b>
          </h3>
          <h6 style="font-size:13px;color: #b3b3b3;margin-bottom:20px">Report EHS Dashboard</h6>
        </div>
        <div class="col-md-2"></div>
        <div class="col-lg-6">
          <div class="row clearfix">
            <div class="col-lg-4 col-md-4 col-sm-12">
              <label class="font-noraml" style="font-weight:bold">Start Date :</label>
              <div class="input-group">
                <input id="startDate" name="date" readonly="" class="form-control"> 
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <label class="font-noraml" style="font-weight:bold">Finish Date :</label>
              <div class="input-group">
                <input id="endDate" name="date" readonly="" class="form-control"> 
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <label class="font-noraml" style="font-weight:bold">&nbsp;</label>
              <div class="input-group">
                <button id="button-submit" class="btn btn-primarys btn-rounded btn-block" onclick="setPiePie()">Submit</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Count Visitor, Contractor, Employee, and Outsourcing today -->
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
              <div class="progress-bar bg-warnings" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
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
              <div class="progress-bar bg-warnings" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
          <div class="widget">
            <div class="widget-body">
              <div class="row">
                <div class="d-flex justify-content-between align-items-center">
                  <div class="state col-md-8">
                    <h6>Employee Today</h6>
                    <div style="display:flex">
                      <!-- Count Employee today -->
                      <?php
                        foreach ($employee as $r); ?>
                        <h2>
                          <?php echo $r->emp; ?>
                        </h2>
                      <?php ?>
                      <!-- Count All Employee -->
                      <?php 
                        foreach ($totalEmp as $te); ?>
                        <h6 style="margin: 15px 0 0 7px;color:#d0d0d0;font-weight:600">
                          / <?php echo $te->totemp; ?>
                        </h6>
                      <?php ?>
                    </div>
                    <span>&nbsp;</span>
                  </div>
                  <div class="img-visit col-md-4">
                    <img src="assets/img/workers.png" style="max-width:50%;float:right">
                  </div>
                </div>
              </div>
            </div>
            <div class="progress progress-sm">
              <div class="progress-bar bg-warnings" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
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
                    <div style="display:flex">
                      <!-- Count Outsourcing today -->
                      <?php
                      foreach ($outsourcing as $r); ?>
                      <h2>
                        <?php echo $r->outs; ?>
                      </h2>
                      <?php ?>
                      <!-- Count All Outsourcing -->
                      <?php 
                        foreach ($totalOut as $to); ?>
                        <h6 style="margin: 15px 0 0 7px;color:#d0d0d0;font-weight:600">
                          / <?php echo $to->totout; ?>
                        </h6>
                      <?php ?>
                    </div>
                    <span>&nbsp;</span>
                  </div>
                  <div class="img-visit col-md-4">
                    <img src="assets/img/outsourcing.png" style="max-width:50%;float:right">
                  </div>
                </div>
              </div>
            </div>
            <div class="progress progress-sm">
              <div class="progress-bar bg-warnings" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
            </div>
          </div>
        </div>
      </div>

      <!-- List People by Judgement -->
      <div class="row">
        <div class="card">
          <div class="card-body">
            <!-- Filter Date Pie for chart list people, filled form, and judgement bar chart -->
            <div class="row">
              <div class="col-md-4">
                <h4 style="font-size: 1.3rem;font-weight: 600;">List People by Judgement</h4>
                <h6 style="font-size:13px;color: #b3b3b3;margin-bottom:20px">Very Low, Low, Moderate, High, and Very High</h6>
              </div>
            </div>
            <!-- Pie Chart List yang sudah isi -->
            <div class="row">
              <div class="col-md-12">
                <!-- Check -->
                <div class="row">
                  <div class="col-lg-3" id="cardPieTamu">
                    <div class="card" style="text-align:center">
                      <div class="card-header">
                        <h6>Visitor</h6>
                      </div>
                      <div class="card-block text-center vis">
                        <div id="loaders" class="loaders">Loading...</div>
                        <div id="c3-donut-chart_Tamu" style="height:400px"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3" id="cardPieContractor">
                    <div class="card" style="text-align:center">
                      <div class="card-header">
                        <h6>Contractor</h6>
                      </div>
                      <div class="card-block text-center con">
                        <div id="loaders" class="loaders">Loading...</div>
                        <div id="c3-donut-chart_Contractor" style="height:400px"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3" id="cardPieKaryawan">
                    <div class="card" style="text-align:center">
                      <div class="card-header">
                        <h6>Employee</h6>
                      </div>
                      <div class="card-block text-center emp">
                        <div id="loaders" class="loaders">Loading...</div>
                        <div id="c3-donut-chart_Karyawan" style="height:400px"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3" id="cardPieOutsourcing">
                    <div class="card" style="text-align:center">
                      <div class="card-header">
                        <h6>Outsourcing</h6>
                      </div>
                      <div class="card-block text-center out">
                        <div id="loaders" class="loaders">Loading...</div>
                        <div id="c3-donut-chart_Outsourcing" style="height:400px"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Judgement -->
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h3>Judgement</h3>
                  </div>
                  <div class="card-block text-center">
                    <div id="loaders" class="loaders">Loading...</div>
                    <div id="judgement" class="chart-shadow" style="height:400px"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Percentage of COVID Screening Form Filling -->
      <div class="row">
        <div class="card">
          <div id="loadersa" class="loadersa" style="display:none"></div>
          <div id="loaders-text" class="loaders-text" style="display: none; left: 50%; height: 40px; margin-left: -89.5px; line-height: 16px;">Processing, please wait ...</div>
          <div class="card-body">
            <div id="percentDept" class="percentDept">
              <div class="row">
                <div class="col-md-6">
                  <!-- Title -->
                  <h4 style="font-size: 1.3rem;font-weight: 600;">Percentage of COVID Screening Form Filling <span class="dateTitle"></span></h4>
                  <h6 style="font-size:13px;color: #b3b3b3">Departement</h6>
                </div>
                <div class="col-lg-6">
                  <div class="row clearfix">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                      <label class="font-noraml" style="font-weight:bold">Start Date :</label>
                      <div class="input-group">
                        <input id="startDates" name="date" readonly="" class="form-control"> 
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                      <label class="font-noraml" style="font-weight:bold">Finish Date :</label>
                      <div class="input-group">
                        <input id="endDates" name="date" readonly="" class="form-control"> 
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                      <label class="font-noraml" style="font-weight:bold">&nbsp;</label>
                      <div class="input-group">
                        <button id="button-submit" class="btn btn-primarys btn-rounded btn-block" onclick="search_dept()">Submit</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-2">
                  <div style="height: 400px"></div>
                  <div id="table-dept" style="margin-top: -28px;position: relative;left: 32px;width: 240px;">
                    <table id="table-dept" class="main-table table table-striped table-bordered table-hover">
                      <tbody id="tbody">
                        <tr>
                          <td style="background-color: #a367dc;color: #fff;font-weight: 700;font-size: 13px;">Form Employee</td>
                        </tr>
                        <tr>
                          <td style="background-color: #8067dc;color: #fff;font-weight: 700;font-size: 13px;padding: 11.5px;">Form Submission</td>
                        </tr>
                        <tr>
                          <td style="background-color: #6b705c;color: #fff;font-weight: 700;font-size: 13px;">% Submission</td>
                        </tr>
                        <tr>
                          <td style="background-color: #ffb703;color: #fff;font-weight: 700;font-size: 13px;">Target Submission</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-md-10">
                  <!-- Chart -->
                  <div id="departement" style="width: 100%;height:400px;padding-right: 0;"></div>
                  <!-- Table -->
                  <div id="table-depts" style="margin-top: -28px;padding-left: 58px;padding-right: 71px;">
                    <table id="table-dept" class="main-table table table-striped table-bordered table-hover">
                      <tbody>
                        <tr>
                            <td><center>0</center></td>
                            <td><center>0</center></td>
                            <td><center>0</center></td>
                            <td><center>0</center></td>
                            <td><center>0</center></td>
                            <td><center>0</center></td>
                            <td><center>0</center></td>
                            <td><center>0</center></td>
                            <td><center>0</center></td>
                            <td><center>0</center></td>
                            <td><center>0</center></td>
                        </tr>
                        <tr>
                            <td><center>0</center></td>
                            <td><center>0</center></td>
                            <td><center>0</center></td>
                            <td><center>0</center></td>
                            <td><center>0</center></td>
                            <td><center>0</center></td>
                            <td><center>0</center></td>
                            <td><center>0</center></td>
                            <td><center>0</center></td>
                            <td><center>0</center></td>
                            <td><center>0</center></td>
                        </tr>
                        <tr>
                            <td><center>0%</center></td>
                            <td><center>0%</center></td>
                            <td><center>0%</center></td>
                            <td><center>0%</center></td>
                            <td><center>0%</center></td>
                            <td><center>0%</center></td>
                            <td><center>0%</center></td>
                            <td><center>0%</center></td>
                            <td><center>0%</center></td>
                            <td><center>0%</center></td>
                            <td><center>0%</center></td>
                        </tr>
                        <tr>
                            <td><center>100%</center></td>
                            <td><center>100%</center></td>
                            <td><center>100%</center></td>
                            <td><center>100%</center></td>
                            <td><center>100%</center></td>
                            <td><center>100%</center></td>
                            <td><center>100%</center></td>
                            <td><center>100%</center></td>
                            <td><center>100%</center></td>
                            <td><center>100%</center></td>
                            <td><center>100%</center></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Filled and Not filled out the form -->
      <div class="row">
        <div class="card">
          <div class="card-body">
            <div class="col-md-12">
              <h4 style="font-size: 1.3rem;font-weight: 600;">List of people who have filled out and have not filled out the form</h4>
              <h6 style="font-size:13px;color: #b3b3b3;margin-bottom:20px">Employee & Outsourcing</h6>
              <!-- Uncheck -->
              <div class="row">
                <!-- EMPLOYEE -->
                <div class="col-md-6" id="cardPieUncheckKaryawan">
                  <div class="card">
                    <div class="card-header">
                      <h3>Employee Today</h3>
                    </div>
                    <div class="card-block text-center">
                      <div id="c3-donut-chart__Uncheck-Karyawan"style="height:400px"></div>
                    </div>
                  </div>
                </div>
                <!-- OUTSOURCING -->
                <div class="col-md-6" id="cardPieUncheckOutsourcing">
                  <div class="card">
                    <div class="card-header">
                      <h3>Outsourcing Today</h3>
                    </div>
                    <div class="card-block text-center">
                      <div id="c3-donut-chart__Uncheck-Outsourcing"style="height:400px"></div>
                    </div>
                  </div>
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- MODAL POP UP PIE CHART -->
      <div class="modal" id="modalDetail" style="background-color: rgba(0, 0, 0, 0.6);">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title"></h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body form-group" style="overflow: auto;height: 445px;">
              <table class="main-table table table-striped table-bordered table-hover"></table>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
              <button id="close_modal" type="button" class="btn btn-danger">Close</button>
            </div>
          </div>
        </div>
      </div>
      <!-- MODAL POP UP PIE CHART UNCHECK -->
      <div class="modal" id="modalDetailUncheck" style="background-color: rgba(0, 0, 0, 0.6);">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title"></h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body form-group" style="overflow: auto;height: 445px;">
              <table class="main-table table table-striped table-bordered table-hover"></table>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
              <button id="close_modals" type="button" class="btn btn-danger">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>