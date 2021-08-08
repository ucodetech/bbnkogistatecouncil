<?php
    require_once '../core/init.php';
    require_once APPROOT . '/includes/head2.php';
    $db = new FrontEnd();

    if (isset($_GET['slug_url']) && !empty($_GET['slug_url'])) {
    	$slug_url = $_GET['slug_url'];

    	$sql = "SELECT * FROM news WHERE slug_url = ? AND deleted = 0";
    	$stmt = $db->_pdo->prepare($sql);
    	$stmt->execute([$slug_url]);
    	$row = $stmt->fetch(PDO::FETCH_OBJ);

    }

?>
<style>
	.gallery img{
    filter: grayscale(100%);
    transition: 1s;
    box-shadow: 0 0 5px 5px rgb(61, 18, 250);
}
.gallery img:hover{
    filter: grayscale(0);
    transform: scale(1.1);
}
</style>

<div class="container-fluid" style="margin:10px !important;">
	<button type="button" name="button" class="btn btn-lg  btn-info px-1 mb-1" onclick="window.history.back()"><i class="fa fa-arrow-left"></i> Go back </button>
<div class="row">
  <div class="col-lg-8">
    <header class="bg-dark text-light">
      <div class="container-fluid" style="height:10px !important; background:red;">  </div>
      <div class="col-lg-12">
        <div class="row">
          <div class="col-md-6">
            <h2><i class="fa fa-rss-square fa-lg text-warning"></i>
            	<?= $row->author; ?></h2>
          </div>
          <div class="col-md-6">
            <div class="float-right">
              <i class="fa fa-tint text-warning"></i>&nbsp;NEWS<br>
              <small class="text-secondary"><i><i class="fa fa-calendar text-warning"></i>&nbsp;<?= pretty_dates($row->dateCreated); ?></i> </small>
            </div>
          </div>
        </div>
        <div class="row">
        <div class="col-md-12 pb-2">
          <h4 class="text-center text-light"><?= $row->title; ?></h4><hr>
          <div class="text-secondary px-2 text-center">
              <span><i class="fa fa-calendar"></i>&nbsp;Date Created: <?= pretty_dates($row->dateCreated); ?></span>|
              <span><i class="fa fa-calendar"></i>&nbsp;By: <?= $row->author; ?></span>
          </div>
        </div>
        </div>
      </div>
      <div class="container-fluid">
      	<?php if ($row->featuredImage != ''): ?>
      		<img width="100%" height="215" src="<?= URLROOT; ?>uploads/featuredImage/<?=$row->featuredImage;?>" class="img-fluid border-0 pb-1" alt="<?=$row->title;?>" style="height:500px !important;">
      		<?php else: ?>
      		<img width="100%" height="215" src="<?= URLROOT; ?>images/bbl.jpg" class="img-fluid border-0 pb-1" alt="<?=$row->title;?>" style="height:500px !important;">
      	<?php endif ?>
        
        <!-- <div class="container mt-2 pb-2 mb-1">
          <p class="text-info lead align-justify">
              Get Video of this event from our youtube channel <a href="https://www.youtube.com/embed/" target="_blank" class="btn btn-sm btn-danger text-light font-weight-bold"><i class="fa fa-youtube fa-lg"></i>Youtube Channel</a>
          </p>
        </div> -->
      </div>
      <div class="container bg-light pb-3 m-0 pt-0">
        <p class="px-2 align-justify text-dark">
          <?=$row->description;?>
        </p>
      </div>
      <div class="container bg-light pb-3 m-0 pt-0">
      <span class="text-center text-secondary">Related Event Images</span><hr>
      <div class="row">
       <?php if ($newsImage = $db->getById('newsImages', $row->id)): ?>
       	
      	<?php 
      		$newsImage = $db->getById('newsImages', $row->id);
      		$images = explode(', ', $newsImage->images);
      	 ?>
      	 <?php foreach ($images as $img): ?>
      	<div class="col-lg-4 pb-2 gallery">
          <div class="card justify-content-center" style="flex-grow:1.4;">
            <div class="card-body">
           <a href="<?= URLROOT; ?>uploads/newsImages/<?=$img;?>" data-lightbox="<?=$img;?>" data-title="<?=$row->description; ?>" data-alt="<?=$row->title; ?>" data-lightbox="roadtrip">

              <img src="<?= URLROOT; ?>uploads/newsImages/<?=$img; ?>" alt="<?=$row->title; ?>" width="408" class="img-fluid" > <br>
          </a>
            </div>
          </div>
        </div>
      	 <?php endforeach ?>
      
        <?php else: ?>
        	<span class="text-muted text-center">No Related Images</span>
       <?php endif ?>
       
      </div>
      </div>
        
