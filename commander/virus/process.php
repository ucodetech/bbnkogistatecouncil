<?php
require_once  '../../core/init.php';
$general = new General();
if (isset($_GET['export']) && $_GET['export'] == 'officers') {
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=officers.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    $data = $general->exportAllTables('officers', 'officers_group_council');
    echo '<table border="1" align="center">';
    echo '<tr>
            <th>#</th>
            <th>Name</th>
            <th>E-Mail</th>
            <th>Phone Number</th>
            <th>DOB</th>
            <th>Gender</th>
            <th>Username</th>
            <th>Verified</th>
            <th>Company Number</th>
            <th>Church</th>
            <th>Rank</th>
            <th>Designation Company</th>
            <th>Designation Council</th>
            <th>Permissions</th>
            <th>Group Council</th>
            <th>LGA</th>
            <th>Joined On</th>
            <th>Last Login</th>
            <th>Deleted</th>
          </tr>';
      foreach ($data as $row) {
        echo '<tr>
                <td>'.$row->officer_id.'</td>
                <td>'.$row->officers_name.'</td>
                <td>'.$row->officers_email.'</td>
                <td>'.$row->officers_phone_no.'</td>
                <td>'.$row->officers_dob.'</td>
                <td>'.$row->officers_gender.'</td>
                <td>'.$row->officers_username.'</td>
                <td>'.$row->verified.'</td>
                 <td>'.$row->officers_company_code.'</td>
                <td>'.$row->officers_home_church.'</td>
                <td>'.$row->officers_rank.'</td>
                <td>'.$row->designation_company.'</td>
                <td>'.$row->designation_council.'</td>
                <td>'.$row->officers_permissions.'</td>
                <td>'.$row->officers_group_council.'</td>
                <td>'.$row->officers_lga.'</td>
                <td>'.pretty_date($row->date_joined).'</td>
                <td>'.timeAgo($row->last_login).'</td>
                <td>'.$row->deleted.'</td>
              </tr>';
      }
    echo  '</table>';
}



if (isset($_GET['export']) && $_GET['export'] == 'dataBoys') {
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=dataFormBoys.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    $data = $general->exportAllTables('DataFormBoys', 'groupCouncil');
    echo '<table border="1" align="center">';
    echo '<tr>
            <th>#</th>
            <th>Name</th>
            <th>State No</th>
            <th>Qualification</th>
            <th>Year Of LAst Training</th>
            <th>Has State Id</th>
            <th>Company</th>
            <th>Group Council</th>

          </tr>';
      foreach ($data as $row) {
      	if ($row->Qualification == '') {
      		$sure = 'No Qualification';
      	}else{
      		$sure = $row->Qualification;
      	}

      	if ($row->LastTraining == '0000') {
      		$stead = 'No Training';
      	}else{
      		$stead = $row->LastTraining;
      	}

      	if ($row->stateNo == '') {
      		$state = 'No ID';
      	}else{
      		$state = $row->stateNo;
      	}

      	if ($row->hasStateID == 0) {
      		$has = 'No';
      	}else{
      		$has = 'Yes';
      	}


        echo '<tr>
       		   <td>'.$row->id.'</td>
                <td>'.$row->Name.'</td>
                <td>'.$state.'</td>
                <td>'.$sure .'</td>
                <td>'.$stead.'</td>
                <td>'.$has.'</td>
                <td>'.$row->company.'</td>
                <td>'.$row->groupCouncil.'</td>
              </tr>';
      }
    echo  '</table>';
}


if (isset($_GET['export']) && $_GET['export'] == 'dataOfficers') {
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=dataFormOfficers.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    $data = $general->exportAllTables('DataFormOfficers', 'groupCouncil');
    echo '<table border="1" align="center">';
    echo '<tr>
            <th>#</th>
            <th>Name</th>
            <th>State No</th>
            <th>Qualification</th>
            <th>Year Of Last Training</th>
            <th>Has State Id</th>
            <th>Company</th>
            <th>Group Council</th>

          </tr>';
      foreach ($data as $row) {
      	if ($row->Qualification == '') {
      		$sure = 'No Qualification';
      	}else{
      		$sure = $row->Qualification;
      	}

      	if ($row->LastTraining == '0000') {
      		$stead = 'No Training';
      	}else{
      		$stead = $row->LastTraining;
      	}

      	if ($row->stateNo == '') {
      		$state = 'No ID';
      	}else{
      		$state = $row->stateNo;
      	}

      	if ($row->hasStateID == 0) {
      		$has = 'No';
      	}else{
      		$has = 'Yes';
      	}


        echo '<tr>
       		   <td>'.$row->id.'</td>
                <td>'.$row->Name.'</td>
                <td>'.$state.'</td>
                <td>'.$sure .'</td>
                <td>'.$stead.'</td>
                <td>'.$has.'</td>
                <td>'.$row->company.'</td>
                <td>'.$row->groupCouncil.'</td>
              </tr>';
      }
    echo  '</table>';
}


