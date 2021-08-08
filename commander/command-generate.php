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


$general = new General();
$db = Database::getInstance();

$Lt =  "SELECT * FROM bunker WHERE permission = 'lieutenant' ";
$query = $db->query($Lt);
$parade = $query->first();
$lieutenant =  $parade->permission;

$secGen =  "SELECT * FROM bunker WHERE permission = 'secgen' ";
$query = $db->query($secGen);
$parade = $query->first();
$secGeneral =  $parade->permission;

$commnaderInChief =  "SELECT * FROM bunker WHERE permission = 'sso,captian,lieutenant,secgen' ";
$query = $db->query($commnaderInChief);
$parade = $query->first();
$chief =  $parade->permission;

?>

<div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <?php  echo flash('success'); ?>


      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
      <div class="col-lg-12">
        <div class="card rounded-0 mt-3 border-primary">
          <div class="card-header border-primary">
            <ul class="nav nav-tabs card-header-tabs">
              <li class="nav-item">
                <a href="#commandersTable" class="nav-link active font-weight-bold" data-toggle="tab">Commanders</a>
              </li>
              <li class="nav-item">
                <a href="#addCommanders" class="nav-link  font-weight-bold" data-toggle="tab">Add Commander</a>
              </li>

            </ul>
          </div>
          <div class="card-body">
            <div class="tab-content">

              <!-- tutorial tab content start -->
              <div class="tab-pane container active" id="commandersTable">
                <div class="col-lg-12">
              <div class="card">
                <h4 class="card-header bg-success px-3">Commanders</h4>
                <div class="card-body">
                  <div class="table-responsive" id="showCommanders">
                    <p class="text-center align-self-center lead"><img src="<?= URLROOT;  ?>gif/success.gif"> Please Wait...</p>

                  </div>
                </div>
              </div>
            </div>
              </div>
          <!--start of add tut form tab content -->
               <div class="tab-pane container fade" id="addCommanders">
                    <div class="col-lg-12">
              <div class="card">
                <h4 class="card-header bg-info border-info"><i class="fas fa-plus-circle fa-lg"></i>&nbsp;Add Commander</h4>
                <div class="card-body">

                  <hr>
                  <div class="container ">
                      <div class="row  align-items-center justify-content-center">
                        <div class="col-lg-8">
                          <div class="card border-danger shadow-lg">
                            <div class="card-header bg-danger">
                              <h3 class="m-0 text-white">
                                <i class="fas fa-user-cog"></i>&nbsp; Commander's Permission
                              </h3>
                            </div>
                            <div class="card-body text-dark">
                              <form  action="#" method="post" class="px-3" id="admin-add-form">

                                <div class="form-group" id="regError">   </div>
                                <div class="form-group">
                                  <input type="text" name="commander-name" id="commander-name" placeholder="Enter Warhead full Name" class="form-control form-control-lg rounded-1" autofocus autocomplete="false">
                                </div>
                                <div class="form-group">
                                  <input type="email" name="commander-email" id="commander-email" placeholder="Enter Warhead access Email" class="form-control form-control-lg rounded-1" autofocus autocomplete="false">
                                </div>
                                <div class="form-group">
                                  <input type="number" name="commander-tel" id="commander-tel" placeholder="Enter Warhead access phone number" class="form-control form-control-lg rounded-1" autofocus autocomplete="false">
                                </div>
                                <div class="form-group">
                                  <select class="form-control form-control-lg rounded-1" name="permission" id="permission">
                                    <option value="">Select Permission</option>
                                    <option value="<?=$lieutenant ?>"><?= $lieutenant ?></option>
                                    <option value="<?= $secGeneral?>"><?= $secGeneral ?></option>
                                    <option value="<?= $chief?>"><?= $chief ?></option>
                                  </select>
                                </div>

                          <div class="form-group">
                            <input type="text" name="commander-accessName" id="commander-accessName" placeholder="Enter Warhead access name" class="form-control form-control-lg rounded-1" autocomplete="false">
                          </div>
                          <div class="form-group">
                            <input type="password" name="commander-password" id="commander-password" placeholder="Enter Warhead access Auth1" class="form-control form-control-lg rounded-1" autocomplete="false">
                          </div>
                          <div class="form-group">
                            <input type="password" name="commander-cpassword" id="commander-cpassword" placeholder="Enter Warhead access Auth2" class="form-control form-control-lg rounded-1" autocomplete="false">
                          </div>
                        <div class="form-group mt-1">
                          <input type="submit" name="addAuthBtn" id="addAuthBtn" class="btn btn-danger btn-block btn-lg" value="Grant Permission">
                        </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>


                </div>
              </div>
            </div>

               </div>
                 <!-- end of add tut form tab content -->

               <!--End of add source  tab content -->

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
</div>
<?php include APPROOT. '/commander/virus/modals.php' ?>

