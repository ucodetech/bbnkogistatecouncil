 //Add New note
  $(document).ready(function(){

    $("body").on("click", "#reqPermissionBtn", function(e){
        e.preventDefault();
        
    $.ajax({
      url: 'scripts/feedback-pro.php',
      method: 'POST',
      data: $('#requestPermissionForm').serialize()+'&action=grantPermisson',
     beforeSend: function(){
           $('#reqPermissionBtn').html('<img src="<?= URLROOT;  ?>gif/tra.gif"> Please wait...');
           $('#reqPermissionBtn').attr('disabled', true);
         },
      success:function(response){
          location.reload();
      }
        });
    });


      $('#addNoteBtn').click(function(e){
        if ($('#add-note-form')[0].checkValidity()) {
          e.preventDefault();
          $('#addNoteBtn').val('Please Wait...');
          $.ajax({
            url:'scripts/process.php',
            method:'Post',
            data:$('#add-note-form').serialize()+'&action=add_note',
            success:function(response){
                $('#addNoteBtn').val('Add Note');
                $('#add-note-form')[0].reset();
                $('#addNoteModal').modal('hide');
                Swal.fire({
                    title: 'Note Added Successfully!',
                    type: 'success'

                });
                displayAllNotes();

            }
          });
        }
      });

      // Edit Note function

      $("body").on("click", ".editBtn", function(e){
          e.preventDefault();
          edit_id = $(this).attr('id');
          $.ajax({
            url: 'scripts/process.php',
            method: 'POST',
            data: {edit_id: edit_id},
            success:function(response){
            data = JSON.parse(response);
              $('#editId').val(data.id);
              $('#title').val(data.title);
              $('#note').val(data.note);

            }
          });
      });

      //Update Note
      $("#editNoteBtn").click(function(e){
        if ($("#edit-note-form")[0].checkValidity()) {
          e.preventDefault();
          $.ajax({
            url: 'scripts/process.php',
            method: 'POST',
            data: $('#edit-note-form').serialize()+'&action=update_note',
            success:function(response){
              Swal.fire({
                title: 'Note Updated Successfully!',
                type: 'success'
              });
              $('#edit-note-form')[0].reset();
              $('#editNoteModal').modal('hide');
              displayAllNotes();
            }
          });
        }
      });

      // delete note
      $("body").on("click", ".deleteBtn", function(e){
          e.preventDefault();
          del_id = $(this).attr('id');
          Swal.fire({
              title: 'Are you sure?',
              text: "You can view the note in trash and restore or delete permenatly!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, Move it!'
            }).then((result) => {
              if (result.value) {
                $.ajax({
                  url: 'scripts/process.php',
                  method: 'POST',
                  data: {del_id: del_id},
                  success:function(response){
                    Swal.fire(
                      'Note Trashed!',
                      'Note Sent to Trash Can! <a href="trash">Trash Can</a>',
                      'success'
                    )
                    displayAllNotes();
                  }
                });

              }
            });

      });

      //Note Details
      $('body').on("click", ".infoBtn", function(e){
        e.preventDefault();
        info_id = $(this).attr('id');
        $.ajax({
          url: 'scripts/process.php',
          method: 'POST',
          data: {info_id: info_id},
          success:function(response){
          data = JSON.parse(response);
          Swal.fire({
            title: '<strong> Note : ID('+data.id+')</stron>',
            type: 'info',
            html: '<b> Title :  </b>'+data.title+ '<br><br><b> Note :  </b>'+data.note+ '<br><br><i> Created On :  </i>'+data.dateCreated+'<br><br><i> Updated On : </i>'+data.dateUpdated,
            showCloseButton: true
          });
          }
        });
      });

      displayAllNotes();
      //Fetch Post
      function displayAllNotes(){
        $.ajax({
            url: 'scripts/process.php',
            method: 'POST',
            data: {action: 'display_notes'},
            success:function(response){
              $('#showNote').html(response);
              $('#showNotes').DataTable({
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
        });
      };

  update_user_login();

     			function update_user_login()
     			{
     			    var action = 'update_time';
     			    $.ajax({
     			       url:"scripts/virus.php",
     			       method:"POST",
     			       data:{action:action},
     			       success:function(data)
     			       {


     			       },
     			       error:function(){alert("something went wrong")}

     			    });
     			}
     			 setInterval(function(){
     			   update_user_login();
     			}, 3000);


              // checking user is logged in or not
              $.ajax({
                  url: 'scripts/pro-action.php',
                  method: 'post',
                  data: {action: 'checkUser'},
                  success:function(response){
                    if (response === 'Bye' ) {
                      window.location = '../';
                    }
                  }
              });



 $('#dataInfoReportForm').submit(function(e){
        e.preventDefault();
        $.ajax({
         
          url: 'scripts/dataForm-process.php',
          method: 'POST',
          processData: false,
          contentType: false,
          cache: false,
          data: new FormData(this),
          
          success:function(response){
            if (response==='success') {
              $('#dataInfoReportForm')[0].reset();
              $('#dataformInfo').modal('hide');
              location.reload();
            }else{
              $('#showError').html(response);
            }
          
          }
        })

    });


function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#previewLt').html('<img src="'+e.target.result+'" alt="Preview"  class="img-fluid img-thumbnail" width="108">');
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

$("#report_signature").change(function() {
  readURL(this);
});


function readURLCha(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#previewCha').html('<img src="'+e.target.result+'" alt="Preview"  class="img-fluid img-thumbnail" width="108">');
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

$("#chaplain_signature").change(function() {
  readURLCha(this);
});

  
  $('#RedirectBoyOnly').click(function(e){
    e.preventDefault();
    $('#RedirectBoyOnly').html('<img src="<?= URLROOT;  ?>gif/block.gif"> Redirecting Please wait...');
      setInterval(function(){

        window.location = '<?=URLROOT?>officers/dataForm/boysOnly/<?= $officer->officer_id ?>';
      }, 8000);
  });

 
  $('#RedirectOnly').click(function(e){
    e.preventDefault();
    $('#RedirectOnly').html('<img src="<?= URLROOT;  ?>gif/block.gif"> Redirecting Please wait...');
      setInterval(function(){

        window.location = '<?=URLROOT?>officers/dataForm/test/<?= $officer->officer_id ?>';

      }, 8000);
  });


      });