<?php
require_once '../core/init.php';
 if (!isLoggedInOfficer()) {
      Session::flash('access-denied', 'Access Denied! You must login to access the page');
      Redirect::to('access');
    }
    if (!hasPermission()) {
      Session::flash('access-denied', 'Access Denied! You have permission to access that page');
      Redirect::to('access');
    }
require APPROOT .'/includes/head2.php';
require APPROOT .'/includes/navs.php';
?>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
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
                <div id="verifyEmailAlert">  </div>
                <div class="card-deck">
                  <div class="card border-primary" style="border:1px solid blue">
                    <div class="card-header bg-primary text-light text-center lead">
                      State ID:  <?php echo $officer->stateNo; ?>
                    </div>
                    <div class="card-body">
                      <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>Name: </b> <?php echo $officer->officers_name ?>
                      </p>
                      <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>E-mail: </b> <?php echo $officer->officers_email; ?>
                      </p>
                      <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>Gender: </b> <?php echo $officer->officers_gender; ?>
                      </p>
                      <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>DOB: </b> <?php echo $officer->officers_dob ;?>
                      </p>
                     
                      <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>Phone Number: </b> <?php echo $officer->officers_phone_no; ?>
                      </p>
                      <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>Registerd On: </b> <?php echo pretty_dates($officer->date_joined); ?>
                      </p>
                      <p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>E-mail Verified: </b>
                        <?php
                        $verified = 'E-mail Verified!';
                        $notverfied = 'E-mail not Verified!';
                        if ($officer->verified== 0) {
                        ?>
                        <small class="text-danger">
                          <?php echo $notverfied ;?>&nbsp;
                          <a href="#" id="verify-email">Verify now!</a>
                        </small>

                        <?

                      }else{
                        ?>
                        <small class="text-success"><?php echo $verified; ?></small>
                        <?
                      }

                       ?>
                      </p>
                      <div class="clear-fix"> </div>
                    </div>
                  </div>
                  <div class="card border-primary align-self-center"  style="border:1px solid blue">
                    <?php
                    if ($profile->status == 0){
                      echo "<img src='avaters/avaters".$officer->officer_id.".jpg?'".mt_rand()."
		                 class='img-thumbnail img-fluid' alt='User Image' width='408px'>";
                   }else{
                     echo "<img src='avaters/default.png' class='img-thumbnail img-fluid' alt='Default' width='408px'>";
                   }

                     ?>


                  </div>
                </div>
              </div>
                <!-- End Profile tab content -->
                  <!-- Edit Profile tab content start -->
      <div class="tab-pane container fade" id="editProfile">
        <div class="card-deck">
          <div class="card border-danger align-self-center" style="border: 1px solid red">
            <?php
            if ($profile->status == 0){
              echo "<img src='avaters/avaters".$officer->officer_id.".jpg?'".mt_rand()."
             class='img-thumbnail img-fluid' alt='User Image' width='408px'>";
           }else{
             echo "<img src='avaters/default.png' class='img-thumbnail img-fluid' alt='Default' width='408px'>";
           }
             ?>
          </div>
          <div class="card border-danger" style="border: 1px solid red">
            <form  action="#" method="post" class="px-3 m2" enctype="multipart/form-data" id="editProfileForm">
          <div class="form-group m-0">
            <label for="profilePhoto">Profile (jpg only)</label>
           <div class="custom-file">
             <input type="file" name="profilePhoto" id="profilePhoto"
             class="custom-file-input">
              <label for="profilePhoto" class="custom-file-label">Upload Profile Image</label>
           </div>
          </div>
          <div class="form-group m-0">
            <label for="full_name" class="m-1">Full Name</label>
            <input type="text" name="full_name" id="full_name" class="form-control" value="<?php echo $officer->officers_name ?>">
          </div>
          <div class="form-group m-0">
            <label for="gender" class="m-1">Gender</label>
              <select class="form-control" name="gender" id="gender">
                <option value="" disabled <?php if($officer->officers_gender == null){echo 'selected';} ?>>Select</option>
                <option value="male" <?php if($officer->officers_gender == 'male'){echo 'selected';} ?>>Male</option>
                <option value="female" <?php if($officer->officers_gender == 'female'){echo 'selected';} ?>>Female</option>
                <option value="none">Chose not to say</option>
              </select>
            </div>
            <div class="form-group m-0">
              <label for="dob" class="m-1">Date of Birth</label>
                <input type="date" name="dob" id="dob" value="<?php echo $officer->officers_dob ?>" class="form-control">
            </div>
            <div class="form-group m-0">
              <label for="phone_number" class="m-1">Phone Number</label>
                <input type="tel" name="phone_number" id="phone_number" value="<?php echo $officer->officers_phone_no ?>" class="form-control" placeholder="Phone Number">
            </div>
           
            <div class="form-group m-2">
              <input type="submit" name="profile_update" value="Update Profile" class="btn btn-danger btn-block" id="profileUpdateBtn">
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
                        <div class="card border-success" style="border:1px solid green">
                          <div class="card-header bg-success text-white text-center lead">
                            Change Password
                          </div>
                          <form class="px-3 mt-2" action="#" method="post" id="change-password-form">
                            <div class="input-group input-group-lg form-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text rounded-0">
                                <i class="fa fa-key  fa-lg"></i>
                              </span>
                              </div>
                              <input type="password" name="current-password" id="current-password" class="form-control form-control-lg" placeholder="Current Password" autocomplete="false">
                            </div>
                            <div class="input-group input-group-lg form-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text rounded-0">
                                <i class="fa fa-key  fa-lg"></i>
                              </span>
                              </div>
                              <input type="password" name="new-password" id="new-password" class="form-control form-control-lg" placeholder="New  Password" autocomplete="false">
                            </div>
                            <div class="input-group input-group-lg form-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text rounded-0">
                                <i class="fa fa-key  fa-lg"></i>
                              </span>
                              </div>
                              <input type="password" name="confirm-new-password" id="confirm-new-password" class="form-control form-control-lg" placeholder="Confrim New Password" autocomplete="false">
                            </div>

                            <div class="form-group mt-2">
                              <input type="submit" name="changePassBtn" id="changePassBtn" value="Change Password" class="btn btn-success btn-block btn-lg">
                            </div>
                            <div class="form-group">
                              <p id="changePasError" class="text-danger"></p>
                            </div>
                          </form>
                        </div>
                        <div class="card border-success align-self-center"  style="border:1px solid green">
                          <img src="avaters/cga.png" alt="change password" class="img-thumbnail img-fluid" width="408px">
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

<?php require APPROOT .'/includes/footer2.php'; ?>
<script type="text/javascript">
  $(document).ready(function(){
    $('#editProfileForm').submit(function(e){
      e.preventDefault();
      $.ajax({
        url: 'scripts/pro-action.php',
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
            url: 'scripts/pro-action.php',
            method: 'POST',
            data: $('#change-password-form').serialize()+'&action=change_pass',
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

    //Verify email ajax
    $("#verify-email").click(function(e){
      e.preventDefault();
      $(this).text('Please wait...');
      $.ajax({
        url: 'scripts/pro-action.php',
        method: 'POST',
        data: {action: 'verify_email'},
        success:function(response){
          $('#verifyEmailAlert').html(response);
          $('#verify-email').text('Verify Now');
        }
      });
    });

  });
</script>
<script type="text/javascript" src="notificationjs.js"></script>
