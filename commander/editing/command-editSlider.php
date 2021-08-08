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
  $slide = $db->getById('carousel_item', 'id', $edit_id);

      if (isset($_POST['delete_image'])) {
        $image = $slide->carousel_image;
        $image_url = URLROOT. 'uploads/slider/'.$image;
        unlink($image_url);
        // unset($image_url);
        $imageUpdate = "UPDATE carousel_item SET carousel_image = '' WHERE id = '$edit_id' ";
        Database::getInstance()->query($imageUpdate);
        Redirect::to('../command-editSlider/'.$edit_id);
     }
  $Slider_title = ((isset($_POST['Slider_title']) && !empty($_POST['Slider_title']))?$show->test_input($_POST['Slider_title']):$slide->carousel_event);


  $Slider_description = ((isset($_POST['Slider_description']) && !empty($_POST['Slider_description']))?$show->test_input($_POST['Slider_description']):$slide->carousel_description);

  $saved_image = (($slide->carousel_image != '')?$slide->carousel_image : '');
  $dbpath = $saved_image;
}
if ($_POST) {
  $required = array(
    'Slider_title',
    'Slider_description'
  );
  foreach ($required as $fields) {
    if (empty($_POST[$fields])) {
        $error .= 'No field should be blank!';
    }
  }
  if (!empty($_FILES)) {
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

  }
  if (!empty($_FILES)) {
      move_uploaded_file($FileTemp ,$output_dir);
  }
  if ($error == '') {
    if (isset($_GET['edit'])) {
      $Update = "UPDATE carousel_item SET carousel_event = '$Slider_title',  carousel_image = '$dbpath', carousel_description = '$Slider_description' WHERE id = '$edit_id' ";
      Database::getInstance()->query($Update);
      Session::flash('updated', 'Slider Updated Successfully');
      Redirect::to('../../command-slider');
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
            <form class="px-3" action="<?= URLROOT;?>commander/editing/command-editSlider/<?= $edit_id; ?>" method="post"  enctype="multipart/form-data">
              <div class="form-group">
                <h5 class="text-danger"><?php echo $error ?></h5>
              </div>

                <div class="form-group col-lg-12">

    <div class="form-group col-md-12">
          <?php if($saved_image != ''): ?>
            <div class="saved_image col-md-4">
              <img src="<?= URLROOT; ?>uploads/slider/<?=$saved_image?>" alt="Saved Image" class="img-fluid img-thumbnail lazy" width="208">
              <form class="form-inline" action="command-editSlider/<?=$edit_id ?>" method="post">
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
                      <label for="Slider_title">Title</label>
                      <input type="text" name="Slider_title" id="Slider_title" placeholder="Enter Title" class="form-control form-control-lg"
                      value="<?= $Slider_title ?>">
                    </div>

                    <div class="form-group col-md-6">
                      <label for="Slider_description">Berif Detail</label>
                      <textarea  name="Slider_description" id="Slider_description" placeholder="Enter Event Detail" class="form-control form-control-lg" rows="8">
                        <?= $Slider_description ?>
                      </textarea>
                    </div>
                    <div class="clearfix">  </div>
              <div class="form-group col-md-12">
                <input type="submit" name="editSlider" id="editSliderBtn" value="<?= ((isset($_GET['edit']))? 'Edit':'') ;?>  Slider" class="btn btn-info btn-lg btn-block px-2">
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
