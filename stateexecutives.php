  <?php
    require_once 'core/init.php';
    require_once APPROOT . '/includes/head.php';
    require_once APPROOT . '/includes/nav.php';

?>

  <div class="container-fluid bg-light">
  	<h4 class="text-center font-weight-bold text-dark">STATE EXECUTIVES <br>
        SURE AND STEADFAST </h4> <hr>
  	<div class="row  justify-content-center">
  		<div class="col-lg-5">
  	<div class="card mt-auto mb-3 mt-3">
      <div class="card-header">
        <h4 class="text-center text-dark px-3 align-self-center"><?= $stateP->president_office?></h4>
      </div>
      <div class="card-body align-self-center">
        <img src="uploads/sso-president/<?= $stateP->president_image?>" width="408" style="height:405px !important;" class="thumbnail img-fluid lazy" alt="<?= $stateP->president_name?>"><br>
        <span class="text-center text-dark"><?= $stateP->president_name?>
          <a href="#" data-toggle="modal" data-target="#statePresidentProfile" id="<?= $stateP->id ?>" class="btn btn-info btn-sm btn-block presidentDetailIcon"><i class="fa fa-info-circle"></i>&nbsp;More Info </a>
        </span>
      </div>
    </div>
</div>
  		
  <div class="col-lg-5">
    <div class="card mt-auto mb-3 mt-3">
      <div class="card-header">
        <h4 class="text-center text-dark px-3 align-self-center"> <?= $stateS->sso_office?></h4>
      </div>
      <div class="card-body align-self-center">
        <img src="uploads/sso-president/<?= $stateS->sso_image?>" width="408" style="height:405px !important;" class="thumbnail img-fluid lazy" alt="<?= $stateS->sso_name?>"><br>
        <span class="text-center text-dark"><?= $stateS->sso_name?>
          <a href="#" data-toggle="modal" data-target="#stateSSOProfile" id="<?= $stateS->id?>" class="btn btn-info btn-sm btn-block ssoDetailIcon"><i class="fa fa-info-circle"></i>&nbsp;More Info </a>
        </span>
      </div>
    </div>]
</div>
  	</div>
  <div class="row justify-content-center" style="display:block">
          <div class="col-lg-12">

        <div class="card  rounded-right text-dark p-2">
        
        <hr class="my-3 bg-light ucodeHr">
        <div class="row text-dark">

          <?php foreach ($historyBBStateExe as $stateExec): ?>
          <div class="col-md-4">
            <ul class="list-unstyled m-0">
          <a href="#" id="<?=$stateExec->id?>"  data-target="#stateExecDetail" data-toggle="modal" title="View Details" class="page-link border-0 stateExecutiveDetialIcon">
            <li class="media" >
              <img data-src="uploads/executives/<?= $stateExec->exective_image ?>" class="img-thumbnail lazy"  src="uploads/executives/<?= $stateExec->exective_image ?>" alt="<?= $stateExec->exective_name ?>" width="130">
              <div class="media-body ml-2">
                <h6 class="text-info mb-1"><?= $stateExec->exective_name ?></h6>
                <span class="text-center"><?= $stateExec->executive_office ?></span>
              </div>
            </li>
          </a>

        </ul>
          </div>
        <?php endforeach; ?>


        </div>

        </div>


        </div>

        </div>
    </div>

<?php require_once APPROOT . '/includes/footer.php';?>
<script type="text/javascript">
$(document).ready(function(){

  $(document).on('click', '.stateExecutiveDetialIcon', function(e){
    e.preventDefault();
    execute_id = $(this).attr('id');
    $.ajax({
      url: 'process.php',
      method: 'post',
      data: {execute_id: execute_id},
      success:function(response){
        data = JSON.parse(response);
        $('#getNameState').html(data.exective_name);
        $('#getNameState2').html(data.exective_name);
        $('#getProfile').html(data.exective_description);
        $('#getOfficeState').html(data.executive_office);

        $('#getImageState').html('<img data-src="uploads/executives/'+data.exective_image+'" class="img-thumbnail lazy"  src="uploads/executives/'+data.exective_image+'" alt="'+data.exective_name+'" width="408">');
      }
    })
  })


  $(document).on('click', '.ssoDetailIcon', function(e){
    e.preventDefault();
    topsso_id = $(this).attr('id');
    $.ajax({
      url: 'process.php',
      method: 'post',
      data: {topsso_id: topsso_id},
      success:function(response){
        $('#ssoDetail').html(response);
        
      }
    });
  });

  $(document).on('click', '.presidentDetailIcon', function(e){
    e.preventDefault();
    toppre_id = $(this).attr('id');
    $.ajax({
      url: 'process.php',
      method: 'post',
      data: {toppre_id: toppre_id},
      success:function(response){
      $('#statePresident').html(response);

      }
    });
  });


})
</script>
