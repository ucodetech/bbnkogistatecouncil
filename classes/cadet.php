<?php 
  class CadetConsole extends DB {

  public function create($commander_name ,$commander_email ,$commander_phone_no ,$commander_permissions ,$commander_accessName ,$commander_password){
    $sql = "INSERT INTO `commanders`  (commander_name ,commander_email ,commander_phone_no ,commander_permissions ,commander_accessName ,commander_password) VALUES (?,?,?,?,?,?)";
    $stmt = $this->_pdo->prepare($sql);
    $stmt->execute([$commander_name ,$commander_email ,$commander_phone_no ,$commander_permissions ,$commander_accessName ,$commander_password]);
    return true;
  }



  public function CadetAuth($commanderAccessName){
    $sql = "SELECT * FROM  `commanders` WHERE 	commander_accessName = ? AND deleted = 0 ";
    $stmt = $this->_pdo->prepare($sql);
    $stmt->execute([$commanderAccessName]);
    $row = $stmt->fetch(PDO::FETCH_OBJ);
    return $row;

  }

public function warheadAuth($authID){
  $sql = "SELECT * FROM commanders WHERE commander_id = ? ";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$authID]);
  $auth = $stmt->fetch(PDO::FETCH_OBJ);
  return $auth;
}

public function totalCount($tablename){
  $sql = "SELECT * FROM $tablename";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute();
  $count = $stmt->rowCount();
  return $count;
}

public function totalCounts(){
$sql = "SELECT * FROM officers";
$stmt = $this->_pdo->prepare($sql);
$stmt->execute();
$count = $stmt->rowCount();
return $count;
}

//Get gender percentage
public function genderPer(){
  $sql = "SELECT officers_gender, COUNT(*) AS number FROM officers WHERE officers_gender != '' GROUP BY officers_gender ";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_OBJ);
  return $result;
}
// verified and unverified percenta
public function verifiedPer(){
  $sql = "SELECT verified, COUNT(*) AS number FROM officers  GROUP BY verified ";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_OBJ);
  return $result;
}
//hits
public function hits(){
  $sql = " SELECT hits FROM websiteHits";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute();
  $count = $stmt->fetch(PDO::FETCH_OBJ);
  return $count;
}
public function verified_officers_email($status){
  $sql = "SELECT * FROM officers WHERE verified = ?";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$status]);
  $count = $stmt->rowCount();
  return $count;
}

public function findEmail($email){
  $sql = "SELECT * FROM commanders WHERE commander_email = ? AND deleted = 0";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$email]);
  $result = $stmt->fetch(PDO::FETCH_OBJ);
  return $result;
  }

public function virusHead($commanderid){
    $sql = "SELECT * FROM commanders WHERE command_id = ? AND deleted = 0";
    $stmt = $this->_pdo->prepare($sql);
    $stmt->execute([$commanderid]);
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

public function selectUsers($val){
  $sql = "SELECT * FROM officers WHERE  deleted = $val";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute();
  $user = $stmt->fetchAll(PDO::FETCH_OBJ);
return $user;
}


public function updateUser($password,$email){
  $sql = "UPDATE commanders SET commander_password = ? WHERE commander_email = ? AND deleted = 0";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$password, $email]);
  return true;
}

public function getLga($offlga)
{
  $sql = "SELECT * FROM allLGAInNig WHERE lga = ? AND deleted = 0";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$offlga]);
  $lga = $stmt->fetch(PDO::FETCH_OBJ);
  return $lga;
}

public function add_new_note($user_id, $title, $note){
  $sql = "INSERT INTO notes (user_id, title, note) VALUES (?,?,?)";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$user_id, $title, $note]);
  return true;
}
// Fetch all notes from user
public function getNotes(){
  $sql = "SELECT notes.id, notes.title, notes.note, notes.dateCreated, notes.dateUpdated, officers.officers_name, officers.officers_email FROM notes INNER JOIN officers ON notes.officer_id = officers.officer_id ";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute();
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



//Delete Note

public function noteAction($id, $val){
  $sql = "UPDATE notes SET deleted = $val WHERE id = ? ";
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

public function getNoteDeleted(){
  $sql = "SELECT * FROM notes WHERE  deleted = 1";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute();
  $results = $stmt->fetchAll(PDO::FETCH_OBJ);
  return $results;
}



public function selectNewUser($email){
  $sql = "SELECT * FROM officers WHERE email = ?";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$email]);
  $user = $stmt->fetch(PDO::FETCH_OBJ);
return $user;
}
public function insertProfileId($newid){
  $sql = "INSERT INTO commander_profile (commander_id, status) VALUES (?, 1)";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$newid]);
  return true;
}

