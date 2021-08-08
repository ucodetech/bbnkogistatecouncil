<?php
require_once '../../core/init.php';
$db = new Officers();

if (isset($_POST['action']) && $_POST['action'] == 'addInfo') {

	$controller_id	= $db->test_input($_POST['controller_id']); 
	$companyCode	= $db->test_input($_POST['companyCode']);
	$Name	= $db->test_input($_POST['Name']);
	$stateNo	= 				$_POST['stateNo'];
	$qualification	= $db->test_input($_POST['qualification']); 
	$lastTraining	= $db->test_input($_POST['lastTraining']);
	$council = $db->test_input($_POST['council']);


	if (isset($_POST['DntHave'])) {
		$hasStateID = 0;
		
	}else{
		$hasStateID  = 1;

	  $checkSource  = $db->checkStateID('officers', $stateNo);
    
	if ($checkSource == '') {
			echo $db->showMessage('danger', 'State ID not Found!');
			return false;
		}

	}
	
		
$required = array('controller_id','companyCode','Name','qualification','lastTraining','council');
  foreach ($required as $field) {
if (empty($_POST[$field])) {
	echo $db->showMessage('danger', 'All Fields with Astrisks are required!');
	return false;
   	}
   }
    
   		$add = $db->addDataForm('DataFormBoys', 'control_id','Name','stateNo','Qualification', 'LastTraining', 'hasStateID', 'company','groupCouncil ', $controller_id, $Name, $stateNo, $qualification, $lastTraining, $hasStateID, $companyCode, $council);


   if ($add) {
   	$query = "SELECT * FROM DataFormBoys WHERE Name = ?  ";
    $stmt = $db->_pdo->prepare($query);
    $stmt->execute([$Name]);
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    if ($result->stateNo == '') {
    	$stateid = 'empty';
    }else{
    	$stateid = $result->stateNo;
    }
   	$db->StateIDs($result->id, $stateid);

//count for battalion and council
   	$query = "SELECT * FROM countForMe WHERE control_id = ? AND company = ? ";
    $stmt = $db->_pdo->prepare($query);
    $stmt->execute([$officer->officer_id, $officer->officers_company_code]);
    $countThis = $stmt->rowCount();
    if ($countThis) {
    	$update = "UPDATE countForMe SET noOfBoys = noOfBoys + 1 WHERE control_id = ?";
    	$stmt = $db->_pdo->prepare($update);
    	$stmt->execute([$officer->officer_id]);
    }else{
    	$insert = "INSERT INTO countForMe (control_id, company, council, noOfBoys) VALUES (?,?,?, 1) ";
    	$stmt = $db->_pdo->prepare($insert);
    	$stmt->execute([$officer->officer_id, $companyCode, $council]);
    }

   	echo 'true';
   }else{
   	echo 'false';
   }
}


//Fetch boys Ajax request
if (isset($_POST['action']) && $_POST['action'] == 'display_boys') {
  $output = '';
  $userid = $officer->officer_id;
  $boys =  $db->getDataForm('DataFormBoys', 'control_id', $userid);
  if (!$boys) {
    echo '<h3 class="text-center text-secondary">No Data in the database!</h3>';
  }else{
    $output .= '
    <table id="showBoys" class="table table-striped table-sm">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>State ID</th>
          <th>Qualification</th>
          <th>Year Of Last Training</th>
          <th>Update State ID</th>

        </tr>
        <tbody>
    ';
    $x = 0;
    foreach ($boys as $boy) {
      $x = $x + 1;
      if ($boy->stateNo == '') {
      	$report = '<span class="text-danger">No State ID Yet</span>';
      	$hasNow = '<a href="#" data-toggle="modal" data-target="#updateStateID" id="'.$boy->id.'" class="btn btn-block btn-success hasIDBtn">Has State ID Now<a/>';
      }else{
      	$report = $boy->stateNo;
      	$hasNow = '<span class="btn btn-danger">Can\'t Update!</span>';
      }

    $output .= '
    <tr>
      <td>'.$x.'</td>
      <td>'.$boy->Name.'</td>
      <td>'.$report.'</td>
      <td>'.$boy->Qualification.'</td>
      <td>'.pretty_dated($boy->LastTraining).'</td>
      <td>'.$hasNow.'</td>

     
    </tr>
    ';

    }
    $output .='
    </tbody>
  </thead>
</table>
    ';
    echo $output;
  }

}


