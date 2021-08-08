<?php
require_once '../../core/init.php';
//Login
  $general = new General();
  $show = new Show();
  $notify = new Notification();


  if (isset($_POST['action']) && $_POST['action'] == 'add_history') {

       $title = $general->test_input($_POST['history_title']);
       $description = $_POST['history_description'];

       if (empty($_POST['history_title'])) {
         echo $show->showMessage('danger', 'Title is required!','warning');
         return false;
       }

       if (empty($_POST['history_description'])) {
         echo $show->showMessage('danger', 'Introduction is required!','warning');
         return false;
       }

        $general->insertBBHistory('BBHistory', array(
            'bb_title' => $title,
            'bb_description' => $description
        ));
         echo 'success';
   }


  //fetch Histroy
  if(isset($_POST['action']) && $_POST['action'] == 'fetch_history'){
      $output = '';

      $dat = $general->selectHistory('BBHistory');

      if ($dat) {

        $output .= '
        <table class="table table-striped table-hover" id="showHist">
          <thead>
            <tr>
              <th>#</th>
              <th>Title</th>
              <th>Description</th>
              <th>Action</th>

            </tr>
          </thead>
          <tbody>
        ';
        foreach ($dat as $row) {

          $output .= '
              <tr>
                <td>'.$row->id.'</td>

                           <td>'.$row->bb_title.'</td>
                             <td>'.wrap($row->bb_description).'...</td>
                             <td>
                             <a href="#" id="'.$row->id.'" title="View Details" class="text-primary hisDetailsIcon" data-toggle="modal" data-target="#showHisDetailsModal"><i class="fas fa-info-circle fa-lg"></i> </a>&nbsp;

                                  <a href="#" id="'.$row->id.'" title="Edit" class="text-success editHisBtn" data-toggle="modal" data-target="#editHisModal"><i class="fas fa-edit fa-lg"></i> </a>
                             </td>
              </tr>
              ';
        }



        $output .= '
          </tbody>
        </table>';
        echo $output;
      }else{
        echo '<h3 class="text-center text-secondary align-self-center lead">No Data In database</h3>';
      }

  }

//get history by id
if (isset($_POST['his_id'])) {
  $hisid = (int)$_POST['his_id'];
  $output = '';
  $his = $general->getById('BBHistory','id', $hisid);
  if ($his) {

      $output .= '
          <h3>'.$his->bb_title.'</h3> <hr>
          <p class="text-justify text-dark" style="line-height:30px;">'.$his->bb_description.'</p>
      ';

    echo $output;

  }

}

//edit history bb
if (isset($_POST['hisedit_id'])) {
  $editid = (int)$_POST['hisedit_id'];

  $edit = $general->getById('BBHistory','id', $editid);
  if ($edit) {
    echo json_encode($edit);
  }
}

//update history
if (isset($_POST['action']) && $_POST['action'] == 'update_history') {
        $editid = (int)$_POST['editHisID'];
        $title = $_POST['history_title'];
        $description = $_POST['history_description'];

        if (empty($_POST['history_title'])) {
          echo $show->showMessage('danger', 'Title is required!', 'warning');
          return false;
        }

        if (empty($_POST['history_description'])) {
          echo $show->showMessage('danger', 'Introduction is required!', 'warning');
          return false;
        }

      $update = $general->updateHistory('BBHistory',$editid, $title, $description);
      if ($update) {
        echo 'updated';
      }else{
        echo 'Something went wrong';
      }

}