<?php   require APPROOT .'/includes/Panelfooter.php';?>
<script type="text/javascript">
  $(document).ready(function(){

    $('#addAuthBtn').click(function(e){
      if ($('#admin-add-form')[0].checkValidity()) {
        e.preventDefault();
        $('#addAuthBtn').val('Please wait...');
        $.ajax({
          url: 'virus/virus.php',
          method: 'post',
          data: $('#admin-add-form').serialize()+'&action=generate',
          success:function(response){
            if ($.trim(response) === 'granted') {
              $('#addAuthBtn').val('Grant Permission');
              $('#admin-add-form')[0].reset();
              window.location = '<?= $_SERVER['PHP_SELF']; ?>';
              // change this later
            }else{
              $('#regError').html(response).fadeIn('slow')
              setTimeout(function(){
                $('#regError').html(response).fadeOut('slow');
              }, 10000);
            }
          }
        });
      }
    });

    fetchCommanders();
    function   fetchCommanders(){
      $.ajax({
        url: 'virus/commander-process.php',
        method: 'post',
        data: {action: 'fetch_commanders'},
        success:function(response){
          $('#showCommanders').html(response);
          $('#showCommand').DataTable({
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
      })
    }

    //Delete tutorial

  $("body").on("click", ".trashTutIcon", function(e){
    e.preventDefault();
    delTut_id = $(this).attr('id');
    Swal.fire({
        title: 'Are you sure?',
        text: "Tutorial will be Trashed!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, trash it!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: 'virus/commander-process.php',
            method: 'POST',
            data: {delTut_id: delTut_id},
            success:function(response){
              Swal.fire(
                'Tutorial Trashed!',
                'Tutorial Trashed successfully',
                'success'
              )
              fetchCommanders();

            }
          });

        }
      });

  });



  //showfile Names
  // $('input[name="file[]"]').change(function(e){
  //          var fileName = e.target.files[0].name;
  //          $('#showFileNames').html(fileName +  ' has been selected.')
  //  });


  //Fetch source Details
  $('body').on('click', '.commandDetailsIcon', function(e){
    e.preventDefault();
    commander_id = $(this).attr('id');
    $.ajax({
      url: 'virus/commander-process.php',
      method: 'post',
      data: {commander_id: commander_id},
      success:function(response){
        $('#FetchCommanderDetail').html(response);
      }
    });
  });


//edit commanders
$("body").on("click", ".editCommandBtn", function(e){
         e.preventDefault();
         commanderedit_id = $(this).attr('id');
         $.ajax({
           url: 'virus/commander-process.php',
           method: 'POST',
           data: {commanderedit_id: commanderedit_id},
           success:function(response){
           data = JSON.parse(response);
             $('#commanderID').val(data.command_id);
             $('#commander_name').val(data.commander_name);
             $('#commander_email').val(data.commander_email);
             $('#commander_tel').val(data.commander_phone_no);
             $('#commander_permission').val(data.commander_permissions);

           }
         });
     });

     //Update Note
     $("#editAuthBtn").click(function(e){
       if ($("#admin-edit-form")[0].checkValidity()) {
         e.preventDefault();
         $.ajax({
           url: 'virus/commander-process.php',
           method: 'POST',
           data: $('#admin-edit-form').serialize()+'&action=update_permission',
           success:function(response){
             Swal.fire({
               title: 'Commander Updated Successfully!',
               type: 'success'
             });
             $('#admin-edit-form')[0].reset();
             $('#editCommandModal').modal('hide');
             fetchCommanders();

           }
         });
       }
     });

  });
</script>
<!-- <script type="text/javascript" src="notify.js"></script> -->
