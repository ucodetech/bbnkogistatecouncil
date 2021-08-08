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
  $exec = $db->getById('BBStateExecutives', 'id', $edit_id);

      if (isset($_POST['delete_image'])) {
        $image = $exec->exective_image;
        $image_url = URLROOT. 'uploads/executives/'.$image;
        unlink($image_url);
        // unset($image_url);
        $imageUpdate = "UPDATE BBStateExecutives SET exective_image = '' WHERE id = '$edit_id' ";
      Database::getInstance()->query($imageUpdate);

        Redirect::to('../command-editExecutive/'.$edit_id);
     }
  $executive_name = ((isset($_POST['executive_name']) && !empty($_POST['executive_name']))?$show->test_input($_POST['executive_name']):$exec->exective_name);

  $executive_office = ((isset($_POST['executive_office']) && !empty($_POST['executive_office']))?$show->test_input($_POST['executive_office']):$exec->executive_office);

  $executive_description = ((isset($_POST['executive_description']) && !empty($_POST['executive_description']))?$show->test_input($_POST['executive_description']):$exec->exective_description);


  $saved_image = (($exec->exective_image != '')?$exec->exective_image : '');
  $dbpath = $saved_image;
}
if ($_POST) {
  $required = array(
    'executive_name',
  'executive_office',
  'executive_description'
  );
  foreach ($required as $fields) {
    if (empty($_POST[$fields])) {
        $error .= 'No field should be blank!';
    }
  }
  if (!empty($_FILES)) {
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
      $Update = "UPDATE BBStateExecutives SET exective_name = $executive_name, exective_image = $dbpath, exective_description =
      $executive_description , executive_office = $executive_office  WHERE id = $edit_id";
      Database::getInstance()->query($Update);
      Session::flash('updated', 'Record Updated Successfully');
      Redirect::to('../../command-executives');
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
            <form class="px-3" action="<?= URLROOT;?>commander/editing/command-editExecutive/<?= $edit_id; ?>" method="post" enctype="multipart/form-data">

<div class="form-group col-lg-12">
  <div class="form-group text-danger"> <?=  $error ?> </div>

  </div>
<div class="form-group col-md-12">
  <?php if($saved_image != ''): ?>
    <div class="saved_image col-md-4">
      <img src="<?= URLROOT; ?>uploads/executives/<?=$saved_image?>" alt="Saved Image" class="img-fluid img-thumbnail lazy" width="208">
      <a href="../command-editExecutive/<?=$edit_id ?>" class="btn btn-danger px-3">Delete Image</a>
      <!-- <form class="form-inline" action="command-editExecutive/" method="post">
        <input type="submit" name="delete_image" value="Delete Image" class="btn btn-danger px-3">
      </form> -->

      </div>

          <?php else: ?>
            <div class="form-group col-md-12">
              <div class="custom-file">
               <input type="file" name="executive_image" id="executive_image"
               class="custom-file-input">
                <label for="file" class="custom-file-label">Select Files (executive image)</label>
             </div>
            </div>
        <?php endif; ?>

    </div>                  delete

                  <div class="row">

              <div class="form-group col-md-6">
                <label for="executive_name">Name</label>
                <input type="text" name="executive_name" id="executive_name" placeholder="Enter Executives Name" class="form-control form-control-lg" value="<?= $executive_name ?>">
              </div>

              <div class="form-group col-md-6">
                <label for="executive_office">Office</label>
                <input type="text" name="executive_office" id="executive_office" placeholder="Enter Executive Office" class="form-control form-control-lg" value="<?= $executive_office ?>">
              </div>

              <div class="form-group col-md-6">
                <label for="executive_description">Profile</label>
                <textarea  name="executive_description" id="executive_description" placeholder="Enter Executive Profile" class="form-control form-control-lg" rows="8">
                  <?= $executive_description ?>
                </textarea>
              </div>
              <div class="clearfix">  </div>
              <div class="form-group col-md-12">
                <input type="submit" name="editExecutive" value="<?= ((isset($_GET['edit']))? 'Edit':'') ;?>  Executive" class="btn btn-info btn-lg btn-block px-2">
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
