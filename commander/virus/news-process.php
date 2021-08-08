<?php
require_once '../../core/init.php';
//Add Tutorials
$general = new General();
$show = new Show();
$db = Database::getInstance();
if (isset($_POST['action']) && $_POST['action'] == 'add_news') {
  $slug_url = '';
  $author = 'Kogi State Council';
  $news_title = $show->test_input($_POST['news_title']);
  $news_description = $show->test_input($_POST['news_description']);



  if (empty($_POST['news_title'])) {
    echo $show->showMessage('danger', 'Title is required!','warning');
    return false;
  }

    if (empty($_POST['news_description'])) {
      echo $show->showMessage('danger', 'Description is required!','warning');
      return false;
    }

    $slug_url = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($news_title)));

  $checkSlug = $general->slugCheck('news',$slug_url);
  if ($checkSlug) {
      foreach ($checkSlug as $slug) {
        $data[] = $slug->slug_url;
      }
      if (in_array($slug_url, $data)) {
        $count = 0;
        while(in_array(($slug_url . '-' . ++$count), $data));
        $slug_url = $slug_url . '-' . $count;
      }
  }

  $done =  $general->addNews($author, $news_title, $news_description,$slug_url);
  if ($done) {
  	 $sql = "SELECT * FROM news WHERE slug_url = '$slug_url' AND deleted = 0";
	 $query = $db->query($sql);
   if ($query->count()) {
     $post = $query->first();
     $general->likeSys($post->id);
     echo $show->showMessage('success', 'News Added Successfully!', 'check');
   }


  }else{
      echo $show->showMessage('danger', 'Something went wrong!', 'warning');
  }



}

