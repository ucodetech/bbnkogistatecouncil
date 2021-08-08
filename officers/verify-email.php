<?php
require_once '../core/init.php';

if (isset($_GET['token'])) {
  $token = $_GET['token'];


      if (empty($token)) {
        Redirect::to('ur-profile');
      }else{
          $verify =  $user->selectToken($token, $officer->officer_id);
          if ($verify===flase) {
            Redirect::to('ur-profile');
          }else{
              $id = $verify->user_id;
              $user->verify_email($id);
              $user->deleteVkey($officer->officer_id);
              Redirect::to('ur-profile');
            }

      }
}
