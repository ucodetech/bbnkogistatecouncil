<?php
require_once  '../../core/init.php';
$general = new General();
$show = new Show();//Fetch Tutorals
if(isset($_POST['action']) && $_POST['action'] == 'fetchAllUsers'){
    $output = '';

    $dat = $general->selectUsers(1);

    if ($dat) {

      $output .= '
      <table class="table table-striped table-hover" id="show">
        <thead>
          <tr>
            <th>User ID</th>
            <th>Photo</th>
            <th>Full Name</th>
            <th>E-Mail</th>
            <th>Phone Number</th>
            <th>Email Verified</th>
            <th>Action</th>

          </tr>
        </thead>
        <tbody>
      ';
      foreach ($dat as $row) {
        $profi = $general->getImg($row->id);
        if ($profi->status == 0) {
          $yes = '<img src="../users/avaters/avaters'.$profi->user_id.'.jpg"  alt="User Image" width="70px" height="70px" style="border-radius:50px;">';
        }else{
          $yes = "<img src='../users/avaters/default.png' width='70px' height='70px' style='border-radius:50px;' alt='Default Image'>";
        }
        if($row->verified == 0){
            $msg ='<span class="text-danger align-self-center lead">No</span>';
        }else{

          $msg ='<span class="text-success align-self-center lead">Yes</span>';

        }
        $output .= '
            <tr>
              <td>'.$row->id.'</td>
                <td>'.$yes.'</td>
                     <td>'.$row->full_name.'</td>
                       <td>'.$row->email.'</td>
                         <td>'.$row->phone_number.'</td>
                           <td>'.$msg.'</td>
                           <td>
                           <a href="#" id="'.$row->id.'" title="View Details" class="text-primary userDetailsIcon" data-toggle="modal" data-target="#showUserDetailsModal"><i class="fas fa-info-circle fa-lg"></i> </a>&nbsp;
                           <a href="#" id="'.$row->id.'" title="Delete User" class="text-danger deleteUserIcon"><i class="fas fa-trash fa-lg"></i> </a>&nbsp;
                          <a href="#" id="'.$row->id.'" title="Restore User" class="text-warning restoreBtn"><i class="fa fa-recycle fa-lg" ></i></a>
                           </td>
            </tr>
            ';
      }



      $output .= '
        </tbody>
      </table>';
      echo $output;
    }else{
      echo '<h3 class="text-center text-secondary align-self-center lead">No Deletd user In database</h3>';
    }

}
// USer in detail by id
if (isset($_POST['details_id'])) {
  $output = '';
  $id = $_POST['details_id'];
  $data = $general->fetchUserDetail($id, 1);
    $yes = '<img src="../users/avaters/'.$data->profile_pic.'"
    alt="User Image" class="img-thumbnail img-fluid align-self-center" width="280px" >';

  if($data->verified == 0){
      $msg ='<span class="text-danger align-self-center lead">No</span>';
  }else{

    $msg ='<span class="text-success align-self-center lead">Yes</span>';

  }
  $output .= '
  <div class="modal-header">
    <h3 class="modal-title" id="getName">
      '.$data->full_name.' - ID: '.$data->id.'
    </h3>
    <button type="button" class="close" data-dismiss="modal" name="button">&times;</button>
  </div>
  <div class="modal-body">
    <div class="card-deck">
      <div class="card border-primary" style="border:2px solid blue;">
        <div class="card-body">
          <p> Email: '.$data->email.' </p>
          <p>Phone Number: '.$data->phone_number.'</p>
          <p>Gender: '.ucfirst($data->gender).'</p>
          <p>DOB: '.$data->dob.' </p>
          <p>Email-Verified: '.$msg.'</p>
          <p>Registered On: '.pretty_date($data->dateJoined).'</p>
          <p>Last Login: '.pretty_date($data->lastLogin).'</p>
        </div>
      </div>
      <div class="card align-self-center">
          '.$yes.'
      </div>
    </div>
  </div>
  ';
  echo ($output);
}
//delete user
if (isset($_POST['del_id'])) {
    $id = $_POST['del_id'];
  $general->deleteUserP($id);
}

//restore user
if (isset($_POST['restore_id'])) {
    $id = $_POST['restore_id'];
  $general->userAction($id, 0);
}


//Fetch Notes Ajax request
if (isset($_POST['action']) && $_POST['action'] == 'display_deleted') {
  $output = '';
  $notes =  $general->getNoteDeleted();
  if (!$notes) {
    echo '<h3 class="text-center text-secondary">You have not deleted any note from user!</h3>';
  }else{

    $output .= '
    <table id="showDeletedNotes" class="table table-striped table-sm">
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
        $user = $general->selectUserNote($note->officer_id);
      $x = $x + 1;
    $output .= '
    <tr>
      <td>'.$x.'</td>
      <td>'.$user->officers_name.'</td>
      <td>'.$user->officers_email.'</td>
      <td>'.$note->title.'</td>
      <td>'.wrap($note->note).'...</td>
      <td>'.pretty_date($note->dateCreated).'</td>
      <td>'.pretty_date($note->dateUpdated).'</td>
      <td>
        <a href="#" id="'.$note->id.'"  title="View Details" class="text-success infoBtn"><i class="fas fa-info-circle fa-lg"></i> </a>&nbsp;

        <a href="#" id="'.$note->id.'" title="Delete Note" class="text-danger deleteBtn"><i class="fa fa-recycle fa-lg"></i> </a>
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

//Move Note to trash can
if (isset($_POST['restore_id'])) {
  $id = $_POST['restore_id'];
  $general->noteAction($id, 0);

}
//delete note
if (isset($_POST['delnot_id'])) {
  $id = $_POST['delnot_id'];
  $general->deleteNoteP($id);

}
//Display note Details
if (isset($_POST['infoD_id'])) {
  $id = $_POST['infoD_id'];

  $detail = $general->editNote($id);
  echo json_encode($detail);
}
