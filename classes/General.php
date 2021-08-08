<?php
class General{

  private  $_db,
           $_user;


  function __construct()
  {
    $this->_db = Database::getInstance();
   $this->_user = new User() ;

  }


  public function warheadAuth($authID){
    $sql = "SELECT * FROM commanders WHERE commander_id = '$authID' ";
    $res = $this->_db->query($sql);
    if ($res->count()) {
      return $res->first();
    }else{
      return false;
    }
  }

  public function totalCount($tablename){
    $sql = "SELECT * FROM $tablename";
    $res = $this->_db->query($sql);
    if ($res->count()) {
      return $res->count();
    }else{
      return '0';
    }
  }

  public function totalCounts(){
  $sql = "SELECT * FROM officers";
  $res = $this->_db->query($sql);
  if ($res->count()) {
    return $res->count();
  }else{
    return '0';
  }
}

  //Get gender percentage
  public function genderPer(){
    $sql = "SELECT officers_gender, COUNT(*) AS number FROM officers WHERE officers_gender != '' GROUP BY officers_gender ";
    $res = $this->_db->query($sql);
    if ($res->count()) {
      return $res->results();
    }else{
      return false;
    }

  }
  // verified and unverified percenta
  public function verifiedPer(){
    $sql = "SELECT verified, COUNT(*) AS number FROM officers  GROUP BY verified ";
    $res = $this->_db->query($sql);
    if ($res->count()) {
      return $res->results();
    }else{
      return false;
    }
  }
  //hits
  public function hit(){
    $sql = "SELECT hits FROM websiteHits WHERE id = 0";
    $res = $this->_db->query($sql);
    if ($res->count()) {
      return $res->first();
    }else{
      return false;
    }
  }
  public function verified_officers_email($status){
    $sql = "SELECT * FROM officers WHERE verified = '$status'";
    $res = $this->_db->query($sql);
    if ($res->count()) {
      return $res->count();
    }else{
      return false;
    }
  }


  public function virusHead($commanderid){
      $sql = "SELECT * FROM commanders WHERE command_id = '$commanderid' AND deleted = 0";
      $res = $this->_db->query($sql);
      if ($res->count()) {
        return $res->results();
      }else{
        return false;
      }
    }

  public function deleteToken($email){
      $sql = "DELETE FROM pwdReset WHERE email = '$email' ";
      $this->_db->query($sql);
      return true;
  }

  public function selectSelector($selector){

    $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector = '$selector' AND pwdResetExpires > NOW()";
    $res = $this->_db->query($sql);
    if ($res->count()) {
      return $res->first();
    }else{
      return false;
    }
  }

  public function selectUsers($val){
    $sql = "SELECT * FROM officers WHERE  deleted = $val";
    $res = $this->_db->query($sql);
    if ($res->count()) {
      return $res->results();
    }else{
      return false;
    }
  }


  public function updateUser($password,$email){
    $sql = "UPDATE commanders SET commander_password = '$password' WHERE commander_email = '$email' AND deleted = 0";
    $this->_db->query($sql);
    return true;
  }

  public function getLga($offlga)
  {
    $sql = "SELECT * FROM allLGAInNig WHERE lga = '$offlga' AND deleted = 0";
    $res = $this->_db->query($sql);
    if ($res->count()) {
      return $res->first();
    }else{
      return false;
    }
  }

  public function add_new_note($user_id, $title, $note){
    $this->_db->insert('notes', array(
      'user_id' => $user_id,
      'title' => $title,
      'note' => $note
    ));
    return true;
  }
  // Fetch all notes from user
  public function getNotes(){
    $sql = "SELECT notes.id, notes.title, notes.note, notes.dateCreated, notes.dateUpdated, officers.officers_name, officers.officers_email FROM notes INNER JOIN officers ON notes.officer_id = officers.officer_id ";
    $res = $this->_db->query($sql);
    if ($res->count()) {
      return $res->results();
    }else{
      return false;
    }
  }

  //Select Note for Edit note
  public function editNote($id){
    $sql = "SELECT * FROM notes WHERE id ='$id'";
    $res = $this->_db->query($sql);
    if ($res->count()) {
      return $res->first();
    }else{
      return false;
    }
  }



  //Delete Note

  public function noteAction($val, $id){
    $sql = "UPDATE notes SET deleted = $val WHERE id = '$id' ";
    $this->_db->query($sql);
    return true;

  }

