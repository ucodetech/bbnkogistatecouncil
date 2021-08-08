<?php
require_once '../../core/init.php';
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