//add officers
if (isset($_POST['action']) && $_POST['action'] == 'addInfoOfficer') {

	$controller_id	= $db->test_input($_POST['controller_id']); 
	$companyCode	= $db->test_input($_POST['companyCode']);
	$Name	= $db->test_input($_POST['Name']);
	$stateNo	= 				$_POST['stateNo'];
	$qualification	= $db->test_input($_POST['qualification']); 
	$lastTraining	= $db->test_input($_POST['lastTraining']);
	$council = $db->test_input($_POST['council']);
	
	if (isset($_POST['DntHave'])) {
		$hasStateID = 0;
		
	}else{
		$hasStateID  = 1;
		  $checkSource  = $db->checkStateID('officers', $stateNo);
	if ($checkSource == '') {
			echo $db->showMessage('danger', 'State ID not Found!');
			return false;
		}
	}
	
		
$required = array('controller_id','companyCode','Name','qualification','lastTraining','council');
  foreach ($required as $field) {
if (empty($_POST[$field])) {
	echo $db->showMessage('danger', 'All Fields with Astrisks are required!');
	return false;
   	}
   }
    
   $add = $db->addDataForm('DataFormOfficers', 'control_id','Name','stateNo','Qualification', 'LastTraining', 'hasStateID', 'company','groupCouncil', $controller_id, $Name, $stateNo, $qualification, $lastTraining, $hasStateID, $companyCode, $council);
   if ($add) {
   	$query = "SELECT * FROM DataFormOfficers WHERE Name = ?  ";
    $stmt = $db->_pdo->prepare($query);
    $stmt->execute([$Name]);
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    if ($result->stateNo == '') {
    	$stateid = 'empty';
    }else{
    	$stateid = $result->stateNo;
    }
   	$db->StateIDs($result->id, $stateid);


//count for battalion and council
   	$query = "SELECT * FROM countForMe WHERE control_id = ? AND company = ? ";
    $stmt = $db->_pdo->prepare($query);
    $stmt->execute([$officer->officer_id, $officer->officers_company_code]);
    $countThis = $stmt->rowCount();
    if ($countThis) {
    	$update = "UPDATE countForMe SET noOfOfficers = noOfOfficers + 1 WHERE control_id = ?";
    	$stmt = $db->_pdo->prepare($update);
    	$stmt->execute([$officer->officer_id]);
    }else{
    	$insert = "INSERT INTO countForMe (control_id, company, council, noOfOfficers) VALUES (?,?,?, 1) ";
    	$stmt = $db->_pdo->prepare($insert);
    	$stmt->execute([$officer->officer_id, $companyCode, $council]);
    }

   	echo 'true';
   }else{
   	echo 'false';
   }

   
}


//Fetch boys Ajax request
if (isset($_POST['action']) && $_POST['action'] == 'display_officers') {
  $output = '';
  $userid = $officer->officer_id;
  $officers =  $db->getDataForm('DataFormOfficers', 'control_id', $userid);
  if (!$officers) {
    echo '<h3 class="text-center text-secondary">No Data in the database!</h3>';
  }else{
    $output .= '
    <table id="showOfficers" class="table table-striped table-sm">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>State ID</th>
          <th>Qualification</th>
          <th>Year Of Last Training</th>
          <th>Update State ID </th>

        </tr>
        <tbody>
    ';
    $x = 0;
    foreach ($officers as $officer) {
      $x = $x + 1;
      if ($officer->stateNo == '') {
      	$report = '<span class="text-danger">No State ID Yet</span>';
      	$hasNow = '<a href="#" data-toggle="modal" data-target="#updateStateIDOfficer" id="'.$officer->id.'" class="btn btn-block btn-success hasIDOfficerBtn">Has State ID Now<a/>';

      }else{
      	$report = $officer->stateNo;
      	$hasNow = '<span class="btn btn-danger">Can\'t Update!</span>';

      }

    $output .= '
    <tr>
      <td>'.$x.'</td>
      <td>'.$officer->Name.'</td>
      <td>'.$report.'</td>
      <td>'.$officer->Qualification.'</td>
      <td>'.pretty_dated($officer->LastTraining).'</td>
      <td>'.$hasNow.'</td>

     
    </tr>
    ';

    }
    $output .='
    </tbody>
  </thead>
</table>
    ';
    echo $output;
  }

}


