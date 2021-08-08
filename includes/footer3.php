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
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js" integrity="sha512-k2GFCTbp9rQU412BStrcD/rlwv1PYec9SNrkbQlo6RZCf75l6KcC3UwDY8H5n5hl4v77IDtIPwOk9Dqjs/mMBQ==" crossorigin="anonymous"></script>

<script>
    lightbox.option({
      'resizeDuration': 200,
      'wrapAround': true,
      'fitImagesInViewport': true,
      'maxWidth': 1000,
      'maxHeight':500
    })
</script>
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



    $('#register-link').click(function(){
     $('#login-box').hide();
    $('#register-box').show();
      });
      $('#login-link').click(function(){
        $('#login-box').show();
        $('#register-box').hide();
      });


        //Register Ajax Request
      $('#register-btn').click(function(e){
          if ($('#register-form')[0].checkValidity()) {
            e.preventDefault();
            $("#register-btn").html('<img src="../../images/tra.gif" /> Please Wailt..');
            $.ajax({
              url: '../../officers/action.php',
              method:'POST',
              data: $('#register-form').serialize()+'&action=register',
              success:function(response){
                $("#register-btn").html('Sign Up');
              // console.log(response);
              if ($.trim(response) === 'success' ) {
                $('#login-box').hide();
                $('#register-box').show();
              }else{
                  $('#regAlert').html(response);
              }

              }

                  });

          }
      });

  //Login Ajax Request
      $('#login-btn').click(function(e){
          if ($('#login-form')[0].checkValidity()) {
            e.preventDefault();

            $("#login-btn").html('<img src="../../images/tra.gif" /> Please Wailt..');
           if ($('#Lemail').val() == '') {
                $('#error-message').fadeIn().html('* Email is Required!');
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
                    url: '../../officers/action.php',
                    method:'POST',
                    data: $('#login-form').serialize()+'&action=login',
                    beforeSend: function(){},
                success:function(response){
                    $("#login-btn").html('Sign In');
                  if ($.trim(response) === 'success') {
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
        url: '../../process.php',
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
     url:"../../process.php",
     method:"POST",
     data:{action:action},
     success:function(response)
     {


     },
     // error:function(){alert("something went wrong")}

  });
  }
   setInterval(function(){
     update_user_login();
  }, 3000);

hits();

    function hits(){
     
      $.ajax({
        url: '../../process.php',
        method: 'post',
        data: {action:'hits'},
        success:function(data){ }
      });
    };




    });
</script>




</body>
</html>