if (isset($_GET['export']) && $_GET['export'] == 'dataMothers') {
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=dataFormMothers.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    $data = $general->exportAllTables('DataFormMothers', 'groupCouncil');
    echo '<table border="1" align="center">';
    echo '<tr>
            <th>#</th>
            <th>Name</th>
            <th>State No</th>
            <th>Qualification</th>
            <th>Year Of Last Training</th>
            <th>Has State Id</th>
            <th>Company</th>
            <th>Group Council</th>

          </tr>';
      foreach ($data as $row) {
      	if ($row->Qualification == '') {
      		$sure = 'No Qualification';
      	}else{
      		$sure = $row->Qualification;
      	}

      	if ($row->LastTraining == '0000') {
      		$stead = 'No Training';
      	}else{
      		$stead = $row->LastTraining;
      	}

      	if ($row->stateNo == '') {
      		$state = 'No ID';
      	}else{
      		$state = $row->stateNo;
      	}

      	if ($row->hasStateID == 0) {
      		$has = 'No';
      	}else{
      		$has = 'Yes';
      	}


        echo '<tr>
       		   <td>'.$row->id.'</td>
                <td>'.$row->Name.'</td>
                <td>'.$state.'</td>
                <td>'.$sure .'</td>
                <td>'.$stead.'</td>
                <td>'.$has.'</td>
                <td>'.$row->company.'</td>
                <td>'.$row->groupCouncil.'</td>
              </tr>';
      }
    echo  '</table>';
}


if (isset($_GET['export']) && $_GET['export'] == 'dataPatrons') {
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=dataFormPatrons.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    $data = $general->exportAllTables('DataFormPatrons', 'groupCouncil');
    echo '<table border="1" align="center">';
    echo '<tr>
            <th>#</th>
            <th>Name</th>
            <th>State No</th>
            <th>Qualification</th>
            <th>Year Of Last Training</th>
            <th>Has State Id</th>
            <th>Company</th>
            <th>Group Council</th>

          </tr>';
      foreach ($data as $row) {
      	if ($row->Qualification == '') {
      		$sure = 'No Qualification';
      	}else{
      		$sure = $row->Qualification;
      	}

      	if ($row->LastTraining == '0000') {
      		$stead = 'No Training';
      	}else{
      		$stead = $row->LastTraining;
      	}

      	if ($row->stateNo == '') {
      		$state = 'No ID';
      	}else{
      		$state = $row->stateNo;
      	}

      	if ($row->hasStateID == 0) {
      		$has = 'No';
      	}else{
      		$has = 'Yes';
      	}


        echo '<tr>
       		   <td>'.$row->id.'</td>
                <td>'.$row->Name.'</td>
                <td>'.$state.'</td>
                <td>'.$sure .'</td>
                <td>'.$stead.'</td>
                <td>'.$has.'</td>
                <td>'.$row->company.'</td>
                <td>'.$row->groupCouncil.'</td>
              </tr>';
      }
    echo  '</table>';
}

if (isset($_GET['export']) && $_GET['export'] == 'controls') {
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=dataFormControlInfo.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    $data = $general->exportAllTables('DataFormInfo', 'council');
    echo '<table border="1" align="center">';
    echo '<tr>
            <th>#</th>
            <th>Officer Reporting Name</th>
            <th>Church</th>
            <th>Designation</th>
            <th>Area council</th>
            <th>Chaplain</th>
            <th>Company</th>
            <th>Group Council</th>
            <th>Date</th>

          </tr>';
      foreach ($data as $row) {


        echo '<tr>
       		   <td>'.$row->id.'</td>
                <td>'.$row->officer_name.'</td>
                <td>'.$row->church.'</td>
                <td>'.$row->office .'</td>
                <td>'.$row->AreaCouncil.'</td>
                <td>'.$row->Chaplian.'</td>
                <td>'.$row->company.'</td>
                <td>'.$row->council.'</td>
                <td>'.pretty_dates($row->dateSum).'</td>

              </tr>';
      }
    echo  '</table>';
}


