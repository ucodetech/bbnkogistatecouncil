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
            <div class="card-deck mt-3 text-light text-center font-weight-bold">
              <div class="card bg-primary">
                <div class="card-header">
                  <i class="fas fa-users fa-lg"></i>
                  Export Officers
                </div>
                <div class="card-body">
                  <h1 class="display-4" >
                    <a href="<?php echo URLROOT; ?>commander/virus/process.php?export=officers" class="btn btn-light btn-block btn-lg"><i class="fas fa-table"></i> Officers Table</a>
                  </h1>
                </div>
              </div>
              <div class="card bg-success">
                <div class="card-header">
                    <i class="fas fa-bell fa-lg"></i>Export Data Form Boys
                </div>
                <div class="card-body">
                  <h1 class="display-4">
                    <a href="<?php echo URLROOT; ?>commander/virus/process.php?export=dataBoys" class="btn btn-light btn-block btn-lg"><i class="fas fa-table"></i> Data Form Boys Table</a>
                  </h1>
                </div>
              </div>
              <div class="card bg-danger">
                <div class="card-header">
                <i class="fas fa-bell-o fa-lg"></i>Export Data Form Officers
                </div>
                <div class="card-body">
                  <h1 class="display-4">
                    <a href="<?php echo URLROOT; ?>commander/virus/process.php?export=dataOfficers" class="btn btn-light btn-block btn-lg"><i class="fas fa-table"></i> Officers Data Form</a>
                  </h1>
                </div>
              </div>
              <div class="card bg-info">
                <div class="card-header">
                <i class="fas fa-comment-dots fa-lg"></i> Export Data Form Mothers
                </div>
                <div class="card-body">
                  <h1 class="display-4">
                    <a href="<?php echo URLROOT; ?>commander/virus/process.php?export=dataMothers" class="btn btn-light btn-block btn-lg"><i class="fas fa-table"></i> Data Form Mothers Table</a>
                  </h1>
                </div>
              </div>
              <div class="card bg-warning">
                <div class="card-header">
                <i class="fas fa-book fa-lg"></i> Export Patrons
                </div>
                <div class="card-body">
                  <h1 class="display-4">
                    <a href="<?php echo URLROOT; ?>commander/virus/process.php?export=dataPatrons" class="btn btn-light btn-block btn-lg"><i class="fas fa-table"></i> Data Form Patrons Table</a>
                  </h1>
                </div>
              </div>
            </div>
          </div>
        </div>

         <div class="row">
          <div class="col-lg-12">
             <div class="card-deck mt-3 text-light text-center font-weight-bold">
               <div class="card bg-primary">
                <div class="card-header">
                  <i class="fas fa-users fa-lg"></i>
                  Export Officers in charge of data form
                </div>
                <div class="card-body">
                  <h1 class="display-4" >
                    <a href="<?php echo URLROOT; ?>commander/virus/process.php?export=controls" class="btn btn-light btn-block btn-lg"><i class="fas fa-table"></i> Data Form controllers</a>
                  </h1>
                </div>
              </div>
              <div class="card bg-info">
                <div class="card-header">
                  <i class="fas fa-users fa-lg"></i>
                  Total Number Of Each Councils
                </div>
                <div class="card-body">
                  <h1 class="display-4" >
                    <a href="<?php echo URLROOT; ?>commander/virus/process.php?export=summary" class="btn btn-light btn-block btn-lg"><i class="fas fa-table"></i> Data Form summary</a>
                  </h1>
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


<?php   require APPROOT .'/includes/Panelfooter.php';?>
<script type="text/javascript" src="notify.js"></script>