  public function deleteNoteP($id){
    $sql = "DELETE FROM notes WHERE id = '$id' ";
    $this->_db->query($sql);
    return true;
  }

  public function getNoteDeleted(){
    $sql = "SELECT * FROM notes WHERE  deleted = 1";
    $res = $this->_db->query($sql);
    if ($res->count()) {
      return $res->results();
    }else{
      return false;
    }
  }



  public function selectNewUser($email){
    $sql = "SELECT * FROM officers WHERE email = '$email'";
    $res = $this->_db->query($sql);
    if ($res->count()) {
      return $res->first();
    }else{
      return false;
    }
  }



  public function updateVkey($token, $id){
    $this->_db->insert('verifyEaml', array(
      'token' => $token,
      'user_id' => $id
    ));
    return true;
  }

  public function deleteVkey($id){
    $this->_db->delete('verifyEaml', array('officer_id', '=', $id));
    return true;
  }


  public function verify_email($officerid){
    $this->_db->update('officers','officer_id', $officerid, array(
      'verified' => 1
    ));
    return true;
  }



  public function loggedUsers(){
    $sql = "SELECT * FROM officers WHERE last_login > DATE_SUB(NOW(), INTERVAL 5 SECOND)";
    $res = $this->_db->query($sql);
    if ($res->count()) {
      return $res->results();
    }else{
      return false;
    }
  }

  //Get users by id

  public function fetchUserDetail($id, $val){
    $sql = "SELECT * FROM officers WHERE officer_id = '$id' AND deleted = '$val'";
    $res = $this->_db->query($sql);
    if ($res->count()) {
      return $res->first();
    }else{
      return false;
    }
  }

  //Delete USer

  public function userAction($id, $val){
    $sql = "UPDATE officers SET deleted = $val WHERE officer_id = '$id' ";
    $this->_db->query($sql);
    return true;

  }

  //delete user permenatly
  public function deleteUserP($id){
    $sql = "DELETE FROM officers WHERE officer_id = '$id' ";
    $this->_db->query($sql);
    return true;
  }


  public function exportAllTables($table, $val){
    $sql = "SELECT * FROM $table ORDER BY $val ";
    $res = $this->_db->query($sql);
    if ($res->count()) {
      return $res->results();
    }else{
      return false;
    }
  }




  public function subNews($email){
    $sql = "INSERT INTO `newsSubscribers` (subscriber_email) VALUES ('$email') ";
    $this->_db->query($sql);

    return true;
  }

  public function selectSubscribers(){
      $sql = "SELECT * FROM `newsSubscribers`";
      $res = $this->_db->query($sql);
      if ($res->count()) {
        return $res->results();
      }else{
        return false;
      }

  }





  public function likeSys($pid)
  {
    $this->_db->insert('likeSystem', array(
      'post_id' => $pid
    ));
    return true;
  }


  public function checkLike($postid)
  {
    $sql = "SELECT officer_id  FROM likeSystem WHERE post_id ='$postid'";
    $res = $this->_db->query($sql);
    if ($res->count()) {
      return $res->first();
    }else{
      return false;
    }
  }

  //add executives
  public function addExectives($executive_name,$executive_description, $dbpath,$executive_office)
  {
    $this->_db->insert('BBStateExecutives', array(
      'exective_name' => $executive_name,
      'exective_description' => $executive_description,
      'exective_image' => $dbpath,
      'executive_office' => $executive_office
    ));
    return true;
  }

  public function checkExeutive($executive_office)
  {
    $sql = "SELECT * FROM BBCadetExecutives WHERE executive_office = '$executive_office' AND deleted = 0";
    $res = $this->_db->query($sql);
    if ($res->count()) {
      return $res->first();
    }else{
      return false;
    }

  }

  public function getById($table, $field, $id){
    $sql = "SELECT * FROM $table WHERE $field = '$id'  ";
    $res = $this->_db->query($sql);
    if ($res->count()) {
      return $res->first();
    }else{
      return false;
    }
  }

  public function updateCommanders($commander_id, $commander_name ,$commander_email,$commander_phone_no,$commander_home_church,$commander_permission)
  {
    $this->_db->update('commanders','command_id',$commander_id, array(
      'commander_name' => $commander_name,
      'commander_email' => $commander_email,
      'commander_phone_no' => $commander_phone_no,
      'commander_home_church' => $commander_home_church,
      'commmander_permissions' => $commander_permission
    ));
    return true;
  }

