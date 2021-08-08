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
                <a href="#ExecutivesTable" class="nav-link active font-weight-bold" data-toggle="tab">Executives</a>
              </li>
              <li class="nav-item">
                <a href="#addExecutives" class="nav-link  font-weight-bold" data-toggle="tab">Add Executives</a>
              </li>

            </ul>
          </div>
          <div class="card-body">
            <div class="tab-content">

              <!-- tutorial tab content start -->
              <div class="tab-pane container active" id="ExecutivesTable">
                <div class="col-lg-12">
              <div class="card">
                <h4 class="card-header bg-success px-3">Executives</h4>
                <div class="card-body">
                  <div class="table-responsive" id="showExecutive">
                    <p class="text-center align-self-center lead"><img src="<?= URLROOT;  ?>gif/success.gif"> Please Wait...</p>

                  </div>
                </div>
              </div>
            </div>
              </div>
          <!--start of add tut form tab content -->
               <div class="tab-pane container fade" id="addExecutives">
                    <div class="col-lg-12">
              <div class="card">
                <h4 class="card-header bg-info border-info"><i class="fas fa-plus-circle fa-lg"></i>&nbsp;Add Executives</h4>
                <div class="card-body">

                  <hr>
                  <form class="px-3" action="#" method="post" id="add_executive_form" enctype="multipart/form-data">
                    <div class="form-group">
                      <h2 id="executiveAlert"></h2>
                    </div>

                      <div class="form-group col-lg-12">
                        <div class="form-group" id="imageAlert">  </div>

                        <div class="progress form-group" style="border-radius:20px; ">
                        <div class="progress-bar" style="border-radius:20px;"></div>
                        </div>
                        <div class="form-group col-md-12">
                          <div class="custom-file">
                           <input type="file" name="executive_image" id="executive_image"
                           class="custom-file-input">
                            <label for="file" class="custom-file-label">Select Files (executives image)</label>
                         </div>
                        </div>
                        <div class="row">

                    <div class="form-group col-md-6">
                      <label for="executive_name">Name</label>
                      <input type="text" name="executive_name" id="executive_name" placeholder="Enter Executives Name" class="form-control form-control-lg">
                    </div>

                    <div class="form-group col-md-6">
                      <label for="executive_office">Office</label>
                      <input type="text" name="executive_office" id="executive_office" placeholder="Enter Executive Office" class="form-control form-control-lg">
                    </div>

                    <div class="form-group col-md-6">
                      <label for="executive_description">Profile</label>
                      <textarea  name="executive_description" id="executive_description" placeholder="Enter Executive Profile" class="form-control form-control-lg" rows="8">

                      </textarea>
                    </div>
                    <div class="clearfix">  </div>
                    <div class="form-group col-md-12">
                      <input type="submit" name="addExecutive" id="addExecutBtn" value="Add Executive" class="btn btn-info btn-lg btn-block px-2">
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
            <div class="modal fade" id="showExeDetailsModal">
              <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header bg-primary">
                    <h4 class="modal-title text-light"><i class="fas fa-info-circle fa-lg"></i>&nbsp; Executive Details</h4>
                    <button type="button" name="button" class="close text-light" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body text-primary" id="FetchExecDetails">

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

    $('#add_executive_form').submit(function(e){
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
          url: 'virus/executive-process.php',
          method: 'POST',
          processData: false,
          contentType: false,
          cache: false,
          data: new FormData(this),
          beforeSend: function(){
              $(".progress-bar").width('0%');
          },
          success:function(response){
          $('#executiveAlert').html(response);
          $('#add_executive_form')[0].reset();
          fetchExecutives();
          }
        })

    });

    fetchExecutives();
    function   fetchExecutives(){
      $.ajax({
        url: 'virus/executive-process.php',
        method: 'post',
        data: {action: 'fetch_executives'},
        success:function(response){
          $('#showExecutive').html(response);
          $('#showExe').DataTable({
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

$("body").on("click", ".trashExeIcon", function(e){
    e.preventDefault();
    delExe_id = $(this).attr('id');
    Swal.fire({
        title: 'Are you sure?',
        text: "Executive's Records will be Trashed!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, trash it!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: 'virus/executive-process.php',
            method: 'POST',
            data: {delExe_id: delExe_id},
            success:function(response){
              Swal.fire(
                'Record Trashed!',
                'Record Trashed successfully',
                'success'
              )
              fetchExecutives();

            }
          });

        }
      });

});



//showfile Names
  // $('input[name="file[]"]').change(function(e){
  //          var fileName = e.target.files[0].name;
  //          $('#showFileNames').html(fileName +  ' has been selected.')
  //  });


  //Fetch source Details
  $('body').on('click', '.exeDetailsIcon', function(e){
    e.preventDefault();
    executive_id = $(this).attr('id');
    $.ajax({
      url: 'virus/executive-process.php',
      method: 'post',
      data: {executive_id: executive_id},
      success:function(response){
        $('#FetchExecDetails').html(response);
      }
    });
  });





  });
</script>
<script type="text/javascript" src="notify.js"></script>