public function getWarStatus($commandid){
  $sql = "SELECT * FROM commander_profile WHERE commander_id = ?";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$commandid]);
  $result = $stmt->fetch(PDO::FETCH_OBJ);
  return $result;
}
public function update_war($commanderid){
  $sql = "UPDATE commander_profile SET status = 0 WHERE commander_id = ? ";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$commanderid ]);
  return true;
}
public function update_warhead($full_name, $phone,$church, $id){
  $sql = "UPDATE commanders SET commander_name = ? , commander_phone_number = ?, commander_home_church = ? WHERE command_id = ? ";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$full_name, $phone, $church, $id ]);
  return true;
}

//change Password
public function change_access_key($authkey, $commanderid){
  $sql = "UPDATE commanders SET commander_password = ? WHERE command_id = ?";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$authkey, $commanderid]);
  return true;
}

public function updateVkey($token, $id){
  $sql = "INSERT INTO verifyEaml (token, user_id) VALUES (?, ?) ";
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


public function verify_email($officerid){
  $sql = "UPDATE officers SET verified = 1 WHERE officer_id = ?";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$officerid]);
  return true;
}

public function feedBack($subject, $feedback, $officerid){
  $sql = "INSERT INTO feedback (officer_id,	subject	,feedback) VALUES (? ,?, ?) ";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$officerid, $subject,$feedback]);
  return true;
}

//insert notification
public function virusMonitorHead($commanderid, $action){
  $sql = "INSERT INTO commander_monitor (lieutenant_id, action) VALUES (?, ?)";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$commanderid, $action]);
  return true;
}


public function loggedUsers(){
  $sql = "SELECT * FROM officers WHERE last_login > DATE_SUB(NOW(), INTERVAL 5 SECOND)";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute();
  $results = $stmt->fetchAll(PDO::FETCH_OBJ);
  return $results;
}
  public function getImg($imgid){
      $sql = "SELECT * FROM officers_profile WHERE officer_id = ? ";
      $stmt = $this->_pdo->prepare($sql);
      $stmt->execute([$imgid]);
      $imgs = $stmt->fetch(PDO::FETCH_OBJ);
      return $imgs;
  }



  public function loggedAdmin(){
    $sql = "SELECT * FROM commanders WHERE last_login > DATE_SUB(NOW(), INTERVAL 5 SECOND)";
    $stmt = $this->_pdo->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $results;
  }
    public function getImgCommander($commanderid){
        $sql = "SELECT * FROM commander_profile WHERE commander_id = ? ";
        $stmt = $this->_pdo->prepare($sql);
        $stmt->execute([$commanderid]);
        $imgs = $stmt->fetch(PDO::FETCH_OBJ);
        return $imgs;
    }

  public function updateWar($inid){
      $sql = "UPDATE commanders SET last_login = NOW() WHERE command_id = ?";
      $stmt = $this->_pdo->prepare($sql);
      $stmt->execute([$inid]);
      return true;
  }


//Get users by id

public function fetchUserDetail($id, $val){
  $sql = "SELECT * FROM officers WHERE officer_id = ? AND deleted = $val";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$id]);
  $result = $stmt->fetch(PDO::FETCH_OBJ);
  return $result;
}

//Delete USer

public function userAction($id, $val){
  $sql = "UPDATE officers SET deleted = $val WHERE officer_id = ? ";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$id]);
  return true;

}

//delete user permenatly
public function deleteUserP($id){
  $sql = "DELETE FROM officers WHERE officer_id = ? ";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$id]);
  return true;
}

// Fetch all notes from user
public function getFeedback(){
  $sql = "SELECT feedback.id, feedback.subject, feedback.feedback, feedback.dateSent, feedback.replied,feedback.officer_id, officers.officers_name, officers.officers_email FROM feedback INNER JOIN officers ON feedback.officer_id = officers.officer_id WHERE feedback.deleted = 0";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute();
  $results = $stmt->fetchAll(PDO::FETCH_OBJ);
  return $results;
}

