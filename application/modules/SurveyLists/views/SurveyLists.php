<div class="main-content">
  <div class="container-fluid">
    <div class="page-header" style="margin-bottom:10px;">
      <div class="row align-items-end">
        <div class="col-lg-12">
          <div class="page-header-title" style="text-align: center;">
            <!-- <i class="ik ik-file-text bg-blue"></i> -->
            <div class="d-inline">
              <!-- <i class="ik ik-inbox bg-blue"></i> -->
              <h5 class="titleModule"></h5>
              <hr />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div div class="col-lg-12">
        <div class='form-group' style='width:100% !important'>
          <label class='font-noraml' style='font-weight:bold'>&nbsp;</label>
          <div class='input-group'>
            <button id="btnAddSurvey" class='btn btn-success btn-md' onclick="modalCreateSurvey()"><i class='ik ik-plus'></i> Add Survey</button>
            <div class="spinner-border" role="status" style="display: none" id="spinner">
              <span class="sr-only">Loading...</span>
            </div>
            <input type="hidden" id="create" readonly value="<?php echo $akses->create ?>" >
            <input type="hidden" id="update" readonly value="<?php echo $akses->update ?>" >
            <input type="hidden" id="delete" readonly value="<?php echo $akses->delete ?>" >
            <input type="hidden" id="id" name="id" readonly="" class="form-control"> 
            <input type="hidden" id="titleSurvey" name="titleSurvey" readonly="" class="form-control"> 
          </div>
        </div>
      </div>

      <!-- CARD FOR ALL PROCESS --ir -->
      <div class="col-md-12" id="headPages">
        <div class="card">
          <div class="card-header">
            <span>
              <button id="goBack" class='btn btn-info btn-md' onclick="showSurveys()"><i class='fa fa-arrow-left'></i> Go Back</button>
              <h1 class="infoSurvey" id="surveyTitle"></h1>
              <h3 class="infoSurvey" id="surveyDate"></h3>
              <h3 class="infoSurvey" id="surveyURL"></h3>
              <input type="hidden" id="idPage" name="idPage" readonly="" class="form-control"> 
              <hr>
            </span>
          </div>
        </div>
      </div>

      <!-- CARD FOR ALL PROCESS --ir -->
      <div class="col-md-12" id="tableSurveys">
        <div class="card">
          <div class="card-body">
            <!-- TABLE SURVEY LISTS-->
            <div class="table-scroll table-responsive" style="padding: 0 40px 0 40px">
              <div class="table-wrap">
                <table id="tableSurveyLists" class="dataTableAll main-table table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <th><center><b>Status</b></center></th>
                      <th>Survey Name</th>
                      <!-- <th>Views</th> -->
                      <th>Responses</th>
                      <!-- <th>Complete Rate</th> -->
                      <th>Created Date</th>
                      <th>Last responses</th>
                      <th class="nosort"><b>Action</b></th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          
          <div>
            <?php echo $this->session->flashdata('pesan'); ?>
          </div>
        </div>
      </div>

      <!-- CARD FOR ALL PROCESS --ir -->
      <div class="col-md-12" id="tableResponses">
        <div class="card">
          
          <div class="card-body">
            <!-- TABLE SURVEY RESPONSES LISTS-->
            <div class="table-scroll table-responsive" style="padding: 0 40px 0 40px">
              <div class="table-wrap">
                <table id="tableResponsesLists" class="dataTableResponses main-table table table-striped table-bordered table-hover">
                </table>
              </div>
            </div>
          </div>
          <div>
            <?php echo $this->session->flashdata('pesan'); ?>
          </div>
        </div>
      </div>

      <!-- CARD FOR ALL PROCESS --ir -->
      <div class="col-md-12" id="chartResponses" style="overflow:auto">
      
        <div class="col-md-12 doNotRemoveMe" style="padding:0">
          <div class="col-md-8" style="padding:0 10px 0 0">
            <div class="card">
              <div class="card-header" style="text-align: center;">
                <div class="col-md-12">
                  <h2 align="center"><b>Total Respondents</b></h2>
                  <h4 align="center"><b>(MAIN CHART)</b></h4>
                </div>
              </div>
              <div class="card-body">
                <div class="row"> 
                  <div class="col-md-12">
                    <table style="width:100%">
                      <tr>
                        <td style="padding: 0 6px; width:100%;"><h3 style="font-weight:400">Based on Question : </h3><h3 id="basedQTitle"></h3></td>
                      </tr>
                      <tr>
                        <!-- <td style="padding: 0 6px; white-space: nowrap;"><button class="btn btn-md btn-warning allResp">All</button></td> -->
                        <td style="padding: 0 6px; width:100%; white-space: nowrap;">
                          <input class="form-control" id="typeChartMain" name="typeChartMain" type="hidden">
                          <input class="form-control" id="idQMain" name="idQMain" type="hidden">
                          <select class="form-control" id="basedQ" name="basedQ" onchange="getDataChart('','','chartTypeMain')"></select>
                        </td>
                        <td style="padding: 0 6px; white-space: nowrap;"><label style="cursor: pointer"><input style="cursor: pointer;" type="checkbox" value=""> All</label></td>
                        <td style="padding: 0 6px; white-space: nowrap;"><button class="btn btn-md btn-warning changeOptResp" onclick="changeOptChart('', 'main', 'edit')">Option</button></td>
                      </tr>
                    </table>
                    <br><hr style="padding:10px 0">
                  </div>
                  <div id="loadingMainChart" style="display: none; margin: 100px auto;">
                    <div class="spinner-grow text-danger"></div>
                    <div class="spinner-grow text-danger"></div>
                    <div class="spinner-grow text-danger"></div>
                  </div>
                  <div class="col-md-12">
                    <div id="chartTypeMain" style="height:400px"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4" style="padding:0 0 0 10px">
            <div class="card">
              <div class="card-header" style="text-align: center;">
                <div class="col-md-6">
                  <h2><b>List Charts</b></h2>
                </div>
                <div class="col-md-6">
                  <button style="float:right; margin:0 2px;" class="btn btn-md btn-success showAllCharts" onclick="showHideAllCharts('show')"><i class="fa fa-eye"></i></button>
                  <button style="float:right; margin:0 2px;" class="btn btn-md btn-warning hideAllCharts" onclick="showHideAllCharts('hide')"><i class="fa fa-eye-slash"></i></button>
                  <button style="float:right; margin:0 2px;" class="btn btn-md btn-info addCharts" onclick="changeOptChart('', 'custom', 'create')"><i class="fa fa-plus"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="row"> 
                  <div id="loadingListCharts" style="display: none; margin: 10px auto;">
                    <div class="spinner-grow spinner-grow-sm text-danger"></div>
                    <div class="spinner-grow spinner-grow-sm text-danger"></div>
                    <div class="spinner-grow spinner-grow-sm text-danger"></div>
                  </div>
                  <table class="col-md-12 listBtnCharts" style="padding:0px 10px;">

                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
