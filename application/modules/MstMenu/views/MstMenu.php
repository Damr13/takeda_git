<div class="main-content">
  <div class="container-fluid">
    <!-- HEADER FOR TITLE --ir -->
    <div class="page-header" style="margin-bottom:10px;">
      <div class="row align-items-end">
        <div class="col-lg-12">
          <div class="page-header-title" style="text-align: center;">
            <!-- <i class="ik ik-file-text bg-blue"></i> -->
            <div class="d-inline">
              <h5>Master Menu</h5>
              <hr />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">

      <!-- <div class="col-lg-12" style="margin-bottom:10px;">
        <div class="col-lg-2 pull-right">
          <div class='form-group' style='width:100% !important'>
              <button id="btn_upd" class='btn btn-danger btn-lg' onclick="tambah_menu()">Tambah Menu</button>
          </div>        
        </div>
      </div> -->

      <div class="col-md-12">
        <div class="card">
          <div class="content">

            <div class="table-scroll table-responsive">
              <div class="table-wrap">
                <table class="main-table table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <th width="3%"><center><b>No</b></center></th>
                      <th width="27%"><center><b>Menu</b></center></th>
                      <th width="10%"><center><b>Icon</b></center></th>
                      <th width="30%"><center><b>Link</b></center></th>
                      <th width="30%"><center><b>Action</b></center></th>
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
        <input type="hidden" id="id" name="id" readonly="" class="form-control"> 

        <label for="month">Menu : </label>
        <input type="text" id="val" name="val" class="form-control"> 

        <label for="month">Icon : </label>
        <input type="text" id="icon" name="icon" class="form-control"> 

      </div>
          
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" onclick="close_modal()">Close</button>
        <button type="button" class="btn btn-success" onclick="update_menu()">Save</button>
      </div>
          
    </div>
  </div>
</div>


<div class="modal" id="Modal_update_sub">
  <div class="modal-dialog">
    <div class="modal-content">
          
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title" id="header_modal_op"></h4>
      </div>
          
      <!-- Modal body -->
      <div class="modal-body form-group">
        <input type="hidden" id="id_sub" name="id_sub" readonly="" class="form-control"> 

        <label for="month">Menu : </label>
        <input type="text" id="val_sub" name="val_sub" class="form-control"> 

        <label for="month">Link : </label>
        <input type="text" id="link" name="link" class="form-control"> 

      </div>
          
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" onclick="close_modal_sub()">Close</button>
        <button type="button" class="btn btn-success" onclick="update_submenu()">Save</button>
      </div>
          
    </div>
  </div>
</div>

<div class="modal" id="Modal_add_submenu">
  <div class="modal-dialog">
    <div class="modal-content">
          
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title" id="header_modal_op"></h4>
      </div>
          
      <!-- Modal body -->
      <div class="modal-body form-group">
        <input type="hidden" id="id_parent" name="id_parent" readonly="" class="form-control"> 

        <label for="month">Menu : </label>
        <input type="text" id="nama_submenu" name="nama_submenu" class="form-control"> 

        <label for="month">Link : </label>
        <input type="text" id="link_submenu" name="link_submenu" class="form-control"> 

      </div>
          
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" onclick="close_modal_add_submenu()">Close</button>
        <button type="button" class="btn btn-success" onclick="tambah_submenu()">Save</button>
      </div>
          
    </div>
  </div>
</div>