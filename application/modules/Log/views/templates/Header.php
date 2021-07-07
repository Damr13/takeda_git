<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Log Book</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
        
        <link rel="icon" href="<?php echo base_url('favicon.png');?>" type="image/x-icon" />
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">
        
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap/dist/css/bootstrap.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/fontawesome-free/css/all.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/ionicons/dist/css/ionicons.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/icon-kit/dist/css/iconkit.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/theme.min.css');?>">
        <!-- <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/log.css');?>"> -->
        <!-- <link href="<?php echo base_url(); ?>assets/plugins/datapicker/datepicker3.css" rel="stylesheet"> -->
        <script src="<?php echo base_url('assets/src/js/vendor/modernizr-2.8.3.min.js');?>"></script>
        <!-- <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css');?>"> -->

        <link href="<?php echo base_url(); ?>assets/inspinia/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/inspinia/font-awesome/css/font-awesome.css" rel="stylesheet">

        <!-- Toastr style -->
        <link href="<?php echo base_url(); ?>assets/inspinia/css/plugins/toastr/toastr.min.css" rel="stylesheet">

        <link href="<?php echo base_url(); ?>assets/inspinia/css/animate.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/inspinia/css/style.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/inspinia/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/inspinia/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/inspinia/css/plugins/select2/select2.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css" rel="stylesheet"/>
        <script src="<?php echo base_url('assets/src/js/vendor/modernizr-2.8.3.min.js');?>"></script>


        <style type="text/css">
          /*.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
              color: #e3e7ea !important;
              background-color: #404e67 !important;
              border-color: #dee2e6 #dee2e6 #fff !important;
          }*/
          .datepicker.dropdown-menu th, .datepicker.dropdown-menu td {
              padding: 4px 1px !important;
          }

          label {
              margin-bottom: 0% !important;
          }

          .form-group {
              margin-bottom: 10px !important;
          }

          table tr td {
              height: 35px !important;
          }

          .slimScrollBar{
            width: 7% !important;
          }

            html, body{
              margin:0;
              padding:0;
              height:100%;
            }
            section {
              position: relative;
              border: 1px solid #000;
              padding-top: 37px;
              background: #404e67;
            }
            section.positioned {
              position: absolute;
              top:100px;
              left:100px;
              width:800px;
              box-shadow: 0 0 15px #333;
            }
            .container {
              overflow-y: auto;
              height: 400px;
            }
            table {
              border-spacing: 0;
              width:100%;
            }
            td + td {
              border-left:1px solid #eee;
            }
            td{
              border-bottom:1px solid #eee;
              background: #ddd;
              color: #000;
              padding: 10px 25px;
            }
            /*th {
              height: 0;
              line-height: 0;
              padding-top: 0;
              padding-bottom: 0;
              color: transparent;
              border: none;
              white-space: nowrap;
            }*/
            /*th div{
              position: absolute;
              background: transparent;
              color: #fff;
              padding: 9px 25px;
              top: 0;
              margin-left: -25px;
              line-height: normal;
              border-left: 1px solid #fff;
            }
            th:first-child div{
              border: none;
            }*/
        </style>
    </head>