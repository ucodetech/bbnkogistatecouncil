<?php
    require_once '../core/init.php';
    require_once APPROOT . '/includes/head2.php';

    $db = new General();

    $lgac = $db->selectTable('allLGAInNig', 0);
    $lga = '';
    $gender = '';
?>

<style media="screen">
/* //multi setp */


.stepwizard-step p {
    margin-top: 10px;
}

.stepwizard-row {
    display: table-row;
}

.stepwizard {
    display: table;
    width: 100%;
    position: relative;
}

.stepwizard-step button[disabled] {
    opacity: 1 !important;
    filter: alpha(opacity=100) !important;
}

.stepwizard-row:before {
    top: 14px;
    bottom: 0;
    position: absolute;
    content: " ";
    width: 100%;
    height: 1px;
    background-color: #ccc;
    z-order: 0;

}

.stepwizard-step {
    display: table-cell;
    text-align: center;
    position: relative;
}

.btn-circle {
  width: 30px;
  height: 30px;
  text-align: center;
  padding: 6px 0;
  font-size: 12px;
  line-height: 1.428571429;
  border-radius: 15px;
}

</style>
<div class="container-fluid align-self-center" style="margin:10px !important;">
  <!-- register -->
  <div class="row justify-content-center" id="register-box">
    <div class="col-lg-12">
      <div class="card-group">
        <div class="card justify-content-center ucodeColor rounded-right">
          <h2 class="text-center  text-white">Welcome on Board Gallent! <br> SURE AND STEADFAST  </h2>
          <hr class="my-3 bg-light ucodeHr">
          <p class="text-center  text-light lead">
            You are creating this account so as to have access to more information About
            the Cadet! Be Nice. <br>
            Already have an account?

          </p>

          <a class="btn btn-outline-light btn-lg align-self-center font-weight-bolder mt-2 mb-2 ucodeLinkBtn" href="login">Sign In</a>
        </div>
        <div class="card rounded-left p-4" style="flex-grow:1.4;">
          <h4 class="text-center  text-primary">
          <i class="fa fa-user"></i> Sign Up to Start!
        </h4>
<div class="container-fluid">
<div class="stepwizard">
    <div class="stepwizard-row setup-panel">
        <div class="stepwizard-step">
            <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
            <p>Step 1</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
            <p>Step 2</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
            <p>Step 3</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
            <p>Step 4</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-5" type="button" class="btn btn-default btn-circle" disabled="disabled">5</a>
            <p>Step 5</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-6" type="button" class="btn btn-default btn-circle" disabled="disabled">6</a>
            <p>Step 6</p>
        </div>
    </div>
