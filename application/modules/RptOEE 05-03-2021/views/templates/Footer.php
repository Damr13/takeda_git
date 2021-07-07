<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo base_url('assets/src/js/vendor/jquery-3.3.1.min.js');?>"><\/script>')</script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script>window.jQuery || document.write('<script src="../src/js/vendor/jquery-3.3.1.min.js"><\/script>')</script>
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
        <!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
        <script src="<?php echo base_url(); ?>assets/plugins/datapicker/bootstrap-datepicker.js"></script>

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
        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            // (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            // function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            // e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            // e.src='https://www.google-analytics.com/analytics.js';
            // r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            // ga('create','UA-XXXXX-X','auto');ga('send','pageview');

            // jQuery(document).ready(function() {
            //    jQuery(".main-table").clone(true).appendTo('.table-scroll').addClass('clone'); 


            $(document).ready(function() {
                // jQuery(".main-table").clone(true).appendTo('.table-scroll').addClass('clone'); 

                $('#bulan').datepicker({
                    minViewMode: 1,
                    keyboardNavigation: false,
                    forceParse: false,
                    autoclose: true,
                    todayHighlight: true,
                    format: "mm-yyyy",
                    // endDate : '+1m'
                });

                // reload_table_oee();
            });

            function cari_by_bulan(){
                // var bulan_table = $('#bulan').val();
                // alert(bulan_table)
                reload_table_oee()
            }

            function reload_table_oee()
            {
                var bulan_table = $('#bulan').val();
                var id_machine = $('#id_machine').val();
                if(bulan_table=='' || id_machine==''){
                    swal("PERINGATAN", "Bulan dan Mesin tidak boleh kosong !!!", "warning");
                }else{ 
                    $.ajax({
                        url : '<?php echo base_url('RptOEE/RptOEE_table') ?>',
                        type: "post",
                        data: {bulan:bulan_table,id_machine:id_machine},
                        dataType: "JSON",
                        // beforeSend: function(){
                        //     $('#t_body').html(spinner);
                        // },
                        success : function(data){
                            // alert(data.respone);
                            if(data.respone=='sukses'){
                                $('#bulan_name').html(data.bulan_name);
                                // $('#div_kanban_tabel').show();
                                $('#t_body').html(data.tabel);
                                
                            }else{
                                
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

            function d_excel()
            {
                var bulan_table = $('#bulan').val();
                var id_machine = $('#id_machine').val();
                if(bulan_table == '' || id_machine == ''){
                    swal("PERINGATAN", "Bulan dan Mesin tidak boleh kosong !!!", "warning");
                }else{
                    window.open('<?=site_url('RptOEE')?>/excel?bulan_table='+bulan_table+'&id_machine='+id_machine, '_blank');
                }
                 
            }

            function d_pdf()
            {
                var bulan_table = $('#bulan').val();
                var id_machine = $('#id_machine').val();
                if(bulan_table == '' || id_machine == ''){
                    swal("PERINGATAN", "Bulan dan Mesin tidak boleh kosong !!!", "warning");
                }else{
                    window.open('<?=site_url('RptOEE')?>/pdf?bulan_table='+bulan_table+'&id_machine='+id_machine, '_blank');
                }
                 
            }

        </script>
    </body>
</html>