if (isset($_GET['export']) && $_GET['export'] == 'summary') {
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=dataFormSummary.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    $data = $general->exportAllTables('countForMe', 'council');
    echo '<table border="1" align="center">';
    echo '<tr>
            <th>#</th>
            <th>Company</th>
            <th>Group Council</th>
            <th>NO OF BOYS</th>
            <th>NO OF OFFICERS</th>
            <th>NO OF MOTHERS</th>
            <th>NO OF PATRONS</th>
            <th>Date</th>

          </tr>';
      foreach ($data as $row) {


        echo '<tr>
             <td>'.$row->id.'</td>
                <td>'.$row->company.'</td>
                <td>'.$row->council.'</td>
                <td>'.$row->noOfBoys.'</td>
                <td>'.$row->noOfOfficers.'</td>
                <td>'.$row->noOfMothers.'</td>
                <td>'.$row->noOfPatrons.'</td>
                <td>'.pretty_dates($row->dateGenerated).'</td>

              </tr>';
      }
    echo  '</table>';
}


if (isset($_POST['action']) && $_POST['action'] == 'fetchAllMembers') {


  $data = $general->selectTable2('submittedDataForm', 0, 1);
    $output = '';
    if ($data) {
      $output .= '<table class="table table-striped table-hover" id="show">
        <thead>
          <tr>
            <th>#</th>
            <th>Group Council</th>
            <th>NO OF BOYS</th>
            <th>NO OF OFFICERS</th>
            <th>NO OF MOTHERS</th>
            <th>NO OF PATRONS</th>
            <th>Date</th>
            <th>View Details</th>
          </tr>
        </thead>
        <tbody>';
        $x = 0;
      foreach ($data as $row) {
        $x = $x + 1;
        $output .= '

            <tr>
              <td>'.$row->id.'</td>
                <td>'.$row->council.'</td>
                <td>'.$row->noOfBoys.'</td>
                <td>'.$row->noOfOfficers.'</td>
                <td>'.$row->noOfMothers.'</td>
                <td>'.$row->noOfPatrons.'</td>
                <td>'.pretty_dates($row->dateSubmitted).'</td>
                <td>
               <a href="#" id="'.$row->id.'" title="View Details" class="text-primary reportDetailsIcon" data-toggle="modal" data-target="#showReportDetailsModal"><i class="fas fa-info-circle fa-lg"></i> </a>

                </td>
              </tr>
              ';

        }

                $output .= '
                  </tbody>
                </table>';
                echo $output;
    }else{
      echo '<h3 class="text-center text-secondary lead px-3">No data on the database yet</h3>';
    }
}




if (isset($_POST['council'])) {
  $council = (int)$_POST['council'];
  $data = $general->getById('submittedDataForm', 'id', $council);

  $output = '';
  $output .= '
      BATTALION/GROUP COUNCIL.: <span class="text-info">'. strtoupper($data->council).'</span><br>
    ';

$output .='<hr>';
    $output .= '
    <table class="table table-striped table-sm">

        <tr>
        <th>#</th>
          <th></th>
          <td>TOTAL NUMBER</td>
        </tr>

        <tr>
        <th>1</th>
          <th>NO OF BOYS</th>
          <td>'.$data->noOfBoys.'</td>
        </tr>
        <tr>
      <th>2</th>
          <th>NO OF OFFICERS</th>
          <td>'.$data->noOfOfficers.'</td>
        </tr>
         <tr>
      <th>3</th>
          <th>NO OF MOTHERS</th>
          <td>'.$data->noOfMothers.'</td>
        </tr>
         <tr>
      <th>4</th>
          <th>NO OF PATRONS</th>
          <td>'.$data->noOfPatrons.'</td>
        </tr>

        <table>
    ';
 $output .='<hr>';

   $signOfficer = '<img src="../uploads/dataForm/'.$data->signtureOfficer.'" alt="Preview"  class="img-fluid" width="108">';
   $dateOfficer = pretty_dates($data->dateSubmitted);

    $signChaplian = '<img src="../uploads/dataForm/'.$data->signatureChaplain.'" alt="Preview"  class="img-fluid " width="108">';
   $dateChaplian = pretty_dates($data->dateSubmitted);

   $output .= '
      NAME OF REPORTING  OFFICER: <span class="text-info">'. $data->officer_name.'</span><br>
      DESIGNATION OF REPORTING OFFICER.: <span class="text-info">'. $data->designation.'</span><br>
      SIGNATURE AND DATE.: <span class="text-info">'.$signOfficer.' '.$dateOfficer.'</span><br>
      NAME OF CHAPLAIN.: <span class="text-info">'. $data->Chaplian.'</span><br>
      SIGNATURE AND DATE.: <span class="text-info">'.$signChaplian.' '.$dateChaplian.'</span>

    ';


  echo $output;

}