//add mothers
if (isset($_POST['action']) && $_POST['action'] == 'addInfoMother') {

	$controller_id	= $db->test_input($_POST['controller_id']); 
	$companyCode	= $db->test_input($_POST['companyCode']);
	$Name	= $db->test_input($_POST['Name']);
	$stateNo	= 				$_POST['stateNo'];
	$qualification	= $db->test_input($_POST['qualification']); 
	$lastTraining	= $db->test_input($_POST['lastTraining']);
	$council = $db->test_input($_POST['council']);
	if (isset($_POST['DntHave'])) {
		$hasStateID = 0;
		
	}else{
		$hasStateID  = 1;
		  $checkSource  = $db->checkStateID('officers', $stateNo);
	if ($checkSource == '') {
			echo $db->showMessage('danger', 'State ID not Found!');
			return false;
		}
	}
	
		
$required = array('controller_id','companyCode','Name','council');
  foreach ($required as $field) {
if (empty($_POST[$field])) {
	echo $db->showMessage('danger', 'All Fields with Astrisks are required!');
	return false;
   	}
   }
    
    

   $add = $db->addDataForm('DataFormMothers', 'control_id','Name','stateNo','Qualification', 'LastTraining', 'hasStateID', 'company','groupCouncil', $controller_id, $Name, $stateNo, $qualification, $lastTraining, $hasStateID, $companyCode, $council);
   if ($add) {
   	$query = "SELECT * FROM DataFormMothers WHERE Name = ?  ";
    $stmt = $db->_pdo->prepare($query);
    $stmt->execute([$Name]);
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    if ($result->stateNo == '') {
    	$stateid = 'empty';
    }else{
    	$stateid = $result->stateNo;
    }
   	$db->StateIDs($result->id, $stateid);

   	//count for battalion and council
   	$query = "SELECT * FROM countForMe WHERE control_id = ? AND company = ? ";
    $stmt = $db->_pdo->prepare($query);
    $stmt->execute([$officer->officer_id, $officer->officers_company_code]);
    $countThis = $stmt->rowCount();
    if ($countThis) {
    	$update = "UPDATE countForMe SET noOfMothers = noOfMothers + 1 WHERE control_id = ?";
    	$stmt = $db->_pdo->prepare($update);
    	$stmt->execute([$officer->officer_id]);
    }else{
    	$insert = "INSERT INTO countForMe (control_id, company, council, noOfMothers) VALUES (?,?,?, 1) ";
    	$stmt = $db->_pdo->prepare($insert);
    	$stmt->execute([$officer->officer_id, $companyCode, $council]);
    }
   	echo 'true';
   }else{
   	echo 'false';
   }

   
}


