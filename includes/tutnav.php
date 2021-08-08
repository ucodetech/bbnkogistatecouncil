
<?php 
  $data = $warhead->fetchCateParent(0);
 ?>
<nav class="navbar  navbar-expand-lg  text-light" style="font-size: 15px;">
  <div class="container">

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand nav-link " href="<?php echo URLROOT; ?>" >
    <i class="fa fa-code"></i> <?php echo SITENAME; ?>
  </a>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item" >
            <a href="<?= URLROOT; ?>tutorial/tutorials" class='nav-link  text-light'>
                    <i class="fas fa-laptop"></i>&nbsp Tutorials
                  </a>

              </li>
    </ul>
    <div class="navbar-nav">

      <?php 
         if ($data) {
          foreach ($data as $links) {
            ?>
            <li class="nav-item">
            <a href="<?= URLROOT; ?>tutorial/category/<?=  strtolower($links->category) ?>" class='nav-link  text-light'>
                    <i class="fas fa-list"></i>&nbsp; <?= $links->category ?>
                  </a>

              </li>
              <?
          }
      }
       ?>

    </div>
  </div>
</div>
</nav>
<style media="screen">
.fa-code{
  font-weight: bolder;
  font-size: 50px;
}s
</style>
