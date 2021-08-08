<?php
    require_once 'core/init.php';
    require_once APPROOT . '/includes/head.php';
    require_once APPROOT . '/includes/nav.php';


?>
<style media="screen">
.bg-cadet{
    background: rgb(0, 0, 0); /* Fallback color */
    background: rgba(0, 0, 0, 0.5); /* Black background with 0.5 opacity */
    color: #f1f1f1; /* Grey text */
    width: auto; /* Full width */
    height: auto;
    border-radius: 20px;
}
.im{
  border-radius: 20px;
}

</style>

<div class="container-fluid">
  <div class="row">
  <div class="col-lg-8">
    <div class="row">
      <div class="col-lg-12" >
        <div id="carouselExampleCaptions" class="carousel carousel-fade border-warning" data-ride="carousel" style="height:380px !important; border-radius:20px">
  <ol class="carousel-indicators">
    <?php
    $i = 0;
    foreach ($slider as $image) {
      $actives = '';
      if ($i == 0) {
        $actives = 'active';
      }
          ?>
    <li data-target="#carouselExampleCaptions" data-slide-to="<?= $i ?>" class="<?=$actives ?>"></li>
    <?

       $i++;
    }


    ?>
  </ol>

  <div class="carousel-inner">
  <?php
  $i = 0;
   foreach ($slider as $image):
    $current = '';
      if ($i == 0 ) {
        $current = 'active';
      }
    ?>
    <div class="carousel-item <?= $current; ?>">
      <img src="<?php URLROOT; ?>uploads/slider/<?=$image->carousel_image ?>" class="d-block w-100  h-100 img-fluid im" alt="<?= $image->carousel_event?>">
      <div class="carousel-caption d-none d-md-block bg-cadet">
        <h5><?= $image->carousel_event?></h5>
        <p style="font-family: Times New Roman">
          <?php if ($image->carousel_description != ''): ?>
            <?= $image->carousel_description?>
            <?php else: ?>
              <span>State Council Event</span>
          <?php endif ?>
        </p>
      </div>
    </div>
     <?php
      $i++;
      endforeach ?>

  </div>

  <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
      </div>
      <div class="col-lg-12 mt-2">
      <div class="container-fluid  mt-1">
            <h1 class="text-center text-secondary "><i class="fa fa-newspaper fa-lg"></i>&nbsp;State Council News</h1><hr>

     <div class="row shadow-lg">
      <div class="col-lg-12">
        <div class="row animate__animated animate__bounce">
          <?php if ($news): ?>
          <?php foreach ($news as $now): ?>
                <div class="col-lg-4 shadow-lg">
                  <div class="card"
                 <a href="<?=URLROOT; ?>news/read/<?=$now->slug_url; ?>">
               <button class="btn btn-sm btn-info" ><i class="fas fa-book fa-lg"></i>&nbsp;Read Now</button>
                 </a>
                <div  class="card-body align-center">
                      <?=wrap($now->title); ?>
                 </div>
             </div>
                </div>

          <?php endforeach ?>
          <?php else: ?>
            <h5 class="text-center text-danger "><i class="fa fa-newspaper fa-lg"></i>&nbsp;No current News for now</h5><hr>

          <?php endif; ?>

         </div>
         <hr>

      </div>
    </div>
</div>
        <div class="card shadow-lg">
          <h4 class="card-header text-center bg-light text-info">Boys' Brigade Kogi State Council</h4>
          <div class="card-body bg-light">
        <div class="row text-dark">
          <div class="col-lg-6">
            <a href="trainingofficers">
              <div class="card">
                <div class="card-body">
                  Kogi State Council Training Officers
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-6">
            <a href="stategroupcouncil">
              <div class="card">
                <div class="card-body">
                  Kogi State Group Councils
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-6">
            <a href="statepresidents">
              <div class="card mt-2">
                <div class="card-body">
                  Kogi State Presidents
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-6">
            <a href="statevicepresidents">
              <div class="card mt-2">
                <div class="card-body">
                  Kogi State Vice Presidents
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-6">
            <a href="ssos">
              <div class="card mt-2">
                <div class="card-body">
                  State Secretary Organizers
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-6">
            <a href="assos">
              <div class="card mt-2">
                <div class="card-body">
                  Assistant State Secretary Organizers
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-6">
            <a href="statetreasures">
              <div class="card mt-2">
                <div class="card-body">
                State  Treasures
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-6">
            <a href="statefinsec">
              <div class="card mt-2">
                <div class="card-body">
                  Financial Secretaries
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-6">
            <a href="pros">
              <div class="card mt-2">
                <div class="card-body">
                  Public Relation Officers
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-6">
            <a href="dos">
              <div class="card mt-2">
                <div class="card-body">
                  Disciplinary Officers
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-6">
            <a href="paradecommanders">
              <div class="card mt-2">
                <div class="card-body">
                  Parade Commanders

                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-6">
            <a href="chaplains">
              <div class="card mt-2">
                <div class="card-body">
                  Chaplains
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-6">
            <a href="qmbm">
              <div class="card mt-2">
                <div class="card-body">
                  Quarter and Band masters

                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-6">
            <a href="pioniermembers">
              <div class="card mt-2">
                <div class="card-body">
                  Pionier Members
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-6">
            <a href="patronsp">
              <div class="card mt-2">
                <div class="card-body">
                  Patrons/Patronesses
                </div>
              </div>
            </a>
          </div>
            </div>
          </div>
          </div>
        </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="card mt-auto mb-3">
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

    <div class="card mt-auto mb-3">
      <div class="card-header">
        <h4 class="text-center text-dark px-3 align-self-center"> <?= $stateS->sso_office?></h4>
      </div>
      <div class="card-body align-self-center">
        <img src="uploads/sso-president/<?= $stateS->sso_image?>" width="408" style="height:405px !important;" class="thumbnail img-fluid lazy" alt="<?= $stateS->sso_name?>"><br>
        <span class="text-center text-dark"><?= $stateS->sso_name?>
          <a href="#" data-toggle="modal" data-target="#stateSSOProfile" id="<?= $stateS->id?>" class="btn btn-info btn-sm btn-block ssoDetailIcon"><i class="fa fa-info-circle"></i>&nbsp;More Info </a>
        </span>
      </div>
    </div>

<div class="card mt-auto mb-3">
      <div class="card-header">
        <h4 class="text-center text-dark px-3 align-self-center">Kogi State Council Executives</h4>
      </div>
      <div class="card-body align-self-center">

        <span class="text-center text-dark">
          <a href="stateexecutives" class="btn btn-primary btn-sm btn-block"><i class="fa fa-info-circle"></i>&nbsp;More Info </a>
        </span>
      </div>
    </div>
  </div>
  </div>
</div>

<?php   require_once APPROOT . '/includes/footer.php';?>
<script type="text/javascript">
  $(document).ready(function(){
    $('.carousel').carousel({
  interval: 10000
});




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
