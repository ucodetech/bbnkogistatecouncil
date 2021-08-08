<?php
require_once '../../core/init.php';
//Add executives
$general = new General();
$show = new Show();
$cadet = new CadetConsole();
if (isset($_POST['action']) && $_POST['action'] == 'fetch_commanders') {
  $data = $general->selectTable('commanders', 0);
    $output = '';
    if ($data) {
      $output .= '<table class="table table-striped table-hover" id="showCommand">
        <thead>
          <tr>
            <th>#</th>
            <th>Image</th>
            <th>Name</th>
            <th>Permissions</th>
            <th>Access Name</th>
            <th>Last Login</th>
            <th>Action</th>

          </tr>
        </thead>
        <tbody>';
        $x = 0;
      foreach ($data as $command) {
        $x = $x + 1;
          $yes = "<img src='".URLROOT."commander/faceRecond/".$command->profile_pic."' class='' alt='".$command->commander_name."' width='70px' height='70px' style='border-radius:50px;'>";

        //check login $status
        $parade =   $cadet->loggedAdminSingle($command->command_id);

        if ($parade) {
          $online = '<span class="text-success">Active Now</span>';
        }else{
          $online =  timeAgo($command->last_login);
        }
        $permission = explode(',', $command->commander_permissions);
        $permissions = $permission[0];

        $output .= '

            <tr>
              <td>'.$x.'</td>
              <td>
              '.$yes.'
              </td>
             <td>'.$command->commander_name.'</td>
               <td>'.$permissions.'</td>
               <td>'.$command->commander_accessName.'</td>
               <td>'.$online.'</td>
               <td>
               <a href="#" id="'.$command->command_id.'" title="View commander Details" class="text-primary commandDetailsIcon" data-toggle="modal" data-target="#showCommandDetailsModal"><i class="fas fa-info-circle fa-lg"></i> </a>&nbsp;
                 <a href="#" id="'.$command->command_id.'" title="Edit commander" class="text-success editCommandBtn" data-toggle="modal" data-target="#editCommandModal"><i class="fa fa-edit fa-lg" ></i></a>&nbsp;
               <a href="#" id="'.$command->command_id.'" title="Trash commander" class="text-danger trashCommandIcon"><i class="fas fa-recycle fa-lg"></i> </a>

               </td>
              </tr>
              ';

        }

                $output .= '
                  </tbody>
                </table>';
                echo $output;
    }else{
      echo '<h3 class="text-center text-secondary lead px-3">No Commander on the database yet</h3>';
    }
}

if (isset($_POST['commander_id'])) {
  $commandctiveid = $_POST['commander_id'];
// $table, $field, $id
  $data = $general->getById('commanders','command_id', $commandctiveid);
  $output = '';
    $yes = "<img src='".URLROOT."commander/faceRecond/".$command->profile_pic."' class='img-thumbnail lazy' alt='".$data->commander_name."' width='208'>";
    //check login $status
    $parade =   $cadet->loggedAdminSingle($command->command_id);

    if ($parade) {
      $online = '<span class="text-success">Active Now</span>';
    }else{
      $online =  timeAgo($command->last_login);
    }
  if ($data->verified == 0) {
    $verified= '<span class="text-danger">Email Not Verified</span>';
  }else{
    $verified= '<span class="text-success">Email Verified</span>';

  }



  $output .= ' <span class="text-center text-dark">'.$data->commander_name.'</span>
   <ul class="list-unstyled m-0">
   <li class="media">
     '.$yes.'
     <div class="media-body ml-2">
       <h6 class="text-info mb-1">'.$data->commander_name.'</h6>
       <p>
       '.$data->commander_email.'
       </p>
       <p>
       '.$data->commander_phone_no.'
       </p>
       <p>
       '.$data->commander_permissions.'
       </p>
       <p>
       '.((empty($data->commander_home_church))? 'Not updated yet' : $data->commander_home_church).'
       </p>
       <p>
       '.$data->commander_accessName.'
       </p>
       <p>
       '.pretty_dates($data->dateAdded).'
       </p>
       <p>
       '.$online.'
       </p>
       <p>
       '.$verified.'
       </p>
     </div>
   </li>


</ul>';



  echo $output;
}



if (isset($_POST['commanderedit_id'])) {
    $commandid = $_POST['commanderedit_id'];
    $command = $general->getById('commanders','command_id', $commandid);

echo json_encode($command);
}

//Update Note Now
if (isset($_POST['action']) && $_POST['action'] == 'update_permission') {

    $commander_id  =  $show->test_input($_POST['commanderID']);
    $commander_name   =  $show->test_input($_POST['commander-name'] );
    $commander_email   =  $show->test_input($_POST['commander-email']);
    $commander_phone_no   =  $show->test_input($_POST['commander-tel']);
    $commander_home_church   =  $show->test_input($_POST['commander-church']);
    $commander_permission   =  $show->test_input($_POST['commander-permisson']);

    if (empty($_POST['commander-name'])) {
       echo $show->showMessage('danger', 'Commander Full name is required!','warning');
       return false;
    }
    if (empty($_POST['commander-email'])) {
       echo $show->showMessage('danger', 'Commander email is required!','warning');
       return false;
    }elseif(!filter_var($commander_email , FILTER_VALIDATE_EMAIL)){
      echo $show->showMessage('danger', 'Commander email is invalid!','warning');
      return false;
    }

       if (empty($_POST['commander-tel'])) {
          echo $show->showMessage('danger', 'Commander phone number is required!','warning');
          return false;
       }
    if (empty($_POST['commander-permission'])) {
       echo $show->showMessage('danger', 'Commander permission is required!','warning');
       return false;
    }

     $general->updateCommanders($commander_id ,$commander_name ,$commander_email,$commander_phone_no, $commander_home_church,$commander_permission);


}
