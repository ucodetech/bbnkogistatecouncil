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
<style>
	.fa-newspaper{
		font-size: 80px;
		margin: 2px;
		padding: 2px;
		color: orangered;
	}
</style>
<div class="content-wrapper">

    <div class="content-header">
      
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
        	<div class="col-lg-12">
        		<div class="card my-2 border-secondary">
        			<h1 class="card-header bg-secondary  d-flex justify-content-between">
                    <span class="lead align-self-center text-lg">&nbsp;All L.G.As in Nigeria</span>
                      <a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#addLGA"> <i class="fas fa-plus-circle fa-lg"></i>&nbsp; Add New</a>
                  </h1>
               <div class="card-body">
                <div class="table-responsive" id="showAllLga">
                <p class="text-center lead mt-5"><img src="<?= URLROOT; ?>gif/tra.gif" />    Please Wait...</p>
                </div>
              </div>
        		</div>
        	</div>
        </div>
       	
       </div>
        <!-- /.container-fluid -->
      <!-- /.content -->
    </div>
</div>
    <!-- /.content-wrapper -->
     <div class="modal fade" id="addLGA">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title text-light"><i class="fas fa-plus-circle fa-lg"></i>&nbsp; L.G.A</h4>
          <button type="button" name="button" class="close text-light" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body text-primary">
        	<form action="" method="post" id="addLGAForm">
        		<div class="form-group">
        			<input type="text" name="lga" id="lga" class="form-control form-control-lg" placeholder="L.G.A name">
        		</div>
        		<div class="form-group">
        			<input type="submit" name="addLGABtn" id="addLGABtn" class="btn btn-lg btn-primary btn-block" value="Add LGA">
        		</div>
        	</form>
        </div>
      </div>


    </div>
  </div>

<?php   require APPROOT .'/includes/Panelfooter.php';?>
<script type="text/javascript">
  $(document).ready(function(){

    fetchlga();
    function fetchlga(){
      $.ajax({
        url: 'virus/settings-process.php',
        method: 'post',
        data: {action: 'fetchAllLGA'},
        success:function(response){
          $('#showAllLga').html(response);
          $('#showLGA').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
             "lengthMenu": [[20,10, 25, 50, -1], [20, 25, 50, "All"]]
          });

        }

      });
    }

    // delete note
    $("#addLGABtn").on("click", function(e){
       	if ($('#addLGAForm')[0].checkValidity()) {
       	e.preventDefault();

       		$.ajax({
                url: 'virus/settings-process.php',
                method: 'POST',
                data: $('#addLGAForm').serialize()+'&action=add_lga',
                success:function(response){
                  Swal.fire(
                    'L.G .A Added!',
                    'success'
                  )
                 
                    fetchlga();
                }
              });
       	}	

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
