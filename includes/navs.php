<?php $officer = new Officer(); ?>
<nav class="navbar navbar-expand-md navbar-primary bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand text-light <?= (basename($_SERVER['PHP_SELF']) == 'index') ? 'active' : ''; ?>"
        href="<?php echo URLROOT; ?>officers/dashboard">
         <?php echo DASHBOARD; ?>
    </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarCollapse">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link text-light <?= (basename($_SERVER['PHP_SELF']) == 'index') ? 'active' : ''; ?>"
            href="<?php echo URLROOT; ?>index"><i class="fas fa-home"></i>&nbsp;Home</a>
      </li>

    </ul>
    <div class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link text-light <?= (basename($_SERVER['PHP_SELF']) == 'feedback') ? 'active' : ''; ?>"
              href="<?php echo URLROOT; ?>officers/feedback"><i class="fas fa-comment-dots"></i>&nbsp;Feedback</a>
      </li>
      <li class="nav-item">
          <a class="nav-link text-light <?= (basename($_SERVER['PHP_SELF']) == 'ur-profile') ? 'active' : ''; ?>"
              href="<?php echo URLROOT; ?>officers/ur-profile"><i class="fas fa-user-circle"></i>&nbsp;Profile</a>
      </li>
      <li class="nav-item">
          <a class="nav-link text-light <?= (basename($_SERVER['PHP_SELF']) == 'notifacation') ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>officers/notification"><i class="fas fa-bell"></i>Notification&nbsp;<span id="checkNotifaction"></span>   </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light <?= (basename($_SERVER['PHP_SELF']) == 'trash') ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>officers/trash"><i class="fas fa-trash"></i>Trash Can</a>
        </li>
        <li class="nav-item dropdown">
          <a href="#" class="nav-link text-light dropdown-toggle" id="navbardrop" data-toggle="dropdown">
            <i class="fas fa-user-cog"></i>&nbsp; Hi! <?php echo strtok($officer->data()->officers_name, ' ') ?>
          </a>
          <div class="dropdown-menu">
             <a class="dropdown-item " href="<?php echo URLROOT; ?>officers/logout" tabindex="-1" > <i class="fas fa-sign-out-alt"></i> Logout: <span class="text-danger"><?php echo strtok($officer->data()->officers_name, ' '); ?></span></a>
          </div>
        </li>
    </div>
  </div>
</div>
</nav>
