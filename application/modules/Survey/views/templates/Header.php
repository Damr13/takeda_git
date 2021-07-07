<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title class="titleSurvey"></title>
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
        <link rel="stylesheet" href="<?php echo base_url('assets/plugins/fontawesome-free/css/all.min.css');?>">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    </head>

    <style>
        body{
          /* background: linear-gradient(to right, #642b73, #c6426e); */
          background: linear-gradient(to right, #000428, #004e92) fixed;
          /* background: linear-gradient(to right, #005C97, #363795); */
          /* background: linear-gradient(to right, #2410DF, #FFFF06);
          background: linear-gradient(to right, #160986, #E0E000); */
        }

      /* INPUT LINE STYLE --ir*/
        .inputStyle {
          display: block;
          width: auto;
          max-width: 100%;
          height: 60px;
          border: 0;
          background-color: #ffffff;
          border-bottom-left-radius: 41px;
          border-bottom-right-radius: 41px;
          border-top-left-radius: 41px;
          border-top-right-radius: 0;
          box-shadow: 0 17px 40px 0 rgba(75, 128, 182, 0.07);
          margin-bottom: 22px;
          position: relative;
          font-size: 13px;
          color: #a7b4c1;
          transition: opacity 0.2s ease-in-out, filter 0.2s ease-in-out, box-shadow 0.1s ease-in-out;
        }

        .inputStyle:hover {
          box-shadow: 0 14px 44px 0 rgba(0, 0, 0, 0.077);
        }

        .inputStyle input {
          position: absolute;
          border: 0;
          box-shadow: none;
          background-color: rgba(255, 255, 255, 0);
          top: 0;
          height: 50px;
          width: 100%;
          padding: 0 40px;
          box-sizing: border-box;
          z-index: 3;
          display: block;
          color: black;
          font-size: 17px;
          font-family: "Oxygen", sans-serif;
          transition: top 0.1s ease-in-out;
        }

        .inputStyle input::placeholder {
          color: rgba(0, 0, 0, 0);
        }

        .inputStyle input:focus,
        .inputStyle input:not(:placeholder-shown) {
          top: 15px;
        }

        .inputStyle label {
          position: absolute;
          border: 0;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          z-index: 2;
          display: flex;
          align-items: center;
          padding: 0 40px;
          box-sizing: border-box;
          transition: all 0.1s ease-in-out;
          cursor: text;
        }

        .inputStyle input:focus + label,
        .inputStyle input:not(:placeholder-shown) + label {
          bottom: 20px;
          font-size: 10px;
          opacity: 0.7;
        }

        .req-mark {
          position: absolute;
          pointer-events: none;
          top: 0;
          right: 33px;
          bottom: 0;
          display: flex;
          align-items: center;
          justify-content: flex-end;
          font-size: 22px;
          color: #e0e0e0;
          font-family: "Ubuntu", sans-serif;
        }

        .radioAns input[type="checkbox"], .radioAns input[type="radio"], .radioAns label {
          cursor: pointer;
        }

        .textarea {
          margin-top:10px;
          display: block;
          width: 100%;
          overflow: hidden;
          resize: both;
          min-height: 40px;
          line-height: 20px;
          box-shadow: 0 3px 3px 0 rgba(0, 0, 0, 0.3);
          border-radius:5px;
          font-weight:800;
          padding: 10px;
        }

        .textarea[contenteditable]:empty::before {
          color: gray;
        }

        /* .ratingAns > input {
          float: right;
        } */

        .ratingAns > label {
          color: #90A0A3;
          float: left;
        }
        
        .ratingAns > label:after {
          margin: 5px;
          font-size: 1.5em;
          font-family: FontAwesome;
          content: "\f005";
          display: inline-block;
        }
        
        .ratingAns > input {
          display: none;
        }
        
        .ratingAns > label:hover{
          color: #FFD200;
        }
        
        .ratingAns > input:checked + label{
          font-size: 2em;
          color: #F7971E;
        }
        
        /* .ratingAns > input:checked + label:hover,
        .ratingAns > input:checked ~ label:hover,
        .ratingAns > label:hover ~ input:checked ~ label,
        .ratingAns > input:checked ~ label:hover ~ label {
          color: #FFD200;
        } */

        /* .ratingAns > input:checked ~ label,
        .ratingAns:not(:checked) > label:hover,
        .ratingAns:not(:checked) > label:hover ~ label {
          color: #F7971E;
        }
        
        .ratingAns > input:checked + label:hover,
        .ratingAns > input:checked ~ label:hover,
        .ratingAns > label:hover ~ input:checked ~ label,
        .ratingAns > input:checked ~ label:hover ~ label {
          color: #FFD200;
        } */
      /* END -- INPUT LINE STYLE --ir */

      /* BUTTON STYLE --ir */
        .btnPage{
          padding: 10px 50px;
          margin:10px 4px;
          color: #fff;
          font-family: sans-serif;
          text-transform: uppercase;
          text-align: center;
          position: relative;
          text-decoration: none;
          display:inline-block;
          background: transparent!important;
        }

        .btnPage{
          font-family: "proxima-nova", sans-serif;
          font-weight: 500;
          font-size: 13px;
          text-transform: uppercase!important;
          letter-spacing: 2px;
          color: #fff;
          cursor: hand;
          text-align: center;
          text-transform: capitalize;
          border: 1px solid black;
          border-radius:50px;
          position: relative;
          overflow: hidden!important;
          -webkit-transition: all .3s ease-in-out;
          -moz-transition: all .3s ease-in-out;
          -o-transition: all .3s ease-in-out;
          transition: all .3s ease-in-out;
          background: transparent!important;
          z-index:10;
        	box-shadow:2px 0px 14px rgba(0,0,0,.3);

        }
        
        .btnPage:hover{
          border: none;
        	color: white!important;
        }

        .btnPage::before {
          content: '';
          width: 0%;
          height: 100%;
          display: block;
          background: #071982;
          position: absolute;
        	-ms-transform: skewX(-20deg);
          -webkit-transform: skewX(-20deg); 
          transform: skewX(-20deg);   
          left: -10%;
          opacity: 1;
          top: 0;
          z-index: -12;
          -moz-transition: all .7s cubic-bezier(0.77, 0, 0.175, 1);
          -o-transition: all .7s cubic-bezier(0.77, 0, 0.175, 1);
          -webkit-transition: all .7s cubic-bezier(0.77, 0, 0.175, 1);
          transition: all .7s cubic-bezier(0.77, 0, 0.175, 1);
        	box-shadow:2px 0px 14px rgba(0,0,0,.6);
        } 

        .btnPage::after {
          content: '';
          width: 0%;
          height: 100%;
          display: block;
          background: #80ffd3;
          position: absolute;
        	-ms-transform: skewX(-20deg);
          -webkit-transform: skewX(-20deg); 
          transform: skewX(-20deg);   
          left: -10%;
          opacity: 0;
          top: 0;
          z-index: -15;
          /* -webkit-transition: all .94s cubic-bezier(.2,.95,.57,.99);
          -moz-transition: all .4s cubic-bezier(.2,.95,.57,.99);
          -o-transition: all .4s cubic-bezier(.2,.95,.57,.99); */
          transition: all .4s cubic-bezier(.2,.95,.57,.99);
          box-shadow: 2px 0px 14px rgba(0,0,0,.6);
        }

        .prevBtn::before, .welcomeBtn::before{
          background: #F7971E;
        }

        .prevBtn::after, .welcomeBtn::after {
          background: #FFD200;
        }

        .nextBtn::before, .thanksBtn::before {
          background: #000428;
        }

        .nextBtn::after, .thanksBtn::after {
          background: #004e92;
        }

        .loader {
          border: 16px solid #f3f3f3;
          border-radius: 50%;
          border-top: 16px solid #3498db;
          width: 120px;
          height: 120px;
          -webkit-animation: spin 2s linear infinite;
          animation: spin 2s linear infinite;
          margin:auto;
          left:0;
          right:0;
          top:0;
          bottom:0;
          position:fixed;
          z-index: 100;   
        }

        @-webkit-keyframes spin {
          0% { -webkit-transform: rotate(0deg); }
          100% { -webkit-transform: rotate(360deg); }
        }

        @keyframes spin {
          0% { transform: rotate(0deg); }
          100% { transform: rotate(360deg); }
        }

        .overlay {
          content: "";
          background-color: black;
          opacity: 0.5;
          top: 0;
          left: 0;
          bottom: 0;
          right: 0;
          height: 100%;
          overflow: auto;
          position: fixed;
          z-index: 99;   
        }

        .btnPage:hover::before, .btn1O:hover::before{
          opacity:1;
          width: 116%;
        }
        .btnPage:hover::after, .btn1O:hover::after{
        	opacity:1;
        	width: 120%;
        }
        
        /* .btnPage span  {
          display: inline-block;
          padding: 18px 60px;
          border-radius: 25px;
          position: relative;
          z-index: 2;
          will-change: transform, filter;
          transform-style: preserve-3d;
          transition: all 0.3s; 
          vertical-align: middle;
          background: linear-gradient(to left, #52A0FD 0%, #00e2fa 80%, #00e2fa 100%);
        }

        .btnPage:hover span {
          filter: brightness(1.05) contrast(1.05);
          transform: scale(0.95);
          background: linear-gradient(to right, #52A0FD 0%, #00e2fa 80%, #00e2fa 100%);
        } */
      /* END -- BUTTON STYLE --ir */

      /* TEXT STYLE --ir */
        .questBox h2 b{
          font-weight:900 !important;
          color:black;
        }
      /* END -- TEXT STYLE --ir */

      /* PAGE STYLE --ir */
        hr{
          margin:10px 0;
          border-top:1px solid;
        }
      /* END -- PAGE STYLE --ir */

      #surveyTitle{
        padding: 0 30px 10px 30px;
      }

      #boxSurvey{
        margin: 0 auto\; /* Added */
        float: none; /* Added */
        margin-bottom: 10px; /* Added */ 
        padding: 0 300px;
      }

      .card {
        border-radius: 25px;
        background-color: #fffafa;
        background-color: transparent;
        text-align: center;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.26), 0 6px 12px rgba(0, 0, 0, 0.33);
      }  

      .card .card-header {
        background-color: #fffafa;
        border-radius: 30px 30px 0 0 !important;
        border-bottom: 20px solid grey !important;
        margin-bottom: 5px;
      }    

      .card .card-body {
        background-color: transparant;
        padding:0;
      }   

      .card .card-body .questBox {
        background-color: #fffafa;
        padding:5% 15%;
        margin:10px 0;
        border-radius:10px;
      }    

      .card .card-footer {
        background-color: #fffafa;
        border-radius: 0 0 30px 30px !important;
        border-top: 20px solid grey !important;
        margin-top: 5px;
      }

      .card .card-footer div {
        margin:0 20%;
      }    

      .lineAns{
        margin-right: auto;
        margin-left: auto;
      }

      .radioAns, .checkAns, .ratingAns{
        display: table;
        margin-right: auto;
        margin-left: auto;
        text-align: left;
      }        
      
      .datepicker.dropdown-menu th, .datepicker.dropdown-menu td {
			  padding: 4px 1px !important;
			}
      
      /* TABLET, DLL --ir */
      @media only screen and (max-width: 1024px) {
        #boxSurvey{
          padding: 0px;
        }
      }

      /* TABLET, DLL --ir */
      @media only screen and (max-width: 670px) {
        #boxSurvey{
          padding: 0px;
        }

        #surveyTitle{
          font-size: 20px;
        }

        .pageTitle{
          font-size: 18px;
          padding-top:0px;
        }

        .card .card-body .questBox{
          padding:5% 10%;
        }

        .questBox b{
          font-size: 15px;
          font-weight: 1200;
        }
        
        .inputStyle input, .inputStyle label{
          font-size:10px
        }

        .card .card-footer div{
          margin: 0px 7%;
        }

        .btnPage{
          padding:10px 25px;
          font-size:10px;
        }

        .radioAns, .checkAns{
          font-size:11px;
        }

        .ratingAns > label:before{
          font-size:1.5em;
        }

      }

    </style>