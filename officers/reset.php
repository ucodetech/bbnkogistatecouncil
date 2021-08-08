<div class="row justify-content-center wrapper" id="forgot-box" style="display:none">
  <div class="col-lg-10 my-auto">
    <div class="card-group  ucodeShadow">
      <div class="card justify-content-center rounded-left ucodeColor p-4">
        <h2 class="text-center font-weight-bold text-white">Sorry it Seems You forgot your password</h2>
        <hr class="my-3 bg-light ucodeHr">
        <p class="text-center font-weight-bold text-light lead">
        No problem its easy<br>
        </p>
        <div id="emoji" class="fa text-center emo" style="font-size:50px; color:#fff"></div>
        <button class="btn btn-outline-light btn-lg align-self-center font-weight-bolder mt-4 ucodeLinkBtn" id="back-link">Back</button>
      </div>
      <div class="card rounded-right p-4" style="flex-grow:1.4;">
        <h1 class="text-center font-weight-bold text-primary">
        Forgot Your Password?
       </h1>
       <hr class="my-3">
       <p class="lead text-center text-secondary">To reset your password please enter your registered email address and we will mail you instructions on how to reset your password!</p>
       <form  action="#" method="post" id="reset-form" class="px-3">
         <div id="forAlert">

         </div>
         <div class="input-group input-group-lg form-group">
           <div class="input-group-prepend">
             <span class="input-group-text rounded-0">
             <i class="fa fa-envelope  fa-lg"></i>
           </span>
           </div>
           <input type="email" name="email" id="email" value="" class="form-control rounded-0" placeholder="E-mail" required>
           <span class="invalid-feedback"></span>
         </div>
         <!-- email  -->
         <div class="clearfix"> </div>
         <div class="form-group">
           <button type="submit"  id="reset-btn" class="btn btn-success btn-lg btn-block ucodeBtn"> Request Reset </button>
         </div>
       </form>
      </div>

    </div>

  </div>

</div>