//add history bbn
  if (isset($_POST['action']) && $_POST['action'] == 'add_historybbn') {

       $title = $show->test_input($_POST['history_titlebbn']);
       $description = $_POST['history_descriptionbbn'];

       if (empty($_POST['history_titlebbn'])) {
         echo $show->showMessage('danger', 'Title is required!','warning');
         return false;
       }

       if (empty($_POST['history_descriptionbbn'])) {
         echo $show->showMessage('danger', 'Introduction is required!','warning');
         return false;
       }

       $general->insertBBHistory('BBNHistory', array(
           'bb_title' => $title,
           'bb_description' => $description
       ));
        echo 'success';
      }


  if(isset($_POST['action']) && $_POST['action'] == 'fetch_historybbn'){
      $output = '';

      $dat = $general->selectHistory('BBNHistory');

      if ($dat) {

        $output .= '
        <table class="table table-striped table-hover" id="showHistBBN">
          <thead>
            <tr>
              <th>#</th>
              <th>Title</th>
              <th>Description</th>
              <th>Action</th>

            </tr>
          </thead>
          <tbody>
        ';
        foreach ($dat as $row) {

          $output .= '
              <tr>
                <td>'.$row->id.'</td>

                           <td>'.$row->bb_title.'</td>
                             <td>'.wrap($row->bb_description).'...</td>
                             <td>
                             <a href="#" id="'.$row->id.'" title="View Details" class="text-primary hisBBNDetailsIcon" data-toggle="modal" data-target="#showHisBBNDetailsModal"><i class="fas fa-info-circle fa-lg"></i> </a>&nbsp;

                                  <a href="#" id="'.$row->id.'" title="Edit" class="text-success editHisBBNBtn" data-toggle="modal" data-target="#editHisBBNModal"><i class="fas fa-edit fa-lg"></i> </a>
                             </td>
              </tr>
              ';
        }



        $output .= '
          </tbody>
        </table>';
        echo $output;
      }else{
        echo '<h3 class="text-center text-secondary align-self-center lead">No Data In database</h3>';
      }

  }

//get history by id
if (isset($_POST['hisbbn_id'])) {
  $hisbbnid = (int)$_POST['hisbbn_id'];
  $output = '';
  $his = $general->getById('BBNHistory','id', $hisbbnid);
  if ($his) {

      $output .= '
          <h3>'.$his->bb_title.'</h3> <hr>
          <p class="text-justify text-dark" style="line-height:30px;">'.$his->bb_description.'</p>
      ';

    echo $output;

  }

}

//edit history bb
if (isset($_POST['hiseditbbn_id'])) {
  $editidbbn = (int)$_POST['hiseditbbn_id'];

  $editbb = $general->getById('BBNHistory','id', $editidbbn);
  if ($editbb) {
    echo json_encode($editbb);
  }else{
    echo 'no data';
  }
}

if (isset($_POST['action']) && $_POST['action'] == 'update_historybbn') {
        $editid = (int)$_POST['editHisbbnID'];
        $title = $_POST['history_titlebbn'];
        $description = $_POST['history_descriptionbbn'];

        if (empty($_POST['history_titlebbn'])) {
          echo $show->showMessage('danger', 'Title is required!','warning');
          return false;
        }

        if (empty($_POST['history_descriptionbbn'])) {
          echo $show->showMessage('danger', 'Introduction is required!','warning');
          return false;
        }

      $update = $general->updateHistory('BBNHistory',$editid, $title, $description);
      if ($update) {
        echo 'updated';
      }else{
        echo 'Something went wrong';
      }

}

