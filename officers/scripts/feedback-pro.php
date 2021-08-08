<?php
require_once '../../core/init.php';
//feed back ajax
$user = new Officer();
$show = new Show();
$notify = new Notification();
$feed = new  Feedback();
$userid = $user->data()->officer_id;
$db = new Database::getInstance();

if (isset($_POST['action']) && $_POST['action'] == 'feedback') {
  $subject = $show->test_input($_POST['subject']);
  $feedback = $show->test_input($_POST['feedback']);

  if (empty($subject) || empty($feedback)) {
    echo $show->showMessage('danger', 'All Field are required','warning');
    return false;
  }


  $notvalid = array('what the hell', 'fuck', 'shirt', 'idiot', 'fool');
  foreach ($notvalid as $offence) {
     if (in_array(strtolower($_POST['feedback']), $offence)) {
    echo $show->showMessage('danger', 'Mind the Words you are using here!','warning');
    return false;
    }
  }


  $feed->feedBack(array
  (
    'officer_id' => $userid,
    'subject' => $subject,
    'feedback' => $feedback
  ));
  $user->notification($userid, 'Admin', 'Sent Feedback');
  echo 'true';




}

//grant user permission
if (isset($_POST['action']) && $_POST['action'] == 'grantPermisson') {

    $user_id = preg_replace("[^0-9]", "", trim($_POST['LtSecID']));
    $level = preg_replace("[^a-zA-Z]", "", trim($_POST['level']));

    $sql = "INSERT INTO dataFormPermission (permitted_id, level) VALUES ('$user_id', '$level')";
    $db->query($sql);

}


//grant user permission
if (isset($_POST['action']) && $_POST['action'] == 'grantPermissonCouncil') {

    $user_id = preg_replace("[^0-9]", "", trim($_POST['councilSecID']));
    $level = preg_replace("[^a-zA-Z]", "", trim($_POST['level']));

    $sql = "INSERT INTO dataFormPermission (permitted_id, level) VALUES ('$user_id', '$level')";
    $db->query($sql);

}
