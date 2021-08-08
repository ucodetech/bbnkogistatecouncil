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
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="card my-2 border-success">
              <div class="card-header bg-success text-white">
                <h4 class="m-0">Total Registerd Officers</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive" id="showAllUsers">
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
    <!-- Display users in a details modal -->
    <div class="modal fade" id="showUserDetailsModal">
      <div class="modal-dialog modal-dialog-centered mw-100 w-50 modal-dialog-scrollable">
        <div class="modal-content" id="others">


        </div>
      </div>
    </div>

<?php   require APPROOT .'/includes/Panelfooter.php';?>
<script type="text/javascript">
  $(document).ready(function(){

    fetchUsers();
    function fetchUsers(){
      $.ajax({
        url: 'virus/inits.php',
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
    url: 'virus/inits.php',
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
        text: "You can view the user in trash and restore or delete permenatly!",
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
                'User  Trashed!',
                'User Sent to Trash Can! <a href="trash">Trash Can</a>',
                'success'
              )
              fetchUsers();
            }
          });

        }
      });

});






  });
</script>
<script type="text/javascript" src="notify.js"></script>
