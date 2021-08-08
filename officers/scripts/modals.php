<!-- Add Note Modal -->
  <div class="modal fade" id="addNoteModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h4 class="modal-title text-light"> <i class="fas fa-plus-circle"></i> Add New Note</h4>
          <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form  action="#" method="post" id="add-note-form" class="px-3">
            <input type="hidden" name="id" id="id" value="">
            <div class="form-group">
              <input type="text" name="title" class="form-control form-control-lg" placeholder="Enter Title" required>
            </div>
            <div class="form-group">
              <textarea name="note" rows="6" class="form-control form-control-lg" placeholder="Write your note..." required>
              </textarea>
            </div>
            <div class="form-group">
              <input type="submit" name="addNote" id="addNoteBtn" value="Add Note" class="btn btn-info btn-block btn-lg">
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
<!-- End Add New note modal -->
<!-- Edit Note Modal -->
  <div class="modal fade" id="editNoteModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h4 class="modal-title text-light"><i class="fas fa-edit"></i> Edit Note</h4>
          <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form  action="#" method="post" id="edit-note-form" class="px-3">
            <input type="hidden" name="editId" id="editId">
            <div class="form-group">
              <input type="text" name="title" id="title" class="form-control form-control-lg" placeholder="Enter Title" value="" required>
            </div>
            <div class="form-group">
              <textarea name="note" id="note" rows="6" class="form-control form-control-lg" placeholder="Write your note..." required>

              </textarea>
            </div>
            <div class="form-group">
              <input type="submit" name="editNote" id="editNoteBtn" value="Edit Note" class="btn btn-info btn-block btn-lg">
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
<!-- End Edit  note modal -->

<!-- dataform Modal -->
  <div class="modal fade" id="dataformInfo">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h4 class="modal-title text-light"><i class="fas fa-edit"></i> Officer Reporting Details</h4>
          <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div id="showError"></div>
          <form  action="#" method="post" id="dataInfoReportForm" class="px-3">
            <div class="row">
            <input type="hidden" name="controller_id" id="controller_id" value="<?=$officer->officer_id  ?>">
            <div class="form-group col-md-6">
              <label>Church</label>
              <input type="text" name="church" id="church" class="form-control form-control-lg" readonly value="<?= $officer->officers_home_church ?>" required>
            </div>
            <div class="form-group col-md-6">
              <label>Company Code</label>
              <input type="text" name="companyCode" id="companyCode" class="form-control form-control-lg" readonly value="<?= $officer->officers_company_code ?>" required>
            </div>
            <div class="form-group col-md-6">
              <label>Battalion/Group Council</label>
              <input type="text" name="council" id="council" class="form-control form-control-lg" readonly value="<?= $officer->officers_group_council ?>" required>
            </div>
            <div class="form-group col-md-6">
               <label>Name</label>
              <input type="text" name="officer_name" id="officer_name" class="form-control form-control-lg" readonly value="<?= $officer->officers_name ?>" required>
            </div>
            <?php if ($officer->data()->designation_company): ?>
              <div class="form-group col-md-6">
              <label>Office</label>
              <input type="text" name="office" id="office" class="form-control form-control-lg" readonly value="<?= $officer->designation_company?>" required>
            </div>
              <?php else: ?>
                <div class="form-group col-md-6">
              <label>Office</label>
              <input type="text" name="office" id="office" class="form-control form-control-lg" readonly value="<?= $officer->designation_council ?>" required>
            </div>
            <?php endif ?>

            <div class="form-group col-md-6">
              <label>Area Council</label>
              <input type="text" name="areaCouncil" id="areaCouncil" class="form-control form-control-lg" placeholder="Enter Area Councils If Available">
            </div>
            <div class="form-group col-md-6">
              <label for="form-control">Chaplains Name <sup class="text-danger">*</sup></label>
              <input type="text" name="nameChaplain" id="nameChaplain" class="form-control form-control-lg" placeholder="Enter Chaplains Name" required>
            </div>

            <div class="form-group col-md-6">
              <p id="previewLt">
              </p>
              <div class="custom-file">
               <input type="file" name="report_signature" id="report_signature"
               class="custom-file-input">
                <label for="file" class="custom-file-label">(Your Signature)<sup class="text-danger">*</sup></label>

             </div>
            </div>

            <div class="form-group col-md-6">
              <p id="previewCha">
              </p>
              <div class="custom-file">
               <input type="file" name="chaplain_signature" id="chaplain_signature"
               class="custom-file-input">
                <label for="file" class="custom-file-label">(Chaplians Signature)<sup class="text-danger">*</sup></label>
             </div>
            </div>

            <div class="form-group col-md-12">
              <input type="submit" name="addInfo" id="addInfoBtn" value="Submit" class="btn btn-info btn-block btn-lg">
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>

  </div>
<!-- data form note modal -->


<!-- dataform Modal -->
  <div class="modal fade" id="updateStateID">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h4 class="modal-title text-light"><i class="fas fa-edit"></i> Update State ID</h4>
          <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div id="updateError"></div>
          <span class="text-muted text-left">Name: <span id="oName" class="text-success"></span></span>
          <form  action="#" method="post" id="updateForm" class="px-3">
          <input type="hidden" name="updateID" id="updateID">
            <div class="form-group">
              <input type="text" name="idUpdate" id="idUpdate" class="form-control form-control-lg"  placeholder="Enter State ID">
            </div>


            <div class="form-group">
              <input type="submit" name="updateIDBtn" id="updateIDBtn" value="Update" class="btn btn-info btn-block btn-lg">
            </div>

          </form>
        </div>
      </div>
    </div>

  </div>


  <!-- dataform Modal -->
  <div class="modal fade" id="updateStateIDOfficer">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h4 class="modal-title text-light"><i class="fas fa-edit"></i> Update State ID</h4>
          <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div id="updateOfficerError"></div>
          <span class="text-muted text-left">Name: <span id="NameOfficer" class="text-success"></span></span>
          <form  action="#" method="post" id="updateFormOfficer" class="px-3">
          <input type="hidden" name="updateIDOfficer" id="updateIDOfficer">
            <div class="form-group">
              <input type="text" name="idUpdateOfficer" id="idUpdateOfficer" class="form-control form-control-lg"  placeholder="Enter State ID">
            </div>


            <div class="form-group">
              <input type="submit" name="updateIDBtn" id="updateIDBtnOfficer" value="Update" class="btn btn-info btn-block btn-lg">
            </div>

          </form>
        </div>
      </div>
    </div>

  </div>

  <!-- send to state -->
  <div class="modal fade" id="sendToState">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h4 class="modal-title text-light"><i class="fas fa-edit"></i>Send To State</h4>
          <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" id="showSendForm">

        </div>
      </div>
    </div>