  public function insertBBHistory($table, $fields = array())
  {
    $this->_db->insert($table, $fields);
  }

  public function selectHistory($table)
  {
    $sql = "SELECT * FROM $table";
      $res = $this->_db->query($sql);
      if ($res->count()) {
        return $res->results();
      }else{
        return false;
      }
  }

  public function updateHistory($table, $editid,$title, $description)
  {
    $this->_db->update($table,'id',$editid, array(
      'bb_title' => $title,
      'bb_description' => $description
    ));
    return true;
  }

  public function insertBBNHistory($title, $description,$formation_creation
  ,$other_appoint,$secretariat  ,$events,$generalInfo)
  {
    $this->_db->insert('BBStateHistory', array(
      'bb_title' => $title,
      'bb_description' => $description,
      'formation_creation' => $formation_creation,
      'other_apointees_reps' => $other_appoint,
      'secretariat' => $secretariat,
      'events' => $events,
      'general_info' => $generalInfo
    ));
    return true;
  }

  public function updateKSC($editid, $title, $description,$formation_creation ,$other_appoint,$secretariat ,$events,$generalInfo)
  {
    $this->_db->update('BBStateHistory','id',$editid, array(
      'bb_title' => $title,
      'bb_description' => $description,
      'formation_creation' => $formation_creation,
      'other_apointees_reps' => $other_appoint,
      'secretariat' => $secretariat,
      'events' => $events,
      'general_info' => $generalInfo
    ));
    return true;
  }

  public function insertTrainingOfficers($introduction,$tofficer_name, $tofficer_qua)
  {
    $this->_db->insert('BBStateCouncilsTofficers', array(
      'introduction' => $introduction,
      'officer_name' => $tofficer_name,
      'officer_qualification' => $tofficer_qua
    ));
    return true;
  }

  //group councils
  public function insertGroupCouncils($introduction,$council_name)
  {
    $this->_db->insert('BBStateCouncils', array(
      'introduction' => $introduction,
      'council_name' => $council_name
    ));
    return true;
  }


  public function selectTable($table, $val)
  {
    $query = $this->_db->get($table,  array('deleted', '=', $val));
    if ($query->count()) {
      return $query->results();
    }else{
      return false;
    }

  }
  public function selectTable2($table, $val, $submitted)
  {
    $sql = "SELECT * FROM $table WHERE deleted = $val AND submitted = $submitted ORDER by council ASC";
    $query =  $this->_db->query($sql);
    if ($query->count()) {
      return $query->results();
    }else{
      return false;
    }


  }

  public function selectTable3($table, $val)
  {
    $sql = "SELECT * FROM $table WHERE deleted = $val ORDER BY company_number ASC";
    $query =  $this->_db->query($sql);
    if ($query->count()) {
      return $query->results();
    }else{
      return false;
    }

  }

  public function updateTrainingOfficers($editid, $introduction,  $tofficer_name, $tofficer_qua)
  {
    $this->_db->update('BBStateCouncilsTofficers','id',$editid, array(
      'introduction' => $introduction,
      'officer_name' => $tofficer_name,
      'officer_qualification' => $tofficer_qua
        ));
    return true;
  }

  public function updateGroupCouncil($editid, $introduction,  $council_name)
  {
    $this->_db->update('BBStateCouncils','id',$editid, array(
      'introduction' => $introduction,
      'council_name' => $tofficer_name
        ));
    return true;
  }

  public function checkTable($name)
  {
      $get = $this->_db->get('BBStateCouncils', array('council_name', '=', $name));
      if ($get->count()) {
        return $get->first();
      }else{
        return false;
      }

  }

  public function trashUpdate($table,$del_id,$val)
  {
    $this->_db->update($table,'id', $del_id,array(
      'deleted' => $val
    ));
    return true;
  }

  public function slugCheck($table, $slug_url){
    $sql = "SELECT * FROM $table WHERE slug_url LIKE '%$slug_url%' ";
    $query =  $this->_db->query($sql);
    if ($query->count()) {
      return $query->first();
    }else{
      return false;
    }

  }

  public function addGallery($gallery_title,$gallery_date_event,$gallery_event_location,$gallery_description, $dbpath)
  {
    $this->_db->insert('BBStateGallery', array(
      'gall_title' => $gallery_title,
      'gall_eventDate' => $gallery_date_event,
      'gall_event_location' => $gallery_event_location,
      'gall_description' => $gallery_description,
      'gall_image' => $dbpath
    ));
    return true;
  }


