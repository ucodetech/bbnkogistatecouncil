<?php
    require_once '../core/init.php';
    if (!isLoggedInOfficer()) {
      Session::flash('access-denied', 'Access Denied! You must login to access the page');
      Redirect::to('login');
    }
    if (!hasPermission()) {
      Session::flash('access-denied', 'Access Denied! You Do not have permission to access that page');
      Redirect::to('login');
    }
    require_once APPROOT . '/includes/head2.php';
    require_once APPROOT . '/includes/navs.php';

    $officer = new Officer();
    $db = Database::getInstance();
    $officerid = $officer->data()->officer_id;
     $sqlper = "SELECT * FROM dataFormPermission WHERE permitted_id = '$officerid'";
      $stmtper = $db->query($sqlper);
      $row = $stmtper->first();
      $count = $stmtper->count();



      $sql = "SELECT * FROM DataFormInfo WHERE controller_id = '$officerid'";
      $stmt = $db->query($sql);
      $rowInfo = $stmt->first();
      $countInfo = $stmt->count();




?>


<div class="container-fluid">
  <div class="row">
    <div class="col-lg-8 my-2">

      <?php if ($officer->data()->verified == 0): ?>
        <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert">
              &times;
              </button>
              <strong class="text-center">
                Your E-Smail is not verified yet! Please Head Over to your profile page and click on verify email to get instructions on how to verify your E-mail!
              </strong>
              </div>
        <?php endif; ?>
        <?php if (($officer->data()->designation_company == '') && $officer->data()->designation_council == '' ): ?>
          <div class="modal" id="designationAlert">
            <div class="modal-content modal-dialog">
            <div class="modal-header">
              <button id="designationIgnore" class="btn btn-sm btn-danger btn-block">
              Ignore
              </button>
            </div>
            <div class="modal-body">
              <div class="alert alert-info">
              <strong class="text-center">
                Update Your Designation/Office! in your Company or Council!
                if no designation ignore.
              </strong><hr>
               <button id="councilLink" class="btn btn-sm btn-info">
              Not company! Council
              </button>
              <button id="councilcompanyLink" class="btn btn-sm btn-info">
             Both company and Council
             </button>
            <form action="#" method="post" id="DesignationFormCompany" style="display: block;">
              <span id="companyError"></span>
            <div class="form-group">
                  <label for="company">Company Level:</label>
            <input type="company" class="form-control" id="companyLevel" name="companyLevel" placeholder="Ignore if no designation" autofocus>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="noDesCompany" id="noDes">Thick me if No Designation
              </label>
            </div>
            <button type="submit" class="btn btn-primary btn-block" id="desUpdateBtnCompany">Update</button>
           </form>

            <form action="#" method="post" id="DesignationFormCouncil" style="display: none;">
            <span id="councilError"></span>
            <div class="form-group">
               <label for="council">Council Level:</label>
            <input type="text" class="form-control" id="councilLevel" name="councilLevel" placeholder="Ignore if no designation" autofocus>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="noDesCouncil" id="noDes">Thick me if No Designation
              </label>
            </div>
             <button id="backLink" class="btn btn-sm btn-info">
              Back
              </button><hr>
              <button type="submit" class="btn btn-primary btn-block" id="desUpdateBtnCouncil">Update</button>
           </form>

           <form action="#" method="post" id="DesignationFormBoth" style="display: none;">
           <span id="bothError"></span>
           <div class="form-group">
            <label for="bothLevelCouncil">Council Level:</label>
            <input type="text" class="form-control" id="bothLevelCouncil" name="bothLevelCouncil" placeholder="Ignore if no designation" autofocus>
           </div>
           <div class="form-group">
            <label for="bothLevelCompany">Company Level:</label>
            <input type="text" class="form-control" id="bothLevelCompany" name="bothLevelCompany" placeholder="Ignore if no designation" autofocus>
           </div>
           <div class="form-check">
             <label class="form-check-label">
               <input class="form-check-input" type="checkbox" name="noDesBoth" id="noDesBoth">Thick me if No Designation
             </label>
           </div>
            <button id="backLinkBoth" class="btn btn-sm btn-info">
             Back
             </button><hr>
             <button type="submit" class="btn btn-primary btn-block" id="desUpdateBtnBoth">Update</button>
          </form>

            <small class="text-danger">Note: Leave blank if no designation</small>
              </div>
            </div>
          </div>
          </div>

        <?php endif; ?>
        <div class="card">
          <h5 class="card-header bg-primary d-flex justify-content-between">
            <span class="text-light lead align-self-center">All Notes</span>
            <a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#addNoteModal"> <i class="fas fa-plus-circle fa-lg"></i>&nbsp; Add New Note </a>
          </h5>
          <div class="card-body">
            <div class="table-responsive" id="showNote">

              <p class="text-center lead mt-5"><img src="<?= URLROOT; ?>gif/tra.gif" />    Please Wait...</p>

            </div>
          </div>
        </div>
        <hr>
        <!-- check company -->
       <?php if ($count): ?>
       <?php if ($row->status == 0): ?>
        <?php if (($row->level == 'Company Level') && ($row->permission == 'companyLevelApproved')): ?>
        <?php if ($countInfo): ?>

        <div class="card">
          <h5 class="card-header bg-secondary d-flex justify-content-between">
            <span class="text-light lead align-self-center"><i class="fa fa-table fa-lg"></i>&nbsp;Completed Data Form Company Level Boys</span>
          </h5>
          <div class="card-body">
            <div class="table-responsive" id="showBoy">

              <p class="text-center lead mt-5"><img src="<?= URLROOT; ?>gif/tra.gif" />    Please Wait...</p>
              <p class="text-center">Only visible to Secretary of the Company</p>

            </div>
          </div>
        </div>
        <hr>
        <div class="card">
          <h5 class="card-header bg-info d-flex justify-content-between">
            <span class="text-light lead align-self-center"><i class="fa fa-table fa-lg"></i>&nbsp;Completed Data Form Company Level Officers</span>
          </h5>
          <div class="card-body">
            <div class="table-responsive" id="showOfficer">

              <p class="text-center lead mt-5"><img src="<?= URLROOT; ?>gif/tra.gif" />    Please Wait...</p>
              <p class="text-center">Only visible to Secretary of the Company</p>

            </div>
          </div>
        </div>
        <hr>
        <div class="card">
          <h5 class="card-header bg-danger d-flex justify-content-between">
            <span class="text-light lead align-self-center"><i class="fa fa-table fa-lg"></i>&nbsp;Completed Data Form Company Level Mothers</span>
          </h5>
          <div class="card-body">
            <div class="table-responsive" id="showMother">

              <p class="text-center lead mt-5"><img src="<?= URLROOT; ?>gif/tra.gif" />    Please Wait...</p>
              <p class="text-center">Only visible to Secretary of the Company</p>

            </div>
          </div>
        </div>
         <hr>
        <div class="card">
          <h5 class="card-header bg-danger d-flex justify-content-between">
            <span class="text-light lead align-self-center"><i class="fa fa-table fa-lg"></i>&nbsp;Completed Data Form Company Level Patrons</span>
          </h5>
          <div class="card-body">
            <div class="table-responsive" id="showPatron">

              <p class="text-center lead mt-5"><img src="<?= URLROOT; ?>gif/tra.gif" />    Please Wait...</p>
              <p class="text-center">Only visible to Secretary of the Company</p>

            </div>
          </div>
        </div>
        <hr>
        <div class="card">
          <h5 class="card-header bg-info d-flex justify-content-between">
            <span class="text-light lead align-self-center"><i class="fa fa-table fa-lg"></i>&nbsp;Completed Data Form Company Level Executive Summary</span>
          </h5>
          <div class="card-body">
            <div class="table-responsive" id="showSummary">

             <div class="col-md-12 py-2">
                  <button id="generate" class="btn btn-md btn-secondary btn-block" title="Executive Summary">
                Executive Summary
                </button>
                </div>

            </div>
          </div>
        </div>
     <?php endif; ?>
      <?php endif; ?>
       <?php else: ?>

     <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">
            &times;
            </button>
            <strong class="text-center">
               Data Form Is Closed
            </strong><br>
        </div>
       <?php endif; ?>
        <?php endif; ?>

        <!-- council check -->
        <?php if ($count):?>
          <?php if ($row->status == 0): ?>

         <?php if (($row->level == 'Council Level') && ($row->permission == 'CouncilLevelApproved')): ?>
         <div class="card">
          <h5 class="card-header bg-info d-flex justify-content-between">
            <span class="text-light lead align-self-center"><i class="fa fa-table fa-lg"></i>&nbsp;Completed Data Form Battalion/Group Council Level</span>
          </h5>
          <div class="card-body">
            <div class="table-responsive" id="showCouncilLevel">

              <p class="text-center lead mt-5"><img src="<?= URLROOT; ?>gif/tra.gif" /> Waiting for your orders...</p>
              <p class="text-center">click Battalion/Group to Generate</p>

            </div>
          </div>
        </div><hr>
        <div class="card">
          <h5 class="card-header bg-success d-flex justify-content-between">
            <span class="text-light lead align-self-center"><i class="fa fa-table fa-lg"></i>&nbsp;Completed Data Form Battalion/Group Executive Council Level</span>
          </h5>
          <div class="card-body">
            <div class="table-responsive" id="showCouncilLevelSummary">

              <p class="text-center lead mt-5"><img src="<?= URLROOT; ?>gif/tra.gif" />Waiting for your orders...</p>
              <p class="text-center">click Executive Summary to Generate</p>

            </div>
          </div>
        </div>
        <?php endif; ?>
        <?php else: ?>

     <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">
            &times;
            </button>
            <strong class="text-center">
               Data Form Is Closed
            </strong><br>
        </div>
          <?php endif ?>
    <?php endif; ?>

    </div>
    <div class="col-lg-4 my-2">
      <?php if (Session::exists('access-denied')){
        echo '<div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert">
              &times;
              </button>
              <strong class="text-center">
                  '.Session::flash('access-denied').'
              </strong>
              </div>';
      } ?>

      <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">
            &times;
            </button>
            <strong class="text-center">
                Welcome to your dashboard please be nice!
            </strong><br>
            Here is your State ID:<span class="text-success"> <?= $officer->stateNo;  ?></span>
            </div>
            <hr>
        <?php
            if ($officer->data()->verified == 1) {
              if ($count) {
                if ($row->status == 0) {

                if ($row->approved == 'negative'){
                  ?>
                  <div class="card mt-auto mb-3 text-success">
                    <div class="card-body text-center">
                       <p class="text-center">Request Sent! Await Approval</p><hr>
                       <p class="text-center">You will receive an E-mail once your request is approved</p>
                    </div>
                  </div>
                  <?
                }else{
                  ?>
<div class="card mt-auto mb-3">
  <div class="card-header">
    <h4 class="text-center text-dark px-3 align-self-center">Data Form</h4>
  </div>
  <div class="card-body text-center">

    <br>
      <span class=" text-info">Click to fill  Data form</span><hr>
      <div class="row">
        <?php
          if (($row->level == 'Company Level') && ($row->permission == 'companyLevelApproved')){
             if ($countInfo){
              ?>
               <div class="col-md-6 py-2">
                <button  id="RedirectBoyOnly" class="btn btn-md btn-info" title="Boys Only">
             Boys Only
              </button>

              </div>

               <div class="col-md-6 py-2">
                <button id="RedirectOfficerOnly" class="btn btn-md ucodeBtn text-light" title="Officers Only">
              Officers Only
              </button>
              </div>
               <div class="col-md-6 py-2">
                <button id="RedirectPatronOnly" class="btn btn-md btn-success" title="Patrons Only">
              Patrons Only
              </button>
              </div>
               <div class="col-md-6 py-2">
                <button id="RedirectMotherOnly" class="btn btn-md btn-danger" title="Mothers Only">
              Mothers Only
              </button>
              </div>
              <?


             }else{
              ?>
          <div class="col-md-12 py-2">
            <a href="#" data-toggle="modal" data-target="#dataformInfo"  class="btn btn-md btn-info" title="Required Info">
          Entered This required info first
          </a> <br>
          <small class="text-danger text-center">You are to scan your signature and the Chaplains Signature for Upload</small>
          </div>
              <?
             }



          }

           if (($row->level == 'Council Level') && ($row->permission == 'CouncilLevelApproved')){
            if ($countInfo){
              ?>
               <div class="col-md-12 py-2">
                  <button id="councilGenerate" class="btn btn-lg btn-warning btn-block" title="Battalion/Group Council">
                Battalion/Group Council
                </button>
                </div><hr>
                 <div class="col-md-12 py-2">
                  <button id="CouncilgenerateSummary" class="btn btn-md btn-info btn-block" title="Executive Summary">
                Executive Summary
                </button>
                </div>

              <?
            }else{
              ?>
        <div class="col-md-12 py-2">
            <a href="#" data-toggle="modal" data-target="#dataformInfo"  class="btn btn-md btn-info" title="Required Info">
          Entered This required info first
          </a> <br>
          <small class="text-danger text-center">You are to scan your signature and the Chaplains Signature for Upload</small>
          </div>

              <?
            }

          }
         ?>
      </div>
    </div>
  </div>

<?
}
  }else{
    ?>
     <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">
            &times;
            </button>
            <strong class="text-center">
               Data Form Is Closed
            </strong><br>

            </div>
    <?
  }
             }else{

          $company = 'secretary';

          $council =  'council secretary';


            $sql = "SELECT * FROM officers WHERE designation_company = '$company'  AND officer_id = '$officerid'";
            $stmt = $db->query($sql);
            $trueCompany = $stmt->first();


            $sqlcheck = "SELECT designation_council FROM officers WHERE designation_council = '$council' AND officer_id = '$officerid'";
            $stmts = $db->query($sqlper);
            $trueCouncil = $stmts->first();

            if ($trueCompany){
              ?>
                <div class="card mt-auto mb-3">
          <div class="card-header">
            <h4 class="text-center text-danger px-3 align-self-center"><i class="fa fa-warning fa-lg"></i>Only Lieutenant or Sec. Gen in charge! at Company Level</h4>
          </div>
          <div class="card-body text-center">
             <p class="text-center">Request for permission to fill DATA FORM</p><hr>
             <form action="#" method="post" id="requestPermissionForm">
               <div class="form-group">
                 <input type="hidden" name="LtSecID" id="LtSecID" value="<?=$officer->data()->officer_id?>">
                 <input type="text" class="form-control form-control-lg" value="Company Level" readonly name="level" id="level">
               </div>
               <div class="form-group">
                 <button type="submit" class="btn btn-block btn-danger" id="reqPermissionBtn">Request</button>
               </div>
             </form>
          </div>
        </div>

              <?
            }

            if ($trueCouncil) {
              ?>
               <div class="card mt-auto mb-3">
          <div class="card-header">
            <h4 class="text-center text-danger px-3 align-self-center"><i class="fa fa-warning fa-lg"></i>Only Council Secretary!</h4>
          </div>
          <div class="card-body text-center">
             <p class="text-center">Request for permission to fill DATA FORM</p><hr>
             <form action="#" method="post" id="requestPermissionFormCouncil">
               <div class="form-group">
                 <input type="hidden" name="councilSecID" id="councilSecID" value="<?=$officer->data()->officer_id?>">
                 <input type="text" class="form-control form-control-lg" value="Council Level" readonly name="level" id="level">
               </div>
               <div class="form-group">
                 <button type="submit" class="btn btn-block btn-danger" id="reqPermissionBtnCouncil">Request</button>
               </div>
             </form>
          </div>
        </div>

              <?
            }

              }


              // email checkValidity

            }


         ?>


  </div>
