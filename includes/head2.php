 <html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="<?php echo URLROOT; ?>images/cadet.ico">

    <link rel="stylesheet" href="<?php echo URLROOT; ?>assests/plugins/fontawesome-free/css/all.min.css">
    <!-- <link rel="stylesheet" href="<?php echo URLROOT; ?>assests/dist/css/adminlte.min.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet"
        href="<?php echo URLROOT; ?>assests/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="<?php echo URLROOT; ?>assests/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    <!-- other CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>assests/dist/main.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>assests/dist/prism.css">
    <link href="<?php echo URLROOT;?>assests/dist/aos.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.css" integrity="sha512-Woz+DqWYJ51bpVk5Fv0yES/edIMXjj3Ynda+KWTIkGoynAMHrqTcDUQltbipuiaD5ymEo9520lyoVOo9jCQOCA==" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" />

    <link rel="image" type="image/png" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/images/prev.png">
    <link rel="image" type="image/png" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/images/next.png">
    <link rel="image" type="image/gif" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/images/loading.gif">

    <title><?php echo ucfirst(basename($_SERVER['PHP_SELF'], '.php' )) ?>| <?php echo SITENAME; ?></title>
   <style type="text/css">
    body {
        /*background-image: url('../images/banner1.jpg');
     background-attachment: fixed;
     background-repeat: no-repeat;
     background-size: cover;*/
        /* background: radial-gradient(circle at 30% 107%, #fff 0%, #fff 5%, #b82392 45%, #d225a1 60%, #285AEB 90%); */
        background-image:
        linear-gradient(
      to right,
      #004e92,
        #000428,
      rgb(235, 235, 0),
      #004e92
    );
        height: auto !important;
        font-family: Poppins;
        font-size: 18px;



    }

     .bd-placeholder-img {
       font-size: 1.125rem;
       text-anchor: middle;
       -webkit-user-select: none;
       -moz-user-select: none;
       -ms-user-select: none;
       user-select: none;
     }

     @media (min-width: 768px) {
       .bd-placeholder-img-lg {
         font-size: 3.5rem;
       }
     }
 div#load_screen{
       background:#000;
       opacity: 0.9;
       position: fixed;
       z-index: 10;
       top: 0px;
       width: 100%;
       height: 1600px;
     }
     div#load_screen > div#loading{
       position: absolute;
       left: 40%;
       top: 15%;
       margin:0 auto;

     }

     :root {
        --animate-duration: 800ms;
        --animate-delay: 0.9s;
      }
    </style>
    <script type="text/javascript">
    window.addEventListener("load", function(){
      setTimeout(function(){
        var load_screen = document.getElementById("load_screen");
      document.body.removeChild(load_screen);
    },1000);

    });
  </script>
</head>

<body>
  
<div id="load_screen">
      <div id="loading" class="text-center">
        <img src="<?= URLROOT; ?>images/uzb.svg" alt="loading">
      </div>
    </div>

  <div class="container-fluid ">