<?php
require_once '../core/init.php';
if (!isWarHeadGranted()) {
  Session::flash('access-denied', 'Access Denied!');
  Redirect::to('warhead-access');

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
            <div class="card my-2 border-secondary">
              <div class="card-header bg-secondary text-white">
                <h4 class="m-0"><i class="fas fa-book"></i>Total Note By all Users</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive" id="showAllNotes">
                  <p class="text-center align-self-center lead"><img src="../users/images/success.gif"> Please Wait...</p>
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
    <!-- Display users in a details modal -->
    <div class="modal fade" id="showNoteDetailsModal">
      <div class="modal-dialog modal-dialog-centered mw-100 w-50">
        <div class="modal-content" id="others">

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
          </div>
        </div>
      </div>
    </div>

<?php   require APPROOT .'/includes/Panelfooter.php';?>
<script type="text/javascript">
  $(document).ready(function(){

    fetchNotes();
    function fetchNotes(){
      $.ajax({
        url: 'virus/inits.php',
        method: 'post',
        data: {action: 'fetchAllNotes'},
        success:function(response){
          $('#showAllNotes').html(response);
          $('#showNotes').DataTable({
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

    // delete note
    $("body").on("click", ".deleteBtn", function(e){
        e.preventDefault();
        del_id = $(this).attr('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You can view the note in trash and restore or delete permenatly!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Move it!'
          }).then((result) => {
            if (result.value) {
              $.ajax({
                url: 'virus/inits.php',
                method: 'POST',
                data: {del_id: del_id},
                success:function(response){
                  Swal.fire(
                    'Note Trashed!',
                    'Note Sent to Trash Can! <a href="trash">Trash Can</a>',
                    'success'
                  )
                  fetchNotes();
                }
              });

            }
          });

    });

    //Note Details
    $('body').on("click", ".infoBtn", function(e){
      e.preventDefault();
      info_id = $(this).attr('id');
      $.ajax({
        url: 'virus/inits.php',
        method: 'POST',
        data: {info_id: info_id},
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
  

  });
</script>
