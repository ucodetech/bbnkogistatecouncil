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
              <h1 class="card-header bg-warning  d-flex justify-content-between">
                <span class="lead align-self-center text-lg"><i class="fas fa-users fa-lg"></i>&nbsp;Kogi State Group Councils</span>
                  <a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#addGroupCouncil"> <i class="fas fa-plus-circle fa-lg"></i>&nbsp; Add Group Council  </a>
              </h1>
              <div class="card-body">
                <div class="table-responsive" id="showGroupCouncil">
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

    <?php include APPROOT. '/commander/virus/modals.php' ?>

    <?php   require APPROOT .'/includes/Panelfooter.php';?>
    <script type="text/javascript">
      $(document).ready(function(){

        $('#addGroupCouncilBtn').click(function(e){
          if ($('#add_group_council')[0].checkValidity()) {
            e.preventDefault();
            $('#addGroupCouncilBtn').val('Please wait...');
            $.ajax({
              url: 'virus/history-process.php',
              method: 'post',
              data:$('#add_group_council').serialize()
              +'&action=add_group_council',
              success:function(response){
                if ($.trim(response) === 'success') {
                  $('#addGroupCouncilBtn').val('Add Group Council');
                  $('#add_group_council')[0].reset();
                  $('#addGroupCouncil').modal('hide');
                  fetchGroupCouncil();
                }else{
                  $('#groupAlert').fadeIn('slow').html(response)
                  setTimeout(function(){
                    $('#groupAlert').html(response).fadeOut('slow');
                  }, 10000);
                }
              }
            });
          }
        });


        fetchGroupCouncil();
        function   fetchGroupCouncil(){
          $.ajax({
            url: 'virus/history-process.php',
            method: 'post',
            data: {action: 'fetch_groupCouncil'},
            success:function(response){
              $('#showGroupCouncil').html(response);
              $('#showCouncil').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                // "order": [0,'desc'],
                "info": true,
                "autoWidth": false,
                "responsive": true,
                 "lengthMenu": [[5,10, 25, 50, -1], [10, 25, 50, "All"]]
              });
            }
          })
        }



        $('body').on('click', '.editGroupCouncil', function(e){
          e.preventDefault();
          groupid = $(this).attr('id');
          $.ajax({
            url: 'virus/history-process.php',
            method: 'post',
            data: {groupid: groupid},
            success:function(response){
              data = JSON.parse(response);
              $('#groupID').val(data.id);
              $('#editcouncil_name').val(data.council_name);
              $('#edit_introduction').html(data.introduction);
            }
          });
        });

        //Update groyp council
        $("#editGroupCouncilBtn").click(function(e){
          if ($("#edit_group_council")[0].checkValidity()) {
            e.preventDefault();
            $.ajax({
              url: 'virus/history-process.php',
              method: 'POST',
              data:$('#edit_group_council').serialize()
              +'&action=update_council',
              success:function(response){
                if (response === 'updated') {
                  Swal.fire({
                    title: 'Training  Officer Updated Successfully!',
                    type: 'success'
                  });
                  $('#edit_group_council')[0].reset();
                  $('#editGroupCouncilModal').modal('hide');
                  fetchGroupCouncil();
                }else{
                  $('#groupAlert').html(response);
                }

              }
            });
          }
        });

        // delete note
    $("body").on("click", ".trashGroupCouncilIcon", function(e){
        e.preventDefault();
        council_trash_id = $(this).attr('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You can view the Training Officer in trash and restore or delete permenatly!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Move it!'
          }).then((result) => {
            if (result.value) {
              $.ajax({
                url: 'virus/history-process.php',
                method: 'POST',
                data: {council_trash_id: council_trash_id},
                success:function(response){
                  Swal.fire(
                    'Group Council Trashed!',
                    'Group Council Sent to Trash Can! <a href="trash">Trash Can</a>',
                    'success'
                  )
                  fetchGroupCouncil();
                }
              });

            }
          });

    });

});

</script>
<script type="text/javascript" src="notify.js"></script>
