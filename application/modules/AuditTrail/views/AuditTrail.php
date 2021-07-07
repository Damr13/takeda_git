<div class="main-content">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-12">
                    <div class="page-header-title" style="text-align: center;">
                        <div class="d-inline">
                            <h5>AUDIT TRAIL <div id="bulan_name"></div> </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
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
                        <button id="btn_cari" class='btn btn-success btn-lg' onclick="cari()">Search <i class='ik ik-search'></i></button>
                        <div class="spinner-border" role="status" style="display: none" id="spinner">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div> 
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table class="main-table table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th><center><b>No</b></center></th>
                                    <th><center><b>Machine Name</b></center></th>
                                    <th><center><b>Date</b></center></th>
                                    <th><center><b>Time</b></center></th>
                                    <th><center><b>User</b></center></th>
                                    <th><center><b>Shift</b></center></th>
                                    <th><center><b>Down Time Code</b></center></th>
                                    <th><center><b>Down Time Name</b></center></th>
                                    <th><center><b>Down Time Group</b></center></th>
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