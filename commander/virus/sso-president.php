<?php
require_once '../../core/init.php';
//Add executives
$general = new General();
$show = new Show();//Fetch Tutorals

//add sso code
if (isset($_FILES['SSO_image']) && !empty($_FILES['SSO_image'])) {

  $dbpath  = '';

    $SSO_name = $show->test_input($_POST['SSO_name']);
    $SSO_description = $_POST['SSO_description'];
    $SSO_office = $show->test_input($_POST['SSO_office']);


    $required = array(
      'SSO_name',
      'SSO_description',
      'SSO_office'
    );
    foreach ($required as $fields) {
      if (empty($_POST[$fields])) {
          echo $show->showMessage('danger', 'All Fields are required! check again','warning');
          return false;
      }
    }

         $file = $_FILES["SSO_image"]['name'];
         $RandomNum = rand(0, 10000);
         $FileName = str_replace(' ','-',strtolower($_FILES['SSO_image']['name']));
         $FileType = $_FILES['SSO_image']['type']; //"File/png", File/jpeg etc.
         $FileTemp = $_FILES["SSO_image"]["tmp_name"];
         $FileSize = $_FILES['SSO_image']['size'];
         $FileExt = substr($FileName, strrpos($FileName, '.'));
         $FileExt = str_replace('.','',$FileExt);
         $valid = array('jpg', 'png', 'jpeg');
         $FileName = preg_replace("/\.[^.\s]{3,4}$/", "", $FileName);
         $NewFileName = $FileName.'-'.$RandomNum.'.'.$FileExt;
         $output_dir = '../../uploads/sso-president/'.$NewFileName;//Path for file upload
       	if (!in_array(strtolower($FileExt), $valid)) {
          echo $show->showMessage('danger', 'Invalid Extension','warning');

       	}
        $dbpath = $NewFileName;

      	 // if (!is_dir($output_dir)) {
         //   mkdir($output_dir='uploads', 755, true);
         //
         // }
        if (move_uploaded_file($FileTemp ,$output_dir)) {
          $general->addOfficial('BBStateSSO',array(
            'sso_name' => $SSO_name,
            'sso_image' => $dbpath,
            'sso_profile' => $SSO_description,
            'sso_office' => $SSO_office
          ));
            echo $show->showMessage('success','Success!','warning');

        }


}
// foreach(glob("*.jpg") as $picture)
// {
//     echo $picture.'<br />';
// }
//

