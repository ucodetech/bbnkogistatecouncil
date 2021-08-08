<?php
require_once '../core/init.php';
if (!isCommanderGranted()) {
  Session::flash('message', 'Access Denied!');
  Redirect::to('command-access');

}
if (!hasPermissionCaptian()) {
  Session::flash('message', 'Access Denied! You can\'t access that page!');
  Redirect::to('command-dashboard');

}

require APPROOT .'/includes/Panelhead.php';
require APPROOT .'/includes/Panelnav.php';


$db = new DB();

?>

<div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <?php  echo flash('success'); ?>


      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
      <div class="col-lg-12">
        <div class="card rounded-0 mt-3 border-primary">
          <div class="card-header border-primary">
            <ul class="nav nav-tabs card-header-tabs">
              <li class="nav-item">
                <a href="#HisTable" class="nav-link active font-weight-bold" data-toggle="tab">BB History</a>
              </li>

              <li class="nav-item">
                <a href="#addBB" class="nav-link  font-weight-bold" data-toggle="tab">Add History BB</a>
              </li>
              <li class="nav-item">
                <a href="#addBBN" class="nav-link  font-weight-bold" data-toggle="tab">Add Histroy BBN</a>
              </li>
              <li class="nav-item">
                <a href="#addBBNState" class="nav-link  font-weight-bold" data-toggle="tab">Add Histroy BBN State</a>
              </li>

            </ul>
          </div>
          <div class="card-body">
            <div class="tab-content">

              <!-- tutorial tab content start -->
              <div class="tab-pane container active" id="HisTable">
                <div class="col-lg-12">
              <div class="card">
                <h4 class="card-header bg-success px-3">Boys' Brigade History</h4>
                <div class="card-body">
                  <div class="table-responsive" id="showHis">
                    <p class="text-center align-self-center lead"><img src="<?= URLROOT;  ?>gif/success.gif"> Please Wait...</p>

                  </div>
                </div>
              </div>
            </div><hr>
            <div class="col-lg-12">
          <div class="card">
            <h4 class="card-header bg-info px-3">Boys' Brigade Nigeria History</h4>
            <div class="card-body">
              <div class="table-responsive" id="showHisBBN">
                <p class="text-center align-self-center lead"><img src="<?= URLROOT;  ?>gif/success.gif"> Please Wait...</p>

              </div>
            </div>
          </div>
        </div><hr>
        <div class="col-lg-12">
      <div class="card">
        <h4 class="card-header bg-secondary px-3">Boys' Brigade Nigeria Kogi State Council History</h4>
        <div class="card-body">
          <div class="table-responsive" id="showHisBBNKSC">
            <span id="test"></span>
            <p class="text-center align-self-center lead"><img src="<?= URLROOT;  ?>gif/success.gif"> Please Wait...</p>

          </div>
        </div>
      </div>
    </div>
          </div>
          <!--start of add history form tab content -->
               <div class="tab-pane container fade" id="addBB">
                    <div class="col-lg-12">
              <div class="card">
                <h4 class="card-header bg-info border-info"><i class="fas fa-plus-circle fa-lg"></i>&nbsp;Add History</h4>
                <div class="card-body">

                  <hr>
                  <form class="px-3" action="#" method="post" id="add_his_form">
                    <div class="form-group">
                      <h5 id="hisAlert"></h5>
                    </div>
                    <div class="form-group">
                      <label for="history_title">Title</label>
                      <input type="text" name="history_title" id="history_title" placeholder="Enter Title" class="form-control form-control-lg" autofocus>
                    </div>

                    <div class="form-group">
                      <label for="history_description">Introduction</label>
                      <textarea  name="history_description" id="history_description" placeholder="Enter Description" class="form-control form-control-lg" rows="8">

                      </textarea>
                    </div>
                    <div class="clearfix">  </div>
                    <div class="form-group col-md-12">
                      <input type="submit" name="addHistoryBtn" id="addHistoryBtn" value="Add History" class="btn btn-info btn-lg btn-block px-2">
                    </div>

                  </form>
                </div>
              </div>
            </div>

               </div>
                 <!-- end of add tut form tab content -->
                 <!--start of add bbn history form tab content -->
                      <div class="tab-pane container fade" id="addBBN">
                           <div class="col-lg-12">
                     <div class="card">
                       <h4 class="card-header bg-primary border-primary"><i class="fas fa-plus-circle fa-lg"></i>&nbsp;Add BBN History</h4>
                       <div class="card-body">

                         <hr>
                         <form class="px-3" action="#" method="post" id="add_hisbbn_form">
                           <div class="form-group">
                             <h5 id="hisbbnAlert"></h5>
                           </div>
                           <div class="form-group">
                             <label for="history_title">Title</label>
                             <input type="text" name="history_titlebbn" id="history_titlebbn" placeholder="Enter Title" class="form-control form-control-lg" autofocus>
                           </div>

                           <div class="form-group">
                             <label for="history_description">Introduction</label>
                             <textarea  name="history_descriptionbbn" id="history_descriptionbbn" placeholder="Enter Description" class="form-control form-control-lg" rows="8">

                             </textarea>
                           </div>
                           <div class="clearfix">  </div>
                           <div class="form-group col-md-12">
                             <input type="submit" name="addHistoryBBNBtn" id="addHistoryBBNBtn" value="Add History" class="btn btn-primary btn-lg btn-block px-2">
                           </div>

                         </form>
                       </div>
                     </div>
                   </div>

                      </div>
               <!--End of add source  tab content -->
               <!--start of add bbn history form tab content -->
                    <div class="tab-pane container fade" id="addBBNState">
                         <div class="col-lg-12">
                   <div class="card">
                     <h4 class="card-header bg-danger border-danger"><i class="fas fa-plus-circle fa-lg"></i>&nbsp;Add BBN KSC History</h4>
                     <div class="card-body">

                       <hr>
                       <form class="px-3" action="#" method="post" id="add_hisbbnstate_form">

                         <div class="form-group">
                           <label for="history_titlebbnstate">Title</label>
                           <input type="text" name="history_titlebbnstate" id="history_titlebbnstate" placeholder="Enter Title" class="form-control form-control-lg" autofocus>
                         </div>

                         <div class="form-group">
                           <label for="history_descriptionbbnstate">Introduction</label>
                           <textarea  name="history_descriptionbbnstate" id="history_descriptionbbnstate" placeholder="Enter Description" class="form-control form-control-lg" rows="8">

                           </textarea>
                         </div>
                         <div class="form-group">
                           <label for="formation_creation">Formation/ Creation</label>
                           <textarea  name="formation_creation" id="formation_creation" placeholder="Enter Formation Creation" class="form-control form-control-lg" rows="8">

                           </textarea>
                         </div>
                         <div class="form-group">
                           <label for="other_appoint">Other Appointees</label>
                           <textarea  name="other_appoint" id="other_appoint" placeholder="Enter Appointees" class="form-control form-control-lg" rows="8">

                           </textarea>
                         </div>

                         <div class="form-group">
                           <label for="secretariat">Secretariat</label>
                           <textarea  name="secretariat" id="secretariat" placeholder="Enter Secretariat" class="form-control form-control-lg" rows="8">

                           </textarea>
                         </div>
                         <div class="form-group">
                           <label for="events">Events</label>
                           <textarea  name="events" id="events" placeholder="Enter Events" class="form-control form-control-lg" rows="8">

                           </textarea>
                         </div>
                         <div class="form-group">
                           <label for="generalInfo">General Info</label>
                           <textarea  name="generalInfo" id="generalInfo" placeholder="Enter General Information" class="form-control form-control-lg" rows="8">

                           </textarea>
                         </div>
                         <div class="form-group">
                           <h5 id="hisbbnstateAlert"></h5>
                         </div>
                         <div class="clearfix">  </div>
                         <div class="form-group col-md-12">
                           <input type="submit" name="addHistoryBBNstateBtn" id="addHistoryBBNstateBtn" value="Add History" class="btn btn-danger btn-lg btn-block px-2">
                         </div>

                       </form>
                     </div>
                   </div>
                 </div>

                    </div>
             <!--End of add source  tab content -->

            </div>
          </div>
        </div>
      </div>
    </div>

          <!-- End view modal -->

        </div>
      </div><!-- /.container-fluid -->
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>
<?php include APPROOT. '/commander/virus/modals.php' ?>
<?php   require APPROOT .'/includes/Panelfooter.php';?>
<script type="text/javascript">
  $(document).ready(function(){

    $('#addHistoryBtn').click(function(e){
      if ($('#add_his_form')[0].checkValidity()) {
        e.preventDefault();
        $('#addHistoryBtn').val('Please wait...');
        if ($('#history_description').val() == '') {
          $('#hisAlert').fadeIn('slow').html('Introduction is required!');
        }
        $.ajax({
          url: 'virus/history-process.php',
          method: 'post',
          data: $('#add_his_form').serialize()+'&action=add_history',
          success:function(response){
            if ($.trim(response) === 'success') {
              $('#addHistoryBtn').val('Add History');
              $('#add_his_form')[0].reset();
              window.location = '<?= $_SERVER['PHP_SELF']; ?>';
              fetchHistory();
            }else{
              $('#hisAlert').fadeIn('slow').html(response)
              setTimeout(function(){
                $('#hisAlert').html(response).fadeOut('slow');
              }, 10000);
            }
          }
        });
      }
    });


    fetchHistory();
    function   fetchHistory(){
      $.ajax({
        url: 'virus/history-process.php',
        method: 'post',
        data: {action: 'fetch_history'},
        success:function(response){
          $('#showHis').html(response);
          $('#showHist').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "order": [0,'desc'],
            "info": true,
            "autoWidth": false,
            "responsive": true,
             "lengthMenu": [[5,10, 25, 50, -1], [10, 25, 50, "All"]]
          });
        }
      })
    }



  //Fetch source Details
  $('body').on('click', '.hisDetailsIcon', function(e){
    e.preventDefault();
    his_id = $(this).attr('id');
    $.ajax({
      url: 'virus/history-process.php',
      method: 'post',
      data: {his_id: his_id},
      success:function(response){
        $('#fetchHistoryDetail').html(response);
      }
    });
  });



    //Fetch source Details
    $('body').on('click', '.editHisBtn', function(e){
      e.preventDefault();
      hisedit_id = $(this).attr('id');
      $.ajax({
        url: 'virus/history-process.php',
        method: 'post',
        data: {hisedit_id: hisedit_id},
        success:function(response){
          data = JSON.parse(response);
          $('#editHisID').val(data.id);
          $('#edit_history_title').val(data.bb_title);
          $('#edit_history_description').val(data.bb_description);
        }
      });
    });

    //Update Note
    $("#editHistoryBtn").click(function(e){
      if ($("#edit_his_form")[0].checkValidity()) {
        e.preventDefault();
        $.ajax({
          url: 'virus/history-process.php',
          method: 'POST',
          data: $('#edit_his_form').serialize()+'&action=update_history',
          success:function(response){
            if (response === 'updated') {
              Swal.fire({
                title: 'History Updated Successfully!',
                type: 'success'
              });
              $('#edit_his_form')[0].reset();
              $('#editHisModal').modal('hide');
              fetchHistory();
            }else{
              $('#hisEditAlert').html(response);
            }

          }
        });
      }
    });


    $('#addHistoryBBNBtn').click(function(e){
      if ($('#add_hisbbn_form')[0].checkValidity()) {
        e.preventDefault();
        $('#addHistoryBBNBtn').val('Please wait...');

        $.ajax({
          url: 'virus/history-process.php',
          method: 'post',
          data: $('#add_hisbbn_form').serialize()+'&action=add_historybbn',
          success:function(response){

            if ($.trim(response) === 'success') {
              $('#addHistoryBBNBtn').val('Add History');
              $('#add_hisbbn_form')[0].reset();
              window.location = '<?= $_SERVER['PHP_SELF']; ?>';
              fetchBBNHistory();
            }else{
              $('#hisbbnAlert').fadeIn('slow').html(response)
              // setTimeout(function(){
              //   $('#regError').html(response).fadeOut('slow');
              // }, 10000);
            }
          }
        });
      }
    });


    fetchBBNHistory();
    function   fetchBBNHistory(){
      $.ajax({
        url: 'virus/history-process.php',
        method: 'post',
        data: {action: 'fetch_historybbn'},
        success:function(response){
          $('#showHisBBN').html(response);
          $('#showHistBBN').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "order": [0,'desc'],
            "info": true,
            "autoWidth": false,
            "responsive": true,
             "lengthMenu": [[5,10, 25, 50, -1], [10, 25, 50, "All"]]
          });
        }
      })
    }



  //Fetch source Details
  $('body').on('click', '.hisBBNDetailsIcon', function(e){
    e.preventDefault();
    hisbbn_id = $(this).attr('id');
    $.ajax({
      url: 'virus/history-process.php',
      method: 'post',
      data: {hisbbn_id: hisbbn_id},
      success:function(response){
        $('#fetchHistoryBBNDetail').html(response);
      }
    });
  });



    //Fetch source Details
    $('body').on('click', '.editHisBBNBtn', function(e){
      e.preventDefault();
      hiseditbbn_id = $(this).attr('id');
      $.ajax({
        url: 'virus/history-process.php',
        method: 'post',
        data: {hiseditbbn_id: hiseditbbn_id},
        success:function(response){
          output = JSON.parse(response);
          $('#editHisbbnID').val(output.id);
          $('#edit_history_titlebbn').val(output.bb_title);
          $('#edit_history_descriptionbbn').val(output.bb_description);
        }
      });
    });

    //Update Note
    $("#editHistorybbnBtn").click(function(e){
      if ($("#edit_hisbbn_form")[0].checkValidity()) {
        e.preventDefault();
        $.ajax({
          url: 'virus/history-process.php',
          method: 'POST',
          data: $('#edit_hisbbn_form').serialize()+'&action=update_historybbn',
          success:function(response){
            if (response === 'updated') {
              Swal.fire({
                title: 'History Updated Successfully!',
                type: 'success'
              });
              $('#edit_hisbbn_form')[0].reset();
              $('#editHisBBNModal').modal('hide');
                  fetchBBNHistory();
            }else{
              $('#hisbbnEditAlert').html(response);
            }

          }
        });
      }
    });



        $('#addHistoryBBNstateBtn').click(function(e){
          if ($('#add_hisbbnstate_form')[0].checkValidity()) {
            e.preventDefault();
            $('#addHistoryBBNstateBtn').val('Please wait...');

            $.ajax({
              url: 'virus/history-process.php',
              method: 'post',
              data: $('#add_hisbbnstate_form').serialize()+'&action=add_historybbnstate',
              success:function(response){

                if ($.trim(response) === 'success') {
                  $('#addHistoryBBNstateBtn').val('Add History');
                  $('#add_hisbbnstate_form')[0].reset();
                  window.location = '<?= $_SERVER['PHP_SELF']; ?>';
                  fetchBBNHistory();
                }else{
                  $('#hisbbnstateAlert').fadeIn('slow').html(response)
                  setTimeout(function(){
                    $('#hisbbnstateAlert').html(response).fadeOut('slow');
                  }, 10000);
                }
              }
            });
          }
        });


        fetchBBNStateHistory();
        function   fetchBBNStateHistory(){
          $.ajax({
            url: 'virus/history-process.php',
            method: 'post',
            data: {action: 'fetch_historybbnstate'},
            success:function(response){
              $('#showHisBBNKSC').html(response);
              $('#showHistBBNState').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "order": [0,'desc'],
                "info": true,
                "autoWidth": false,
                "responsive": true,
                 "lengthMenu": [[5,10, 25, 50, -1], [10, 25, 50, "All"]]
              });
            }
          })
        }



      //Fetch source Details
      $('body').on('click', '.hisBBNstateDetailsIcon', function(e){
        e.preventDefault();
        hisstate_id = $(this).attr('id');
        $.ajax({
          url: 'virus/history-process.php',
          method: 'post',
          data: {hisstate_id: hisstate_id},
          success:function(response){
            $('#fetchHistoryBBNstateDetail').html(response);
          }
        });
      });



        //Fetch source Details
        $('body').on('click', '.editHisBBNstateBtn', function(e){
          e.preventDefault();
          editbbn_id = $(this).attr('id');
          $.ajax({
            url: 'virus/history-process.php',
            method: 'post',
            data: {editbbn_id: editbbn_id},
            success:function(response){
              output = JSON.parse(response);
              $('#editstateID').val(output.id);
              $('#history_titlestate').val(output.bb_title);
              $('#history_descriptionstate').val(output.bb_description);
              $('#editformation_creation').val(output.formation_creation);
              $('#editother_appoint').val(output.other_apointees_reps);
              $('#editsecretariat').val(output.secretariat);
              $('#editevents').val(output.events);
              $('#editgeneralInfo').val(output.general_info);

            }
          });
        });

        //Update Note
        $("#editHistoryBBNstateBtn").click(function(e){
          if ($("#edit_hisbbnstate_form")[0].checkValidity()) {
            e.preventDefault();
            $.ajax({
              url: 'virus/history-process.php',
              method: 'POST',
              data: $('#edit_hisbbnstate_form').serialize()+'&action=update_state',
              success:function(response){
                if (response === 'updated') {
                  Swal.fire({
                    title: 'History Updated Successfully!',
                    type: 'success'
                  });
                  $('#edit_hisbbnstate_form')[0].reset();
                  $('#editHisBBNstateModal').modal('hide');
                        fetchBBNStateHistory();
                }else{
                  $('#hisbbnEditAlert').html(response);
                }

              }
            });
          }
        });



  });
</script>
<!-- <script type="text/javascript" src="notify.js"></script> -->
