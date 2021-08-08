<?php
require_once '../../core/init.php';
//Login
  $general = new General();
  $show = new Show();


  if (isset($_POST['action']) && $_POST['action'] == 'add_company') {

       $company = $show->test_input($_POST['companyNumber']);
       $church = $show->test_input($_POST['church']);
       $church  = strtoupper($church);


       if (empty($_POST['companyNumber'])) {
         echo $show->showMessage('danger', 'Company Number is required!','warning');
         return false;
       }

       if (empty($_POST['church'])) {
         echo $show->showMessage('danger', 'Church is required!','warning');
         return false;
       }

       $check = $general->selectCompany($company);
       if ($check) {
       	echo $show->showMessage('danger', $company.' Already Exists', 'warning');
         return false;
       }

       $add = $general->insertCompany($company, $church);
       if ($add) {
         echo 'success';
       }
  }

  //fetch Histroy
  if(isset($_POST['action']) && $_POST['action'] == 'fetch_company'){
      $output = '';

      $dat = $general->selectTable3('registeredCompanys',0);

      if ($dat) {

        $output .= '
        <table class="table table-striped table-hover" id="showCompanys">
          <thead>
            <tr>
              <th>#</th>
              <th>Company</th>
              <th>Church</th>
              <th>Action</th>

            </tr>
          </thead>
          <tbody>
        ';
        foreach ($dat as $row) {

      $output .= '
      <tr>
      <td>'.$row->id.'</td>
	  <td>'.$row->company_number.'</td>
	  <td>'.$row->church.'</td>
	  <td>
	  <a href="#" id="'.$row->id.'" title="Edit" class="text-success editCompBtn" data-toggle="modal" data-target="#editCompanyModal"><i class="fas fa-edit fa-lg"></i>
	  </a>
	 </td>
      </tr>
              ';
        }



        $output .= '
          </tbody>
        </table>';
        echo $output;
      }else{
        echo '<h3 class="text-center text-secondary align-self-center lead">No Data In database</h3>';
      }

  }
//edit history bb
if (isset($_POST['compedit_id'])) {
  $editid = (int)$_POST['compedit_id'];
  $edit = $general->getById('registeredCompanys', 'id', $editid);
  if ($edit) {
    echo json_encode($edit);
  }
}

//update history
if (isset($_POST['action']) && $_POST['action'] == 'update_company') {
       $editid = (int)$_POST['editCompanyID'];

       $company = $general->test_input($_POST['editcompanyNumber']);
       $church = $general->test_input($_POST['editchurch']);
       $church  = strtoupper($church);
       if (empty($_POST['editcompanyNumber'])) {
         echo $show->showMessage('danger', 'Company Number is required!','warning');
         return false;
       }

       if (empty($_POST['editchurch'])) {
         echo $show->showMessage('danger', 'Church is required!','warning');
         return false;
       }

       $check = $general->selectCompany2($company, $editid);
       if ($check) {
       	echo $show->showMessage('danger', $company.' Already Exists','warning');
         return false;
       }

      $update = $general->updateCompany($company,$church,$editid);
      if ($update) {
        echo 'updated';
      }else{
        echo 'Something went wrong';
      }

}
