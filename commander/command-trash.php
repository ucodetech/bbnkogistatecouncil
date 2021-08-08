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
        <div class="row justify-content-center">
      <div class="col-lg-12">
        <div class="card rounded-0 mt-3 border-primary">
          <div class="card-header border-primary">
            <ul class="nav nav-tabs card-header-tabs">
              <li class="nav-item">
                <a href="#deletedUsers" class="nav-link active font-weight-bold" data-toggle="tab">Deleted Users</a>
              </li>
              <li class="nav-item">
                <a href="#deletedNotes" class="nav-link font-weight-bold" data-toggle="tab">Deleted User Notes</a>
              </li>
              <li class="nav-item">
                <a href="#deletedCategories" class="nav-link  font-weight-bold" data-toggle="tab">Deleted Categories</a>
              </li>
              <li class="nav-item">
                <a href="#deletedSource" class="nav-link  font-weight-bold" data-toggle="tab">Deleted Source</a>
              </li>
            </ul>
          </div>
          <div class="card-body">
            <div class="tab-content">

              <!-- tutorial tab content start -->
              <div class="tab-pane container active" id="deletedUsers">
                <div class="col-lg-12">
            <div class="card my-2 border-success">
              <div class="card-header bg-danger text-white">
                <h4 class="m-0"><i class="fas fa-user-slash"></i>Total Deleted Users</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive" id="showAllUsers">
                  <p class="text-center align-self-center lead"><img src="../users/images/success.gif"> Please Wait...</p>
                </div>
              </div>
            </div>
          </div>
              </div>
                <!-- End tutorial tab content -->

                <!-- start source code table tab content start -->
            <div class="tab-pane container fade" id="deletedNotes">

          <div class="col-lg-12">
            <div class="card my-2 border-success">
              <div class="card-header bg-info text-white">
                <h4 class="m-0"><i class="fas fa-book"></i>Total Deleted Users Notes</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive" id="showNote">
                  <p class="text-center align-self-center lead"><img src="../users/images/success.gif"> Please Wait...</p>
                </div>
              </div>
            </div>
          </div>
            </div>
            <!--end source code table tab content End -->

                    <!--start of add tut form tab content -->
               <div class="tab-pane container fade" id="deletedCategories">
                   <div class="col-lg-12">
            <div class="card my-2 border-success">
              <div class="card-header bg-secondary text-white">
                <h4 class="m-0"><i class="fas fa-list"></i>Total Deleted Categories</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive" id="cateTable">
                  <p class="text-center align-self-center lead"><img src="../users/images/success.gif"> Please Wait...</p>
                </div>
              </div>
            </div>
          </div>

               </div>
                 <!-- end of add tut form tab content -->
               <!--Start of add source  tab content -->
               <div class="tab-pane container fade" id="deletedSource">


               </div>
               <!--End of add source  tab content -->

            </div>
          </div>
        </div>
      </div>
    </div>

        </div>
      </div><!-- /.container-fluid -->
      <!-- /.content -->
      <!-- Display users in a details modal -->
    <div class="modal fade" id="showUserDetailsModal">
      <div class="modal-dialog modal-dialog-centered mw-100 w-50">
        <div class="modal-content" id="others">


        </div>
      </div>
    </div>
    </div>
    <!-- /.content-wrapper -->
    <!-- Display users in a details modal -->


<?php   require APPROOT .'/includes/Panelfooter.php';?>
<script type="text/javascript">
  $(document).ready(function(){

    fetchUsers();
    function fetchUsers(){
      $.ajax({
        url: 'virus/trash.php',
        method: 'post',
        data: {action: 'fetchAllUsers'},
        success:function(response){
          $('#showAllUsers').html(response);
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
    url: 'virus/trash.php',
    method: 'post',
    data: {details_id: details_id},
    success:function(response){
      $('#others').html(response);
    }
  });
});

//Delete users

$("body").on("click", ".deleteUserIcon", function(e){
    e.preventDefault();
    del_id = $(this).attr('id');
    Swal.fire({
        title: 'Are you sure?',
        text: "User will be deleted permenatly!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: 'virus/trash.php',
            method: 'POST',
            data: {del_id: del_id},
            success:function(response){
              Swal.fire(
                'User  Deleted!',
                'User Deleted successfully',
                'success'
              )
              fetchUsers();
            }
          });

        }
      });

});

//Delete note
$("body").on("click", ".deleteBtn", function(e){
    e.preventDefault();
    delnot_id = $(this).attr('id');
    Swal.fire({
        title: 'Are you sure?',
        text: "Note will be deleted permenatly!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: 'virus/trash.php',
            method: 'POST',
            data: {delnot_id: delnot_id},
            success:function(response){
              Swal.fire(
                'Note Deleted!',
                'Note Deleted successfully',
                'success'
              )
              displayAllNotes();

            }
          });

        }
      });

});
//restore from Trash
$("body").on("click", ".restoreBtn", function(e){
    e.preventDefault();
    restore_id = $(this).attr('id');
    Swal.fire({
        title: 'Are you sure?',
        text: "You'r about to Restore this User!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Restore it!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: 'virus/trash.php',
            method: 'POST',
            data: {restore_id: restore_id},
            success:function(response){
              Swal.fire(
                'Restored!',
                'User Restored!</a>',
                'success'
              )
            fetchUsers();
            }
          });

        }
      });

});


//restore from Trash
$("body").on("click", ".restoreNoteBtn", function(e){
    e.preventDefault();
    restore_id = $(this).attr('id');
    Swal.fire({
        title: 'Are you sure?',
        text: "You'r about to Restore this Note!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Restore it!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: 'virus/trash.php',
            method: 'POST',
            data: {restore_id: restore_id},
            success:function(response){
              Swal.fire(
                'Restored!',
                'Note Restored!</a>',
                'success'
              )
            fetchAllNotes();
            }
          });

        }
      });

});
$('body').on("click", ".infoBtn", function(e){
  e.preventDefault();
  infoD_id = $(this).attr('id');
  $.ajax({
    url: 'virus/trash.php',
    method: 'POST',
    data: {infoD_id: infoD_id},
    success:function(response){
    data = JSON.parse(response);
    Swal.fire({
      title: '<strong> Note : ID('+data.id+')</stron>',
      type: 'info',
      html: '<b> Title :  </b>'+data.title+ '<br><br><b> Note :  </b>'+data.note+ '<br><br><i> Created On :  </i>'+data.dateCreated+'<br><br><i> Updated On : </i>'+data.dateUpdated,
      showCloseButton: true
    });
    }
  });
});



displayAllNotes();
//Fetch Post
function displayAllNotes(){
  $.ajax({
      url: 'virus/trash.php',
      method: 'POST',
      data: {action: 'display_deleted'},
      success:function(response){
        $('#showNote').html(response);
        $('#showDeletedNotes').DataTable({
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
  });
};


//fetch categories ajax call
fetchCategories();
function fetchCategories(){
  $.ajax({
    url: 'virus/trash.php',
    method:'post',
    data: {action : 'FetchCate'},
    success:function(response){
      $('#cateTable').html(response);
      $('#categoreDl').DataTable({
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
      $('#categorel').DataTable({
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



  });
</script>
<script type="text/javascript" src="notify.js"></script>