</div>

<!-- MODAL FOR ADD OR UPDATE SURVEYS --ir -->
<div class="modal" id="modalSurvey">
  <div class="modal-dialog">
    <div class="modal-content">
          
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title"></h4>
      </div>
          
      <!-- Modal body -->
      <div class="modal-body form-group">
        <label>Survey Title : </label>
        <input type="text" id="title" name="title" class="form-control"" required> <br>
        <div class="row">
          <div class="col-6">
            <label class='font-noraml' style='font-weight:bold'>Start Date :</label>
            <div class='input-group'>
              <input id="surveyBegin" name="surveyBegin" class="form-control"> 
            </div>
          </div>
          <div class="col-6">
            <label class='font-noraml' style='font-weight:bold'>Finish Date :</label>
            <div class='input-group'>
              <input id="surveyEnd" name="surveyEnd" class="form-control"> 
            </div>
          </div>
        </div>
        <label>Target Responden : </label>
        <input type="number" id="target" name="target" class="form-control"" required> <br>
        <label>Redirect URL : </label>
        <input type="text" id="url" name="url" class="form-control"" required> <br>
      </div>
          
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" onclick="closeModal()">Close</button>
        <button type="button" id="action" class="btn btn-success" onclick="updateSurvey()">Save</button>
      </div>
          
    </div>
  </div>
