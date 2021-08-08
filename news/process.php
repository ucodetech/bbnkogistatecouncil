<?php 
require_once '../core/init.php';
$warhead = new FrontEnd();

if (isset($_POST['query'])) {
    $inputText = strtolower($_POST['query']);
$sql =  "SELECT *  FROM news WHERE title LIKE '%$inputText%' AND published = 1 AND deleted = 0 ";
$stmt = $warhead->_pdo->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_OBJ);
 
    if ($data) {
        foreach ($data as $row) {
         echo '<a href="'.URLROOT.'news/read/'.$row->slug_url.'" class="list-group-item list-group-item-action">'.$row->title.'</a> ';
        }
    }else{
        echo '<a  class="list-group-item list-group-item-action">No record found</a> ';
    }
}



if (isset($_POST['action']) && $_POST['action'] == 'recentPost') {
	$current = $_POST['current'];
	$sql = "SELECT * FROM `news` WHERE published = 1 AND deleted = 0 AND id != '$current' ORDER BY id DESC";
    $stmt = $warhead->_pdo->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_OBJ);
  $output = '';
  if ($data) {
    foreach ($data as $r) {
    	if ($r->featuredImage != '') {
    		$featured = '<img data-src="'.URLROOT.'uploads/featuredImage/'.$r->featuredImage.'" class="img-thumbnail lazy" alt="'.$r->title.'" src="'.URLROOT.'uploads/featuredImage/'.$r->featuredImage.'" width="100">';
    	}else{
    		$featured = '<img data-src="'.URLROOT.'images/bbl.jpg" class="img-thumbnail lazy" alt="'.$r->title.'" src="'.URLROOT.'images/bbl.jpg" width="100">';
    	}
      $output .= '
      <ul class="list-unstyled m-0">
      <a href="'.URLROOT.'news/read/'.$r->slug_url.'" class="page-link border-0">
        <li class="media">
          '.$featured.'
          <div class="media-body ml-2">
            <h6 class="text-info mb-1">'.$r->title.'</h6>
            <p class="small text-muted m-0">
              '.pretty_dates($r->dateCreated).'
            </p>
          </div>
        </li>
      </a>
    </ul>';
    }
    echo $output;
  }else{
    echo '<h3 class="text-center text-secondary px-3"> No Recent Post Yet</h3>';
  }
}

// comment