<div class="col-lg-12">
      <div class="container">
       <p class="text-center">Drop Comment</p>
     <form method="post" id="comment_form">
       <?php if (isLoggedInOfficer()): ?>

       <div class="form-group">
         <input type="text" name="comment_sender_name" id="comment_sender_name" class="form-control" placeholder="Name" value="<?= $data->officers_name ?>" readonly>
       </div>
       <div class="form-group">
         <input type="email" name="comment_sender_email" id="comment_sender_email" class="form-control" placeholder="Email" aria-describedby="comment_sender_email" value="<?= $data->officers_email ?>"  readonly>
         <small id="comment_sender_email" class="form-text text-muted">We'll never share your email with anyone else.</small>

       </div>
       	<?php else: ?>
       <div class="form-group">
         <input type="text" name="comment_sender_name" id="comment_sender_name" class="form-control" placeholder="Name">
       </div>
       <div class="form-group">
         <input type="email" name="comment_sender_email" id="comment_sender_email" class="form-control" placeholder="Email" aria-describedby="comment_sender_email">
         <small id="comment_sender_email" class="form-text text-muted">We'll never share your email with anyone else.</small>

       </div>
       <?php endif ?>
        <div class="form-group">

         <textarea name="msg" id="msg"  rows="5"  class="form-control form-control-lg rounded-5" style="font-size: 15px;"></textarea>
       </div>
        <div class="form-group">
          <input type="hidden" name="comment_id" id="comment_id" value="0">
           <input type="hidden" name="news_id" id="news_id" value="<?=$row->id; ?>">

         <input type="submit" name="commentBtn" id="commentBtn" class="btn btn-primary" value="Comment">
       </div>
     </form>
     <hr>
     <div class="clearfix"></div>
    <span id="comment_message"></span>
     <div id="display_comment" class="display_4 px-1">  </div>
   </div>


    </div>
<div class="container" style="height:10px; background:red"></div>
    </header>

  </div>
  <div class="col-lg-4 px-2 px-lg-3 mt-1" style="height: auto !important;">
      <div class="row">
        <!-- Search widget start -->
      <div class="card rounded-0 mb-3 shadow-lg">
        <div class="card-header rounded-0 py-1 text-center lead">Search</div>
        <div class="card-body">
          <form method="POST" action="#">
            <div class="input-group">
              <input type="text" id="search" name="search" class="form-control border-secondary rounded-0" placeholder="Search terms">
              <div class="input-group-append">
                <button class="btn btn-outline-secondary rounded-0" type="submit" id="searchBtn"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </form>
        </div>
        <div class="list-group" id="show-list" style="position:relative; margin-top:-28px;">
        </div>
      </div>

        <!-- Side Links -->
      <div class="card rounded-0 mb-3 shadow-lg" style="width:410px; overflow:hidden" scrolling="no">
        <div class="card-header rounded-0 py-3 text-center lead">Recent Events</div>
        <div class="card-body" id="recentPost">
           <p class="text-center align-self-center lead"><img src="<?php echo URLROOT; ?>gif/success.gif"> Please Wait...</p>
        </div>
        
      </div>
      <!-- youtube channel -->
      <div class="card rounded-0 mb-3 shadow-lg" style="width:410px;">
        <div class="card-header rounded-0 py-3 text-center lead">Youtube Channel</div>
        <div class="card-body text-center">
          <!--   <a href="https://www.youtube.com/channel/UChtGjfqM2lUwlxuxjnGAAMQ" target="_blank" class="btn btn-sm btn-danger text-light font-weight-bold"><i class="fa fa-youtube fa-lg"></i>Youtube Channel</a> -->
          <script src="https://apis.google.com/js/platform.js"></script>

          <div class="g-ytsubscribe" data-channelid="UChtGjfqM2lUwlxuxjnGAAMQ" data-layout="full" data-count="default"></div>
        </div>
      </div>
      <!-- Twitter -->
      <div class="card rounded-0 mb-3 shadow-lg" style="width:410px;">
        <div class="card-header rounded-0 py-3 text-center lead">Twitter</div>
        <div class="card-body text-center">
            <a href="https://twitter.com/GravethUzoma" target="_blank" class="btn btn-sm btn-info text-light font-weight-bold"><i class="fa fa-twitter fa-lg"></i>Twiiter</a>
        </div>
      </div>

      <!-- //Faceboook page -->
       <div class="card rounded-0 mb-3 shadow-lg">
        <div class="card-header rounded-0 py-1 text-center lead">Facebook Page</div>
        <div class="card-body">
          <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FUzb-Graphix-102968254716095%2F&tabs=timeline&width=400&height=500&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=737616176774073" width="380" height="400" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
        </div>
      </div>

       <!-- Instagram -->
      <div class="card rounded-0 mb-3 shadow-lg" style="width:410px;">
        <div class="card-header rounded-0 py-3 text-center lead">Instagram</div>
        <div class="card-body text-center">
            <a href="https://www.instagram.com/micky00792/" target="_blank" class="btn btn-sm btn-two text-light font-weight-bold"><i class="fa fa-instagram fa-lg"></i>Instalgram</a>
        </div>
      </div>
        <!-- Ads -->
      <div class="card rounded-0 mb-3 shadow-lg" style="width:410px;">
        <div class="card-header rounded-0 py-3 text-center lead">Ads</div>
        <div class="card-body text-center text-dark">
            Ads here
        </div>
      </div>

      <div class="card rounded-0 mb-3 shadow-lg" style="width:410px;">
        <div class="card-header rounded-0 py-3 text-center lead">Related Posts</div>
        <div class="card-body" id="">
           <p class="text-center align-self-center lead"><img src="<?php echo URLROOT; ?>gif/trans.gif"> Please Wait...</p>
        </div>
      </div>

      </div>

      </div>


