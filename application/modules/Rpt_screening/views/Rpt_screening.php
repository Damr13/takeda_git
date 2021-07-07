<div class="main-content">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-12">
                    <div class="page-header-title" style="text-align: center;">
                        <div class="d-inline">
                            <h5>Report Screening <div id="bulan_name"></div> </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2">
                <div class='form-group' style='width:100% !important'>
                    <button class='btn btn-success btn-lg' onclick="d_excel()" style="padding:3px 11px;background-color: #1D6F42;border:none;font-size:14px">
                        Download Excel
                        <i class='fa fa-file-excel-o' style="margin-left:5px;font-size:15px"></i>
                    </button>
                </div>        
            </div>
            <!-- <div class="col-lg-12 row align-items-end" style="margin-bottom:10px;">
                <div class="col-lg-2">
                    <div class='form-group' style='width:100% !important'>
                        <label for="month">Bulan : </label>
                        <input id="bulan" name="bulan" readonly="" class="form-control"> 
                    </div>
                </div>
                <div class="col-lg-3">
                    <div>
                        <div class='form-group' style='width:100% !important'>
                            <label class='font-noraml' style='font-weight:bold'>Category :</label>
                            <div class='input-group'>
                            <select class='select2_demo_1 form-control' id='judgement'>
                                <option value=''></option>
                                <option value='Tamu'>Visitor</option>
                                <option value='Contractor'>Contractor</option>
                                <option value='Karyawan'>Employee</option>
                                <option value='Outsourcing'>Outsourcing</option>
                            </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div>
                        <div class='form-group' style='width:100% !important'>
                            <label class='font-noraml' style='font-weight:bold'>Judgement :</label>
                            <div class='input-group'>
                            <select class='select2_demo_1 form-control' id='judgement'>
                                <option value=''></option>
                                <option value='very low'>Very Low</option>
                                <option value='low'>Low</option>
                                <option value='moderate'>Moderate</option>
                                <option value='high'>High</option>
                                <option value='very high'>Very High</option>
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
            </div> -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table id="data_table" class="main-table table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th><center><b>No</b></center></th>
                                    <th><center><b>Date</b></center></th>
                                    <th><center><b>Response ID</b></center></th>
                                    <th><center><b>Category</b></center></th>
                                    <th><center><b>Full Name</b></center></th>
                                    <th><center><b>Departement / Company</b></center></th>
                                    <th><center><b>Risk Score</b></center></th>
                                    <th><center><b>Tracing Score</b></center></th>
                                    <th><center><b>Judgement</b></center></th>
                                </tr>
                            </thead>
                            <tbody id="t_body">
                            <?php 
                                $no = 1;
                                foreach($data as $data){
                            ?>
                                <tr>
                                    <td><center><?php echo $no++;?></center></td>
                                    <td><?php echo $data->tgl;?></td>
                                    <td><center><?php echo $data->idResponse;?></center></td>
                                    <td><center><?php echo $data->category;?></center></td>
                                    <td><center><?php echo $data->Nama;?></center></td>
                                    <td><center><?php echo $data->Company;?></center></td>
                                    <td><center><?php echo $data->total_risk;?></center></td>
                                    <td><center><?php echo $data->total_tracing;?></center></td>
                                    <td><center><?php echo $data->judgement;?></center></td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>