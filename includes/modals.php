

<!-- The Modal login-->
<div class="modal fade" id="bbHisNig">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title text-dark"><?=$historyBBN->bb_title ?></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
        <div class="modal-body text-dark">
   <span class="text-center text-dark"><?=$historyBBN->bb_title ?></span>
          <p class="text-justify px-2 py-1 text-dark">
              <?=nl2br($historyBBN->bb_description) ?>
          </p>
        </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!-- The Modal EXECUTIVES details-->
<div class="modal fade" id="stateExecDetail">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title text-dark" id="getNameState"></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
        <div class="modal-body text-dark">
   <span class="text-center text-dark" id="getOfficeState"></span>
   <ul class="list-unstyled m-0">
   <li class="media">
     <p id="getImageState"></p>
     <div class="media-body ml-2">
       <h6 class="text-info mb-1" id="getNameState2"></h6>
       <p id="getProfile">

       </p>
     </div>
   </li>


</ul>
        </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>



<!-- The Modal Lieutenant details-->
<div class="modal fade" id="Lts">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title text-dark">Lieutenant's Name</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
        <div class="modal-body text-dark">
   <span class="text-center text-dark">Served (27 October 1854 – 10 May 1914)</span>
   <ul class="list-unstyled m-0">
   <li class="media">
     <img data-src="<?= URLROOT; ?>images/boysbrigade_16456011203.jpg" class="img-thumbnail lazy"  src="<?= URLROOT; ?>images/boysbrigade_16456011203.jpg" alt="Sir William Alexander Smith" width="208">
     <div class="media-body ml-2">
       <h6 class="text-info mb-1">Name</h6>
       <p>
         Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,
       </p>
     </div>
   </li>


</ul>
        </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>



<div class="modal fade" id="cookieLogin">
              <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                  <div class="modal-header ucodeColor">
                    <h4 class="modal-title text-light">Authentication</h4>
                    <button type="button" name="button" class=" btn btn-danger btn-sm text-light" id="notNowBtn" data-dismiss="modal">Not Now Thanks</button>
                  </div>
                  <div class="modal-body text-primary">

                    <!-- //Login -->
                    <div class="row justify-content-center " id="login-box" style="display:block">
                      <div class="col-lg-12">
                    <div class="card-group ">
                    <div class="card rounded-left"  style="flex-grow:1.4;">
                    <h4 class="text-center text-primary">
                    <i class="fa fa-user"></i> Sign in to Account
                    </h4>
                    <hr class="my-3">
                    <form  action="#" method="post" id="login-form" class="px-3">
                     <div id="logAlert"> </div>
                     <div class="form-group">
                       <?php
                       if (Session::exists('access-denied')) {

                           echo '<div class="alert alert-danger alert-dismissible">
                                 <button type="button" class="close" data-dismiss="alert">
                                 &times;
                                 </button>
                                 <strong class="text-center">'. Session::flash('access-denied') .'</strong>
                                 </div>';


                       }
                        ?>
                      </div>
                     <div class="form-group">
                       <span id="error-message" class="text-danger"></span>
                     </div>

                      <label for="Lusername">Username: <sup class="text-danger">*</sup></label><br>
                     <div class="input-group input-group-lg form-group">
                       <div class="input-group-prepend">
                         <span class="input-group-text rounded-0">
                         <i class="fa fa-envelope  fa-lg"></i>
                       </span>
                       </div>
                       <input type="text" name="username" id="Lusername" class="form-control rounded-0" placeholder="username">
                     </div>
                     <!-- email  -->
                     <div class="input-group input-group-lg form-group">
                       <div class="input-group-prepend">
                         <span class="input-group-text rounded-0">
                         <i class="fa fa-key  fa-lg"></i>
                       </span>
                       </div>
                       <input type="password" name="password" id="Lpassword"
                        class="form-control rounded-0" placeholder="Password">
                     </div>
                     <div class="form-group">
                       <div class="custom-control custom-checkbox float-left">
                         <input type="checkbox" name="remember" id="customCheck"  class="custom-control-input"/>
                         <label for="customCheck" class="custom-control-label">Remember me</label>
                       </div>
                     </div>

                     <div class="clearfix"> </div>
                     <div class="form-group">
                       <button type="submit"  id="login-btn" class="btn btn-success btn-lg btn-block ucodeBtn mt-5">Sign In </button>
                     </div>
                    </form>
                    </div>
                    <div class="card justify-content-center rounded-right ucodeColor p-4">
                    <h2 class="text-center font-weight-bold text-white">Welcome back Gallant! <br>
                    SURE AND STEADFAST   </h2>
                    <hr class="my-3 bg-light ucodeHr">
                    <p class="text-center font-weight-bold text-light lead">
                      You are about to access your dashboard! Be Nice. <br>
                      Don't have an account?
                    </p>
                    <a href="officers/register" class="btn btn-outline-light btn-lg align-self-center font-weight-bolder mt-4 ucodeLinkBtn">Sign Up</a>
                    </div>
                    </div>

                    </div>

                    </div>

<!-- here -->
                  </div>
                </div>


              </div>
     </div>


     <div class="modal fade" id="stateSSOProfile">
       <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
         <div class="modal-content" id="ssoDetail">

           <!-- Modal footer -->


         </div>
       </div>
     </div>


     <div class="modal fade" id="statePresidentProfile">
       <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
         <div class="modal-content" id="statePresident">


         </div>
       </div>
     </div>
