<?php
    require_once 'core/init.php';
    require_once APPROOT . '/includes/head.php';
    require_once APPROOT . '/includes/nav.php';

    $db = new CadetConsole();

    $awards =  $db->selectTable('awardWinners', 0);

?>

<div class="container-fluid" >

  <div class="container marketing">

    <!-- Three columns of text below the carousel -->
    <div class="row" style="background: url('images/bg.png');border-radius: 20px;">
  		<div class="col-lg-12" id="overlay" style="height: auto  !important;border-radius: 20px; font-size: 30px;">
  			<h1 class="text-center px-2 py-3 "style="font-size: 50px;"><i class="fa fa-trophy fa-lg modified"></i>&nbsp;AWARD WINNERS</h1>
  		</div>
    </div><!-- /.row -->


    <!-- START THE FEATURETTES -->

    <hr class="featurette-divider">
    <?php foreach ($awards as $row): ?>

    <div class="row featurette">
      <div class="col-md-7">
        <h4 class="featurette-heading"><?=$row->award_event_title;?></h4>
        <p class="py-4 text-center"><?=nl2br($row->award_event_description);?></p>
        <span class="text-left lead"><?= $row->award_name?></span>

      </div>
      <?php  $images = explode(', ', $row->award_images); ?>
      <div class="col-md-5 fotorama" data-autoplay="true">
        <?php foreach ($images as $one): ?>
          <img src="uploads/awards/<?=$one; ?>" alt="<?=$row->award_event_title; ?>" class="img-fluid img-thumbnail lazy" style="border-radius: 20px !important; width: 500px !important; height:400px !important;">

        <?php endforeach ?>



      </div>

    </div>

    <hr class="featurette-divider">

    <?php endforeach ?>


    </div>

    <!-- /END THE FEATURETTES -->

  </div><!-- /.container -->

</div>
<style media="screen">

      /* MARKETING CONTENT
-------------------------------------------------- */

/* Center align the text within the three columns below the carousel */
.marketing .col-lg-4 {
  margin-bottom: 1.5rem;
  text-align: center;
}
.marketing h2 {
  font-weight: 400;
}
.marketing .col-lg-4 p {
  margin-right: .75rem;
  margin-left: .75rem;
}


/* Featurettes
------------------------- */

.featurette-divider {
  margin: 5rem 0; /* Space out the Bootstrap <hr> more */
}

/* Thin out the marketing headings */
.featurette-heading {
  font-weight: 300;
  line-height: 1;
  letter-spacing: -.05rem;
}


/* RESPONSIVE CSS
-------------------------------------------------- */

@media (min-width: 40em) {

  .featurette-heading {
    font-size: 50px;
  }
}

@media (min-width: 62em) {
  .featurette-heading {
    margin-top: 7rem;
  }
}

/* The animation code */
@keyframes fun {
    0%   {color:red; left:0px; top:0px;}
    25%  {color:yellow; left:40px; top:0px;}
    50%  {color:blue; left:40px; top:50px;}
    75%  {color:green; left:0px; top:50px;}
    100% {color:red; left:0px; top:0px;}
}

/* The element to apply the animation to */
.modified {
    width: 100px;
    height: 100px;
    color: red;
    position: relative;
    animation-name: fun;
    animation-duration: 4s;
   animation-delay: 2s;
   animation-iteration-count: infinite;
}
</style>
<?php   require_once APPROOT . '/includes/footer.php';?>
