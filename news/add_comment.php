<?php 
require_once '../core/init.php';
$warhead = new FrontEnd();

   

   $error = '';
    $comment_sender_name = $warhead->test_input($_POST['comment_sender_name']);
    $comment_sender_email = $warhead->test_input($_POST['comment_sender_email']);
    $comment = $warhead->test_input($_POST['msg']);
  
     if (empty($_POST['msg'])) {
       $error .= '<span class="text-danger text-sm">Comment  must not be empty!</span>';
    }
    $news_id = $_POST['news_id'];
    $parent = $_POST['comment_id'];

   if ($error == '') {
      $warhead->sendComment($parent, $comment,$comment_sender_name,$news_id, $comment_sender_email);
   
  	   echo '<span class="text-success text-sm">Comment Added!</span>';

  
   }else{
        echo $error;
   }
    

  
    