if (isset($_POST['action']) && $_POST['action'] == 'fetch_SSO') {

    $data = $general->selectTable('BBStateSSO', 0);
    $output = '';
    if ($data) {
      $output .= '<table class="table table-striped table-hover" id="showS">
        <thead>
          <tr>
            <th>#</th>
            <th>Image</th>
            <th>Name</th>
            <th>Profile</th>
            <th>Action</th>

          </tr>
        </thead>
        <tbody>';
        $x = 0;
      foreach ($data as $sso) {
        $x = $x + 1;
        $output .= '

            <tr>
              <td>'.$x.'</td>
              <td>
              <img src="'.URLROOT.'uploads/sso-president/'.$sso->sso_image.'" width="70px" height="70px" style="border-radius:50px;" alt="'.$sso->sso_name.'">
              </td>
              <td>'.$sso->sso_office.'</td>

               <td>'.wrap3($sso->sso_profile).'</td>
               <td>
               <a href="#" id="'.$sso->id.'" title="View SSO Details" class="text-primary SSODetailsIcon" data-toggle="modal" data-target="#showSSODetailsModal"><i class="fas fa-info-circle fa-lg"></i> </a>&nbsp;

                 <a href="editing/command-editSSO/'.$sso->id.'" id="'.$sso->id.'" title="Edit SSO" class="text-success"><i class="fa fa-edit fa-lg" ></i></a>&nbsp;

               <a href="#" id="'.$sso->id.'" title="Trash SSO" class="text-danger trashSSOIcon"><i class="fas fa-recycle fa-lg"></i> </a>

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

if (isset($_POST['SSO_id'])) {
    $ssoid = $_POST['SSO_id'];
  // $table, $field, $id
    $data = $general->getById('BBStateSSO','id', $ssoid);
    $output = '';

    $output .= ' <span class="text-center text-dark">'.$data->sso_name.' - '.$data->sso_office.'</span>
     <ul class="list-unstyled m-0">
     <li class="media">
          <div class="media-body ml-2">
       <div class="row">
       <div class="col-md-8">
        <p>
         '.nl2br($data->sso_profile).'
         </p>
       </div>
       <div class="col-md-4">
              <img data-src="'.URLROOT.'uploads/sso-president/sso.png" class="img-fluid"  src="'.URLROOT.'uploads/sso-president/sso.png" alt="'.$data->sso_name.'" width="408">

       </div>
       </div>

       </div>
     </li>


  </ul>';



    echo $output;
}

if (isset($_POST['delSSO_id'])) {
  $delt = $_POST['delSSO_id'];

  $general->trashUpdate('BBStateSSO',1, $delt);
}

//
//add president
if (isset($_FILES['President_image']) && !empty($_FILES['President_image'])) {

  $dbpath  = '';

    $President_name = $show->test_input($_POST['President_name']);
    $President_description = $_POST['President_description'];
    $President_office = $show->test_input($_POST['President_office']);


    $required = array(
      'President_name',
      'President_description',
      'President_office'
    );
    foreach ($required as $fields) {
      if (empty($_POST[$fields])) {
          echo $show->showMessage('danger', 'All Fields are required! check again','warning');
          return false;
      }
    }

         $file = $_FILES["President_image"]['name'];
         $RandomNum = rand(0, 10000);
         $president = 'presid';
         $FileName = str_replace(' ','-',strtolower($_FILES['President_image']['name']));
         $FileType = $_FILES['President_image']['type']; //"File/png", File/jpeg etc.
         $FileTemp = $_FILES["President_image"]["tmp_name"];
         $FileSize = $_FILES['President_image']['size'];
         $FileExt = substr($FileName, strrpos($FileName, '.'));
         $FileExt = str_replace('.','',$FileExt);
         $valid = array('jpg', 'png', 'jpeg');
         $FileName = preg_replace("/\.[^.\s]{3,4}$/", "", $FileName);
         $NewFileName = $FileName.'-'.$RandomNum.'-'.$president.'.'.$FileExt;
         $output_dir = '../../uploads/sso-president/'.$NewFileName;//Path for file upload
       	if (!in_array(strtolower($FileExt), $valid)) {
          echo $show->showMessage('danger', 'Invalid Extension','warning');

       	}
        $dbpath = $NewFileName;

      	 // if (!is_dir($output_dir)) {
         //   mkdir($output_dir='uploads', 755, true);
         //
         // }
        if (move_uploaded_file($FileTemp ,$output_dir)) {
          $general->addOfficial('BBStatePresident', array(
            'president_name' => $President_name,
            'president_image' => $dbpath,
            'president_profile' => $President_description,
            'president_office' => $President_office
          ));
            echo $show->showMessage('success','Success!','warning ');


        }


}
// foreach(glob("*.jpg") as $picture)
// {
//     echo $picture.'<br />';
// }
//

if (isset($_POST['action']) && $_POST['action'] == 'fetch_President') {

    $data = $general->selectTable('BBStatePresident', 0);
    $output = '';
    if ($data) {
      $output .= '<table class="table table-striped table-hover" id="showPre">
        <thead>
          <tr>
            <th>#</th>
            <th>Image</th>
            <th>Name</th>
            <th>Profile</th>
            <th>Action</th>

          </tr>
        </thead>
        <tbody>';
        $x = 0;
      foreach ($data as $president) {
        $x = $x + 1;
        $output .= '

            <tr>
              <td>'.$x.'</td>
              <td>
              <img src="'.URLROOT.'uploads/sso-president/'.$president->president_image.'" width="70px" height="70px" style="border-radius:50px;" alt="'.$president->president_name.'">
              </td>
              <td>'.$president->president_office.'</td>

               <td>'.wrap3($president->president_profile).'</td>
               <td>
               <a href="#" id="'.$president->id.'" title="View Pre Details" class="text-primary PreDetailsIcon" data-toggle="modal" data-target="#showPreDetailsModal"><i class="fas fa-info-circle fa-lg"></i> </a>&nbsp;

                 <a href="editing/command-editPresident/'.$president->id.'" id="'.$president->id.'" title="Edit President" class="text-success"><i class="fa fa-edit fa-lg" ></i></a>&nbsp;

               <a href="#" id="'.$president->id.'" title="Trash Pre" class="text-danger trashPresidentIcon"><i class="fas fa-recycle fa-lg"></i> </a>

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

if (isset($_POST['President_id'])) {
  $presidentid = $_POST['President_id'];
// $table, $field, $id
  $data = $general->getById('BBStatePresident','id', $presidentid);
  $output = '';

  $output .= ' <span class="text-center text-dark">'.$data->president_name.' - '.$data->president_office.'</span>
   <ul class="list-unstyled m-0">
   <li class="media">
     <img data-src="'.URLROOT.'uploads/sso-president/'.$data->president_image.'" class="img-thumbnail lazy"  src="'.URLROOT.'uploads/sso-president/'.$data->president_image.'" alt="'.$data->president_name.'" width="408">
     <div class="media-body ml-2">
       <p>
       '.nl2br($data->president_profile).'
       </p>
     </div>
   </li>


</ul>';



  echo $output;
}

if (isset($_POST['delPresident_id'])) {
  $delt = $_POST['delPresident_id'];

  $general->trashUpdate('BBStatePresident',1, $delt);
}

//
