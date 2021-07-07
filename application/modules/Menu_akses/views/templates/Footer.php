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

            $(document).ready(function() {
                // reload_table();
            });

            function cari()
            {
                reload_table();
            }

            function reload_table()
            {
                var id_level =$('#id_level').val();
                $.ajax({
                    url : '<?php echo base_url('Menu_akses/table') ?>',
                    type: "post",
                    data: {id_level:id_level},
                    dataType: "JSON",
                    // beforeSend: function(){
                    //     $('#t_body').html(spinner);
                    // },
                    success : function(data){
                        // alert(data.respone);
                        if(data.respone=='sukses'){
                            $('#t_body').html(data.tabel);
                        }
                        $('#div_btn_add_menu_akses').show();
                    },
                    beforeSend: function(){
                        $('#spinner').show();
                        $('#t_body').html('<th colspan="3"></th>');
                        $('#btn_cari').hide();
                    },complete: function(){
                        $('#spinner').hide();
                        $('#btn_cari').show();
                    },
                });
                
            }


            function close_modal_add_menu(){
                $('#header_add_menu').val('');
                $('#id_level_add_menu').val('');
                $('#id_add_menu').val('');
                $('#Modal_add_menu').hide();
            }

            function add_menu_akses()
            {
                var id_level =$('#id_level').val();
                $.ajax({
                    url : '<?php echo base_url('Menu_akses/add_menu_akses') ?>',
                    type: "post",
                    data: {id_level:id_level},
                    dataType: "JSON",
                    // beforeSend: function(){
                    //     $('#t_body').html(spinner);
                    // },
                    success : function(data){
                        // alert(data.respone);
                        if(data.respone=='sukses'){
                            // alert(data.option)
                            $('#header_add_menu').html(data.nama_level);
                            $('#id_level_add_menu').val(id_level);
                            $('#id_add_menu').html(data.option);
                            $('#Modal_add_menu').show();
                        }
                        // $('#div_btn_add_menu_akses').show();
                    },
                    beforeSend: function(){
                        // $('#spinner').show();
                        // $('#t_body').html('<th colspan="3"></th>');
                        // $('#btn_cari').hide();
                    },complete: function(){
                        // $('#spinner').hide();
                        // $('#btn_cari').show();
                    },
                });
                
            }


            function add_menu(){
                var id_level = $('#id_level_add_menu').val();
                var id_menu = $('#id_add_menu').val();
                
                // var create = 0;
                // if($('#create').prop('checked') == true ){
                //     create = 1;
                // }

                // var update = 0;
                // if($('#update').prop('checked') == true ){
                //     update = 1;
                // }

                // var deletee = 0;
                // if($('#delete').prop('checked') == true ){
                //     deletee = 1;
                // }

                // alert(create)
                $.ajax({
                    url : '<?php echo base_url('Menu_akses/add_menu') ?>',
                    type: "post",
                    // data: {id_level:id_level,id_menu:id_menu,create:create,update:update,deletee:deletee},
                    data: {id_level:id_level,id_menu:id_menu},
                    dataType: "JSON",
                    success : function(data){
                        if(data.respone=='sukses'){
                            reload_table()
                            close_modal_add_menu()
                        }else{
                            swal("GAGAL", "Proses gagal !!!", "error");
                        }
                    },
                    beforeSend: function(){
                        
                    },complete: function(){
                        
                    },
                });
            }


            function close_modal_add_submenu(){
                $('#header_add_submenu').val('');
                $('#id_level_add_submenu').val('');
                $('#id_add_submenu').val('');
                $('#Modal_add_submenu').hide();
            }

            function add_submenu_akses(parent)
            {
                var id_level =$('#id_level').val();
                $.ajax({
                    url : '<?php echo base_url('Menu_akses/add_submenu_akses') ?>',
                    type: "post",
                    data: {id_level:id_level,parent:parent},
                    dataType: "JSON",
                    // beforeSend: function(){
                    //     $('#t_body').html(spinner);
                    // },
                    success : function(data){
                        // alert(data.respone);
                        if(data.respone=='sukses'){
                            // alert(data.option)
                            $('#header_add_submenu').html(data.nama_level);
                            $('#id_level_add_submenu').val(id_level);
                            $('#id_add_submenu').html(data.option);
                            $('#Modal_add_submenu').show();
                        }
                        // $('#div_btn_add_menu_akses').show();
                    },
                    beforeSend: function(){
                        // $('#spinner').show();
                        // $('#t_body').html('<th colspan="3"></th>');
                        // $('#btn_cari').hide();
                    },complete: function(){
                        // $('#spinner').hide();
                        // $('#btn_cari').show();
                    },
                });
                
            }

            function add_submenu(){
                var id_level = $('#id_level_add_submenu').val();
                var id_menu = $('#id_add_submenu').val();

                var create = 0;
                if($('#create').prop('checked') == true ){
                    create = 1;
                }

                var update = 0;
                if($('#update').prop('checked') == true ){
                    update = 1;
                }

                var deletee = 0;
                if($('#delete').prop('checked') == true ){
                    deletee = 1;
                }

                $.ajax({
                    url : '<?php echo base_url('Menu_akses/add_submenu') ?>',
                    type: "post",
                    data: {id_level:id_level,id_menu:id_menu,create:create,update:update,deletee:deletee},
                    dataType: "JSON",
                    success : function(data){
                        if(data.respone=='sukses'){
                            reload_table()
                            close_modal_add_submenu()
                        }else{
                            swal("GAGAL", "Proses gagal !!!", "error");
                        }
                    },
                    beforeSend: function(){
                        
                    },complete: function(){
                        
                    },
                });
            }


            function hapus_menu_akses(id){
                $.ajax({
                    url : '<?php echo base_url('Menu_akses/hapus_menu_akses') ?>',
                    type: "post",
                    data: {id:id},
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



        </script>
    </body>
</html>