<?php
require_once '../../core/init.php';
//add new note ajax request
$user = new Officer();
$show = new Show();
$notify = new Notification();
$feed = new  Feedback();
$userid = $user->data()->officer_id;
$db = new Database::getInstance();//add exective code
if (isset($_FILES['report_signature']) && $_FILES['chaplain_signature']) {
    $warheadpath  = '';
    $warheadpath2 = '';
    $controller_id = $show->test_input($_POST['controller_id']);
    $church = $show->test_input($_POST['church']);
    $companyCode = $show->test_input($_POST['companyCode']);
    $council = $show->test_input($_POST['council']);
    $officer_name = $show->test_input($_POST['officer_name']);
    $office = $show->test_input($_POST['office']);
    $areaCouncil = $show->test_input($_POST['areaCouncil']);
    $nameChaplain = $show->test_input($_POST['nameChaplain']);

    $required = array('controller_id', 'church', 'companyCode', 'council', 'officer_name', 'office','nameChaplain');
    foreach ($required as $fields) {
    	if (empty($_POST[$fields])) {
    	 echo $show->showMessage('danger', 'Some Required fields are still left blank check!','warning');
      return false;
    	}
    }

  $checkfileNo = $warhead->checkEntered('DataFormInfo','controller_id',$controller_id);
  if ($checkfileNo) {
      echo $warhead->showMessage('danger', 'Information Entered Already!');
      return false;
  }


      	 $file = $_FILES["report_signature"]['name'];
         $RandomNum = rand(0, 10000);
         $FileName = str_replace(' ','-',strtolower($_FILES['report_signature']['name']));
         $FileType = $_FILES['report_signature']['type']; //"File/png", File/jpeg etc.
         $FileTemp = $_FILES["report_signature"]["tmp_name"];
         $FileSize = $_FILES['report_signature']['size'];
         $FileExt = substr($FileName, strrpos($FileName, '.'));
         $FileExt = str_replace('.','',$FileExt);
         $valid = array('jpg', 'png', 'jpeg');
         $FileName = preg_replace("/\.[^.\s]{3,4}$/", "", $FileName);
         $NewFileName = $FileName.'-'.$RandomNum.'.'.$FileExt;
         $output_dir = '../../uploads/dataForm/'.$NewFileName;//Path for file upload
       	if (!in_array(strtolower($FileExt), $valid)) {
          echo $warhead->showMessage('danger', 'Invalid Extension');

       	}
        $warheadpath = $NewFileName;

      	 // if (!is_dir($output_dir)) {
         //   mkdir($output_dir='uploads', 755, true);
         //
         // }
        move_uploaded_file($FileTemp ,$output_dir);


      	 $files = $_FILES["chaplain_signature"]['name'];
         $RandomNums = rand(0, 10000);
         $FileNames = str_replace(' ','-',strtolower($_FILES['chaplain_signature']['name']));
         $FileTypes = $_FILES['chaplain_signature']['type']; //"File/png", File/jpeg etc.
         $FileTemps = $_FILES["chaplain_signature"]["tmp_name"];
         $FileSize = $_FILES['chaplain_signature']['size'];
         $FileExts = substr($FileNames, strrpos($FileNames, '.'));
         $FileExts = str_replace('.','',$FileExts);
         $valids = array('jpg', 'png', 'jpeg');
         $FileNames = preg_replace("/\.[^.\s]{3,4}$/", "", $FileName);
         $NewFileNames = $FileNames.'-'.$RandomNums.'.'.$FileExts;
         $output_dirs = '../../uploads/dataForm/'.$NewFileNames;//Path for file upload
       	if (!in_array(strtolower($FileExts), $valids)) {
          echo $warhead->showMessage('danger', 'Invalid Extension');

       	}
        $warheadpath2 = $NewFileNames;

      	 // if (!is_dir($output_dir)) {
         //   mkdir($output_dir='uploads', 755, true);
         //
         // }
        move_uploaded_file($FileTemps ,$output_dirs);



      $upload = $warhead->addInfoData($controller_id,$church,$companyCode,$council,$officer_name,$office,$areaCouncil,$nameChaplain, $warheadpath, $warheadpath2);


     if (!$upload) {
      echo $warhead->showMessage('danger', $upload->errorInfo());
     }else{
       echo 'success';
     }


}



if (isset($_POST['sendnow_council_id'])) {
    $councilsending = $_POST['sendnow_council_id'];
    $warhead->updatePermission($councilsending);
    $warhead->subMitReport($officer->officers_group_council);
    $warhead->notification($councilsending, 'Admin', 'Have Submitted  Data Form Report For  there Group Council');

  }


if (isset($_POST['sendnow_compan_id'])) {
    $councilsending = $_POST['sendnow_compan_id'];
    $warhead->updatePermission($councilsending);


  }
