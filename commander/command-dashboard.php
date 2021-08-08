<?php
require_once '../core/init.php';
if (!isCommanderGranted()) {
  Session::flash('message', 'Access Denied!');
  Redirect::to('command-access');

}
$incharge = new CadetConsole();
$count = new General();
require APPROOT .'/includes/Panelhead.php';
require APPROOT .'/includes/Panelnav.php';


?>

<div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->

    <div class="content">
      <?php if (hasPermissionSuper()): ?>

      <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="card-group">
              <div class="card border-danger shadow-lg border-2" style="flex-grow:1.4;">
                <div class="card-header bg-info">
                  <h3 class="m-0 text-white">
                    <i class="fa fa-users"></i>&nbsp; Active Officers
                  </h3>
                </div>
                <div class="card-body">
                  <div class="row" id="activeUsers">
                <p class="text-center lead mt-5"><img src="<?= URLROOT; ?>gif/tra.gif" />    Please Wait...</p>

                  </div>
                </div>
            </div>
              <div class="card border-danger shadow-lg border-2">
            <div class="card-header bg-info">
                  <h3 class="m-0 text-white">
                    <i class="fa fa-users"></i>&nbsp; Active Commanders
                  </h3>
                </div>
                <div class="card-body">
                  <div class="row" id="activeAdmin">

                    <p class="text-center lead mt-5"><img src="<?= URLROOT; ?>gif/tra.gif" />    Please Wait...</p>

                  </div>
                </div>
              </div>
            </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card-deck mt-3 text-light text-center font-weight-bold">
                <div class="card bg-primary">
                  <div class="card-header">
                    <i class="fas fa-users fa-lg"></i>Total Users
                  </div>
                  <div class="card-body">
                    <h1 class="display-4" id="totUsers">

                      <p class="text-center lead mt-5"><img src="<?= URLROOT; ?>gif/tra.gif" />    Please Wait...</p>

                    </h1>
                  </div>
                </div>
                <div class="card bg-success">
                  <div class="card-header">
                      <i class="fas fa-envelope fa-lg"></i>Verified Users
                  </div>
                  <div class="card-body">
                    <h1 class="display-4" id="totVemails">

                      <p class="text-center lead mt-5"><img src="<?= URLROOT; ?>gif/tra.gif" />    Please Wait...</p>

                    </h1>
                  </div>
                </div>
                <div class="card bg-danger">
                  <div class="card-header">
                  <i class="fas fa-envelope fa-lg"></i>Unverified Users
                  </div>
                  <div class="card-body">
                    <h1 class="display-4" id="totVdemails">
                      <p class="text-center lead mt-5"><img src="<?= URLROOT; ?>gif/tra.gif" />    Please Wait...</p>

                    </h1>
                  </div>
                </div>
                <div class="card bg-info">
                  <div class="card-header">
                  <i class="fas fa-circle fa-lg"></i> Website hit
                  </div>
                  <div class="card-body">
                    <h1 class="display-4" id="totHits">
                      <p class="text-center lead mt-5"><img src="<?= URLROOT; ?>gif/tra.gif" />    Please Wait...</p>

                    </h1>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card-deck mt-3 text-light text-center font-weight-bold">
                <div class="card bg-danger">
                  <div class="card-header">
                    <i class="fas fa-book fa-lg"></i>Total Notes
                  </div>
                  <div class="card-body">
                    <h1 class="display-4" id="totNotes">
                      <p class="text-center lead mt-5"><img src="<?= URLROOT; ?>gif/tra.gif" />    Please Wait...</p>

                    </h1>
                  </div>
                </div>
                <div class="card bg-success">
                  <div class="card-header">
                    <i class="fas fa-comment-dots fa-lg"></i>Total Feedback
                  </div>
                  <div class="card-body">
                    <h1 class="display-4" id="totFeedback">
                      <p class="text-center lead mt-5"><img src="<?= URLROOT; ?>gif/tra.gif" />    Please Wait...</p>

                    </h1>
                  </div>
                </div>
                <div class="card bg-warning">
                  <div class="card-header">
                    <i class="fas fa-bell fa-lg"></i>Total Notification
                  </div>
                  <div class="card-body">
                    <h1 class="display-4" id="totNotification">
                      <p class="text-center lead mt-5"><img src="<?= URLROOT; ?>gif/tra.gif" />    Please Wait...</p>

                    </h1>
                  </div>
                </div>
                <div class="card bg-primary">
                  <div class="card-header">
                    <i class="fas fa-bell fa-lg"></i>Total Notification From Admin
                  </div>
                  <div class="card-body">
                    <h1 class="display-4" id="totMonitor">
                      <p class="text-center lead mt-5"><img src="<?= URLROOT; ?>gif/tra.gif" />    Please Wait...</p>

                    </h1>
                  </div>
                </div>
                <div class="card bg-secondary">
                  <div class="card-header">
                  <i class="fas fa-key fa-lg"></i>  Total Password Reset Request
                  </div>
                  <div class="card-body">
                    <h1 class="display-4" id="totpwD">
                      <p class="text-center lead mt-5"><img src="<?= URLROOT; ?>gif/tra.gif" />    Please Wait...</p>

                    </h1>
                  </div>
                </div>
              </div>
            </div>
          </div>
           <div class="row">
            <div class="col-lg-12">
              <div class="card-deck mt-3 text-light text-center font-weight-bold">
                <div class="card bg-primary">
                  <div class="card-header">
                    <i class="fas fa-users fa-lg"></i> - <i class="fas fa-newspaper fa-lg"></i>&nbsp;Total Subscribers
                  </div>
                  <div class="card-body">
                    <h1 class="display-4" id="totSubscribers">
                      <p class="text-center lead mt-5"><img src="<?= URLROOT; ?>gif/tra.gif" />    Please Wait...</p>

                    </h1>
                  </div>
                </div>
               <!--  <div class="card bg-success">
                  <div class="card-header">
                      <i class="fas fa-envelope fa-lg"></i>Verified Users
                  </div>
                  <div class="card-body">
                    <h1 class="display-4" id="totVemails">

                    </h1>
                  </div>
                </div>
                <div class="card bg-danger">
                  <div class="card-header">
                  <i class="fas fa-envelope fa-lg"></i>Unverified Users
                  </div>
                  <div class="card-body">
                    <h1 class="display-4" id="totVdemails">
                    </h1>
                  </div>
                </div>
                <div class="card bg-info">
                  <div class="card-header">
                  <i class="fas fa-circle fa-lg"></i> Website hit
                  </div>
                  <div class="card-body">
                    <h1 class="display-4" id="totHits">

                    </h1>
                  </div>
                </div> -->
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card-deck my-3">
                <div class="card border-success">
                  <div class="card-header bg-success text-center text-white lead">
                    Male/Female User's Percentage
                  </div>
                  <div id="chartOne" style="width:99%; height:400px;">

                  </div>
                </div>
                <div class="card border-info">
                  <div class="card-header bg-info text-center text-white lead">
                  Verified/Unverified Percentage
                  </div>
                  <div id="chartTwo" style="width:99%; height:400px;">

                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div><!-- /.container-fluid -->
      <?php else: ?>
        <div class="container">
          <h3 class="text-center text-secondary">Welcome <?= $incharge->data()->commander_name ?></h3>
        </div>
    <?php endif; ?>
      <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
  // Load the Visualization API and the corechart package.
     google.charts.load('current', {'packages':['corechart']});

     // Set a callback to run when the Google Visualization API is loaded.
     google.charts.setOnLoadCallback(pieChart);

     // Callback that creates and populates a data table,
     // instantiates the pie chart, passes in the data and
     // draws it.
     function pieChart() {

       // Create the data table.
       var data = new google.visualization.arrayToDataTable([
         ['Gender', 'Number'],
         <?php
            $gender = $count->genderPer();
            foreach ($gender as $row) {
              echo '["'.$row->officers_gender.'", '.$row->number.'],';
            }
          ?>

       ]);

       // Set chart options
       var options = {'title':'Officers Gender',
                      is3D: false
                    };

       // Instantiate and draw our chart, passing in some options.
       var chart = new google.visualization.PieChart(document.getElementById('chartOne'));
       chart.draw(data, options);
     }




     // Load the Visualization API and the corechart package.
        google.charts.load('current', {'packages':['corechart']});

        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(colChart);

        // Callback that creates and populates a data table,
        // instantiates the pie chart, passes in the data and
        // draws it.
        function colChart() {

          // Create the data table.
          var data = new google.visualization.arrayToDataTable([
            ['Verified', 'Number'],
            <?php
               $verified = $count->verifiedPer();
               foreach ($verified as $row) {
                 if ($row->verified == 0) {
                   $row->verified = 'Unverified';
                 }else{
                   $row->verified = 'Verified';
                 }
                 echo '["'.$row->verified.'", '.$row->number.'],';
               }
             ?>

          ]);

          // Set chart options
          var options = {'title':'Verified and Unverified E-Mail',
                        pieHole: 0.4,
                       };

          // Instantiate and draw our chart, passing in some options.
          var chart = new google.visualization.PieChart(document.getElementById('chartTwo'));
          chart.draw(data, options);
        }
  </script>

