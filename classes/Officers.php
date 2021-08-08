<?php

  class Officers extends DB {



  public function create($officer_name, $officer_email,$officer_phone_no, $officer_LtInCharge, $officer_captsName, $officer_rank, $officer_home_church, $officer_dob, $officer_gender, $officer_groupCouncil, $officer_password,$officer_username, $officer_companyCode, $permission, $officer_lga){
    $sql = "INSERT INTO `officers`  (officers_name, officers_email, officers_phone_no, officers_Lt_inCharge_name, officers_Capts_name, officers_rank, officers_home_church, officers_dob, officers_gender, officers_group_council, officers_password,officers_username, officers_company_code, officers_permissions, officers_lga) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $this->_pdo->prepare($sql);
    $stmt->execute([$officer_name, $officer_email,$officer_phone_no, $officer_LtInCharge, $officer_captsName, $officer_rank, $officer_home_church, $officer_dob, $officer_gender, $officer_groupCouncil, $officer_password,$officer_username, $officer_companyCode, $permission, $officer_lga]);
    return true;
  }




  public function login($stateNo){
    $sql = "SELECT * FROM  `officers` WHERE officers_username = ? AND deleted = 0";
    $stmt = $this->_pdo->prepare($sql);
    $stmt->execute([$stateNo]);
    $row = $stmt->fetch(PDO::FETCH_OBJ);
    return $row;

  }
public function activity($id){
    $sql = "UPDATE officers SET last_login = NOW() WHERE officer_id = ?";
    $stmt = $this->_pdo->prepare($sql);
    $stmt->execute([$id]);
    return true;
}
    //check input



public function reset($email,$selector, $hashed){
  $sql = "INSERT INTO pwdReset (email, pwdResetSelector, pwdResetToken,
pwdResetExpires) VALUES (?, ?, ?, DATE_ADD(NOW(), INTERVAL 15 MINUTE))";
$stmt = $this->_pdo->prepare($sql);
$stmt->execute([$email,$selector, $hashed]);
return true;
}



public function findUsername($username){
  $sql = "SELECT * FROM officers WHERE username = ? AND deleted = 0";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$username]);
  $result = $stmt->fetch(PDO::FETCH_OBJ);
  return $result;
  }
public function findEmail($email){
  $sql = "SELECT * FROM officers WHERE officers_email = ? AND deleted = 0";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$email]);
  $result = $stmt->fetch(PDO::FETCH_OBJ);
  return $result;
  }

public function findCurrentUser($id){
    $sql = "SELECT * FROM officers WHERE officer_id = ? AND deleted = 0";
    $stmt = $this->_pdo->prepare($sql);
    $stmt->execute([$id]);
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    return $result;
    }

public function deleteToken($email){
    $sql = "DELETE FROM pwdReset WHERE email = ? ";
    $stmt = $this->_pdo->prepare($sql);
    $stmt->execute([$email]);
    return true;
}

public function selectSelector($selector){

  $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector = ? AND pwdResetExpires > NOW()";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$selector]);
  $result = $stmt->fetch(PDO::FETCH_OBJ);
  return $result;
}

public function selectUser($email){
  $sql = "SELECT * FROM Officers WHERE email = ? AND deleted = 0";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$email]);
  $user = $stmt->fetch(PDO::FETCH_OBJ);
return $user;
}


public function updateUser($password,$email){
  $sql = "UPDATE Officers SET password = ? WHERE email = ? AND deleted = 0";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$password, $email]);
  return true;
}

public function add_new_note($officer_id, $title, $note){
  $sql = "INSERT INTO notes (officer_id, title, note) VALUES (?,?,?)";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$officer_id, $title, $note]);
  return true;
}
// Fetch all notes from user
public function getNotes($officer_id){
  $sql = "SELECT * FROM notes WHERE officer_id = ? AND deleted = 0";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$officer_id]);
  $results = $stmt->fetchAll(PDO::FETCH_OBJ);
  return $results;
}

//Select Note for Edit note
public function editNote($id){
  $sql = "SELECT * FROM notes WHERE id =?";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$id]);
  $result = $stmt->fetch(PDO::FETCH_OBJ);
  return $result;

}

//Update Note

public function updateNote($id, $title, $note){
  $sql = "UPDATE notes SET title = ?, note = ?, dateUpdated = NOW() WHERE id = ? ";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$title, $note, $id]);
  return true;

}

//Delete Note

public function deleteNote($id){
  $sql = "UPDATE notes SET deleted = 1 WHERE id = ? ";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$id]);
  return true;

}
//restore note
public function restoreNote($id){
  $sql = "UPDATE notes SET deleted = 0 WHERE id = ? ";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$id]);
  return true;

}
public function deleteNoteP($id){
  $sql = "DELETE FROM notes WHERE id = ? ";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$id]);
  return true;
}
public function getNoteDeleted($userid){
  $sql = "SELECT * FROM notes WHERE officer_id = ? AND deleted = 1";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$userid]);
  $results = $stmt->fetchAll(PDO::FETCH_OBJ);
  return $results;
}

