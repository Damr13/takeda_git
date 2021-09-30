<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Takeda EHS Dashboard</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="icon" href="<?php echo base_url('favicon.png'); ?>" type="image/x-icon" />

        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">
        
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap/dist/css/bootstrap.min.css')?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/fontawesome-free/css/all.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/icon-kit/dist/css/iconkit.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/ionicons/dist/css/ionicons.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/jvectormap/jquery-jvectormap.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/weather-icons/css/weather-icons.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/c3/c3.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/owl.carousel/dist/assets/owl.carousel.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/owl.carousel/dist/assets/owl.theme.default.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/theme.min.css');?>">
        <script src="<?php echo base_url('assets/src/js/vendor/modernizr-2.8.3.min.js');?>"></script>

        <link href="<?php echo base_url(); ?>assets/inspinia/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/inspinia/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css" rel="stylesheet"/>
        <script src="<?php echo base_url('assets/src/js/vendor/modernizr-2.8.3.min.js');?>"></script>
        
        <style type="text/css">
            #table-dept .table-bordered td {
                border: 1px solid #5b5b5b;
            }
            #table-depts .table-bordered td {
                border: 1px solid #5b5b5b;
            }
            .date-picker .dropdown-menu {
                min-width: 200px;
            }
            .bg-warnings {
                background-color: #ea4c62 !important;
            }
            .btn-primarys {
                background-color: #ea4c62;
                border: 1px solid #ea4c62;
                color: #fff;
            }
            .btn-primarys:hover, .btn-primarys:focus, .btn-primarys.active {
                background-color: #fff;
                border: 1px solid #ea4c62;
                color: #ea4c62 !important;
            }
            .btn-primarys:hover {
                color: #ea4c62;
                background-color: #fff;
                border-color: #bb2e42;
            }
            .loaders {
                color: #ea4c62;
                font-size: 90px;
                text-indent: -9999em;
                overflow: hidden;
                width: 1em;
                height: 1em;
                border-radius: 50%;
                margin: 72px auto;
                position: relative;
                -webkit-transform: translateZ(0);
                -ms-transform: translateZ(0);
                transform: translateZ(0);
                -webkit-animation: load6 1.7s infinite ease, round 1.7s infinite ease;
                animation: load6 1.7s infinite ease, round 1.7s infinite ease;
                }
                @-webkit-keyframes load6 {
                0% {
                    box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
                }
                5%,
                95% {
                    box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
                }
                10%,
                59% {
                    box-shadow: 0 -0.83em 0 -0.4em, -0.087em -0.825em 0 -0.42em, -0.173em -0.812em 0 -0.44em, -0.256em -0.789em 0 -0.46em, -0.297em -0.775em 0 -0.477em;
                }
                20% {
                    box-shadow: 0 -0.83em 0 -0.4em, -0.338em -0.758em 0 -0.42em, -0.555em -0.617em 0 -0.44em, -0.671em -0.488em 0 -0.46em, -0.749em -0.34em 0 -0.477em;
                }
                38% {
                    box-shadow: 0 -0.83em 0 -0.4em, -0.377em -0.74em 0 -0.42em, -0.645em -0.522em 0 -0.44em, -0.775em -0.297em 0 -0.46em, -0.82em -0.09em 0 -0.477em;
                }
                100% {
                    box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
                }
                }
                @keyframes load6 {
                0% {
                    box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
                }
                5%,
                95% {
                    box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
                }
                10%,
                59% {
                    box-shadow: 0 -0.83em 0 -0.4em, -0.087em -0.825em 0 -0.42em, -0.173em -0.812em 0 -0.44em, -0.256em -0.789em 0 -0.46em, -0.297em -0.775em 0 -0.477em;
                }
                20% {
                    box-shadow: 0 -0.83em 0 -0.4em, -0.338em -0.758em 0 -0.42em, -0.555em -0.617em 0 -0.44em, -0.671em -0.488em 0 -0.46em, -0.749em -0.34em 0 -0.477em;
                }
                38% {
                    box-shadow: 0 -0.83em 0 -0.4em, -0.377em -0.74em 0 -0.42em, -0.645em -0.522em 0 -0.44em, -0.775em -0.297em 0 -0.46em, -0.82em -0.09em 0 -0.477em;
                }
                100% {
                    box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
                }
                }
                @-webkit-keyframes round {
                0% {
                    -webkit-transform: rotate(0deg);
                    transform: rotate(0deg);
                }
                100% {
                    -webkit-transform: rotate(360deg);
                    transform: rotate(360deg);
                }
                }
                @keyframes round {
                0% {
                    -webkit-transform: rotate(0deg);
                    transform: rotate(0deg);
                }
                100% {
                    -webkit-transform: rotate(360deg);
                    transform: rotate(360deg);
                }
            }
            /* Loaders */
            .loadersa {
            background: #6c757d; 
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            opacity: 0.3;
            filter: alpha(opacity=30);
            z-index: 9999;
            }
            .loaders-text {
                border-color: #95B8E7;
            }
            .loaders-text {
                background: #ffffff url(assets/inspinia/css/plugins/loading.gif) no-repeat scroll 5px center;
            }
            .loaders-text {
                position: absolute;
                top: 50%;
                margin-top: -20px;
                padding: 10px 5px 10px 30px;
                width: auto;
                height: 16px;
                border-width: 2px;
                border-style: solid;
                z-index: 999999;
            }
        </style>
    </head>