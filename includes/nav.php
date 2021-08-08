<style media="screen">
  .identity{
    background-image: url('slider/top.JPG');
   background-attachment: fixed;
   background-position: center;
   background-repeat: no-repeat;
   background-size:contain;
   height: 300px !important;
   position: relative;

  }
  .bg-cadet2{
    position: relative; /* Position the background text */
      background: rgb(0, 0, 0); /* Fallback color */
      background: rgba(0, 0, 0, 0.5); /* Black background with 0.5 opacity */
      color: #f1f1f1; /* Grey text */
      width: 100%; /* Full width */
      height: auto;
      padding: 28px; /* Some padding */
  }
</style>
<div class="container-fluid bg-light my-auto py-lg-3"  style="min-height:100px !important;">
  <div class="row" >
    <div class="col-md-3">
      <img src="<?= URLROOT; ?>images/BBNSTATE.png" alt="STATE BBN LOGO" class="img-fluid" width="108px">
    </div>
    <div class="col-md-6 m-0 p-0 px-0 py-0 text-center">
    <h2 class="text-center text-primary">THE BOYS' BRIGADE KOGI STATE COUNCIL</h2><hr class="hrs">
      <div class="row text-center">
        <div class="form-group col-md-3">
          <a class="btn btn-info btn-sm rounded-5" href="officers/login">
            <i class="fa fa-sign-in fa-lg"></i>
            &nbsp;Login
          </a>
        </div>
        <div class="form-group col-md-3">
          <a class="btn btn-info btn-sm rounded-5"href="officers/register">
            <i class="fa fa-user-plus fa-lg"></i>
            &nbsp;Register
          </a>
        </div>
      </div>
    </div>
    <div class="col-md-3 text-center">
      <span class="text-center">Follow Us:</span><hr class="hrs">
        <div class="display-4 m-0 ">
          <a href="#" class="text-primary icon"><i class="fa fa-facebook-square"></i> </a>&nbsp;
          <a href="#" class="text-info icon"><i class="fa fa-twitter-square "></i> </a>&nbsp;
          <a href="#" class="text-warning icon"><i class="fa fa-instagram"></i> </a>&nbsp;
          <a href="#" class="text-success icon"><i class="fa fa-whatsapp"></i> </a>
        </div>
        <style media="screen">
          .icon{
            font-size: 40px;
          }
        </style>
        <!-- <div class="display-4 px-2">
          <a class="btn btn-warning btn-lg btn-block" href="#" >Donate To Cadet</a>

        </div> -->

    </div>
  </div>
</div>

 <nav class="navbar navbar-expand-md navbar-primary   bg-primary">
   <div class="container-fluid">
     <a class="navbar-brand text-light <?= (basename($_SERVER['PHP_SELF']) == 'index') ? 'active' : ''; ?>"
         href="<?php echo URLROOT; ?>">
          <?php echo NAVNAME; ?>
     </a>
   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
     <span class="navbar-toggler-icon"><i class="fa fa-toggler text-light"></i>   </span>
   </button>
   <div class="collapse navbar-collapse" id="navbarCollapse">
     <ul class="navbar-nav mr-auto">
       <li class="nav-item active">
         <a class="nav-link text-light <?= (basename($_SERVER['PHP_SELF']) == 'index') ? 'active' : ''; ?>"
             href="<?php echo URLROOT; ?>index"><i class="fas fa-home"></i>&nbsp;Home</a>
       </li>
       <li class="nav-item">
           <a class="nav-link text-light <?= (basename($_SERVER['PHP_SELF']) == 'about') ? 'active' : ''; ?>"
               href="<?php echo URLROOT; ?>about"><i class="fas fa-info-circle"></i>&nbsp;About Us</a>
       </li>
       <li class="nav-item">
           <a class="nav-link text-light <?= (basename($_SERVER['PHP_SELF']) == 'contact') ? 'active' : ''; ?>"
               href="<?php echo URLROOT; ?>contact"><i class="fas fa-phone"></i>&nbsp;Contact Us</a>
       </li>
       <li class="nav-item">
           <a class="nav-link text-light <?= (basename($_SERVER['PHP_SELF']) == 'gallery') ? 'active' : ''; ?>"
               href="<?php echo URLROOT; ?>gallery"><i class="fa fa-braille"></i>&nbsp;Gallery</a>
       </li>
         <li class="nav-item">
           <a class="nav-link text-light <?= (basename($_SERVER['PHP_SELF']) == 'awards') ? 'active' : ''; ?>"
               href="<?php echo URLROOT; ?>awards"><i class="fa fa-trophy"></i>&nbsp;Award winners</a>
       </li>
     </ul>
     <div class="navbar-nav">
         <?php if (isLoggedInOfficer()): ?>
          <li class="nav-item">
             <a class="nav-link text-light <?= (basename($_SERVER['PHP_SELF']) == 'dashboard') ? 'active' : ''; ?>"
                 href="<?php echo URLROOT; ?>officers/dashboard"><i class="fas fa-user-circle"></i>&nbsp;Dashboard</a>
         </li>
           <?php else: ?>
            <li class="nav-item">
             <a class="nav-link text-light <?= (basename($_SERVER['PHP_SELF']) == 'access') ? 'active' : ''; ?>"
                 href="<?php echo URLROOT; ?>officers/login"><i class="fa fa-sign-in"></i>&nbsp;Sign In</a>
         </li>
         <?php endif ?>


     </div>
   </div>
 </div>
 </nav>
<div class="container-fluid mt-3">