public function add_test($file){
  $sql = "INSERT INTO imagearray (image) VALUES (?)";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$file]);
  return true;
}


public function selectNewUser($email){
  $sql = "SELECT * FROM officers WHERE officers_email = ?";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$email]);
  $user = $stmt->fetch(PDO::FETCH_OBJ);
return $user;
}
public function insertProfileId($newid){
  $sql = "INSERT INTO officers_profile (officers_id, status) VALUES (?, 1)";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$newid]);
  return true;
}

public function getProStatus($userid){
  $sql = "SELECT * FROM officers_profile WHERE officer_id = ?";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$userid]);
  $result = $stmt->fetch(PDO::FETCH_OBJ);
  return $result;
}
public function update_status($uid){
  $sql = "UPDATE officers_profile SET status = 0 WHERE officer_id = ? ";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$uid ]);
  return true;
}
public function updateProfile($uid){
  $sql = "UPDATE officers_profile SET status = 1 WHERE officer_id = ? ";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$uid]);
  return true;
}

public function update_user($full_name, $gender, $dob, $phone, $nickname, $id){
  $sql = "UPDATE officers SET full_name = ? , gender = ?, dob = ?, phone_number = ?, nickname = ?, authenticated = 0 WHERE id = ? ";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$full_name,$gender, $dob, $phone, $nickname, $id ]);
  return true;
}

//change Password
public function change_password($pass, $id){
  $sql = "UPDATE Officers SET password = ? WHERE id = ?";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$pass, $id]);
  return true;
}

public function updateVkey($token, $id){
  $sql = "INSERT INTO verifyEaml (token, officer_id) VALUES (?, ?) ";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$token, $id]);
  return true;
}

public function deleteVkey($id){
  $sql = "DELETE FROM verifyEaml WHERE officer_id = ? ";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$id]);
  return true;
}

public function selectToken($token, $userid){

  $sql = "SELECT * FROM verifyEaml WHERE token = ? AND officer_id = ?";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$token, $userid]);
  $result = $stmt->fetch(PDO::FETCH_OBJ);
  return $result;
}
public function verify_email($usid){
  $sql = "UPDATE officers SET verified = 1 WHERE id = ?";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$usid]);
  return true;
}

public function feedBack($subject, $feedback, $uid){
  $sql = "INSERT INTO feedback (officer_id,	subject	,feedback) VALUES (? ,?, ?) ";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$uid, $subject,$feedback]);
  return true;
}

//insert notification
public function notification($uid, $type, $message){
  $sql = "INSERT INTO notifications (officer_id, type, message) VALUES (?, ?, ?)";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$uid, $type, $message]);
  return true;
}


//FEtch notification from database
public function fetchNotifaction($userid){
  $sql = "SELECT * FROM notifications WHERE officer_id = ? AND type = 'user'";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$userid]);
  $result = $stmt->fetchAll(PDO::FETCH_OBJ);
  return $result;
}
public function fetchNotifactionCount($userid){
  $sql = "SELECT * FROM notifications WHERE officer_id = ? AND type = 'user'";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$userid]);
  $count = $stmt->rowCount();
  return $count;
}

//Delete notification
  public function removeNotification($id){
    $sql = "DELETE FROM notifications WHERE id = ? AND type = 'user'";
    $stmt = $this->_pdo->prepare($sql);
    $stmt->execute([$id]);
    return true;
  }

  // public function UpdatePermission($permission,$officer_id)
  // {
  //   $sql = "UPDATE Officers SET comp_permission = ? WHERE id = ?";
  //   $stmt = $this->_pdo->prepare($sql);
  //   $stmt->execute([$permission, $officer_id]);
  //   return true;
  // }

public function selectAssignment($val){
  $sql = "SELECT * FROM comp_ass WHERE deleted = $val ";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute();
  $download = $stmt->fetchAll(PDO::FETCH_OBJ);
  return $download;
}

public function updateAssignment($downs, $id)
{
    $sql = "UPDATE comp_ass SET downloads = ? WHERE id = ?";
    $stmt = $this->_pdo->prepare($sql);
    $stmt->execute([$downs, $id]);
    return true;
}

public function fetchDownloads($field,$table){
  $sql = "SELECT $field FROM $table";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute();
  $fet = $stmt->fetchAll(PDO::FETCH_OBJ);
  return $fet;
}

public function fetchDown($id){
  $sql = "SELECT downloads FROM comp_ass WHERE id = ? ";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$id]);
  $fet = $stmt->fetch(PDO::FETCH_OBJ);
  return $fet;
}