//Fetch Tutorals
if (isset($_POST['action']) && $_POST['action'] == 'fetch_news') {
    $data = $general->selectTable('news',0);
    $output = '';
    if ($data) {
      $output .= '<table class="table table-striped table-hover" id="showNew">
        <thead>
          <tr>
            <th>#</th>
            <th>Title</th>
            <th>Description</th>
            <th>Date Created</th>
            <th>Updated</th>
            <th>Publish Now</th>
            <th>Action</th>

          </tr>
        </thead>
        <tbody>';
        $x = 0;
      foreach ($data as $new) {
        $x = $x + 1;
        if ($new->published == 0) {
        	$featured = '<a href="#" id="'.$new->id.'" class="btn btn-xs btn-danger PublishBtn">
            <span class="fa fa-minus"></span>&nbsp; Not Published
          </a>
          ';
        }else{
        	$featured = '<a href="#" id="'.$new->id.'" class="btn btn-xs btn-success UnPublishBtn">
            <span class="fa fa-plus"></span>&nbsp; Published
          </a>
          ';
        }
        $output .= '
            <tr>
       <td>'.$x.'</td>
       <td>'.wrap($new->title).'...</td>
       <td>'.wrap($new->description).'...</td>
       <td>'.timeAgo($new->dateCreated).'</td>
       <td>'.timeAgo($new->dateUpdated).'</td>
       <td>
       	'.$featured.'
       <td>
       <td>
       <a href="#" id="'.$new->id.'" title="View Details" class="text-primary newsDetailsIcon" data-toggle="modal" data-target="#showNewsDetailsModal"><i class="fas fa-info-circle fa-lg"></i> </a>&nbsp;

         <a href="editing/command-editNews/'.$new->id.'" id="'.$new->id.'" title="Edit News" class="text-success editNewsBtn"><i class="fa fa-edit fa-lg" ></i></a>&nbsp;

       <a href="#" id="'.$new->id.'" title="Trash News" class="text-danger trashNewsIcon"><i class="fas fa-recycle fa-lg"></i> </a>

       </td>
      </tr>
                          ';

        }

                $output .= '
                  </tbody>
                </table>';
                echo $output;
    }else{
      echo '<h3 class="text-center text-secondary lead px-3">No News yet</h3>';
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'news_slug') {

    $data = $general->selectTable('news',0);
    $output = '';
    $output .= '<select  name="news_id"  id="news_id" class="form-control form-control-lg">';
    $output .= '  <option value="">Select News</option>';
    foreach ($data as $nes) {

      if ($nes->featuredImage == Null) {
         $output .= '<option value="'.$nes->id.'">'.$nes->slug_url.'</option>';
      }

    }
    $output .= '</select>';

    echo $output;

}

if (isset($_POST['action']) && $_POST['action'] == 'news_images_add') {

    $data = $general->selectTable('news',0);
    $output = '';
    $output .= '<select  name="news_id"  id="news_id" class="form-control form-control-lg">';
    $output .= '  <option value="">Select News</option>';
    foreach ($data as $news) {

      if ($news->has_images == 0) {
         $output .= '<option value="'.$news->id.'">'.$news->slug_url.'</option>';
      }

    }
    $output .= '</select>';

    echo $output;

}

//add images
if (isset($_FILES['file']) && !empty($_FILES['file'])) {
  $dbpath  = '';
    $news_id = $_POST['news_id'];
    if (empty($_POST['news_id'])) {
      echo $show->showMessage('danger', 'Select news', 'warning');
      return false;
    }

      $filesCount = count($_FILES['file']['name']);
      if ($filesCount > 0) {
      for($i=0; $i<$filesCount; $i++){
        $RandomNums = rand(0, 10000);
        $FileNames = str_replace(' ','-',strtolower($_FILES['file']['name'][$i]));
        $FileTypes = $_FILES['file']['type'][$i]; //"File/png", File/jpeg etc.
        $FileTemps[] = $_FILES["file"]["tmp_name"][$i];
        $FileExts = substr($FileNames, strrpos($FileNames, '.'));
        $FileExts = str_replace('.','',$FileExts);
        $valids = array('png', 'jpg', 'jpeg');
        $FileNames = preg_replace("/\.[^.\s]{3,4}$/", "", $FileNames);
        $NewFileNames = $FileNames.'-'.$RandomNums.'.'.$FileExts;
        $output_dirs[] = '../../uploads/newsImages/'.$NewFileNames;//Path for file upload
       if (!in_array(strtolower($FileExts), $valids)) {
         echo $show->showMessage('danger', 'Invalid Extension', 'warning');
       }
        if ($i != 0) {
          $dbpath .= ', ';
        }
        $dbpath .= $NewFileNames;
}

    for ($i=0; $i<$filesCount; $i++) {
        move_uploaded_file($FileTemps[$i],$output_dirs[$i]);

    }


}
       $upload = $general->uploadFile($news_id, $dbpath);


        if ($upload===true) {
          echo $show->showMessage('success', 'Files Uploaded Successfully!', 'warning');
        }else{
          echo $show->showMessage('danger', 'Error adding files', 'warning');

        }


}


if (isset($_POST['action']) && $_POST['action'] == 'Newsimages') {

    $data = $general->selectTable('newsImages',0);
    $output = '';
    if ($data) {
      $output .= '<table class="table table-striped table-hover" id="showNe">
        <thead>
          <tr>
            <th>#</th>
            <th>News</th>
            <th>Action</th>

          </tr>
        </thead>
        <tbody>';
        $x = 0;
      foreach ($data as $Image) {
        $x = $x + 1;
        $id =  $Image->news_id;
        $news = $general->getByIdNews('news', 'id', $id, 0);

        $output .= '
            <tr>
              <td>'.$x.'</td>
                <td>'.$news->title.'</td>

               <td>
               <a href="#" id="'.$Image->id.'" title="View Details" class="text-primary ImageDetailsIcon" data-toggle="modal" data-target="#showImageDetailsModal"><i class="fas fa-info-circle fa-lg"></i> </a>&nbsp;
                 <a href="#" id="'.$Image->id.'" title="Edit Images" class="text-success editImageBtn" data-toggle="modal" data-target="#editImageModal"><i class="fa fa-edit fa-lg" ></i></a>&nbsp;
               <a href="#" id="'.$Image->id.'" title="Trash" class="text-danger trashImagesIcon"><i class="fas fa-recycle fa-lg"></i> </a>

               </td>
              </tr>
              ';

        }

                $output .= '
                  </tbody>
                </table>';
                echo $output;
    }else{
      echo '<h3 class="text-center text-secondary lead px-3">No Images yet</h3>';
    }
}

if (isset($_POST['newsImage_id'])) {
  $newsid = $_POST['newsImage_id'];

  $data = $general->getByIdNews('newsImages', 'id', $newsid, 0);
  $newsowner = $general->getByIdNews('news','id', $data->news_id, 0);
  $output = '';

  $output .= '<div class="row">
    <div class="col-md-3">
      <span class="lead text-secondary">News: '.$ca->title.'</span>
    </div>

     </div>
     <hr>';
$output .= '<div class="row">';
      $photos = explode(', ', $data->images);

      foreach ($photos as $screen) {

    $output .= '<div class="col-lg-4 fotorama">
        <img src="'.URLROOT.'uploads/newsImages/'.$screen.'" class="img-thumbnail img-fluid" alt="Images" width="208px">
      </div>';

      }

  $output .= '
  </div>';

  echo $output;
}

if (isset($_POST['delNews_id'])) {
  $delt = $_POST['delNews_id'];

  $general->newsAction('deleted',1, $delt);
   $general->newsimageAction(1, $delt);
}

if (isset($_POST['newsdt_id'])) {
  $newsid = $_POST['newsdt_id'];
// $table, $field, $id
  $data = $general->getById('news','id', $newsid);
  $output = '';

  $output .= ' <span class="text-center text-dark"> '.$data->title.'</span>
   <ul class="list-unstyled m-0">
   <li class="media">
     <img data-src="'.URLROOT.'uploads/featuredImage/'.$data->featuredImage.'" class="img-thumbnail lazy"  src="'.URLROOT.'uploads/featuredImage/'.$data->featuredImage.'" alt="'.$data->title.'" width="408">
     <div class="media-body ml-2">
       <h6 class="text-info mb-1">'.$data->title.'</h6>
       <p>
       '.$data->description.'
       </p>
     </div>
   </li>

</ul>';



  echo $output;
}



//add featured
if (isset($_FILES['featured_image']) && !empty($_FILES['featured_image'])) {
  $dbpath  = '';
    $news_id = $_POST['news_id'];
    if (empty($_POST['news_id'])) {
      echo $show->showMessage('danger', 'Select news', 'warning');
      return false;
    }

         $file = $_FILES["featured_image"]['name'];
         $RandomNum = rand(0, 10000);
         $FileName = str_replace(' ','-',strtolower($_FILES['featured_image']['name']));
         $FileType = $_FILES['featured_image']['type']; //"File/png", File/jpeg etc.
         $FileTemp = $_FILES["featured_image"]["tmp_name"];
         $FileSize = $_FILES['featured_image']['size'];
         $FileExt = substr($FileName, strrpos($FileName, '.'));
         $FileExt = str_replace('.','',$FileExt);
         $valid = array('jpg', 'jpeg', 'png');
         $FileName = preg_replace("/\.[^.\s]{3,4}$/", "", $FileName);
         $NewFileName = $FileName.'-'.$RandomNum.'.'.$FileExt;
         $output_dir = '../../uploads/featuredImage/'.$NewFileName;//Path for file
        if (!in_array(strtolower($FileExt), $valid)) {
          echo $show->showMessage('danger', 'Invalid Extension', 'warning');

        }
        $dbpath = $NewFileName;

         // if (!is_dir($output_dir)) {
         //   mkdir($output_dir='uploads', 755, true);
         //
         // }
        move_uploaded_file($FileTemp ,$output_dir);

        $upload = $general->featuredAction($dbpath, $news_id);
        if ($upload===true) {
          echo $show->showMessage('success', 'Featured Image Set!', 'check');
        }else{
          echo $show->showMessage('danger', 'Error adding file', 'warning');

        }


}


if (isset($_POST['publishNews'])) {
	$id = (int)$_POST['publishNews'];

	$update = "UPDATE news SET published = 1 WHERE id = '$id' ";
	$stmt = $db->query($update);
}

if (isset($_POST['UnpublishNews'])) {
	$id = (int)$_POST['UnpublishNews'];

	$update = "UPDATE news SET published = 0 WHERE id = '$id' ";
  $stmt = $db->query($update);

}
