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


$db = new CadetConsole();

?>

<div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <?php
          if (Session::exists('updated')) {
          echo ' <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert">
                  &times;
                  </button>
                  <strong class="text-center">'.Session::flash('updated') .'</strong>
                  </div>';
          }
         ?>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
      <div class="col-lg-12">
        <div class="card rounded-0 mt-3 border-primary">
          <div class="card-header border-primary">
            <ul class="nav nav-tabs card-header-tabs">
              <li class="nav-item">
                <a href="#AwardTable" class="nav-link active font-weight-bold" data-toggle="tab">Award</a>
              </li>
              <li class="nav-item">
                <a href="#addAward" class="nav-link  font-weight-bold" data-toggle="tab">Add Award</a>
              </li>

            </ul>
          </div>
          <div class="card-body">
            <div class="tab-content">

              <!-- tutorial tab content start -->
              <div class="tab-pane container active" id="AwardTable">
                <div class="col-lg-12">
              <div class="card">
                <h4 class="card-header bg-success px-3">Award</h4>
                <div class="card-body">
                  <div class="table-responsive" id="showAward">
                    <p class="text-center align-self-center lead"><img src="<?= URLROOT;  ?>gif/success.gif"> Please Wait...</p>

                  </div>
                </div>
              </div>
            </div>
              </div>
          <!--start of add tut form tab content -->
               <div class="tab-pane container fade" id="addAward">
                    <div class="col-lg-12">
              <div class="card">
                <h4 class="card-header bg-info border-info"><i class="fas fa-plus-circle fa-lg"></i>&nbsp;Add Award</h4>
                <div class="card-body">

                  <hr>
                  <form class="px-3" action="#" method="post" id="add_award_form" enctype="multipart/form-data">
                    <div class="form-group">
                      <h2 id="awardAlert"></h2>
                    </div>

                      <div class="form-group col-lg-12">
                        <div class="form-group" id="imageAlert">  </div>

                        <div class="progress form-group" style="border-radius:20px; ">
                        <div class="progress-bar" style="border-radius:20px;"></div>
                        </div>
                        <div class="form-group col-md-12">
                          <div class="custom-file">
                           <input type="file" name="award_image[]" id="award_image"
                           class="custom-file-input" multiple>
                            <label for="file" class="custom-file-label">Select Files (Award image)</label>
                         </div>
                        </div>
                        <div class="row">

                    <div class="form-group col-md-6">
                      <label for="award_name">Name Of Winner</label>
                      <input type="text" name="award_name" id="award_name" placeholder="Enter Award Name" class="form-control form-control-lg">
                    </div>

                    <div class="form-group col-md-6">
                      <label for="award_event_title">Award Ttitle</label>
                      <input type="text" name="award_event_title" id="award_event_title" placeholder="Enter Title of award" class="form-control form-control-lg">
                    </div>

                    <div class="form-group col-md-6">
                      <label for="award_description">Description</label>
                      <textarea  name="award_description" id="award_description" placeholder="Write...." class="form-control form-control-lg" rows="8">

                      </textarea>
                    </div>
                    <div class="clearfix">  </div>
                    <div class="form-group col-md-12">
                      <input type="submit" id="addAwardBtn" value="Add Ward" class="btn btn-info btn-lg btn-block px-2">
                    </div>
                  </div>
                  </form>
                </div>
              </div>
            </div>

               </div>
                 <!-- end of add tut form tab content -->

               <!--End of add source  tab content -->

            </div>
          </div>
        </div>
      </div>
    </div>
          <!-- Start view Modal -->
            <div class="modal fade" id="showAwardDetails">
              <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header bg-primary">
                    <h4 class="modal-title text-light"><i class="fas fa-info-circle fa-lg"></i>&nbsp; Award Details</h4>
                    <button type="button" name="button" class="close text-light" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body text-primary" id="FetchAwardDetails">

                  </div>
                </div>


              </div>
            </div>
          <!-- End view modal -->

        </div>
      </div><!-- /.container-fluid -->
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>

<?php   require APPROOT .'/includes/Panelfooter.php';?>
<script type="text/javascript">
  $(document).ready(function(){

      $('input[type="file"]').change(function(e){
       // var fileName = e.target.files[0].name;
       $('#imageAlert').html('Files have been selected.')
   });



    $('#add_award_form').submit(function(e){
        e.preventDefault();
        $.ajax({
          xhr: function() {
             var xhr = new window.XMLHttpRequest();
             xhr.upload.addEventListener("progress", function(evt) {
                 if (evt.lengthComputable) {
                     var percentComplete = ((evt.loaded / evt.total) * 100);
                     $(".progress-bar").width(percentComplete + '%');
                     $(".progress-bar").html(percentComplete+'%');
                 }
             }, false);
             return xhr;
         },
          url: 'virus/award-process.php',
          method: 'POST',
          processData: false,
          contentType: false,
          cache: false,
          data: new FormData(this),
          beforeSend: function(){
              $(".progress-bar").width('0%');
          },
          success:function(response){
          $('#awardAlert').html(response);
          $('#add_award_form')[0].reset();
          fetchAward();
          }
        })

    });

    fetchAward();
    function   fetchAward(){
      $.ajax({
        url: 'virus/award-process.php',
        method: 'post',
        data: {action: 'fetch_Award'},
        success:function(response){
          $('#showAward').html(response);
          $('#showAwa').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "order": [0,'desc'],
            "info": true,
            "autoWidth": false,
            "responsive": true,
             "lengthMenu": [[5,10, 25, 50, -1], [10, 25, 50, "All"]]
          });
        }
      })
    }

    //Delete tutorial

$("body").on("click", ".trashAwardIcon", function(e){
    e.preventDefault();
    trash_id = $(this).attr('id');
    Swal.fire({
        title: 'Are you sure?',
        text: "Award Records will be Trashed!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, trash it!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: 'virus/award-process.php',
            method: 'POST',
            data: {trash_id: trash_id},
            success:function(response){
              Swal.fire(
                'Record Trashed!',
                'Record Trashed successfully',
                'success'
              )
              fetchAward();

            }
          });

        }
      });

});



  //Fetch source Details
  $('body').on('click', '.awardDetailsIcon', function(e){
    e.preventDefault();
    executive_id = $(this).attr('id');
    $.ajax({
      url: 'virus/award-process.php',
      method: 'post',
      data: {executive_id: executive_id},
      success:function(response){
        $('#FetchAwardDetails').html(response);
      }
    });
  });





  });
</script>
<script type="text/javascript" src="notify.js"></script>
