<?php
    require_once '../core/init.php';
    require_once APPROOT . '/includes/head2.php';
?>

<div class="container-fluid align-self-center" style="margin:10px !important;">

<!-- //Login -->
<div class="row justify-content-center " id="login-box">
  <div class="col-lg-12">
  <div class="card-group ">
  <div class="card rounded-left"  style="flex-grow:1.4;">
  <h4 class="text-center text-primary">
  <i class="fa fa-user"></i> Sign in to Account
  </h4>
  <hr class="my-3">
  <form  action="#" method="post" id="login-form" class="px-3">
   <div id="logAlert"> </div>
   <div class="form-group">
   <?php
   if (Session::exists('access-denied')) {

       echo '<div class="alert alert-danger alert-dismissible">
             <button type="button" class="close" data-dismiss="alert">
             &times;
             </button>
             <strong class="text-center">'. Session::flash('access-denied') .'</strong>
             </div>';


   }
    ?>
  </div>
 <div class="form-group">
   <span id="error-message" class="text-danger"></span>
 </div>
  <label for="officer_username">Username:</label>
 <div class="input-group input-group-lg form-group">
   <div class="input-group-prepend">
     <span class="input-group-text rounded-0">
     <i class="fas fa-user-lock fa-lg"></i>
   </span>
   </div>
   <input type="text" name="username" id="officer_username" class="form-control rounded-0" placeholder="Your Username"/>
 </div>
 <!-- email  -->
 <div class="input-group input-group-lg form-group">
   <div class="input-group-prepend">
     <span class="input-group-text rounded-0">
     <i class="fa fa-key  fa-lg"></i>
   </span>
   </div>
   <input type="password" name="password" id="Lpassword" class="form-control rounded-0" placeholder="Password">
 </div>
 <div class="form-group">
   <div class="custom-control custom-checkbox float-left">
     <input type="checkbox" name="remember" id="customCheck"  class="custom-control-input"/>
     <label for="customCheck" class="custom-control-label">Remember me</label>
   </div>
   <a href="forgot" class="align-self-center font-weight-bolder float-right" id="forgot-link">Forgotten Password!</a>
 </div>

 <div class="clearfix"> </div>
 <div class="form-group">
   <button type="submit"  id="login-btn" class="btn btn-success btn-lg btn-block ucodeBtn mt-5">Sign In </button>
 </div>
</form>
</div>
<div class="card justify-content-center rounded-right ucodeColor p-4">
<h2 class="text-center font-weight-bold text-white">Welcome back Gallant! <br>
SURE AND STEADFAST   </h2>
<hr class="my-3 bg-light ucodeHr">
<p class="text-center font-weight-bold text-light lead">
  You are about to access your dashboard! Be Nice. <br>
  Don't have an account?
</p>
<a class="btn btn-outline-light btn-lg align-self-center font-weight-bolder mt-4 ucodeLinkBtn" href="register">Sign Up</a>
</div>
</div>

</div>

</div>
</div>
<?php require_once APPROOT . '/includes/footer2.php';?>

<script type="text/javascript">
$(document).ready(function () {

    //Login Ajax Request
      $('#login-btn').click(function(e){
          if ($('#login-form')[0].checkValidity()) {
            e.preventDefault();
            $.ajax({
              url: 'scripts/virus.php',
              method:'POST',
              data: $('#login-form').serialize()+'&action=login',
              beforeSend: function(){
                $("#login-btn").html('<img src="<?= URLROOT;  ?>gif/success.gif">Please wait...');
              },
          success:function(response){
            if ($.trim(response) === 'success') {
              window.location.href = '../index';
            }else{
                $('#logAlert').html(response);
            }
          },
          complete: function(){
            $("#login-btn").html('Sign In');
          }

            });

    }
      });





});
</script>
