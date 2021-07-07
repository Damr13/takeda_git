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
                    minViewMode: "years"
                    // endDate : '+1m'
                });
                // b_chart();
                // reload_table_bd();
            });

            function cari(){
                // var bulan_table = $('#bulan').val();
                // alert(bulan_table)
                reload_table_bd()
            }

            function reload_table_bd()
            {
                var tahun = $('#tahun').val(); 
                var id_machine = $('#id_machine').val();
                var group_downtime = $('#group_downtime').val(); 
                if(tahun == '' || id_machine == ''){
                    swal("PERINGATAN", "Year,Machine dan Downtime tidak boleh kosong !!!", "warning");
                }else{
                    $.ajax({
                        url : '<?php echo base_url('BreakDowntime/BreakDowntime_table') ?>',
                        type: "post",
                        data: {tahun:tahun,id_machine:id_machine,group_downtime:group_downtime},
                        dataType: "JSON",
                        // beforeSend: function(){
                        //     $('#t_body').html(spinner);
                        // },
                        success : function(data){
                            // alert(data.respone);
                            if(data.respone=='sukses'){
                                $('#tahun_name').html('Tahun : '+data.tahun);
                                // $('#div_kanban_tabel').show();
                                $('#t_body').html(data.tabel);
                                $('#id_jdl').html(data.jdl);
                                b_chart(data.d_chart);
                            }
                        },
                        beforeSend: function(){
                            $('#spinner').show();
                            $('#t_body').html('<th colspan="14"></th>');
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
                var id_machine = $('#id_machine').val();
                var group_downtime = $('#group_downtime').val(); 
                if(tahun == '' || id_machine == ''){
                    swal("PERINGATAN", "Year,Machine dan Downtime tidak boleh kosong !!!", "warning");
                }else{
                    window.open('<?=site_url('BreakDowntime')?>/excel?tahun='+tahun+'&id_machine='+id_machine+'&group_downtime='+group_downtime, '_blank');
                }
                 
            }

            function d_pdf()
            {
                var tahun = $('#tahun').val(); 
                var id_machine = $('#id_machine').val();
                var group_downtime = $('#group_downtime').val(); 
                if(tahun == '' || id_machine == ''){
                    swal("PERINGATAN", "Year,Machine dan Downtime tidak boleh kosong !!!", "warning");
                }else{
                    window.open('<?=site_url('BreakDowntime')?>/pdf?tahun='+tahun+'&id_machine='+id_machine+'&group_downtime='+group_downtime, '_blank');
                }
                 
            }

            function b_chart(d_chart){
                var obj = jQuery.parseJSON(JSON.stringify(d_chart));
                var chart = AmCharts.makeChart( "capa_chart", {
                    "type": "serial",
                    "theme": "light",
                    "dataProvider": [ 
                        {
                            "month": "Jan",
                            "value": obj.Jan
                        },{
                            "month": "Feb",
                            "value": obj.Feb
                        },{
                            "month": "Mar",
                            "value": obj.Mar
                        },{
                            "month": "Apr",
                            "value": obj.Apr
                        },{
                            "month": "May",
                            "value": obj.May
                        },{
                            "month": "Jun",
                            "value": obj.Jun
                        },{
                            "month": "Jul",
                            "value": obj.Jul
                        },{
                            "month": "Aug",
                            "value": obj.Aug
                        },{
                            "month": "Sep",
                            "value": obj.Sep
                        },{
                            "month": "Oct",
                            "value": obj.Oct
                        },{
                            "month": "Nov",
                            "value": obj.Nov
                        },{
                            "month": "Des",
                            "value": obj.Des
                        },
                    ],
                    "valueAxes": [ {
                        "gridColor": "#FFFFFF",
                        "gridAlpha": 0.2,
                        "dashLength": 0
                    } ],
                    "gridAboveGraphs": true,
                    "startDuration": 1,
                    "graphs": [ {
                        "balloonText": "[[category]]: <b>[[value]]</b>",
                        "fillAlphas": 0.8,
                        "lineAlpha": 0.2,
                        "type": "column",
                        "valueField": "value"
                    } ],
                    "chartCursor": {
                        "categoryBalloonEnabled": false,
                        "cursorAlpha": 0,
                        "zoomable": false
                    },
                    "categoryField": "month",
                    "categoryAxis": {
                        "gridPosition": "start",
                        "gridAlpha": 0,
                        "tickPosition": "start",
                        "tickLength": 20
                    },
                    "export": {
                        "enabled": true
                    }
                } );

            
            }

        </script>
    </body>
</html>