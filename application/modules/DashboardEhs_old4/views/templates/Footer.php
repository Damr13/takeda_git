                <!-- <footer class="footer">
                    <div class="w-100 clearfix">
                        <span class="text-center text-sm-left d-md-inline-block">Copyright © 2020 Takeda Indonesia v1.0. All Rights Reserved.</span>
                        <span class="float-none float-sm-right mt-1 mt-sm-0 text-center">Developed<i class="fa fa-heart text-danger"></i> By <a href="https://digitaloptima.id/" class="text-dark" target="_blank">Digital Optima Integra</a></span>
                    </div>
                </footer> -->
            </div>
        </div>
        
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo base_url('assets/src/js/vendor/jquery-3.3.1.min.js');?>"><\/script>')</script>
        <script src="<?php echo base_url('assets/plugins/popper.js/dist/umd/popper.min.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/bootstrap/dist/js/bootstrap.min.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/screenfull/dist/screenfull.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/datatables.net/js/jquery.dataTables.min.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/jvectormap/jquery-jvectormap.min.js');?>"></script>
        <!-- <script src="<?php echo base_url('assets/plugins/jvectormap/tests/assets/jquery-jvectormap-world-mill-en.js');?>"></script> -->
        <script src="<?php echo base_url('assets/plugins/moment/moment.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/d3/dist/d3.min.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/c3/c3.min.js');?>"></script>
        <script src="<?php echo base_url('assets/js/tables.js');?>"></script>
        <script src="<?php echo base_url('assets/js/widgets.js');?>"></script>
        <!-- <script src="<?php echo base_url('assets/js/charts.js');?>"></script> -->
        <script src="<?php echo base_url('assets/dist/js/theme.min.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/flot-charts/jquery.flot.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/flot-charts/jquery.flot.categories.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/flot-charts/jquery.flot.pie.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/flot-charts/curvedLines.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/flot-charts/jquery.flot.tooltip.min.js');?>"></script>
        <!-- <script src="dist/js/theme.min.js"></script> -->
        <script src="<?php echo base_url('assets/js/chart-flot.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/amcharts/amcharts.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/amcharts/gauge.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/amcharts/serial.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/amcharts/themes/light.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/amcharts/animate.min.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/amcharts/pie.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/ammap3/ammap/ammap.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/ammap3/ammap/maps/js/usaLow.js');?>"></script>
        <!-- <script src="dist/js/theme.min.js"></script> -->
        <script src="<?php echo base_url('assets/js/chart-amcharts.js');?>"></script>
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/datapicker/bootstrap-datepicker.js"></script>
        <script src="<?php echo base_url(); ?>assets/inspinia/js/plugins/sweetalert/sweetalert.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.js" type="text/javascript" ></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');

            $('#dateStart, #dateFinish').datepicker({
              // minViewMode: 1,
              keyboardNavigation: false,
              forceParse: false,
              autoclose: true,
              todayHighlight: true,
              endDate: 'd',
              format: "yyyy-mm-dd"
            });
            
            $('#dateStart2, #dateFinish2').datepicker({
              // minViewMode: 1,
              keyboardNavigation: false,
              forceParse: false,
              autoclose: true,
              todayHighlight: true,
              endDate: 'd',
              format: "yyyy-mm-dd"
            });

            // $('#dateStart2, #dateFinish2').datepicker({
            //   // minViewMode: 1,
            //   // keyboardNavigation: false,
            //   // forceParse: false,
            //   // autoclose: true,
            //   // todayHighlight: true,
            //   endDate: 'mm',
            //   format: "mm-yyyy",
            //   startView: "months", 
            //   minViewMode: "months"
            // });

            $('#tahun_budget').datepicker({
                format: "yyyy",
                viewMode: "years", 
                minViewMode: "years",
                endDate : 'y'
            });
        </script>
    </body>
</html>