public function feedDetails($id){
  $sql = "SELECT * FROM feedback WHERE id = ? ";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$id]);
  $result = $stmt->fetch(PDO::FETCH_OBJ);
  return $result;

}

//Reply to user feedback
public function replyFeedback($officerid, $message){
  $sql = "INSERT INTO notifications (officer_id, type, message) VALUES (?, 'officer', ?)";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$userid, $message]);
  return true;
}
public function updateFeedbackReplied($feedid){
  $sql = "UPDATE  feedback SET replied = 1 WHERE id = ? ";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$feedid]);
  return true;
}

//FEtch notification from database
public function fetchNotifaction(){
  $sql = "SELECT * FROM notifications ORDER BY id DESC";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_OBJ);
  return $result;
}
public function fetchNotifactionCount(){
  $sql = "SELECT * FROM notifications";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute();
  $count = $stmt->rowCount();
  return $count;
}

//Delete notification
  public function removeNotification($id){
    $sql = "DELETE FROM notifications WHERE id = ? ";
    $stmt = $this->_pdo->prepare($sql);
    $stmt->execute([$id]);
    return true;
  }

  public function feedAction($id){
    $sql = "DELETE FROM feedback WHERE id = ? ";
    $stmt = $this->_pdo->prepare($sql);
    $stmt->execute([$id]);
    return true;

  }

public function exportAllTables($table, $val){
  $sql = "SELECT * FROM $table ORDER BY $val ";
  $stmt =  $this->_pdo->prepare($sql);
  $stmt->execute();
  $results = $stmt->fetchAll(PDO::FETCH_OBJ);
  return $results;
}




public function subNews($email){
  $sql = "INSERT INTO `newsSubscribers` (subscriber_email) VALUES (?) ";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$email]);
  return true;
}

public function selectSubscribers(){
    $sql = "SELECT * FROM `newsSubscribers`";
    $stmt = $this->_pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $result;
}





public function likeSys($pid)
{
  $sql = "INSERT INTO likeSystem (post_id) VALUES (?)";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$pid]);
  return true;
}


public function checkLike($postid)
{
  $sql = "SELECT officer_id  FROM likeSystem WHERE post_id = ?";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$postid]);
  $result = $stmt->fetch(PDO::FETCH_OBJ);
  return $result;
}

//add executives
public function addExectives($executive_name,  $executive_description, $dbpath,   $executive_office)
{
  $sql = "INSERT INTO BBStateExecutives (exective_name,exective_description, exective_image, executive_office	) VALUES (?, ?, ?, ?)";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$executive_name, $executive_description, $dbpath,   $executive_office]);
  return true;
}

public function checkExeutive($executive_office)
{
  $sql = "SELECT * FROM BBCadetExecutives WHERE executive_office = ? AND deleted = 0";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$executive_office]);
  $result = $stmt->fetch(PDO::FETCH_OBJ);
  return $result;

}

public function getById($table, $field, $id){
  $query = "SELECT * FROM $table WHERE $field = ?  ";
    $stmt = $this->_pdo->prepare($query);
    $stmt->execute([$id]);
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    return $result;
}

public function updateCommanders($commander_name ,$commander_email,$commander_phone_no,$commander_home_church,$commander_permission, $commander_id)
{
  $sql = "UPDATE commanders SET  commander_name = ?, commander_email = ?, commander_phone_no = ?, commander_home_church = ?, commmander_permissions = ? WHERE command_id = ?";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$commander_name ,$commander_email,$commander_phone_no,$commander_home_church,$commander_permission, $commander_id]);
  return true;
}

public function insertBBHistory($table, $field1, $field2, $input1, $input2)
{
  $sql = "INSERT INTO $table ($field1, $field2) VALUES (?, ?)";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$input1, $input2]);
  return true;
}

