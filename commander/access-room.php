<?php
require_once '../core/init.php';
if (!isCommanderGranted()) {
  Session::flash('message', 'Access Denied!');
  Redirect::to('command-access');

}
$incharge = new CadetConsole();
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
      <div class="container-fluid h-100">
        <div class="row justify-content-center">
          <div class="col-lg-12">
            <div class="card rounded-0 mt-3 border-primary">
              <div class="card-header border-primary">
                <ul class="nav nav-tabs card-header-tabs">
                  <li class="nav-item">
                    <a href="#Userprofile" class="nav-link active font-weight-bold" data-toggle="tab">Profile</a>
                  </li>
                  <li class="nav-item">
                    <a href="#editProfile" class="nav-link font-weight-bold" data-toggle="tab">Edit Profile</a>
                  </li>
                  <li class="nav-item">
                    <a href="#changePassword" class="nav-link  font-weight-bold" data-toggle="tab">Change Password</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content">
                  <?php if (Session::exists('danger')){
                    echo Session::flash('danger');
                  }
                   ?>
                  <!-- Profile tab content start -->
                  <div class="tab-pane container active" id="Userprofile">

                    <div class="card-deck">
                      <div class="card shadow-lg border-primary" style="border:1px solid blue">
                        <div class="card-header bg-primary text-light text-center lead">
                          Commander ID:  <?php echo $incharge->data()->command_id; ?>
                        </div>
                        <div class="card-body">
                          <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>Name: </b> <?php echo $incharge->data()->commander_name ?>
                          </p>
                          <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>E-mail: </b> <?php echo $incharge->data()->commander_email; ?>
                          </p>
                          <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>Home Church: </b> <?php echo $incharge->data()->commander_home_church; ?>
                          </p>
                          <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>Permission: </b> <?php echo $incharge->data()->commander_permissions ;?>
                          </p>
                          <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>Phone Number: </b> <?php echo $incharge->data()->commander_phone_no; ?>
                          </p>
                          <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>Registerd On: </b> <?php
                          echo pretty_dates($incharge->data()->dateAdded);
                           ?>
                          </p>

                          <div class="clear-fix"> </div>
                        </div>
                      </div>
                      <div class="card shadow-lg border-primary text-center">
                       <img src='faceRecond/<?=$incharge->data()->profile_pic;?>' class='img-thumbnail img-fluid' alt='User Image'  style="border:3px double navy; border-radius:50%; width:300px;height:300px;margin:10px auto">
                       <span style="border:3px double navy;"><?php echo $incharge->data()->commander_name ?></span>
                      </div>
                    </div>
                  </div>
                    <!-- End Profile tab content -->
                      <!-- Edit Profile tab content start -->
          <div class="tab-pane container fade" id="editProfile">
            <div class="card-deck">
              <div class="card  shadow-lg border-primary text-center">
               <img src='faceRecond/<?=$incharge->data()->profile_pic;?>' class='img-thumbnail img-fluid' alt='User Image'  style="border:3px double navy; border-radius:50%; width:300px;height:300px;margin:10px auto">
               <span style="border:3px double navy;"><?php echo $incharge->data()->commander_name ?></span>
              </div>
              <div class="card shadow-lg border-danger" style="border: 1px solid red">
                <form  action="#" method="post" class="px-3 m2" enctype="multipart/form-data" id="editProfileForm">
              <div class="form-group m-0">
                <label for="profilePhoto">Profile (jpg only)</label>
               <div class="custom-file">
                 <input type="file" name="profilePhoto" id="profilePhoto"
                 class="custom-file-input">
                  <label for="profilePhoto" class="custom-file-label">Upload Profile Image</label>
               </div>
              </div>
              <div class="form-group m-2">
                <input type="submit" name="profile_update" value="Update Profile" class="btn btn-warning btn-block" id="profileUpdateBtn">
              </div>
            </form>

            <form  action="#" method="post" class="px-3 m2" id="editDetailsForm">
              <div class="form-group m-0">
                <label for="commander_full_name" class="m-1">Full Name</label>
                <input type="text" name="commander_full_name" id="commander_full_name" class="form-control" value="<?php echo $incharge->data()->commander_name?>">
              </div>

                <div class="form-group m-0">
                  <label for="commander_phone_number" class="m-1">Phone Number</label>
                    <input type="tel" name="commander_phone_number" id="phone_number" value="<?php echo $incharge->data()->commander_phone_no ?>" class="form-control" placeholder="Phone Number">
                </div>
                <div class="form-group m-0">
                  <label for="commander_home_church" class="m-1">Home Church</label>
                    <input type="text" name="commander_home_church" id="commander_home_church" value="<?php echo $incharge->data()->commander_home_church ?>" class="form-control" placeholder="Home Church">
                </div>

                <div class="form-group m-2">
                  <input type="submit" name="detail_update" value="Update Details" class="btn btn-danger btn-block" id="DetailUpdateBtn">
                </div>
                </form>
                <div id="proAlert">

                </div>
              </div>
            </div>
          </div>
            <!--Edit Profile tab content End -->

                        <!-- change password tab content -->
              <div class="tab-pane container fade" id="changePassword">
                <div id="changePasAlert">  </div>
                          <div class="card-deck">
                            <div class="card shadow-lg border-danger" style="border:1px solid red">
                              <div class="card-header bg-danger text-white text-center lead">
                                Overide Access Key
                              </div>
                              <form class="px-3 mt-2" action="#" method="post" id="change-password-form">
                                <div class="input-group input-group-lg form-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0">
                                    <i class="fa fa-key  fa-lg"></i>
                                  </span>
                                  </div>
                                  <input type="password" name="current-password" id="current-password" class="form-control form-control-lg" placeholder="Existing Key" autocomplete="false">
                                </div>
                                <div class="input-group input-group-lg form-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0">
                                    <i class="fa fa-key  fa-lg"></i>
                                  </span>
                                  </div>
                                  <input type="password" name="new-password" id="new-password" class="form-control form-control-lg" placeholder="Key 1" autocomplete="false">
                                </div>
                                <div class="input-group input-group-lg form-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0">
                                    <i class="fa fa-key  fa-lg"></i>
                                  </span>
                                  </div>
                                  <input type="password" name="confirm-new-password" id="confirm-new-password" class="form-control form-control-lg" placeholder="Key 2" autocomplete="false">
                                </div>

                                <div class="form-group mt-2">
                                  <input type="submit" name="changePassBtn" id="changePassBtn" value="Overide Key" class="btn btn-danger btn-block btn-lg">
                                </div>
                                <div class="form-group">
                                  <p id="changePasError" class="text-danger"></p>
                                </div>
                              </form>
                            </div>
                            <div class="card border-danger align-self-center"  style="border:1px solid red">
                              <img src="<?= URLROOT; ?>gif/cga.png" alt="change password" class="img-thumbnail img-fluid" width="508px">
                            </div>
                          </div>

                        </div>
                        <!-- End change password tab content -->

                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>