//add history bbn
if (isset($_POST['action']) && $_POST['action'] == 'add_historybbnstate') {

 $title = $_POST['history_titlebbnstate'];
 $description = $_POST['history_descriptionbbnstate'];
 $formation_creation =$_POST['formation_creation'];
 $other_appoint = $_POST['other_appoint'];
 $secretariat = $_POST['secretariat'];
 $events = $_POST['events'];
 $generalInfo = $_POST['generalInfo'];

  $required = array(
              'history_titlebbnstate',
               'history_descriptionbbnstate',
               'formation_creation',
               'other_appoint',
               'secretariat',
               'events',
               'generalInfo'
             ) ;
    foreach ($required as $fields) {
    if (empty($_POST[$fields])) {
        echo $show->showMessage('danger', 'All Fields Are required! check carefully','warning');
        return false;
    }

    }

   $add = $general->insertBBNHistory($title, $description,$formation_creation
  ,$other_appoint,$secretariat ,$events,$generalInfo);
   if ($add) {
     echo 'success';
   }
  }

  if(isset($_POST['action']) && $_POST['action'] == 'fetch_historybbnstate'){
      $output = '';

      $dat = $general->selectHistory('BBStateHistory');

      if ($dat) {

        $output .= '
        <table class="table table-striped table-hover" id="showHistBBNState">
          <thead>
            <tr>
              <th>#</th>
              <th>Title</th>
              <th>Description</th>
              <th>Action</th>

            </tr>
          </thead>
          <tbody>
        ';
        foreach ($dat as $row) {

          $output .= '
              <tr>
                <td>'.$row->id.'</td>

                           <td>'.wrap3($row->bb_title).'...</td>
                             <td>'.wrap3($row->bb_description).'...</td>
                             <td>
                             <a href="#" id="'.$row->id.'" title="View Details" class="text-primary hisBBNstateDetailsIcon" data-toggle="modal" data-target="#showHisBBNstateDetailsModal"><i class="fas fa-info-circle fa-lg"></i> </a>&nbsp;

                          <a href="#" id="'.$row->id.'" title="Edit" class="text-success editHisBBNstateBtn" data-toggle="modal" data-target="#editHisBBNstateModal"><i class="fas fa-edit fa-lg"></i> </a>
                             </td>
              </tr>
              ';
        }



        $output .= '
          </tbody>
        </table>';
        echo $output;
      }else{
        echo '<h3 class="text-center text-secondary align-self-center lead">No Data In database</h3>';
      }

  }

//get history by id
if (isset($_POST['hisstate_id'])) {
  $hid = (int)$_POST['hisstate_id'];
  $output = '';
  $his = $general->getById('BBStateHistory','id', $hid);
  if ($his) {

      $output .= '
          <h3>'.$his->bb_title.'</h3> <hr>
          <p class="text-justify text-dark" style="line-height:30px;">'.$his->bb_description.'</p>
          <p class="text-justify text-dark" style="line-height:30px;" >'.nl2br($his->formation_creation).'</p>
          <p class="text-justify text-dark" style="line-height:30px;" >'.nl2br($his->other_apointees_reps).'</p>
          <p class="text-justify text-dark" style="line-height:30px;" >'.nl2br($his->secretariat).'</p>
          <p class="text-justify text-dark" style="line-height:30px;" >'.nl2br($his->events).'</p>
          <p class="text-justify text-dark" style="line-height:30px;" >'.nl2br($his->general_info).'</p>
      ';

    echo $output;


  }

}

//edit history bb
if (isset($_POST['editbbn_id'])) {
  $editidbbn = (int)$_POST['editbbn_id'];

  $editbb = $general->getById('BBStateHistory','id', $editidbbn);
  if ($editbb) {
    echo json_encode($editbb);
  }else{
    echo 'no data';
  }
}

if (isset($_POST['action']) && $_POST['action'] == 'update_state') {
         $editid = (int)$_POST['editstateID'];
         $title = $_POST['history_titlestate'];
         $description = $_POST['history_descriptionstate'];
         $formation_creation =$_POST['formation_creation'];
         $other_appoint = $_POST['other_appoint'];
         $secretariat = $_POST['secretariat'];
         $events = $_POST['events'];
         $generalInfo = $_POST['generalInfo'];
         $required = array(
                     'history_titlestate',
                      'history_descriptionstate',
                      'formation_creation',
                      'other_appoint',
                      'secretariat',
                      'events',
                      'generalInfo'
                    ) ;
           foreach ($required as $fields) {
           if (empty($_POST[$fields])) {
               echo $show->showMessage('danger', 'All Fields Are required! check carefully','warning');
               return false;
           }

           }

      $update = $general->updateKSC($editid,$title, $description,$formation_creation ,$other_appoint,$secretariat ,$events,$generalInfo);
      if ($update) {
        echo 'updated';
      }else{
        echo 'Something went wrong';
      }

}

