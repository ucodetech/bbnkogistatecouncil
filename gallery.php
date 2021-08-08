<?php
    require_once 'core/init.php';
    require_once APPROOT . '/includes/head.php';
    require_once APPROOT . '/includes/nav.php';

?>
<style>
  .gallery img{
    filter: grayscale(100%);
    transition: 1s;
    box-shadow: 0 0 5px 5px rgb(36, 9, 290);
}
.gallery img:hover{
    filter: grayscale(0);
    transform: scale(1.1);
}
</style>
<div class="container-fluid" style="margin:10px !important;">
  <div class="row">
      <div class="container-fluid" id="overlay" style="height: auto  !important; font-size: 30px;">
        <h1 class="text-center px-2 py-3"style="font-size: 50px;"><i class="fa fa-braille fa-lg modified"></i>&nbsp;KOGI STATE COUNCIL GALLERY</h1>
      </div>
    </div><hr><!-- /.row -->

<div class="row">

<?php foreach ($gallery as $gall): ?>
  
  <div class="col-lg-4 pb-2" id="evtImg" data-aos="fade-in">
   
    <div class="card justify-content-center bg-primary" style="flex-grow:1.4;">
      <div class="card-body gallery">
        <a href="<?= URLROOT; ?>uploads/gallery/<?=$gall->gall_image;?>" data-lightbox="<?=$gall->gall_image;?>" data-title="<?=$gall->gall_title;?>" data-alt="<?=$gall->gall_title;?>" title="<?=$gall->gall_event_location .'---'. pretty_dated($gall->gall_eventDate);?>">
          <img src="<?= URLROOT; ?>uploads/gallery/<?=$gall->gall_image;?>" alt="<?=$gall->gall_title;?>" width="408" class="img-fluid" >
        </a>
      </div>
    </div>
 
  </div>

<?php endforeach ?>

</div>
</div>





<?php require_once APPROOT . '/includes/footer.php';?>
<script>
    lightbox.option({
      'resizeDuration': 200,
      'wrapAround': true,
      'fitImagesInViewport': true,
      'maxWidth': 1000,
      'maxHeight':500
    })
</script>