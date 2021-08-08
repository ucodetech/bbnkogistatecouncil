<?php
require_once '../../core/init.php';
//Update profile ajax
$user = new Officer();
$show =  new Show();
$userid = $user->data()->officer_id;
if (isset($_FILES['profilePhoto'])) {

    $full_name = $show->test_input($_POST['full_name']);
    $gender = $show->test_input($_POST['gender']);
    $dob = $show->test_input($_POST['dob']);
    $phone = $show->test_input($_POST['phone_number']);
    $nickname = $show->test_input($_POST['nickname']);

    if (!empty($_FILES)) {
      $file =$_FILES['profilePhoto'];
      $name = $file['name'];
      $nameArray = explode('.', $name);
      $fileName = $nameArray[0];
      $fileExt = $nameArray[1];
      $fileType = $file['type'];
      $tmpLoc = $file['tmp_name'];
      $fileSize = $file['size'];
      $allowed  = array('jpg');
      $uploadName = "avaters".$userid.".".$fileExt;
      $uploadPath = '../avaters/'.$uploadName;
      // $dbpath = $uploadName;

      if (!in_array($fileExt, $allowed )) {
         echo  $show->showMessage('danger', 'file extension not supported!','warning');
      }
      if ($fileSize > 1500000) {
          echo  $show->showMessage('danger', 'The file size must be blow 2MB.','warning');

      }
      // if ($uploadPath  != null) {
      //   unlink($uploadPath);
      // }
        move_uploaded_file($tmpLoc, $uploadPath);
    }

    $user->update_status($userid);
    $user->update_user($full_name, $gender, $dob, $phone, $nickname, $userid);
    $user->notification($userid, 'Admin', 'Profile image Updated');
    echo 'success';
}


//change Password
if (isset($_POST['action']) && $_POST['action'] == 'change_pass') {
  $currentP = $show->test_input($_POST['current-password']);
  $newP = $show->test_input($_POST['new-password']);
  $cnewP = $show->test_input($_POST['confirm-new-password']);


  if ($newP == '') {
    echo $show->showMessage('danger', 'New Password is required!','warning');
  }else{
      if (strlen($newP) < 10) {
        echo $show->showMessage('danger', 'Password must be atleast 10 characters long!','warning');
      }
  }
  if ($cnewP == '') {
    echo $show->showMessage('danger', 'Please verify new password!','warning');
  }else{
    if ($cnewP != $newP) {
      echo $show->showMessage('danger', 'Password Mismatch!','warning');
    }
  }

  $hashNewPass = password_hash($newP, PASSWORD_DEFAULT);
  if ($currentP == '') {
    echo $show->showMessage('danger', 'Current Password is required!','warning');
  }else{
    if (!password_verify($currentP, $data->password)) {
      echo $show->showMessage('danger', 'Current Password is not correct!','warning');
    }else{
      $user->change_password($hashNewPass, $userid);
      $user->notification($userid, 'Admin', 'Changed Password');
      echo $show->showMessage('success', 'Password Changed successfully!','check');
    }
  }


}

//verify email
if (isset($_POST['action']) && $_POST['action'] == 'verify_email') {
  $token = md5(microtime());
  $url = "http://localhost/bbnkogistatecouncil/officers/verify-email.php?token=".$token;

  $deleteUser = $user->deleteVkey($userid);
  $updateUser = $user->updateVkey($token, $userid);
  $user->notification($userid, 'Admin', 'Verified E-mail');

  if ($updateUser===true) {
    try {

            $mail =  new PHPMailer(true);
               //SMTP settings
               $mail->isSMTP();
               $mail->Host = "smtp.gmail.com";
               $mail->SMTPAuth = true;
               $mail->Username = "ucodetech.wordpress@gmail.com";
               $mail->Password =  "echo@mike12@@";
               $mail->Port = 587; //587 for tls
               $mail->SMTPSecure = "tls";

               //email settings
               $mail->isHTML(true);
               $mail->setFrom("ucodetech.wordpress@gmail.com");
               $mail->addAddress($data->email);
               $mail->addReplyTo("ucodetech.wordpress@gmail.com");
               $mail->Subject = "E-Mail verification";
               $mail->Body = "
            <div style='width:80%; height:auto; padding:10px; margin:10px'>
        <p align='center'><img src='http://localhost/ucodeTuts/images/ucodeTut%20Logo.png' class='img-fluid' width='300' alt='Ucode Logo' align='center'>  </p>
        <p style='color: #fff; font-size: 20px; text-align: center; text-transform: uppercase;margin-top:0px'>E-Mail verification</p>
        <p  style='color: #000; font-size: 18px; text-transform:capitalize;margin:10px;  '>
        Here is your E-mail verification link:<br><hr>
        <a  href='".$url."' style='margin-bottom: 0;font-weight: 400;text-align: center;white-space: nowrap;vertical-align: middle;-ms-touch-action: manipulation;touch-action: manipulation;cursor: pointer;background-image: none;border: 1px solid transparent;padding: 6px 12px;font-size: 14px;line-height: 1.42857143;border-radius: 4px;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;  color: #fff;background-color: #d9534f;border-color: #d43f3a; text-decoration: none; font-size: 20px;'>Verify Email</a>
        <hr>
        <hr>
        <h4>UcodeTuts</h4>
        <p style='color: #fff; font-size:20px; text-align: center; text-transform: uppercase;'>
        <a href='http//uzbgraphix.com.ng' style='color:#fff;'>Offical Site</a></p> </div>
        ";
        $mail->send();
        echo $show->showMessage('success', 'We have sent a verification link to you! check your mail-box','warning');
        } catch (\Exception $e) {
        echo $show->showMessage('danger', 'Something went wrong please try again!','warning');
        }
      }
}

//checking if user is logged in or note
if (isset($_POST['action']) &&  $_POST['action'] == 'checkUser') {
  if (!$user->isLoggedIn()) {
    echo 'Bye';
    Session::delete(Config::get('session/session_officer'));
    // $user->updateProfile($userid);s

  }
}
