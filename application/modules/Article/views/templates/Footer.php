<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo base_url('assets/src/js/vendor/jquery-3.3.1.min.js');?>"><\/script>')</script>
        <script src="<?php echo base_url('assets/plugins/popper.js/dist/umd/popper.min.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/bootstrap/dist/js/bootstrap.min.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/screenfull/dist/screenfull.js');?>"></script>
        <script src="<?php echo base_url('assets/dist/js/theme.min.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/datatables.net/js/jquery.dataTables.min.js');?>"></script>
        <script src="<?php echo base_url('assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js');?>"></script>
        <script src="<?php echo base_url('assets/js/datatables.js');?>"></script>
        <!-- SUMMERNOTE -->
        <script src="<?php echo base_url('assets/js/summernote/summernote.min.js');?>"></script>
        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
                // $('.summernote').summernote();
                $('.summernote').summernote({
                    height: '200px',
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear','fontname']],
                        ['color', ['color']],
                        ['fontsize', ['fontsize']],
                        ['height', ['height']],
                        ['style', ['style']],
                        ['para', ['ul', 'ol', 'paragraph']],  
                        ['misc', ['fullscreen','undo','redo']],
                        ['table', ['table']]
                    ]
                });
            });
        </script>
    </body>
</html>