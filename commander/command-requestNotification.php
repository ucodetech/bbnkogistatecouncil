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
      <div class="container-fluid">
        <div class="row" id="notificationRequest">
        <p class="text-center align-self-center lead mt-5"><img src="<?= URLROOT; ?>gif/tra.gif" />    Loading...</p>

        </div>

        </div>
      </div><!-- /.container-fluid -->
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


<?php   require APPROOT .'/includes/Panelfooter.php';?>
<script>
	$(document).ready(function(){

		$(document).on('click', '.verifyOfficerIcon', function(e){
			e.preventDefault();
			officerLt_id = $(this).attr('id');
			ltName = $(this).attr('data-name');

			 $.ajax({
          url: 'virus/requestNotify.php',
          method: 'POST',
          data: {officerLt_id: officerLt_id, ltName: ltName},
          success:function(response){
          data = JSON.parse(response);
          if (data.designation_company  == 'lieutenant in charge' || data.designation_company  == 'secretary') {
          	var informed = '<p style="color:green">Approve now!<p>';
          }else{
          	var informed = '<p style="color:red">Do not Approve!<p>';
          }
          if (data.designation_council) {
            var yes = 'This is Council level'
            if (data.designation_council == 'council secretary') {
                var informed = '<p style="color:green">The officer is the Council Secretary You can approve now!<p>';
              }else{
                  var informed = '<p style="color:red">The officer is not the Council Secretary do not approve!<p>';
              }
          
          }else{
            var yes = 'This is company level';
          }
          Swal.fire({
            title: '<strong> State : ID('+data.stateNo+')</strong>',
            type: 'info',
            html: '<b>Name :  </b>'+data.officers_name+ '<br><br><b> Rank/Portfolio :  </b>'+data.officers_rank+ '<br><br><i> Lt Incharge Name :  </i>'+data.officers_Lt_inCharge_name+'<br><br><i> Company : </i>'+data.officers_company_code+'<br><br><i> Church : </i>'+data.officers_home_church+'<br>'+informed+'<br>'+yes,
            showCloseButton: true
          });

          }
        });
		});
08154556316

$("body").on("click", ".approveOfficerIcon", function(e){
    e.preventDefault();
    approve_id = $(this).attr('id');
    request_id = $(this).attr('data-id');
    level = $(this).attr('data-level');

    Swal.fire({
        title: 'Are you sure?',
        text: "You want to approve this request!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, approve it!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: 'virus/requestNotify.php',
            method: 'POST',
            data: {approve_id: approve_id, request_id:request_id, level: level},
            success:function(response){
              // console.log(response);

              Swal.fire(
                'Requeset Approved!',
                'Requeset Approved successfully',
                'success'
              )

            }
          });

        }
      });

});

$("body").on("click", ".deleteOfficerIcon", function(e){
    e.preventDefault();
    delete_id = $(this).attr('id');
    request_id = $(this).attr('data-id');
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to delete this request!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: 'virus/requestNotify.php',
            method: 'POST',
            data: {delete_id: delete_id, request_id:request_id},
            success:function(response){
              Swal.fire(
                'Requeset Deleted!',
                'Requeset Deleted successfully',
                'success'
              )

            }
          });

        }
      });

});




	})
</script>

<script type="text/javascript" src="notify.js"></script>
