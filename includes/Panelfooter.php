<!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
     <?php echo ADMIN;?>
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2019-<?php echo date("Y");?> <a href="https://adminlte.io"> <?php echo ADMIN;?></a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?php echo URLROOT;?>assests/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo URLROOT;?>assests/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="<?php echo URLROOT;?>assests/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo URLROOT;?>assests/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo URLROOT;?>assests/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo URLROOT;?>assests/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<!-- AdminLTE App -->
<script src="<?php echo URLROOT;?>assests/dist/js/adminlte.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="<?php echo URLROOT;?>assests/dist/prism.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.min.js" integrity="sha512-cWEytOR8S4v/Sd3G5P1Yb7NbYgF1YAUzlg1/XpDuouZVo3FEiMXbeWh4zewcYu/sXYQR5PgYLRbhf18X/0vpRg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js" integrity="sha512-cWEytOR8S4v/Sd3G5P1Yb7NbYgF1YAUzlg1/XpDuouZVo3FEiMXbeWh4zewcYu/sXYQR5PgYLRbhf18X/0vpRg==" crossorigin="anonymous"></script>

<script type="text/javascript">
      function readFile(input) {
      if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        var htmlPreview =
        '<img  class="img-thumbnail lazy"  src="'+ e.target.result +'" alt="'+input.files[0].name+'" width="408">'+
         '<p>' + input.files[0].name + '</p>';
        var wrapperZone = $(input).parent();
        var previewZone = $(input).parent().parent().find('.preview-zone');
        var boxZone = $(input).parent().parent().find('.preview-zone').find('.box').find('.box-body');

        wrapperZone.removeClass('dragover');
        previewZone.removeClass('hidden');
        // dropzone-wrapper.hide();
        boxZone.empty();
        boxZone.append(htmlPreview);
        };

      reader.readAsDataURL(input.files[0]);
          }
              }

              function reset(e) {
                  e.wrap('<form>').closest('form').get(0).reset();
                  e.unwrap();
              }

              $(".dropzone").change(function() {
                  readFile(this);
              });

              $('.dropzone-wrapper').on('dragover', function(e) {
                  e.preventDefault();
                  e.stopPropagation();
                  $(this).addClass('dragover');
              });

              $('.dropzone-wrapper').on('dragleave', function(e) {
                  e.preventDefault();
                  e.stopPropagation();
                  $(this).removeClass('dragover');
              });

            $('.remove-preview').on('click', function() {
                    var boxZone = $(this).parents('.preview-zone').find('.box-body');
                    var previewZone = $(this).parents('.preview-zone');
                    var dropzone = $(this).parents('.form-group').find('.dropzone');
                    boxZone.empty();
                    previewZone.addClass('hidden');
                    reset(dropzone);
              });

$(document).ready(function(){

// update last lastLogin
update_admin_login();

function update_admin_login()
{
    var action = 'update_war';
    $.ajax({
       url:"virus/initate.php",
       method:"POST",
       data:{action:action},
       success:function(data)
       {


       },
       error:function(){alert("something went wrong admin update")}

    });
}
 setInterval(function(){
   update_admin_login();
}, 3000);

})

</script>
</body>
</html>