//Fetch mothersAjax request
if (isset($_POST['action']) && $_POST['action'] == 'display_mothers') {
  $output = '';
  $userid = $officer->officer_id;
  $mothers =  $db->getDataForm('DataFormMothers', 'control_id', $userid);
  if (!$mothers) {
    echo '<h3 class="text-center text-secondary">No Data in the database!</h3>';
  }else{
    $output .= '
    <table id="showMothers" class="table table-striped table-sm">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>State ID</th>
          <th>Qualification</th>
          <th>Year Of Last Training</th>
          <th>Update State ID </th>

        </tr>
        <tbody>
    ';
    $x = 0;
    foreach ($mothers as $mother) {
      $x = $x + 1;
      if ($mother->stateNo == '') {
      	$report = '<span class="text-danger">No State ID Yet</span>';
      	$hasNow = '<a href="#" data-toggle="modal" data-target="#updateStateIDMother" id="'.$mother->id.'" class="btn btn-block btn-success hasIDMotherBtn">Has State ID Now<a/>';

      }else{
      	$report = $mother->stateNo;
      	$hasNow = '<span class="btn btn-danger">Can\'t Update!</span>';

      }
      if ($mother->Qualification == '') {
      	$qua = '<span class="text-danger">No Qualification</span>';
      	

      }else{
      	$qua = $mother->Qualification;

      }
      if ($mother->LastTraining == '0000') {
      	$year = '<span class="text-danger">No Training</span>';
      	
      }else{
      	$year = pretty_dated($mother->LastTraining);

      }
      

    $output .= '
    <tr>
      <td>'.$x.'</td>
      <td>'.$mother->Name.'</td>
      <td>'.$report.'</td>
      <td>'.$qua.'</td>
      <td>'.$year.'</td>
      <td>'.$hasNow.'</td>

     
    </tr>
    ';

    }
    $output .='
    </tbody>
  </thead>
</table>
    ';
    echo $output;
  }

}


//add patrons
if (isset($_POST['action']) && $_POST['action'] == 'addInfoPatron') {

	$controller_id	= $db->test_input($_POST['controller_id']); 
	$companyCode	= $db->test_input($_POST['companyCode']);
	$Name	= $db->test_input($_POST['Name']);
	$stateNo	= 				$_POST['stateNo'];
	$qualification	= $db->test_input($_POST['qualification']); 
	$lastTraining	= $db->test_input($_POST['lastTraining']);
	$council = $db->test_input($_POST['council']);
	if (isset($_POST['DntHave'])) {
		$hasStateID = 0;
		
	}else{
		$hasStateID  = 1;
		  $checkSource  = $db->checkStateID('officers', $stateNo);
	if ($checkSource == '') {
			echo $db->showMessage('danger', 'State ID not Found!');
			return false;
		}
	}
	
		
$required = array('controller_id','companyCode','Name','council');
  foreach ($required as $field) {
if (empty($_POST[$field])) {
	echo $db->showMessage('danger', 'All Fields with Astrisks are required!');
	return false;
   	}
   }
    
    

   $add = $db->addDataForm('DataFormPatrons', 'control_id','Name','stateNo','Qualification', 'LastTraining', 'hasStateID', 'company','groupCouncil', $controller_id, $Name, $stateNo, $qualification, $lastTraining, $hasStateID, $companyCode, $council);
   if ($add) {
   	$query = "SELECT * FROM DataFormPatrons WHERE Name = ?  ";
    $stmt = $db->_pdo->prepare($query);
    $stmt->execute([$Name]);
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    if ($result->stateNo == '') {
    	$stateid = 'empty';
    }else{
    	$stateid = $result->stateNo;
    }
   	$db->StateIDs($result->id, $stateid);

   	 	//count for battalion and council
   	$query = "SELECT * FROM countForMe WHERE control_id = ? AND company = ? ";
    $stmt = $db->_pdo->prepare($query);
    $stmt->execute([$officer->officer_id, $officer->officers_company_code]);
    $countThis = $stmt->rowCount();
    if ($countThis) {
    	$update = "UPDATE countForMe SET noOfPatrons = noOfPatrons + 1 WHERE control_id = ?";
    	$stmt = $db->_pdo->prepare($update);
    	$stmt->execute([$officer->officer_id]);
    }else{
    	$insert = "INSERT INTO countForMe (control_id, company, council, noOfPatrons) VALUES (?,?,?, 1) ";
    	$stmt = $db->_pdo->prepare($insert);
    	$stmt->execute([$officer->officer_id, $companyCode, $council]);
    }
   	echo 'true';
   }else{
   	echo 'false';
   }

   
}


