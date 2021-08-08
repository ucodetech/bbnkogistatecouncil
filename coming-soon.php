<?php
    require_once 'core/init.php';
    require_once APPROOT . '/includes/head2.php';

?>
<style>
	/*.card-body{
		background: url("images/me.jpg");
		background-size: contain;
		background-repeat: no-repeat;
		background-position: center top;

	}*/
	.card{
		background: url("images/bday.png");
		background-size: cover;
		background-repeat: no-repeat;
/*		background-position: center top;
*/
	}
	#demo{
		font-size: 5em;
	}
	.float-right{
		top: 0;
		bottom: 0%;
	}
</style>
  <div class="container h-100" style="font-family: Poppins;">
      <div class="row h-100 align-items-center justify-content-center">
        <div class="col-lg-10">
          <div class="card border-primary shadow-lg">
            <div class="card-header ucodeColor">
              <h3 class="m-0 text-white">
                <i class="fas fa-user-c	og"></i>&nbsp; Count Down Begins
              </h3>
            </div>
            <div class="card-body text-dark">
				  <div class="row">
				  	<div class="col-lg-6">
				  		<div class="topleft">
				    <p class="text-left"><img src="<?= URLROOT; ?>images/ucodeTut Logo.png" class="img-fluid img-thumbnail" width="108" /></p>
				  </div>
				 
				  	</div>
				  	<div class="col-lg-6">
				  
				  <div class="float-right">
				    <p class="text-left"><img src="<?= URLROOT; ?>images/me.jpg" class="img-fluid img-thumbnail" width="108" /></p>
				  </div>
				  	</div>
				  </div>
				  <div class="middle">
				    <marquee behavior="scroll" direction="right">
				    	<h1 class="text-center text-white font-weight-bolder mt-0 "> 
				    	<button class="btn btn-lg btn-block btn-light">BIRTHDAY COUNT DOWN</button>
				    </h1>
				    </marquee>
				    <hr>
				    <h1 id="demo" class="text-center font-weight-bolder text-warning ucodeBtn" ></h1>
				  </div>
				  <div class="bottomleft">
				    <p class="text-white">#CODE</p>
				  </div>
            </div>
          </div>
        </div>
      </div>
    </div>


<script>
	// Set the date we're counting down to
var countDownDate = new Date("Oct 26, 2020 12:00:00").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get todays date and time
  var now = new Date().getTime();

  // Find the distance between now an the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in an element with id="demo"
  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
</script>