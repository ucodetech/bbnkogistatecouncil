<?php
require_once  '../../core/init.php';
  $general = new General();
  $feed = new Feedback();
  $notify = new Notification();
if(isset($_POST['action']) && $_POST['action'] == 'fetchAllUsers'){
    $output = '';

    $dat = $general->selectUsers(0);

    if ($dat) {

      $output .= '
      <table class="table table-striped table-hover" id="show">
        <thead>
          <tr>
            <th>#</th>
            <th>Photo</th>
            <th>Full Name</th>
            <th>E-Mail</th>
            <th>State ID</th>
            <th>Email Verified</th>
            <th>Action</th>

          </tr>
        </thead>
        <tbody>
      ';
      foreach ($dat as $row) {

          $yes = '<img src="../officers/avaters/'.$row->profile_pic.'"  alt="User Image" width="70px" height="70px" style="border-radius:50px;">';

        if($row->verified == 0){
            $msg ='<span class="text-danger align-self-center lead">No</span>';
        }else{

          $msg ='<span class="text-success align-self-center lead">Yes</span>';

        }
        $output .= '
            <tr>
              <td>'.$row->officer_id.'</td>
                <td>'.$yes.'</td>
                     <td>'.$row->officers_name.'</td>
                       <td>'.$row->officers_email.'</td>
                         <td>'.$row->stateNo.'</td>
                           <td>'.$msg.'</td>
                           <td>
                           <a href="#" id="'.$row->officer_id.'" title="View Details" class="text-primary userDetailsIcon" data-toggle="modal" data-target="#showUserDetailsModal"><i class="fas fa-info-circle fa-lg"></i> </a>&nbsp;
                           <a href="#" id="'.$row->officer_id.'" title="Trash User" class="text-danger deleteUserIcon"><i class="fa fa-recycle fa-lg"></i> </a>&nbsp;

                           </td>
            </tr>
            ';
      }



      $output .= '
        </tbody>
      </table>';
      echo $output;
    }else{
      echo '<h3 class="text-center text-secondary align-self-center lead">No user In database</h3>';
    }

}
// USer in detail by id
if (isset($_POST['details_id'])) {
  $output = '';
  $id = $_POST['details_id'];
  $data = $general->fetchUserDetail($id, 0);
    $yes = '<img src="../officers/avaters/'.$data->profile_pic.'"
    alt="User Image" class="img-thumbnail img-fluid align-self-center" width="280px" >';

  if($data->verified == 0){
      $msg ='<span class="text-danger align-self-center lead">No</span>';
  }else{

    $msg ='<span class="text-success align-self-center lead">Yes</span>';

  }
  $output .= '
  <div class="modal-header">
    <h3 class="modal-title">
      '.$data->officers_name.' - ID: '.$data->stateNo.'
    </h3>
    <button type="button" class="close" data-dismiss="modal" name="button">&times;</button>
  </div>
  <div class="modal-body">
    <div class="card-deck">
      <div class="card border-primary" style="border:2px solid blue;">
        <div class="card-body">
          <p>Email: '.$data->officers_email.' </p>
          <p>Phone Number: '.$data->officers_phone_no.'</p>
          <p>Gender: '.ucfirst($data->officers_gender).'</p>
          <p>DOB: '.$data->officers_dob.' </p>
          <p>Company: '.$data->officers_company_code.' </p>
          <p>Church: '.$data->officers_home_church.' </p>
          <p>Lt. In Charge: '.$data->officers_Lt_inCharge_name.' </p>
          <p>Captian: '.$data->officers_Capts_name.' </p>
          <p>Rank: '.$data->officers_rank.' </p>
          <p>Group Council: '.$data->officers_group_council.' </p>
          <p>LGA: '.$data->officers_lga.' </p>
          <p>Email-Verified: '.$msg.'</p>
          <p>Registered On: '.pretty_dates($data->date_joined).'</p>
          <p>Last Login: '.timeAgo($data->last_login).'</p>
        </div>
      </div>
      <div class="card align-self-center">
          '.$yes.'
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
  </div>
  ';
  echo ($output);
}
//delete user
if (isset($_POST['del_id'])) {
    $id = $_POST['del_id'];
  $general->userAction($id, 1);
}

