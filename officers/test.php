<?php
require_once '../core/init.php';
if (!isLoggedInStudent()) {
    Session::flash('access-denied', 'Access Denied! You must login to access the page');
  Redirect::to('access');

}
require APPROOT .'/includes/head2.php';
require APPROOT .'/includes/navs.php';
?>

  <div class="container">
    <?php
    if (isset($_POST['upBtn']) ) {

    foreach($_FILES['image']['tmp_name'] as $key => $image) {

    $RandomNum = md5(microtime());
    $FileName = str_replace(' ','-',strtolower($_FILES['image']['name'][$key]));
    $FileType = $_FILES['image']['type'][$key]; //"File/png", File/jpeg etc.
    $FileTemp = $_FILES["image"]["tmp_name"][$key];
    $FileExt = substr($FileName, strrpos($FileName, '.'));
    $FileExt = str_replace('.','',$FileExt);
    $valid = array('png','pdf');
    $FileName = preg_replace("/\.[^.\s]{3,4}$/", "", $FileName);
    $NewFileName = $FileName.'-'.$RandomNum.'.'.$FileExt;
    $dbpath = $NewFileName;
    // $output_dir = 'uploads/'.$NewFileName;//Path for file upload
   if (!in_array(strtolower($FileExt), $valid)) {
     flash('message', 'Invalid Extension', 'alert alert-danger');

   }

    // if (!is_dir($output_dir)) {
    //   mkdir($output_dir='uploads', 755, true);
    //
    // }
    if ( move_uploaded_file($FileTemp , $output_dir = 'files/'.$NewFileName)) {
        echo $NewFileName . ' Uploaded Successfully!';
    }



        }



    }
     ?>
    <form class="form" action="" method="post" id="UploadFile" enctype="multipart/form-data">
      <input type="file" name="image[]" id="image" class="form-control" multiple>
      <button type="submit" name="upBtn" id="upBtn" class="btn btn-success">Upload Multiple File</button>
    </form>
  </div>

<?php require APPROOT .'/includes/footer2.php'; ?>