//Fetch mothersAjax request
if (isset($_POST['action']) && $_POST['action'] == 'display_patrons') {
  $output = '';
  $userid = $officer->officer_id;
  $patrons =  $db->getDataForm('DataFormPatrons', 'control_id', $userid);
  if (!$patrons) {
    echo '<h3 class="text-center text-secondary">No Data in the database!</h3>';
  }else{
    $output .= '
    <table id="showMothers" class="table table-striped table-sm">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>State ID</th>
          <th>Qualification</th>
          <th>Year Of Last Training</th>
          <th>Update State ID </th>

        </tr>
        <tbody>
    ';
    $x = 0;
    foreach ($patrons as $patron) {
      $x = $x + 1;
      if ($patron->stateNo == '') {
      	$report = '<span class="text-danger">No State ID Yet</span>';
      	$hasNow = '<a href="#" data-toggle="modal" data-target="#updateStateIDMother" id="'.$patron->id.'" class="btn btn-block btn-success hasIDMotherBtn">Has State ID Now<a/>';

      }else{
      	$report = $patron->stateNo;
      	$hasNow = '<span class="btn btn-danger">Can\'t Update!</span>';

      }
      if ($patron->Qualification == '') {
      	$qua = '<span class="text-danger">No Qualification</span>';
      	

      }else{
      	$qua = $patron->Qualification;

      }
      if ($patron->LastTraining == '0000') {
      	$year = '<span class="text-danger">No Training</span>';
      	
      }else{
      	$year = pretty_dated($patron->LastTraining);

      }
      

    $output .= '
    <tr>
      <td>'.$x.'</td>
      <td>'.$patron->Name.'</td>
      <td>'.$report.'</td>
      <td>'.$qua.'</td>
      <td>'.$year.'</td>
      <td>'.$hasNow.'</td>

     
    </tr>
    ';

    }
    $output .='
    </tbody>
  </thead>
</table>
    ';
    echo $output;
  }

}



//select state id 
if (isset($_POST['boy_id'])) {
	$boyid = (int)$_POST['boy_id'];

	$get = $db->getById('DataFormBoys', 'id', $boyid);
	if ($get) {
		echo json_encode($get);
	}


}

if (isset($_POST['action']) && $_POST['action'] == 'update_stateID') {
	$boyid = (int)$_POST['updateID'];
	$stateID = $_POST['idUpdate'];

	if (empty($_POST['idUpdate'])) {
		echo $db->showMessage('danger', 'State ID is required!');
		return false;
}

if (empty($_POST['updateID'])) {
		echo $db->showMessage('danger', 'Becareful!');
		return false;
}

	$checkSource  = $db->checkStateID('officers', $stateID);
	$check  = $db->checkStateID('AllStateIDs', $stateID);

	if (!$checkSource) {
		echo $db->showMessage('danger', 'State ID not Found!');
		return false;
	}else{
		if ($check) {
			echo $db->showMessage('danger', 'The ID belongs  to another officer!');
		return false;
		}
	}
	$update = $db->updateState('DataFormBoys', 'stateNo', $stateID, $boyid);
	if ($update) {
		echo 'true';
	}else{
		return false;
	}
}


//select state id 
if (isset($_POST['officer_id'])) {
	$officerid = (int)$_POST['officer_id'];

	$get = $db->getById('DataFormOfficers', 'id', $officerid);
	if ($get) {
		echo json_encode($get);
	}


}

if (isset($_POST['action']) && $_POST['action'] == 'update_stateIDOfficer') {
	$officerid = (int)$_POST['updateIDOfficer'];
	$stateID = $_POST['idUpdateOfficer'];

	if (empty($_POST['idUpdateOfficer'])) {
		echo $db->showMessage('danger', 'State ID is required!');
		return false;
}

if (empty($_POST['updateIDOfficer'])) {
		echo $db->showMessage('danger', 'Becareful!');
		return false;
}

	$checkSource  = $db->checkStateID('officers', $stateID);
	$check  = $db->checkStateID('AllStateIDs', $stateID);

	if (!$checkSource) {
		echo $db->showMessage('danger', 'State ID not Found!');
		return false;
	}
	if ($check) {
	echo $db->showMessage('danger', 'The ID belongs  to another officer!');
		return false;
}

	$update = $db->updateState('DataFormOfficers', 'stateNo', $stateID, $officerid);
	if ($update) {
		echo 'true';
	}else{
		return false;
	}
}








