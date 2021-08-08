<?php
require_once '../../core/init.php';
if (!isCommanderGranted()) {
  Session::flash('message', 'Access Denied!');
  Redirect::to('command-access');

}
if (!hasPermissionCaptian()) {
  Session::flash('message', 'Access Denied! You can\'t access that page!');
  Redirect::to('command-dashboard');

}

require APPROOT .'/includes/Panelhead.php';


$db = new General();
$show = new Show();

if (isset($_GET['edit']) && !empty($_GET['edit'])) {
  $edit_id = (int)$_GET['edit'];
  $error = '';
  $dbpath = '';
  $galls = $db->getById('BBStateGallery', 'id', $edit_id);

      if (isset($_POST['delete_image'])) {
        $image = $galls->gall_image;
        $image_url = URLROOT. 'uploads/gallery/'.$image;
        unlink($image_url);
        // unset($image_url);
        $imageUpdate = "UPDATE BBStateGallery SET gall_image = '' WHERE id = '$edit_id' ";
        Database::getInstance()->query($imageUpdate);
        Redirect::to('../command-editGallery/'.$edit_id);
     }
  $gallery_title = ((isset($_POST['gallery_title']) && !empty($_POST['gallery_title']))?$show->test_input($_POST['gallery_title']):$galls->gall_title);

  $gallery_date_event = ((isset($_POST['gallery_date_event']) && !empty($_POST['gallery_date_event']))?$show->test_input($_POST['gallery_date_event']):$galls->gall_eventDate);

  $gallery_event_location = ((isset($_POST['gallery_event_location']) && !empty($_POST['gallery_event_location']))?$show->test_input($_POST['gallery_event_location']):$galls->gall_event_location);

  $gallery_description = ((isset($_POST['gallery_description']) && !empty($_POST['gallery_description']))?$show->test_input($_POST['gallery_description']):$galls->gall_description);


  $saved_image = (($galls->gall_image != '')?$galls->gall_image : '');
  $dbpath = $saved_image;
}
if ($_POST) {
  $required = array(
    'gallery_title',
  'gallery_date_event',
  'gallery_event_location',
  'gallery_description'
  );
  foreach ($required as $fields) {
    if (empty($_POST[$fields])) {
        $error .= 'No field should be blank!';
    }
  }
  $slug_url = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($gallery_title )));
  if (!empty($_FILES)) {
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

  }
  if (!empty($_FILES)) {
      move_uploaded_file($FileTemp ,$output_dir);
  }
  if ($error == '') {
    if (isset($_GET['edit'])) {
      $Update = "UPDATE BBStateGallery SET gall_title = $gallery_title,  gall_event_location =$gallery_event_location,  gall_image = $dbpath, gall_description = $gallery_description, gall_eventDate = $gallery_date_event WHERE id = $edit_id ";
      Database::getInstance()->query($Update);
      Session::flash('updated', 'Gallery Updated Successfully');
      Redirect::to('../../command-gallery');
    }
  }

}

?>


    <div class="content-header">
      <div class="container-fluid">

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="card">
          <h4 class="card-header bg-info border-info"><i class="fas fa-edit fa-lg"></i>&nbsp;<?= ((isset($_GET['edit']))? 'Edit':'') ;?> Gallery</h4>
          <div class="card-body">

            <hr>
            <form class="px-3" action="<?= URLROOT;?>commander/editing/command-editGallery/<?= $edit_id; ?>" method="post"  enctype="multipart/form-data">
              <div class="form-group">
                <h5 class="text-danger"><?php echo $error ?></h5>
              </div>

                <div class="form-group col-lg-12">

    <div class="form-group col-md-12">
          <?php if($saved_image != ''): ?>
            <div class="saved_image col-md-4">
              <img src="<?= URLROOT; ?>uploads/gallery/<?=$saved_image?>" alt="Saved Image" class="img-fluid img-thumbnail lazy" width="208">
              <form class="form-inline" action="command-editGallery/<?=$edit_id ?>" method="post">
                <input type="submit" name="delete_image" value="Delete Image" class="btn btn-danger px-3">
              </form>

              </div>

                        <?php else: ?>
                          <div class="custom-file">
                           <input type="file" name="gallery_image" id="gallery_image"
                           class="custom-file-input">
                            <label for="file" class="custom-file-label">Select Files (image)</label>
                         </div>
                      <?php endif; ?>

                  </div>
                  <div class="row">

              <div class="form-group col-md-6">
                <label for="gallery_title">Title</label>
                <input type="text" name="gallery_title" id="gallery_title" placeholder="Enter Title" class="form-control form-control-lg" value="<?= $gallery_title; ?>">
              </div>

              <div class="form-group col-md-6">
                <label for="gallery_date_event">Event Date</label>
                <input type="date" name="gallery_date_event" id="gallery_date_event" placeholder="Enter Event Date" class="form-control form-control-lg" value="<?=$gallery_date_event; ?>">
              </div>
              <div class="form-group col-md-6">
                <label for="gallery_event_location">Event Location</label>
                <input type="text" name="gallery_event_location" id="gallery_event_location" placeholder="Enter Event Location" class="form-control form-control-lg" value="<?=$gallery_event_location; ?>">
              </div>
              <div class="form-group col-md-6">
                <label for="gallery_description">Berif Detail</label>
                <textarea  name="gallery_description" id="gallery_description" placeholder="Enter Event Detail" class="form-control form-control-lg" rows="8">
                  <?=$gallery_description; ?>
                </textarea>
              </div>
              <div class="clearfix">  </div>
              <div class="form-group col-md-12">
                <input type="submit" name="editGallery" id="editGalleryBtn" value="<?= ((isset($_GET['edit']))? 'Edit':'') ;?>  Gallery" class="btn btn-info btn-lg btn-block px-2">
              </div>
            </div>
            </form>
          </div>
        </div>
      </div>
      </div><!-- /.container-fluid -->
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
<?php   require APPROOT .'/includes/editFooter.php';?>