</div>

<!-- MODAL FOR OPT TOTAL RESPONDEN GAUGES --ir -->
<div class="modal" id="modalOptChart">
  <div class="modal-dialog">
    <div class="modal-content">
          
      <!-- Modal Header -->
      <div class="modal-header">
        <!-- <div class="row"> -->
          <div class="col-md-8"><h3 class="modal-title"></h3></div>
          <div class="col-md-4"><a style="float:right; color:white" id="action" class="btn btn-warning" onclick="getDataOptChart()"><i class="fa fa-refresh"></i> Reset</a></div>
        <!-- </div> -->
      </div>
          
      <!-- Modal body -->
      <form enctype="multipart/form-data" id="formOptChart" method="POST">
        <input type="hidden" id="idChart" required> <br>
        <div class="modal-body form-group">
          <div class="row">
            <div class="col-8">
              <label class='font-noraml' style='font-weight:bold'>Type of Chart :</label>
              <div class='input-group'>
                <select class="form-control" id="typeChart" name="typeChart" onchange="changeTypeChart()">
                  <option value=""></option>
                </select> <br>
              </div>
            </div>
            <div class="col-4">
              <label class='font-noraml' style='font-weight:bold'>.</label>
              <div class='input-group'>
                <button type="button" style="width:100%" class="btn btn-md btn-info" value="0" id="previewChart" onclick="showPreviewChart()"><i class="fa fa-eye"></i> Preview</button>
              </div>
            </div>
            <div id="loadingChart" style="display: none; margin: 10px auto;">
              <div class="spinner-grow spinner-grow-sm text-danger"></div>
              <div class="spinner-grow spinner-grow-sm text-danger"></div>
              <div class="spinner-grow spinner-grow-sm text-danger"></div>
            </div>
            <div class="col-12" id="chartPreview" style="display:none">
            </div>
          </div>
          <!-- ADD TITLE AND SUBTITLE FOR CUSTOM CHART ONLY --ir -->
          <div class="customChartOpt">
            <label>Title</label>
            <input type="text" id="titleChart" name="titleChart" class="form-control"" required> <br>
            <label>Subtitle</label>
            <input type="text" id="subtitleChart" name="subtitleChart" class="form-control"" required> <br>
            <div class="row">
              <div class="col-8">
                <label>Button Title</label>
                <input type="text" id="buttonTitleChart" name="buttonTitleChart" class="form-control"" required> <br>
              </div>
              <div class="col-4">
                <label class='font-noraml' style='font-weight:bold'>Card Column :</label>
                <div class='input-group'>
                  <input type="number" id="cardColChart" name="cardColChart" min="3" max="12" step="3" class="form-control"> 
                </div>
              </div>
            </div>
          </div>
          <!-- MAIN BASED Q AND ITS ANSWERS --ir -->
          <div class="mainBasedQ">
            <hr style="border-bottom: 1px solid black;"><br>
            <label>Based on Question : </label>
            <select class="selectpicker form-control" data-live-search="true" id="basedQLists" name="basedQLists" onchange="changeBasedQLists(this.options[this.selectedIndex].value)">
              <option value=""></option>
            </select> <br><br>
            <label class="ansQTtext"></label>
            <input type="text" id="ansQLists" name="ansQLists" data-role="tagsinput" class="form-control"" required> <br><br>
            <div class="optChart" id="optTag">
              <label>Minimal Mention</label>
              <input type="number" id="minTags" name="minTags" class="form-control" value="1" > <br><br>
            </div>
          </div>
          <!-- MAIN BASED Q AND ITS ANSWERS --ir -->
          <div class="optChart" id="optGauges" style="display:none">
            <hr style="border-bottom: 1px solid black;">
            <h3 style="margin:10px 0px 5px"><b>Option for Gauge Bands</b></h3>
            <hr style="border-bottom: 1px solid black;"><br>
            <div class="row">
              <div class="col-6">
                <label class='font-noraml' style='font-weight:bold'>Min :</label>
                <div class='input-group'>
                  <input id="minTotResp" value="0" name="minTotResp" onchange="changeMinChart()" class="form-control"> 
                </div>
              </div>
              <div class="col-6">
                <label class='font-noraml' style='font-weight:bold'>Max (from Target Responden) :</label>
                <div class='input-group'>
                  <input id="maxTotResp" name="maxTotResp" readonly class="form-control"> 
                </div>
              </div>
            </div>
            <br>
            <hr style="padding-top:15px">
            <div class="row">
              <div class="col-7">
                <a style="width:100%; color:white;" class="btn btn-md btn-success addSeries" onclick="addSeriesChart()"><i class="fa fa-plus"></i> Add Scale/Grade/Series</a>
              </div>
              <div class="col-3">
                <a style="width:100%; color:white;" class="btn btn-md btn-primary autoCalcSeries" onclick="autoCalcSeries()"><i class="fa fa-magic"></i></a>
              </div>
              <div class="col-2">
                <a style="width:100%; color:white;" class="btn btn-md btn-warning resetSeries" onclick="resetSeries()"><i class="fa fa-refresh"></i></a>
              </div>
            </div>
            <br>
            <hr style="padding-bottom:15px">
            <table style="width:100%" id="moreSeriesCol"></table>
          </div>
          <div style="display:none" id="jsonOptResp"></div>
        </div>
      </form>
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" onclick="closeModalOptChart()">Close</button>
        <button type="button" id="actionOpt" class="btn btn-success" onclick="updateOptChart()">Change</button>
        <input type="hidden" id="modalOpt">
      </div>
          
    </div>
  </div>
