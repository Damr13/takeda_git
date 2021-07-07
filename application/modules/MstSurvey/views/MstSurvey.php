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
      <div div class="col-lg-7">
        <div class='form-group' style='width:100% !important'>
          <label class='font-noraml' style='font-weight:bold'>Survey Lists :</label>
          <div class='input-group'>
            <select class="selectpicker form-control" data-live-search="true" id="surveys" name="surveys" onchange="changeSurvey(this.options[this.selectedIndex].value)">
              <option value=""></option>
            </select>
          </div>
        </div>
      </div>
      <div div class="col-lg-4">
        <div class='form-group' style='width:100% !important'>
          <label class='font-noraml' style='font-weight:bold'>&nbsp;</label>
          <div class='input-group'>
            <button id="btnAddSurvey" class='btn btn-info btn-md' onclick="modalCreateSurvey()"><i class='ik ik-plus'></i> Add Survey</button>
            <div class="spinner-border" role="status" style="display: none" id="spinner">
              <span class="sr-only">Loading... </span>
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
      <div class="col-md-12" id="allProc">
        <div class="card">
          <div class="card-header" id="headPages">
            <span>
              <button id="btnStatSurvey"><i class='ik ik-pencil'></i></button>
              <button id="btnUpdateSurvey" class='btn btn-success btn-md'><i class='fa fa-edit'></i> Edit Survey</button>
              <button id="btnDuplicateSurvey" class='btn btn-warning btn-md' onclick="duplicate('survey', '')"><i class='fa fa-copy'></i> Duplicate Survey</button>
              <button id="btnDelSurvey" class='btn btn-danger btn-md' onclick="delRow('survey')"><i class='ik ik-trash'></i></button>
              <button id="btnViewSurvey" class='btn btn-default btn-md'><i class='ik ik-eye'></i></button>
              <br>
              <h1 class="infoSurvey" id="surveyTitle"></h1>
              <h3 class="infoSurvey" id="surveyDate"></h3>
              <h3 class="infoSurvey" id="surveyCategory"></h3>
              <h3 class="infoSurvey" id="surveyURL"></h3>
            </span>
          </div>
          <div class="card-body">
            <button id="btnAddPage" class='btn btn-success btn-md' onclick="modalPage('create')"><i class='ik ik-plus'></i> Add Page</button>
            <button id="goBack" class='btn btn-info btn-md' onclick="showPages()"><i class='fa fa-arrow-left'></i> Go Back</button>
            <button id="addQ" class='btn btn-success btn-md' onclick="modalQ('create')"><i class='fa fa-plus'></i> Add Question</button>
            <button id="btnDuplicatePage" class='btn btn-warning btn-md' onclick="duplicate('page', '')"><i class='fa fa-copy'></i> Duplicate Page</button>
            <input type="hidden" id="idPage" name="idPage" readonly="" class="form-control"> 
            <br>
            <h2 id="pageTitle"></h2>
            <h5 id="pageDesc"></h5>
            <br>
            <div class="table-scroll table-responsive" id="tablePages">
              <div class="table-wrap">
                <table class="main-table table table-bordered" id="tPage">
                  <thead class="tHeadPages">
                    <tr>
                      <th width="15%"><center>Orders </center></th>
                      <th width="25%"><center>Pages </center></th>
                      <th><center>Description </center></th>
                      <th width="10%"><center>No. of Questions </center></th>
                      <th width="15%"><center>Actions </center></th>
                    </tr>
                  </thead>
                  <tbody style="text-align: center" class="tBodyPages" id="tBodyPages" >
                  </tbody>
                </table>
              </div>
            </div>
            <div class="table-scroll table-responsive" id="tableQ">
              <div class="table-wrap">
                <table class="main-table table table-bordered" id="tQ">
                  <thead class="tHeadQ">
                    <tr>
                      <th width="15%"><center>Orders </center></th>
                      <th><center>Questions </center></th>
                      <th><center>Description </center></th>
                      <th width="10%"><center>Type of Question </center></th>
                      <th width="25%"><center>Answer/Instruction/Placeholder </center></th>
                      <th width="15%"><center>Actions </center></th>
                    </tr>
                  </thead>
                  <tbody style="text-align: center" class="tBodyQ" id="tBodyQ" >
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
        <label>Category : </label>
        <select class='select2_demo_1 form-control' id="category" name="category" >
            <option value='Tamu'>Tamu</option>
            <option value='Contractor'>Contractor</option>
            <option value='Outsourcing'>Outsourcing</option>
            <option value='Karyawan'>Karyawan</option>
        </select> <br>
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

