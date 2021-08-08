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


$db = new General();

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
                <a href="#GalleryTable" class="nav-link active font-weight-bold" data-toggle="tab">Gallery</a>
              </li>
              <li class="nav-item">
                <a href="#addGallery" class="nav-link  font-weight-bold" data-toggle="tab">Add Gallery</a>
              </li>

            </ul>
          </div>
          <div class="card-body">
            <div class="tab-content">

              <!-- tutorial tab content start -->
              <div class="tab-pane container active" id="GalleryTable">
                <div class="col-lg-12">
              <div class="card">
                <h4 class="card-header bg-success px-3"><i class="fa fa-table fa-lg"></i>Gallery</h4>
                <div class="card-body">
                  <div class="table-responsive" id="showGallery">
                    <p class="text-center align-self-center lead"><img src="<?= URLROOT;  ?>gif/success.gif"> Please Wait...</p>

                  </div>
                </div>
              </div>
            </div>
              </div>
          <!--start of add tut form tab content -->
               <div class="tab-pane container fade" id="addGallery">
                    <div class="col-lg-12">
              <div class="card">
                <h4 class="card-header bg-info border-info"><i class="fas fa-plus-circle fa-lg"></i>&nbsp;Add Gallery</h4>
                <div class="card-body">

                  <hr>
                  <form class="px-3" action="#" method="post" id="add_gallery_form" enctype="multipart/form-data">
                    <div class="form-group">
                      <h2 id="galleryAlert"></h2>
                    </div>

                      <div class="form-group col-lg-12">
                        <div class="form-group" id="imageAlert">  </div>

                        <div class="progress form-group" style="border-radius:20px; ">
                        <div class="progress-bar" style="border-radius:20px;"></div>
                        </div>
                        <div class="form-group col-md-12">
                          <div class="custom-file">
                           <input type="file" name="gallery_image" id="gallery_image"
                           class="custom-file-input">
                            <label for="file" class="custom-file-label">Select Files (image)</label>
                         </div>
                        </div>
                        <div class="row">

                    <div class="form-group col-md-6">
                      <label for="gallery_title">Title</label>
                      <input type="text" name="gallery_title" id="gallery_title" placeholder="Enter Title" class="form-control form-control-lg">
                    </div>

                    <div class="form-group col-md-6">
                      <label for="gallery_date_event">Event Date</label>
                      <input type="date" name="gallery_date_event" id="gallery_date_event" placeholder="Enter Event Date" class="form-control form-control-lg">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="gallery_event_location">Event Location</label>
                      <input type="text" name="gallery_event_location" id="gallery_event_location" placeholder="Enter Event Location" class="form-control form-control-lg">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="gallery_description">Berif Detail</label>
                      <textarea  name="gallery_description" id="gallery_description" placeholder="Enter Event Detail" class="form-control form-control-lg" rows="8">

                      </textarea>
                    </div>
                    <div class="clearfix">  </div>
                    <div class="form-group col-md-12">
                      <input type="submit" name="addGallery" id="addGalleryBtn" value="Add Gallery" class="btn btn-info btn-lg btn-block px-2">
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

    $('#add_gallery_form').submit(function(e){
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

          url: 'virus/gallery-process.php',
          method: 'POST',
          processData: false,
          contentType: false,
          cache: false,
          data: new FormData(this),
          beforeSend: function(){
              $(".progress-bar").width('0%');
          },
          success:function(response){
           $('#galleryAlert').html(response);
            setTimeout(function(){
            $('#galleryAlert').html('');
            }, 3000);
          $('#add_gallery_form')[0].reset();
          fetchGallery();
          }
        })

    });

    fetchGallery();
    function   fetchGallery(){
      $.ajax({
        url: 'virus/gallery-process.php',
        method: 'post',
        data: {action: 'fetch_gallery'},
        success:function(response){
          $('#showGallery').html(response);
          $('#showGall').DataTable({
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
 $('input[type="file"]').change(function(e){
           var fileName = e.target.files[0].name;
           $('#galleryAlert').html(fileName +  ' have  been selected.');
            $(".progress-bar").width('0%');
   });

    //Delete tutorial

$("body").on("click", ".trashGalleryIcon", function(e){
    e.preventDefault();
    delGall_id = $(this).attr('id');
    Swal.fire({
        title: 'Are you sure?',
        text: "Gallery will be Trashed!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, trash it!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: 'virus/gallery-process.php',
            method: 'POST',
            data: {delGall_id: delGall_id},
            success:function(response){
              Swal.fire(
                'Gallery Trashed!',
                'Gallery Trashed successfully',
                'success'
              )
              fetchGallery();

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
  $('body').on('click', '.GalleryDetailsIcon', function(e){
    e.preventDefault();
    gallery_id = $(this).attr('id');
    $.ajax({
      url: 'virus/gallery-process.php',
      method: 'post',
      data: {gallery_id: gallery_id},
      success:function(response){
        $('#fetchGalleryDetail').html(response);
      }
    });
  });





  });
</script>
<script type="text/javascript" src="notify.js"></script>
