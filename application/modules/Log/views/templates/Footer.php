<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <!-- <script>window.jQuery || document.write('<script src="<?php echo base_url('assets/src/js/vendor/jquery-3.3.1.min.js');?>"></script>')</script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script>window.jQuery || document.write('<script src="../src/js/vendor/jquery-3.3.1.min.js"></script>')</script> -->
        <script src="<?php echo base_url('assets/plugins/popper.js/dist/umd/popper.min.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/bootstrap/dist/js/bootstrap.min.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/screenfull/dist/screenfull.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/sweetalert/dist/sweetalert.min.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/summernote/dist/summernote-bs4.min.js');?>"></script>
        <script src="<?php echo base_url('assets/dist/js/theme.min.js');?>"></script>
        <script src="<?php echo base_url('assets/js/layouts.js');?>"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        <!-- <script src="<?php echo base_url(); ?>assets/plugins/datapicker/bootstrap-datepicker.js"></script> -->
        <!-- <script src="<?php echo base_url('assets/js/datatables.js');?>"></script> -->


        <script src="<?php echo base_url(); ?>assets/inspinia/js/jquery-2.1.1.js"></script>
        <script src="<?php echo base_url(); ?>assets/inspinia/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

        <!-- Custom and plugin javascript -->
        <script src="<?php echo base_url(); ?>assets/inspinia/js/inspinia.js"></script>
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/pace/pace.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/datapicker/bootstrap-datepicker.js"></script>
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/sweetalert/sweetalert.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/select2/select2.full.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.js" type="text/javascript" ></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>


        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            // (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            // function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            // e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            // e.src='https://www.google-analytics.com/analytics.js';
            // r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            // ga('create','UA-XXXXX-X','auto');ga('send','pageview');

            $(document).ready(function() {
                // $('#table_id').DataTable();

                $(function () {
                    $('#startTime').datetimepicker({
                        format: 'HH:mm'
                    });
                });
                $(function () {
                    $('#endTime').datetimepicker({
                        format: 'HH:mm'
                    });
                });     

                $('#date_1').datepicker({
                    // minViewMode: 1,
                    keyboardNavigation: false,
                    forceParse: false,
                    autoclose: true,
                    todayHighlight: true,
                    endDate: 'd',
                    format: "dd-mm-yyyy"
                });

                // $('#date_1').datepicker('setDate', 'today');

                // reload_tabs();
            });

            function hanyaAngka(evt) {
              var charCode = (evt.which) ? evt.which : event.keyCode
               if (charCode > 31 && (charCode < 48 || charCode > 57))
     
                return false;
              return true;
            }


            function cari_by_bulan(){
                reload_tabs();
                // show_data();
            }

            function show_data(){
                var tgl = $('#date_1').val();
                var id_machine = $('#id_machine').val();
                if(tgl=='' || id_machine==''){
                    // swal("PERINGATAN", "Tanggal dan Mesin tidak boleh kosong !!!", "warning");
                }else{
                    // reload_tabs();
                    show_data_tabel(1,id_machine);
                    show_data_tabel(2,id_machine);
                    show_data_tabel(3,id_machine);
                    show_report(1,id_machine);
                    show_report(2,id_machine);
                    show_report(3,id_machine);
                    show_report(4,id_machine);
                    show_report(5,id_machine);
                    show_report(6,id_machine);
                }
            }

            function reload_tabs(){
                var tgl = $('#date_1').val();
                var id_machine = $('#id_machine').val();
                // var id_machine = $('#id_machine').html();
                if(tgl=='' || id_machine==''){
                    swal("PERINGATAN", "Tanggal dan Mesin tidak boleh kosong !!!", "warning");
                }else{
                    $.ajax({
                        url : '<?php echo base_url('Log/cek_data') ?>',
                        type: "post",
                        data: {date:tgl,id_machine:id_machine},
                        dataType: "JSON",
                        // beforeSend: function(){
                        //     $('#t_body').html(spinner);
                        // },
                        success : function(data){
                            // alert(data.respone);
                            if(data.respone=='sukses'){
                                // $('#tabs').html(data.tab);
                                $('#bulan_name').html(data.bulan_name);
                                show_data();
                            }
                            $('#name_machine').html(data.machine_name);
                            // $('#machineTitle').html(data.machine_name);
                            // $('#speedRpm').html(data.speed);
                        },
                        beforeSend: function(){
                            $('#btn_cari').hide();
                            $('#spinner').show();
                            // $('#spinner_tbl').html(spinner);
                        },complete: function(){
                            $('#btn_cari').show();
                            $('#spinner').hide();
                            // $("#spinner_tbl").html('');
                        },
                    });
                }
                
            }

            function show_data_tabel(shift,id_machine){
                var tgl = $('#date_1').val();
                if(tgl==''){

                }else{
                    $.ajax({
                        url : '<?php echo base_url('Log/show_data') ?>',
                        type: "post",
                        data: {date:tgl,shift:shift,id_machine:id_machine},
                        dataType: "JSON",
                        // beforeSend: function(){
                        //     $('#t_body').html(spinner);
                        // },
                        success : function(data){
                            // alert(data.respone);
                            if(data.respone=='sukses'){
                                $(data.table_id).html(data.tab);
                                $('#bulan_name').html(data.bulan_name);
                            }else{
                                $(data.table_id).html(data.tab);
                            }
                        },
                        beforeSend: function(){
                            $('#btn_cari').hide();
                            $('#spinner').show();
                            // $('#spinner_tbl').html(spinner);
                        },complete: function(){
                            $('#btn_cari').show();
                            $('#spinner').hide();
                            // $("#spinner_tbl").html('');
                        },
                    });
                }
                
            }

            // UPDATE DOWNTIME BY TIME RANGE --ir
            function modalUpdateRange(id,shift){
                $('#header_modal_range').html('Pilih Range Time dan Downtime Code');
                $('#idLBRange').val(id);
                $('#modalRangeInput').show();
            }

            function closeModalRange(){
                $('#id_down_range').val('');
                $('#modalRangeInput').hide();
            }
            
            function updateDTRange(){
                idLBRange   = $('#idLBRange').val();
                shift       = $('#shiftRange').val();
                id_down     = $('#id_down_range').val();
                startTime   = $('#startTime').val();
                endTime     = $('#endTime').val();
                technician  = $('#technicianRange').val();

                // alert(id_det_time+' - '+id_down)
                if(id_down==false){
                    swal("WARNING", "Data has not been selected!", "warning");
                }else{
                    // swal(startTime);
                    $.ajax({
                        url : '<?php echo base_url('Log/updateDTRange') ?>',
                        type: "post",
                        data: {idLBRange:idLBRange,id_down:id_down,startTime:startTime,endTime:endTime,technician:technician},
                        dataType: "JSON",
                        success : function(data){
                            if(data.respone=='sukses'){
                                show_data();
                                $('#startTime').val('');
                                $('#endTime').val('');
                                $('#id_down').val('');
                                $('#technicianRange').val('');
                                $('#modalRangeInput').hide();
                                swal("Success", "Data has already saved!", "success");
                                freqBd(idLBRange,shift);
                            }else{
                                swal("ERROR", "Process failed!", "error");
                            }
                        },
                        beforeSend: function(){
                        },complete: function(){
                        },
                    });
                }
            }

            // UPDATE DOWNTIME PER FIVE MINUTES INTERVAL --ir
            function modal_update_code(id_det_time,time,id,shift){
                $('#header_modal').html('Pilih DownTime '+time);
                $('#id_det_time').val(id_det_time);
                $('#idLb').val(id);
                $('#myModal').show();
            }

            function close_modal(){
                $('#id_det_time').val('');
                $('#id_down').val('');
                $('#idLb').val('');
                $('#myModal').hide();
            }

            function update_time(){
                id_det_time = $('#id_det_time').val();
                id_down = $('#id_down').val();
                technician = $('#technician').val();
                id        = $('#idLb').val();
                shift       = $('#shift').val();

                // alert(id_det_time+' - '+id_down)
                if(id_down==false){
                    swal("WARNING", "Data has not been selected!", "warning");
                }else{
                    update_time2(id_det_time,id_down,technician,id,shift)
                }
            }

            function update_time2(id_det_time,id_down,technician,id,shift){
                $.ajax({
                        url : '<?php echo base_url('Log/update_time') ?>',
                        type: "post",
                        data: {id_det_time:id_det_time,id_down:id_down,technician:technician},
                        dataType: "JSON",
                        success : function(data){
                            if(data.respone=='sukses'){
                                show_data();
                                $('#id_det_time').val('');
                                $('#id_down').val('');
                                $('#technician').val('');
                                $('#myModal').hide();
                                swal("Success", "Data has already saved!", "success");
                                freqBd(id,shift);
                            }else{
                                swal("ERROR", "Process failed!", "error");
                            }
                        },
                        beforeSend: function(){
                        },complete: function(){
                        },
                    });
            }

            // ADD PRODUCTS --ir
            function openModalProduct(id,shift){
                $.ajax({
                        url : '<?php echo base_url('Log/getProducts') ?>',
                        type: "post",
                        data: {shift:shift},
                        dataType: "JSON",
                        success : function(data){
                            if(data.respone=='sukses'){
                                $('#idProduct').html(data.option);
                                $('#header_modal_pr').html('Select Products Shift '+shift);
                                $('#id_lb_pr').val(id);
                                $('#modalProduct').show();
                            }else{
                                swal("ERROR", "Error !!!", "error");
                            }
                        },
                        beforeSend: function(){
                        },complete: function(){
                        },
                    });
            }

            function closeModalProduct(){
                $('#id_lb_pr').val('');
                $('#modalProduct').hide();
            }

            function addProduct(){
                id_lb           = $('#id_lb_pr').val();
                idProduct       = $('#idProduct').val();
                productBatch    = $('#productBatch').val();
                productGood     = $('#productGood').val();
                productReject   = $('#productReject').val();
                $.ajax({
                        url : '<?php echo base_url('Log/addProduct') ?>',
                        type: "post",
                        data: {
                            id_lb        :id_lb,
                            idProduct    :idProduct,
                            productBatch :productBatch,
                            productGood  :productGood,
                            productReject:productReject,
                        },
                        dataType: "JSON",
                        success : function(data){
                            if(data.respone=='sukses'){
                                show_data();
                                $('#idProduct').val('');
                                $('#productBatch').val('');
                                $('#productGood').val('');
                                $('#productReject').val('');
                                swal("SUCCESS", "Process Input Product Success!", "success");
                                $('#modalProduct').hide();
                            }else{
                                swal("ERROR", "Process Failed !!!", "error");
                            }
                        },
                        beforeSend: function(){
                        },complete: function(){
                        },
                    });
            }

            function delProduct(id){
                swal({
                  title: "Warning",
                  text: "Are you sure?",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "Yes, Delete!",
                  cancelButtonText: "No!",
                  closeOnConfirm: true,
                  closeOnCancel: false
                },
                function(isConfirm){
                  if (isConfirm) {
                    $.ajax({
                        url : '<?php echo base_url('Log/delProduct') ?>',
                        type: "post",
                        data: {id:id},
                        dataType: "JSON",
                        success : function(data){
                            if(data.respone=='sukses'){
                                swal("SUCCESS", "Delete product success!", "success");
                                show_data();
                            }else{
                                swal("Error", "Process Failed!", "error");
                            }
                        },
                        beforeSend: function(){
                        },complete: function(){
                        },
                    });
                  } else {
                        swal("CANCELED", "Process canceled!", "error");
                  }
                });
            }

            // ADD OPERATOR --ir
            function tambah_operator(id,shift){
                $.ajax({
                        url : '<?php echo base_url('Log/get_operator') ?>',
                        type: "post",
                        data: {shift:shift},
                        dataType: "JSON",
                        success : function(data){
                            if(data.respone=='sukses'){
                                $('#id_op').html(data.option);
                                $('#header_modal_op').html('Pilih Operator Shift '+shift);
                                $('#id_lb_op').val(id);
                                $('#Modal_operator').show();
                            }else{
                                swal("GAGAL", "Gagal !!!", "error");
                            }
                        },
                        beforeSend: function(){
                        },complete: function(){
                        },
                    });
            }

            function close_modal_op(){
                $('#id_lb_op').val('');
                // $('#id_down').val('');
                $('#Modal_operator').hide();
            }

            function tambah_op(){
                id_lb = $('#id_lb_op').val();
                id_op = $('#id_op').val();
                $.ajax({
                        url : '<?php echo base_url('Log/tambah_op') ?>',
                        type: "post",
                        data: {id_lb:id_lb,id_op:id_op},
                        dataType: "JSON",
                        success : function(data){
                            if(data.respone=='sukses'){
                                show_data();
                                $('#id_det_time').val('');
                                $('#id_down').val('');
                                swal("SUCCESS", "Process Input Operator Success!", "success");
                                $('#Modal_operator').hide();
                            }else{
                                swal("GAGAL", "Proses gagal !!!", "error");
                            }
                        },
                        beforeSend: function(){
                        },complete: function(){
                        },
                    });
            }

            function hapus_hist_op(id){
                // alert(id)
                swal({
                  title: "Peringatan",
                  text: "Apakah anda sudah yakin?",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "Ya, Hapus!",
                  cancelButtonText: "Tidak!",
                  closeOnConfirm: true,
                  closeOnCancel: false
                },
                function(isConfirm){
                  if (isConfirm) {
                    hapus_hist_op2(id);
                  } else {
                        swal("BATAL", "Proses dibatalkan", "error");
                  }
                });
            }

            function hapus_hist_op2(id){
                $.ajax({
                    url : '<?php echo base_url('Log/hapus_hist_op') ?>',
                    type: "post",
                    data: {id:id},
                    dataType: "JSON",
                    success : function(data){
                        if(data.respone=='sukses'){
                            show_data();
                        }else{
                            swal("GAGAL", "Proses gagal !!!", "error");
                        }
                    },
                    beforeSend: function(){
                    },complete: function(){
                    },
                });
            }

            // LOCK SHIFT --ir
            function lock(id,shift){
                id_ldr      = $('#id_leader_'+shift).val();
                id_product  = $('#id_product_'+shift).val();
                id_batch    = $('#id_batch_'+shift).val();
                id_baik     = $('#id_baik_'+shift).val();
                id_reject   = $('#id_reject_'+shift).val();
                note  = $('#note_'+shift).val();
                freq_bd     = $('#freq_bd_'+shift).val();
                speed       = $('#speed_'+shift).val();
                // if(id_ldr==false || id_product==false || id_batch==false){
                //     swal("GAGAL", "Leader, Produk dan Batch pada shift "+shift+" belum dipilih !!!", "error");
                // }else{
                    swal({
                      title: "Peringatan",
                      text: "Apakah anda sudah yakin untuk Lock Shift "+shift+" ?",
                      type: "warning",
                      showCancelButton: true,
                      confirmButtonColor: "#DD6B55",
                      confirmButtonText: "Ya, Lock!",
                      cancelButtonText: "Tidak!",
                      closeOnConfirm: true,
                      closeOnCancel: false
                    },
                    function(isConfirm){
                      if (isConfirm) {
                        locking(id);
                      } else {
                            swal("BATAL", "Proses dibatalkan", "error");
                      }
                    });
                // }
            }

            function locking(id){
                $.ajax({
                    url : '<?php echo base_url('Log/lock_shift/') ?>' + 'lock',
                    type: "post",
                    data: {id:id},
                    dataType: "JSON",
                    success : function(data){
                        if(data.respone=='sukses'){
                            show_data();
                        }else{
                            swal("GAGAL", "Proses gagal !!!", "error");
                        }
                    },
                    beforeSend: function(){
                    },complete: function(){
                    },
                });
            }

            // UNLOCK SHIFT --ir
            function unlock(id,shift){
                swal({
                  title: "Peringatan",
                  text: "Apakah anda sudah yakin untuk Unlock Shift "+shift+" ?",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "Ya, Unlock!",
                  cancelButtonText: "Tidak!",
                  closeOnConfirm: true,
                  closeOnCancel: false
                },
                function(isConfirm){
                  if (isConfirm) {
                    unlocking(id);
                  } else {
                        swal("BATAL", "Proses dibatalkan", "error");
                  }
                });
            }

            function unlocking(id){
                $.ajax({
                    url : '<?php echo base_url('Log/lock_shift/') ?>' + 'unlock',
                    type: "post",
                    data: {id:id},
                    dataType: "JSON",
                    success : function(data){
                        if(data.respone=='sukses'){
                            show_data();
                        }else{
                            swal("GAGAL", "Proses gagal !!!", "error");
                        }
                    },
                    beforeSend: function(){
                    },complete: function(){
                    },
                });
            }

            // SAvE SHIFT --ir
            function save(id,shift){
                id_ldr = $('#id_leader_'+shift).val();
                id_product = $('#id_product_'+shift).val();
                id_batch = $('#id_batch_'+shift).val();
                id_baik = $('#id_baik_'+shift).val();
                id_reject = $('#id_reject_'+shift).val();
                note = $('#note_'+shift).val();
                freq_bd = $('#freq_bd_'+shift).val();
                speed = $('#speed_'+shift).val();
                // if(id_ldr==false || id_product==false || id_batch==false){
                //     swal("GAGAL", "Leader, Produk dan Batch pada shift "+shift+" belum dipilih !!!", "error");
                // }else{
                    swal({
                      title: "Peringatan",
                      text: "Apakah anda sudah yakin untuk simpan data Shift "+shift+" ?",
                      type: "warning",
                      showCancelButton: true,
                      confirmButtonColor: "#DD6B55",
                      confirmButtonText: "Ya, Simpan!",
                      cancelButtonText: "Tidak!",
                      closeOnConfirm: true,
                      closeOnCancel: false
                    },
                    function(isConfirm){
                      if (isConfirm) {
                        saving(id,id_ldr,id_product,id_batch,id_baik,id_reject,note,freq_bd,speed);
                      } else {
                            swal("BATAL", "Proses dibatalkan", "error");
                      }
                    });
                // }
            }

            function saving(id,id_ldr,id_product,id_batch,id_baik,id_reject,note,freq_bd,speed){
                $.ajax({
                    url : '<?php echo base_url('Log/save_shift') ?>',
                    type: "post",
                    data: {id:id,id_ldr:id_ldr,id_product:id_product,id_batch:id_batch,id_baik:id_baik,id_reject:id_reject,note:note,freq_bd:freq_bd,speed:speed},
                    dataType: "JSON",
                    success : function(data){
                        if(data.respone=='sukses'){
                            show_data();
                        }else{
                            swal("GAGAL", "Proses simpan gagal !!!", "error");
                        }
                    },
                    beforeSend: function(){
                    },complete: function(){
                    },
                });
            }

            function freqBd(id,shift) {
                $.ajax({
                    url : '<?php echo base_url('Log/countFreqBd') ?>',
                    type: "post",
                    data: {id:id},
                    dataType: "JSON",
                    success : function(data){
                        if(data.respone=='sukses'){
                            show_data();
                        }else{
                            swal("Failed", "Cannot count Frequency Breakdown!", "error");
                        }
                    },
                    beforeSend: function(){
                    },complete: function(){
                    },
                });
            }

            // ========================= Daily Report =========================
            function show_report(id_down,id_machine){
                var tgl = $('#date_1').val();
                if(tgl==''){
                    swal("PERINGATAN", "Tanggal tidak boleh kosong !!!", "warning");
                }else{
                    $.ajax({
                        url : '<?php echo base_url('Log/show_report') ?>',
                        type: "post",
                        data: {date:tgl,id_down:id_down,id_machine:id_machine},
                        dataType: "JSON",
                        success : function(data){
                            if(data.respone=='sukses'){
                                $(data.id_report).html(data.rpt);
                            }else{
                                $(data.id_report).html(data.rpt);
                            }
                        },
                        beforeSend: function(){
                        },complete: function(){
                        },
                    });
                }
                
            }

        </script>
    </body>
</html>