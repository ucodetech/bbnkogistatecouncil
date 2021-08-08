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
              <div class="card-group">
                <div class="card border-secondary">
                  <h1 class="card-header bg-secondary  d-flex justify-content-between">
                    <span class="lead align-self-center text-lg">&nbsp; Presidents</span>
                      <a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#addPresidents"> <i class="fas fa-plus-circle fa-lg"></i>&nbsp; Add</a>
                  </h1>

                <div class="card-body">
                  <div class="table-responsive" id="presidentTable">
                    <p class="text-center align-self-center lead"><img src="<?= URLROOT;  ?>gif/success.gif"> Please Wait...</p>

                  </div>
                </div>
                </div>
                <div class="card border-primary">
                  <h1 class="card-header bg-primary  d-flex justify-content-between">
                    <span class="lead align-self-center text-lg">&nbsp;Vice Presidents</span>
                      <a href="#" class="btn btn-info" data-toggle="modal" data-target="#addVPresidents"> <i class="fas fa-plus-circle fa-lg"></i>&nbsp; Add</a>
                  </h1>
                <div class="card-body">
                  <div class="table-responsive" id="vicepresidentTable">
                    <p class="text-center align-self-center lead"><img src="<?= URLROOT;  ?>gif/tra.gif"> Please Wait...</p>

                  </div>
                </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row mt-5">
              <div class="col-lg-12">
                <div class="card-group">
                  <div class="card border-secondary">
                    <h1 class="card-header bg-secondary  d-flex justify-content-between">
                      <span class="lead align-self-center text-lg">&nbsp;SSO</span>
                        <a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#addSSO"> <i class="fas fa-plus-circle fa-lg"></i>&nbsp; Add</a>
                    </h1>
                  <div class="card-body">
                    <div class="table-responsive" id="ssoTable">
                      <p class="text-center align-self-center lead"><img src="<?= URLROOT;  ?>gif/trans.gif"> Please Wait...</p>

                    </div>
                  </div>
                  </div>
                  <div class="card border-warning">
                    <h1 class="card-header bg-warning  d-flex justify-content-between">
                      <span class="lead align-self-center text-lg">&nbsp;ASSO</span>
                        <a href="#" class="btn btn-info" data-toggle="modal" data-target="#addASSO"> <i class="fas fa-plus-circle fa-lg"></i>&nbsp; Add</a>
                    </h1>
                  <div class="card-body">
                    <div class="table-responsive" id="assoTable">
                      <p class="text-center align-self-center lead"><img src="<?= URLROOT;  ?>gif/bar.gif"> Please Wait...</p>

                    </div>
                  </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row mt-5">
                <div class="col-lg-12">
                  <div class="card-group">
                    <div class="card border-secondary">
                      <h1 class="card-header bg-warning  d-flex justify-content-between">
                        <span class="lead align-self-center text-lg">&nbsp;Treasures</span>
                          <a href="#" class="btn btn-info" data-toggle="modal" data-target="#addTreasures"> <i class="fas fa-plus-circle fa-lg"></i>&nbsp; Add</a>
                      </h1>
                    <div class="card-body">
                      <div class="table-responsive" id="treaTable">
                        <p class="text-center align-self-center lead"><img src="<?= URLROOT;  ?>gif/trans.gif"> Please Wait...</p>

                      </div>
                    </div>
                    </div>
                    <div class="card border-warning">
                      <h1 class="card-header bg-warning  d-flex justify-content-between">
                        <span class="lead align-self-center text-lg">&nbsp; Financial Secretaries</span>
                          <a href="#" class="btn btn-info" data-toggle="modal" data-target="#addFinSec"> <i class="fas fa-plus-circle fa-lg"></i>&nbsp; Add</a>
                      </h1>

                    <div class="card-body">
                      <div class="table-responsive" id="finsecTable">
                        <p class="text-center align-self-center lead"><img src="<?= URLROOT;  ?>gif/bar.gif"> Please Wait...</p>

                      </div>
                    </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row mt-5">
                  <div class="col-lg-12">
                    <div class="card-group">
                      <div class="card border-primary">
                        <h1 class="card-header bg-warning  d-flex justify-content-between">
                          <span class="lead align-self-center text-lg">&nbsp;Auditors</span>
                            <a href="#" class="btn btn-info" data-toggle="modal" data-target="#addAud"> <i class="fas fa-plus-circle fa-lg"></i>&nbsp; Add</a>
                        </h1>
                      <div class="card-body">
                        <div class="table-responsive" id="audTable">
                          <p class="text-center align-self-center lead"><img src="<?= URLROOT;  ?>gif/trans.gif"> Please Wait...</p>

                        </div>
                      </div>
                      </div>
                      <div class="card border-info">
                        <h1 class="card-header bg-warning  d-flex justify-content-between">
                          <span class="lead align-self-center text-lg">&nbsp;PRO's</span>
                            <a href="#" class="btn btn-info" data-toggle="modal" data-target="#addpro"> <i class="fas fa-plus-circle fa-lg"></i>&nbsp; Add</a>
                        </h1>
                      <div class="card-body">
                        <div class="table-responsive" id="proTable">
                          <p class="text-center align-self-center lead"><img src="<?= URLROOT;  ?>gif/bar.gif"> Please Wait...</p>

                        </div>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row mt-5">
                    <div class="col-lg-12">
                      <div class="card-group">
                        <div class="card border-primary">
                          <h1 class="card-header bg-warning  d-flex justify-content-between">
                            <span class="lead align-self-center text-lg">&nbsp;                        Disciplinary Officers</span>
                              <a href="#" class="btn btn-info" data-toggle="modal" data-target="#addDO"> <i class="fas fa-plus-circle fa-lg"></i>&nbsp; Add</a>
                          </h1>

                        <div class="card-body">
                          <div class="table-responsive" id="doTable">
                            <p class="text-center align-self-center lead"><img src="<?= URLROOT;  ?>gif/trans.gif"> Please Wait...</p>

                          </div>
                        </div>
                        </div>
                        <div class="card border-info">
                          <h1 class="card-header bg-warning  d-flex justify-content-between">
                            <span class="lead align-self-center text-lg">&nbsp;                        Parade Commandes</span>
                              <a href="#" class="btn btn-info" data-toggle="modal" data-target="#addPC"> <i class="fas fa-plus-circle fa-lg"></i>&nbsp; Add</a>
                          </h1>
                        <div class="card-body">
                          <div class="table-responsive" id="pcTable">
                            <p class="text-center align-self-center lead"><img src="<?= URLROOT;  ?>gif/tra.gif"> Please Wait...</p>

                          </div>
                        </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row mt-5">
                      <div class="col-lg-12">
                        <div class="card-group">
                          <div class="card border-primary">
                            <h1 class="card-header bg-warning  d-flex justify-content-between">
                              <span class="lead align-self-center text-lg">&nbsp;                        Chaplains</span>
                                <a href="#" class="btn btn-info" data-toggle="modal" data-target="#addCHA"> <i class="fas fa-plus-circle fa-lg"></i>&nbsp; Add</a>
                            </h1>
                          <div class="card-body">
                            <div class="table-responsive" id="chapTable">
                              <p class="text-center align-self-center lead"><img src="<?= URLROOT;  ?>gif/success.gif"> Please Wait...</p>

                            </div>
                          </div>
                          </div>
                          <div class="card border-info">
                            <h1 class="card-header bg-info  d-flex justify-content-between">
                              <span class="lead align-self-center text-lg">&nbsp; Quarter masters </span>
                                <a href="#" class="btn btn-info" data-toggle="modal" data-target="#addQB"> <i class="fas fa-plus-circle fa-lg"></i>&nbsp; Add</a>
                            </h1>
                          <div class="card-body">
                            <div class="table-responsive" id="qbTable">
                              <p class="text-center align-self-center lead"><img src="<?= URLROOT;  ?>gif/bar.gif"> Please Wait...</p>

                            </div>
                          </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-lg-12">
                          <div class="card-group">
                            <div class="card border-info">
                              <h1 class="card-header bg-info  d-flex justify-content-between">
                                <span class="lead align-self-center text-lg">&nbsp; Band masters </span>
                                  <a href="#" class="btn btn-info" data-toggle="modal" data-target="#addBM"> <i class="fas fa-plus-circle fa-lg"></i>&nbsp; Add</a>
                              </h1>
                            <div class="card-body">
                              <div class="table-responsive" id="bmTable">
                                <p class="text-center align-self-center lead"><img src="<?= URLROOT;  ?>gif/bar.gif"> Please Wait...</p>

                              </div>
                            </div>
                            </div>
                          </div>
                        </div>
                      </div>

                    <div class="row mt-5">
                        <div class="col-lg-12">
                          <div class="card-group">
                            <div class="card border-primary">
                              <h1 class="card-header bg-primary  d-flex justify-content-between">
                                <span class="lead align-self-center text-lg">&nbsp;  Pionier Members </span>
                                  <a href="#" class="btn btn-info" data-toggle="modal" data-target="#addPM"> <i class="fas fa-plus-circle fa-lg"></i>&nbsp; Add</a>
                              </h1>

                            <div class="card-body">
                              <div class="table-responsive" id="pmTable">
                                <p class="text-center align-self-center lead"><img src="<?= URLROOT;  ?>gif/trans.gif"> Please Wait...</p>

                              </div>
                            </div>
                            </div>
                            <div class="card border-info">
                              <h1 class="card-header bg-primary  d-flex justify-content-between">
                                <span class="lead align-self-center text-lg">&nbsp; Patrons/Patronesses</span>
                                  <a href="#" class="btn btn-info" data-toggle="modal" data-target="#addPP"> <i class="fas fa-plus-circle fa-lg"></i>&nbsp; Add</a>
                              </h1>

                            <div class="card-body">
                              <div class="table-responsive" id="ppTable">
                                <p class="text-center align-self-center lead"><img src="<?= URLROOT;  ?>gif/success.gif"> Please Wait...</p>

                              </div>
                            </div>
                            </div>
                          </div>
                        </div>
                      </div>
        </div>
      </div><!-- /.container-fluid -->
      <!-- /.content -->
    </div>
  <?php include APPROOT. '/commander/virus/modals.php' ?>
<?php   require APPROOT .'/includes/Panelfooter.php';?>
<script type="text/javascript" src="add-process.js"></script>
