<?php
require_once '../core/init.php';
  $user = new Officers();
  Session::delete(Config::get('session/session_nameUr'));
  Redirect::to('../');
