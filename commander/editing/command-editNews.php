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
  $news = $db->getById('news', 'id', $edit_id);

      if (isset($_POST['delete_image'])) {
        $image = $news->featuredImage;
        $image_url = URLROOT. 'uploads/featuredImage/'.$image;
        unlink($image_url);
        // unset($image_url);
        $imageUpdate = "UPDATE news SET featuredImage = '' WHERE id = '$edit_id' ";
        Database::getInstance()->query($imageUpdate);
        $stmt->execute();
        Redirect::to('../command-editNews/'.$edit_id);
     }
  $title = ((isset($_POST['title']) && !empty($_POST['title']))?$show->test_input($_POST['title']):$news->title);

  $description = ((isset($_POST['description']) && !empty($_POST['description']))?$show->test_input($_POST['description']):$news->description);


  $saved_image = (($news->featuredImage != '')?$news->featuredImage : '');
  $dbpath = $saved_image;
}
if ($_POST) {
  $required = array(
    'title',
  'description'
  );
  foreach ($required as $fields) {
    if (empty($_POST[$fields])) {
        $error .= 'No field should be blank!';
    }
  }
  if (!empty($_FILES)) {
         $file = $_FILES["news_image"]['name'];
         $RandomNum = rand(0, 10000);
         $news = 'presid';
         $FileName = str_replace(' ','-',strtolower($_FILES['news_image']['name']));
         $FileType = $_FILES['news_image']['type']; //"File/png", File/jpeg etc.
         $FileTemp = $_FILES["news_image"]["tmp_name"];
         $FileSize = $_FILES['news_image']['size'];
         $FileExt = substr($FileName, strrpos($FileName, '.'));
         $FileExt = str_replace('.','',$FileExt);
         $valid = array('jpg', 'png', 'jpeg');
         $FileName = preg_replace("/\.[^.\s]{3,4}$/", "", $FileName);
         $NewFileName = $FileName.'-'.$RandomNum.'-'. $news.'.'.$FileExt;
         $output_dir = '../../uploads/featuredImage/'.$NewFileName;//Path for file upload
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
      $Update = "UPDATE news SET title = '$title', description = '$description', featuredImage = '$dbpath'   WHERE id = '$edit_id' ";
      Database::getInstance()->query($Update);
      Session::flash('updated', 'Record Updated Successfully');
      Redirect::to('../../command-news');
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
          <h4 class="card-header bg-info border-info"><i class="fas fa-edit fa-lg"></i>&nbsp;<?= ((isset($_GET['edit']))? 'Edit':'') ;?> news</h4>
          <div class="card-body">

            <hr>
            <form class="px-3" action="<?= URLROOT;?>commander/editing/command-editNews/<?= $edit_id; ?>" method="post" enctype="multipart/form-data">

<div class="form-group col-lg-12">
  <div class="form-group text-danger"> <?=  $error ?> </div>

  </div>
<div class="form-group col-md-12">
  <?php if($saved_image != ''): ?>
    <div class="saved_image col-md-4">
      <img src="<?= URLROOT; ?>uploads/featuredImage/<?=$saved_image?>" alt="Saved Image" class="img-fluid img-thumbnail lazy" width="208">
      <a href="../command-editNews/<?=$edit_id ?>" class="btn btn-danger px-3">Delete Image</a>
      <!-- <form class="form-inline" action="command-editExecutive/" method="post">
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
                <input type="file" name="news_image" id="news_image" class="dropzone">
              </div>

            </div>
        <?php endif; ?>

    </div>
                  <div class="row">

                    <div class="form-group col-md-6">
                      <label for="title">News Title</label>
                      <input type="text" name="title" id="title" placeholder="Enter news title" class="form-control form-control-lg" value="<?= $title ?>">
                    </div>



                    <div class="form-group col-md-6">
                      <label for="description">News Description</label>
                      <textarea  name="description" id="description" placeholder="Enter news Description" class="form-control form-control-lg" rows="8">
                        <?= $description ?>
                      </textarea>
                    </div>
              <div class="clearfix">  </div>
              <div class="form-group col-md-12">
                <input type="submit" name="editnews" value="<?= ((isset($_GET['edit']))? 'Edit':'') ;?>  news" class="btn btn-info btn-lg btn-block px-2">
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
