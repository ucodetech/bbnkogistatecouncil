<?php
require_once '../../core/init.php';
//add new note ajax request
$user = new Officer();
$show = new Show();
$userid = $user->data()->officer_id;

if (isset($_POST['action']) && $_POST['action'] == 'add_note') {
    $title = $show->test_input($_POST['title']);
    $note = $show->test_input($_POST['note']);
    $user_id  = $user->data()->officer_id;
    $add = $user->add_new_note($user_id, $title, $note);
    if ($add) {
      $user->notification($user_id, 'Admin', 'Note Added');
    }


}

//Fetch Notes Ajax request
if (isset($_POST['action']) && $_POST['action'] == 'display_notes') {
  $output = '';
  $userid = $user->data()->officer_id;
  $notes =  $user->getNotes($userid);

  if (!$notes) {
    echo '<h3 class="text-center text-secondary">You do not have any notes! write your first note now!</h3>';
  }else{
    $output .= '
    <table id="showNotes" class="table table-striped table-sm">
      <thead>
        <tr>
          <th>#</th>
          <th>Title</th>
          <th>Note</th>
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
      <td>'.$note->title.'</td>
      <td>'.wrap($note->note).'...</td>
      <td>
        <a href="#" id="'.$note->id.'"  title="View Details" class="text-success infoBtn"><i class="fas fa-info-circle fa-lg"></i> </a>&nbsp;

          <a href="#"  id="'.$note->id.'" title="Edit Note" class="text-info editBtn" data-toggle="modal" data-target="#editNoteModal"><i class="fa fa-edit fa-lg"></i> </a>&nbsp;

            <a href="#" id="'.$note->id.'" title="Move Note to trash" class="text-danger deleteBtn"><i class="fa fa-trash fa-lg"></i> </a>
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

//Edit note
if (isset($_POST['edit_id'])) {
    $id = $_POST['edit_id'];
    $note = $user->editNote($id);

    echo json_encode($note);
}

//Update Note Now
if (isset($_POST['action']) && $_POST['action'] == 'update_note') {
  $id = $show->test_input($_POST['editId']);
  $title = $show->test_input($_POST['title']);
  $note = $show->test_input($_POST['note']);
  $user->updateNote($title, $note,$id);
  $user->notification($user->data()->officer_id, 'Admin', 'Updated Note');

}

//Move Note to trash can
if (isset($_POST['del_id'])) {
  $id = $_POST['del_id'];
  $user->deleteNote($id);
 $user->notification($userid, 'Admin', 'Note Deleted');

}


//Fetch Notes deleted Ajax request
if (isset($_POST['action']) && $_POST['action'] == 'display_deleted') {
  $output = '';
  $notes =  $user->getNoteDeleted($userid);
  if (!$notes) {
    echo '<h3 class="text-center text-secondary">Nothing in the trash can! <a href="dashboard"><i class="fa fa-tachometer fa-lg" aria-hidden="true"></i> Dashboard</a></h3>';
  }else{
    $output .= '
    <table id="showNotes" class="table table-striped table-sm">
      <thead>
        <tr>
          <th>#</th>
          <th>Title</th>
          <th>Note</th>
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
      <td>'.$note->title.'</td>
      <td>'.wrap($note->note).'...</td>
      <td>
        <a href="#" id="'.$note->id.'"  title="View Details" class="text-success infoBtn"><i class="fas fa-info-circle fa-lg"></i> </a>&nbsp;

      <a href="#" id="'.$note->id.'" title="Delete Note" class="text-danger deleteBtn"><i class="fa fa-trash fa-lg"></i> </a> &nbsp;

      <a href="#" id="'.$note->id.'" title="Restore Note" class="text-warning restoreBtn"><i class="fa fa-refresh fa-lg" aria-hidden="true"></i> </a>
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
  $user->restoreNote($id);
  $user->notification($userid, 'Admin', 'Note Restored');

}
//delete note
if (isset($_POST['delp_id'])) {
  $id = $_POST['delp_id'];
  $user->deleteNoteP($id);
  $user->notification($userid, 'Admin', 'Note Deleted From Trash');

}

//Display note Details
if (isset($_POST['info_id'])) {
  $id = $_POST['info_id'];

  $detail = $user->editNote($id);
  $user->notification($userid, 'Admin', 'Viewed note Detail');

  echo json_encode($detail);
}

//Display note Details
if (isset($_POST['infoD_id'])) {
  $id = $_POST['infoD_id'];

  $detail = $user->editNote($id);
  $user->notification($userid, 'Admin', 'Viewed Note in trash');

  echo json_encode($detail);
}

// FEtch notification ajax
if (isset($_POST['action']) && $_POST['action'] == 'fetchNotifaction') {

  $notifaction = $user->fetchNotifaction($userid);
  $output = '';
  if ($notifaction){
    foreach ($notifaction as $noti) {
      $output .= '
      <div class="alert alert-danger" role="alert">
        <button type="button" id="'.$noti->id.'" name="button" class="close" data-dismiss="alert" aria-label="Close">
        <span arid-hidden="true">&times;</span>
      </button>
      <h4 class="alert-heading">New Notification</h4>
      <p class="mb-0 lead">
        '.$noti->message.'
      </p>
      <hr class="my-2">
      <p class="mb-0 float-left">Reply From Admin</p>
      <p class="mb-0 float-right"><i class="lead">'.timeAgo($noti->dateCreated).'</i></p>
      <div class="clearfix"> </div>
    </div>
      ';
    }
    echo $output;
  }else{
    echo '<h4 class="text-center text-white mt-5">No New Notifications</h4>';
  }



  }

  if (isset($_POST['action']) && $_POST['action'] == 'checkNotifaction') {
      if ($user->fetchNotifaction($userid)) {
        $count =  $user->fetchNotifactionCount($userid);
        echo '<span class="badge badge-pill badge-danger">'.$count.'</span>';
      }else{
          $count =  $user->fetchNotifactionCount($userid);
      echo '<span class="badge badge-pill badge-danger">'.$count.'</span>';
      }
  }


//remove notifatications
if (isset($_POST['notifacation_id'])) {
  $id = $_POST['notifacation_id'];
  ;
  $user->removeNotification($id);

}
