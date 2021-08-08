<?php
require_once '../../core/init.php';
 if (!isLoggedInOfficer()) {
      Session::flash('access-denied', 'Access Denied! You must login to access the page');
      Redirect::to('access');
    }
    if (!hasPermission()) {
      Session::flash('access-denied', 'Access Denied! You have permission to access that page');
      Redirect::to('access');
    }
require APPROOT .'/includes/head2.php';
require APPROOT .'/includes/navs.php';
$db = new Officers(); 
?>
<?php 

  if (isset($_GET['control']) && !empty($_GET['control'])) {
    $controller = (int)$_GET['control'];

    if ($controller == $_SESSION[Config::get('session/session_nameUr')]) {
      ?>
       <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-lg-12 mt-3 mb-3">
       
          <div class="card" style="border:1px solid blue">
            <div class="card-header lead text-center bg-primary text-white">
              <i class="fas fa-form fa-lg"></i>Fill Form!
            </div>
            <div class="card-body">
          <h3 class="text-muted text-center"> Officer Reporting Details</h3><hr>
          <form  action="#" method="post" id="dataFormPatrons" class="px-3">
            <div class="row">
            <input type="hidden" name="controller_id" id="controller_id" value="<?=$officer->officer_id  ?>">
            <div class="form-group col-md-6">
              <label>Church</label>
              <input type="text" name="church" id="church" class="form-control form-control-lg" readonly value="<?= $officer->officers_home_church ?>" required>
            </div>
            <div class="form-group col-md-6">
              <label>Company Code</label>
              <input type="text" name="companyCode" id="companyCode" class="form-control form-control-lg" readonly value="<?= $officer->officers_company_code ?>" required>
            </div>
            <div class="form-group col-md-6">
              <label>Battalion/Group Council</label>
              <input type="text" name="council" id="council" class="form-control form-control-lg" readonly value="<?= $officer->officers_group_council ?>" required>
            </div>
            <div class="form-group col-md-6">
               <label>Name</label>
              <input type="text" name="officer_name" id="officer_name" class="form-control form-control-lg" readonly value="<?= $officer->officers_name ?>" required>
            </div>
            <div class="form-group col-md-6">
              <label>Office</label>
              <input type="text" name="office" id="office" class="form-control form-control-lg" readonly value="<?= $officer->designation_company?>" required>
            </div>
           
          </div><hr>
         <h3 class="text-muted text-center">Data Form Info</h3><hr>
          <div id="showError">
          	<div class="alert alert-info alert-dismissible">
			<button type="button" class="close" data-dismiss="alert">
			&times;
			</button>
			<strong class="text-center">For Qualification, Leave blank if the patron does not have any! and For Last Year of Training select <span class="text-danger">0000</span> if the patron have not undergo any training!</strong>
			</div>
          	
          </div><br>

          <div class="row">
            
            <div class="form-group col-md-6">
              <label for="form-control">Patron's Name <sup class="text-danger">*</sup></label>
              <input type="text" name="Name" id="Name" class="form-control form-control-lg" placeholder="Enter  Name" required>
            </div>
            
            <div class="form-group col-md-6">
              <label for="form-control">State ID</label>
              <input type="text" name="stateNo" id="stateNo" class="form-control form-control-lg" placeholder="Leave Blank if no State ID">
            <div class="custom-control custom-checkbox float-left">
             <input type="checkbox" name="DntHave" id="DntHave"  class="custom-control-input" />
             <label for="DntHave" class="custom-control-label">Don't Have</label>
           </div><br>
           <small class="text-muted">If mother does not have state ID thick this box</small>
            </div>

             <div class="form-group col-md-6">
              <label for="form-control">BB Highest Qualification <sup class="text-danger">*</sup></label>
              <?php 
                $qualification = '';
                $qualifations = $db->selectTable('BBQualification', 0);
               ?>
              <select name="qualification" id="qualification" class="form-control form-control-lg">

                <option value="" <?= (($qualification == ''))? ' selected' : ''  ?>readonly>Select  qualification</option>
                <?php foreach ($qualifations as $qua): ?>
                  <option value="<?= $qua->qua_s ?>"<?= (($qualification == $qua->qua_s))? ' selected' : ''  ?>><?= $qua->qua_s ?></option>
                <?php endforeach ?>
                

              </select>
            </div>

             <div class="form-group col-md-6">
              <label for="form-control">Year of Last Training</label>
              <?php 
              	$lastTraining = '';
              	$select = $db->selectTable('Allyears', 0);
               ?>
              <select name="lastTraining" id="lastTraining" class="form-control form-control-lg">

              	<option value="" <?= (($lastTraining == ''))? ' selected' : ''  ?>readonly>Select  year of last training</option>
              	<?php foreach ($select as $year): ?>
              		<option value="<?= $year->year_s ?>"<?= (($lastTraining == $year->year_s))? ' selected' : ''  ?>><?= $year->year_s ?></option>
              	<?php endforeach ?>
              	

              </select>
            </div>

            <div class="form-group col-md-6">
              <input type="submit" name="addPatron" id="addPatronBtn" value="Add Patron" class="btn btn-info btn-block btn-lg">
            </div>
            <div class="col-md-6">
                <button  id="RedirectBoyOnly" class="btn btn-md btn-block btn-danger">
               Click me after adding all the officers!
                </button> 
               
                </div>
          </div>
          </form>
        </div>
          </div>
          
      </div>
    </div>
  </div>

      <?
      
    }else if ($controller != $_SESSION[Config::get('session/session_nameUr')]){

      $sql = "SELECT * FROM WarningTable WHERE officer_id = ?";
      $stmt = $db->_pdo->prepare($sql);
      $stmt->execute([$officer->officer_id]);
      $countTimes = $stmt->rowCount();

      if ($countTimes) {
      $sql = "UPDATE WarningTable SET UnauthorizeAccessFailed = UnauthorizeAccessFailed + 1  WHERE officer_id = ? ";
      $st = $db->_pdo->prepare($sql);
      $st->execute([$officer->officer_id]);
      }else{

      $sql = "INSERT INTO WarningTable (officer_id, UnauthorizeAccessFailed) VALUES (?, 1)";
      $st = $db->_pdo->prepare($sql);
      $st->execute([$officer->officer_id]);
    }
      ?>
      <div class="container h-100" style="font-family: Poppins;">
      <div class="row h-100 align-items-center justify-content-center">
        <div class="col-lg-10">
          <div class="card border-warning shadow-lg">
            <div class="card-header bg-warning">
              <h3 class="m-0 text-danger text-center">
                <i class="fas fa-warning fa-lg"></i>&nbsp; BE CAREFUL
              </h3>
            </div>
            <div class="card-body text-dark">
          <div class="row">
            <div class="col-lg-6">
              <img src="../../../images/use.jpg" alt="Warning" class="img-fluid" widthi="408">
            </div>
            <div class="col-lg-6">
            <h4 class="text-danger"><i class="fa fa-warning fa-lg"></i>Warning</h4>
            <p>You are Attempting to access something that doesnt belong to you!</p>
            <h3 class="text-danger text-center">This is your last chance <br>
              <img src="../../../images/danger.jpg" alt="Warning" class="img-fluid img-thumbnail" widthi="108">
            </h3>

            </div>
          </div>
            </div>
          </div>
        </div>
      </div>
    </div>

      <?

    }


  }

 ?>
 
