<?php
    require_once '../core/init.php';
    require_once APPROOT . '/includes/head2.php';

    $db = new General();

    $lgac = $db->selectTable('allLGAInNig', 0);
    $lga = '';
    $gender = '';
?>

<div class="container-fluid align-self-center" style="margin:10px !important;">
  <!-- reset password -->

</div>




<?php require_once APPROOT . '/includes/footer2.php';?>

<script type="text/javascript">
$(document).ready(function () {

  $('#register-link').on('click', function(){
    $('#register-box').show();
    $('#login-box').hide();
    $('#forgot-box').hide();
  })
  $('#login-link').on('click', function(){
    $('#register-box').hide();
    $('#login-box').show();
    $('#forgot-box').hide();
  })
  $('#forgot-link').on('click', function(){
    $('#login-box').hide();
    $('#forgot-box').show();
  })
  $('#back-link').on('click', function(){
    $('#forgot-box').hide();
    $('#login-box').show();
  })


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

    //Login Ajax Request
      $('#login-btn').click(function(e){
          if ($('#login-form')[0].checkValidity()) {
            e.preventDefault();
            $.ajax({
              url: 'scripts/virus.php',
              method:'POST',
              data: $('#login-form').serialize()+'&action=login',
              beforeSend: function(){
                $("#login-btn").html('<img src="<?= URLROOT;  ?>gif/success.gif">Please wait...');
              },
          success:function(response){
            if ($.trim(response) === 'success') {
              window.location.href = '../index';
            }else{
                $('#logAlert').html(response);
            }
          },
          complete: function(){
            $("#login-btn").html('Sign In');
          }

            });

    }
      });



      $('#reset-btn').click(function(e){
        if ($("#reset-form")[0].checkValidity()) {
          e.preventDefault();
          $("#reset-btn").html('<img src="images/success.gif"> Please wait...');
          $.ajax({
            url: 'action.php',
            method: 'post',
            data: $("#reset-form").serialize()+'&action=forgot',
            success:function(response){
              $("#reset-btn").html('<img src="images/success.gif"> Please wait...');
              $('#reset-form')[0].reset();
              $("#reset-btn").html('Reset Password');
              $("#forAlert").html(response);
            }
          });
        }
      });


});
</script>
