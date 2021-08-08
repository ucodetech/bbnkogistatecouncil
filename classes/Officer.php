<?php
/**
 * user class
 */
class Officer
{
  private  $_db,
           $_officerData,
           $_sessionName,
           $_cookieName,
           $_isLoggedIn;

public function __construct($user = null)
  {
    $this->_db = Database::getInstance();
    $this->_sessionName = Config::get('session/session_officer');
    $this->_cookieName = Config::get('cookie/cookie_name');

    if (!$user) {
      if (Session::exists($this->_sessionName)) {
        $user = Session::get($this->_sessionName);

        if ($this->findUser($user)) {
          $this->_isLoggedIn = true;
        }else{
          //process logout
        }
      }
    }else{
     return  $this->findUser($user);
    }

  }

public function create($fields =  array())
{
    if (!$this->_db->insert('officers', $fields)) {
      // return 'erroring registering';
      throw new Exception("Error Processing Request", 1);


    }
}
//find user details for login
public function findUser($user = null)
    {
      if ($user) {
       $field = (is_numeric($user)) ? 'officer_id' : 'officers_username';
       $data = $this->_db->get('officers', array($field, '=', $user));
       if ($data->count()) {
         $this->_officerData = $data->first();
         return true;
       }
      }
      return false;
    }

//login
public function login($username = null, $password = null)
{
    $show = new Show();
  $user = $this->findUser($username);

  if ($user) {
      if ($this->data()->approved == 1){

        if (password_verify($password, $this->data()->officers_password)) {
           Session::put($this->_sessionName, $this->data()->officer_id);
           $id = $this->data()->officer_id;
            $sql = "UPDATE officers SET last_login = NOW() WHERE officer_id = '$id' ";
            $this->_db->query($sql);
            $this->notification($id, 'Admin', 'Officer Logged In');

          return true;
        }else{
          echo $show->showMessage('danger','Password Incorrect', 'warning');
          return false;
        }
      }else{
          echo $show->showMessage('danger','You have not been approved by the chapel please hold on!', 'warning');
          return false;
      }
  }else{
      echo $show->showMessage('danger','User not found', 'warning');
      return false;
  }



}

//return student data
//get id
public function getId()
{
  return $this->data()->officer_id;
}

//get passport
public function getPassport()
{
  return $this->data()->profile_pic;
}
//get department


//get verified
public function getVerified()
{
  return $this->data()->verified;
}


public function data()
{
  return $this->_officerData;
}


public function isLoggedIn(){
  return $this->_isLoggedIn;
}

public function logout()
{
  Session::delete($this->_sessionName);
}

public function createVerification($fields =  array())
{
    if (!$this->_db->insert('otp_table', $fields)) {
      throw new Exception("Error Processing Request email verify", 1);

    }
}
//find email
public function findEmail($email)
{
  $data = $this->_db->get('officers', array('officers_email', '=', $email));
  if ($data->count()) {
    $this->_officerData = $data->first();
    return $this->_officerData;
      }else{
    return false;
  }

}

//find phone number
public function findPhone($phoneNo)
{
  $data = $this->_db->get('officers', array('officers_phone_no', '=', $phoneNo));
  if ($data->count()) {
     $this->_officerData = $data->first();
    return true;
  }else{
    return false;
  }

}
public function updateStudent($username, $email)
{
  // $this->_db->update('superofficers', 'sudo_email', $email, array(
  //  'sudo_username' => $username
  // ));

  $sql = "UPDATE officers SET officers_username = '$username' WHERE officers_email = '$email' ";
  $this->_db->query($sql);
  return true;
}


// find username
public function findUsername($username){
  $data = $this->_db->get('officers', array('officers_username', '=', $username));
  if ($data->count()) {
   $this->_officerData = $data->first();
    return true;
  }else{
    return false;
  }

}

public function update_statu($profile, $userid)
    {
      $up = $this->_db->update('officers','officer_id', $userid, array(
        'profile_pic' => $profile
    ));
      if ($up) {
        return true;
      }else{
        return false;
      }
    }
//password reset
   // delete token
public function deleteToken($email)
    {
      $this->_db->delete('pwdReset', array('officers_email', '=', $email));
      return true;
    }









public function updateRecoreds($user_id, $field = array())
{
	if(!$this->_db->update('officers', 'id', $user_id, $field)){
         throw new Exception("Error Processing Request", 1);
         return false;

  }
}


public function update_status($uid){
	$this->_db->update('userprofile', 'user_id', $uid, array(
    	'status' => 0,
    ));

    return true;
}

public function updateStudentRecored($student_id, $field, $value)
{
	$this->_db->update('officers', 'id', $student_id, array(
    	$field => $value

    ));

    return true;
}

public function change_password($hashNewPass, $id)
{
	$this->_db->update('officers', 'officer_id', $id, array(
    	'officers_password' => $hashNewPass,

    ));

    return true;


}


public function deleteVkey($id){
	if($this->_db->delete('verifyEmail', array('user_id', '=', $id))){
		  return true;
		}else{
			return false;
		}
}

public function updateVkey($token, $id){
	$this->_db->insert('verifyEmail', array(
		'token' => $token,
		'user_id' => $id
	));
	return true;

}

public function updateProfileDelete($uid){
	$this->_db->update('userprofile', 'user_id', $uid, array(
		'status' => 1
	));
  return true;
}



public function selectToken($token, $userid){

  $sql = "SELECT * FROM verifyEmail WHERE token = '$token' AND user_id = '$userid'";
 $this->_db->query($sql);
 if ($this->_db->count()) {
 	return $this->_db->first();
 }else{
 	return false;
 }
}

public function verify_email($usid){
	$this->_db->update('officers', 'officer_id', $usid, array(
		'verified' => 1
	));
  return true;
}

public function selectSelector($selector){

  $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector = '$selector' AND pwdResetExpires > NOW()";
  $this->_db->query($sql);
 if ($this->_db->count()) {
   return $this->_db->first();
 }else{
  return false;
 }
}

// public function selectUser($email){
//   $sql = "SELECT * FROM officers WHERE email = ? AND deleted = 0";
//   $stmt = $this->_pdo->prepare($sql);
//   $stmt->execute([$email]);
//   $user = $stmt->fetch(PDO::FETCH_OBJ);
// return $user;
// }


public function updateUser($password,$email){
  $this->_db->update('officers', 'officers_email', $email, array(
    'officers_password' => $password
  ));
  return true;
}

public function updateHits()
{
  $id = 0;
  $hits = $hits+1;
  $this->_db->update('visitors', 'id', $id, array(
    'hits' => $hits
  ));
  return true;

}


public function subNews($email){
  $this->_db->insert('update_subscribers', array(
    'user_email' => $email
  ));
  return true;
}


public function getUser($cu)
{
  $this->_db->get('officers', array('officer_id', '=', $cu));
  if ($this->_db->count()) {
    return $this->_db->first();
  }else{
    return false;
  }
}

public function activity($id){
    $sql = "UPDATE officers SET last_login = NOW() WHERE officer_id = '$id'";
    $this->_db->query($sql);
    return true;
}


public function reset($email,$selector, $hashed){
  $sql = "INSERT INTO pwdReset (email, pwdResetSelector, pwdResetToken,
pwdResetExpires) VALUES ($email, $selector, $hashed, DATE_ADD(NOW(), INTERVAL 15 MINUTE))";
$this->_db->query($sql);
return true;
}

