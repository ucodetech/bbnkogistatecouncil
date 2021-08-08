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
  $president = $db->getById('BBStatePresident', 'id', $edit_id);

      if (isset($_POST['delete_image'])) {
        $image = $president->president_image;
        $image_url = URLROOT. 'uploads/sso-president/'.$image;
        unlink($image_url);
        // unset($image_url);
        $imageUpdate = "UPDATE BBStatePresident SET president_image = '' WHERE id = '$edit_id' ";
          Database::getInstance()->query($imageUpdate);
        Redirect::to('../command-editPresident/'.$edit_id);
     }
  $president_name = ((isset($_POST['president_name']) && !empty($_POST['president_name']))?$show->test_input($_POST['president_name']):$president->president_name);

  $president_office = ((isset($_POST['president_office']) && !empty($_POST['president_office']))?$show->test_input($_POST['president_office']):$president->president_office);

  $president_description = ((isset($_POST['president_description']) && !empty($_POST['president_description']))?$_POST['president_description']:$president->president_profile);


  $saved_image = (($president->president_image != '')?$president->president_image : '');
  $dbpath = $saved_image;
}
if ($_POST) {
  $required = array(
    'president_name',
  'president_office',
  'president_description'
  );
  foreach ($required as $fields) {
    if (empty($_POST[$fields])) {
        $error .= 'No field should be blank!';
    }
  }
  if (!empty($_FILES)) {
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
         $NewFileName = $FileName.'-'.$RandomNum.'-'. $president.'.'.$FileExt;
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
      $Update = "UPDATE BBStatePresident SET president_name = '$president_name', president_image = '$dbpath', president_profile = '$president_description' , president_office = '$president_office'  WHERE id = '$edit_id' ";
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
          <h4 class="card-header bg-info border-info"><i class="fas fa-edit fa-lg"></i>&nbsp;<?= ((isset($_GET['edit']))? 'Edit':'') ;?> President</h4>
          <div class="card-body">

            <hr>
            <form class="px-3" action="<?= URLROOT;?>commander/editing/command-editPresident/<?= $edit_id; ?>" method="post" enctype="multipart/form-data">

<div class="form-group col-lg-12">
  <div class="form-group text-danger"> <?=  $error ?> </div>

  </div>
<div class="form-group col-md-12">
  <?php if($saved_image != ''): ?>
    <div class="saved_image col-md-4">
      <img src="<?= URLROOT; ?>uploads/sso-president/<?=$saved_image?>" alt="Saved Image" class="img-fluid img-thumbnail lazy" width="208">
<!--       <a href="../command-editPresident/<?=$edit_id ?>" class="btn btn-danger px-3">Delete Image</a>
 -->      <form class="form-inline" action="command-editPresident/<?=$edit_id ?>" method="post">
        <input type="submit" name="delete_image" value="Delete Image" class="btn btn-danger px-3">
      </form>

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
                <input type="file" name="President_image" id="President_image" class="dropzone">
              </div>

            </div>
        <?php endif; ?>

    </div>
                  <div class="row">

                    <div class="form-group col-md-6">
                      <label for="president_name">Name</label>
                      <input type="text" name="president_name" id="president_name" placeholder="Enter President Name" class="form-control form-control-lg" value="<?= $president_name ?>">
                    </div>

                    <div class="form-group col-md-6">
                      <label for="president_office">Office</label>
                      <input type="text" name="president_office" id="president_office" placeholder="Enter President Office" class="form-control form-control-lg" value="<?= $president_office ?>">
                    </div>

                    <div class="form-group col-md-6">
                      <label for="president_description">Profile</label>
                      <textarea  name="president_description" id="president_description" placeholder="Enter President Profile" class="form-control form-control-lg" rows="8">
                        <?= $president_description ?>
                      </textarea>
                    </div>
              <div class="clearfix">  </div>
              <div class="form-group col-md-12">
                <input type="submit" name="editPresident" value="<?= ((isset($_GET['edit']))? 'Edit':'') ;?>  President" class="btn btn-info btn-lg btn-block px-2">
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
