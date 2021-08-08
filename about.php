<?php
    require_once 'core/init.php';
    require_once APPROOT . '/includes/head.php';
    require_once APPROOT . '/includes/nav.php';

?>

  <div class="container-fluid">
    <div class="row justify-content-center" style="display:block">
      <div class="col-lg-12">
    <div class="card-group ">
    <div class="card rounded-left"  style="flex-grow:1.0;">
    <h4 class=" card-header text-center text-primary mt-2">
      &nbsp;THE BOYS' BRIGADE
    </h4>
    <div class="card-body align-self-center">
      <img src="<?= URLROOT; ?>images/Boys-Brigade-logo-1.png" alt="Cadet BBN LOGO" class="img-fluid" width="208px">
    </div>
    </div>
    <div class="card  rounded-right text-dark p-2" style="flex-grow:1.6;">
    <h4 class="text-center font-weight-bold"><?=$historyBB->bb_title ?> <br>
    SURE AND STEADFAST   </h4>
    <hr class="my-3 bg-light ucodeHr">
    <p class="text-dark align-justify lead">
        <?=nl2br($historyBB->bb_description); ?> <br>
   <a href="https://en.wikipedia.org/wiki/Boys%27_Brigade" class="btn btn-primary btn-sm btn-block">Read more...</a> <br>&nbsp;

   <a href="#" class="btn btn-sm btn-warning btn-block" data-toggle="modal" data-target="#bbHisNig">History of Bridage in Nigeria</a>

    </p>

    <br>
        <p class="" style="display:block;">
          <ul class="list-unstyled m-0">
        <a href="https://en.wikipedia.org/wiki/William_Alexander_Smith_(Boys%27_Brigade)" class="page-link border-0">
          <li class="media">
            <img data-src="<?= URLROOT; ?>images/boysbrigade_16456011203.jpg" class="img-thumbnail lazy"  src="<?= URLROOT; ?>images/boysbrigade_16456011203.jpg" alt="Sir William Alexander Smith" width="130">
            <div class="media-body ml-2">
              <h6 class="text-info mb-1">Sir William Alexander Smith</h6>
              <p class="small text-muted m-0">
                Lived (27 October 1854 – 10 May 1914)
              </p>
            </div>
          </li>
        </a>
      </ul>
        </p>
    </div>
    </div>

    </div>

    </div>
<hr>
    <div class="row justify-content-center" style="display:block">
      <div class="col-lg-12">
    <div class="card rounded-left"  style="flex-grow:1.0;">
    <h4 class=" card-header text-center text-primary mt-2">
      &nbsp;THE BOYS' BRIGADE KOGI STATE COUNCIL
    </h4>
    <div class="card-body align-self-center">
      <img src="<?= URLROOT; ?>images/BBNSTATE.png" alt="STATE BBN LOGO" class="img-fluid" width="208px">
    </div>
    </div>
    <div class="card  rounded-right text-dark p-2" style="flex-grow:1.6;">
    <h4 class="text-center font-weight-bold"><?=$historyBBState->bb_title ?> <br>
    SURE AND STEADFAST   </h4>
    <hr class="my-3 bg-light ucodeHr">
    <p class="text-dark align-justify lead">
      <?=nl2br($historyBBState->bb_description) ?>
    </p><br>
      <div class="contianer">
        <div class="row">
          <div class="col-lg-6">
            <p class="text-dark align-justify lead">
                <?=nl2br($historyBBState->formation_creation) ?>
            </p>
          </div>
          <div class="col-lg-6">
            <p class="text-dark align-justify lead">
                <?=nl2br($historyBBState->other_apointees_reps) ?>
            </p>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-lg-6">
            <p class="text-dark align-justify lead">
                <?=nl2br($historyBBState->secretariat) ?>
            </p>
          </div>
          <div class="col-lg-6">
            <p class="text-dark align-justify lead">
                <?=nl2br($historyBBState->events) ?>
            </p>
          </div>
        </div>

          <div class="col-lg-12">
            <p class="text-dark align-justify lead">
                <?=nl2br($historyBBState->general_info) ?>
            </p>
          </div>


      </div>
    </div>

    </div>

    </div>
      
  </div>

<?php require_once APPROOT . '/includes/footer.php';?>