public function add_new_note($officer_id, $title, $note){
  $this->_db->insert('notes', array(
    'officer_id' => $officer_id,
    'title' => $title,
    'note' => $note
  ));
  return true;
}

// Fetch all notes from user
public function getNotes($officer_id){
  $note = $this->_db->get('notes' ,array('officer_id', '=', $officer_id));
  if ($note->count()) {
    return $note->results();
  }else{
    return false;
  }
}

//Select Note for Edit note
public function editNote($id){
  $note = $this->_db->get('notes' ,array('id', '=', $id));
  if ($note->count()) {
    return $note->first();
  }else{
    return false;
  }

}


//Delete Note

public function deleteNote($id){
  $sql = "UPDATE notes SET deleted = 1 WHERE id = '$id' ";
  $this->_db->query($sql);
  return true;

}

public function getNoteDeleted($userid){
  $sql = "SELECT * FROM notes WHERE officer_id ='$userid' AND deleted = 1";
  $note = $this->_db->query($sql);
  if ($note->count()) {
    return $note->results();
  }else{
    return false;
  }
}



//Update Note

public function updateNote($title, $note,$id){
  $sql = "UPDATE notes SET title ='$title', note ='$note', dateUpdated = NOW() WHERE id = '$id' ";
  $this->_db->query($sql);
  return true;

}

//restore note
public function restoreNote($id){
  $sql = "UPDATE notes SET deleted = 0 WHERE id = '$id' ";
  $this->_db->query($sql);
  return true;

}
public function deleteNoteP($id){
  $sql = "DELETE FROM notes WHERE id = '$id' ";
  $this->_db->query($sql);
  return true;
}


//insert notification
public function notification($uid, $type, $message){
  $sql = "INSERT INTO notifications (officer_id, type, message) VALUES ('$uid', '$type', '$message')";
  $this->_db->query($sql);
  return true;
}


