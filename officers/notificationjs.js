$(document).ready(function(){



  //FEtch notification

  fetchNotifaction();
  setInterval(function(){
        fetchNotifaction();
  }, 1000);
  function fetchNotifaction(){
    $.ajax({
      url: 'scripts/process.php',
      method: 'post',
      data: {action: 'fetchNotifaction'},
      success:function(response){
        $('#showAlertNotification').html(response);
      }
    });
  }


  //CHECK NOTIFACATION
  checkNotifacations();

  setInterval(function(){
      checkNotifacations();
  }, 1000);
    function checkNotifacations(){
      $.ajax({
        url: 'scripts/process.php',
        method: 'post',
        data: {action: 'checkNotifaction'},
        success:function(response){
          // console.log(response);
          $('#checkNotifaction').html(response);
        }
      });
    }

  // remove notifiaction
  $('body').on('click', '.close', function(e){
    e.preventDefault();

    notifacation_id = $(this).attr('id');
    $.ajax({
      url: 'scripts/process.php',
      method: 'post',
      data: {notifacation_id: notifacation_id},
      success:function(response){
        checkNotifacations();
          fetchNotifaction();

      }
    });
  })
});