//Fetch Notes Ajax request
if (isset($_POST['action']) && $_POST['action'] == 'fetchAllNotes') {
  $output = '';
  $notes =  $general->getNotes();
  if (!$notes) {
    echo '<h3 class="text-center text-secondary">Users have not written any note!</h3>';
  }else{

    $output .= '
    <table id="showNotes" class="table table-striped table-sm">
      <thead>
        <tr>
          <th>#</th>
          <th>User Name</th>
          <th>User Eamil</th>
          <th>Note Title</th>
          <th>Note</th>
          <th>Written On</th>
          <th>Updated On </th>
          <th>Action</th>
        </tr>
        <tbody>
    ';
    $x = 0;
    foreach ($notes as $note) {
      $x = $x + 1;
    $output .= '
    <tr>
      <td>'.$x.'</td>
      <td>'.$note->full_name.'</td>
      <td>'.$note->email.'</td>
      <td>'.$note->title.'</td>
      <td>'.wrap($note->note).'...</td>
      <td>'.pretty_date($note->dateCreated).'</td>
      <td>'.pretty_date($note->dateUpdated).'</td>
      <td>
        <a href="#" id="'.$note->id.'"  title="View Details" class="text-success infoBtn"><i class="fas fa-info-circle fa-lg"></i> </a>&nbsp;

        <a href="#" id="'.$note->id.'" title="Move Note to trash" class="text-danger deleteBtn"><i class="fa fa-recycle fa-lg"></i> </a>
      </td>
    </tr>
    ';

    }
    $output .='
    </tbody>
  </thead>
</table>
    ';
    echo $output;
  }

}


//delete note
if (isset($_POST['del_id'])) {
  $id = $_POST['del_id'];
  $general->noteAction($id, 1);

}

//delete feedback
if (isset($_POST['delfed_id'])) {
  $id = $_POST['delfed_id'];
  $general->feedAction($id);

}

//Display note Details
if (isset($_POST['info_id'])) {
  $id = $_POST['info_id'];

  $detail = $general->editNote($id);
  echo json_encode($detail);
}

//Fetch Notes Ajax request
if (isset($_POST['action']) && $_POST['action'] == 'fetchAllFeed') {
  $output = '';
  $feeds =  $general->getFeedback();
  if (!$feeds) {
    echo '<h3 class="text-center text-secondary">No Feedback from users!</h3>';
  }else{

    $output .= '
    <table id="show" class="table table-striped table-sm">
      <thead>
        <tr>
          <th>#</th>
          <th>User Name</th>
          <th>User Eamil</th>
          <th>Feedback Suject</th>
          <th>Feedback</th>
          <th>Sent On</th>
          <th>Replied</th>
          <th>Action</th>
        </tr>
        <tbody>
    ';
    $x = 0;
    foreach ($feeds as $feed) {
      if ($feed->replied == 0) {
          $msg = "<span class='text-danger align-self-center lead'>No</span>";
      }else{
        $msg = "<span class='text-success align-self-center lead'>Yes</span>";
      }
      $x = $x + 1;
    $output .= '
    <tr>
      <td>'.$x.'</td>
      <td>'.$feed->full_name.'</td>
      <td>'.$feed->email.'</td>
      <td>'.$feed->subject.'</td>
      <td>'.wrap($feed->feedback).'...</td>
      <td>'.pretty_date($feed->dateCreated).'</td>
      <td>'.$msg.'</td>
      <td>
        <a href="#" id="'.$feed->id.'"  title="View Details" class="text-success feedBackinfoBtn"  data-toggle="modal" data-target="#showFeedDetailsModal"><i class="fas fa-info-circle fa-lg"></i> </a>&nbsp;

        <a href="#" id="'.$feed->id.'" title="Delete Feedback" class="text-danger feedBackdeleteBtn"><i class="fa fa-trash fa-lg"></i> </a>
      </td>
    </tr>
    ';

    }
    $output .='
    </tbody>
  </thead>
</table>
    ';
    echo $output;
  }

}

