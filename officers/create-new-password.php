<?php
require_once '../core/init.php';
require APPROOT .'/includes/head.php';
  $user = new Officer();
if (isset($_GET['selector']) && isset($_GET['validator'])) {
  $selector = $_GET['selector'];
  $validator = $_GET['validator'];
  $msg = '';

      if (empty($validator) || empty($selector)) {
        $msg = '<div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert">
              &times;
              </button>
              <strong class="text-center"> Something went wrong 1</strong> <br>
              </div>';
      }else{
        $reset =  $user->selectSelector($selector);
        if ($reset===false) {
          Session::flash('tokeExp', 'Token Expired');
          Redirect::to('../index');
        }
        if (isset($_POST['reset-submit'])) {

      $password = $user->test_input($_POST['password']);
      $cpassword = $user->test_input($_POST['cpassword']);

      $reset =  $user->selectSelector($selector);
      if (!$reset) {
        $msg = '<div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert">
              &times;
              </button>
              <strong class="text-center"> Token Expired</strong> <br>
              </div>';

      }else{

        $tokencheck = password_verify($validator, $reset->pwdResetToken);
        if ($tokencheck === false) {
          $msg = '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">
                &times;
                </button>
                <strong class="text-center"> Something went wrong 2</strong> <br>
                </div>';

        }elseif($tokencheck === true){
          $email = $reset->email;
          $userReset = $user->selectUser($email);
          if (strlen($password) < 10) {
            $msg = '<div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert">
                  &times;
                  </button>
                  <strong class="text-center">Password must be atleaset 10 characters</strong> <br>
                  </div>';
          }else{
          if ($password != $cpassword) {
            $msg = '<div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert">
                  &times;
                  </button>
                  <strong class="text-center"> Password Mismatch!</strong> <br>
                  </div>';
          }
        }
          $passwordhash = password_hash($password, PASSWORD_DEFAULT);
          $update = $user->updateUser($passwordhash, $email);

          if ($update===true) {
            $user->deleteToken($email);
            $msg = '<div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert">
                  &times;
                  </button>
                  <strong class="text-center"> You have successfully created a new password now you can login</strong> <br>
                  <a href="access" class="btn btn-success">Login</a>
                  </div>';
          }else{
            $msg = '<div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert">
                  &times;
                  </button>
                  <strong class="text-center"> Something went wrong 3</strong> <br>
                  </div>';
          }
        }
      }
      }
}
}
      ?>
      <div class="container">
      <div class="row justify-content-center wrapper">
        <div class="col-lg-10 my-auto">
          <div class="card-group  ucodeShadow">
            <div class="card justify-content-center rounded-right ucodeColor p-4">
              <h2 class="text-center font-weight-bold text-white">Welcome Back Dear Friend!</h2>
              <hr class="my-3 bg-light ucodeHr">
              <p class="text-center font-weight-bold text-light lead">
                Now you can create a new password Make sure its strong!
              </p>
              <div id="glass" class="fa text-center emo" style="font-size:50px; color:red"></div>

            </div>
            <div class="card rounded-left p-4" style="flex-grow:1.4;">
              <h4 class="text-center font-weight-bold text-primary">
              <i class="fa fa-key"></i>Create New Password
            </h4>
             <hr class="my-3">
             <div>
               <?php echo $msg; ?>
             </div>
             <form  action="#" method="post"  class="px-3">
               <!-- email  -->
               <input type="hidden" name="selector" value="<?php echo $selector; ?>">
               <input type="hidden" name="validator" value="<?php echo $validator; ?>">
               <div class="input-group input-group-lg form-group">
                 <div class="input-group-prepend">
                   <span class="input-group-text rounded-0">
                   <i class="fa fa-key  fa-lg"></i>
                 </span>
                 </div>
                 <input type="password" name="password"  class="form-control rounded-0" placeholder="Password" minlength="10">
               </div>
               <div class="input-group input-group-lg form-group">
                 <div class="input-group-prepend">
                   <span class="input-group-text rounded-0">
                   <i class="fa fa-key  fa-lg"></i>
                 </span>
                 </div>
                 <input type="password" name="cpassword"  class="form-control rounded-0" placeholder="Confirm New Password">
               </div>
               <div class="clearfix"> </div>
               <div class="form-group">
                 <button type="submit"  name="reset-submit" class="btn btn-success btn-lg btn-block ucodeBtn">
                   Create New Password
                 </button>
               </div>
             </form>
            </div>

          </div>

        </div>

      </div>
      </div>



<?php
require APPROOT .'/includes/footer.php';


?>