</div>
</div>


<?php require APPROOT .'/includes/footer2.php'; ?>
<script type="text/javascript">
  //Add New note
  $(document).ready(function(){

    $('#desUpdateBtnCompany').click(function(e){
      if ($('#DesignationFormCompany')[0].checkValidity()) {
        e.preventDefault();

        $.ajax({
      url: 'scripts/designation-process.php',
      method: 'POST',
      data: $('#DesignationFormCompany').serialize()+'&action=designationUpdatecompany',
     beforeSend: function(){
           $('#desUpdateBtnCompany').html('<img src="<?= URLROOT;  ?>gif/tra.gif"> Please wait...');
         },
      success:function(response){
        if (response==='true') {
        $('#DesignationFormCompany')[0].reset();
        $('#designationAlert').modal('hide');
          location.reload();
        }else{
          $('#companyError').html(response)
        }

      },
      complete:function(){
        $('#desUpdateBtnCompany').html('Update');
      }

        });
      }
    });


    $('#desUpdateBtnCouncil').click(function(e){
      if ($('#DesignationFormCouncil')[0].checkValidity()) {
        e.preventDefault();

        $.ajax({
      url: 'scripts/designation-process.php',
      method: 'POST',
      data: $('#DesignationFormCouncil').serialize()+'&action=designationUpdateCouncil',
     beforeSend: function(){
           $('#desUpdateBtnCouncil').html('<img src="<?= URLROOT;  ?>gif/tra.gif"> Please wait...');
         },
      success:function(response){
        console.log(response);
        if (response==='true') {
        $('#DesignationFormCouncil')[0].reset();
        $('#designationAlert').modal('hide');
          location.reload();
        }else{
          $('#councilError').html(response)
        }

      },
      complete:function(){
        $('#desUpdateBtnCouncil').html('Update');
      }

        });
      }
    });

    //both
    $('#desUpdateBtnBoth').click(function(e){
      if ($('#DesignationFormBoth')[0].checkValidity()) {
        e.preventDefault();

        $.ajax({
      url: 'scripts/designation-process.php',
      method: 'POST',
      data: $('#DesignationFormBoth').serialize()+'&action=designationUpdateBoth',
     beforeSend: function(){
           $('#desUpdateBtnBoth').html('<img src="<?= URLROOT;  ?>gif/tra.gif"> Please wait...');
         },
      success:function(response){
        console.log(response);
        if (response==='true') {
        $('#DesignationFormBoth')[0].reset();
        $('#designationAlert').modal('hide');
          location.reload();
        }else{
          $('#bothError').html(response)
        }

      },
      complete:function(){
        $('#desUpdateBtnBoth').html('Update');
      }

        });
      }
    });



    // end both

    $('#councilLink').click(function(e){
      e.preventDefault();
      $('#DesignationFormCompany').css('display', 'none');
      $('#DesignationFormCouncil').css('display', 'block');
      $('#councilLink').css('display','none');


    });


    $('#councilcompanyLink').click(function(e){
      e.preventDefault();
      $('#DesignationFormCompany').css('display', 'none');
      $('#DesignationFormBoth').css('display', 'none');
      $('#DesignationFormBoth').css('display', 'block');
      $('#councilLink').css('display','none');
      $('#councilcompanyLink').css('display','none');


    });

    $('#backLink').click(function(e){
        e.preventDefault();
      $('#DesignationFormCouncil').css('display', 'none');
        $('#DesignationFormBoth').css('display', 'none');
      $('#DesignationFormCompany').css('display', 'block');
        $('#councilcompanyLink').css('display','block');
      $('#councilLink').css('display','block');
    });


    $("body").on("click", "#reqPermissionBtn", function(e){
        e.preventDefault();

    $.ajax({
      url: 'scripts/feedback-pro.php',
      method: 'POST',
      data: $('#requestPermissionForm').serialize()+'&action=grantPermisson',
     beforeSend: function(){
           $('#reqPermissionBtn').html('<img src="<?= URLROOT;  ?>gif/tra.gif"> Please wait...');
           $('#reqPermissionBtn').attr('disabled', true);
         },
      success:function(response){
          location.reload();
      }
        });
    });

  $("body").on("click", "#reqPermissionBtnCouncil", function(e){
        e.preventDefault();

    $.ajax({
      url: 'scripts/feedback-pro.php',
      method: 'POST',
      data: $('#requestPermissionFormCouncil').serialize()+'&action=grantPermissonCouncil',
     beforeSend: function(){
           $('#reqPermissionBtnCouncil').html('<img src="<?= URLROOT;  ?>gif/tra.gif"> Please wait...');
           $('#reqPermissionBtnCouncil').attr('disabled', true);
         },
      success:function(response){
          location.reload();
      }
        });
    });

      $('#addNoteBtn').click(function(e){
        if ($('#add-note-form')[0].checkValidity()) {
          e.preventDefault();
          $('#addNoteBtn').val('Please Wait...');
          $.ajax({
            url:'scripts/process.php',
            method:'Post',
            data:$('#add-note-form').serialize()+'&action=add_note',
            success:function(response){
                $('#addNoteBtn').val('Add Note');
                $('#add-note-form')[0].reset();
                $('#addNoteModal').modal('hide');
                Swal.fire({
                    title: 'Note Added Successfully!',
                    type: 'success'

                });
                displayAllNotes();

            }
          });
        }
      });

      // Edit Note function

      $("body").on("click", ".editBtn", function(e){
          e.preventDefault();
          edit_id = $(this).attr('id');
          $.ajax({
            url: 'scripts/process.php',
            method: 'POST',
            data: {edit_id: edit_id},
            success:function(response){
            data = JSON.parse(response);
              $('#editId').val(data.id);
              $('#title').val(data.title);
              $('#note').val(data.note);

            }
          });
      });

      //Update Note
      $("#editNoteBtn").click(function(e){
        if ($("#edit-note-form")[0].checkValidity()) {
          e.preventDefault();
          $.ajax({
            url: 'scripts/process.php',
            method: 'POST',
            data: $('#edit-note-form').serialize()+'&action=update_note',
            success:function(response){
              Swal.fire({
                title: 'Note Updated Successfully!',
                type: 'success'
              });
              $('#edit-note-form')[0].reset();
              $('#editNoteModal').modal('hide');
              displayAllNotes();
            }
          });
        }
      });

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
                  url: 'scripts/process.php',
                  method: 'POST',
                  data: {del_id: del_id},
                  success:function(response){
                    Swal.fire(
                      'Note Trashed!',
                      'Note Sent to Trash Can! <a href="trash">Trash Can</a>',
                      'success'
                    )
                    displayAllNotes();
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
          url: 'scripts/process.php',
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

      displayAllNotes();
      //Fetch Post
      function displayAllNotes(){
        $.ajax({
            url: 'scripts/process.php',
            method: 'POST',
            data: {action: 'display_notes'},
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

    update_user_login();

    function update_user_login()
	{
  var action = 'update_time';
  $.ajax({
     url:"scripts/virus.php",
     method:"POST",
     data:{action:action},
     success:function(response)
     {


     },
     error:function(){alert("something went wrong")}

  });
	}
	 setInterval(function(){
	   update_user_login();
	}, 3000);


      // checking user is logged in or not
      $.ajax({
          url: 'scripts/pro-action.php',
          method: 'post',
          data: {action: 'checkUser'},
          success:function(response){
            if (response === 'Bye' ) {
              window.location = '../';
            }
          }
      });



 $('#dataInfoReportForm').submit(function(e){
        e.preventDefault();
        $.ajax({

          url: 'scripts/dataForm-process.php',
          method: 'POST',
          processData: false,
          contentType: false,
          cache: false,
          data: new FormData(this),

          success:function(response){
            if (response==='success') {
              $('#dataInfoReportForm')[0].reset();
              $('#dataformInfo').modal('hide');
              location.reload();
            }else{
              $('#showError').html(response);
            }

          }
        })

    });


 displayBoys();
      //Fetch Post
      function displayBoys(){
        $.ajax({
            url: 'dataForm/data-process.php',
            method: 'POST',
            data: {action: 'display_boys'},
            success:function(response){
              $('#showBoy').html(response);
              $('#showBoys').DataTable({
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

displayOfficers();
      //Fetch Post
      function displayOfficers(){
        $.ajax({
            url: 'dataForm/data-process.php',
            method: 'POST',
            data: {action: 'display_officers'},
            success:function(response){
              $('#showOfficer').html(response);
              $('#showOfficers').DataTable({
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

displayMothers();
      //Fetch Post
      function displayMothers(){
        $.ajax({
            url: 'dataForm/data-process.php',
            method: 'POST',
            data: {action: 'display_mothers'},
            success:function(response){
              $('#showMother').html(response);
              $('#showMothers').DataTable({
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

displayPatrons();
      //Fetch Post
      function displayPatrons(){
        $.ajax({
            url: 'dataForm/data-process.php',
            method: 'POST',
            data: {action: 'display_patrons'},
            success:function(response){
              $('#showPatron').html(response);
              $('#showPatrons').DataTable({
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



function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#previewLt').html('<img src="'+e.target.result+'" alt="Preview"  class="img-fluid img-thumbnail" width="108">');
    }

    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

$("#report_signature").change(function() {
  readURL(this);
});


function readURLCha(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#previewCha').html('<img src="'+e.target.result+'" alt="Preview"  class="img-fluid img-thumbnail" width="108">');
    }

    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

$("#chaplain_signature").change(function() {
  readURLCha(this);
});


  $('#RedirectBoyOnly').click(function(e){
    e.preventDefault();
    $('#RedirectBoyOnly').html('<img src="<?= URLROOT;  ?>gif/block.gif"> Redirecting Please wait...');
      setInterval(function(){

        window.location = '<?=URLROOT?>officers/dataForm/boysOnly/<?= $officer->officer_id ?>';
      }, 8000);
  });


  $('#RedirectOfficerOnly').click(function(e){
    e.preventDefault();
    $('#RedirectOfficerOnly').html('<img src="<?= URLROOT;  ?>gif/success.gif"> Redirecting Please wait...');
      setInterval(function(){

        window.location = '<?=URLROOT?>officers/dataForm/officersOnly/<?= $officer->officer_id ?>';

      }, 8000);
  });

  $('#RedirectMotherOnly').click(function(e){
    e.preventDefault();
    $('#RedirectMotherOnly').html('<img src="<?= URLROOT;  ?>gif/trans.gif"> Redirecting Please wait...');
      setInterval(function(){

        window.location = '<?=URLROOT?>officers/dataForm/mothersOnly/<?= $officer->officer_id ?>';

      }, 8000);
  });

  $('#RedirectPatronOnly').click(function(e){
    e.preventDefault();
    $('#RedirectPatronOnly').html('<img src="<?= URLROOT;  ?>gif/success.gif"> Redirecting Please wait...');
      setInterval(function(){

        window.location = '<?=URLROOT?>officers/dataForm/patronsOnly/<?= $officer->officer_id ?>';

      }, 8000);
  });



  $(document).on('click', '.hasIDBtn', function(e){
    e.preventDefault();
    boy_id = $(this).attr('id');
    $.ajax({
      url: 'dataForm/data-process.php',
      method: 'POST',
      data: {boy_id: boy_id},
      success:function(response){
        data = JSON.parse(response);
          $('#updateID').val(data.id);
          $('#idUpdate').val(data.stateNo);
          $('#oName').html(data.Name);

      }
    })
  })


//Update Note
      $("#updateIDBtn").click(function(e){
        if ($("#updateForm")[0].checkValidity()) {
          e.preventDefault();
          $.ajax({
            url: 'dataForm/data-process.php',
            method: 'POST',
            data: $('#updateForm').serialize()+'&action=update_stateID',
            success:function(response){
              if (response==='true') {
                Swal.fire({
                title: 'Updated Successfully!',
                type: 'success'
              });
              $('#updateForm')[0].reset();
              $('#updateStateID').modal('hide');
              displayBoys();
            }else{
              $('#updateError').html(response);
            }
            }
          });
        }
      });



  $(document).on('click', '.hasIDOfficerBtn', function(e){
    e.preventDefault();
    officer_id = $(this).attr('id');
    $.ajax({
      url: 'dataForm/data-process.php',
      method: 'POST',
      data: {officer_id: officer_id},
      success:function(response){
        data = JSON.parse(response);
          $('#updateIDOfficer').val(data.id);
          $('#idUpdateOfficer').val(data.stateNo);
          $('#oNameOfficer').html(data.Name);

      }
    })
  })


//Update Note
      $("#updateIDBtnOfficer").click(function(e){
        if ($("#updateFormOfficer")[0].checkValidity()) {
          e.preventDefault();
          $.ajax({
            url: 'dataForm/data-process.php',
            method: 'POST',
            data: $('#updateFormOfficer').serialize()+'&action=update_stateIDOfficer',
            success:function(response){
              // console.log(response);
              if (response==='true') {
                Swal.fire({
                title: 'Updated Successfully!',
                type: 'success'
              });
              $('#updateFormOfficer')[0].reset();
              $('#updateStateIDOfficer').modal('hide');
              displayBoys();
            }else{
              $('#updateOfficerError').html(response);
            }
            }
          });
        }
      });



      //trigger display summary function
        $("#generate").click(function(e){
        e.preventDefault();
       $("#generate").html('<img src="<?= URLROOT;  ?>gif/tra.gif"> Generating Summary...');
         setInterval(function(){
            displaySummary();
         }, 8000);


      });


      //trigger display summary function
    $("#councilGenerate").click(function(e){
        e.preventDefault();
       $("#councilGenerate").html('<img src="<?= URLROOT;  ?>gif/tra.gif"> Generating...');
         setInterval(function(){
            displayCouncilLevelDataForm();
         }, 3000);

        setInterval(function(){
            $("#councilGenerate").html('Done');
            $("#councilGenerate").attr('disabled', true);
         }, 3000);

      });
     //Fetch Post
      function displayCouncilLevelDataForm(){
        $.ajax({
            url: 'dataForm/data-process.php',
            method: 'POST',
            data: {action: 'display_council_level'},
            success:function(response){
              $('#showCouncilLevel').html(response);

            }
        });
      };



       //trigger display summary function
       $('#CouncilgenerateSummary').click(function(e){
        e.preventDefault();
        displayCouncilLevelSummaryDataForm();
       })

      //Fetch Post
      function displayCouncilLevelSummaryDataForm(){

        $.ajax({
            url: 'dataForm/data-process.php',
            method: 'POST',
            data: {action: 'display_council_summary'},
            beforeSend:function(){
                $("#CouncilgenerateSummary").html('<img src="<?= URLROOT;  ?>gif/tra.gif"> Generating...');
            },
            success:function(response){
              $('#showCouncilLevelSummary').html(response);

            },
            complete:function(){
               $("#CouncilgenerateSummary").html('Done');
             $("#CouncilgenerateSummary").attr('disabled', true);
            }
        });
      };



      //Fetch Post
      function displaySummary(){
        $.ajax({
            url: 'dataForm/data-process.php',
            method: 'POST',
            data: {action: 'display_summary'},
            success:function(response){
              $('#showSummary').html(response);

            }
        });
      };



        const designationInfo = $('#designationAlert');
        const ignore = $('#designationIgnore');

        $(ignore).click(function(){
            $(designationInfo).modal('hide');
            localStorage.setItem("designationIgnored", "true");
        });

        setInterval(function(){
            if (!localStorage.getItem("designationIgnored")) {
                $(designationInfo).modal('show');
            }

        }, 10000);



 // send to council
      $("body").on("click", ".sendToState", function(e){
          e.preventDefault();
          sendnow_council_id = '<?=$officer->officer_id;?>';
          Swal.fire({
              title: 'Are you sure?',
              text: "You are about to send your Data Form Report to State Council It can't be Reverted! ",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, Send it!'
            }).then((result) => {
              if (result.value) {
                $.ajax({
                  url: 'scripts/dataForm-process.php',
                  method: 'POST',
                  data: {sendnow_council_id: sendnow_council_id},
                  success:function(response){
                    Swal.fire(
                      'Report Send To Council!',
                      'Your Report have been sent to State Council!',
                      'success'
                    );
                    location.reload();
                  }
                });

              }
            });

      });



      });



 // send to council
      $("body").on("click", ".sendToCouncil", function(e){
          e.preventDefault();
          sendnow_compan_id = '<?=$officer->officer_id;?>';
          Swal.fire({
              title: 'Are you sure?',
              text: "You are about to send your Data Form Report to Group Council It can't be Reverted! ",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, Send it!'
            }).then((result) => {
              if (result.value) {
                $.ajax({
                  url: 'scripts/dataForm-process.php',
                  method: 'POST',
                  data: {sendnow_compan_id: sendnow_compan_id},
                  success:function(response){
                    Swal.fire(
                      'Report Sent To Council!',
                      'Your Report have been sent to Group Council!',
                      'success'
                    );
                    location.reload();
                  }
                });

              }
            });

      });

</script>
<script type="text/javascript" src="notificationjs.js"></script>
