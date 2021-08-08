<?php
    require_once '../core/init.php';
    require_once APPROOT . '/includes/head2.php';
?>

<!-- //forget password -->
<div class="row justify-content-center " id="forgot-box">
  <div class="col-lg-12">
<div class="card-group ">
<div class="card rounded-left"  style="flex-grow:1.4;">
<h4 class="text-center text-primary">
<i class="fa fa-user"></i> Reset Password
</h4>
<p class="text-center text-secondary lead">Enter Your registered E-mail address! and We will send an instruction on how to reset your password!</p>
<hr class="my-3">
<form  action="#" method="post" id="forgot-form" class="px-3">
 <div id="forgotAlert"> </div>
 <div class="form-group">
   <span id="error-message" class="text-danger"></span>
 </div>
 <div class="input-group input-group-lg form-group">
   <div class="input-group-prepend">
     <span class="input-group-text rounded-0">
     <i class="fa fa-envelope  fa-lg"></i>
   </span>
   </div>
   <input type="email" name="email" id="reset-email"
   class="form-control rounded-0" placeholder="E-mail">
   <span class="invalid-feedback"></span>
 </div>


 <div class="clearfix"> </div>
 <div class="form-group">
   <button type="submit"  id="reset-btn" class="btn btn-success btn-lg btn-block ucodeBtn">Request Reset Link</button>
 </div>
</form>
</div>
<div class="card justify-content-center rounded-right ucodeColor p-4">
<h2 class="text-center font-weight-bold text-white">Welcome back Gallant! <br>
SURE AND STEADFAST   </h2>
<hr class="my-3 bg-light ucodeHr">
<p class="text-center font-weight-bold text-light lead">
  It Seems you forgot your access code! <br>
</p>

</div>
</div>

</div>

</div>




<?php require_once APPROOT . '/includes/footer2.php';?>

<script type="text/javascript">
$(document).ready(function () {
      $('#reset-btn').click(function(e){
        if ($("#reset-form")[0].checkValidity()) {
          e.preventDefault();
          $("#reset-btn").html('<img src="images/success.gif"> Please wait...');
          $.ajax({
            url: 'action.php',
            method: 'post',
            data: $("#reset-form").serialize()+'&action=forgot',
            success:function(response){
              $("#reset-btn").html('<img src="images/success.gif"> Please wait...');
              $('#reset-form')[0].reset();
              $("#reset-btn").html('Reset Password');
              $("#forAlert").html(response);
            }
          });
        }
      });


});
</script>
