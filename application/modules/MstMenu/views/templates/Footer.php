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
                reload_table();
            });

            function reload_table()
            {
                $.ajax({
                    url : '<?php echo base_url('MstMenu/table') ?>',
                    type: "post",
                    dataType: "JSON",
                    // beforeSend: function(){
                    //     $('#t_body').html(spinner);
                    // },
                    success : function(data){
                        // alert(data.respone);
                        if(data.respone=='sukses'){
                            $('#t_body').html(data.tabel);
                        }
                    },
                    beforeSend: function(){
                        $('#t_body').html('<th colspan="5"></th>');
                    },complete: function(){

                    },
                });
                
            }


            function update_status(id_menu,sts){
                
                $.ajax({
                    url : '<?php echo base_url('MstMenu/update_status') ?>',
                    type: "post",
                    data: {id_menu:id_menu,sts:sts},
                    dataType: "JSON",
                    success : function(data){
                        if(data.respone=='sukses'){
                            reload_table()
                        }else{
                            swal("GAGAL", "Proses gagal !!!", "error");
                        }
                    },
                    beforeSend: function(){
                        
                    },complete: function(){
                        
                    },
                });
            }


            function close_modal(){
                $('#id').val('');
                $('#val').val('');
                $('#icon').val('');
                $('#Modal_update').hide();
            }

            function modal_update_menu(id,val,icon){
                // alert(id+' : '+val+' : '+month);
                $('#id').val(id);
                $('#val').val(val);
                $('#icon').val(icon);
                $('#Modal_update').show();
            }


            function update_menu(){
                var id =$('#id').val();
                var val=$('#val').val();
                var icon=$('#icon').val();
                if(val == '' || icon == ''){
                    swal("PERINGATAN", "Menu dan Icon tidak boleh kosong !!!", "warning");
                }else{
                    $.ajax({
                        url : '<?php echo base_url('MstMenu/update_menu') ?>',
                        type: "post",
                        data: {id:id,val:val,icon:icon},
                        dataType: "JSON",
                        success : function(data){
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

            function close_modal_sub(){
                $('#id_sub').val('');
                $('#val_sub').val('');
                $('#link').val('');
                $('#Modal_update_sub').hide();
            }

            function modal_update_submenu(id,val,link){
                // alert(id+' : '+val+' : '+month);
                $('#id_sub').val(id);
                $('#val_sub').val(val);
                $('#link').val(link);
                $('#Modal_update_sub').show();
            }


            function update_submenu(){
                var id =$('#id_sub').val();
                var val=$('#val_sub').val();
                var link=$('#link').val();
                if(val == '' || link == ''){
                    swal("PERINGATAN", "Menu dan Link tidak boleh kosong !!!", "warning");
                }else{
                    $.ajax({
                        url : '<?php echo base_url('MstMenu/update_submenu') ?>',
                        type: "post",
                        data: {id:id,val:val,link:link},
                        dataType: "JSON",
                        success : function(data){
                            if(data.respone=='sukses'){
                                reload_table()
                                close_modal_sub()
                            }else{
                                close_modal_sub()
                                swal("GAGAL", "Proses gagal !!!", "error");
                            }
                        },
                        beforeSend: function(){
                            
                        },complete: function(){
                            
                        },
                    });
                }
            }

            function close_modal_add_submenu(){
                $('#id_parent').val('');
                $('#nama_submenu').val('');
                $('#link_submenu').val('');
                $('#Modal_add_submenu').hide();
            }

            function add_submenu(id_parent){
                // alert(id+' : '+val+' : '+month);
                $('#id_parent').val(id_parent);
                $('#Modal_add_submenu').show();
            }


            function tambah_submenu(){
                var id_parent =$('#id_parent').val();
                var nama_submenu=$('#nama_submenu').val();
                var link_submenu=$('#link_submenu').val();
                if(nama_submenu == '' || link_submenu == ''){
                    swal("PERINGATAN", "Menu dan Link tidak boleh kosong !!!", "warning");
                }else{
                    $.ajax({
                        url : '<?php echo base_url('MstMenu/tambah_submenu') ?>',
                        type: "post",
                        data: {id_parent:id_parent,nama_submenu:nama_submenu,link_submenu:link_submenu},
                        dataType: "JSON",
                        success : function(data){
                            if(data.respone=='sukses'){
                                reload_table()
                                close_modal_add_submenu()
                            }else{
                                close_modal_add_submenu()
                                swal("GAGAL", "Proses gagal !!!", "error");
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