</div>

<!-- MODAL FOR ADD/UPDATE CHART AND ITS OPTIONS --ir -->
<!-- <div class="modal" id="modalOptChart">
  <div class="modal-dialog">
    <div class="modal-content">
          
      <div class="modal-header">
        <h4 class="modal-title"></h4>
      </div>
          
      <form enctype="multipart/form-data" id="formOptChart" method="POST">
        <div class="modal-body form-group">
          <div class="row">
            <div class="col-8">
              <label class='font-noraml' style='font-weight:bold'>Type of Chart :</label>
              <div class='input-group'>
                <select class="form-control" id="typeChart2" name="typeChart2">
                  <option value=""></option>
                </select> <br>
              </div>
            </div>
            <div class="col-4">
              <label class='font-noraml' style='font-weight:bold'>.</label>
              <div class='input-group'>
                <button style="width:100%" class="btn btn-md btn-info previewChart" onclick="previewChart()"><i class="fa fa-eye"></i> Preview</button>
              </div>
            </div>
          </div>
          <label>Based on Question : </label>
          <select class="selectpicker form-control" data-live-search="true" id="basedQChartLists" name="basedQChartLists" onchange="changeBasedQLists(this.options[this.selectedIndex].value)">
            <option value=""></option>
          </select> <br><br>
          <label>All the answers (you can remove some, but you can't add it!) : </label>
          <input type="text" id="ansQChartLists" name="ansQChartLists" data-role="tagsinput" class="form-control"" required> <br><br>
        </div>
      </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" onclick="closeModalOptChart()">Close</button>
        <button type="button" id="actionOptChart" class="btn btn-success" onclick="updateOptChart()">Change</button>
      </div>
          
    </div>
  </div>
</div> -->