//Fetch mothersAjax request
if (isset($_POST['action']) && $_POST['action'] == 'display_summary') {
  $output = '';
  $userid = $officer->officer_id;
  date_default_timezone_set('Africa/Lagos');
  $date = date('M d, Y h:i A');
 
  $sqlDate = "UPDATE  DataFormInfo SET dateSum = '$date' WHERE controller_id = ?";
  $stmt = $db->_pdo->prepare($sqlDate);
  $stmt->execute([$userid]);
  $rowInfoDate = $stmt->fetch(PDO::FETCH_OBJ);


  $boys =  $db->totalCount('DataFormBoys',  $userid);
  $officers =  $db->totalCount('DataFormOfficers', $userid);
  $patrons =  $db->totalCount('DataFormPatrons', $userid);
  $mothers =  $db->totalCount('DataFormMothers',  $userid);


  $sql = "SELECT * FROM DataFormInfo WHERE controller_id = ?";
  $stmt = $db->_pdo->prepare($sql);
  $stmt->execute([$userid]);
  $rowInfo = $stmt->fetch(PDO::FETCH_OBJ);

  	$output .= '
  		NAME OF CHURCH: <span class="text-info">'. $rowInfo->church.'</span><br>
  		COMPANY NO.: <span class="text-info">'. $rowInfo->company.'</span><br>
  		BATTALION/GROUP COUNCIL.: <span class="text-info">'. $rowInfo->council.'</span><br>

  	';
  	
$output .='<hr>';
    $output .= '
    <table id="showSummaries" class="table table-striped table-sm">
    
        <tr>
        <th>#</th>
          <th></th>
          <td>TOTAL NUMBER</td>
        </tr>

        <tr class="bg-info text-light">
        <th>1</th>
          <th>NO OF BOYS</th>
          <td>'.$boys.'</td>
        </tr>
        <tr class="bg-success text-light">
     	<th>2</th>
          <th>NO OF OFFICERS</th>
          <td>'.$officers.'</td>
        </tr>
         <tr class="bg-primary text-light">
     	<th>3</th>
          <th>NO OF MOTHERS</th>
          <td>'.$mothers.'</td>
        </tr>
         <tr class="bg-warning text-light">
     	<th>4</th>
          <th>NO OF PATRONS</th>
          <td>'.$patrons.'</td>
        </tr>

        <table>
    ';
 $output .='<hr>';

 $signOfficer = '<img src="../uploads/dataForm/'.$rowInfo->signatureOfficer.'" alt="Preview"  class="img-fluid" width="108">';
 $dateOfficer = pretty_dates($rowInfo->dateSum);

  $signChaplian = '<img src="../uploads/dataForm/'.$rowInfo->signatureChaplain.'" alt="Preview"  class="img-fluid " width="108">';
 $dateChaplian = pretty_dates($rowInfo->dateSum);

 $output .= '
  		NAME OF REPORTING  OFFICER: <span class="text-info">'. $rowInfo->officer_name.'</span><br>
  		DESIGNATION OF REPORTING OFFICER.: <span class="text-info">'. $rowInfo->office.'</span><br>
  		SIGNATURE AND DATE.: <span class="text-info">'.$signOfficer.' '.$dateOfficer.'</span><br>
  		NAME OF CHAPLAIN.: <span class="text-info">'. $rowInfo->Chaplian.'</span><br>
  		SIGNATURE AND DATE.: <span class="text-info">'.$signChaplian.' '.$dateChaplian.'</span>

  	';
  	
$output .= '<hr>';
  
  $output .= '
  <span class="text-danger text-center">Be Sure your report is complete before sending</span><hr>
  <button class="btn btn-block btn-danger btn-lg sendToCouncil"><i class="fa fa-upload fa-lg"></i>Send To Group Council</button>
  ';
    
    echo $output;
  
}

