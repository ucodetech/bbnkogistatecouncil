
<?php
 require APPROOT . '/views/includes/head.php';
 require APPROOT . '/views/includes/nav.php';
 ?>

<div class="container-fluid">
    <div class="row">
      <div class="col-md-3">

      </div>
      <div class="col-md-6">
        <?php  if (Session::exists('success-reg')){
         echo '<div class="alert alert-success">'.Session::flash('success-reg').'</div>';

          } ?>
      </div>
      <div class="col-md-3">

      </div>
    </div>
    <div class="text-center">

<p>Thanks for registrating with us. please check your email for verification</p>
	 <p>If you don't see the email check your spam folder</p>
	<div class="text-center text-success" style="font-size:80px">
	<i class="fa fa-envelope"></i>
    </div>
  </div>
</div>
<style media="screen">
  .row{
    margin-top: 10px;
  }
</style>

<?php require APPROOT . '/views/includes/footer.php'; ?>
