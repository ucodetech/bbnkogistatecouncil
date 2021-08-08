<?php
require_once '../../core/init.php';
//Add executives
$general = new General();
$show = new Show();

//Fetch Tutorals

//add exective code
if (isset($_FILES['award_image']) && !empty($_FILES['award_image'])) {

  $dbpath  = '';

    $award_name = $show->test_input($_POST['award_name']);
    $award_event_title = $show->test_input($_POST['award_event_title']);
    $award_description = $show->test_input($_POST['award_description']);

    $required = array(
      'award_name',
      'award_event_title',
      'award_description'
    );
    foreach ($required as $fields) {
      if (empty($_POST[$fields])) {
          echo $show->showMessage('danger', 'All Fields are required! check again','warning');
          return false;
      }
    }



    $filesCount = count($_FILES['award_image']['name']);
      if ($filesCount > 0) {
      for($i=0; $i<$filesCount; $i++){
        $RandomNums = rand(0, 10000);
        $FileNames = str_replace(' ','-',strtolower($_FILES['award_image']['name'][$i]));
        $FileTypes = $_FILES['award_image']['type'][$i]; //"File/png", File/jpeg etc.
        $FileTemps[] = $_FILES["award_image"]["tmp_name"][$i];
        $FileExts = substr($FileNames, strrpos($FileNames, '.'));
        $FileExts = str_replace('.','',$FileExts);
        $valids = array('png', 'jpg', 'jpeg');
        $FileNames = preg_replace("/\.[^.\s]{3,4}$/", "", $FileNames);
        $NewFileNames = $FileNames.'-'.$RandomNums.'.'.$FileExts;
        $output_dirs[] = '../../uploads/awards/'.$NewFileNames;//Path for file upload
       if (!in_array(strtolower($FileExts), $valids)) {
         echo $show->showMessage('danger', 'Invalid Extension','warning');
       }
        if ($i != 0) {
          $dbpath .= ', ';
        }
        $dbpath .= $NewFileNames;
}

    for ($i=0; $i<$filesCount; $i++) {
      $move =   move_uploaded_file($FileTemps[$i],$output_dirs[$i]);
    }

    if ($move) {
    	$general->awardUpload($award_name,$dbpath, $award_event_title, $award_description);
    }

}



}


if (isset($_POST['action']) && $_POST['action'] == 'fetch_Award') {

    $data = $general->selectTable('awardWinners', 0);
    $output = '';
    if ($data) {
      $output .= '<table class="table table-striped table-hover" id="showAwa">
        <thead>
          <tr>
            <th>#</th>
            <th>Image</th>
            <th>Winner</th>
            <th>Award Title</th>
            <th>Description</th>
            <th>Event Date</th>
            <th>Action</th>

          </tr>
        </thead>
        <tbody>';
        $x = 0;
      foreach ($data as $award) {
        $x = $x + 1;
        $image  = explode(', ', $award->award_images);
        foreach ($image as $awardImage) {
        $images = '<img src="'.URLROOT.'uploads/awards/'.$awardImage.'" width="70px" height="70px" style="border-radius:50px;" alt="'.$award->award_event_title.'">';
        }
        $output .= '

            <tr>
              <td>'.$x.'</td>
              <td>
             	'.$images.'
              </td>
               <td>'.$award->award_name.'</td>
              <td>'.wrap($award->award_event_title).'...</td>
	           <td>'.wrap($award->award_event_description).'...</td>
	           <td>'.pretty_dates($award->event_date).'</td>

               <td>
               <a href="#" id="'.$award->id.'" title="View awardery Details" class="text-primary awardDetailsIcon" data-toggle="modal" data-target="#showAwardDetailsModal"><i class="fas fa-info-circle fa-lg"></i> </a>&nbsp;

                 <a href="editing/command-editAward/'.$award->id.'" id="'.$award->id.'" title="Edit Award" class="text-success"><i class="fa fa-edit fa-lg" ></i></a>&nbsp;

               <a href="#" id="'.$award->id.'" title="Trash Award" class="text-danger trashAwardIcon"><i class="fas fa-recycle fa-lg"></i> </a>

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

if (isset($_POST['award_id'])) {
  $awardctiveid = $_POST['award_id'];
// $table, $field, $id
  $data = $general->getById('awardWinners','id', $awardctiveid);
  $output = '';

  $output .= ' <span class="text-center text-dark">'.$data->award_title.' / '.$data->slug_url.'</span>
   <ul class="list-unstyled m-0">
   <li class="media">
     <img data-src="'.URLROOT.'uploads/award/'.$data->award_images.'" class="img-thumbnail lazy"  src="'.URLROOT.'uploads/award/'.$data->award_images.'" alt="'.$data->award_title.'" width="408">
     <div class="media-body ml-2">
       <h6 class="text-info mb-1">'.$data->award_event_location.'</h6>
       <p>
       '.nl2br($data->award_description).'
       </p>
     </div>
   </li>


</ul>';



  echo $output;
}

if (isset($_POST['delaward_id'])) {
  $delt = $_POST['delaward_id'];

  $general->trashUpdate('BBStateawardery',1, $delt);
}

//
//
