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
  $award = $db->getById('awardWinners', 'id', $edit_id);


      if (isset($_GET['delete_image'])) {
        $imgi = (int)$_GET['imgi'] - 1;
        $images = explode(',', $award->award_images);
        $image_url = $URLROOT. 'uploads/awards/'.$images[$imgi];
        unlink($image_url);
        unset($images[$imgi]);
        $imageString = implode(', ',$images);
        $imageUpdate = "UPDATE awardWinners SET award_image = '{$imageString}' WHERE id = '$edit_id' ";
        $stmt = $db->_pdo->prepare($imageUpdate);
        $stmt->execute();
        Redirect::to('../command-editAward/'.$edit_id);
      }
  $award_name = ((isset($_POST['award_name']) && !empty($_POST['award_name']))?$show->test_input($_POST['award_name']):$award->award_name);

  $award_event_title = ((isset($_POST['award_event_title']) && !empty($_POST['award_event_title']))?$show->test_input($_POST['award_event_title']):$award->award_event_title);

  $award_event_description = ((isset($_POST['award_event_description']) && !empty($_POST['award_event_description']))?$show->test_input($_POST['award_event_description']):$award->award_event_description);

  $saved_image = (($award->award_images != '')?$award->award_images : '');
  $dbpath = $saved_image;
}
if ($_POST) {
  $required = array(
  'award_name',
  'award_event_title',
  'award_event_description',
  );
  foreach ($required as $fields) {
    if (empty($_POST[$fields])) {
        $error .= 'No field should be blank!';
    }
  }

   $filesCount = count($_FILES['award_image']['name']);
      if ($filesCount > 0) {
      for($i=0; $i<$filesCount; $i++){
        $RandomNums = rand(0, 10000);
        $FileNames = str_replace(' ','-',strtolower($_FILES['award_image']['name'][$i]));
        $FileTypes = $_FILES['award_image']['type'][$i]; //"File/png", File/jpeg etc.
        $FileTemps[] = $_FILES["award_image"]["tmp_name"][$i];
        $FileExts = substr($FileNames, strrpos($FileNames, '.'));
        $FileExts = str_replace('.','',$FileExts);
        $valids = array('png', 'jpg', 'jpeg');
        $FileNames = preg_replace("/\.[^.\s]{3,4}$/", "", $FileNames);
        $NewFileNames = $FileNames.'-'.$RandomNums.'.'.$FileExts;
        $output_dirs[] = '../../uploads/awards/'.$NewFileNames;//Path for file upload
       if (!in_array(strtolower($FileExts), $valids)) {
         echo $show->showMessage('danger', 'Invalid Extension','warning');
       }
        if ($i != 0) {
          $dbpath .= ', ';
        }
        $dbpath .= $NewFileNames;
 }
}



   if ($filesCount > 0) {
   	 for ($i=0; $i<$filesCount; $i++) {
      move_uploaded_file($FileTemps[$i],$output_dirs[$i]);
    }
   }

  if ($error == '') {
    if (isset($_GET['edit'])) {
	 $sql = "UPDATE awardWinners SET award_name = '$award_name', award_images = '$dbpath', award_event_title = '$award_event_title', award_event_description = '$award_event_description' WHERE id = '$edit_id' ";

      if (!Database::getInstance()->query($sql)) {
      	echo 'error occured!';
      }else{
      	 Session::flash('updated', 'Award Updated Successfully');
      Redirect::to('../../command-awardwinners');
      }

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
          <h4 class="card-header bg-info border-info"><i class="fas fa-edit fa-lg"></i>&nbsp;<?= ((isset($_GET['edit']))? 'Edit':'') ;?> Award</h4>
          <div class="card-body">

            <hr>
            <form class="px-3" action="<?= URLROOT;?>commander/editing/command-editAward/<?= $edit_id; ?>" method="post"  enctype="multipart/form-data">
              <div class="form-group">
                <h5 class="text-danger"><?php echo $error ?></h5>
              </div>

                <div class="form-group col-lg-12">

    <div class="form-group col-md-12">
          <?php if($saved_image != ''): ?>
          	 <?php
         $imgi = 1;
         $images = explode(', ', $saved_image);?>
         <div class="row">
         <?php foreach ($images as $image): ?>

            <div class="saved_image col-md-4">

              	<img src="<?= URLROOT; ?>uploads/awards/<?=$image?>" alt="Saved Image" class="img-fluid img-thumbnail lazy" width="108">

              <a class="btn btn-danger" href="command-editAward.php?delete_image=1&edit=<?=$edit_id;?>&imgi=<?=$imgi;?>">Delete Image</a>
             <!--  <form class="form-inline" action="command-editAward/<?=$edit_id;?>&imgi=<?=$imgi;?>" method="post">
                <input type="submit" name="delete_image" value="Delete Image" class="btn btn-danger px-3">
              </form> -->

              </div>
		       <?php
		          $imgi++;
		      endforeach; ?>
		 </div>

            <?php else: ?>


                  <div class="custom-file">
                   <input type="file" name="award_image[]" id="award_image"
                   class="custom-file-input" multiple>
                    <label for="file" class="custom-file-label">Select Files (Award image)</label>
                 </div>

          <?php endif; ?>

                  </div>
                       <div class="row">

                    <div class="form-group col-md-6">
                      <label for="award_name">Name Of Winner</label>
                      <input type="text" name="award_name" id="award_name" placeholder="Enter Award Name" class="form-control form-control-lg" value="<?=$award_name?>">
                    </div>

                    <div class="form-group col-md-6">
                      <label for="award_event_title">Award Ttitle</label>
                      <input type="text" name="award_event_title" id="award_event_title" placeholder="Enter Title of award" class="form-control form-control-lg" value="<?=$award_event_title?>">
                    </div>

                    <div class="form-group col-md-6">
                      <label for="award_event_description">Description</label>
                      <textarea  name="award_event_description" id="award_event_description" placeholder="Write...." class="form-control form-control-lg" rows="8">
                      	<?=$award_event_description ?>
                      </textarea>
                    </div>
                    <div class="clearfix">  </div>
                    <div class="form-group col-md-12">
                      <input type="submit" name="editAwardBtn" id="editAwardBtn" value="Edit Ward" class="btn btn-info btn-lg btn-block px-2">
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
