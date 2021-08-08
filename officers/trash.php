<?php
require_once '../core/init.php';
 if (!isLoggedInOfficer()) {
      Session::flash('access-denied', 'Access Denied! You must login to access the page');
      Redirect::to('access');
    }
    if (!hasPermission()) {
      Session::flash('access-denied', 'Access Denied! You have permission to access that page');
      Redirect::to('access');
    }
require APPROOT .'/includes/head2.php';
require APPROOT .'/includes/navs.php';
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-8 my-2">
      <?php if ($officer->verified == 0): ?>
        <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert">
              &times;
              </button>
              <strong class="text-center">
                Your E-Smail is not yet verified! An E-mail was sent to you with a verificaiton token please login to your mail box to verify your E-mail!
              </strong>
              </div>
        <?php endif; ?>
        <div class="card">
          <h5 class="card-header bg-danger d-flex justify-content-between">
            <span class="text-light lead align-self-center"><i class="fa fa-trash-o" aria-hidden="true"></i>Trash Can</span>
          </h5>
          <div class="card-body">
            <div class="table-responsive" id="showNote">



            </div>
          </div>
        </div>
    </div>
    <div class="col-lg-4 my-2">
      <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">
            &times;
            </button>
            <strong class="text-center">
                Welcome to your dashboard please be nice!
            </strong>
            </div>
            <hr>

    </div>
  </div>
</div>

<!-- End Edit  note modal -->
<?php require APPROOT .'/includes/footer2.php'; ?>
<script type="text/javascript">
  //Add New note
  $(document).ready(function(){

      // delete note
      $("body").on("click", ".deleteBtn", function(e){
          e.preventDefault();
          delp_id = $(this).attr('id');
          Swal.fire({
              title: 'Are you sure?',
              text: "You'r about to Delete Note permenatly!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.value) {
                $.ajax({
                  url: 'scripts/process.php',
                  method: 'POST',
                  data: {delp_id: delp_id},
                  success:function(response){
                    Swal.fire(
                      'Deleted!',
                      'Note Deleted!</a>',
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
              text: "You'r about to Restore this Note!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, Restore it!'
            }).then((result) => {
              if (result.value) {
                $.ajax({
                  url: 'scripts/process.php',
                  method: 'POST',
                  data: {restore_id: restore_id},
                  success:function(response){
                    Swal.fire(
                      'Restored!',
                      'Note Restored!</a>',
                      'success'
                    )
                    displayAllNotes();
                  }
                });

              }
            });

      });
      $('body').on("click", ".infoBtn", function(e){
        e.preventDefault();
        infoD_id = $(this).attr('id');
        $.ajax({
          url: 'scripts/process.php',
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
            url: 'scripts/process.php',
            method: 'POST',
            data: {action: 'display_deleted'},
            success:function(response){
              $('#showNote').html(response);
              $('#showNotes').DataTable({
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






      });
</script>
<script type="text/javascript" src="notificationjs.js"></script>
