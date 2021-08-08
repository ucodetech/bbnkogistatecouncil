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
  <div class="row justify-content-center my-2">
    <div class="col-lg-6 mt-4" id="showAlertNotification">

  </div>
</div>
</div>
<?php require APPROOT .'/includes/footer2.php'; ?>
<script type="text/javascript" src="notificationjs.js"></script>