  public function addSlider($Slider_title,$Slider_description, $dbpath)
  {
    $this->_db->insert('carousel_item', array(
      'carousel_event' => $Slider_title,
      'carousel_description' => $Slider_description,
      'carousel_image' => $dbpath
    ));
    return true;
  }

  public function addOfficial($table,$fields = array())
  {
    $this->_db->insert($table, $fields);
  }

  public function addStateExecutives($table,$fields = array())
  {
      $this->_db->insert($table, $fields);
}

  public function addPPP($table,$fields = array())
  {
    $this->_db->insert($table, $fields);
  }

  public function insertLga($lga)
  {
    $this->_db->insert('allLGAInNig', array(
      'lga' => $lga
    ));
    return true;
  }

  //FEtch notification from database
  public function fetchReqestNotifaction(){
    $sql = "SELECT * FROM dataFormPermission WHERE approved = 'negative' ORDER BY id DESC";
    $query =  $this->_db->query($sql);
    if ($query->count()) {
      return $query->results();
    }else{
      return false;
    }
  }
  public function fetchReqestNotifactionCount(){
    $get = $this->_db->get('dataFormPermission', array('approved', '=', 'negative'));
    if ($get->count()) {
      return $get->count();
    }else{
      return false;
    }
  }

  public function selectRequestedLt($officerid){

    $get = $this->_db->get('officers', array('officer_id', '=', $officerid));
    if ($get->count()) {
      return $get->first();
    }else{
      return false;
    }

  }

  public function selectUserNote($officerid){
    $get = $this->_db->get('officers', array('officer_id', '=', $officerid));
    if ($get->count()) {
      return $get->first();
    }else{
      return false;
    }

  }

  public function insertCompany($company, $church)
  {
    $this->_db->insert('registeredCompanys', array(
      'company_number' => $company,
      'church' => $church
    ));
    return true;
  }

  public function selectCompany($company)
  {
     $get = $this->_db->get('registeredCompanys', array('company_number', '=', $company));
     if ($get->count()) {
       return $get->first();
     }else{
       return false;
     }
  }

  public function selectCompany2($company, $editid)
  {
    $sql = "SELECT * FROM registeredCompanys WHERE company_number = '$company' AND id != '$editid'";
    $get = $this->_db->query($sql);
    if ($get->count()) {
      return $get->first();
    }else{
      return false;
    }
  }

  public function updateCompany($editid, $company,$church)
  {
    $this->_db->update('registeredCompanys', 'id', $editid, array(
      'company_number'  => $company,
      'church' => $church
    ));
    return true;
  }

  public function awardUpload($award_name,$dbpath, $award_event_title, $award_description)
  {

    $this->_db->insert('awardWinners', array(
      'award_name'  => $award_name,
      'award_images' => $dbpath,
      'award_event_title' => $award_event_title,
      'award_event_description' => $award_description
    ));
    return true;

  }

  public function awardUpdate($editid, $award_name, $dbpath, $award_event_title, $award_description)
  {
    $this->_db->insert('awardWinners', 'id',$editid,  array(
      'award_name'  => $award_name,
      'award_images' => $dbpath,
      'award_event_title' => $award_event_title,
      'award_event_description' => $award_description
    ));
    return true;

  }


    public function addNews($author, $news_title, $news_description,$slug_url)
    {
    $this->_db->insert('news', array(
      'author'  => $author,
      'title' => $news_title,
      'description' => $news_description,
      'slug_url' => $slug_url
    ));
    return true;

    }

  //Update tutorials featured image
  public function featuredAction($dbpath, $news_id){
      $this->_db->update('news', 'id', $news_id, array(
        'featuredImage' => $dbpath
      ));
      return true;
  }

  //Update tutorials table and source code table
  public function newsAction($id, $field, $val){
  $this->_db->update('news', 'id', $id, array(
    $field => $val
  ));
  return true;
  }

  public function newsimageAction($id, $val){
  $this->_db->update('newsImages', 'news_id', $id, array(
    'deleted' => $val
  ));
  return true;
  }


  public function getByIdNews($table, $field, $id){
      $dat = $this->_db->get($table, array($field, '=', $id));
      if ($dat->count()) {
        return $dat->first();
      }else{
        return false;
      }
  }

  public function uploadFile($news_id, $dbpath){
    $this->_db->insert('newsImages', array(
      'news_id' => $news_id,
      'images' => $dbpath
    ));
    return true;
  }






}//end of class