//Fetch mothersAjax request
if (isset($_POST['action']) && $_POST['action'] == 'display_council_level') {
  $output = '';
  $userCouncil = $officer->officers_group_council;

  $sql = "SELECT * FROM countForMe WHERE council = '$userCouncil'";
  $stmt = $db->_pdo->prepare($sql);
  $stmt->execute();
  $com = $stmt->fetchAll(PDO::FETCH_OBJ);


  if (!$com) {
    echo '<h3 class="text-center text-secondary">No Data in the database!</h3>';
  }else{
    $output .= '
    <table id="showMothers" class="table table-striped table-sm">
      <thead>
        <tr>
          <th>#</th>
          <th>Company Name</th>
          <th>NO OF BOYS</th>
          <th>NO OF OFFICER</th>
          <th>NO OF PATRONS</th>
          <th>NO OF MOTHERS </th>
        </tr>
        <tbody>
    ';
    $x = 0;
    foreach ($com as $owner) {
      $x = $x + 1;
    $output .= '
    <tr>
      <td>'.$x.'</td>
      <td>'.$owner->company.'</td>
 		<td>'.$owner->noOfBoys.'</td>
 		<td>'.$owner->noOfOfficers.'</td>
 		<td>'.$owner->noOfPatrons.'</td>
 		<td>'.$owner->noOfMothers.'</td>

     
    </tr>
    ';

    }
    $output .='
    </tbody>
  </thead>
</table>
    ';
    echo $output;
  }

}

