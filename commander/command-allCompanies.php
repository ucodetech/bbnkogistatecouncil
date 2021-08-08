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
                <span class="lead align-self-center text-lg"><i class="fas fa-users fa-lg"></i>&nbsp;All Companies</span>
                  <a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#addCompany"> <i class="fas fa-plus-circle fa-lg"></i>&nbsp; Add Company </a>
              </h1>
              <div class="card-body">
                <div class="table-responsive" id="showCompany">
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

        $('#addCompanyBtn').click(function(e){
          if ($('#addCompanyForm')[0].checkValidity()) {
            e.preventDefault();
            $('#addCompanyBtn').val('Please wait...');
            $.ajax({
              url: 'virus/company-process.php',
              method: 'post',
              data: $('#addCompanyForm').serialize()+'&action=add_company',
              success:function(response){

                if ($.trim(response) === 'success') {
                  $('#addCompanyBtn').val('Add Company');
                  $('#addCompanyForm')[0].reset();
                  $('#addCompany').modal('hide');
                  fetchCompaines();
                }else{
                  $('#companyAlert').fadeIn('slow').html(response)
                  setTimeout(function(){
                    $('#companyAlert').html(response).fadeOut('slow');
                  }, 10000);
                }
              }
            });
          }
        });


        fetchCompaines();
        function   fetchCompaines(){
          $.ajax({
            url: 'virus/company-process.php',
            method: 'post',
            data: {action: 'fetch_company'},
            success:function(response){
              $('#showCompany').html(response);
              $('#showCompanys').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                // "order": [0,'desc'],
                "info": true,
                "autoWidth": false,
                "responsive": true,
                 "lengthMenu": [[10,20, 25, 50, -1], [10, 25, 50, "All"]]
              });
            }
          })
        }



        //Fetch source Details
        $('body').on('click', '.editCompBtn', function(e){
          e.preventDefault();
          compedit_id = $(this).attr('id');
          $.ajax({
            url: 'virus/company-process.php',
            method: 'post',
            data: {compedit_id: compedit_id},
            success:function(response){
              data = JSON.parse(response);
              $('#editCompanyID').val(data.id);
              $('#editcompanyNumber').val(data.company_number);
              $('#editchurch').val(data.church);
            }
          });
        });

        //Update Note
        $("#editCompanyBtn").click(function(e){
          if ($("#editCompanyForm")[0].checkValidity()) {
            e.preventDefault();
            $.ajax({
              url: 'virus/company-process.php',
              method: 'POST',
              data: $('#editCompanyForm').serialize()+'&action=update_company',
              success:function(response){
                if (response === 'updated') {
                  Swal.fire({
                    title: 'Company Updated Successfully!',
                    type: 'success'
                  });
                  $('#editCompanyForm')[0].reset();
                  $('#editCompanyModal').modal('hide');
                  fetchCompaines();
                }else{
                  $('#companyEditAlert').html(response);
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
                url: 'virus/company-process.php',
                method: 'POST',
                data: {toffier_trash_id: toffier_trash_id},
                success:function(response){
                  Swal.fire(
                    'Training Officer Trashed!',
                    'Training Officer Sent to Trash Can! <a href="trash">Trash Can</a>',
                    'success'
                  )
                  fetchCompaines();
                }
              });

            }
          });

    });

});

</script>
<script type="text/javascript" src="notify.js"></script>
