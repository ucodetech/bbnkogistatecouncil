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
  $sso = $db->getById('BBStateSSO', 'id', $edit_id);

      if (isset($_POST['delete_image'])) {
        $image = $sso->sso_image;
        $image_url = URLROOT. 'uploads/sso-president/'.$image;
        unlink($image_url);
        // unset($image_url);
        $imageUpdate = "UPDATE BBStateSSO SET sso_image = '' WHERE id = '$edit_id' ";
        Database::getInstance()->query($imageUpdate);
        Redirect::to('../command-editSSO/'.$edit_id);
     }
  $sso_name = ((isset($_POST['sso_name']) && !empty($_POST['sso_name']))?$show->test_input($_POST['sso_name']):$sso->sso_name);

  $sso_office = ((isset($_POST['sso_office']) && !empty($_POST['sso_office']))?$show->test_input($_POST['sso_office']):$sso->sso_office);

  $sso_description = ((isset($_POST['sso_description']) && !empty($_POST['sso_description']))?$_POST['sso_description']:$sso->sso_profile);


  $saved_image = (($sso->sso_image != '')?$sso->sso_image : '');
  $dbpath = $saved_image;
}
if ($_POST) {
  $required = array(
    'sso_name',
  'sso_office',
  'sso_description'
  );
  foreach ($required as $fields) {
    if (empty($_POST[$fields])) {
        $error .= 'No field should be blank!';
    }
  }
  if (!empty($_FILES)) {
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

  }
  if (!empty($_FILES)) {
      move_uploaded_file($FileTemp ,$output_dir);
  }
  if ($error == '') {
    if (isset($_GET['edit'])) {
      $Update = "UPDATE BBStateSSO SET sso_name = '$sso_name', sso_image = '$dbpath', sso_profile = '$sso_description' , sso_office ='$sso_office'  WHERE id = '$edit_id' ";
      Database::getInstance()->query($Update);
      Session::flash('updated', 'Record Updated Successfully');
      Redirect::to('../../command-topOffical');
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
          <h4 class="card-header bg-info border-info"><i class="fas fa-edit fa-lg"></i>&nbsp;<?= ((isset($_GET['edit']))? 'Edit':'') ;?> SSO</h4>
          <div class="card-body">

            <hr>
            <form class="px-3" action="<?= URLROOT;?>commander/editing/command-editSSO/<?= $edit_id; ?>" method="post" enctype="multipart/form-data">

<div class="form-group col-lg-12">
  <div class="form-group text-danger"> <?=  $error ?> </div>

  </div>
<div class="form-group col-md-12">
  <?php if($saved_image != ''): ?>
    <div class="saved_image col-md-4">
      <img src="<?= URLROOT; ?>uploads/sso-president/<?=$saved_image?>" alt="Saved Image" class="img-fluid img-thumbnail lazy" width="208">
      <a href="../command-editSSO/<?=$edit_id ?>" class="btn btn-danger px-3">Delete Image</a>
  <!-- <form class="form-inline" action="command-editSSO/<?=$edit_id ?>" method="post">
        <input type="submit" name="delete_image" value="Delete Image" class="btn btn-danger px-3">
      </form> -->

      </div>

          <?php else: ?>
            <div class="form-group">
              <label class="control-label">Upload File</label>
              <div class="preview-zone hidden">
                <div class="box box-solid">
                  <div class="box-header with-border">
                    <div><b>Preview</b></div>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-danger btn-xs remove-preview">
                        <i class="fa fa-times"></i> Change Image
                      </button>
                    </div>
                  </div>
                  <div class="box-body"></div>
                </div>
              </div>
              <div class="dropzone-wrapper">
                <div class="dropzone-desc">
                  <i class="fas fa-upload fa-lg"></i>
                  <p>Choose an image file or drag it here.</p>
                </div>
                <input type="file" name="SSO_image" id="SSO_image" class="dropzone">
              </div>

            </div>
        <?php endif; ?>

    </div>
                  <div class="row">

                    <div class="form-group col-md-6">
                      <label for="sso_name">Name</label>
                      <input type="text" name="sso_name" id="sso_name" placeholder="Enter SSO Name" class="form-control form-control-lg" value="<?= $sso_name ?>">
                    </div>

                    <div class="form-group col-md-6">
                      <label for="sso_office">Office</label>
                      <input type="text" name="sso_office" id="sso_office" placeholder="Enter SSO Office" class="form-control form-control-lg" value="<?= $sso_office ?>">
                    </div>

                    <div class="form-group col-md-6">
                      <label for="sso_description">Profile</label>
                      <textarea  name="sso_description" id="sso_description" placeholder="Enter SSO Profile" class="form-control form-control-lg" rows="8"><?= $sso_description ?> </textarea>
                    </div>
              <div class="clearfix">  </div>
              <div class="form-group col-md-12">
                <input type="submit" name="editSSO" value="<?= ((isset($_GET['edit']))? 'Edit':'') ;?>  SSO" class="btn btn-info btn-lg btn-block px-2">
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
