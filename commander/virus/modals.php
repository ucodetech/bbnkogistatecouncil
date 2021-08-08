<!-- Start view Modal -->
  <div class="modal fade" id="showCommandDetailsModal">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title text-light"><i class="fas fa-info-circle fa-lg"></i>&nbsp; Commander Details</h4>
          <button type="button" name="button" class="close text-light" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body text-primary" id="FetchCommanderDetail">

        </div>
      </div>


    </div>
  </div>
<!-- End view modal -->

<!-- Start edit Modal -->
  <div class="modal fade" id="editCommandModal">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title text-light"><i class="fas fa-edit fa-lg"></i>&nbsp; Edit Commander</h4>
          <button type="button" name="button" class="close text-light" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body text-primary" id="FetchCommanderEdit">
          <form  action="#" method="post" class="px-3" id="admin-edit-form">
             <input type="hidden" name="commanderID" id="commanderID" >
             <div class="form-group" id="regError">   </div>
             <div class="form-group">
               <input type="text" name="commander-name" id="commander_name" placeholder="Enter Warhead full Name" class="form-control form-control-lg rounded-1" >
             </div>
             <div class="form-group">
               <input type="email" name="commander-email" id="commander_email" placeholder="Enter Warhead access Email" class="form-control form-control-lg rounded-1" >
             </div>
             <div class="form-group">
               <input type="number" name="commander-tel" id="commander_tel" placeholder="Enter Warhead access phone number" class="form-control form-control-lg rounded-1" >
             </div>
             <div class="form-group">
               <input type="text" name="commander-church" id="commander_church" placeholder="Enter Warhead home church" class="form-control form-control-lg rounded-1" />
             </div>
             <div class="form-group">
               <input type="text" name="commander-permisson" id="commander_permission" placeholder="Enter commander permission" class="form-control form-control-lg rounded-1" >
             </div>


       <div class="form-group mt-1">
           <input type="submit" name="editAuthBtn" id="editAuthBtn" class="btn btn-danger btn-block btn-lg" value="Edit Permission">
         </div>
           </form>
        </div>
      </div>


    </div>
  </div>
<!-- End edit modal -->

