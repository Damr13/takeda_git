<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Master Employee</title>
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
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css');?>">
        <script src="<?php echo base_url('assets/src/js/vendor/modernizr-2.8.3.min.js');?>"></script>
    </head>
    
    <style>
        .table-responsive-emp {
            display: block;
            width: 100%;
        }
        .table-scroll {
            position:relative;
            max-width:100%;
            margin:auto;
        }
        .table-wrap {
            width:100%;
        }
        .table-scroll table {
            width:100%;
            margin:auto;
            border-collapse:separate;
            border-spacing:0;
        }
        .table-scroll th, .table-scroll td {
            padding:5px 10px;
            /* background:#fff; */
            white-space:nowrap;
            vertical-align:top;
        }

        /* Button Add Master Employee */
        .button-emp {
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            padding: 8px ​14px;
            margin-bottom: 1rem;
            list-style: none;
            background-color: #ea4c62;
            border-radius: .25rem;
        }
        .btn-emp {
            color: #fff;
            font-size:14px;
            font-weight:700;
            height:auto;
            background-color: #ea4c62;
            border: 1px solid #ea4c62;
        }
        .btn-emp:hover {
            background-color: #fff;
            border: 1px solid #ea4c62;
            color: #ea4c62;
        }
    </style>
    