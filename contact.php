<?php
    require_once 'core/init.php';
    require_once APPROOT . '/includes/head.php';
    require_once APPROOT . '/includes/nav.php';


?>
<style media="screen">
::-webkit-input-placeholder { /* Chrome/Opera/Safari */
color: pink;
}
::-moz-placeholder { /* Firefox 19+ */
color: pink;
}
:-ms-input-placeholder { /* IE 10+ */
color: pink;
}
:-moz-placeholder { /* Firefox 18- */
color: pink;
}
input[type="text"]{
  font-size:15px;
}
input[type="email"]{
  font-size:15px;
}
textarea{
  font-size:15px;
}
</style>
<div class="container">

      <div class="row justify-content-center" style="display:block">
        <div class="col-lg-12">
      <div class="card-group ">
      <div class="card rounded-left"  style="flex-grow:1.4;">
      <h4 class="text-center text-primary mt-2">
      <i class="fas fa-envelope fa-lg"></i>&nbsp;Contact Us
      </h4>
      <hr class="my-3">
      <form class="px-3" action="#" id="contactForm" method="post">
        <div class="row">
        <div class="form-group col-lg-6">
          <input type="text" name="fullName" id="fullName" placeholder="Enter Name *" class="form-control form-control-lg rounded-0">
        </div>
        <div class="form-group col-lg-6">
          <input type="text" name="companyName" id="companyName" placeholder="Enter Your company name" class="form-control form-control-lg rounded-0">

        </div>
        <div class="form-group col-lg-6">
          <input type="text" name="rank/port" id="rank/port" placeholder="Enter Your Rank/Portoflio" class="form-control form-control-lg rounded-0">

        </div>
        <div class="form-group col-lg-6">
          <input type="email" name="email" id="email" placeholder="Enter Your email address" class="form-control form-control-lg rounded-0">

        </div>
        <div class="form-group col-lg-6">
          <input type="text" name="subject" id="subject" placeholder="Enter subject" class="form-control form-control-lg rounded-0">

        </div>
      </div>
      <div class="row">
        <div class="form-group col-lg-12">
          <textarea name="msg" id="msg" rows="8" class="form-control form-control-lg rounded-0" placeholder="Write your message here...">

          </textarea>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-lg-12" id="errorMessage">  </div>
        <div class="clearfix"></div>
        <div class="form-group col-lg-12">
          <button type="submit" name="contBtn" id="contBtn" class="btn  btn-primary btn-sm btn-block">Send</button>
        </div>
      </div>
      </form>
      </div>
      <div class="card justify-content-center rounded-right ucodeColor p-4">
      <h2 class="text-center font-weight-bold text-white">Welcome back Gallant! <br>
      SURE AND STEADFAST   </h2>
      <hr class="my-3 bg-light ucodeHr">
      <p class="font-weight-bold text-light lead">

        <ul>
          <li>
            <span>If you are not a Brigade Officer! leave the company name and rank field blank!</span>

          </li><hr>
          <li>
            <span>We will never publish your email address without your permission!</span>
          </li>
        </ul>
      </p>
      <p class="text-center">
          <img src="<?= URLROOT; ?>images/bbl.jpg" alt="Cadet BBN LOGO" class="img-fluid" width="108px">&nbsp;
          <span class="text-left" style="display:block;"><i class="fas fa-phone-square-alt fa-lg text-danger"></i>&nbsp;08107972754</span>
          <span class="text-left" style="display:block;"><i class="fas fa-phone-square-alt fa-lg text-danger"></i>&nbsp;08107972754</span>
      </p>
      </div>
      </div>

      </div>

      </div>


  </div>



<?php require_once APPROOT . '/includes/footer.php';?>
