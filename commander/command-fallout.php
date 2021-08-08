<?php
require_once '../core/init.php';
  Session::delete(Config::get('session/session_nameAd'));
  Redirect::to('command-access');