if (isset($_POST['action']) && $_POST['action'] == 'add_tofficer') {
  $introduction = $show->test_input($_POST['introduction']);
  $tofficer_qua = $show->test_input($_POST['tofficer_qua']);
  $tofficer_name = $show->test_input($_POST['tofficer_name']);

  if (empty($_POST['tofficer_name'])) {
      echo $show->showMessage('danger', 'Training Officers Name is Required!','warning');
      return false;
  }
  if (empty($_POST['tofficer_qua'])) {
      echo $show->showMessage('danger', 'Training Officers qualification is Required!','warning');
      return false;
  }

  $add = $general->insertTrainingOfficers($introduction,  $tofficer_name, $tofficer_qua);
  if ($add) {
    echo 'success';
  }

}

if(isset($_POST['action']) && $_POST['action'] == 'fetch_training'){
    $output = '';
    $data = $general->selectTable('BBStateCouncilsTofficers', 0);

    if ($data) {

      $output .= '
      <table class="table table-striped table-hover" id="showTOfficers">
        <thead>
          <tr>
            <th>#</th>
            <th>Officers Name</th>
            <th>Officers Qualification</th>
            <th>Action</th>

          </tr>
        </thead>
        <tbody>
      ';

      foreach ($data as $row) {
        $output .='
            <p class="text-center text-dark">'.nl2br($row->introduction).'</p>
        ';
        $output .= '
            <tr>
              <td>'.$row->id.'</td>
             <td>'.$row->officer_name.'</td>
             <td>'.$row->officer_qualification.'</td>

         <td>
         <a href="#" id="'.$row->id.'" title="View Details" class="text-primary tofficerDetailsIcon"><i class="fas fa-info-circle fa-lg"></i> </a>&nbsp;

          <a href="#" id="'.$row->id.'" title="Edit" class="text-success editTofficer" data-toggle="modal" data-target="#editTofficerModal"><i class="fas fa-edit fa-lg"></i> </a>&nbsp;

          <a href="#" id="'.$row->id.'" title="Trash" class="text-danger trashTofficerIcon" ><i class="fas fa-recycle fa-lg"></i> </a>
         </td>
            </tr>
            ';
      }



      $output .= '
        </tbody>
      </table>';
      echo $output;
    }else{
      echo '<h3 class="text-center text-secondary align-self-center lead">No Data In database</h3>';
    }

}


//get training officer by id
if (isset($_POST['officerTid_id'])) {
  $Tid = (int)$_POST['officerTid_id'];
  $output = '';
  $Tofficer = $general->getById('BBStateCouncilsTofficers','id', $Tid);
  if ($Tofficer) {

    echo json_encode($Tofficer);

  }

}

//edit history bb
if (isset($_POST['teditid'])) {
  $officerid = (int)$_POST['teditid'];

  $editbb = $general->getById('BBStateCouncilsTofficers','id', $officerid);
  if ($editbb) {
    echo json_encode($editbb);
  }else{
    echo 'no data';
  }
}

if (isset($_POST['action']) && $_POST['action'] == 'update_officerT') {
         $editid = (int)$_POST['editTofficerID'];
         $introduction = $show->test_input($_POST['editintroduction']);
         $tofficer_qua = $show->test_input($_POST['editofficer_qua']);
         $tofficer_name = $show->test_input($_POST['tofficer_name']);

         if (empty($_POST['tofficer_name'])) {
             echo $show->showMessage('danger', 'Training Officers Name is Required!','warning');
             return false;
         }
         if (empty($_POST['editofficer_qua'])) {
             echo $show->showMessage('danger', 'Training Officers qualification is Required!','warning');
             return false;
         }

         $update = $general->updateTrainingOfficers($editid, $introduction,  $tofficer_name, $tofficer_qua);
      if ($update) {
        echo 'updated';
      }else{
        echo 'Something went wrong';
      }

}

