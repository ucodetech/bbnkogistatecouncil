<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class CadetConsole
{
    private $_db,
        $_data,
        $_sessionName,
        $_cookieName,
        $_isLoggedIn;

  function __construct($admin = null)
  {
    $this->_db =  Database::getInstance();
    $this->_sessionName = Config::get('session/session_admin');
    $this->_cookieName = Config::get('remember/cookie_name');


    if (!$admin) {
      if (Session::exists($this->_sessionName)) {
        $admin = Session::get($this->_sessionName);
        if ($this->findAdmin($admin)) {
          $this->_isLoggedIn = true;
        }

      }
    }else{
      $this->findAdmin($admin);
    }

  }



public function findAdmin($admin = null)
{
  if ($admin) {

  $field = (is_numeric($admin))? 'command_id' : 'commander_accessName';
  $data = $this->_db->get('commanders', array($field, '=', $admin));
  if ($data->count()) {
    $this->_data = $data->first();
    return true;
  }
}
return false;
}

public function login($supername = null, $password = null)
{
  $show = new Show();
  $admin = $this->findAdmin($supername);
  if ($admin) {
    $adminPassword = $this->data()->commander_password;
    $adminEamil = $this->data()->commander_email;
    $adminId = $this->data()->command_id;
    $fullname = $this->getAdminFullname();
    if (password_verify($password, $adminPassword)) {


   //      $rndno=rand(100000, 999999);//OTP generate
   //      $token = "OTP NUMBER: "."<h2>".$rndno."</h2>";

//Load Composer's autoloader
    // require 'vendor/autoload.php';
   //  $mail =  new PHPMailer(true);

    // try{

   //             // //SMTP settings
   //             // $mail->isSMTP();
   //             // $mail->Host = "mail.ucodetuts.com.ng";
   //             // $mail->SMTPAuth = true;
   //             // $mail->Username = "noreply@ucodetuts.com.ng";
   //             // $mail->Password =  "warmechine500@#**@@";
   //             // $mail->SMTPSecure = "ssl";
   //             // $mail->Port = 465; //587 for tls
    //      $mail->isSMTP();
   //            $mail->Host = "smtp.gmail.com";
   //            $mail->SMTPAuth = true;
   //            $mail->Username = "ucodetut@gmail.com";
   //            $mail->Password =  "warmechine500@##***";
   //            $mail->SMTPSecure = "tls";
   //            $mail->Port = 587; // for tls

   //             //email settings
   //             $mail->isHTML(true);
   //             $mail->setFrom("ucodetut@gmail.com", "Library Offence Doc.");
   //             $mail->addAddress($this->data()->commander_email);
   //             // $mail->addReplyTo("ucodetut@gmail.com", "Library Offence Doc.");
   //             $mail->Subject = 'Device Verification';
   //             $mail->Body = "
   //          <div style='width:80%; height:auto; padding:10px; margin:10px'>

   //      <p style='color: #fff; font-size: 20px; text-align: center; text-transform: uppercase;margin-top:0px'>One Time Password Verification<br></p>
   //      <p>Hey $fullname! <br><br>

   //      A sign in attempt requires further verification because we did not recognize your device. To complete the sign in, enter the verification code on the unrecognized device.

   //     <br><hr>
   //      $token <br><hr>

   //      If you did not attempt to sign in to your account, your password may be compromised. Visit https://localhost/libraryoffencedoc/lod_Admin/admin-login to create a new, strong password for your Library Offence Doc account.</p>
   //              <hr>

   //     </div>
   //      ";
   //      if($mail->send())
   //       $email =  $this->data()->commander_email;
   //       $sql = "INSERT INTO verifyAdmin (commander_email, token) VALUES ('$email','$rndno')";
   //        $this->_db->query($sql);

   //       Session::put($this->_sessionName, $this->data()->command_id);
   //       $sql = "UPDATE commanders SET last_login = NOW() WHERE commander_email = '$email' ";
   //        $this->_db->query($sql);

   //       return true;

   //      } catch (\Exception $e) {
   //      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
   //      }

       Session::put($this->_sessionName, $this->data()->command_id);
        $sql = "UPDATE commanders SET last_login = NOW() WHERE commander_email = '$adminEamil' ";
          $this->_db->query($sql);
    return true;
  }else{
      echo $show->showMessage('danger','Incorrect Password Retype!', 'warning');
      return false;
    }


  }else{
        echo $show->showMessage('danger','Admin not found!', 'warning');
        return false;
  }
}

    /**
     * @return bool
     */
    public function isIsLoggedIn()
    {
        return $this->_isLoggedIn;
    }

public function logout()
{
  Session::delete($this->_sessionName);

}

public function data()
{
  return $this->_data;
}

public function getAdminEmail()
{
  return $this->data()->commander_email;
}
public function getAdminId()
{
  return $this->data()->command_id;
}
public function getAdminFullname()
{
  return $this->data()->commander_name;
}
public function getAdminPhoneNo()
{
  return $this->data()->commander_phone_no;
}
public function getAdminPermission()
{
  return $this->data()->commander_permissions;
}

public function create($field = array())
{
  if (!$this->_db->insert('commanders',$field)) {
    throw new Exception("Error Processing Request", 1);

  }
}


public function findEmail($email)
{
  $check = $this->_db->get('commanders', array('commander_email', '=', $email));
  if ($check->count()) {
    return $check->first();
  }else{
    return false;
  }

}

public function CadetAuth($commanderAccessName){
    $check = $this->_db->get('commanders', array('commander_accessName', '=', $commanderAccessName));
  if ($check->count()) {
    return $check->first();
    }else{
      return false;
    }

  }


public function findPhone($phoneNo)
{
  $check = $this->_db->get('commanders', array('commander_phone_no', '=', $phoneNo));
  if ($check->count()) {
   return $check->first();
  }else{
    return false;
  }

}


public function updateAdmin($username, $email)
{
  // $this->_db->update('commanders', 'commander_email', $email, array(
  //  'sudo_username' => $username
  // ));

  $sql = "UPDATE commanders SET commander_accessName = '$username' WHERE commander_email = '$email' ";
  $this->_db->query($sql);
  return true;
}

public function updateWar($id)
    {

        $sql = "UPDATE commanders SET last_login = NOW() WHERE command_id = '$id' ";
        $this->_db->query($sql);
        return true;
    }

public function insertProfileId($adminId)
{
  $this->_db->insert('commander_profile', array(
    'command_id' => $adminId,
    'status' => '1'
  ));
  return true;
}

    public function update_warhead($id, $fields = array())
    {
        if (!$this->_db->update('commanders', 'command_id',$id, $fields)) {
          throw new \Exception("Error Processing Request", 1);
        }

    }
  public function loggedAdmin(){
        $sql = "SELECT * FROM commanders WHERE last_login > DATE_SUB(NOW(), INTERVAL 5 SECOND)";
        $data = $this->_db->query($sql);
        if ($data->count()) {
            return $data->results();
        }else{
            return false;
        }
    }
    public function loggedAdminSingle($adminid){
          $sql = "SELECT * FROM commanders WHERE command_id = '$adminid' AND last_login > DATE_SUB(NOW(), INTERVAL 5 SECOND)";
          $data = $this->_db->query($sql);
          if ($data->count()) {
              return $data->first();
          }else{
              return false;
          }
      }
//change password
public function change_access_key($hashNewPass, $admin_id)
  {
    $this->_db->update('commanders', 'command_id', $admin_id, array(
              'commander_password' => $hashNewPass

          ));

          return true;
  }



public function virusMonitorHead($commanderid, $action){
  $sql = "INSERT INTO commander_monitor (lieutenant_id, action) VALUES ('$commanderid','$action')";
 $this->_db->query($sql);
  return true;
}







}//end of class
