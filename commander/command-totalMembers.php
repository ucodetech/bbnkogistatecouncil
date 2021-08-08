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
              <div class="card-header bg-warning text-white">
                <h4 class="m-0"><i class="fas fa-users"></i>Total Members In Kogi State Council</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive" id="showAllMemebers">
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
   
        <!-- Start view Modal -->
  <div class="modal fade" id="showReportDetailsModal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title text-light"><i class="fas fa-info-circle fa-lg"></i>&nbsp; Report Details</h4>
          <button type="button" name="button" class="close text-light" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body text-primary" id="FetchReportDetail">

        </div>
      </div>


    </div>
  </div>
<!-- End view modal -->



<?php   require APPROOT .'/includes/Panelfooter.php';?>
<script type="text/javascript">
  $(document).ready(function(){
    
    totalMemebers();


    function totalMemebers(){
      $.ajax({
        url: 'virus/process.php',
        method: 'post',
        data: {action: 'fetchAllMembers'},
        success:function(response){
          $('#showAllMemebers').html(response);
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

    $('body').on('click', '.reportDetailsIcon', function(e){
    	e.preventDefault();
    	council = $(this).attr('id');
    	$.ajax({
    		url: 'virus/process.php',
    		method: 'post',
    		data: {council: council},
    		success:function(response){
    			$('#FetchReportDetail').html(response);
    		}
    	});
    })

  });
</script>
<script type="text/javascript" src="notify.js"></script>
