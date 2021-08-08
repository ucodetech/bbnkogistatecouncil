<?php 
require_once '../core/init.php';
$warhead = new FrontEnd();

$news_id = $_POST['news_id'];
$result = $warhead->getComment($news_id);

  $output = '';
  foreach ($result as $row) {
    $output .= '
   <div class="card mt-2 mb-2">
          <div class="card-header bg-primary px-0 py-0">
            <i class="fa fa-user"></i> By <b>'.$row->comment_sender_name.' </b> <span class="text-info on"> on</span>  <small><i>'.pretty_dates($row->comment_date).'</i></small>
          </div>
          <div class="card-body py-0 text-dark">
            <p class="comment">'.$row->comment.'</p>
     
          </div>
          <div class="card-footer bg-primary px-0 py-0" align="right">
            <button type="button" class="btn btn-xs btn-warning reply" id="'.$row->id.'"><i>Reply</i></button>
          </div>
    </div>

    ';
    $output .= get_reply_comment($row->id);

  }
  echo $output;

   function get_reply_comment($parent_id = 0, $marginleft = 0){
    $output = '';
    $db = new FrontEnd();

    $query = "SELECT * FROM newsComment WHERE parent_comment_id = '".$parent_id."'  ";
    $stmt = $db->_pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    $count = $stmt->rowCount();

    if ($parent_id == 0) {
      $marginleft = 0;
    }else{
      $marginleft = $marginleft + 48;
    }
    if ($count > 0) {
      foreach ($result as $row) {
        $output .='
          <div class="card" style="margin-left:'.$marginleft.'px">
          <div class="card-header bg-warning text-dark px-0 py-0">
            <i class="fa fa-user"></i> By <b>'.$row->comment_sender_name.' </b> <span class="text-info on"> on</span>  <small><i>'.pretty_dates($row->comment_date).'</i></small>
          </div>
          <div class="card-body py-0 text-dark">
            <p class="comment">'.$row->comment.'</p>
     
          </div>
          <div class="card-footer bg-warning px-0 py-0" align="right">
            <button type="button" class="btn btn-xs btn-info reply" id="'.$row->id.'"><i>Reply</i></button>
          </div>
    </div>
        ';
        $output .= get_reply_comment($row->id, $marginleft);
      }
    }
    return $output;

  }

?>
<style type="text/css">
  .on{
    padding-left: 10px;
  }
  .comment{
    margin: 0px;
    padding: 0px;
    text-align: justify;
    font-size: 16px;
  }
</style>