<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title class="titleModule"></title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/select2.min.css');?>">
        
        <link rel="icon" href="<?php echo base_url('favicon.png');?>" type="image/x-icon" />
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">
        
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap/dist/css/bootstrap.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/fontawesome-free/css/all.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/ionicons/dist/css/ionicons.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/icon-kit/dist/css/iconkit.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/theme.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css');?>">
        <link href="<?php echo base_url(); ?>assets/inspinia/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
        <script src="<?php echo base_url('assets/src/js/vendor/modernizr-2.8.3.min.js');?>"></script>

        <link href="<?php echo base_url(); ?>assets/inspinia/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/inspinia/font-awesome/css/font-awesome.css" rel="stylesheet">

        <!-- Toastr style -->
        <link href="<?php echo base_url(); ?>assets/inspinia/css/plugins/toastr/toastr.min.css" rel="stylesheet">

        <link href="<?php echo base_url(); ?>assets/inspinia/css/animate.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/inspinia/css/style.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/inspinia/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/inspinia/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/inspinia/css/plugins/select2/select2.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-datetimepicker.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-select.min.css');?>">
        
        <script src="<?php echo base_url('assets/src/js/vendor/modernizr-2.8.3.min.js');?>"></script>

        <!-- EDITOR QUILL -->
        <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
    </head>

    <style>
      .wrapper{
        padding:0px !important;
      }
      
      .app-sidebar{
        width:200px !important;
      }

      .app-sidebar span{
        font-size:11px !important;
      }

      .datepicker.dropdown-menu th, .datepicker.dropdown-menu td {
			  padding: 4px 1px !important;
			}

      .modal {
        overflow: inherit !important;
      }

      .modal-body{
        overflow-y: auto;
      }
      
      #modalPart label{
        padding-top:20px;
      }

      .btnModalSort {
        color : black;
        align : center;
      }

      thead th{
        /* background: linear-gradient(to right, #000428, #004e92) !important; */
        background-color: #004e92 !important;
        color: #f0f0f0 !important;
      }

      .btn-primary{
        background: linear-gradient(to right, #000428, #004e92) !important;
        border: 1px white;
      }

      .btn-warning{
        background-color: #F7971E !important;
        border: 1px white;
      }

      .btn-success{
        background-color: #000428 !important;
        border: 1px white;
      }

      .btn-info{
        background-color: #004e92 !important;
        border: 1px white;
      }

      .btn-danger{
        background-color: #D7263D !important;
        border: 1px white;
      }

      .btn-default{
        background-color: #999999 !important;
        border: 1px white;
      }

      tr:nth-child(even){
        background-color: #f0f0f0;
      }

      tr:nth-child(even) .btnPlus, tr:nth-child(even) .btnMinus, tr:nth-child(even) .btnOrder{
        background-color: white;
      }


    </style>