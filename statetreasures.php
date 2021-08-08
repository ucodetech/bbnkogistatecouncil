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
      <h3 class="text-center text-info mt-1"><i class="fa fa-spinner"></i>&nbsp;State Treasures In Kogi State Council&nbsp;<i class="fa fa-spinner"></i></h3><hr class="hrs">
      
      <table class="table table-striped table-hover table-bordered" id="treasures">
        <thead>
          <th>#</th>
          <th>Name</th>
          <th>From</th>
          <th>To</th>
          <th>Sure & Steadfast</th>
        </thead>
        <tbody>
          <?php 
          $i = 0;
          foreach ($statetreasures as $treasures):
            $date = date('Y');
            if ($treasures->served_finish_date > $date) {
              $tillnow = '<span class="text-center text-success">To Date&nbsp;<i class="fa fa-check fa-lg"></i></span>';
            }else{
                $tillnow = pretty_dated($treasures->served_finish_date);
            }
            $i = $i + 1;

           ?>
          <tr>
            <td><?= $i ?></td>
            <td><?=$treasures->tre_name ?></td>
            <td><?=pretty_dated($treasures->served_start_date) ?></td>
            <td><?=$tillnow ?></td>
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
    $('#treasures').DataTable({
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