<?php $warhead = new CadetConsole(); ?>
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->

       <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>


      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo URLROOT; ?>commander/command-dashboard" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a class="nav-link"><h3><?php echo $title; ?></h3>   </a>
      </li>
    </ul>



    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <li class="nav-item">
         <a class="nav-link text-success"  role="button"><i class="fa fa-user"></i>Welcome: <?php echo strtok($warhead->data()->commander_name, ' ') ?></a>

      </li>
      <li class="nav-item">
        <a class="nav-link text-danger"  href="<?php echo URLROOT;?>commander/command-fallout" role="button"><i
            class="fas fa-power-off"></i>Fallout</a>
      </li>
    </ul>


  </nav>

  <!-- /.navbar -->

  <!-- Main Sidebar Container -->

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo URLROOT; ?>commander/command-dashboard" class="brand-link text-center">
      <img src="<?php echo URLROOT; ?>images/BBNSTATE.png" alt="<?php echo ADMIN; ?> Logo" class="img-circle " width="150"  ><br>
      <span class="brand-text font-weight-light"><?php echo ADMIN; ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?php echo URLROOT; ?>commander/command-dashboard" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
               Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

          </li>
          <li class="nav-item">
            <a href="<?php echo URLROOT; ?>commander/command-news" class="nav-link ">
              <i class="nav-icon fa fa-newspaper"></i>
              <p>
               News
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

          </li>
          <li class="nav-item">
            <a href="<?php echo URLROOT; ?>commander/command-notification" class="nav-link ">
              <i class="nav-icon fa fa-bell"></i>
              <p>
                Notifications <span id="getNotifys"></span>
              </p>
            </a>

          </li>
          <li class="nav-item">
            <a href="<?php echo URLROOT; ?>commander/command-requestNotification" class="nav-link ">
              <i class="nav-icon fa fa-bell"></i>
              <p>
                DataForm Rqst <span id="getRequest"></span>
              </p>
            </a>

          </li>
           <li class="nav-item">
            <a href="<?php echo URLROOT; ?>commander/command-totalMembers" class="nav-link ">
              <i class="nav-icon fa fa-users"></i>
              <p>
                Total Memebers
              </p>
            </a>

          </li>
            <li class="nav-item">
            <a href="<?php echo URLROOT; ?>commander/command-allCompanies.php" class="nav-link ">
              <i class="nav-icon fas fa-list"></i>
              <p>
               Companies
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

          </li>
          <li class="nav-item">
            <a href="<?php echo URLROOT; ?>commander/command-feedback" class="nav-link ">
              <i class="nav-icon fas fa-comment-dots"></i>
              <p>
               Feedback
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

          </li>
          <li class="nav-item">
            <a href="<?php echo URLROOT; ?>commander/command-executives" class="nav-link ">
              <i class="nav-icon fa fa-users"></i>
              <p>
              Executives
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

          </li>
           <li class="nav-item">
            <a href="<?php echo URLROOT; ?>commander/command-gallery" class="nav-link ">
              <i class="nav-icon  fa fa-table "></i>
              <p>
                State Gallery
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>

          </li>
          <li class="nav-item">
            <a href="<?php echo URLROOT; ?>commander/command-trainingOfficers" class="nav-link ">
              <i class="nav-icon fas fa-users"></i>
              <p>
               Training Officers
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

          </li>
          <li class="nav-item">
            <a href="<?php echo URLROOT; ?>commander/command-executives&ServiceDate" class="nav-link ">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Executives and Services date
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

          </li>
          <li class="nav-item">
            <a href="<?php echo URLROOT; ?>commander/command-councils" class="nav-link ">
              <i class="nav-icon fas fa-users"></i>
              <p>
               Group Councils
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

          </li>
          <li class="nav-item">
            <a href="<?php echo URLROOT; ?>commander/command-slider" class="nav-link ">
              <i class="nav-icon fas fa-tag"></i>
              <p>
               Slider Images
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

          </li>
          <li class="nav-item">
            <a href="<?php echo URLROOT; ?>commander/command-officers" class="nav-link ">
              <i class="nav-icon fas fa-users"></i>
              <p>
               Officers
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

          </li>
           <li class="nav-item">
            <a href="<?php echo URLROOT; ?>commander/command-topOffical" class="nav-link ">
              <i class="nav-icon fas fa-users"></i>
              <p>
              State Top Officers
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

          </li>
          <li class="nav-item">
            <a href="<?php echo URLROOT; ?>commander/command-trash" class="nav-link ">
              <i class="nav-icon fas fa-trash"></i>
              <p>
               Trash Can
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

          </li>
          <li class="nav-item">
            <a href="<?php echo URLROOT; ?>commander/command-exportTables.php" class="nav-link ">
              <i class="nav-icon fa fa-table"></i>
              <p>
               Export Tabls
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

          </li>
          
          <li class="nav-item">
            <a href="<?php echo URLROOT; ?>commander/command-history" class="nav-link ">
              <i class="nav-icon fa fa-coffee"></i>
              <p>
              BB Histroy's
              </p>
            </a>

          </li>
           <li class="nav-item">
            <a href="<?php echo URLROOT; ?>commander/command-awardwinners.php" class="nav-link ">
              <i class="nav-icon fas fa-trophy"></i>
              <p>
               Award Winners
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

          </li>
          <li class="nav-item">
            <a href="<?php echo URLROOT; ?>commander/command-mail" class="nav-link ">
              <i class="nav-icon fa fa-envelope"></i>
              <p>
                Send Email to Officer
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

          </li>
          <li class="nav-item">
            <a href="<?php echo URLROOT; ?>commander/command-generate" class="nav-link ">
              <i class="nav-icon fas fa-jedi"></i>
              <p>
                Commanders
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

          </li>
          <hr>
           <li class="nav-item">
            <a href="<?php echo URLROOT; ?>commander/access-room" class="nav-link ">
              <i class="nav-icon fas fa-id-card"></i>
              <p>
               Access Room
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

          </li>
          <li class="nav-item">
            <a href="<?php echo URLROOT; ?>commander/command-settings" class="nav-link ">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

          </li>


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
