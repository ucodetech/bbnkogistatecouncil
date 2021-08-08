<?php
require_once '../../core/init.php';
//Add executives
$general = new General();
$show = new Show();
$notify = new Notification();
//Fetch Tutorals

//add exective code
if (isset($_FILES['gallery_image']) && !empty($_FILES['gallery_image'])) {

  $dbpath  = '';

    $gallery_title = $show->test_input($_POST['gallery_title']);
    $gallery_date_event = $show->test_input($_POST['gallery_date_event']);
    $gallery_event_location = $show->test_input($_POST['gallery_event_location']);
    $gallery_description =$_POST['gallery_description'];

    $required = array(
      'gallery_title',
      'gallery_date_event',
      'gallery_event_location',
      'gallery_description'
    );
    foreach ($required as $fields) {
      if (empty($_POST[$fields])) {
          echo $show->showMessage('danger', 'All Fields are required! chek again','warning');
          return false;
      }
    }


         $file = $_FILES["gallery_image"]['name'];
         $RandomNum = rand(0, 10000);
         $FileName = str_replace(' ','-',strtolower($_FILES['gallery_image']['name']));
         $FileType = $_FILES['gallery_image']['type']; //"File/png", File/jpeg etc.
         $FileTemp = $_FILES["gallery_image"]["tmp_name"];
         $FileSize = $_FILES['gallery_image']['size'];
         $FileExt = substr($FileName, strrpos($FileName, '.'));
         $FileExt = str_replace('.','',$FileExt);
         $valid = array('jpg', 'png', 'jpeg');
         $FileName = preg_replace("/\.[^.\s]{3,4}$/", "", $FileName);
         $NewFileName = $FileName.'-'.$RandomNum.'.'.$FileExt;
         $output_dir = '../../uploads/gallery/'.$NewFileName;//Path for file upload
       	if (!in_array(strtolower($FileExt), $valid)) {
          echo $show->showMessage('danger', 'Invalid Extension','warning');

       	}
        $dbpath = $NewFileName;

      	 // if (!is_dir($output_dir)) {
         //   mkdir($output_dir='uploads', 755, true);
         //
         // }
        if (move_uploaded_file($FileTemp ,$output_dir)) {
          $upload = $general->addGallery($gallery_title,$gallery_date_event,$gallery_event_location,$gallery_description, $dbpath);

          if ($upload===true) {
            echo $show->showMessage('success','Success!','success');
          }else{
            echo $show->showMessage('danger', 'Error processing','warning');

          }

        }


}
// foreach(glob("*.jpg") as $picture)
// {
//     echo $picture.'<br />';
// }
//

if (isset($_POST['action']) && $_POST['action'] == 'fetch_gallery') {

    $data = $general->selectTable('BBStateGallery', 0);
    $output = '';
    if ($data) {
      $output .= '<table class="table table-striped table-hover" id="showGall">
        <thead>
          <tr>
            <th>#</th>
            <th>Image</th>
            <th>Title</th>
            <th>Location</th>
            <th>Description</th>
            <th>Event Date</th>
            <th>Action</th>

          </tr>
        </thead>
        <tbody>';
        $x = 0;
      foreach ($data as $gall) {
        $x = $x + 1;
        $output .= '

            <tr>
              <td>'.$x.'</td>
              <td>
              <img src="'.URLROOT.'uploads/gallery/'.$gall->gall_image.'" width="70px" height="70px" style="border-radius:50px;" alt="'.$gall->gall_title.'">
              </td>
              <td>'.wrap($gall->gall_title).'</td>

             <td>'.$gall->gall_event_location.'</td>
               <td>'.wrap($gall->gall_description).'</td>
               <td>'.pretty_dates($gall->gall_eventDate).'</td>

               <td>
               <a href="#" id="'.$gall->id.'" title="View Gallery Details" class="text-primary GalleryDetailsIcon" data-toggle="modal" data-target="#showGalleryDetailsModal"><i class="fas fa-info-circle fa-lg"></i> </a>&nbsp;
                 <a href="editing/command-editGallery/'.$gall->id.'" id="'.$gall->id.'" title="Edit Gallery" class="text-success"><i class="fa fa-edit fa-lg" ></i></a>&nbsp;

               <a href="#" id="'.$gall->id.'" title="Trash Gallery" class="text-danger trashGalleryIcon"><i class="fas fa-recycle fa-lg"></i> </a>

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

if (isset($_POST['gallery_id'])) {
  $gallctiveid = $_POST['gallery_id'];
// $table, $field, $id
  $data = $general->getById('BBStateGallery','id', $gallctiveid);
  $output = '';

  $output .= ' <span class="text-center text-dark">'.$data->gall_title.'</span>
   <ul class="list-unstyled m-0">
   <li class="media">
     <img data-src="'.URLROOT.'uploads/gallery/'.$data->gall_image.'" class="img-thumbnail lazy"  src="'.URLROOT.'uploads/gallery/'.$data->gall_image.'" alt="'.$data->gall_title.'" width="408">
     <div class="media-body ml-2">
       <h6 class="text-info mb-1">'.$data->gall_event_location.'</h6>
       <p>
       '.nl2br($data->gall_description).'
       </p>
     </div>
   </li>


</ul>';



  echo $output;
}

if (isset($_POST['delGall_id'])) {
  $delt = $_POST['delGall_id'];

  $general->trashUpdate('BBStateGallery',1, $delt);
}

//
//
// if (isset($_POST['action']) && $_POST['action'] == 'recentPost') {
//   $data = $general->fetchTutorialsFront(0);
//   $output = '';
//   if ($data) {
//     foreach ($data as $r) {
//       $output .= '
//       <ul class="list-unstyled m-0">
//       <a href="'.URLROOT.'tutorial/post/'.$r->slug_url.'" class="page-link border-0">
//         <li class="media">
//           <img data-src="'.URLROOT.'uploads/featuredImage/'.$r->featured_image.'" class="img-thumbnail lazy" alt="'.$r->tut_title.'" src="'.URLROOT.'uploads/featuredImage/'.$r->featured_image.'" width="100">
//           <div class="media-body ml-2">
//             <h6 class="text-info mb-1">'.$r->tut_title.'</h6>
//             <p class="small text-muted m-0">
//               '.pretty_dates($r->date_created).'
//             </p>
//           </div>
//         </li>
//       </a>
//     </ul>';
//     }
//     echo $output;
//   }else{
//     echo '<h3 class="text-center text-secondary px-3"> No Recent Post Yet</h3>';
//   }
// }
