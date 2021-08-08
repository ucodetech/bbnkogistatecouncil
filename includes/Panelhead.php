<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="icon" type="image/png" href="<?php echo URLROOT; ?>images/cadet.ico">

    <?php
      $title = basename($_SERVER['PHP_SELF'], '.php');
      $title = explode('-', $title);
      $title = ucfirst($title[1]);
     ?>
    <title><?php echo $title; ?>|<?php echo ADMIN;?></title>
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo URLROOT;?>assests/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo URLROOT;?>assests/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="<?php echo URLROOT;?>assests/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT;?>assests/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<link rel="stylesheet" href="<?php echo URLROOT; ?>assests/dist/warhead.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>assests/dist/prism.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css">
    <link rel="image/png" href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.png">

  <style type="text/css">
    body{
  color: #000;
  font-family: Poppins;
}
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
