<?php
require_once '../../core/init.php';
//Login
  $warhead = new CadetConsole();
  $show = new Show();
  $db = Database::getInstance();
if (isset($_POST['action']) && $_POST['action'] == 'generate') {
   $commander_name  = $show->test_input($_POST['commander-name']);
   $commander_email  = $show->test_input($_POST['commander-email']);
   $commander_tel  = $show->test_input($_POST['commander-tel']);
   $commander_permissions  = $_POST['permission'];
   $commander_accessName  = $show->test_input($_POST['commander-accessName']);
   $commander_password  = $show->test_input($_POST['commander-password']);
   $commander_cpassword  = $show->test_input($_POST['commander-cpassword']);

   if (empty($_POST['commander-name'])) {
      echo $show->showMessage('danger', 'Commander Full name is required!','warning');
      return false;
   }
   if (empty($_POST['commander-email'])) {
      echo $show->showMessage('danger', 'Commander email is required!','warning');
      return false;
   }elseif(!filter_var($commander_email , FILTER_VALIDATE_EMAIL)){
     echo $show->showMessage('danger', 'Commander email is invalid!','warning');
     return false;
   }

      if (empty($_POST['commander-tel'])) {
         echo $show->showMessage('danger', 'Commander phone number is required!','warning');
         return false;
      }
   if (empty($_POST['permission'])) {
      echo $show->showMessage('danger', 'Commander permission is required!','warning');
      return false;
   }


   if (empty($_POST['commander-accessName'])) {
      echo $show->showMessage('danger', 'Commander access name is required!','warning');
      return false;
   }

   if (empty($_POST['commander-password'])) {
      echo $show->showMessage('danger', 'Commander auth1 is required!','warning');
      return false;
   }elseif(strlen($_POST['commander-password'])  < 10){
     echo $show->showMessage('danger', 'Commander auth must be atleast 10 characters of more!','warning');
     return false;
   }

   if (empty($_POST['commander-cpassword'])) {
      echo $show->showMessage('danger', 'Commander auth2 is required!','warning');
      return false;
   }

      if ($commander_password  !=  $commander_cpassword  ) {
         echo $show->showMessage('danger', 'Commander auth1 and auth2 Mismatched!','warning');
         return false;
      }
   $hashed_commander_password = password_hash($commander_password , PASSWORD_DEFAULT);

   $state = 'sso';
   $newCommanderAccessName  = $commander_accessName.'-'.$state;

   $checkAccessName = $warhead->CadetAuth($newCommanderAccessName);
   if ($checkAccessName) {
     echo $show->showMessage('danger', 'Commander access name  already exist!','warning');
     return false;
   }

   $checkEmail = $warhead->findEmail($commander_email);
   if ($checkEmail) {
     echo $show->showMessage('danger', 'Commander email  already exist!','warning');
     return false;
   }

   $marker = $warhead->create($commander_name ,$commander_email , $commander_tel ,$commander_permissions ,$newCommanderAccessName , $hashed_commander_password);

   try {
     $default = 'default.png';
     $warhead->create(array(
        'commander_name' => $commander_name,
        'commander_email' => $commander_email,
        'commander_phone_no' => $commander_tel,
        'commander_permissions' => $commander_permissions,
        'commander_accessName' => $commander_accessName,
        'commander_password' => $commander_password,
        'profile_pic' => $default
     ));
     echo 'granted';

   } catch (Exception $e) {
     echo $show->showMessage('danger', $e->getMessage(), 'warning');
   }

}

//login

if (isset($_POST['action']) && $_POST['action'] == 'grant') {
  $username = $show->test_input($_POST['commander-accessName']);
  $password = $show->test_input($_POST['commander-accessPassword']);
if (empty($username)) {
      echo  $show->showMessage('danger','Auth Name is required!','warning');
      return false;
  }
if (empty($password)) {
      echo  $show->showMessage('danger','Auth Key is required!','warning');
      return false;
}
        $LoggedIn = $warhead->login($username, $password);

        if ($LoggedIn) {
            $warhead->virusMonitorHead($warhead->data()->command_id,  'A commander Logged In');
            echo 'granted';

        }
}


//Edit profile
//Update profile ajax
if (isset($_FILES['profilePhoto'])) {

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
      $uploadName = "faceRecond".$warhead->data()->command_id.".".$fileExt;
      $uploadPath = '../faceRecond/'.$uploadName;
      // $dbpath = $uploadName;

      if (!in_array($fileExt, $allowed )) {
         echo  $show->showMessage('danger', 'file extension not supported!','warning');
      }
      if ($fileSize > 1500000) {
          echo  $show->showMessage('danger', 'The file size must be blow 2MB.','warning');

      }
      // if ($uploadPath  != null) {
      //   unlink($uploadPath);
      //
      // }
      if(move_uploaded_file($tmpLoc, $uploadPath)){
        $id =  $warhead->data()->command_id;
        $sql = "UPDATE commanders SET profile_pic = '$uploadPath' WHERE command_id = '$id' ";
        $db->query($sql);
        $warhead->virusMonitorHead($warhead->data()->command_id, 'Commander updated profile picture');
        echo 'success';
      }

}


}


//Update profile ajax
if (isset($_POST['action']) && $_POST['action'] == 'updateRecord') {
    $full_name = $show->test_input($_POST['commander_full_name']);
    $phone = $show->test_input($_POST['commander_phone_number']);
    $church = $show->test_input($_POST['commander_home_church']);
    $id = $warhead->data()->command_id;

      $sql = "UPDATE commanders SET commander_name = '$full_name', commander_phone_number = '$phone', commander_home_church = '$church'  WHERE command_id = '$id' ";
      $db->query($sql);
      $warhead->virusMonitorHead($id, 'Commander updated profile Details');
      echo 'success';

}



//change password

//change Password
if (isset($_POST['action']) && $_POST['action'] == 'overide') {
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
    if (!password_verify($currentP, $warhead->data()->commander_password)) {
      echo $show->showMessage('danger', 'Current Password is not correct!','warning');
    }else{
      $warhead->change_access_key($hashNewPass, $warhead->data()->command_id);
      $warhead->virusMonitorHead($warhead->data()->command_id,  'Commander Changed Password');
      echo $show->showMessage('success', 'Access Key Changed successfully!','success');
    }
  }


}
