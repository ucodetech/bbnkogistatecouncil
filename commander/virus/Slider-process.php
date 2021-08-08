<?php
require_once '../../core/init.php';
//Add executives
$general = new General();
$show = new Show();
//Fetch Tutorals

//add exective code
if (isset($_FILES['Slider_image']) && !empty($_FILES['Slider_image'])) {

  $dbpath  = '';

    $Slider_title = $show->test_input($_POST['Slider_title']);
    $Slider_description =$_POST['Slider_description'];

    $required = array(
      'Slider_title',
      'Slider_description'
    );
    foreach ($required as $fields) {
      if (empty($_POST[$fields])) {
          echo $show->showMessage('danger', 'All Fields are required! check again','warning');
          return false;
      }
    }

         $file = $_FILES["Slider_image"]['name'];
         $RandomNum = rand(0, 10000);
         $FileName = str_replace(' ','-',strtolower($_FILES['Slider_image']['name']));
         $FileType = $_FILES['Slider_image']['type']; //"File/png", File/jpeg etc.
         $FileTemp = $_FILES["Slider_image"]["tmp_name"];
         $FileSize = $_FILES['Slider_image']['size'];
         $FileExt = substr($FileName, strrpos($FileName, '.'));
         $FileExt = str_replace('.','',$FileExt);
         $valid = array('jpg', 'png', 'jpeg');
         $FileName = preg_replace("/\.[^.\s]{3,4}$/", "", $FileName);
         $NewFileName = $FileName.'-'.$RandomNum.'.'.$FileExt;
         $output_dir = '../../uploads/slider/'.$NewFileName;//Path for file upload
       	if (!in_array(strtolower($FileExt), $valid)) {
          echo $show->showMessage('danger', 'Invalid Extension','warning');

       	}
        $dbpath = $NewFileName;

      	 // if (!is_dir($output_dir)) {
         //   mkdir($output_dir='uploads', 755, true);
         //
         // }

        if (move_uploaded_file($FileTemp ,$output_dir)) {
          $upload = $general->addSlider($Slider_title,$Slider_description, $dbpath);

          if ($upload===true) {
            echo $show->showMessage('success','Success!','warning');
          }else{
            echo $show->showMessage('danger', 'Error processing','warning');
            return false;

          }

        }


}
// foreach(glob("*.jpg") as $picture)
// {
//     echo $picture.'<br />';
// }
//

if (isset($_POST['action']) && $_POST['action'] == 'fetch_Slider') {

    $data = $general->selectTable('carousel_item', 0);
    $output = '';
    if ($data) {
      $output .= '<table class="table table-striped table-hover" id="showSlid">
        <thead>
          <tr>
            <th>#</th>
            <th>Image</th>
            <th>Title</th>
            <th>Description</th>
            <th>Action</th>

          </tr>
        </thead>
        <tbody>';
        $x = 0;
      foreach ($data as $slide) {
        $x = $x + 1;
        $output .= '

            <tr>
              <td>'.$x.'</td>
              <td>
              <img src="'.URLROOT.'uploads/slider/'.$slide->carousel_image.'" width="70px" height="70px" style="border-radius:50px;" alt="'.$slide->carousel_event.'">
              </td>
              <td>'.wrap($slide->carousel_event).'</td>

               <td>'.wrap($slide->carousel_description).'</td>
               <td>
               <a href="#" id="'.$slide->id.'" title="View Slider Details" class="text-primary SliderDetailsIcon" data-toggle="modal" data-target="#showSliderDetailsModal"><i class="fas fa-info-circle fa-lg"></i> </a>&nbsp;

                 <a href="editing/command-editSlider/'.$slide->id.'" id="'.$slide->id.'" title="Edit Slider" class="text-success"><i class="fa fa-edit fa-lg" ></i></a>&nbsp;

               <a href="#" id="'.$slide->id.'" title="Trash Slider" class="text-danger trashSliderIcon"><i class="fas fa-recycle fa-lg"></i> </a>

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

if (isset($_POST['Sliderd_id'])) {
    $gallctiveid = $_POST['Sliderd_id'];
  // $table, $field, $id
    $data = $general->getById('carousel_item','id', $gallctiveid);
    $output = '';

    $output .= ' <span class="text-center text-dark">'.$data->carousel_event.'</span>
     <ul class="list-unstyled m-0">
     <li class="media">
       <img data-src="'.URLROOT.'uploads/slider/'.$data->carousel_image.'" class="img-thumbnail lazy"  src="'.URLROOT.'uploads/slider/'.$data->carousel_image.'" alt="'.$data->carousel_event.'" width="408">
       <div class="media-body ml-2">
         <p>
         '.nl2br($data->carousel_description).'
         </p>
       </div>
     </li>


  </ul>';



    echo $output;
}

if (isset($_POST['delSlider_id'])) {
  $delt = $_POST['delSlider_id'];

  $general->trashUpdate('carousel_item',1, $delt);
}
