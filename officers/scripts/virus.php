<?php
require_once '../../core/init.php';
$warhead = new Officer();
$show = new Show();
$notify = new Notification();
$db = Database::getInstance();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['action']) && $_POST['action'] == 'reg_officer') {
	$officer_name = $show->test_input($_POST['full_name']);
    $officer_dob = $show->test_input($_POST['dob']);
    $officer_lga = $show->test_input($_POST['lga']);
    $officer_email = $show->test_input($_POST['email']);
    $officer_phone_no = $show->test_input($_POST['tel_no']);
    $officer_companyCode = $show->test_input($_POST['comp_name']);
		$officer_captsName = $show->test_input($_POST['capt-name']);
    $officer_LtInCharge = $show->test_input($_POST['lt_name'] );
    $officer_rank = $show->test_input($_POST['rank-port'] );
    $officer_groupCouncil = $show->test_input($_POST['group_council'] );
    $officer_password = $show->test_input($_POST['password'] );
    $officer_cpassword = $show->test_input($_POST['cpassword']);
    $officer_home_church = $show->test_input($_POST['home_church']);
    $officer_username = $show->test_input($_POST['officer_username']);
	$officer_gender = $show->test_input($_POST['gender']);
	$permission = 'bbn/ksc';


	$required = array(
		'full_name','dob','lga','email','tel_no','comp_name','capt-name','lt_name','rank-port','group_council','password','cpassword','home_church','gender','officer_username'
	);
foreach ($required as $field) {
	if (empty($_POST[$field])) {
		echo $show->showMessage('danger', 'All Fields are required!','warning');
		return false;
	}
}
//add a check  for list of group councils in kogi state
   $sql2 = "SELECT * FROM BBStateCouncils WHERE council _name = '$officer_groupCouncil'";
	 $dat = $db->query($sql);
	 $check2 =  $dat->first();
	if ($check2 < 0) {
		echo $show->showMessage('danger', 'Group council: '.$officer_groupCouncil.' is invalid!');
		return false;

	}

//add a check  for list of companys in kogi state
$sql = "SELECT * FROM registeredCompanys WHERE company_number = '$officer_companyCode' AND church = '$officer_home_church'";
$dats = $db->query($sql);
$check =  $dats->first();

	if (!$check) {
		echo $show->showMessage('danger', 'Company No.: '.$officer_companyCode.'  or Church: ' .$officer_home_church . ' is invalid!', 'warning');
		return false;

	}

	if (strlen($officer_password) < 10) {
		echo $show->showMessage('danger', 'Password must be at least 10 or more characters!', 'warning');
		return false;

	}elseif($officer_cpassword != $officer_password){
		echo $show->showMessage('danger', 'Password Mismatch!', 'warning');
		return false;
	}

	$email = $warhead->findEmail($officer_email);
	if ($email) {
		echo $show->showMessage('danger', 'E-Mail Already Exist!', 'warning');
		return false;
	}else{
		if (!filter_var($officer_email, FILTER_VALIDATE_EMAIL)) {
            echo $show->showMessage('danger', 'E-Mail is invalid!', 'warning');
		return false;
          }
	}

  $username = $warhead->findUsername($officer_username);
  if ($username) {
    echo $show->showMessage('danger', $officer_username.' Already Exist!', 'warning');
    return false;
  }else{
    if (strlen($_POST['officer_username']) > 15) {
     echo $show->showMessage('danger', 'Username should be maximum of 15 characters or less!', 'warning');
    return false;
    }
  }


	$hashed = password_hash($officer_password, PASSWORD_DEFAULT);

//and church's too
try {

	 $register = $warhead->create(array(
		 'officers_name' => $officer_name,
		 'officers_email' => $officer_email,
		 'officers_phone_no' => $officer_phone_no,
		 'officers_Lt_inCharge_name' => $officer_LtInCharge,
		 'officers_Capts_name' => $officer_captsName,
		 'officers_rank' => $officer_rank,
		 'officers_home_church' => $officer_home_church,
		 'officers_dob' => $officer_dob,
		 'officers_gender' => $officer_gender,
		 'officers_group_council' => $officer_groupCouncil,
		 'officers_password' => $hashed,
		 'officers_username' => $officer_username,
		 'officers_company_code' => $officer_companyCode,
		 'officers_permissions' => $permission,
		 'officers_lga' => $officer_lga,
		 'profile_pic' => 'default.png'
	 ));

	if ($register===true) {
		$sql = "SELECT * FROM officers WHERE officers_email = '$officer_email' LIMIT 1 ";
		$gd = $db->query($sql);
		$row =  $gd->first();
		$officer_id = $row->officer_id;

		$group = explode(' ',  $officer_groupCouncil);
		$take1 = $group[0];
		if (strlen($take1) > 5) {
			$take = $take1;
			$i = $take[0] . $take[1] . $take[2];

		}else{
			$take = $take1;
			$i = $take[0] . $take[1] . $take[3];
		}

	$council = strtoupper($i);
	$stateNo = 'BBN/KSC/'.$council.'/'.$officer_id;
		$update = "UPDATE officers SET stateNo = '$stateNo' WHERE officer_id = $officer_id ";
		$db->query($sql);

		$warhead->notification($newid, 'Admin', 'New Officer have registered');

			//Load Composer's autoloader
			    // require 'vendor/autoload.php';
		// $mail =  new PHPMailer(true);
	 //             //SMTP settings
		// 	     // $mail->SMTPDebug = 2;
	 //             $mail->isSMTP();
	 //             $mail->Host = "smtp.gmail.com";
	 //             $mail->SMTPAuth = true;
	 //             $mail->Username = "ucodetech.wordpress@gmail.com";
	 //             $mail->Password =  "echo@mike12@@";
	 //             $mail->Port = 587; //587 for tls
	 //             $mail->SMTPSecure = "tls";

	 //             //email settings
	 //             $mail->isHTML(true);
	 //             $mail->setFrom("ucodetech.wordpress@gmail.com");
	 //             $mail->addAddress($_POST['email']);
	 //             $mail->addReplyTo("ucodetech.wordpress@gmail.com");
	 //             $mail->Subject = "Access Key";
	 //             $mail->Body = "
	 //        <div style='width:80%; height:auto; padding:10px; margin:5px;'>
	 //      <p align='center'><img src='http://localhost/ucodeTuts/images/ucodeTut%20Logo.png' class='img-fluid' width='300' alt='Ucode Logo' align='center'>  </p>
	 //      <p style='color:blue; font-size: 20px; text-align: center; text-transform: uppercase;margin-top:0px'>Welcome on board</p>
	 //      <p  style='color: #000; font-size: 18px; text-transform:capitalize;margin:10px;  '>
	 //      Welcome Officer:  ".$officer_name.",
	 //      <hr>
	 //      <h4>Wlcome to Kogi State Council! Here is your ACcess Username: ".$stateNo." Note this key also serves as your State Idenitification No. Keep it safe. Password is the one you created during registration!</h4>
	 //      <p style='color: #fff; font-size:20px; text-align: center; text-transform: uppercase;'>
	 //      <a href='http//uzbgraphix.com.ng' style='color:#fff;'>Offical Site</a></p></div>
	 //      ";
	 //      $mail->send();

				echo 'success';



	}
} catch (\Exception $e) {
	echo $show->showMessage('danger', $e->getMessage(), 'warning');
 return false;
}



}



