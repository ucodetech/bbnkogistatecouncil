<?php

  function isLoggedInOfficer(){
      $user = new Officer();
    if ($user->isLoggedIn()) {
        return true;
     }else{
        return false;
     }


      }



  function isOTPset($useremail){
    $sql = "SELECT * FROM verifyAdmin WHERE sudo_email = '$useremail'";
     $check = Database::getInstance()->query($sql);
    if ($check->count()) {
      return true;
    }else{
      return false;
    }
  }

  function isOTPsetOfficer($useremail){
    $sql = "SELECT * FROM otp WHERE email = '$useremail'";
     $check = Database::getInstance()->query($sql);
    if ($check->count()) {
      return true;
    }else{
      return false;
    }
  }


function isCommanderGranted(){
      $admin = new CadetConsole();
      if ($admin->isIsLoggedIn()){
          return true;
      }else{
          return  false;
      }
}

function hasPermissionSuper($permission = 'sso'){
    $admin = new CadetConsole();
    if (isset($_SESSION[Config::get('session/session_admin')])) {

    $permissioned = $admin->data()->commander_permissions;

    $permissions = explode(',', $permissioned);
     if (in_array($permission, $permissions,true)) {
      return true;
     }
     return false;

   }
}


function hasPermissionCaptian($permission = 'captian'){
     $admin = new CadetConsole();
    if (isset($_SESSION[Config::get('session/session_admin')])) {

    $permissioned = $admin->data()->commander_permissions;

    $permissions = explode(',', $permissioned);
     if (in_array($permission, $permissions,true)) {
      return true;
     }
     return false;

   }

}

function hasPermissionSecGen($permission = 'secgen'){
     $admin = new CadetConsole();
    if (isset($_SESSION[Config::get('session/session_admin')])) {

    $permissioned = $admin->data()->commander_permissions;

    $permissions = explode(',', $permissioned);
     if (in_array($permission, $permissions,true)) {
      return true;
     }
     return false;

   }

}
function hasPermission($permission = 'bbn/ksc'){
    $off = new Officers();
    $currentUser = $_SESSION[Config::get('session/session_officer')];

    $permissioned = $off->data()->officers_permissions;

    $permissions = explode(',', $permissioned);
     if (in_array($permission, $permissions,true)) {
      return true;
     }
     return false;

   }