public function selectHistory($table)
{
  $query = "SELECT * FROM $table";
    $stmt = $this->_pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
public function updateHistory($table, $title, $description, $editid)
{
  $update = "UPDATE $table SET bb_title = ?, bb_description = ? WHERE id = ? ";
  $stmt = $this->_pdo->prepare($update);
  $stmt->execute([$title, $description, $editid]);
  return true;
}

public function insertBBNHistory($title, $description,$formation_creation
,$other_appoint,$secretariat  ,$events,$generalInfo)
{
  $sql = "INSERT INTO BBStateHistory (bb_title, bb_description, formation_creation, other_apointees_reps,secretariat , events, general_info) VALUES (?, ?, ?, ?, ?, ?, ?)";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$title, $description,$formation_creation
  ,$other_appoint,$secretariat  ,$events, $generalInfo]);
  return true;
}
public function updateKSC($title, $description,$formation_creation ,$other_appoint,$secretariat ,$events,$generalInfo,$editid)
{
  $sql = "UPDATE BBStateHistory SET bb_title = ?, bb_description = ?, formation_creation = ? , other_apointees_reps = ?,secretariat = ?, events = ? , general_info = ? WHERE id = ? ";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$title, $description,$formation_creation ,$other_appoint,$secretariat ,$events,$generalInfo,$editid]);
  return true;
}

public function insertTrainingOfficers($introduction,$tofficer_name, $tofficer_qua)
{
  $sql = "INSERT INTO `BBStateCouncilsTofficers` (introduction, officer_name, officer_qualification) VALUES (?, ?, ?)";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$introduction,$tofficer_name, $tofficer_qua]);
  return true;
}

//group councils
public function insertGroupCouncils($introduction,$council_name)
{
  $sql = "INSERT INTO `BBStateCouncils` (introduction, council_name) VALUES (?, ?)";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$introduction,$council_name]);
  return true;
}


public function selectTable($table, $val)
{
  $query = "SELECT * FROM $table WHERE deleted = $val";
    $stmt = $this->_pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $result;
}
public function selectTable2($table, $val, $submitted)
{
  $query = "SELECT * FROM $table WHERE deleted = $val AND submitted = $submitted ORDER by council";
    $stmt = $this->_pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

public function selectTable3($table, $val)
{
  $query = "SELECT * FROM $table WHERE deleted = $val ORDER BY company_number ASC";
    $stmt = $this->_pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

public function updateTrainingOfficers($introduction,  $tofficer_name, $tofficer_qua, $editid)
{
  $sql = "UPDATE BBStateCouncilsTofficers SET introduction = ?, officer_name = ?, officer_qualification = ? WHERE id = ? ";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$introduction,  $tofficer_name, $tofficer_qua, $editid]);
  return true;
}

public function updateGroupCouncil($introduction,  $council_name, $editid)
{
  $sql = "UPDATE BBStateCouncils SET introduction = ?, council_name = ? WHERE id = ? ";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$introduction, $council_name, $editid]);
  return true;
}

public function checkTable($name)
{
  $query = "SELECT * FROM BBStateCouncils WHERE council_name = ? ";
    $stmt = $this->_pdo->prepare($query);
    $stmt->execute([$name]);
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    return $result;
}

public function trashUpdate($table,$val, $del_id)
{
  $sql = "UPDATE $table SET deleted =  $val WHERE id = ? ";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$del_id]);
  return true;
}
public function slugCheck($table, $slug_url){
  $sql = "SELECT * FROM $table WHERE slug_url LIKE '%$slug_url%' ";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute();
  $slug = $stmt->fetchAll(PDO::FETCH_OBJ);
  return $slug;
}

public function addGallery($gallery_title,$gallery_date_event,$gallery_event_location,$gallery_description, $dbpath)
{
  $sql = "INSERT INTO `BBStateGallery` (gall_title, gall_eventDate,	gall_event_location, gall_description , gall_image) VALUES (?, ?, ?, ?, ?)";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$gallery_title,$gallery_date_event,$gallery_event_location,$gallery_description, $dbpath]);
  return true;
}


public function addSlider($Slider_title,$Slider_description, $dbpath)
{
  $sql = "INSERT INTO `carousel_item` (carousel_event, carousel_description , carousel_image) VALUES (?, ?, ?)";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$Slider_title,$Slider_description, $dbpath]);
  return true;
}

public function addOfficial($table,$field1, $field2,$field3,$field4, $input1,$input2, $input3, $input4)
{
  $sql = "INSERT INTO $table ($field1, $field2,$field3,$field4) VALUES (?, ?, ?, ?)";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$input1,$input2, $input3, $input4]);
  return true;
}

