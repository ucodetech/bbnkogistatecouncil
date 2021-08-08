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
                <a href="#SSOTable" class="nav-link active font-weight-bold" data-toggle="tab">SSO</a>
              </li>
              <li class="nav-item">
                <a href="#addSSO" class="nav-link  font-weight-bold" data-toggle="tab">Add SSO</a>
              </li>
              <li class="nav-item">
                <a href="#PresidentTable" class="nav-link  font-weight-bold" data-toggle="tab">State President</a>
              </li>
              <li class="nav-item">
                <a href="#addPresident" class="nav-link  font-weight-bold" data-toggle="tab">Add President</a>
              </li>
            </ul>
          </div>
          <div class="card-body">
            <div class="tab-content">

              <!-- sso-presidentorial tab content start -->
              <div class="tab-pane container active" id="SSOTable">
                <div class="col-lg-12">
              <div class="card">
                <h4 class="card-header bg-success px-3">SSO</h4>
                <div class="card-body">
                  <div class="table-responsive" id="showSSO">
                    <p class="text-center align-self-center lead"><img src="<?= URLROOT;  ?>gif/success.gif"> Please Wait...</p>

                  </div>
                </div>
              </div>
            </div>
              </div>

                <!-- sso-presidentorial tab content start -->
                <div class="tab-pane container" id="PresidentTable">
                  <div class="col-lg-12">
                <div class="card">
                  <h4 class="card-header bg-success px-3">State President</h4>
                  <div class="card-body">
                    <div class="table-responsive" id="showPresident">
                      <p class="text-center align-self-center lead"><img src="<?= URLROOT;  ?>gif/trans.gif"> Please Wait...</p>

                    </div>
                  </div>
                </div>
              </div>
                </div>
          <!--start of add sso-president form tab content -->
               <div class="tab-pane container fade" id="addSSO">
                    <div class="col-lg-12">
              <div class="card">
                <h4 class="card-header bg-info border-info"><i class="fas fa-plus-circle fa-lg"></i>&nbsp;Add SSO</h4>
                <div class="card-body">

                  <hr>
                  <form class="px-3" action="#" method="post" id="add_SSO_form" enctype="multipart/form-data">
                    <div class="form-group">
                      <h2 id="SSOAlert"></h2>
                    </div>

                      <div class="form-group col-lg-12">


                        <div class="progress form-group" style="border-radius:20px; ">
                        <div class="progress-bar" style="border-radius:20px;"></div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="control-label">Upload File</label>
                            <div class="preview-zone hidden">
                              <div class="box box-solid">
                                <div class="box-header with-border">
                                  <div><b>Preview</b></div>
                                  <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-danger btn-xs remove-preview">
                                      <i class="fa fa-times"></i> Change Image
                                    </button>
                                  </div>
                                </div>
                                <div class="box-body"></div>
                              </div>
                            </div>
                            <div class="dropzone-wrapper">
                              <div class="dropzone-desc">
                                <i class="fas fa-upload fa-lg"></i>
                                <p>Choose an image file or drag it here.</p>
                              </div>
                              <input type="file" name="SSO_image" id="SSO_image" class="dropzone">
                            </div>

                          </div>
                      </div>

                        <div class="row">

                    <div class="form-group col-md-6">
                      <label for="SSO_name">Name</label>
                      <input type="text" name="SSO_name" id="SSO_name" placeholder="Enter SSO Name" class="form-control form-control-lg">
                    </div>

                    <div class="form-group col-md-6">
                      <label for="SSO_office">Office</label>
                      <input type="text" name="SSO_office" id="SSO_office" placeholder="Enter SSO Office" class="form-control form-control-lg">
                    </div>

                    <div class="form-group col-md-6">
                      <label for="SSO_description">Profile</label>
                      <textarea  name="SSO_description" id="SSO_description" placeholder="Enter SSO Profile" class="form-control form-control-lg" rows="8">

                      </textarea>
                    </div>
                    <div class="clearfix">  </div>
                    <div class="form-group col-md-12">
                      <input type="submit" name="addSSO" id="addSSOBtn" value="Add SSO" class="btn btn-info btn-lg btn-block px-2">
                    </div>
                  </div>
                  </form>
                </div>
              </div>
            </div>

               </div>
                 <!-- end of add sso-president form tab content -->

               <!--End of add source  tab content -->

            </div>
            <!--start of add sso-president form tab content -->
                 <div class="tab-pane container fade" id="addPresident">
                      <div class="col-lg-12">
                <div class="card">
                  <h4 class="card-header bg-info border-info"><i class="fas fa-plus-circle fa-lg"></i>&nbsp;Add State President</h4>
                  <div class="card-body">

                    <hr>
                    <form class="px-3" action="#" method="post" id="add_President_form" enctype="multipart/form-data">
                      <div class="form-group">
                        <h2 id="PresidentAlert"></h2>
                      </div>

                        <div class="form-group col-lg-12">


                          <div class="progress form-group" style="border-radius:20px; ">
                          <div class="progress-bar" style="border-radius:20px;"></div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <label class="control-label">Upload File</label>
                              <div class="preview-zone hidden">
                                <div class="box box-solid">
                                  <div class="box-header with-border">
                                    <div><b>Preview</b></div>
                                    <div class="box-tools pull-right">
                                      <button type="button" class="btn btn-danger btn-xs remove-preview">
                                        <i class="fa fa-times"></i> Change Image
                                      </button>
                                    </div>
                                  </div>
                                  <div class="box-body"></div>
                                </div>
                              </div>
                              <div class="dropzone-wrapper">
                                <div class="dropzone-desc">
                                  <i class="fas fa-upload fa-lg"></i>
                                  <p>Choose an image file or drag it here.</p>
                                </div>
                                <input type="file" name="President_image" id="President_image" class="dropzone">
                              </div>

                            </div>
                        </div>

                          <div class="row">

                      <div class="form-group col-md-6">
                        <label for="President_name">Name</label>
                        <input type="text" name="President_name" id="President_name" placeholder="Enter President Name" class="form-control form-control-lg">
                      </div>

                      <div class="form-group col-md-6">
                        <label for="President_office">Office</label>
                        <input type="text" name="President_office" id="President_office" placeholder="Enter President Office" class="form-control form-control-lg">
                      </div>

                      <div class="form-group col-md-6">
                        <label for="President_description">Profile</label>
                        <textarea  name="President_description" id="President_description" placeholder="Enter President Profile" class="form-control form-control-lg" rows="8">

                        </textarea>
                      </div>
                      <div class="clearfix">  </div>
                      <div class="form-group col-md-12">
                        <input type="submit" name="addPresident" id="addPresidentBtn" value="Add State President" class="btn btn-info btn-lg btn-block px-2">
                      </div>
                    </div>
                    </form>
                  </div>
                </div>
              </div>

                 </div>
                   <!-- end of add sso-president form tab content -->

                 <!--End of add source  tab content -->

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
</div>
<?php include APPROOT. '/commander/virus/modals.php' ?>
<?php   require APPROOT .'/includes/Panelfooter.php';?>
<script type="text/javascript">
  $(document).ready(function(){

    $('#add_SSO_form').submit(function(e){
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
          url: 'virus/sso-president.php',
          method: 'POST',
          processData: false,
          contentType: false,
          cache: false,
          data: new FormData(this),
          beforeSend: function(){
              $(".progress-bar").width('0%');
          },
          success:function(response){
          $('#SSOAlert').html(response);
          $('#add_SSO_form')[0].reset();
          fetchSSO();
          }
        })

    });

    fetchSSO();
    function   fetchSSO(){
      $.ajax({
        url: 'virus/sso-president.php',
        method: 'post',
        data: {action: 'fetch_SSO'},
        success:function(response){
          $('#showSSO').html(response);
          $('#showS').DataTable({
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

    //Delete sso-presidentorial

$("body").on("click", ".trashSSOIcon", function(e){
    e.preventDefault();
    delSSO_id = $(this).attr('id');
    Swal.fire({
        title: 'Are you sure?',
        text: "SSO's Records will be Trashed!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, trash it!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: 'virus/sso-president.php',
            method: 'POST',
            data: {delSSO_id: delSSO_id},
            success:function(response){
              Swal.fire(
                'Record Trashed!',
                'Record Trashed successfully',
                'success'
              )
              fetchSSO();

            }
          });

        }
      });

});


  //Fetch source Details
  $('body').on('click', '.SSODetailsIcon', function(e){
    e.preventDefault();
    SSO_id = $(this).attr('id');
    $.ajax({
      url: 'virus/sso-president.php',
      method: 'post',
      data: {SSO_id: SSO_id},
      success:function(response){
        $('#FetchSSODetails').html(response);
      }
    });
  });

//state president

$('#add_President_form').submit(function(e){
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
      url: 'virus/sso-president.php',
      method: 'POST',
      processData: false,
      contentType: false,
      cache: false,
      data: new FormData(this),
      beforeSend: function(){
          $(".progress-bar").width('0%');
      },
      success:function(response){
      $('#PresidentAlert').html(response);
      $('#add_President_form')[0].reset();
      fetchPresident();
      }
    })

});

fetchPresident();
function   fetchPresident(){
  $.ajax({
    url: 'virus/sso-president.php',
    method: 'post',
    data: {action: 'fetch_President'},
    success:function(response){
      $('#showPresident').html(response);
      $('#showPre').DataTable({
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

//Delete sso-presidentorial

$("body").on("click", ".trashPresidentIcon", function(e){
e.preventDefault();
delPresident_id = $(this).attr('id');
Swal.fire({
    title: 'Are you sure?',
    text: "President's Records will be Trashed!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, trash it!'
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url: 'virus/sso-president.php',
        method: 'POST',
        data: {delPresident_id: delPresident_id},
        success:function(response){
          Swal.fire(
            'Record Trashed!',
            'Record Trashed successfully',
            'success'
          )
          fetchPresident();

        }
      });

    }
  });

});


//Fetch source Details
$('body').on('click', '.PreDetailsIcon', function(e){
e.preventDefault();
President_id = $(this).attr('id');
$.ajax({
  url: 'virus/sso-president.php',
  method: 'post',
  data: {President_id: President_id},
  success:function(response){
    $('#fetchPresidentDetails').html(response);
  }
});
});

  });
</script>
<script type="text/javascript" src="notify.js"></script>
