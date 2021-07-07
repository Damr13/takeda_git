<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo base_url('assets/src/js/vendor/jquery-3.3.1.min.js');?>"><\/script>')</script>
        <script src="<?php echo base_url('assets/plugins/popper.js/dist/umd/popper.min.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/bootstrap/dist/js/bootstrap.min.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/screenfull/dist/screenfull.js');?>"></script>
        <script src="<?php echo base_url('assets/dist/js/theme.min.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/datatables.net/js/jquery.dataTables.min.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js');?>"></script>
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/sweetalert/sweetalert.min.js"></script>

        <script src="<?php echo base_url('assets/js/datatables.js');?>"></script>
        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');

            // ADD YEAR TARGET --ir
            function addYear(){
                swal({
                  title: "Add New Year Target",
                  text: "Are you sure?",
                  type: "info",
                  showCancelButton: true,
                  confirmButtonColor: "#3085d6",
                  confirmButtonText: "Yes, add please!",
                  cancelButtonText: "No!",
                  closeOnConfirm: true,
                  closeOnCancel: false
                },
                function(isConfirm){
                  if (isConfirm) {
                    $.ajax({
                        url : '<?php echo base_url('MstTarget/addYear') ?>',
                        type: "post",
                        dataType: "JSON",
                        success : function(data){
                            if(data.respone=='sukses'){
                                swal("Success", "Add Year success!", "success");
                                location.reload();
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

            // UPDATE TARGET --ir
            function modalEditTarget(id,year,jan,feb,mar,apr,may,jun,jul,aug,sep,oct,nov,dec){
                $('#headerYear').html('Target Year '+year);
                $('#idTarget').val(id);
                $('#jan').val(jan);
                $('#feb').val(feb);
                $('#mar').val(mar);
                $('#apr').val(apr);
                $('#may').val(may);
                $('#jun').val(jun);
                $('#jul').val(jul);
                $('#aug').val(aug);
                $('#sep').val(sep);
                $('#oct').val(oct);
                $('#nov').val(nov);
                $('#dec').val(dec);
                $('#editTarget').show();
            }

            function closeModal(){
                $('#idTarget').val('');
                $('#jan').val('');
                $('#feb').val('');
                $('#mar').val('');
                $('#apr').val('');
                $('#may').val('');
                $('#jun').val('');
                $('#jul').val('');
                $('#aug').val('');
                $('#sep').val('');
                $('#oct').val('');
                $('#nov').val('');
                $('#dec').val('');
                $('#editTarget').hide();
            }
            
            function editTarget(){
                idTarget    = $('#idTarget').val();
                year        = $('#year').val();
                jan         = $('#jan').val();
                feb         = $('#feb').val();
                mar         = $('#mar').val();
                apr         = $('#apr').val();
                may         = $('#may').val();
                jun         = $('#jun').val();
                jul         = $('#jul').val();
                aug         = $('#aug').val();
                sep         = $('#sep').val();
                oct         = $('#oct').val();
                nov         = $('#nov').val();
                dec         = $('#dec').val();

                if(year && idTarget==false){
                    swal("Warning", "Data has not been selected!", "warning");
                }else{
                    // swal(startTime);
                    $.ajax({
                        url : '<?php echo base_url('MstTarget/updateTarget') ?>',
                        type: "post",
                        data: {
                            idTarget:idTarget,
                            year:year,
                            jan:jan,
                            feb:feb,
                            mar:mar,
                            apr:apr,
                            may:may,
                            jun:jun,
                            jul:jul,
                            aug:aug,
                            sep:sep,
                            oct:oct,
                            nov:nov,
                            dec:dec
                        },
                        dataType: "JSON",
                        success : function(data){
                            if(data.respone=='sukses'){
                                $('#idTarget').val('');
                                $('#jan').val('');
                                $('#feb').val('');
                                $('#mar').val('');
                                $('#apr').val('');
                                $('#may').val('');
                                $('#jun').val('');
                                $('#jul').val('');
                                $('#aug').val('');
                                $('#sep').val('');
                                $('#oct').val('');
                                $('#nov').val('');
                                $('#dec').val('');
                                $('#editTarget').hide();
                                swal("Success", "Target has already updated!", "success");
                                location.reload();
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
        </script>
    </body>
</html>