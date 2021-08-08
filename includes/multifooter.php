
<div class="container-fluid bg-primary text-light px-2 m-0" style="height: auto  !important;">
    <div class="row">
    <div class="col-lg-4 aligh-self-center px-3 text-light">
         <span class="text-light lead text-center"><i class="fa fa-user-circle-o fa-lg"></i>&nbsp;   About BBN KOGI STATE COUNCIL</span><hr>
         <p class="text-light text-center align-self-center">
            <img src="images/BBNSTATE.png" alt="BBN KOGI STATE COUNCIL" class="img-fluid" style="border-radius: 100px;" width="100"><br>
             <?=nl2br(wrap4($historyBBState->bb_description)) ?>
             <a href="<?= URLROOT; ?>about" class="btn  btn-md btn-block btn-warning"><i class="fa fa-book">Read More...</i>  </a>
         </p>
    <span class="text-center">Follow Us: <br>
    <div class="container icons">
      <a href='https://www.facebook.com/UZB-Graphix-466662830763109/' target='_blank'><i class='fa fa-facebook-square text-light social f' aria-hidden='none'></i></a>
      <a href='https://wa.me/2349054914198' target='_blank'><i class='fa fa-whatsapp text-success social w' aria-hidden='none'></i></a>
      <a href='https://www.youtube.com/channel/UCR_j5BAhQiVAeR9bYEneIFw' target='_blank'><i class='fa fa-youtube text-danger social y' aria-hidden='none'></i></a>
      <a href='https://www.instagram.com/uzbgraphix/' target='_blank'><i class='fa fa-instagram text-warning social i' aria-hidden='none'></i></a>
       <a href='https://github.com/uzbgraphix' target='_blank'><i class='fa fa-github text-light social i' aria-hidden='none'></i></a>
    </div>
    <hr class="hrss">
    </span>
    </div>
    <div class="col-lg-4 aligh-self-center px-3 text-light">
         <span class="text-light lead text-center"><i class="fa fa-newspaper-o fa-lg"></i> &nbsp;    Subscribe For Updates</span><hr>
         <p class="px-2">
             <div class="card rounded-5 mb-3 shadow-lg">
        <div class="card-header rounded-5 py-1 lead text-dark"><small>Want to get updates then hit subscribe button!</small></div>
        <div class="card-body">
          <form method="POST" action="#" id="subscribe-form">
            <div class="form-group">
              <input type="email" id="sub-email" name="sub-email" class="form-control border-secondary rounded-5" placeholder="Subscribe for Updates">
            </div>
            <div class="form-group">
                <button type="submit" id="subBtn" name="subBtn"  class="btn btn-block btn-lg btn-warning">Subscribe</button>
            </div>
            <div class="clearfix"></div>
            <div class="form-group text-dark">
                <span id="sub_Error"></span>
            </div>
          </form>
        </div>
        <div class="list-group" id="show-list" style="position:relative; margin-top:-28px;">
        </div>
      </div>
         </p>
    </div>
    <div class="col-lg-4 aligh-self-center px-3 text-dark">
         <span class="text-light lead text-center"><i class="fa fa-chain fa-lg"></i>&nbsp;  Links</span><hr>
         <p class="px-2">
             <div class="list-group">
              <a href="#" class="list-group-item list-group-item-action">First item</a>
              <a href="#" class="list-group-item list-group-item-action">Second item</a>
              <a href="#" class="list-group-item list-group-item-action">Third item</a>
            </div>
         </p>
    </div>
</div>
</div>