<style>
  input[type="text"], input[type="date"]{
    border: 0;
    background: none;
    outline: none;
    border-bottom: 2px solid #000;
  }
</style>
<?php require APPROOT .'/includes/footer2.php'; ?>
<script type="text/javascript">
  $(document).ready(function(){
    //send feedback ajax
      $('#addPatronBtn').click(function(e){
      if($('#dataFormPatrons')[0].checkValidity()){
        e.preventDefault();
          $(this).val('Please wait...');
          $.ajax({
            url: '../data-process.php',
            method: 'post',
            data: $('#dataFormPatrons').serialize()+'&action=addInfoPatron',
            success:function(response){
              console.log(response);
              if ($.trim(response) === 'true') {
                $('#dataFormPatrons')[0].reset();
                $('#addPatronBtn').val('Add Patron');
                $('#showError').html('<span class="text-success">Patron Added!</span>');
  
            }else{
              $('#showError').html(response);
            }

            }
          });

      }
    });

  
  $('#RedirectBoyOnly').click(function(e){
    e.preventDefault();
    $('#RedirectBoyOnly').html('<img src="<?= URLROOT;  ?>gif/star.gif"> Redirecting Please wait...');
      setInterval(function(){

        window.location = '<?=URLROOT?>officers/dashboard';
      }, 8000);
  });

  })
</script>