if (isset($_POST['feeddetails_id'])) {
    $id = $_POST['feeddetails_id'];
    $feeds = $feed->feedDetails($id);
    $user = $general->selectUserNote($feeds->user_id);
    $output = '';
    if ($feeds->replied == 0) {
        $msg = "<span class='text-danger align-self-center lead'>No</span>";
        $answer  = '<a href="#" fid="'.$feeds->id.'" id="'.$feeds->user_id.'" class="btn btn-primary btn-block btn-lg replyFeedbackIcon" title="Reply" data-toggle="modal" data-target="#replyModal"><i class="fas fa-reply fa-lg"></i> </a>';
    }else{
      $msg = "<span class='text-success align-self-center lead'>Yes</span>";
      $answer = "<span class='btn btn-info btn-lg btn-block align-self-center lead'>Feedback Replied</span>";
    }
    $output .= '
    <div class="modal-header">
      <h3 class="modal-title" id="getName">
        '.$user->full_name.' - ID: '.$user->id.'
      </h3>
      <button type="button" class="close" data-dismiss="modal" name="button">&times;</button>
    </div>
    <div class="modal-body">
      <div class="card-deck">
        <div class="card border-primary" style="border:2px solid blue;">
          <div class="card-body">
            <p> Email: '.$user->email.' </p>
            <p>Subject: '.$feeds->subject.'</p>
            <p>Feedback: '.$feeds->feedback.' </p>
            <p>Replied: '.$msg.'</p>
            <p>Sent On: '.pretty_date($feeds->dateCreated).'</p>
          </div>
        </div>
        <div class="card align-self-center">
              '.$answer.'
        </div>
      </div>
    </div>
    <div class="modal-footer">
    <span class="align-left">Feedback Detail</span>
      <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
    </div>
    ';


    echo $output;
}

//Reply feedback to user Ajax
if (isset($_POST['message'])) {
  $userid = $_POST['userid'];
  $message = $general->test_input($_POST['message']);
  $feedid = $_POST['feedid'];

  $feed->replyFeedback($userid, $message);
  $feed->updateFeedbackReplied($feedid);

}


// FEtch notification ajax
if (isset($_POST['action']) && $_POST['action'] == 'fetchNotifaction') {

  $notifaction = $notify->fetchNotifactionAdmin();
  $output = '';
  if ($notifaction){
    foreach ($notifaction as $noti) {
      $user = $general->selectUserNote($noti->officer_id);
      $output .= '
      <div class="col-lg-5 align-self-center">
      <div class="alert alert-info" role="alert">
        <button type="button" id="'.$noti->id.'" name="button" class="close" data-dismiss="alert" aria-label="Close">
        <span arid-hidden="true">&times;</span>
      </button>
      <h4 class="alert-heading">New Notification</h4>
      <p class="mb-0 lead">
        '.$user->officers_name.'->  '.$noti->message.'
      </p>
      <hr class="my-2">
      <p class="mb-0 float-left">User -> '.$user->officers_name.'</p>
      <p class="mb-0 float-right"><i class="lead">'.timeAgo($noti->dateCreated).'</i></p>
      <div class="clearfix"> </div>
    </div>
    </div>
      ';
    }
    echo $output;
  }else{
    echo '<h4 class="text-center text-white mt-5">No New Notifications</h4>';
  }



  }

if (isset($_POST['action']) && $_POST['action'] == 'getNotify') {
    if ($notify->fetchNotifactionAdmin()) {
      $count =  $notify->fetchNotifactionCountAdmin();
      echo '<span class="badge badge-pill badge-danger">'.$count.'</span>';
    }else{
        $count =  $notify->fetchNotifactionCountAdmin();
    echo '<span class="badge badge-pill badge-danger">'.$count.'</span>';
    }
}