//FEtch notification from database
public function fetchNotifaction($userid){
  $sql = "SELECT * FROM notifications WHERE officer_id = '$userid' AND type = 'user'";
  $note = $this->_db->query($sql);
  if ($note->count()) {
    return $note->results();
  }else{
    return false;
  }
}
public function fetchNotifactionCount($userid){
  $sql = "SELECT * FROM notifications WHERE officer_id = '$userid' AND type = 'user'";
  $note = $this->_db->query($sql);
  if ($note->count()) {
    return $note->count();
  }else{
    return false;
  }
}

//Delete notification
  public function removeNotification($id){
    $sql = "DELETE FROM notifications WHERE id = '$id' AND type = 'user'";
    $this->_db->query($sql);
    return true;
  }


  public function update_user($full_name, $gender, $dob, $phone, $nickname, $id){
    $sql = "UPDATE officers SET full_name = '$full_name' , gender = '$gender', dob = '$dob', phone_number = '$phone', nickname = '$nickname', authenticated = 0 WHERE officer_id = '$id' ";
    $this->_db->query($sql);
    return true;
  }


  public function selectNewUser($email){
    $sql = "SELECT * FROM officers WHERE officers_email = '$email'";
    $note = $this->_db->query($sql);
    if ($note->count()) {
      return $note->first();
    }else{
      return false;
    }
  }

   public function checkEntered($table,$field, $input)
   {
    $sql = "SELECT * FROM $table WHERE $field = '$input' ";
    $note = $this->_db->query($sql);
    if ($note->count()) {
      return $note->count();
    }else{
      return false;
    }
   }

   public function addInfoData($controller_id,$church,$companyCode,$council,$officer_name,$office,$areaCouncil,$nameChaplain, $dbpath, $dbpath2)
   {
         $this->_db->insert('DataFormInfo', array(
           'controller_id' => $controller_id,
           'church' => $church,
           'company' => $companyCode,
           'council' => $council,
           'officer_name' => $officer_name,
           'office' => $office,
           'AreaCouncil' => $areaCouncil,
           'Chaplian' => $nameChaplain,
           'signatureOfficer' => $dbpath,
           'signatureChaplain' => $dbpath2
         ));
       return true;

   }


  public function addDataForm($table, $fields = array())
  {
     $this->_db->insert($table, $fields);

  }

  public function StateIDs($dataid, $stateid)
  {
     $this->_db->insert('AllStateIDs', array(
       'dataForm_id' => $dataid,
       'stateNo' => $stateid
     ));
   return true;
  }

  public function getDataForm($table, $field, $userid)
  {
     $sql = "SELECT * FROM $table WHERE $field = '$userid' ";
     $note = $this->_db->query($sql);
     if ($note->count()) {
       return $note->results();
     }else{
       return false;
     }
  }


  public function getById($table, $field, $id){
    $query = "SELECT * FROM $table WHERE $field = '$id'  ";
    $note = $this->_db->query($query);
    if ($note->count()) {
      return $note->first();
    }else{
      return false;
    }
  }

  public function updateState($table, $field, $input1,  $input2)
  {
    $update = "UPDATE $table SET $field = '$input1' WHERE id = '$input2'";
    $this->_db->query($update);
    return true;
  }

  public function checkStateID($table, $stateID)
  {
    $sql = "SELECT * FROM $table WHERE stateNo = '$stateID' ";
    $note = $this->_db->query($sql);
    if ($note->count()) {
      return $note->first();
    }else{
      return false;
    }
  }
  public function selectTable($table, $val)
  {
    $query = "SELECT * FROM $table WHERE deleted = $val ";
    $note = $this->_db->query($sql);
    if ($note->count()) {
      return $note->results();
    }else{
      return false;
    }
  }


  public function totalCount($tablename, $id){
    $sql = "SELECT * FROM $tablename WHERE control_id = '$id'";
    $note = $this->_db->query($sql);
    if ($note->count()) {
      return $note->count();
    }else{
      return false;
    }
  }

  public function totalCount2($tablename, $groupcouncil, $company){
    $sql = "SELECT * FROM $tablename WHERE groupCouncil = '$groupcouncil' AND company = '$company'";
    $note = $this->_db->query($sql);
    if ($note->count()) {
      return $note->count();
    }else{
      return false;
    }
  }
  public function updatePermission($councilsending)
  {
     $sql = "UPDATE dataFormPermission SET status = 1 WHERE permitted_id = '$councilesending'";
     $this->_db->query($sql);
      return true;
  }
  public function subMitReport($userCouncil)
  {
      $sql = "UPDATE submittedDataForm SET submitted = 1 WHERE council = '$userCouncil' ";
      $this->_db->query($sql);
      return true;
  }



//end of class
}
