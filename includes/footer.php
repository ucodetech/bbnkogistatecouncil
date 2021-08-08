<!-- <div class="rightShare">
     <div class="container py-4">
       <small class="text-center text-sm">Share</small>
       <span class="text-primary"><i class="fa fa-facebook-square fa-lg"></i> </span>
        <span class="text-info"><i class="fa fa-twitter-square fa-lg"></i> </span>
        <span class="text-success"><i class="fa fa-whatsapp fa-lg"></i> </span>
        <span class="text-danger"><i class="fa fa-envelope fa-lg"></i></span>
     </div>

 </div> -->
<div class="container text-light  mt-2 cookie-container shadow-lg">
    <p class="mt-5">
        We use cookies in this site to give you the best experience on our site and show you relevant ads. To find out more, read our <a href="" class="btn btn-sm btn-info">privacy policy</a> and <a href="" class="btn btn-sm btn-info">cookie policy</a><br>
        <button class="btn btn-md btn-danger mb-2 float-right cookie-btn">Okay</button>
    </p>
</div>
<button onclick="topFunction()" id="myBtn" title="Go to top" class="btn btn-danger"><i class="fa fa-arrow-up fa-lg"></i></button>

<!-- here -->
     </div>
     <?php include APPROOT. '/includes/modals.php'; ?>
     <?php   require_once APPROOT . '/includes/multifooter.php';?>
<footer style="padding: 20px;" class="text-light bg-info" style="border-top: 2px solid orangered">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
    <?php echo NAVNAME;  ?> <?php echo APPVERSION;  ?>
    </div>
    <!-- Default to the left -->
    <strong>Copyright  &copy; 2019-<?php echo date("Y");?> <a href="<?= URLROOT ?>" class="text-warning"><?php echo SITENAME; ?></a>.</strong> All rights reserved.
  </footer>
</div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?php echo URLROOT; ?>assests/plugins/jquery/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo URLROOT; ?>assests/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="<?php echo URLROOT; ?>assests/plugins/datatables/jquery.dataTables.min.js"></script>

<script src="<?php echo URLROOT; ?>assests/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo URLROOT; ?>assests/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo URLROOT; ?>assests/plugins/datatables-responsive/js/responsive.bootstrap4.min.js">

</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="<?php echo URLROOT;?>assests/dist/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.min.js" integrity="sha512-cWEytOR8S4v/Sd3G5P1Yb7NbYgF1YAUzlg1/XpDuouZVo3FEiMXbeWh4zewcYu/sXYQR5PgYLRbhf18X/0vpRg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js" integrity="sha512-k2GFCTbp9rQU412BStrcD/rlwv1PYec9SNrkbQlo6RZCf75l6KcC3UwDY8H5n5hl4v77IDtIPwOk9Dqjs/mMBQ==" crossorigin="anonymous"></script>

<script>
  AOS.init({
    duration: 1000,
    disable: 'mobile'
  });
</script>
</body>
</html>
<style>
    .cookie-container{
      border-radius: 10px;
      background: #2f3640;
    font-size: 15px;
    position: fixed;
    left: 0;
    right: 0;
    bottom: -100%;

    padding: 0 32px;

    transition: 400ms;

    }
    .active{
        bottom: 0;
    }

    .cookie-btn{
        padding: 12px 48px;
    }
    #myBtn {
    display: none; /* Hidden by default */
    position: fixed; /* Fixed/sticky position */
    bottom: 20px; /* Place the button at the bottom of the page */
    right: 30px; /* Place the button 30px from the right */
    z-index: 99; /* Make sure it does not overlap */
    border: none; /* Remove borders */
    outline: none; /* Remove outline */

    color: white; /* Text color */
    cursor: pointer; /* Add a mouse pointer on hover */
    padding: 15px; /* Some padding */
    border-radius: 10px; /* Rounded corners */
    font-size: 18px; /* Increase font size */
}

#myBtn:hover {
    background-color: #589; /* Add a dark-grey background on hover */
}
</style>

<script>
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

        const cookieCont = $('.cookie-container');
        const cookeBtn = $('.cookie-btn');

        $(cookeBtn).click(function(){
            $(cookieCont).removeClass('active');
            localStorage.setItem("cookieBannerDisplayed", "true");
        });

        setTimeout(function(){
            if (!localStorage.getItem("cookieBannerDisplayed")) {
                 $(cookieCont).addClass('active');
            }

        }, 5000);



        const modalReg = $('#cookieLogin');
        const notNowBtn = $('#notNowBtn');

        $(notNowBtn).click(function(){
            $(modalReg).modal('hide');
            localStorage.setItem("registerWithModal", "true");
        });

        setTimeout(function(){
            if (!localStorage.getItem("registerWithModal")) {
                $(modalReg).modal('show');
            }

        }, 8000);



      

  //Login Ajax Request
      $('#login-btn').click(function(e){
          if ($('#login-form')[0].checkValidity()) {
            e.preventDefault();

            $("#login-btn").html('<img src="gif/tra.gif" /> Please Wailt..');
           if ($('#Lusername').val() == '') {
                $('#error-message').fadeIn().html('* Username is Required!');
                setTimeout(function(){
                  $('#error-message').fadeOut('slow');
                }, 5000);
            }  else if ($('#Lpassword').val() == '') {
                $('#error-message').fadeIn().html('* Please enter password!');
                setTimeout(function(){
                  $('#error-message').fadeOut('slow');
                }, 5000);
            }else{
                  $('#error-message').text('');
                  $.ajax({
                    url: 'officers/scripts/virus.php',
                    method:'POST',
                    data: $('#login-form').serialize()+'&action=login',
                    beforeSend: function(){},
                success:function(response){
                    $("#login-btn").html('Sign In');
                  if ($.trim(response) === 'success') {
                    localStorage.setItem("registerWithModal", "true");

                         window.location.href = '<?php $_SERVER['PHP_SELF']; ?>';
                  }else{
                      $('#logAlert').html(response);
                  }
                }

                  });
                }
          }

      });

$('#subBtn').click(function(e){
  if ($('#subscribe-form')[0].checkValidity()) {
    e.preventDefault();
    var email = $('#sub-email').val();
    if (email.length < 1) {
      $('#sub_Error').html('<span class="text-danger">Email is required!</span>');
  }else{
    $.ajax({
        url: 'process.php',
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
     url:"<?=URLROOT; ?>process.php",
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

hits();

    function hits(){
     
      $.ajax({
        url: 'process.php',
        method: 'post',
        data: {action:'hits'},
        success:function(data){ }
      });
    };




    });

</script>
