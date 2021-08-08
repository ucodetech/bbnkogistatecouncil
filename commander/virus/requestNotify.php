<?php
require_once '../../core/init.php';
//feed back ajax
$general= new General();
$notify = new Notification();
// FEtch notification ajax
if (isset($_POST['action']) && $_POST['action'] == 'fetchRequestNotifaction') {

  $notifaction = $general->fetchReqestNotifaction();
  $output = '';
  if ($notifaction){
    foreach ($notifaction as $noti) {
      $user = $general->selectUserNote($noti->permitted_id);
      $output .= '
      <div class="col-lg-5 align-self-center">
      <div class="alert alert-info" role="alert">
        <button type="button" id="'.$noti->id.'" name="button" class="close" data-dismiss="alert" aria-label="Close">
        <span arid-hidden="true">&times;</span>
      </button>
      <h4 class="alert-heading">New Notification</h4>
      <p class="mb-0 lead">
        '.$user->officers_name.'->  '.$noti->level.'
      </p>
      <p class="mb-0 lead">

        Requeseted for permission as the Lieutenant In Charge of '.$user->officers_company_code.'-'.$user->officers_home_church.' to fill Data Form!.
      </p>
      <a href="#" id="'.$user->officer_id.'" data-name = "'.$user->officers_Lt_inCharge_name.'"  class="btn btn-danger btn-block verifyOfficerIcon">Verify Officer</a>
      <hr class="my-2">
      <p class="mb-0 float-left">Officer -> '.$user->officers_name.'</p>
      <p class="mb-0 float-right"><i class="lead">'.timeAgo($noti->dateRequested).'</i></p>
      <div class="clearfix"> </div>

      <a href="#" id="'.$user->officer_id.'" data-id = "'.$noti->id.'"  data-level="'.$noti->level.'" class="btn btn-success approveOfficerIcon"><i class="fa fa-check"></i>&nbsp;Approve</a>

      <a href="#" id="'.$user->officer_id.'" data-id = "'.$noti->id.'"  class="btn btn-warning deleteOfficerIcon float-right text-dark"><i class="fa fa-trash"></i>&nbsp;Delete Requeset</a>
    </div>
    </div>
      ';
    }
    echo $output;
  }else{
    echo '<h4 class="text-center text-info mt-5">No New Notifications</h4>';
  }



  }

if (isset($_POST['action']) && $_POST['action'] == 'getRequestNotify') {
    if ($general->fetchReqestNotifaction()) {
      $count =  $general->fetchReqestNotifactionCount();
      echo '<span class="badge badge-pill badge-danger">'.$count.'</span>';
    }else{
        $count =  $general->fetchReqestNotifactionCount();
    echo '<span class="badge badge-pill badge-danger">'.$count.'</span>';
    }
}



if (isset($_POST['officerLt_id'])) {
	$id = (int)$_POST['officerLt_id'];

	$check = $general->selectRequestedLt($id);
	if ($check) {
	echo json_encode($check);
	}

}


if (isset($_POST['approve_id'])) {
	$officerid = (int)$_POST['approve_id'];
	$requestid = (int)$_POST['request_id'];
  $level =  $_POST['level'];

  if ($level == 'Company Level') {
    $permission = 'companyLevelApproved';
  }elseif($level == 'Council Level'){
    $permission = 'CouncilLevelApproved';
  }


	$approved = 'granted';
	$sql = "UPDATE dataFormPermission SET permission = '$permission', approved = '$approved' WHERE id = '$requestid' AND permitted_id = '$officerid'  ";
  Database::getInstance()->query($sql);
	return true;

}


if (isset($_POST['delete_id'])) {
	$officerid = (int)$_POST['delete_id'];
	$requestid = (int)$_POST['request_id'];

	$sql = "DELETE FROM dataFormPermission WHERE id = '$officerid' AND permitted_id = '$requestid'  ";
  Database::getInstance()->query($sql);
  return true;

}
