<?php
require_once '../../core/init.php';
$general = new General();
$cadet = new CadetConsole();
$incharge = $cadet->data()->command_id;
if($_POST['action'] == "fetch_data"){
    $output = '';

    $row =   $general->loggedUsers();
   if ($row) {
     foreach ($row as $active) {

       ?>
       <div class="col-sm-2">
        <img src='../officers/avaters/<?=$active->profile_pic;?>' alt='User Image' width='70px' height='70px' style='border-radius:50px;'>";
         <br>
         <?=strtok($active->officers_name, ' ') . '- ID-' . $active->officer_id ;
         ?>

       </div>
       <?
     }
   }else{
    echo '<span class="text-danger lead">No officer online at the moment</span>';
   }


}


if($_POST['action'] == "fetch_commander"){
    $output = '';
    $parade =   $cadet->loggedAdmin();
   if ($parade) {
     foreach ($parade as $active) {
       ?>
       <div class="col-md-3">
          <img src='faceRecond/<?=$active->profile_pic;?>' width='70px' height='70px' style='border-radius:50px;'>
           <br>
           <?
         $shortname = explode(' ', $active->commander_name);
         $commander_first = $shortname[0];
         echo $commander_first. '- ID-' . $active->command_id;
         ?>

       </div>
       <?
     }
   }else{
     echo 'No one is online yet';
   }


}

if (isset($_POST['action']) && $_POST['action'] == 'update_war') {
      $cadet->updateWar($incharge);
}

if($_POST['action'] == "totOfficers"){
  $tot =  $general->totalCount('officers');
   echo $tot;
}
if($_POST['action'] == "totNotes"){
  $tot =  $general->totalCount('notes');
   echo $tot;
}
if($_POST['action'] == "totfeed"){
  $tot =  $general->totalCount('feedback');
   echo $tot;
}
if($_POST['action'] == "totHead"){
  $tot =  $general->totalCount('commander_monitor');
   echo $tot;
}
if($_POST['action'] == "totNotification"){
  $tot =  $general->totalCount('notifications');
   echo $tot;
}
if($_POST['action'] == "totVemail"){
  $tot =  $general->verified_officers_email(0);
   echo $tot;
}
if($_POST['action'] == "totVdemail"){
  $tot =  $general->verified_officers_email(1);
   echo $tot;
}
if($_POST['action'] == "totPwdReset"){
  $tot =  $general->totalCount('resetPwd');
   echo $tot;
}
if($_POST['action'] == "subs"){
  $tot =  $general->totalCount('newsSubscribers');
   echo $tot;
}
if($_POST['action'] == "hits"){
  $tot =  $general->hit();
   echo $tot->hits;
}
