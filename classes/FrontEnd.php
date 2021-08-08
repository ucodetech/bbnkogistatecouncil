<?php

  class FrontEnd extends DB {

    public function getOfficals($table, $val, $vals)
    {
    
    $sql = "SELECT * FROM $table WHERE id = $val AND deleted = $vals LIMIT 1";
    $stmt = $this->_pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    return $result;
    }


    public function getHistory($table, $val)
    {
      $sql = "SELECT * FROM $table WHERE id = $val LIMIT 1";
      $stmt = $this->_pdo->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_OBJ);
      return $result;
    }

    public function getStateEx($table, $val)
    {
      $sql = "SELECT * FROM $table WHERE deleted = $val";
      $stmt = $this->_pdo->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_OBJ);
      return $result;
    }

    public function getById($table, $id)
    {
      $sql = "SELECT * FROM $table WHERE id = ?";
      $stmt = $this->_pdo->prepare($sql);
      $stmt->execute([$id]);
      $result = $stmt->fetch(PDO::FETCH_OBJ);
      return $result;
    }

    public function getIntroduction($table, $val, $vals)
    {
     
    $sql = "SELECT * FROM $table WHERE id = $val AND deleted = $vals LIMIT 1";
    $stmt = $this->_pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    return $result;
    }



public function subNews($email){
  $sql = "INSERT INTO `news-subscribers` (`subscriber_email`) VALUES (?) ";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$email]);
  return true;
}

public function selectSubscribers($email){
    $sql = "SELECT * FROM `news-subscribers` WHERE subscriber_email = ?";
    $stmt = $this->_pdo->prepare($sql);
    $stmt->execute([$email]);
    $result = $stmt->fetch(PDO::FETCH_OBJ);
    return $result;
}

public function activity($id){
    $sql = "UPDATE officers SET last_login = NOW() WHERE officer_id = ?";
    $stmt = $this->_pdo->prepare($sql);
    $stmt->execute([$id]);
    return true;
}

public function selectTable($val)
{
  $sql = "SELECT * FROM `news` WHERE published = $val AND deleted = 0 ORDER BY id DESC";
    $stmt = $this->_pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

public function selectTables($table, $val)
{
  $sql = "SELECT * FROM $table  WHERE  deleted = $val ORDER BY id DESC";
    $stmt = $this->_pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

//Send comment
public function sendComment($parent, $comment_content, $comment_sender_name, $news_id, $comment_sender_email){
  $sql = "INSERT INTO `newsComment`  (parent_comment_id, comment, comment_sender_name, news_id, comment_sender_email) VALUES (?,?,?,?, ?)  ";
  $stmt = $this->_pdo->prepare($sql);
  $stmt ->execute([$parent, $comment_content, $comment_sender_name, $news_id, $comment_sender_email]);
  return true;
}
//fetch comment
public function getComment($newsid){
  $sql = "SELECT * FROM `newsComment` WHERE parent_comment_id = 0 AND news_id = ?  ORDER BY id DESC ";
  $stmt = $this->_pdo->prepare($sql);
  $stmt->execute([$newsid]);
  $result = $stmt->fetchAll(PDO::FETCH_OBJ);
  return $result;
}

public function getCommentReply($id){
  $query = "SELECT * FROM `newsComment` WHERE parent_comment_id = ?  ";
    $stmt = $this->_pdo->prepare($query);
    $stmt->execute([$id]);
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    $count = $stmt->rowCount();
    return $result;
    return $count;
}



  }
