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
        <h3 class="text-center text-bold text-lg">Coming soon</h3>
        </div>
      </div>

<!-- /.container-fluid -->
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->



<?php
  require APPROOT .'/includes/Panelfooter.php';

  ?>