<!-- MODAL PAGE --ir -->
<div class="modal" id="modalPage" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
          
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title"></h4>
      </div>
          
      <!-- Modal body -->
      <div class="modal-body form-group">
        <input type="hidden" id="typePage" name="typePage" readonly="" class="form-control"> 
        <label>Title : </label>
        <input type="text" id="titlePage" name="titlePage" class="form-control"" required> <br>
        <label>Description : </label><br>
        <label id="labelDesc" style="display:none"><b>(Paste inside editor first!)</b></label>
        <!-- <div id="textPage" name="textPage" class="form-control""></textarea> <br> -->
        <div id="textPage" name="textPage" class="form-control""></div> <br>
        <label class="btnPage">Button Text : </label>
        <input type="text" id="btnPage" name="btnPage" class="form-control"" required>
        <text id="textCopy"></text>
      </div>
          
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" onclick="closeModalPage()">Close</button>
        <button type="button" id="actionPage" class="btn btn-success" onclick="updatePage()">Save</button>
      </div>
          
    </div>
  </div>
</div>

<!-- MODAL FOR ADD OR UPDATE QUESTIONS --ir -->
<div class="modal" id="modalQ">
  <div class="modal-dialog">
    <div class="modal-content">
          
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title"></h4>
      </div>
          
      <!-- Modal body -->
      <div class="modal-body form-group">
        <input type="hidden" id="idQ" name="idQ" readonly="" class="form-control"> 
        <label>Question : </label>
        <input type="text" id="titleQ" name="titleQ" class="form-control"" required> <br>
        <label>Description : </label>
        <textarea id="textQ" name="textQ" class="form-control""></textarea> <br>
        <label class="typeAns">Type of Answer : </label>
        <select class="form-control" id="typeAns" name="typeAns">
          <option value=""></option>
        </select> <br>
        <label class="reqQ">Required : </label>
        <select class="form-control" id="reqQ" name="reqQ">
          <option value="N" selected>No</option>
          <option value="Y">Yes</option>
        </select> <br>
        <label>Category Risk : </label>
        <select class='form-control' id="cat_risk" name="cat_risk" >
            <option value="General">General</option>
            <option value="Risk">Risk</option>
            <option value="Tracing">Tracing</option>
            <option value="Location">Location</option>
        </select> 
      </div>
          
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" onclick="closeModalQ()">Close</button>
        <button type="button" id="actionQ" class="btn btn-success" onclick="updateQ()">Save</button>
      </div>
          
    </div>
  </div>
</div>

<!-- MODAL FOR ADD OR UPDATE ANSWERS --ir -->
<div class="modal" id="modalAns">
  <div class="modal-dialog">
    <div class="modal-content">
          
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title"></h4>
        <div>
          <button style="display:none" id="btnAddAnswer" class='btn btn-primary btn-md' onclick="addMoreAnswers()"><i class='ik ik-plus'></i></button>
          <button style="display:none" id="btnResetAnswer" class='btn btn-warning btn-md' onclick="resetAnswers()"><i class='fa fa-refresh'></i></button>
          <button style="display:none" id="btnRightAns" class='btn btn-success btn-md' onclick="showRightAns()"><i class='fa fa-check'></i></button>
        </div>
      </div>
          
      <form enctype="multipart/form-data" id="formAns" method="POST">
        <!-- Modal body -->
        <div class="modal-body form-group">
          <h3 class="modal-desc"></h3>
          <input type="hidden" id="idAns" name="idAns" readonly="" class="form-control"> 
          <input type="hidden" id="typeAns2" name="typeAns2" class="form-control"" required>
          <input type="hidden" id="multi" name="multi" class="form-control"" required>
          <div class="col-md-12">
            <label>Answer/Instruction/Placeholder : </label>
            <div class="col-md-8" style="padding: 0 0;">
              <input type="text" id="titleAns0" name="titleAns0" class="form-control"" required>
            </div>
            <div class="col-md-4">
              <select class='select2_demo_1 form-control' id="skorAns0" name="skorAns0" >
                  <option value='0'>0</option>
                  <option value='1'>1</option>
                  <option value='2'>2</option>
                  <option value='3'>3</option>
                  <option value='4'>4</option>
                  <option value='5'>5</option>
                  <option value='12'>12</option>
                  <option value='27'>27</option>
              </select>
            </div>
          </div>
          <div class="col-md-12">
            <div id="moreAnswersCol"></div>
          </div>
        </div>
          
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" onclick="closeModalAns('no')">Close</button>
          <button type="button" id="actionAns" class="btn btn-success" onclick="updateAns()">Save</button>
        </div>
      </form>
          
    </div>
  </div>
</div>