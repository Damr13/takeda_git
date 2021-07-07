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

    
        <script src="<?php echo base_url(); ?>assets/inspinia/js/inspinia.js"></script>
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/pace/pace.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/datapicker/bootstrap-datepicker.js"></script>
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/sweetalert/sweetalert.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/select2/select2.full.min.js"></script>


        <script src="<?php echo base_url('assets/plugins/amcharts/amcharts.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/amcharts/gauge.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/amcharts/serial.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/amcharts/themes/light.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/amcharts/animate.min.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/amcharts/pie.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/ammap3/ammap/ammap.js');?>"></script>
        <script src="<?php echo base_url('assets/js/chart-amcharts.js');?>"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script> 

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

                $('#tahun').datepicker({
                    format: "yyyy",
                    viewMode: "years", 
                    minViewMode: "years",
                    endDate : 'y'
                });
                // b_chart();
                // reload_table_bd();

            });

            function hanyaAngka(evt) {
              var charCode = (evt.which) ? evt.which : event.keyCode
               if (charCode > 31 && (charCode < 48 || charCode > 57))
     
                return false;
              return true;
            }

            function cari(){
                // alert('ddd')
                cek()
            }

            function cek()
            {
                var tahun = $('#tahun').val(); 
                var compare = $('#compare').val(); 
                if(tahun == '' || compare == ''){
                    swal("PERINGATAN", "Tahun dan Compare tidak boleh kosong !!!", "warning");
                }else{
                    $.ajax({
                        url : '<?php echo base_url('Capex/cek') ?>',
                        type: "post",
                        data: {tahun:tahun,compare:compare},
                        dataType: "JSON",
                        // beforeSend: function(){
                        //     $('#t_body').html(spinner);
                        // },
                        success : function(data){
                            // alert(data.respone);
                            if(data.respone=='sukses'){
                                // $('#tahun_name').html('Tahun : '+data.tahun);
                                // $('#div_kanban_tabel').show();
                                // $('#t_body').html(data.tabel);
                                reload_table();
                                
                            }
                        }
                    });
                }

                
            }

            function reload_table()
            {
                var tahun = $('#tahun').val(); 
                var compare = $('#compare').val(); 
                if(tahun == '' || compare == ''){
                    swal("PERINGATAN", "Tahun dan Compare tidak boleh kosong !!!", "warning");
                }else{
                    $.ajax({
                        url : '<?php echo base_url('Capex/table') ?>',
                        type: "post",
                        data: {tahun:tahun,compare:compare},
                        dataType: "JSON",
                        // beforeSend: function(){
                        //     $('#t_body').html(spinner);
                        // },
                        success : function(data){
                            // alert(data.respone);
                            if(data.respone=='sukses'){
                                if(compare=='plan'){
                                    cmp = 'Plan';
                                }else if(compare=='myc'){
                                    cmp = 'MYC';
                                }else{
                                    cmp = 'LBE';
                                }
                                $('#th_compare').html(cmp);
                                $('#th_compare_ytd').html(cmp);
                                $('#tahun_name').html('Tahun : '+data.tahun);
                                $('#t_body').html(data.tabel);
                                $('#fyb').val(data.fyb);
                                $('#div_fyb').show();
                                $('#div_btn_upd').show();
                                //alert(data.grp);
                                line_chart2(data.grp);


                            }
                        },
                        beforeSend: function(){
                            $('#spinner').show();
                            $('#t_body').html('<th colspan="13"></th>');
                            $('#btn_cari').hide();
                        },complete: function(){
                            $('#spinner').hide();
                            $('#btn_cari').show();
                        },
                    });
                }
                
            }

            function d_excel()
            {
                var tahun = $('#tahun').val(); 
                var compare = $('#compare').val(); 
                if(tahun == '' || compare == ''){
                    swal("PERINGATAN", "Tahun dan Compare tidak boleh kosong !!!", "warning");
                }else{
                    window.open('<?=site_url('Capex')?>/excel?tahun='+tahun+'&compare='+compare, '_blank');
                }
                 
            }

            function d_pdf()
            {
                var tahun = $('#tahun').val(); 
                var compare = $('#compare').val(); 
                if(tahun == '' || compare == ''){
                    swal("PERINGATAN", "Tahun dan Compare tidak boleh kosong !!!", "warning");
                }else{
                    window.open('<?=site_url('Capex')?>/pdf?tahun='+tahun+'&compare='+compare, '_blank');
                }
                 
            }

            function close_modal(){
                $('#id_det').val('');
                $('#val_det').val('');
                $('#f_det').val('');
                $('#Modal_update').hide();
            }

            function modal_update_val(id,val,f_det){
                // alert(id+' : '+val+' : '+month);
                $('#id_det').val(id);
                $('#val_det').val(val);
                $('#f_det').val(f_det);
                $('#Modal_update').show();
            }

            function update(){
                var id =$('#id_det').val();
                var val=$('#val_det').val();
                var f_det=$('#f_det').val();

                var compare=$('#compare').val();
                var tahun=$('#tahun').val();
                if(val == ''){
                    swal("PERINGATAN", "Value tidak boleh kosong !!!", "warning");
                }else{
                    $.ajax({
                        url : '<?php echo base_url('Capex/update_det') ?>',
                        type: "post",
                        // data: {id:id,val:val,f_det:f_det},
                        data: {id:id,val:val,f_det:f_det,compare:compare,tahun:tahun},
                        dataType: "JSON",
                        // beforeSend: function(){
                        //     $('#t_body').html(spinner);
                        // },
                        success : function(data){
                            // alert(data.respone);
                            if(data.respone=='sukses'){
                                reload_table()
                                close_modal()
                            }else{
                                close_modal()
                                swal("GAGAL", "Proses gagal !!!", "error");
                            }
                        },
                        beforeSend: function(){
                            
                        },complete: function(){
                            
                        },
                    });
                }
            }

            function upd_fyb(){
                var tahun = $('#tahun').val(); 
                var fyb = $('#fyb').val(); 
                if(tahun == '' || fyb == ''){
                    swal("PERINGATAN", "Tahun dan Full Year Budget tidak boleh kosong !!!", "warning");
                }else{
                    $.ajax({
                        url : '<?php echo base_url('Capex/update_fyb') ?>',
                        type: "post",
                        data: {tahun:tahun,fyb:fyb},
                        dataType: "JSON",
                        // beforeSend: function(){
                        //     $('#t_body').html(spinner);
                        // },
                        success : function(data){
                            // alert(data.respone);
                            if(data.respone=='sukses'){
                                reload_table()
                                // close_modal()
                            }else{
                                // close_modal()
                                swal("GAGAL", "Proses gagal !!!", "error");
                            }
                        },
                        beforeSend: function(){
                            $('#spinner_upd').show();
                            $('#btn_upd').hide();
                        },complete: function(){
                            $('#spinner_upd').hide();
                            $('#btn_upd').show();
                        },
                    });
                }
            }

        </script>
    </body>
</html>