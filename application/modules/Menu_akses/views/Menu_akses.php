<div class="main-content">
  <div class="container-fluid">
    <!-- HEADER FOR TITLE --ir -->
    <div class="page-header" style="margin-bottom:10px;">
      <div class="row align-items-end">
        <div class="col-lg-12">
          <div class="page-header-title" style="text-align: center;">
            <!-- <i class="ik ik-file-text bg-blue"></i> -->
            <div class="d-inline">
              <h5>Menu Acces</h5>
              <hr />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">

      <div class="col-lg-12 row align-items-end" style="margin-bottom:10px;">
        <div class="col-lg-3">
            <div class='form-group' style='width:100% !important'>
              <label class='font-noraml' style='font-weight:bold'>Level :</label>
              <div class='input-group'>
                <select class='select2_demo_1 form-control' id='id_level'>
                    <?php foreach ($user_level as $lvl) { ?>
                      <option value='<?php echo $lvl->id_user_level; ?>'><?php echo $lvl->nama_level; ?></option>
                    <?php } ?>
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

        <div class="col-lg-3"></div>

        <div class="col-lg-2" style="display: none;" id="div_btn_add_menu_akses">
          <div class='form-group' style='width:100% !important'>
              <button id="btn_upd" class='btn btn-danger btn-lg' onclick="add_menu_akses()">Add Menu</button>
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
                      <th width="3%"><center><b>No</b></center></th>
                      <th width="37%"><center><b>Menu</b></center></th>
                      <th width="10%"><center><b>Create</b></center></th>
                      <th width="10%"><center><b>Update</b></center></th>
                      <th width="10%"><center><b>Delete</b></center></th>
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

<div class="modal" id="Modal_add_menu">
  <div class="modal-dialog">
    <div class="modal-content">
          
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title" id="header_add_menu"></h4>
      </div>
          
      <!-- Modal body -->
      <div class="modal-body form-group">
        <input type="hidden" id="id_level_add_menu" name="id_level_add_menu" readonly="" class="form-control"> 

        <label for="month">Menu : </label>
        <div class='input-group'>
          <select class='select2_demo_1 form-control' id='id_add_menu'>
            <option value=''></option>
          </select>
        </div>

        <!-- <label for="month">Access : </label>
        <div class='input-group'>
          <label class="checkbox-inline"><input type="checkbox" id="create" checked> Create </label>
          <label class="checkbox-inline"><input type="checkbox" id="update" checked> Update </label>
          <label class="checkbox-inline"><input type="checkbox" id="delete" checked> Delete </label>
        </div> -->

      </div>
          
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" onclick="close_modal_add_menu()">Close</button>
        <button type="button" class="btn btn-success" onclick="add_menu()">Save</button>
      </div>
          
    </div>
  </div>
</div>

<div class="modal" id="Modal_add_submenu">
  <div class="modal-dialog">
    <div class="modal-content">
          
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title" id="header_add_submenu"></h4>
      </div>
          
      <!-- Modal body -->
      <div class="modal-body form-group">
        <input type="hidden" id="id_level_add_submenu" name="id_level_addsub_menu" readonly="" class="form-control"> 

        <label for="month">SubMenu : </label>
        <div class='input-group'>
          <select class='select2_demo_1 form-control' id='id_add_submenu'>
            <option value=''></option>
          </select>
        </div>

        <label for="month">Access : </label>
        <div class='input-group'>
          <label class="checkbox-inline"><input type="checkbox" id="create" checked> Create </label>
          <label class="checkbox-inline"><input type="checkbox" id="update" checked> Update </label>
          <label class="checkbox-inline"><input type="checkbox" id="delete" checked> Delete </label>
        </div>

      </div>
          
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" onclick="close_modal_add_submenu()">Close</button>
        <button type="button" class="btn btn-success" onclick="add_submenu()">Save</button>
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