//Login Request
if (isset($_POST['action']) && $_POST['action'] == 'login') {

  $username = $show->test_input($_POST['username']);
  $password = $show->test_input($_POST['password']);
if (empty($username)) {
      echo  $show->showMessage('danger','Username is required!','warning');
      return false;
  }
if (empty($password)) {
      echo  $show->showMessage('danger','Password is required!','warning');
      return false;
}
        $IsLoggedIn = $warhead->login($username, $password);
        if ($IsLoggedIn) {
            echo 'success';
          }

};




//Forgot Request
if (isset($_POST['action']) && $_POST['action'] == 'forgot') {
    $email = $show->test_input($_POST['email']);

        $useremail = $warhead->findEmail($email);
        if ($useremail != null) {
          $selector = md5(microtime(uniqid()));
          $token = md5(microtime());
          $url = "http://localhost/bbnkogistatecouncil/officers/create-new-password.php?selector=".$selector.'&validator='.$token;

          $warhead->deleteToken($email);
          $hashed = password_hash($token, PASSWORD_DEFAULT);
          $done  =  $warhead->reset($email,$selector, $hashed);


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
               $mail->addAddress($email);
               $mail->addReplyTo("ucodetech.wordpress@gmail.com");
               $mail->Subject = "Password Reset Request";
               $mail->Body = "

        <p align='center'><img src='http://localhost/bbnkogistatecouncil/images/BBNSTATE.png' class='img-fluid' width='300' alt='LMS Logo' align='center'>  </p>
        <p style='color: #fff; font-size: 20px; text-align: center; text-transform: uppercase;margin-top:0px'> Password Reset</p>
        <p  style='color: #000; font-size: 18px; text-transform:capitalize;margin:10px;  '>
       You requested for a password reset here is the link below:<br><hr>
       <a  href='".$url."' style='margin-bottom: 0;font-weight: 400;text-align: center;white-space: nowrap;vertical-align: middle;-ms-touch-action: manipulation;touch-action: manipulation;cursor: pointer;background-image: none;border: 1px solid transparent;padding: 6px 12px;font-size: 14px;line-height: 1.42857143;border-radius: 4px;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;  color: #fff;background-color: #d9534f;border-color: #d43f3a; text-decoration: none; font-size: 20px;'>Reset Password</a>
       <hr>
       $url
       <br> Note: if you didnt requeset for this your self please ignore this mail! thanks</p>
       <h4>UcodeTuts</h4>
       <p style='color: #fff; font-size:20px; text-align: center; text-transform: uppercase;'>
       <a href='http//e-library.uzbgraphix.com.ng' style='color:#fff;'>Offical Site</a></p>
";
        $mail->send();
        echo $show->showMessage('success', 'We have sent the reset link to your email. check to verify!','check');
      } catch (\Exception $e) {
        echo $show->showMessage('danger', 'Something went wrong please try again!','warning');
    }


      }else{
        echo $show->showMessage('danger', 'The email does not exist in the database','warning');
        }

      }



 if(isset($_POST['action']) && $_POST['action'] == "update_time"){
 	  $id =  $warhead->data()->officer_id;
 	   $warhead->activity($id);
 	}
