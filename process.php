<?php
require_once 'core/init.php';
$company = new FrontEnd();

if (isset($_POST['execute_id'])) {
    $id = (int)$_POST['execute_id'];

    $detail = $company->getById('BBStateExecutives', $id);
    if ($detail) {
      echo json_encode($detail);
    }
}

if (isset($_POST['topsso_id'])) {
    $idsso = (int)$_POST['topsso_id'];
    $output = '';
    $detailsso = $company->getById('BBStateSSO', $idsso);
    if ($detailsso) {

     $output .=' 
     <div class="modal-header">
             <h4 class="modal-title text-dark">'.$detailsso->sso_name.'</h4>
             <button type="button" class="close" data-dismiss="modal">&times;</button>
           </div>
           <div class="modal-body text-dark">
          <span class="text-center text-info">'.strtoupper($detailsso->sso_office).'</span><hr>
        
        <div class="row">
              <div class="col-lg-8">
              <p  class="text-justify">'.nl2br($detailsso->sso_profile).'</p>
              </div>  
              <div class="col-lg-4">
                <img data-src="uploads/sso-president/sso.png" class="img-fluid"  src="uploads/sso-president/sso.png" alt="'.$detailsso->sso_name.'" width="408">
              </div>
            </div>
            </div>
         <div class="modal-footer">
             <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
           </div>
            ';

    }
    echo $output;
}

if (isset($_POST['toppre_id'])) {
    $idpre = (int)$_POST['toppre_id'];
     $output = '';
    $detailpre = $company->getById('BBStatePresident', $idpre);
    if ($detailpre) {
        $output .=' 
     <div class="modal-header">
             <h4 class="modal-title text-dark">'.$detailpre->president_name.'</h4>
             <button type="button" class="close" data-dismiss="modal">&times;</button>
           </div>
           <div class="modal-body text-dark">
          <span class="text-center text-info">'.strtoupper($detailpre->president_office).'</span><hr>
        
        <div class="row">
              <div class="col-lg-8">
              <p  class="text-justify">'.nl2br($detailpre->president_profile).'</p>
              </div>  
              <div class="col-lg-4">
                <img data-src="uploads/sso-president/'.$detailpre->president_image.'" class="img-fluid"  src="uploads/sso-president/'.$detailpre->president_image.'" alt="'.$detailpre->president_name.'" width="408">
              </div>
            </div>
            </div>
         <div class="modal-footer">
             <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
           </div>
            ';

    }
    echo $output;
    }



if (isset($_POST['action']) && $_POST['action'] == 'subscribe') {
    $email = $company->test_input($_POST['sub-email']);

    if (empty($_POST['sub-email'])) {
        echo $company->showMessage('danger', 'E-Mail is required!');
        return false;
    }else{
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo $company->showMessage('danger', 'E-Mail is invalid!');
            return false;
        }
    }

    $check = $company->selectSubscribers($email);
    if ($check) {
        echo $company->showMessage('info', 'You have already Subscribe for updates! thanks!');
            return false;
    }

    $send = $company->subNews($email);
    if ($send) {
        echo 'true';
    }

}


if(isset($_POST['action']) && $_POST['action'] == "update_time"){
      $id =  $officer->officer_id;
       $company->activity($id);
    }
 
 
 if (isset($_POST['action']) && $_POST['action'] == 'hits') {
  $sql = "UPDATE websiteHits SET hits = hits+1 WHERE id = 0";
  $stmt = $company->_pdo->prepare($sql);
  $stmt->execute();


}