//Fetch mothersAjax request
if (isset($_POST['action']) && $_POST['action'] == 'display_council_summary') {
  $output = '';
  $userid = $officer->officer_id;
  $userCouncil = $officer->officers_group_council;
  date_default_timezone_set('Africa/Lagos');
  $date = date('M d, Y h:i A');
  $sql = "UPDATE  DataFormInfo SET dateGenerated = '$date' WHERE council  = ?";
  $stmt = $db->_pdo->prepare($sql);
  $stmt->execute([$userCouncil]);
  $rowInfo = $stmt->fetch(PDO::FETCH_OBJ);


  $boysql = "SELECT SUM(`noOfBoys`) AS 'Total_boys' FROM countForMe WHERE council = '$userCouncil'";
  $cu = $db->_pdo->prepare($boysql);
  $cu->execute();
  $boy = $cu->fetch(PDO::FETCH_OBJ);

  $patronSql= "SELECT SUM(`noOfPatrons`) AS 'Total_patrons' FROM countForMe WHERE council = '$userCouncil'";
  $cu = $db->_pdo->prepare($patronSql);
  $cu->execute();
  $patron = $cu->fetch(PDO::FETCH_OBJ);

  $officerSql = "SELECT SUM(`noOfOfficers`) AS 'Total_officers' FROM countForMe WHERE council = '$userCouncil'";
  $cus = $db->_pdo->prepare($officerSql);
  $cus->execute();
  $office = $cus->fetch(PDO::FETCH_OBJ);

  $motherSql = "SELECT SUM(`noOfMothers`) AS 'Total_mothers' FROM countForMe WHERE council = '$userCouncil'";
  $cu = $db->_pdo->prepare($motherSql);
  $cu->execute();
  $mother = $cu->fetch(PDO::FETCH_OBJ);


  $sql = "SELECT * FROM DataFormInfo WHERE controller_id = ?";
  $stmt = $db->_pdo->prepare($sql);
  $stmt->execute([$userid]);
  $rowInfo = $stmt->fetch(PDO::FETCH_OBJ);


  $submitState = "SELECT * FROM submittedDataForm WHERE council = '$userCouncil'";
  $sub = $db->_pdo->prepare($submitState);
  $sub->execute();
  $there = $sub->rowCount();

  if ($there) {
     $sql = "UPDATE submittedDataForm SET council = ?, officer_name = ?, designation = ?, Chaplian = ?, signtureOfficer = ? , signatureChaplain = ?, noOfOfficers = ?, noOfBoys = ?,noOfMothers = ?,noOfPatrons = ? WHERE council = ? ";
    $stmt = $db->_pdo->prepare($sql);
    $stmt->execute([$rowInfo->council, $rowInfo->officer_name, $rowInfo->office,$rowInfo->Chaplian, $rowInfo->signatureOfficer, $rowInfo->signatureChaplain,$office->Total_officers,$boy->Total_boys,$mother->Total_mothers, $patron->Total_patrons, $userCouncil]);
  }else{
    $sql = "INSERT INTO submittedDataForm (council, officer_name, designation, Chaplian, signtureOfficer , signatureChaplain, noOfOfficers, noOfBoys,noOfMothers,noOfPatrons) VALUES (?,?,?,?,?,?,?,?,?,?)";
    $stmt = $db->_pdo->prepare($sql);
    $stmt->execute([$rowInfo->council, $rowInfo->officer_name, $rowInfo->office, $rowInfo->Chaplian, $rowInfo->signatureOfficer, $rowInfo->signatureChaplain, $office->Total_officers,$boy->Total_boys,$mother->Total_mothers, $patron->Total_patrons ]);
  } 


  	$output .= '
  		BATTALION/GROUP COUNCIL.: <span class="text-info">'. $rowInfo->council.'</span><br>

  	';
  	
$output .='<hr>';
    $output .= '
    <table id="showSummaries" class="table table-striped table-sm">
    
        <tr>
        <th>#</th>
          <th></th>
          <td>TOTAL NUMBER</td>
        </tr>

        <tr class="bg-info text-light">
        <th>1</th>
          <th>NO OF BOYS</th>
          <td>'.$boy->Total_boys.'</td>
        </tr>
        <tr class="bg-success text-light">
     	<th>2</th>
          <th>NO OF OFFICERS</th>
          <td>'.$office->Total_officers.'</td>
        </tr>
         <tr class="bg-primary text-light">
     	<th>3</th>
          <th>NO OF MOTHERS</th>
          <td>'.$mother->Total_mothers.'</td>
        </tr>
         <tr class="bg-warning text-light">
     	<th>4</th>
          <th>NO OF PATRONS</th>
          <td>'.$patron->Total_patrons.'</td>
        </tr>

        <table>
    ';
 $output .='<hr>';

 $signOfficer = '<img src="../uploads/dataForm/'.$rowInfo->signatureOfficer.'" alt="Preview"  class="img-fluid" width="108">';
 $dateOfficer = pretty_dates($rowInfo->dateSum);

  $signChaplian = '<img src="../uploads/dataForm/'.$rowInfo->signatureChaplain.'" alt="Preview"  class="img-fluid " width="108">';
 $dateChaplian = pretty_dates($rowInfo->dateSum);

 $output .= '
  		NAME OF REPORTING  OFFICER: <span class="text-info">'. $rowInfo->officer_name.'</span><br>
  		DESIGNATION OF REPORTING OFFICER.: <span class="text-info">'. $rowInfo->office.'</span><br>
  		SIGNATURE AND DATE.: <span class="text-info">'.$signOfficer.' '.$dateOfficer.'</span><br>
  		NAME OF CHAPLAIN.: <span class="text-info">'. $rowInfo->Chaplian.'</span><br>
  		SIGNATURE AND DATE.: <span class="text-info">'.$signChaplian.' '.$dateChaplian.'</span>

  	';

   $output .= '<hr>';
  
  $output .= '
  <span class="text-danger text-center">Be Sure your report is complete before sending</span><hr>
  <button class="btn btn-block btn-danger btn-lg sendToState"><i class="fa fa-upload fa-lg"></i>Send To State Council</button>
  ';
  	
    echo $output;
  
}
