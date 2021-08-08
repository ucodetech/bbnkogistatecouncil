<?php
require_once '../../core/init.php';
//Add executives
$general = new General();
$notify = new Notification();
$show = new Show();
//Fetch Tutorals


//add exective code
if (isset($_FILES['executive_image']) && !empty($_FILES['executive_image'])) {
  $dbpath  = '';
    $executive_name = $show->test_input($_POST['executive_name']);
    $executive_office = $show->test_input($_POST['executive_office']);
    $executive_description = $show->test_input($_POST['executive_description']);



    if (empty($_POST['executive_name'])) {
      echo $show->showMessage('danger', 'Executive\'s name is required!','warning');
      return false;
    }


    if (empty($_POST['executive_description'])) {
        echo $show->showMessage('danger', 'Executive\'s description is required!','warning');
        return false;
      }
      if (empty($_POST['executive_office'])) {
          echo $show->showMessage('danger', 'Executive\'s office is required!','warning');
          return false;
        }


      $checkfileNo = $general->checkExeutive($executive_office);
      if ($checkfileNo) {
          echo $show->showMessage('danger', 'Executive already Added!', 'warning');
          return false;
      }
         $file = $_FILES["executive_image"]['name'];
         $RandomNum = rand(0, 10000);
         $FileName = str_replace(' ','-',strtolower($_FILES['executive_image']['name']));
         $FileType = $_FILES['executive_image']['type']; //"File/png", File/jpeg etc.
         $FileTemp = $_FILES["executive_image"]["tmp_name"];
         $FileSize = $_FILES['executive_image']['size'];
         $FileExt = substr($FileName, strrpos($FileName, '.'));
         $FileExt = str_replace('.','',$FileExt);
         $valid = array('jpg', 'png', 'jpeg');
         $FileName = preg_replace("/\.[^.\s]{3,4}$/", "", $FileName);
         $NewFileName = $FileName.'-'.$RandomNum.'.'.$FileExt;
         $output_dir = '../../uploads/executives/'.$NewFileName;//Path for file upload
       	if (!in_array(strtolower($FileExt), $valid)) {
          echo $show->showMessage('danger', 'Invalid Extension', 'warning');

       	}
        $dbpath = $NewFileName;

      	 // if (!is_dir($output_dir)) {
         //   mkdir($output_dir='uploads', 755, true);
         //
         // }
        move_uploaded_file($FileTemp ,$output_dir);

        $upload = $general->addExectives($executive_name,  $executive_description, $dbpath,  $executive_office);

        if ($upload===true) {
          echo $show->showMessage('success', 'Executive added Successfully!', 'check');
        }else{
          echo $show->showMessage('danger', 'Error processing', 'warning');

        }


}
// foreach(glob("*.jpg") as $picture)
// {
//     echo $picture.'<br />';
// }
//

if (isset($_POST['action']) && $_POST['action'] == 'fetch_executives') {

    $data = $general->selectTable('BBStateExecutives', 0);
    $output = '';
    if ($data) {
      $output .= '<table class="table table-striped table-hover" id="showExe">
        <thead>
          <tr>
            <th>#</th>
            <th>Image</th>
            <th>Name</th>
            <th>Description</th>
            <th>Office</th>
            <th>Action</th>

          </tr>
        </thead>
        <tbody>';
        $x = 0;
      foreach ($data as $exe) {
        $x = $x + 1;
        $output .= '

            <tr>
              <td>'.$x.'</td>
              <td>
              <img src="'.URLROOT.'uploads/executives/'.$exe->exective_image.'" width="70px" height="70px" style="border-radius:50px;" alt="'.$exe->exective_name.'">
              </td>
             <td>'.$exe->exective_name.'</td>
               <td>'.wrap($exe->exective_description).'</td>
               <td>'.$exe->executive_office.'</td>

               <td>
               <a href="#" id="'.$exe->id.'" title="View Executive Details" class="text-primary exeDetailsIcon" data-toggle="modal" data-target="#showExeDetailsModal"><i class="fas fa-info-circle fa-lg"></i> </a>&nbsp;
                 <a href="editing/command-editExecutive/'.$exe->id.'" id="'.$exe->id.'" title="Edit Exective" class="text-success" ><i class="fa fa-edit fa-lg" ></i></a>&nbsp;
               <a href="#" id="'.$exe->id.'" title="Trash Exective" class="text-danger trashExeIcon"><i class="fas fa-recycle fa-lg"></i> </a>

               </td>
              </tr>
              ';

        }

                $output .= '
                  </tbody>
                </table>';
                echo $output;
    }else{
      echo '<h3 class="text-center text-secondary lead px-3">No Executive on the database yet</h3>';
    }
}

if (isset($_POST['executive_id'])) {
  $exectiveid = $_POST['executive_id'];
// $table, $field, $id
  $data = $general->getById('BBStateExecutives','id', $exectiveid);
  $output = '';

  $output .= ' <span class="text-center text-dark"> '.$data->executive_office.'</span>
   <ul class="list-unstyled m-0">
   <li class="media">
     <img data-src="'.URLROOT.'uploads/executives/'.$data->exective_image.'" class="img-thumbnail lazy"  src="'.URLROOT.'uploads/executives/'.$data->exective_image.'" alt="'.$data->exective_name.'" width="408">
     <div class="media-body ml-2">
       <h6 class="text-info mb-1">'.$data->exective_name.'</h6>
       <p>
       '.$data->exective_description.'
       </p>
     </div>
   </li>


</ul>';



  echo $output;
}

if (isset($_POST['delExe_id'])) {
  $delt = $_POST['delExe_id'];

  $general->trashUpdate('BBStateExecutives',1, $delt);

}
