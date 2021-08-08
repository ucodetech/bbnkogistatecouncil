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


$db = new DB();

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
                <span class="lead align-self-center text-lg"><i class="fas fa-users fa-lg"></i>&nbsp;State Training Officers</span>
                  <a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#addTrainingOfficers"> <i class="fas fa-plus-circle fa-lg"></i>&nbsp; Add Officer  </a>
              </h1>
              <div class="card-body">
                <div class="table-responsive" id="showToff">
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

        $('#addTOfficerBtn').click(function(e){
          if ($('#training-officer-form')[0].checkValidity()) {
            e.preventDefault();
            $('#addTOfficerBtn').val('Please wait...');
            $.ajax({
              url: 'virus/history-process.php',
              method: 'post',
              data: $('#training-officer-form').serialize()+'&action=add_tofficer',
              success:function(response){

                if ($.trim(response) === 'success') {
                  $('#addTOfficerBtn').val('Add Officer');
                  $('#training-officer-form')[0].reset();
                  $('#addTrainingOfficers').modal('hide');
                  fetchTrainingOfficer();
                }else{
                  $('#toAlert').fadeIn('slow').html(response)
                  setTimeout(function(){
                    $('#toAlert').html(response).fadeOut('slow');
                  }, 10000);
                }
              }
            });
          }
        });


        fetchTrainingOfficer();
        function   fetchTrainingOfficer(){
          $.ajax({
            url: 'virus/history-process.php',
            method: 'post',
            data: {action: 'fetch_training'},
            success:function(response){
              $('#showToff').html(response);
              $('#showTOfficers').DataTable({
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



      //Fetch source Details
      $('body').on('click', '.tofficerDetailsIcon', function(e){
        e.preventDefault();
        officerTid_id = $(this).attr('id');
        $.ajax({
          url: 'virus/history-process.php',
          method: 'post',
          data: {officerTid_id: officerTid_id},
          success:function(response){
            data = JSON.parse(response);
            Swal.fire({
            title: '<strong> Training Officer  : ID('+data.id+')</strong>',
            type: 'info',
            html: '<b> Training Officer Name :  </b>'+data.officer_name+ '<br><br><b> Qualification :  </b>'+data.officer_qualification,
            showCloseButton: true
          });


          }
        });
      });



        //Fetch source Details
        $('body').on('click', '.editTofficer', function(e){
          e.preventDefault();
          teditid = $(this).attr('id');
          $.ajax({
            url: 'virus/history-process.php',
            method: 'post',
            data: {teditid: teditid},
            success:function(response){
              data = JSON.parse(response);
              $('#editTofficerID').val(data.id);
              $('#edittofficer_name').val(data.officer_name);
              $('#editofficer_qua').val(data.officer_qualification);
            }
          });
        });

        //Update Note
        $("#editTOfficerBtn").click(function(e){
          if ($("#edit-training-officer-form")[0].checkValidity()) {
            e.preventDefault();
            $.ajax({
              url: 'virus/history-process.php',
              method: 'POST',
              data: $('#edit-training-officer-form').serialize()+'&action=update_officerT',
              success:function(response){
                if (response === 'updated') {
                  Swal.fire({
                    title: 'Training  Officer Updated Successfully!',
                    type: 'success'
                  });
                  $('#edit-training-officer-form')[0].reset();
                  $('#editTofficerModal').modal('hide');
                  fetchTrainingOfficer();
                }else{
                  $('#toEditAlert').html(response);
                }

              }
            });
          }
        });

        // delete note
    $("body").on("click", ".trashTofficerIcon", function(e){
        e.preventDefault();
        toffier_trash_id = $(this).attr('id');
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
                data: {toffier_trash_id: toffier_trash_id},
                success:function(response){
                  Swal.fire(
                    'Training Officer Trashed!',
                    'Training Officer Sent to Trash Can! <a href="trash">Trash Can</a>',
                    'success'
                  )
                  fetchTrainingOfficer();
                }
              });

            }
          });

    });

});

</script>
