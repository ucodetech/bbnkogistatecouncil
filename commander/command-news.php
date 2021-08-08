<?php
require_once '../core/init.php';
if (!isCommanderGranted()) {
  Session::flash('message', 'Access Denied!');
  Redirect::to('command-access');

}
if (!hasPermissionSuper()) {
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
        <?php  echo flash('success'); ?>


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
                <a href="#newsTable" class="nav-link active font-weight-bold" data-toggle="tab">News</a>
              </li>
              <li class="nav-item">
                <a href="#newsImages" class="nav-link font-weight-bold" data-toggle="tab">Images</a>
              </li>
              <li class="nav-item">
                <a href="#addNewsFormLink" class="nav-link  font-weight-bold" data-toggle="tab">Add News</a>
              </li>
              <li class="nav-item">
                <a href="#addImagesLink" class="nav-link  font-weight-bold" data-toggle="tab">Add Images</a>
              </li>
            </ul>
          </div>
          <div class="card-body">
            <div class="tab-content">

              <!-- tutorial tab content start -->
              <div class="tab-pane container active" id="newsTable">
                <div class="col-lg-12">
              <div class="card">
                <h4 class="card-header bg-success px-3">News</h4>
                <div class="card-body">
                  <div class="table-responsive" id="showNews">
                    <p class="text-center align-self-center lead"><img src="../gif/success.gif"> Please Wait...</p>
                  </div>
                </div>
              </div>
            </div>
              </div>
                <!-- End tutorial tab content -->

                <!-- start source code table tab content start -->
            <div class="tab-pane container fade" id="newsImages">
              <div class="col-lg-12">
              <div class="card">
                <h4 class="card-header bg-success px-3">News Images</h4>
                <div class="card-body">
                  <div class="table-responsive" id="showNewsImages">
                    <p class="text-center align-self-center lead"><img src="../gif/success.gif"> Please Wait...</p>
                  </div>
                </div>
              </div>
            </div>
            </div>
            <!--end source code table tab content End -->

                    <!--start of add tut form tab content -->
               <div class="tab-pane container fade" id="addNewsFormLink">
              <div class="col-lg-12">
              <div class="card">
                <h4 class="card-header bg-info border-info"><i class="fas fa-plus-circle fa-lg"></i>&nbsp;Add News</h4>
                <div class="card-body">
                  <form class="px-3" action="#" method="post" enctype="multipart/form-data" id="featuredForm">
                <span class="alert alert-info">After Adding News Details! Upload a featured image for it!</span>

                    <div class="form-group" id="featAlert">  </div>

                    <div class="progress form-group" style="border-radius:20px; ">
                    <div class="progress-bar" style="border-radius:20px;"></div>
                    </div>
                    <div class="form-group col-md-12">
                      <div class="custom-file">
                       <input type="file" name="featured_image" id="featured_image"
                       class="custom-file-input">
                        <label for="file" class="custom-file-label">Select File (featured image)</label>
                     </div>
                    </div>

                <div class="form-group col-md-12" id="getNewsSelectFFeature">


                </div>
                    <div class="clearfix">  </div>
                    <div class="form-group col-md-12">
                      <input type="submit" name="uploadFeaturedImage" id="uploadFeaturedImage" value="Upload Featured Image" class="btn btn-warning btn-lg btn-block px-2">
                    </div>
                  </form>

                  <hr>
                  <h3 class="text-center lead">Add News</h3>
                  <form class="px-3" action="#" method="post" id="addNewsForm">
                    <div class="form-group">
                      <h2 id="newsAlert"></h2>
                    </div>

                  <div class="row">

                    <div class="form-group col-md-6">
                      <label for="news_title">Title</label>
                      <input type="text" name="news_title" id="news_title" placeholder="Title" class="form-control form-control-lg">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="news_description">Tut Description</label>
                      <textarea  name="news_description" id="news_description" placeholder="Description" class="form-control form-control-lg" rows="8"> </textarea>
                    </div>

                    <div class="clearfix">  </div>
                    <div class="form-group col-md-12">
                      <input type="submit"  id="uploadNews" value="Upload News" class="btn btn-info btn-lg btn-block px-2">
                    </div>
                  </div>
                  </form>
                </div>
              </div>
            </div>

               </div>
                 <!-- end of add tut form tab content -->
               <!--Start of add source  tab content -->
               <div class="tab-pane container fade" id="addImagesLink">

                 <div class="col-lg-12">
              <div class="card">
                <h4 class="card-header px-3 text-white bg-warning">Upload Images</h4>
                <div class="card-body">
                  <form class="px-3" action="#" method="post" enctype="multipart/form-data" id="imageForm">
                    <div class="form-group" id="imageAlert">  </div>

                    <div class="progress form-group" style="border-radius:20px; ">
                    <div class="progress-bar" style="border-radius:20px;"></div>
                    </div>

                    <div class="form-group col-md-12">
                      <div class="custom-file">
                       <input type="file" name="file[]" id="file"
                       class="custom-file-input"  multiple>
                        <label for="file" class="custom-file-label">Select Files (news Images)</label>
                     </div>
                    </div>


                <div class="form-group col-md-12" id="getNewsSelectImages">


                </div>
                    <div class="clearfix">  </div>
                    <div class="form-group col-md-12">
                      <input type="submit"  id="uploadImages" value="Upload Images" class="btn btn-warning btn-lg btn-block px-2">
                    </div>
                  </form>
                </div>
              </div>
            </div>
               </div>
               <!--End of add source  tab content -->

            </div>
          </div>
        </div>
      </div>
    </div>
          <!-- Start view Modal -->
            <div class="modal fade" id="showNewsDetailsModal">
              <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header bg-secondary">
                    <h4 class="modal-title text-light"><i class="fas fa-newspaper fa-lg"></i>&nbsp; News Details</h4>
                    <button type="button" name="button" class="close text-light" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body text-primary" id="FetchNewsDetails">

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


<?php   require APPROOT .'/includes/Panelfooter.php';?>
<script type="text/javascript">
  $(document).ready(function(){

    $('#uploadNews').click(function(e){
      if ($('#addNewsForm')[0].checkValidity()) {
        e.preventDefault();
        $.ajax({
            url: 'virus/news-process.php',
            method: 'post',
            data: $('#addNewsForm').serialize()+'&action=add_news',
            success:function(response){
              $('#addNewsForm')[0].reset();
              $('#newsAlert').html(response);
              fetchNews();
               get_Newss();
                get_News();
            }
        });
      }
    });

    fetchNews();
    function   fetchNews(){
      $.ajax({
        url: 'virus/news-process.php',
        method: 'post',
        data: {action: 'fetch_news'},
        success:function(response){
          $('#showNews').html(response);
          $('#showNew').DataTable({
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

$("body").on("click", ".trashNewsIcon", function(e){
    e.preventDefault();
    delNews_id = $(this).attr('id');
    Swal.fire({
        title: 'Are you sure?',
        text: "Tutorial will be Trashed!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, trash it!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: 'virus/news-process.php',
            method: 'POST',
            data: {delNews_id: delNews_id},
            success:function(response){
              Swal.fire(
                'Tutorial Trashed!',
                'Tutorial Trashed successfully',
                'success'
              )
              fetchNews();
               get_Newss();
                get_News();
            }
          });

        }
      });

});

        fetchNewsImages();

        function   fetchNewsImages(){
          $.ajax({
            url: 'virus/news-process.php',
            method: 'post',
            data: {action: 'Newsimages'},
            success:function(response){
              $('#showNewsImages').html(response);
              $('#showNe').DataTable({
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

        //add source code
        $('#imageForm').submit(function(e){
          e.preventDefault();
          $.ajax({
            xhr: function() {
               var xhr = new window.XMLHttpRequest();
               xhr.upload.addEventListener("progressSrc", function(evt) {
                   if (evt.lengthComputable) {
                       var percentComplete = ((evt.loaded / evt.total) * 100);
                       $(".progress-barSrc").width(percentComplete + '%');
                       $(".progress-barSrc").html(percentComplete+'%');
                   }
               }, false);
               return xhr;
           },

            url: 'virus/news-process.php',
            method: 'POST',
            processData: false,
            contentType: false,
            cache: false,
            data: new FormData(this),
            beforeSend: function(){
                $(".progress-barSrc").width('0%');
            },
            success:function(response){
            $('#imageAlert').html(response);
            $('#imageForm')[0].reset();
            fetchNewsImages();
            get_News();
            get_Newss();
            }
          })
        });

         //add featured image
        $('#featuredForm').submit(function(e){
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

            url: 'virus/news-process.php',
            method: 'POST',
            processData: false,
            contentType: false,
            cache: false,
            data: new FormData(this),
            beforeSend: function(){
                $(".progress-bar").width('0%');
            },
            success:function(response){
            $('#featAlert').html(response);
            $('#featuredForm')[0].reset();
            fetchNews();
            get_Newss();
            get_News();
            }
          })
        });

    //fetch News for sourcecode
    get_News();
    function  get_News(){
        $.ajax({
          url: 'virus/news-process.php',
          method:'post',
          data: {action: 'news_slug'},
          success:function(response){
            $('#getNewsSelectFFeature').html(response);

          }

        });
      }

    //fetch News for sourcecode
    get_Newss();
    function  get_Newss(){
        $.ajax({
          url: 'virus/news-process.php',
          method:'post',
          data: {action: 'news_images_add'},
          success:function(response){
            $('#getNewsSelectImages').html(response);
          }

        });
      }




  //Fetch source Details
  $('body').on('click', '.newsDetailsIcon', function(e){
    e.preventDefault();
    newsdt_id = $(this).attr('id');
    $.ajax({
      url: 'virus/news-process.php',
      method: 'post',
      data: {newsdt_id: newsdt_id},
      success:function(response){
        $('#FetchNewsDetails').html(response);
      }
    });
  });


$('body').on('click', '.PublishBtn', function(e){
  e.preventDefault();
  publishNews = $(this).attr('id');
  $.ajax({
      url: 'virus/news-process.php',
      method: 'post',
      data: {publishNews: publishNews},
      success:function(response){
           fetchNews();


      }
    });
});

$('body').on('click', '.UnPublishBtn', function(e){
  e.preventDefault();
  UnpublishNews = $(this).attr('id');
  $.ajax({
      url: 'virus/news-process.php',
      method: 'post',
      data: {UnpublishNews: UnpublishNews},
      success:function(response){
            fetchNews();

      }
    });
})



  });
</script>
<script type="text/javascript" src="notify.js"></script>
