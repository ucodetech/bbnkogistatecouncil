<?php
require_once '../../core/init.php';
//feed back ajax
$user = new Officer();
$show = new Show();
$notify = new Notification();
$feed = new  Feedback();
$userid = $user->data()->officer_id;
$db = new Database::getInstance();
if (isset($_POST['action']) && $_POST['action'] == 'designationUpdatecompany') {

	if (isset($_POST['noDesCompany'])) {
		$designation = Null;
	}else{
		$designation = $show->test_input($_POST['companyLevel']);
		$designation =  strtolower($designation);
	}

	if (!empty($_POST['noDesCompany']) && !empty($_POST['companyLevel'])) {
		echo $show->showMessage('danger', 'Either you leave Designation blank and Thick No Designation or Do not thick no Designation and Enter Your designation!','warning');
		return false;
	}
	if (empty($_POST['noDesCompany']) && empty($_POST['companyLevel'])) {
		echo $show->showMessage('danger', 'Enter Your designation or thick the box if you do not have any designation!'.'warning');
		return false;
	}


	$sql = "UPDATE officers SET designation_company  = '$designation' WHERE officer_id = '$userid'";
 	if($db->query($sql))
		echo 'true';


}

if (isset($_POST['action']) && $_POST['action'] == 'designationUpdateCouncil') {

	if (isset($_POST['noDesCouncil'])) {
		$designation = Null;
	}else{
		$designation = $show->test_input($_POST['councilLevel']);
		$designation = strtolower($designation);
	}

	if (!empty($_POST['noDesCouncil']) && !empty($_POST['councilLevel'])) {
		echo $show->showMessage('danger', 'Either you leave Designation blank and Thick No Designation or Do not thick no Designation and Enter Your designation!','warning');
		return false;
	}
	if (empty($_POST['noDesCouncil']) && empty($_POST['councilLevel'])) {
		echo $show->showMessage('danger', 'Enter Your designation or thick the box if you do not have any designation!','warning');
		return false;
	}


	$sql = "UPDATE officers SET designation_council  = '$designation' WHERE officer_id = '$userid'";
	if($db->query($sql))
		echo 'true';


}

// designation both
if (isset($_POST['action']) && $_POST['action'] == 'designationUpdateBoth') {

	if (isset($_POST['noDesBoth'])) {
		$designationCompany = Null;
		$designationCouncil = Null;
	}else{
		$designationCompany = $show->test_input($_POST['bothLevelCompany']);
		$designationCompany =  strtolower($designationCompany);

		$designationCouncil = $show->test_input($_POST['bothLevelCouncil']);
		$designationCouncil =  strtolower($designationCouncil);
	}

	if (!empty($_POST['noDesBoth']) && !empty($_POST['bothLevelCompany'])  && !empty($_POST['bothLevelCouncil'])) {
		echo $show->showMessage('danger', 'Either you leave Designation blank and Thick No Designation or Do not thick no Designation and Enter Your designation!','warning');
		return false;
	}
	if (empty($_POST['noDesBoth']) && empty($_POST['bothLevelCompany'])  && empty($_POST['bothLevelCouncil'])) {
		echo $show->showMessage('danger', 'Enter Your designation or thick the box if you do not have any designation!'.'warning');
		return false;
	}


	$sql = "UPDATE officers SET designation_company  = '$designationCompany', designation_council = '$designationCouncil' WHERE officer_id = '$userid'";
 	if($db->query($sql))
		echo 'true';


}