<!-- Start view Modal -->
  <div class="modal fade" id="showHisDetailsModal">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title text-light"><i class="fas fa-info-circle fa-lg"></i>&nbsp; BB History Details</h4>
          <button type="button" name="button" class="close text-light" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body text-primary" id="fetchHistoryDetail">

        </div>
      </div>


    </div>
  </div>

  <!-- Start edit Modal -->
    <div class="modal fade" id="editHisModal">
      <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <h4 class="modal-title text-light"><i class="fas fa-edit fa-lg"></i>&nbsp; Edit BB History</h4>
            <button type="button" name="button" class="close text-light" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body text-primary">
            <form class="px-3" action="#" method="post" id="edit_his_form">
              <div class="form-group">
                <h5 id="hisEditAlert"></h5>
              </div>
              <input type="hidden" name="editHisID" id="editHisID">
              <div class="form-group">
                <label for="history_title">Title</label>
                <input type="text" name="history_title" id="edit_history_title" placeholder="Enter Title" class="form-control form-control-lg"/>
              </div>

              <div class="form-group">
                <label for="history_description">Introduction</label>
                <textarea  name="history_description" id="edit_history_description" placeholder="Enter Description" class="form-control form-control-lg" rows="8">

                </textarea>
              </div>
              <div class="clearfix">  </div>
              <div class="form-group col-md-12">
                <input type="submit" name="editHistoryBtn" id="editHistoryBtn" value="Edit History" class="btn btn-danger btn-lg btn-block px-2">
              </div>

            </form>
          </div>
        </div>


      </div>
    </div>
  <!-- End edit modal -->

  <!-- Start view Modal -->
    <div class="modal fade" id="showHisBBNDetailsModal">
      <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header bg-info">
            <h4 class="modal-title text-light"><i class="fas fa-info-circle fa-lg"></i>&nbsp; BBN History Details</h4>
            <button type="button" name="button" class="close text-light" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body text-dark" id="fetchHistoryBBNDetail">

          </div>
        </div>


      </div>
    </div>

    <!-- Start edit Modal -->
      <div class="modal fade" id="editHisBBNModal">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header bg-info">
              <h4 class="modal-title text-light"><i class="fas fa-edit fa-lg"></i>&nbsp; Edit BBN History</h4>
              <button type="button" name="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-info">
              <form class="px-3" action="#" method="post" id="edit_hisbbn_form">
                <div class="form-group">
                  <h5 id="hisEditbbnAlert"></h5>
                </div>
                <input type="hidden" name="editHisbbnID" id="editHisbbnID">
                <div class="form-group">
                  <label for="history_titlebbn">Title</label>
                  <input type="text" name="history_titlebbn" id="edit_history_titlebbn" placeholder="Enter Title" class="form-control form-control-lg"/>
                </div>

                <div class="form-group">
                  <label for="history_descriptionbbn">Introduction</label>
                  <textarea  name="history_descriptionbbn" id="edit_history_descriptionbbn" placeholder="Enter Description" class="form-control form-control-lg" rows="8">

                  </textarea>
                </div>
                <div class="clearfix">  </div>
                <div class="form-group col-md-12">
                  <input type="submit" name="editHistorybbnBtn" id="editHistorybbnBtn" value="Edit BBN History" class="btn btn-danger btn-lg btn-block px-2">
                </div>

              </form>
            </div>
          </div>


        </div>
      </div>
    <!-- End edit modal -->

    <!-- Start view Modal -->
      <div class="modal fade" id="showHisBBNstateDetailsModal">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h4 class="modal-title text-light"><i class="fas fa-info-circle fa-lg"></i>&nbsp; BBN Kogi State Council History Details</h4>
              <button type="button" name="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body  text-primary" id="fetchHistoryBBNstateDetail" >

            </div>
          </div>


        </div>
      </div>

      <!-- Start edit Modal -->
        <div class="modal fade" id="editHisBBNstateModal">
          <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header bg-info">
                <h4 class="modal-title text-light"><i class="fas fa-edit fa-lg"></i>&nbsp; Edit BBN KSC History</h4>
                <button type="button" name="button" class="close text-light" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body text-info">
                <form class="px-3" action="#" method="post" id="edit_hisbbnstate_form">

                  <div class="form-group">
                    <label for="history_titlebbnstate">Title</label>
                    <input type="text" name="history_titlestate" id="history_titlestate" placeholder="Enter Title" class="form-control form-control-lg" autofocus>
                  </div>

                  <div class="form-group">
                    <label for="history_descriptionstate">Introduction</label>
                    <textarea  name="history_descriptionstate" id="history_descriptionstate" placeholder="Enter Description" class="form-control form-control-lg" rows="8">

                    </textarea>
                  </div>
                  <div class="form-group">
                    <label for="formation_creation">Formation/ Creation</label>
                    <textarea  name="formation_creation" id="editformation_creation" placeholder="Enter Formation Creation" class="form-control form-control-lg" rows="8">

                    </textarea>
                  </div>
                  <div class="form-group">
                    <label for="other_appoint">Other Appointees</label>
                    <textarea  name="other_appoint" id="editother_appoint" placeholder="Enter Appointees" class="form-control form-control-lg" rows="8">

                    </textarea>
                  </div>

                  <div class="form-group">
                    <label for="secretariat">Secretariat</label>
                    <textarea  name="secretariat" id="editsecretariat" placeholder="Enter Secretariat" class="form-control form-control-lg" rows="8">

                    </textarea>
                  </div>
                  <div class="form-group">
                    <label for="events">Events</label>
                    <textarea  name="events" id="editevents" placeholder="Enter Events" class="form-control form-control-lg" rows="8">

                    </textarea>
                  </div>
                  <div class="form-group">
                    <label for="generalInfo">General Info</label>
                    <textarea  name="generalInfo" id="editgeneralInfo" placeholder="Enter General Information" class="form-control form-control-lg" rows="8">

                    </textarea>
                  </div>
                  <div class="form-group">
                    <h5 id="hisbbnstateAlert"></h5>
                  </div>
                  <div class="clearfix">  </div>
                  <div class="form-group col-md-12">
                    <input type="hidden" name="editstateID" id="editstateID">
                    <input type="submit" name="editHistoryBBNstateBtn" id="editHistoryBBNstateBtn" value="Edit History" class="btn btn-danger btn-lg btn-block px-2">
                  </div>

                </form>
              </div>
            </div>


          </div>
        </div>
      <!-- End edit modal -->

      <!-- Display edit tainging officer details modal -->
      <div class="modal fade" id="editTofficerModal">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable  modal-lg">
          <div class="modal-content" >
            <div class="modal-header bg-info text-light">
              <h4 class="text-light font-weight-bolder text-left lead"><i class="fa fa-edit fa-lg"></i>&nbsp; Edit Training Officer</h4>
            </div>
            <div class="card-body">
              <form class="px-3" action="#" method="post" id="edit-training-officer-form">
                <span id="toEditAlert"></span>
                <div class="form-group">
                  <label for="tofficer_name">Training Officers Name <sup class="text-danger">*</sup> </label>
                  <input type="text" name="tofficer_name" id="edittofficer_name" class="form-control"  placeholder="Training Officers name"  autofocus>

                </div>
                <div class="form-group">
                  <label for="tofficer_name">Training Officers qualification <sup class="text-danger">*</sup> </label>
                  <input type="text" name="editofficer_qua" id="editofficer_qua" class="form-control"  placeholder="Training Officers qualification">

                </div>
                <div class="form-group">
                  <label for="tofficer_name">Introduction (<small class="text-muted">Leave blank if adding just officers name and qualification</small>) </label>
                  <textarea name="editintroduction" id="editintroduction" class="form-control" rows="6" placeholder="Introduction Here">
                  </textarea>
                  <small class="text-muted">Leave blank if adding just officers name and qualification</small>
                </div>
                <div class="form-group">
                  <input type="hidden" name="editTofficerID" id="editTofficerID">
                  <input type="submit" id="editTOfficerBtn" value="Edit Training Officer" class="btn btn-success btn-block btn-lg">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

    <!-- //add training officer-->
    <div class="modal fade" id="addTrainingOfficers">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable  modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">
        Add Training Officer
          </h3>
          <button type="button" class="close" data-dismiss="modal" name="button">&times;</button>
        </div>
        <div class="modal-body">
          <form class="px-3" action="#" method="post" id="training-officer-form">
            <span id="toAlert"></span>
            <div class="form-group">
              <label for="tofficer_name">Training Officers Name <sup class="text-danger">*</sup> </label>
              <input type="text" name="tofficer_name" id="tofficer_name" class="form-control"  placeholder="Training Officers name"  autofocus>

            </div>
            <div class="form-group">
              <label for="tofficer_name">Training Officers Qualification (ANTO, NTO, NBS) <sup class="text-danger">*</sup> </label>
              <select name="tofficer_qua" id="tofficer_qua" class="form-control">
                <option value="">Training Officers Qualification</option>
                <option value="ANTO">ANTO</option>
                <option value="NTO">NTO</option>
                <option value="NBS">NBS</option>
              </select>
            </div>
            <div class="form-group">
              <label for="tofficer_name">Introduction (<small class="text-muted">Leave blank if adding just officers name and qualification</small>) </label>
              <textarea name="introduction" id="introduction" class="form-control" rows="6" placeholder="Introduction Here">
              </textarea>
              <small class="text-muted">Leave blank if adding just officers name and qualification</small>
            </div>
            <div class="form-group">
              <input type="submit" id="addTOfficerBtn" value="Add Officer" class="btn btn-success btn-block btn-lg">
            </div>
          </form>
        </div>

      </div>
    </div>
    </div>


        <!-- //add group council-->
        <div class="modal fade" id="addGroupCouncil">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable  modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title">
            Add Group Council
              </h3>
              <button type="button" class="close" data-dismiss="modal" name="button">&times;</button>
            </div>
            <div class="modal-body">
              <form class="px-3" action="#" method="post" id="add_group_council">
                <span id="groupAlert"></span>
                <div class="form-group">
                  <label for="tofficer_name">Group Council Name <sup class="text-danger">*</sup> </label>
                  <input type="text" name="council_name" id="council_name" class="form-control"  placeholder="Group council name"  autofocus>

                </div>

                <div class="form-group">
                  <label for="tofficer_name">Introduction (<small class="text-muted">Leave blank if adding just group council name!</small>) </label>
                  <textarea name="introduction" id="council_introduction" class="form-control" rows="6" placeholder="Introduction Here">
                  </textarea>
                  <small class="text-muted">Leave blank if adding just group council name!</small>
                </div>
                <div class="form-group">
                  <input type="submit" id="addGroupCouncilBtn" value="Add Group Council" class="btn btn-success btn-block btn-lg">
                </div>
              </form>
            </div>

          </div>
        </div>
        </div>


        <div class="modal fade" id="editGroupCouncilModal">
          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable  modal-lg">
            <div class="modal-content" >
              <div class="modal-header bg-info text-light">
                <h4 class="text-light font-weight-bolder text-left lead"><i class="fa fa-edit fa-lg"></i>&nbsp; Edit Group Council</h4>
              </div>
              <div class="card-body">
                <form class="px-3" action="#" method="post" id="edit_group_council">
                  <span id="groupAlert"></span>
                  <div class="form-group">
                    <label for="council_name">Group Council Name <sup class="text-danger">*</sup> </label>
                    <input type="text" name="council_name" id="editcouncil_name" class="form-control"  placeholder="Group council name"  autofocus>

                  </div>

                  <div class="form-group">
                    <label for="edit_introduction">Introduction (<small class="text-muted">Leave blank if adding just group council name!</small>) </label>
                    <textarea name="introduction" id="edit_introduction" class="form-control" rows="6" placeholder="Introduction Here">
                    </textarea>
                    <small class="text-muted">Leave blank if adding just group council name!</small>
                  </div>
                  <div class="form-group">
                    <input type="hidden" name="groupID" id="groupID">
                    <input type="submit" id="editGroupCouncilBtn" value="Edit Group Council" class="btn btn-danger btn-block btn-lg">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- Start view Modal -->
          <div class="modal fade" id="showGalleryDetailsModal">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header bg-primary">
                  <h4 class="modal-title text-light"><i class="fas fa-info-circle fa-lg"></i>&nbsp; Gallery Details</h4>
                  <button type="button" name="button" class="close text-light" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-primary" id="fetchGalleryDetail">

                </div>
              </div>


            </div>
          </div>
        <!-- End view modal -->
        <!-- Start view Modal -->
          <div class="modal fade" id="showSliderDetailsModal">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header bg-primary">
                  <h4 class="modal-title text-light"><i class="fas fa-info-circle fa-lg"></i>&nbsp; Slider Details</h4>
                  <button type="button" name="button" class="close text-light" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-primary" id="fetchSliderDetail">

                </div>
              </div>


            </div>
          </div>
        <!-- End view modal -->
        <!-- Start view Modal -->
          <div class="modal fade" id="showSSODetailsModal">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header bg-primary">
                  <h4 class="modal-title text-light"><i class="fas fa-info-circle fa-lg"></i>&nbsp; SSO Details</h4>
                  <button type="button" name="button" class="close text-light" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-primary" id="FetchSSODetails">

                </div>
              </div>


            </div>
          </div>
        <!-- End view modal -->
        <!-- Start view Modal -->
          <div class="modal fade" id="showPreDetailsModal">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header bg-primary">
                  <h4 class="modal-title text-light"><i class="fas fa-info-circle fa-lg"></i>&nbsp; SSO Details</h4>
                  <button type="button" name="button" class="close text-light" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-primary" id="fetchPresidentDetails">

                </div>
              </div>


            </div>
          </div>
        <!-- End view modal -->

        <!-- Start view Modal -->
          <div class="modal fade" id="addPresidents">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header bg-primary">
                  <h4 class="modal-title text-light"><i class="fas fa-plus fa-lg"></i>&nbsp; State Presidents </h4>
                  <button type="button" name="button" class="close text-light" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body  text-primary" >
                  <form class="px-3" action="#" method="post" id="addPresidentsForm">
                    <div class="form-group">
                      <h5 id="addAlert"></h5>
                    </div>
                    <div class="form-group">
                    <input type="text" name="pre_name" id="pre_name" placeholder="enter Presidents Name" class="form-control form-control-lg">
                    </div>
                    <div class="form-group">
                      <label for="form-control">From Date</label>
                    <input type="date" name="pre_served_start" id="pre_serverd_start" class="form-control form-control-lg">
                    </div>
                    <div class="form-group">
                      <label for="form-control">To Date</label>
                    <input type="date" name="pre_served_end" id="pre_serverd_end" class="form-control form-control-lg">
                    <small>If still in service set (to date) higher than the current year</small>
                    </div>
                    <div class="form-group">
                    <input type="submit"  id="addPreBtn" value="Add" class="btn btn-info btn-lg btn-block">
                    </div>
                  </form>
                </div>
              </div>


            </div>
          </div>

          <!-- Start view Modal -->
            <div class="modal fade" id="addVPresidents">
              <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                  <div class="modal-header bg-primary">
                    <h4 class="modal-title text-light"><i class="fas fa-plus fa-lg"></i>&nbsp; State Vice Presidents </h4>
                    <button type="button" name="button" class="close text-light" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body  text-primary" >
                    <form class="px-3" action="#" method="post" id="addVPresidentsForm">
                      <div class="form-group">
                        <h5 id="addVAlert"></h5>
                      </div>
                      <div class="form-group">
                      <input type="text" name="vpre_name" id="vpre_name" placeholder="enter Vice Presidents Name" class="form-control form-control-lg">
                      </div>
                      <div class="form-group">
                        <label for="form-control">From Date</label>
                      <input type="date" name="vpre_served_start" id="vpre_serverd_start" class="form-control form-control-lg">
                      </div>
                      <div class="form-group">
                        <label for="form-control">To Date</label>
                      <input type="date" name="vpre_served_end" id="vpre_serverd_end" class="form-control form-control-lg">
                      <small>If still in service set (to date) higher than the current year</small>
                      </div>
                      <div class="form-group">
                      <input type="submit"  id="addVPreBtn" value="Add" class="btn btn-info btn-lg btn-block">
                      </div>
                    </form>
                  </div>
                </div>


              </div>
            </div>

            <div class="modal fade" id="addSSO">
              <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                  <div class="modal-header bg-primary">
                    <h4 class="modal-title text-light"><i class="fas fa-plus fa-lg"></i>&nbsp; State Secretary Organizers </h4>
                    <button type="button" name="button" class="close text-light" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body  text-primary" >
                    <form class="px-3" action="#" method="post" id="addSSOForm">
                      <div class="form-group">
                        <h5 id="addSSOAlert"></h5>
                      </div>
                      <div class="form-group">
                      <input type="text" name="sso_name" id="sso_name" placeholder="enter SSO Name" class="form-control form-control-lg">
                      </div>
                      <div class="form-group">
                        <label for="form-control">From Date</label>
                      <input type="date" name="sso_served_start" id="sso_serverd_start" class="form-control form-control-lg">
                      </div>
                      <div class="form-group">
                        <label for="form-control">To Date</label>
                      <input type="date" name="sso_served_end" id="sso_serverd_end" class="form-control form-control-lg">
                      <small>If still in service set (to date) higher than the current year</small>
                      </div>
                      <div class="form-group">
                      <input type="submit"  id="addSSOBtn" value="Add" class="btn btn-info btn-lg btn-block">
                      </div>
                    </form>
                  </div>
                </div>


              </div>
            </div>

            <div class="modal fade" id="addASSO">
              <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                  <div class="modal-header bg-primary">
                    <h4 class="modal-title text-light"><i class="fas fa-plus fa-lg"></i>&nbsp;Assistant State Secretary Organizers </h4>
                    <button type="button" name="button" class="close text-light" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body  text-primary" >
                    <form class="px-3" action="#" method="post" id="addASSOForm">
                      <div class="form-group">
                        <h5 id="addASSOAlert"></h5>
                      </div>
                      <div class="form-group">
                      <input type="text" name="asso_name" id="asso_name" placeholder="enter ASSO Name" class="form-control form-control-lg">
                      </div>
                      <div class="form-group">
                        <label for="form-control">From Date</label>
                      <input type="date" name="asso_served_start" id="asso_serverd_start" class="form-control form-control-lg">
                      </div>
                      <div class="form-group">
                        <label for="form-control">To Date</label>
                      <input type="date" name="asso_served_end" id="asso_serverd_end" class="form-control form-control-lg">
                      <small>If still in service set (to date) higher than the current year</small>
                      </div>
                      <div class="form-group">
                      <input type="submit"  id="addASSOBtn" value="Add" class="btn btn-info btn-lg btn-block">
                      </div>
                    </form>
                  </div>
                </div>


              </div>
            </div>

            <div class="modal fade" id="addTreasures">
              <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                  <div class="modal-header bg-primary">
                    <h4 class="modal-title text-light"><i class="fas fa-plus fa-lg"></i>&nbsp;Treasures </h4>
                    <button type="button" name="button" class="close text-light" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body  text-primary" >
                    <form class="px-3" action="#" method="post" id="addTreasuresForm">
                      <div class="form-group">
                        <h5 id="addTreasuresAlert"></h5>
                      </div>
                      <div class="form-group">
                      <input type="text" name="tre_name" id="tre_name" placeholder="enter Treasure Name" class="form-control form-control-lg">
                      </div>
                      <div class="form-group">
                        <label for="form-control">From Date</label>
                      <input type="date" name="tre_served_start" id="tre_serverd_start" class="form-control form-control-lg">
                      </div>
                      <div class="form-group">
                        <label for="form-control">To Date</label>
                      <input type="date" name="tre_served_end" id="tre_serverd_end" class="form-control form-control-lg">
                      <small>If still in service set (to date) higher than the current year</small>
                      </div>
                      <div class="form-group">
                      <input type="submit"  id="addTreasuresBtn" value="Add" class="btn btn-info btn-lg btn-block">
                      </div>
                    </form>
                  </div>
                </div>


              </div>
            </div>

    <div class="modal fade" id="addFinSec">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <h4 class="modal-title text-light"><i class="fas fa-plus fa-lg"></i>&nbsp;Financial Secretary</h4>
            <button type="button" name="button" class="close text-light" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body  text-primary" >
            <form class="px-3" action="#" method="post" id="addFinForm">
              <div class="form-group">
                <h5 id="addFinAlert"></h5>
              </div>
              <div class="form-group">
              <input type="text" name="fs_name" id="fs_name" placeholder="enter Fin Sec Name" class="form-control form-control-lg">
              </div>
              <div class="form-group">
                <label for="form-control">From Date</label>
              <input type="date" name="fs_served_start" id="fs_serverd_start" class="form-control form-control-lg">
              </div>
              <div class="form-group">
                <label for="form-control">To Date</label>
              <input type="date" name="fs_served_end" id="fs_serverd_end" class="form-control form-control-lg">
              <small>If still in service set (to date) higher than the current year</small>
              </div>
              <div class="form-group">
              <input type="submit"  id="addFinBtn" value="Add" class="btn btn-info btn-lg btn-block">
              </div>
            </form>
          </div>
        </div>


      </div>
    </div>


    <div class="modal fade" id="addAud">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <h4 class="modal-title text-light"><i class="fas fa-plus fa-lg"></i>&nbsp;Auditors</h4>
            <button type="button" name="button" class="close text-light" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body  text-primary" >
            <form class="px-3" action="#" method="post" id="addAudForm">
              <div class="form-group">
                <h5 id="addAudAlert"></h5>
              </div>
              <div class="form-group">
              <input type="text" name="aud_name" id="aud_name" placeholder="enter Auditor Name" class="form-control form-control-lg">
              </div>
              <div class="form-group">
                <label for="form-control">From Date</label>
              <input type="date" name="aud_served_start" id="aud_serverd_start" class="form-control form-control-lg">
              </div>
              <div class="form-group">
                <label for="form-control">To Date</label>
              <input type="date" name="aud_served_end" id="aud_serverd_end" class="form-control form-control-lg">
              <small>If still in service set (to date) higher than the current year</small>
              </div>
              <div class="form-group">
              <input type="submit"  id="addAudBtn" value="Add" class="btn btn-info btn-lg btn-block">
              </div>
            </form>
          </div>
        </div>


      </div>
    </div>


        <div class="modal fade" id="addpro">
          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <h4 class="modal-title text-light"><i class="fas fa-plus fa-lg"></i>&nbsp;PROs</h4>
                <button type="button" name="button" class="close text-light" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body  text-primary" >
                <form class="px-3" action="#" method="post" id="addPROForm">
                  <div class="form-group">
                    <h5 id="addPROAlert"></h5>
                  </div>
                  <div class="form-group">
                  <input type="text" name="pro_name" id="pro_name" placeholder="enter PRO Name" class="form-control form-control-lg">
                  </div>
                  <div class="form-group">
                    <label for="form-control">From Date</label>
                  <input type="date" name="pro_served_start" id="pro_serverd_start" class="form-control form-control-lg">
                  </div>
                  <div class="form-group">
                    <label for="form-control">To Date</label>
                  <input type="date" name="pro_served_end" id="pro_serverd_end" class="form-control form-control-lg">
                  <small>If still in service set (to date) higher than the current year</small>
                  </div>
                  <div class="form-group">
                  <input type="submit"  id="addPROBtn" value="Add" class="btn btn-info btn-lg btn-block">
                  </div>
                </form>
              </div>
            </div>


          </div>
        </div>

        <div class="modal fade" id="addDO">
          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <h4 class="modal-title text-light"><i class="fas fa-plus fa-lg"></i>&nbsp;Disciplinary Officers</h4>
                <button type="button" name="button" class="close text-light" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body  text-primary" >
                <form class="px-3" action="#" method="post" id="addDOForm">
                  <div class="form-group">
                    <h5 id="addDOAlert"></h5>
                  </div>
                  <div class="form-group">
                  <input type="text" name="do_name" id="do_name" placeholder="enter Officer Name" class="form-control form-control-lg">
                  </div>
                  <div class="form-group">
                    <label for="form-control">From Date</label>
                  <input type="date" name="do_served_start" id="do_serverd_start" class="form-control form-control-lg">
                  </div>
                  <div class="form-group">
                    <label for="form-control">To Date</label>
                  <input type="date" name="do_served_end" id="do_serverd_end" class="form-control form-control-lg">
                  <small>If still in service set (to date) higher than the current year</small>
                  </div>
                  <div class="form-group">
                  <input type="submit"  id="addDOBtn" value="Add" class="btn btn-info btn-lg btn-block">
                  </div>
                </form>
              </div>
            </div>


          </div>
        </div>

        <div class="modal fade" id="addPC">
          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <h4 class="modal-title text-light"><i class="fas fa-plus fa-lg"></i>&nbsp;Parade Commanders</h4>
                <button type="button" name="button" class="close text-light" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body  text-primary" >
                <form class="px-3" action="#" method="post" id="addPCForm">
                  <div class="form-group">
                    <h5 id="addPCAlert"></h5>
                  </div>
                  <div class="form-group">
                  <input type="text" name="pc_name" id="pc_name" placeholder="enter Parade Commanders Name" class="form-control form-control-lg">
                  </div>
                  <div class="form-group">
                    <label for="form-control">From Date</label>
                  <input type="date" name="pc_served_start" id="pc_serverd_start" class="form-control form-control-lg">
                  </div>
                  <div class="form-group">
                    <label for="form-control">To Date</label>
                  <input type="date" name="pc_served_end" id="pc_serverd_end" class="form-control form-control-lg">
                  <small>If still in service set (to date) higher than the current year</small>
                  </div>
                  <div class="form-group">
                  <input type="submit"  id="addPCBtn" value="Add" class="btn btn-info btn-lg btn-block">
                  </div>
                </form>
              </div>
            </div>


          </div>
        </div>

        <div class="modal fade" id="addCHA">
          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <h4 class="modal-title text-light"><i class="fas fa-plus fa-lg"></i>&nbsp;Chaplains</h4>
                <button type="button" name="button" class="close text-light" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body  text-primary" >
                <form class="px-3" action="#" method="post" id="addCHAForm">
                  <div class="form-group">
                    <h5 id="addPCAlert"></h5>
                  </div>
                  <div class="form-group">
                  <input type="text" name="cha_name" id="cha_name" placeholder="enter Chaplains Name" class="form-control form-control-lg">
                  </div>
                  <div class="form-group">
                    <label for="form-control">From Date</label>
                  <input type="date" name="cha_served_start" id="cha_serverd_start" class="form-control form-control-lg">
                  </div>
                  <div class="form-group">
                    <label for="form-control">To Date</label>
                  <input type="date" name="cha_served_end" id="cha_serverd_end" class="form-control form-control-lg">
                  <small>If still in service set (to date) higher than the current year</small>
                  </div>
                  <div class="form-group">
                  <input type="submit"  id="addCHABtn" value="Add" class="btn btn-info btn-lg btn-block">
                  </div>
                </form>
              </div>
            </div>


          </div>
        </div>



        <div class="modal fade" id="addQB">
          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <h4 class="modal-title text-light"><i class="fas fa-plus fa-lg"></i>&nbsp;Quarter masters</h4>
                <button type="button" name="button" class="close text-light" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body  text-primary" >
                <form class="px-3" action="#" method="post" id="addQBForm">
                  <div class="form-group">
                    <h5 id="addQBAlert"></h5>
                  </div>
                  <div class="form-group">
                  <input type="text" name="qb_name" id="qb_name" placeholder="enter QM Name" class="form-control form-control-lg">
                  </div>
                  <div class="form-group">
                    <label for="form-control">From Date</label>
                  <input type="date" name="qb_served_start" id="qb_serverd_start" class="form-control form-control-lg">
                  </div>
                  <div class="form-group">
                    <label for="form-control">To Date</label>
                  <input type="date" name="qb_served_end" id="qb_serverd_end" class="form-control form-control-lg">
                  <small>If still in service set (to date) higher than the current year</small>
                  </div>

                  <div class="form-group">
                  <input type="submit"  id="addQBBtn" value="Add" class="btn btn-info btn-lg btn-block">
                  </div>
                </form>
              </div>
            </div>


          </div>
        </div>

        <div class="modal fade" id="addBM">
          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <h4 class="modal-title text-light"><i class="fas fa-plus fa-lg"></i>&nbsp;Band masters</h4>
                <button type="button" name="button" class="close text-light" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body  text-primary" >
                <form class="px-3" action="#" method="post" id="addBMForm">
                  <div class="form-group">
                    <h5 id="addBMAlert"></h5>
                  </div>
                  <div class="form-group">
                  <input type="text" name="bm_name" id="bm_name" placeholder="enter BM Name" class="form-control form-control-lg">
                  </div>
                  <div class="form-group">
                    <label for="form-control">From Date</label>
                  <input type="date" name="bm_served_start" id="bm_serverd_start" class="form-control form-control-lg">
                  </div>
                  <div class="form-group">
                    <label for="form-control">To Date</label>
                  <input type="date" name="bm_served_end" id="bm_serverd_end" class="form-control form-control-lg">
                  <small>If still in service set (to date) higher than the current year</small>
                  </div>

                  <div class="form-group">
                  <input type="submit"  id="addBMBtn" value="Add" class="btn btn-info btn-lg btn-block">
                  </div>
                </form>
              </div>
            </div>


          </div>
        </div>

        <div class="modal fade" id="addPM">
          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <h4 class="modal-title text-light"><i class="fas fa-plus fa-lg"></i>&nbsp;Pioner Memebers</h4>
                <button type="button" name="button" class="close text-light" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body  text-primary" >
                <form class="px-3" action="#" method="post" id="addPMForm">
                  <div class="form-group">
                    <h5 id="addPMAlert"></h5>
                  </div>
                  <div class="form-group">
                  <input type="text" name="piom_name" id="piom_name" placeholder="enter Pionier Member Name" class="form-control form-control-lg">
                  </div>

                  <div class="form-group">
                  <input type="submit"  id="addPMBtn" value="Add" class="btn btn-info btn-lg btn-block">
                  </div>
                </form>
              </div>
            </div>


          </div>
        </div>

        <div class="modal fade" id="addPP">
          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <h4 class="modal-title text-light"><i class="fas fa-plus fa-lg"></i>&nbsp;Patrons And Partronesses</h4>
                <button type="button" name="button" class="close text-light" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body  text-primary" >
                <form class="px-3" action="#" method="post" id="addPPForm">
                  <div class="form-group">
                    <h5 id="addPPAlert"></h5>
                  </div>
                  <div class="form-group">
                  <input type="text" name="pat_name" id="pat_name" placeholder="enter  Name" class="form-control form-control-lg" >
                  </div>

                  <div class="form-group">
                  <input type="submit"  id="addPPBtn" value="Add" class="btn btn-info btn-lg btn-block">
                  </div>
                </form>
              </div>
            </div>


          </div>
        </div>


