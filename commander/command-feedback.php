<?php
require_once '../core/init.php';
if (!isCommanderGranted()) {
  Session::flash('message', 'Access Denied!');
  Redirect::to('command-access');

}
if (!hasPermissionCaptian()) {
  Session::flash('message', 'Access Denied! You can\'t access that page!');
  Redirect::to('command-dashboard');

}

require APPROOT .'/includes/Panelhead.php';
require APPROOT .'/includes/Panelnav.php';

?>

<div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="card my-2 border-success">
              <div class="card-header bg-warning text-white">
                <h4 class="m-0"><i class="fas fa-comment-dots"></i>Total Feedback From Officers</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive" id="showAlFeed">
                  <p class="text-center align-self-center lead"><img src="<?= URLROOT;  ?>gif/success.gif"> Please Wait...</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div><!-- /.container-fluid -->
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- Display feedback in a details modal -->
    <div class="modal fade" id="showFeedDetailsModal">
      <div class="modal-dialog modal-dialog-centered mw-100 w-50 modal-lg">
        <div class="modal-content" id="feedBack">


        </div>
      </div>
    </div>

<!-- //REply feedback -->
<div class="modal fade" id="replyModal">
  <div class="modal-dialog modal-dialog-centered mw-100 w-50 modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">
        Reply This Feedback
        </h3>
        <button type="button" class="close" data-dismiss="modal" name="button">&times;</button>
      </div>
      <div class="modal-body">
        <form class="px-3" action="#" method="post" id="reply-feedback-form">
          <div class="form-group">
            <textarea name="message" id="message" class="form-control" rows="6" placeholder="Message here" required autofocus="true">
            </textarea>
          </div>
          <div class="form-group">
            <input type="submit" id="replyBtn" value="Send Reply" class="btn btn-success btn-block btn-lg">
          </div>
        </form>
      </div>

    </div>
  </div>
</div>



<?php   require APPROOT .'/includes/Panelfooter.php';?>
<script type="text/javascript">
  $(document).ready(function(){

    fetchFeedback();
    function fetchFeedback(){
      $.ajax({
        url: 'virus/feedback-init.php',
        method: 'post',
        data: {action: 'fetchAllFeed'},
        success:function(response){
          $('#showAlFeed').html(response);
          $('#show').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
             "lengthMenu": [[5,10, 25, 50, -1], [10, 25, 50, "All"]]
          });

        }

      });
    }

//Display user in details ajax request
$("body").on("click", ".userDetailsIcon", function(e){
  e.preventDefault();

  details_id = $(this).attr('id');
  $.ajax({
    url: 'virus/feedback-init.php',
    method: 'post',
    data: {details_id: details_id},
    success:function(response){
      $('#others').html(response);
    }
  });
});

//Delete users

$("body").on("click", ".feedBackdeleteBtn", function(e){
    e.preventDefault();
    delfed_id = $(this).attr('id');
    Swal.fire({
        title: 'Are you sure?',
        text: "You can revert this action",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: 'virus/feedback-init.php',
            method: 'POST',
            data: {delfed_id: delfed_id},
            success:function(response){
              Swal.fire(
                'Feedback  Deleted!',
                'Feedback Deleted Successfully!',
                'success'
              )
              fetchFeedback();
            }
          });

        }
      });

});




//Display user in details ajax request
$("body").on("click", ".feedBackinfoBtn", function(e){
  e.preventDefault();

  feeddetails_id = $(this).attr('id');
  $.ajax({
    url: 'virus/feedback-init.php',
    method: 'post',
    data: {feeddetails_id: feeddetails_id},
    success:function(response){
      $('#feedBack').html(response);
    }
  });
});

//GEt current selected user id and feedback id
var officerid;
var feedid;
$('body').on('click', '.replyFeedbackIcon', function(e){
  $('#showFeedDetailsModal').modal('hide');
  officerid = $(this).attr('id');
  feedid = $(this).attr('fid');
});
  //SEnd feedback reply to the user ajax request
    $('#replyBtn').click(function(e){
      if($('#reply-feedback-form')[0].checkValidity()){
        let message = $("#message").val();
        e.preventDefault();
        $("#replyBtn").val('Please wait...');
        $.ajax({
          url: 'virus/feedback-init.php',
          method: 'post',
          data: {officerid: officerid, message : message, feedid : feedid},
          success:function(response){
            $("#replyBtn").val('Send Reply');
            $('#replyModal').modal('hide');
            $('#reply-feedback-form')[0].reset();
            Swal.fire(
              'Sent!',
              'Reply Sent Successfully to the user!',
              'success'
            )
              fetchFeedback();
          }
        })
      }
    })



  });
</script>