<!-- /.container-fluid -->
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->



<?php
  require APPROOT .'/includes/Panelfooter.php';

  ?>
  <script type="text/javascript">
    $(document).ready(function(){
      $('#editProfileForm').submit(function(e){
        e.preventDefault();
        $.ajax({
          url: 'virus/virus.php',
          method: 'POST',
          processData: false,
          contentType: false,
          cache: false,
          data: new FormData(this),
          success:function(response){
            if ($.trim(response) === 'success') {
              location.reload();
            }else{
              $('#proAlert').html(response);
            }
          }
        })
      })

      $('#DetailUpdateBtn').click(function(e){
        if($('#editDetailsForm')[0].checkValidity()){
          e.preventDefault();
          $.ajax({
            url: 'virus/virus.php',
            method: 'POST',
            data: $('#editDetailsForm').serialize()+'&action=updateRecord',
            beforeSend:function(){
              $('#DetailUpdateBtn').val('Please wait...');
            },
            success:function(response){
              console.log(response);
              if ($.trim(response) === 'success') {
                location.reload();
              }else{
                $('#proAlert').html(response);
              }

          },
          complete:function(){
            $('#DetailUpdateBtn').val('Update details');
          }
        });
      }
      });
      //change Password
      $('#changePassBtn').click(function(e){
        if ($('#change-password-form')[0].checkValidity()) {
          e.preventDefault();
          $('#changePassBtn').val('Please wait....');
          if ($('#new-password').val() != $('#confirm-new-password').val()) {
            $('#changePasError').html('* Password mismatch!');
                $('#changePassBtn').val('Change Password');
          }else{
            $.ajax({
              url: 'virus/virus.php',
              method: 'POST',
              data: $('#change-password-form').serialize()+'&action=overide',
              success:function(response){
                $('#changePasAlert').html(response);
                $('#changePassBtn').val('Change Password');
                $('#changePasError').html('');
                $('#change-password-form')[0].reset();
              }
            })
          }
        }
      });


    });
  </script>