public function addStateExecutives($table,$field1, $field2,$field3, $input1,$input2, $input3)
{
  $sql = "INSERT INTO $table ($field1, $field2,$field3) VALUES (?, ?, ?)";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$input1,$input2, $input3]);
  return true;
}

public function addPPP($table,$field, $input)
{
  $sql = "INSERT INTO $table ($field) VALUES (?)";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$input]);
  return true;
}

public function insertLga($lga)
{
 $sql = "INSERT INTO allLGAInNig (lga) VALUES (?)";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$lga]);
  return true;
}

//FEtch notification from database
public function fetchReqestNotifaction(){
  $sql = "SELECT * FROM dataFormPermission WHERE approved = 'negative' ORDER BY id DESC";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_OBJ);
  return $result;
}
public function fetchReqestNotifactionCount(){
  $sql = "SELECT * FROM dataFormPermission WHERE approved = 'negative'";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute();
  $count = $stmt->rowCount();
  return $count;
}

public function selectRequestedLt($officerid){

  $sql = "SELECT * FROM officers WHERE officer_id = ?";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$officerid]);
  $result = $stmt->fetch(PDO::FETCH_OBJ);
  return $result;
}

public function selectUserNote($officerid){

  $sql = "SELECT * FROM officers WHERE officer_id = ? ";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$officerid]);
  $result = $stmt->fetch(PDO::FETCH_OBJ);
  return $result;
}

public function insertCompany($company, $church)
{
   $sql = "INSERT INTO registeredCompanys (company_number, church) VALUES (?,?)";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$company, $church]);
  return true;
}
public function selectCompany($company)
{
   $sql = "SELECT * FROM registeredCompanys WHERE company_number = ? ";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$company]);
  $result = $stmt->fetch(PDO::FETCH_OBJ);
  return $result;
}

public function selectCompany2($company, $editid)
{
   $sql = "SELECT * FROM registeredCompanys WHERE company_number = ? AND id != ?";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$company, $editid]);
  $result = $stmt->fetch(PDO::FETCH_OBJ);
  return $result;
}

public function updateCompany($company,$church,$editid)
{

  $sql = "UPDATE registeredCompanys SET company_number =  ?, church = ? WHERE id = ? ";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$company,$church,$editid]);
  return true;
}

public function awardUpload($award_name,$dbpath, $award_event_title, $award_description)
{
  $sql = "INSERT INTO awardWinners (award_name, award_images, award_event_title, award_event_description) VALUES (?, ?, ?, ?)";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$award_name,  $dbpath , $award_event_title, $award_description]);
  return true;
}

public function awardUpdate($award_name, $dbpath, $award_event_title, $award_description,  $editid)
{
  $sql = "UPDATE awardWinners SET award_name = ?, award_images = ?, award_event_title = ?, award_event_description = ? WHERE id = ? ";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$award_name, $dbpath, $award_event_title, $award_description, $editid]);
  return true;
}


  public function addNews($author, $news_title, $news_description,$slug_url)
  {
  $sql = "INSERT INTO news (author, title, description, slug_url) VALUES (?, ?, ?, ?)";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$author,$news_title, $news_description,$slug_url]);
  return true;
  }

//Update tutorials featured image
public function featuredAction($dbpath, $news_id){
    $sql = "UPDATE news SET featuredImage = ? WHERE id =  ?";
    $stmt = $this->_pdo->prepare($sql);
    $stmt->execute([$dbpath, $news_id]);
    return true;
}

//Update tutorials table and source code table
public function newsAction($field, $val, $id){
$sql = "UPDATE news SET $field = $val WHERE id =  ?";
$stmt = $this->_pdo->prepare($sql);
$stmt->execute([$id]);
return true;
}
public function newsimageAction($val, $id){
$sql = "UPDATE newsImages SET deleted = $val WHERE news_id =  ?";
$stmt = $this->_pdo->prepare($sql);
$stmt->execute([$id]);
return true;
}


public function getByIdNews($table, $field, $id, $val){
  $query = "SELECT * FROM $table WHERE $field = ?  AND deleted = $val";
    $stmt = $this->_pdo->prepare($query);
    $stmt->execute([$id]);
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    return $result;
}

public function uploadFile($news_id, $dbpath){
  $sql = "INSERT INTO newsImages (news_id, images) VALUES (?,?) ";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$news_id, $dbpath]);
  return true;
}


// end of class
}
