<?php
    require_once 'core/init.php';
    require_once APPROOT . '/includes/head.php';
    require_once APPROOT . '/includes/nav.php';

?>
<style>
  .fa-spinner, .load {
  animation: spin 2s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
  <div class="container-fluid bg-light text-dark">
    <div class="table-responsive">
      <h3 class="text-center text-info mt-1"><i class="fa fa-spinner"></i>&nbsp;Group and Battalion Councils In Kogi State Council&nbsp;<i class="fa fa-spinner"></i></h3><hr class="hrs">
      <p class="text-center text-info">
        <?= nl2br($introductioncou->introduction) ?>
      </p>
      <p class="text-center text-info">
        <?= nl2br($introductioncou20->introduction) ?>
      </p>
       <p class="text-center text-info">
        <?= nl2br($introductioncou25->introduction) ?>
      </p>
      <table class="table table-striped table-hover table-bordered" id="councils">
        <thead>
          <th>#</th>
          <th>Name</th>
          <th>Sure & Steadfast</th>
        </thead>
        <tbody>
          <?php 
          $i = 0;
          foreach ($councils as $group):
            $i = $i + 1;

           ?>
          <tr>
            <td><?= $i ?></td>
            <td><?=$group->council_name ?></td>
            <td><img src="<?= URLROOT; ?>images/BBNSTATE.png" alt="STATE BBN LOGO" class="img-fluid load" width="30"></td>
          </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>

<?php require_once APPROOT . '/includes/footer.php';?>
<script>
  $(document).ready(function(){
    $('#councils').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
           "lengthMenu": [[10,10, 25, 50, -1], [10, 25, 50, "All"]]
        });

})
</script>