public function insertOfficers($userid, $full_name, $downloadid, $courseid)
{
  $sql = "INSERT INTO proDownCount (officer_id, user_name, download_id) VALUES (?, ?, ?, ?)";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$userid, $full_name, $downloadid, $courseid]);
  return true;
}

public function checkUserD($id, $courseid)
{
  $sql = "SELECT * FROM  proDownCount  WHERE officer_id = ? AND course_id = ?  ";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$id, $courseid]);
  $fet = $stmt->fetch(PDO::FETCH_OBJ);
  return $fet;
}

public function selectAssignmentID($name){
  $sql = "SELECT * FROM comp_ass WHERE source_code = ? ";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$name]);
  $fileID = $stmt->fetch(PDO::FETCH_OBJ);
  return $fileID;
}
//alert course mates on new  post
public function checkAlert($field,$table){
  $sql = "SELECT $field FROM $table WHERE id = 0";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute();
  $fet = $stmt->fetch(PDO::FETCH_OBJ);
  return $fet;
}

 public function checkEntered($table,$field, $input)
 {
  $sql = "SELECT * FROM $table WHERE $field = ? ";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$input]);
  $entered = $stmt->rowCount();
  return $entered;
 }

 public function addInfoData($controller_id,$church,$companyCode,$council,$officer_name,$office,$areaCouncil,$nameChaplain, $dbpath, $dbpath2)
 {
    $sql = "INSERT INTO DataFormInfo (controller_id, church, company, council, officer_name, office, AreaCouncil, Chaplian, signatureOfficer, signatureChaplain) VALUES (?,?,?,?,?,?,?,?,?,?) ";
       $stmt = $this->_pdo->prepare($sql);
       $stmt->execute([$controller_id,$church,$companyCode,$council,$officer_name,$office,$areaCouncil,$nameChaplain, $dbpath, $dbpath2]);
     return true;
  
 }


public function addDataForm($table, $field1,$field2,$field3,$field4, $field5, $field6, $field7,$field8, $input1, $input2, $input3, $input4, $input5, $input6, $input7, $input8)
{
   $sql = "INSERT INTO $table ($field1, $field2, $field3, $field4, $field5, $field6, $field7,$field8) VALUES (?,?,?,?,?,?,?,?)";
   $stmt = $this->_pdo->prepare($sql);
   $stmt->execute([$input1, $input2, $input3, $input4, $input5, $input6, $input7,$input8]);
   return true;
  
}

public function StateIDs($dataid, $stateid)
{
   $sql = "INSERT INTO AllStateIDs (dataForm_id, stateNo) VALUES (?,?)";
   $stmt = $this->_pdo->prepare($sql);
   $stmt->execute([$dataid, $stateid]);
   return true;
  
}

public function getDataForm($table, $field, $userid)
{
   $sql = "SELECT * FROM $table WHERE $field = ? ";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$userid]);
  $row = $stmt->fetchAll(PDO::FETCH_OBJ);
  return $row;
}


public function getById($table, $field, $id){
  $query = "SELECT * FROM $table WHERE $field = ?  ";
    $stmt = $this->_pdo->prepare($query);
    $stmt->execute([$id]);
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    return $result;
}

public function updateState($table, $field, $input1,  $input2)
{
  $update = "UPDATE $table SET $field = ? WHERE id = ?";
  $stmt = $this->_pdo->prepare($update);
  $stmt->execute([$input1, $input2]);
  return true;
}

public function checkStateID($table, $stateID)
{
  $sql = "SELECT * FROM $table WHERE stateNo = ? ";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$stateID]);
  $row = $stmt->fetch(PDO::FETCH_OBJ);
  return $row;
}
public function selectTable($table, $val)
{
  $query = "SELECT * FROM $table WHERE deleted = $val ";
    $stmt = $this->_pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $result;
}


public function totalCount($tablename, $id){
  $sql = "SELECT * FROM $tablename WHERE control_id = ?";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$id]);
  $count = $stmt->rowCount();
  return $count;
}

public function totalCount2($tablename, $groupcouncil, $company){
  $sql = "SELECT * FROM $tablename WHERE groupCouncil = ? AND company = ?";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$groupcouncil, $company]);
  $count = $stmt->rowCount();
  return $count;
}
public function updatePermission($councilsending)
{
   $sql = "UPDATE dataFormPermission SET status = 1 WHERE permitted_id = ?";
    $stmt = $this->_pdo->prepare($sql);
    $stmt->execute([$councilsending]);
    return true;
}
public function subMitReport($userCouncil)
{
    $sql = "UPDATE submittedDataForm SET submitted = 1 WHERE council = ? ";
    $stmt = $this->_pdo->prepare($sql);
    $stmt->execute([$userCouncil]);
    return true;
}

}
