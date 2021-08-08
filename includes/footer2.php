
<a href="<?=URLROOT;  ?>" title="Go to Home" class="btn btn-danger"><i class="fa fa-home fa-lg"></i></a>

<!-- here -->
     </div>
<?php include APPROOT. '/officers/scripts/modals.php'; ?>
<?php include APPROOT. '/includes/modals.php'; ?>
<footer style="padding: 20px;" class="bg-dark text-light">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
    <?php echo DASHBOARD;  ?> <?php echo APPVERSION;  ?>
    </div>
    <!-- Default to the left -->
    <strong>Copyright  &copy; 2019-<?php echo date("Y");?> <a href=""><?php echo SITENAME; ?></a>.</strong> All rights reserved.
  </footer>

<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?php echo URLROOT; ?>assests/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo URLROOT; ?>assests/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="<?php echo URLROOT; ?>assests/plugins/datatables/jquery.dataTables.min.js"></script>

<script src="<?php echo URLROOT; ?>assests/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo URLROOT; ?>assests/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo URLROOT; ?>assests/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>



<script type="text/javascript">
	  // When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("myBtn").style.display = "block";
    } else {
        document.getElementById("myBtn").style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}



$(document).ready(function(){

$('#subBtn').click(function(e){
  if ($('#subscribe-form')[0].checkValidity()) {
    e.preventDefault();
    var email = $('#sub-email').val();
    if (email.length < 1) {
      $('#sub_Error').html('<span class="text-danger">Email is required!</span>');
  }else{
    $.ajax({
        url: '../process.php',
        method: 'post',
        data: $('#subscribe-form').serialize()+'&action=subscribe',
        beforeSend: function(){
          $("#subBtn").html('<img src="gif/tra.gif" /> Please Wailt..');
        },
        success:function(response){
          if (response==='true') {
            $('#subscribe-form')[0].reset();
            $('#sub_Error').html('<span class="text-success">Thanks For Subscribing!</span>');
            setTimeout(function(){
              $('#sub_Error').html('');
            }, 3000);
          }else{
             $('#sub_Error').html(response);
          }
        },
        complete:function(){
          $('#subBtn').html('Subscribe');
        }
    });
  }
}
});


 // When the user scrolls the page, execute myFunction

    // $(window).on('scroll', function(){
    //   var docHeight = $(document).height();
    //   winHeight = $(window).height();

    //   var viewport = docHeight - winHeight,
    //   positionY = $(window).scrollTop();

    //   var indicator = (positionY / (viewport)) * 100;

    //   $('.line').css('width', indicator + '%');

    // });

update_user_login();

    function update_user_login()
  {
  var action = 'update_time';
  $.ajax({
     url:"../process.php",
     method:"POST",
     data:{action:action},
     success:function(response)
     {


     },
     error:function(){alert("something went wrong")}

  });
  }
   setInterval(function(){
     update_user_login();
  }, 3000);




    });
</script>




</body>
</html>