<div class="modal fade" id="addCompany">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable  modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">
        Add New Company
          </h3>
          <button type="button" class="close" data-dismiss="modal" name="button">&times;</button>
        </div>
        <div class="modal-body">
          <form class="px-3" action="#" method="post" id="addCompanyForm">
            <span id="companyAlert"></span>
            <div class="form-group">
              <label for="companyNumber">Company Number<sup class="text-danger">*</sup> </label>
              <input type="text" name="companyNumber" id="companyNumber" class="form-control"  placeholder="Eg 1st Kogi Company"  autofocus>

            </div>
            
             <div class="form-group">
              <label for="church">Church<sup class="text-danger">*</sup> </label>
              <input type="text" name="church" id="church" class="form-control"  placeholder="Enter Church"  autofocus>

            </div>
            <div class="form-group">
              <input type="submit" id="addCompanyBtn" value="Add Company" class="btn btn-success btn-block btn-lg">
            </div>
          </form>
        </div>

      </div>
    </div>
    </div>

<div class="modal fade" id="editCompanyModal">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable  modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">
        Edit Company
          </h3>
          <button type="button" class="close" data-dismiss="modal" name="button">&times;</button>
        </div>
        <div class="modal-body">
          <form class="px-3" action="#" method="post" id="editCompanyForm">
            <span id="companyEditAlert"></span>
            <div class="form-group">
              <label for="companyNumber">Company Number<sup class="text-danger">*</sup> </label>
              <input type="text" name="editcompanyNumber" id="editcompanyNumber" class="form-control"  placeholder="Eg 1st Kogi Company"  autofocus>

            </div>
            
             <div class="form-group">
              <label for="church">Church<sup class="text-danger">*</sup> </label>
              <input type="text" name="editchurch" id="editchurch" class="form-control"  placeholder="Enter Church" >

            </div>
            <div class="form-group">
              <input type="hidden" name="editCompanyID" id="editCompanyID">
              <input type="submit" id="editCompanyBtn" value="Edit Company" class="btn btn-success btn-block btn-lg">
            </div>
          </form>
        </div>

      </div>
    </div>
    </div>