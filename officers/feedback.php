<?php
require_once '../core/init.php';
 if (!isLoggedInOfficer()) {
      Session::flash('access-denied', 'Access Denied! You must login to access the page');
      Redirect::to('login');
    }
    if (!hasPermission()) {
      Session::flash('access-denied', 'Access Denied! You have permission to access that page');
      Redirect::to('login');
    }
require APPROOT .'/includes/head2.php';
require APPROOT .'/includes/navs.php';
?>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 mt-3">
        <?php if ($officer->verified == 1): ?>
          <div class="card" style="border:1px solid blue">
            <div class="card-header lead text-center bg-primary text-white">
              <i class="fas fa-comment-dots fa-lg"></i>Send Feedback to Admin!
            </div>
            <div class="card-body">
              <form class="px-4" action="#" method="post" id="feedback-form">
                <div class="form-group"> <p id="feedBack-Error"></p>  </div>
                <div class="form-group">
                  <input type="text" name="subject" id="subject" placeholder="Enter Subject" class="form-control form-control-lg rounded-0">
                </div>
                <div class="form-group">
                  <textarea name="feedback" id="feedback" placeholder="Write Feedback....." class="form-control form-control-lg rounded-0" rows="8">

                  </textarea>
                </div>
                <div class="form-group mt-2">
                  <input type="submit" name="feedback" id="feedbackBtn"  class="btn btn-primary btn-block btn-lg" value="Feedback">
                </div>
              </form>
            </div>
          </div>
          <?php else: ?>
            <h3 class="text-light text-center mt-5">You need to verify your email before you can send feedback!</h3>
        <?php endif; ?>
      </div>
    </div>
  </div>

<?php require APPROOT .'/includes/footer2.php'; ?>
<script type="text/javascript">
  $(document).ready(function(){
    //send feedback ajax
    $('#feedbackBtn').click(function(e){
      if($('#feedback-form')[0].checkValidity()){
        e.preventDefault();
          $(this).val('Please wait...');
          $.ajax({
            url: 'scripts/feedback-pro.php',
            method: 'post',
            data: $('#feedback-form').serialize()+'&action=feedback',
            success:function(response){
              if ($.trim(response) === 'true') {
                $('#feedback-form')[0].reset();
                $('#feedbackBtn').val('Feedback');
                  $('#feedBack-Error').html('');
              Swal.fire({
                title: 'Feedback Sent',
                type: 'success'
              });
            }else{
              $('#feedBack-Error').html(response);
            }

            }
          });

      }
    })
  })
</script>

<script type="text/javascript" src="notificationjs.js"></script>
