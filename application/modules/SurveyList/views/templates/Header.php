<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Survey List</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="icon" href="<?php echo base_url('favicon.png');?>" type="image/x-icon" />

        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">
        
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap/dist/css/bootstrap.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/fontawesome-free/css/all.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/ionicons/dist/css/ionicons.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/icon-kit/dist/css/iconkit.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/theme.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/log.css');?>">
        <script src="<?php echo base_url('assets/src/js/vendor/modernizr-2.8.3.min.js');?>"></script>
        <link href="<?php echo base_url(); ?>assets/plugins/datapicker/datepicker3.css" rel="stylesheet">

        <link href="<?php echo base_url(); ?>assets/inspinia/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/inspinia/font-awesome/css/font-awesome.css" rel="stylesheet">

        <!-- Toastr style -->
        <link href="<?php echo base_url(); ?>assets/inspinia/css/plugins/toastr/toastr.min.css" rel="stylesheet">

        <link href="<?php echo base_url(); ?>assets/inspinia/css/animate.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/inspinia/css/style.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/inspinia/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/inspinia/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/inspinia/css/plugins/select2/select2.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css');?>">
        
        
    </head>

    <style type="text/css">
        table, th, td {
          padding: 0;
        }
        .main-content {
            height: 2000px !important;
        }
        .btn-lg {
            padding: 3px 10px;
        }
        .table-scroll {
            position:relative;
            max-width:100%;
            margin:auto;
            overflow:hidden;
            border:1px solid #000;
        }
        .table-wrap {
            width:100%;
            overflow:auto;
        }
        .table-scroll table {
            width:100%;
            margin:auto;
            border-collapse:separate;
            border-spacing:0;
        }
        .table-scroll th, .table-scroll td {
            padding:5px 10px;
            border:1px solid #000;
            background:#fff;
            white-space:nowrap;
            vertical-align:top;
        }
        .table-scroll thead, .table-scroll tfoot {
          background:#f9f9f9;
        }
        .clone {
          position:absolute;
          top:0;
          left:0;
          pointer-events:none;
        }
        .clone th, .clone td {
          visibility:hidden
        }
        .clone td, .clone th {
          border-color:transparent
        }
        .clone tbody th {
          visibility:visible;
          color:red;
        }
        .clone .fixed-side {
          border:1px solid #000;
          background:#eee;
          visibility:visible;
        }
        .clone thead, .clone tfoot {
					background:transparent;
				}
        td {
          text-align: left !important;
        }
        .button-location ul {
          display: flex;
					list-style-type: none;
					padding: 0 14px;
					margin-bottom: 0;
					margin-top: 15px;
        }
        .button-location ul li{
          padding: 5px 15px;
          font-size: 13px;
					font-weight: 700;
					color: #282828;
					border: 2px solid #A1A1A1;
					margin: 0 5px;
					border-radius: 13px;
        }

        #visitor_table {
          display: block;
        }
        #contractor_table {
          display: none;
        }
        #employee_table {
          display: none;
        }
        #outsourcing_table {
          display: none;
        }
        .btn-search-ehs {
          background-color: #d40113;
          color: #fff;
          font-weight: 600;
        }
        .btn-excel-ehs {
          background-color: #5cb85c;
          color: #fff;
        }
    }
    </style>

    