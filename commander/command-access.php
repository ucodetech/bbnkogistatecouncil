<?php
require_once '../core/init.php';
require APPROOT .'/includes/authhead.php';

?>
<style media="screen">
  html, body{
    height: 100%;
    font-family:Times New Roman;
    font-size: 18px;
  }
</style>
  <div class="container h-100">
      <div class="row h-100 align-items-center justify-content-center">
        <div class="col-lg-5">
          <div class="card border-danger shadow-lg">
            <div class="card-header bg-danger">
              <h3 class="m-0 text-white">
                <i class="fas fa-user-cog"></i>&nbsp; War Head Fall In
              </h3>
            </div>
            <div class="card-body text-dark">
              <form  action="#" method="post" class="px-3" id="admin-login-form">
                <div class="form-group">
                  <?php
                  if (Session::exists('message')) {
                      echo Session::flash('message');

                  }
                   ?>
                 </div>
                <div class="form-group" id="LogError"> </div>
                <div class="form-group">
                  <input type="text" name="commander-accessName" id="commander-accessName" placeholder="Enter Warhead access name" class="form-control form-control-lg rounded-1" autofocus autocomplete="false">
                </div>
                <div class="form-group">
                  <input type="password" name="commander-accessPassword" id="commander-accessPassword" placeholder="Enter Warhead access password" class="form-control form-control-lg rounded-1" autocomplete="false">
                </div>
                <div class="form-group mt-1">
                  <button type="submit" name="AuthBtn" id="AuthBtn" class="btn btn-danger btn-block btn-lg">Fall In </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>



<?php require APPROOT .'/includes/footer2.php';?>
<script type="text/javascript">
  $(document).ready(function(){

    $('#AuthBtn').click(function(e){
      if ($('#admin-login-form')[0].checkValidity()) {
        e.preventDefault();
        $('#AuthBtn').html('<img src="<?= URLROOT;  ?>gif/trans.gif">Please wait...');
        $.ajax({
          url: 'virus/virus.php',
          method: 'post',
          data: $('#admin-login-form').serialize()+'&action=grant',
          beforeSend: function(){
            $('#AuthBtn').html('<img src="<?= URLROOT;  ?>gif/tra.gif">Please wait...');
            // $('#AuthBtn').prop('disabled', 'true');
          },
          success:function(response){
            if ($.trim(response) === 'granted') {
              window.location = 'index';
            }else{
              $('#LogError').html(response).fadeIn('slow');
              setTimeout(function(){
                $('#LogError').html(response).fadeOut('slow');
              }, 5000);
            }

          },
          complete: function(){
            $('#AuthBtn').html('Fall In');
          }
        });
      }
    });

  });
</script>