</div>
<form role="form" method="post" id="regForm" action="#">
  <div class="form-group" id="fallError">  </div>
    <div class="row setup-content" id="step-1">
        <div class="col-lg-12">
            <div class="col-md-12">
                <h3> Personal Details</h3>
                <div class="form-group">
                    <label class="control-label">First Name<sup class="text-danger">*</sup>  </label>
                    <input  maxlength="100" type="text" required="required" class="form-control" name="full_name" id="full_name" placeholder="Enter Full Name"  />
                </div>
                <div class="form-group">
                    <label class="control-label">Date of Birth<sup class="text-danger">*</sup></label>
                    <input maxlength="100" type="date" required="required" class="form-control" name="dob" id="dob"  />
                </div>
                <div class="form-group">
                    <label class="control-label">Gender<sup class="text-danger">*</sup></label>
                    <select maxlength="100"  name="gender" id="gender" required="required" class="form-control">
                        <option value="" <?= (($gender == ''))? ' selected':'' ?> disabled>Select Gender.</option>
                        <option value="male" <?= (($gender == 'male'))? ' selected':'' ?>>Male</option>
                         <option value="female" <?= (($gender == 'female'))? ' selected':'' ?>>Female</option>

                    </select>
                </div>
                  <div class="form-group">
                    <label class="control-label">LGA<sup class="text-danger">*</sup></label>
                    <select maxlength="100"  name="lga" id="lga" required="required" class="form-control">
                        <option value="" <?= (($lga == ''))? ' selected':'' ?> disabled>Select Local Govt.</option>
                        <?php foreach ($lgac as $lg): ?>
                            <option value="<?= $lg->lga  ?>" <?= (($lga == $lg))? ' selected':'' ;?>><?= $lg->lga; ?></option>
                        <?php endforeach ?>

                    </select>
                </div>
                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
            </div>
        </div>
    </div>
    <div class="row setup-content" id="step-2">
        <div class="col-lg-12">
            <div class="col-md-12">
                <h3> Contact Details</h3>
                <div class="form-group">
                    <label class="control-label">Email Address<sup class="text-danger">*</sup>  </label>
                    <input  maxlength="100" type="email" required="required" class="form-control" name="email" id="email" placeholder="Enter Email Address"  />
                </div>
                <div class="form-group">
                    <label class="control-label">Phone Number<sup class="text-danger">*</sup>  </label>
                    <input  type="tel" required="required" class="form-control" name="tel_no" id="tel_no" placeholder="Enter Phone Number" minlength="11" maxlength="11" />
                </div>
                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
            </div>
        </div>
    </div>
    <div class="row setup-content" id="step-3">
        <div class="col-lg-12">
            <div class="col-md-12">
                <h3> Company Details</h3>
                <div class="form-group">
                    <label class="control-label">Company Number<sup class="text-danger">*</sup>  </label>
                    <input  maxlength="100" type="text" required="required" class="form-control" name="comp_name" id="comp_name" placeholder="Enter Company Number"  />
                </div>
                <div class="form-group">
                    <label class="control-label">Captian's Name<sup class="text-danger">*</sup>  </label>
                    <input  maxlength="100" type="text" required="required" class="form-control" name="capt-name" id="capt-name" placeholder="Enter Your Captian's Name"  />
                </div>
                <div class="form-group">
                    <label class="control-label">Church<sup class="text-danger">*</sup>  </label>
                    <input  maxlength="100" type="text" required="required" class="form-control" name="home_church" id="home_church" placeholder="Enter Your church"  />
                </div>
                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
            </div>
        </div>
    </div>
    <div class="row setup-content" id="step-4">
        <div class="col-lg-12">
            <div class="col-md-12">
                <h3> Company Details(contd)</h3>
                <div class="form-group">
                    <label class="control-label">Lieutenant In Charge<sup class="text-danger">*</sup>  </label>
                    <input  maxlength="100" type="text" required="required" class="form-control" name="lt_name" id="lt_name" placeholder="Enter Lieutenant's Incharge  name"  />
                </div>
                <div class="form-group">
                    <label class="control-label">Rank/Portfolio<sup class="text-danger">*</sup>  </label>
                    <input  maxlength="100" type="text" required="required" class="form-control" name="rank-port" id="rank-port" placeholder="Enter Your Rank/Portfolio"  />
                </div>
                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
            </div>
        </div>
    </div>
    <div class="row setup-content" id="step-5">
        <div class="col-lg-12">
            <div class="col-md-12">
                <h3>Login Details</h3>
                <div class="form-group">
                    <label class="control-label">Group Council<sup class="text-danger">*</sup>  </label>
                    <input  maxlength="100" type="text" required="required" class="form-control" name="group_council" id="group_council" placeholder="Enter group council eg Lokoja group council"  />
                </div>
                 <div class="form-group">
                    <label class="control-label">Username<sup class="text-danger">*</sup>  </label>
                    <input  maxlength="100" type="text" required="required" class="form-control" name="officer_username" id="officer_username" placeholder="Enter Username"  minlength="5" maxlength="30" />
                </div>
                <div class="form-group">
                    <label class="control-label">Password<sup class="text-danger">*</sup>  </label>
                    <input  maxlength="100" type="password" required="required" class="form-control" name="password" id="password" placeholder="Enter Password"  />
                </div>

                <div class="form-group">
                    <label class="control-label">Confirm Password<sup class="text-danger">*</sup>  </label>
                    <input  maxlength="100" type="password" required="required" class="form-control" name="cpassword" id="cpassword" placeholder="Verify  Password"  />
                </div>
                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
            </div>
        </div>
    </div>
    <div class="row setup-content" id="step-6">
        <div class="col-lg-12">
            <div class="col-md-12">
                <h5 class="text-sm text-danger" id="Talk">Verify before clicking the Register Button!
                </h5>
                <button class="btn btn-success btn-lg btn-block pull-right ucodeBtn" type="submit" id="regBtn">Register!</button>
            </div>
        </div>
    </div>
</form>
</div>
        </div>

      </div>

    </div>

  </div>
</div>
  <?php require_once APPROOT . '/includes/footer2.php';?>

  <script type="text/javascript">
  $(document).ready(function () {

      var navListItems = $('div.setup-panel div a'),
              allWells = $('.setup-content'),
              allNextBtn = $('.nextBtn');

      allWells.hide();

      navListItems.click(function (e) {
          e.preventDefault();
          var $target = $($(this).attr('href')),
                  $item = $(this);

          if (!$item.hasClass('disabled')) {
              navListItems.removeClass('btn-primary').addClass('btn-default');
              $item.addClass('btn-primary');
              allWells.hide();
              $target.show();
              $target.find('input:eq(0)').focus();
          }
      });

      allNextBtn.click(function(){
          var curStep = $(this).closest(".setup-content"),
              curStepBtn = curStep.attr("id"),
              nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
              curInputs = curStep.find("input[type='text'],input[type='url']"),
              isValid = true;

          $(".form-group").removeClass("has-error");
          for(var i=0; i<curInputs.length; i++){
              if (!curInputs[i].validity.valid){
                  isValid = false;
                  $(curInputs[i]).closest(".form-group").addClass("has-error");
              }
          }

          if (isValid)
              nextStepWizard.removeAttr('disabled').trigger('click');
      });

      $('div.setup-panel div a.btn-primary').trigger('click');
      $('#regBtn').on('click', function(e){
        if ($('#regForm')[0].checkValidity()) {
             e.preventDefault();

            $.ajax({
                url: 'scripts/virus.php',
                method:'post',
                data: $('#regForm').serialize()+'&action=reg_officer',
                 beforeSend: function(){
                   $('#regBtn').html('<img src="<?= URLROOT;  ?>gif/success.gif">Please wait...')
                 },
                success:function(response){
                  if ($.trim(response)==='success') {
                    $('#regForm')[0].reset();
                    $('#Talk').removeClass('text-danger');
                    $('#Talk').addClass('text-success');
                    $('#Talk').html('Success! Check Your E-mail for your State ID No.');
                    $('#regBtn').attr('disabled', true);
                    $('#regBtn').html('<img src="<?= URLROOT;  ?>gif/block.gif">Redirecting...');
                    setInterval(function(){
                     window.location = '<?= $_SERVER['PHP_SELF'];?>';
                    }, 6000)
                  }else{
                    $('#fallError').html(response);
                  }
                }

        });

        }
      });



  });
  </script>