//trash officer
if (isset($_POST['toffier_trash_id'])) {
    $del_id = (int)$_POST['toffier_trash_id'];
    $general->trashUpdate('BBStateCouncilsTofficers', 1, $del_id);
}

//group councils
if (isset($_POST['action']) && $_POST['action'] == 'add_group_council') {
  $introduction = $_POST['introduction'];
  $council_name = $show->test_input($_POST['council_name']);

  if (empty($_POST['council_name'])) {
      echo $show->showMessage('danger', 'Council  Name is Required!','warning');
      return false;
  }

$check = $general->checkTable($council_name);
if ($check) {
  echo $show->showMessage('danger', $council_name.'  already Exist in the database!','warning');
  return false;
}else{

  $add = $general->insertGroupCouncils($introduction,  $council_name);
  if ($add) {
    echo 'success';
  }
}
}

if(isset($_POST['action']) && $_POST['action'] == 'fetch_groupCouncil'){
    $output = '';
    $data = $general->selectTable('BBStateCouncils', 0);

    if ($data) {
      $query = "SELECT * FROM BBStateCouncils WHERE introduction != '' AND  deleted = 0 ";
        $stmt = Database::getInstance()->query($query);
        $result = $stmt->results();
      foreach ($result as $into) {
        $output .='
            <p class="text-center text-dark">ID: '.$into->id.' - '.nl2br($into->introduction).'</p>
        ';
      }
      $output .= '
      <table class="table table-striped table-hover" id="showCouncil">
        <thead>
          <tr>
            <th>#</th>
            <th>Group Council Name</th>
            <th>Action</th>

          </tr>
        </thead>
        <tbody>
      ';

      foreach ($data as $row) {

        $output .= '
            <tr>
              <td>'.$row->id.'</td>
             <td>'.$row->council_name.'</td>

         <td>
          <a href="#" id="'.$row->id.'" title="Edit" class="text-success editGroupCouncil" data-toggle="modal" data-target="#editGroupCouncilModal"><i class="fas fa-edit fa-lg"></i> </a>&nbsp;

          <a href="#" id="'.$row->id.'" title="Trash" class="text-danger trashGroupCouncilIcon" ><i class="fas fa-recycle fa-lg"></i> </a>
         </td>
            </tr>
            ';
      }



      $output .= '
        </tbody>
      </table>';
      echo $output;
    }else{
      echo '<h3 class="text-center text-secondary align-self-center lead">No Data In database</h3>';
    }

}


//get training officer by id
// if (isset($_POST['ocouncilid_id'])) {
//   $Tid = (int)$_POST['councilid_id'];
//   $output = '';
//   $Tofficer = $general->getById('BBStateCouncils','id', $Tid);
//   if ($Tofficer) {
//
//     echo json_encode($Tofficer);
//
//   }
//
// }

//edit history bb
if (isset($_POST['groupid'])) {
  $councilid = (int)$_POST['groupid'];

  $editbb = $general->getById('BBStateCouncils','id', $councilid);
  if ($editbb) {
    echo json_encode($editbb);
  }else{
    echo 'no data';
  }
}

if (isset($_POST['action']) && $_POST['action'] == 'update_council') {
         $editid = (int)$_POST['groupID'];
         $introduction = $show->test_input($_POST['introduction']);
         $council_name = $show->test_input($_POST['council_name']);

         if (empty($_POST['council_name'])) {
             echo $show->showMessage('danger', 'Council Name is Required!', 'warning');
             return false;
         }

         $update = $general->updateGroupCouncil($editid,$introduction,  $council_name);
      if ($update) {
        echo 'updated';
      }else{
        echo 'Something went wrong';
      }

}

//trash officer
if (isset($_POST['council_trash_id'])) {
    $del_id = (int)$_POST['council_trash_id'];
    $general->trashUpdate('BBStateCouncils', 1, $del_id);
}