</div>
</div>



<?php require_once APPROOT . '/includes/footer3.php';?>
<script type="text/javascript">
  $(document).ready(function(){




    getRecent();
    function getRecent(){
    	current = '<?=$row->id; ?>'
      $.ajax({
        url: '../process.php',
        method: 'post',
        data: {action: 'recentPost', current: current},
        success:function(response){
          $('#recentPost').html(response);
        }
      })

    }





  //search box
  $('#search').keyup(function(){
    var searchText = $(this).val();
    if (searchText!= '') {
      $.ajax({
        url: '../process.php',
        method: 'post',
        data: {query:searchText},
        success:function(response){
          $('#show-list').html(response);
          console.log(searchText);
        }
      })
    }else{
      $('#show-list').html('');
    }
  });

  $(document).on('click', 'a', function(){
    $('#search').val($(this).text());
    $('#show-list').html('');
  });


    const modalUpdate = $('#cookieUpdateGetPost');
        const notNowBtn = $('#notNowBtn');

        $(notNowBtn).click(function(){
            $(modalUpdate).modal('hide');
            localStorage.setItem("getPostUpdateShowed", "true");
        });

        setTimeout(function(){
            if (!localStorage.getItem("getPostUpdateShowed")) {
                $(modalUpdate).modal('show');
            }

        }, 5000);


        //comment
       $('#commentBtn').click(function(e){
      if ($('#comment_form')[0].checkValidity()) {
         e.preventDefault();
          $('#commentBtn').val('Please Wait...');

          $.ajax({
            url: '../add_comment.php',
            method: 'post',
            data: $('#comment_form').serialize(),
            success:function(response){
              $('#commentBtn').val('Comment');
              $('#comment_form')[0].reset();
              $('#comment_message').html(response);
              load_comment();

            }
          });

      }
    });

    //fetch comment
     load_comment();

    function load_comment(){

      var news_id = $('#news_id').val();
        $.ajax({
        url: "../fetch_comment.php",
        method:"POST",
        data:{news_id : news_id},
        success: function(response){
          $('#display_comment').html(response);
          console.log(response);

        }
      });
      }

    $('body').on('click', '.reply', function(){
        var comment_id = $(this).attr("id");
        $('#comment_id').val(comment_id);
        $('#comment_sender_name').focus();
    });




  });
</script>