<?php   require APPROOT .'/includes/Panelfooter.php';?>
<script type="text/javascript">
$('document').ready(function(){


//fetech active admins
fetch_admin_login();

setInterval(function(){
   fetch_admin_login();
}, 3000);

function fetch_admin_login()
{
    var action = 'fetch_commander';
    $.ajax({
       url:"virus/initate.php",
       method:"POST",
       data:{action:action},
       success:function(data)
       {
         $('#activeAdmin').html(data);

       },
       error:function(){alert("something went wrong fetch admin")}

    });
}


//FEcth active users
    fetch_user_login();

    setInterval(function(){
       fetch_user_login();
    }, 3000);

    function fetch_user_login()
    {
        var action = 'fetch_data';
        $.ajax({
           url:"virus/initate.php",
           method:"POST",
           data:{action:action},
           success:function(data)
           {
             $('#activeUsers').html(data);

           },
           error:function(){alert("something went wrong fetch user login")}

        });
    }
//Fetch total users

fetch_totOfficers();

setInterval(function(){
   fetch_totOfficers();
}, 5000);

function fetch_totOfficers()
{
    var action = 'totOfficers';
    $.ajax({
       url:"virus/initate.php",
       method:"POST",
       data:{action:action},
       success:function(data)
       {
         $('#totUsers').html(data);

       },
       error:function(){alert("something went wrong tot users")}

    });
}

//Fetch total verified email

fetch_totVdemail();

setInterval(function(){
   fetch_totVdemail();
}, 5000);

function fetch_totVdemail()
{
    var action = 'totVdemail';
    $.ajax({
       url:"virus/initate.php",
       method:"POST",
       data:{action:action},
       success:function(data)
       {
         $('#totVemails').html(data);

       },
       error:function(){alert("something went wrong to v email")}

    });
}

//Fetch total verified email

fetch_totnVemail();

setInterval(function(){
   fetch_totnVemail();
}, 5000);

function fetch_totnVemail()
{
    var action = 'totVemail';
    $.ajax({
       url:"virus/initate.php",
       method:"POST",
       data:{action:action},
       success:function(data)
       {
         $('#totVdemails').html(data);

       },
       error:function(){alert("something went wrong tot v email 2")}

    });
}


//Fetch total notes

fetch_totNotes();

setInterval(function(){
   fetch_totNotes();
}, 5000);

function fetch_totNotes()
{
    var action = 'totNotes';
    $.ajax({
       url:"virus/initate.php",
       method:"POST",
       data:{action:action},
       success:function(data)
       {
         $('#totNotes').html(data);

       },
       error:function(){alert("something went wrong tot notes")}

    });
}
//Fetch total feed back

fetch_totFeed();

setInterval(function(){
   fetch_totFeed();
}, 5000);

function fetch_totFeed()
{
    var action = 'totfeed';
    $.ajax({
       url:"virus/initate.php",
       method:"POST",
       data:{action:action},
       success:function(data)
       {
         $('#totFeedback').html(data);

       },
       error:function(){alert("something went wrong tot feed")}

    });
}
//Fetch total notifactions

fetch_totNote();

setInterval(function(){
   fetch_totNote();
}, 5000);

function fetch_totNote()
{
    var action = 'totNotification';
    $.ajax({
       url:"virus/initate.php",
       method:"POST",
       data:{action:action},
       success:function(data)
       {
         $('#totNotification').html(data);

       },
       error:function(){alert("something went wrong tot notif")}

    });
}

//Fetch total Admin

fetch_totMonitor();

setInterval(function(){
   fetch_totMonitor();
}, 5000);

function fetch_totMonitor()
{
    var action = 'totHead';
    $.ajax({
       url:"virus/initate.php",
       method:"POST",
       data:{action:action},
       success:function(data)
       {
         $('#totMonitor').html(data);

       },
       error:function(){alert("something went wrong tot monitor")}

    });
}

//Fetch Password reset

fetch_totPwdReset();

setInterval(function(){
   fetch_totPwdReset();
}, 5000);

function fetch_totPwdReset()
{
    var action = 'totPwdReset';
    $.ajax({
       url:"virus/initate.php",
       method:"POST",
       data:{action:action},
       success:function(data)
       {
         $('#totpwD').html(data);

       },
       error:function(){alert("something went wrong tot password reset")}

    });
}

//Fetch Hits

fetch_hits();

setInterval(function(){
   fetch_hits();
}, 500);

function fetch_hits()
{
    var action = 'hits';
    $.ajax({
       url:"virus/initate.php",
       method:"POST",
       data:{action:action},
       success:function(data)
       {
         $('#totHits').html(data);

       },
       error:function(){alert("something went wrong tot hits")}

    });
}

//Fetch Subscribers

subscrbers();

setInterval(function(){
   subscrbers();
}, 500);

function subscrbers()
{
    var action = 'subs';
    $.ajax({
       url:"virus/initate.php",
       method:"POST",
       data:{action:action},
       success:function(data)
       {
         $('#totSubscribers').html(data);

       },
       error:function(){alert("something went wrong subscrbers")}

    });
}


});

</script>
<script type="text/javascript" src="notify.js"></script>
