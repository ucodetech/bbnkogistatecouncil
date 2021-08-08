$(document).ready(function(){


  $('#addPreBtn').click(function(e){
            if ($('#addPresidentsForm')[0].checkValidity()) {
              e.preventDefault();
              $('#addPreBtn').val('Please wait...');
              $.ajax({
                url: 'virus/add-process.php',
                method: 'post',
                data: $('#addPresidentsForm').serialize()+'&action=add_presidentState',
                success:function(response){
                  console.log(response);
                  if ($.trim(response) === 'success') {
                    $('#addPreBtn').val('Add');
                    $('#addPresidentsForm')[0].reset();
                    $('#addPresidents').modal('hide');
                    fetchPresidentsState();
                  }else{
                    $('#addAlert').fadeIn('slow').html(response)
                    setTimeout(function(){
                      $('#addAlert').html(response).fadeOut('slow');
                    }, 10000);
                  }
                }
              });
            }
          });


  fetchPresidentsState();
  function fetchPresidentsState(){
    var action = 'fetchData';
    $.ajax({
      url: 'virus/add-process.php',
      method: 'post',
      data: {action:action},
      success:function(response){
        $('#presidentTable').html(response);
        $('#showPr').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
           "lengthMenu": [[2,10, 25, 50, -1], [10, 25, 50, "All"]]
        });

      },
      error:function(){
        alert('something went wrong');
      }
    });
  }



  $('#addVPreBtn').click(function(e){
    if ($('#addVPresidentsForm')[0].checkValidity()) {
      e.preventDefault();
      $('#addVPreBtn').val('Please wait...');
      $.ajax({
        url: 'virus/add-process.php',
        method: 'post',
        data: $('#addVPresidentsForm').serialize()+'&action=add_vpresidentState',
        success:function(response){
          if ($.trim(response) === 'success') {
            $('#addVPreBtn').val('Add');
            $('#addVPresidentsForm')[0].reset();
            $('#addVPresidents').modal('hide');
            fetchVPresidentsState();
          }else{
            $('#addAlert').fadeIn('slow').html(response)
            setTimeout(function(){
              $('#addAlert').html(response).fadeOut('slow');
            }, 10000);
          }
        }
      });
    }
  });


  fetchVPresidentsState();
  function fetchVPresidentsState(){
  var action = 'fetchDataVp';
  $.ajax({
      url: 'virus/add-process.php',
      method: 'post',
      data: {action:action},
      success:function(response){
      $('#vicepresidentTable').html(response);
      $('#showVPr').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
         "lengthMenu": [[2,10, 25, 50, -1], [10, 25, 50, "All"]]
});

  },
  error:function(){
      alert('something went wrong');
      }
  });
  }



    $('#addSSOBtn').click(function(e){
      if ($('#addSSOForm')[0].checkValidity()) {
        e.preventDefault();
        $('#addSSOBtn').val('Please wait...');
        $.ajax({
          url: 'virus/add-process.php',
          method: 'post',
          data: $('#addSSOForm').serialize()+'&action=add_ssoState',
          success:function(response){
            if ($.trim(response) === 'success') {
              $('#addSSOBtn').val('Add');
              $('#addSSOForm')[0].reset();
              $('#addSSO').modal('hide');
              fetchSSOStae();
            }else{
              $('#addSSOAlert').fadeIn('slow').html(response)
              setTimeout(function(){
                $('#addSSOAlert').html(response).fadeOut('slow');
              }, 10000);
            }
          }
        });
      }
    });


    fetchSSOStae();
    function fetchSSOStae(){
    var action = 'fetchDataSSO';
    $.ajax({
        url: 'virus/add-process.php',
        method: 'post',
        data: {action:action},
        success:function(response){
        $('#ssoTable').html(response);
        $('#showSSOState').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
           "lengthMenu": [[2,10, 25, 50, -1], [10, 25, 50, "All"]]
  });

    },
    error:function(){
        alert('something went wrong');
        }
    });
    }


    $('#addASSOBtn').click(function(e){
      if ($('#addASSOForm')[0].checkValidity()) {
        e.preventDefault();
        $('#addASSOBtn').val('Please wait...');
        $.ajax({
          url: 'virus/add-process.php',
          method: 'post',
          data: $('#addASSOForm').serialize()+'&action=add_assoState',
          success:function(response){
            if ($.trim(response) === 'success') {
              $('#addASSOBtn').val('Add');
              $('#addASSOForm')[0].reset();
              $('#addASSO').modal('hide');
                fetchASSOStae();
            }else{
              $('#addASSOAlert').fadeIn('slow').html(response)
              setTimeout(function(){
                $('#addASSOAlert').html(response).fadeOut('slow');
              }, 10000);
            }
          }
        });
      }
    });


    fetchASSOStae();
    function fetchASSOStae(){
    var action = 'fetchDataASSO';
    $.ajax({
        url: 'virus/add-process.php',
        method: 'post',
        data: {action:action},
        success:function(response){
        $('#assoTable').html(response);
        $('#showASSOState').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
           "lengthMenu": [[2,10, 25, 50, -1], [10, 25, 50, "All"]]
  });

    },
    error:function(){
        alert('something went wrong');
        }
    });
    }


  $('#addTreasuresBtn').click(function(e){
    if ($('#addTreasuresForm')[0].checkValidity()) {
      e.preventDefault();
      $('#addTreasuresBtn').val('Please wait...');
      $.ajax({
        url: 'virus/add-process.php',
        method: 'post',
        data: $('#addTreasuresForm').serialize()+'&action=add_treState',
        success:function(response){
          if ($.trim(response) === 'success') {
            $('#addTreasuresBtn').val('Add');
            $('#addTreasuresForm')[0].reset();
            $('#addTreasures').modal('hide');
              fetchTreasuresStae();
          }else{
            $('#addTreasuresAlert').fadeIn('slow').html(response)
            setTimeout(function(){
              $('#addTreasuresAlert').html(response).fadeOut('slow');
            }, 10000);
          }
        }
      });
    }
  });


  fetchTreasuresStae();
  function fetchTreasuresStae(){
  var action = 'fetchDataTreasures';
  $.ajax({
      url: 'virus/add-process.php',
      method: 'post',
      data: {action:action},
      success:function(response){
      $('#treaTable').html(response);
      $('#showTreasuresState').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
         "lengthMenu": [[2,10, 25, 50, -1], [10, 25, 50, "All"]]
});

  },
  error:function(){
      alert('something went wrong');
      }
  });
  }


  $('#addFinBtn').click(function(e){
    if ($('#addFinForm')[0].checkValidity()) {
      e.preventDefault();
      $('#addFinBtn').val('Please wait...');
      $.ajax({
        url: 'virus/add-process.php',
        method: 'post',
        data: $('#addFinForm').serialize()+'&action=add_finState',
        success:function(response){
          if ($.trim(response) === 'success') {
            $('#addFinBtn').val('Add');
            $('#addFinForm')[0].reset();
            $('#addFinSec').modal('hide');
              fetchFinStae();
          }else{
            $('#addFinAlert').fadeIn('slow').html(response)
            setTimeout(function(){
              $('#addFinAlert').html(response).fadeOut('slow');
            }, 10000);
          }
        }
      });
    }
  });


  fetchFinStae();
  function fetchFinStae(){
  var action = 'fetchDataFin';
  $.ajax({
      url: 'virus/add-process.php',
      method: 'post',
      data: {action:action},
      success:function(response){
      $('#finsecTable').html(response);
      $('#showFinState').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
         "lengthMenu": [[2,10, 25, 50, -1], [10, 25, 50, "All"]]
});

  },
  error:function(){
      alert('something went wrong');
      }
  });
  }


  $('#addAudBtn').click(function(e){
    if ($('#addAudForm')[0].checkValidity()) {
      e.preventDefault();
      $('#addAudBtn').val('Please wait...');
      $.ajax({
        url: 'virus/add-process.php',
        method: 'post',
        data: $('#addAudForm').serialize()+'&action=add_audState',
        success:function(response){
          if ($.trim(response) === 'success') {
            $('#addAudBtn').val('Add');
            $('#addAudForm')[0].reset();
            $('#addAud').modal('hide');
              fetchAudStae();
          }else{
            $('#addAudAlert').fadeIn('slow').html(response)
            setTimeout(function(){
              $('#addAudAlert').html(response).fadeOut('slow');
            }, 10000);
          }
        }
      });
    }
  });


  fetchAudStae();
  function fetchAudStae(){
  var action = 'fetchDataAud';
  $.ajax({
      url: 'virus/add-process.php',
      method: 'post',
      data: {action:action},
      success:function(response){
      $('#audTable').html(response);
      $('#showA').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
         "lengthMenu": [[2,10, 25, 50, -1], [10, 25, 50, "All"]]
  });

  },
  error:function(){
      alert('something went wrong');
      }
  });
  }


  $('#addPROBtn').click(function(e){
    if ($('#addPROForm')[0].checkValidity()) {
      e.preventDefault();
      $('#addPROBtn').val('Please wait...');
      $.ajax({
        url: 'virus/add-process.php',
        method: 'post',
        data: $('#addPROForm').serialize()+'&action=add_proState',
        success:function(response){
          if ($.trim(response) === 'success') {
            $('#addPROBtn').val('Add');
            $('#addPROForm')[0].reset();
            $('#addpro').modal('hide');
              fetchPROStae();
          }else{
            $('#addPROAlert').fadeIn('slow').html(response)
            setTimeout(function(){
              $('#addPROAlert').html(response).fadeOut('slow');
            }, 10000);
          }
        }
      });
    }
  });


  fetchPROStae();
  function fetchPROStae(){
  var action = 'fetchDataPRO';
  $.ajax({
      url: 'virus/add-process.php',
      method: 'post',
      data: {action:action},
      success:function(response){
      $('#proTable').html(response);
      $('#showP').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
         "lengthMenu": [[2,10, 25, 50, -1], [10, 25, 50, "All"]]
  });

  },
  error:function(){
      alert('something went wrong');
      }
  });
  }


    $('#addDOBtn').click(function(e){
      if ($('#addDOForm')[0].checkValidity()) {
        e.preventDefault();
        $('#addDOBtn').val('Please wait...');
        $.ajax({
          url: 'virus/add-process.php',
          method: 'post',
          data: $('#addDOForm').serialize()+'&action=add_doState',
          success:function(response){
            if ($.trim(response) === 'success') {
              $('#addDOBtn').val('Add');
              $('#addDOForm')[0].reset();
              $('#addDO').modal('hide');
                fetchDOStae();
            }else{
              $('#addDOAlert').fadeIn('slow').html(response)
              setTimeout(function(){
                $('#addDOAlert').html(response).fadeOut('slow');
              }, 10000);
            }
          }
        });
      }
    });


    fetchDOStae();
    function fetchDOStae(){
    var action = 'fetchDataDO';
    $.ajax({
        url: 'virus/add-process.php',
        method: 'post',
        data: {action:action},
        success:function(response){
        $('#doTable').html(response);
        $('#showD').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
           "lengthMenu": [[2,10, 25, 50, -1], [10, 25, 50, "All"]]
    });

    },
    error:function(){
        alert('something went wrong');
        }
    });
    }


    $('#addPCBtn').click(function(e){
      if ($('#addPCForm')[0].checkValidity()) {
        e.preventDefault();
        $('#addPCBtn').val('Please wait...');
        $.ajax({
          url: 'virus/add-process.php',
          method: 'post',
          data: $('#addPCForm').serialize()+'&action=add_pcState',
          success:function(response){
            if ($.trim(response) === 'success') {
              $('#addPCBtn').val('Add');
              $('#addPCForm')[0].reset();
              $('#addPC').modal('hide');
                fetchPCStae();
            }else{
              $('#addPCAlert').fadeIn('slow').html(response)
              setTimeout(function(){
                $('#addPCAlert').html(response).fadeOut('slow');
              }, 10000);
            }
          }
        });
      }
    });


    fetchPCStae();
    function fetchPCStae(){
    var action = 'fetchDataPC';
    $.ajax({
        url: 'virus/add-process.php',
        method: 'post',
        data: {action:action},
        success:function(response){
        $('#pcTable').html(response);
        $('#showPC').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
           "lengthMenu": [[2,10, 25, 50, -1], [10, 25, 50, "All"]]
    });

    },
    error:function(){
        alert('something went wrong');
        }
    });
    }




        $('#addCHABtn').click(function(e){
          if ($('#addCHAForm')[0].checkValidity()) {
            e.preventDefault();
            $('#addCHABtn').val('Please wait...');
            $.ajax({
              url: 'virus/add-process.php',
              method: 'post',
              data: $('#addCHAForm').serialize()+'&action=add_chaState',
              success:function(response){
                if ($.trim(response) === 'success') {
                  $('#addCHABtn').val('Add');
                  $('#addCHAForm')[0].reset();
                  $('#addCHA').modal('hide');
                    fetchCHAStae();
                }else{
                  $('#addCHAAlert').fadeIn('slow').html(response)
                  setTimeout(function(){
                    $('#addCHAAlert').html(response).fadeOut('slow');
                  }, 10000);
                }
              }
            });
          }
        });


        fetchCHAStae();
        function fetchCHAStae(){
        var action = 'fetchDataCHA';
        $.ajax({
            url: 'virus/add-process.php',
            method: 'post',
            data: {action:action},
            success:function(response){
            $('#chapTable').html(response);
            $('#showCHA').DataTable({
              "paging": true,
              "lengthChange": false,
              "searching": false,
              "ordering": true,
              "info": true,
              "autoWidth": false,
              "responsive": true,
               "lengthMenu": [[2,10, 25, 50, -1], [10, 25, 50, "All"]]
        });

        },
        error:function(){
            alert('something went wrong');
            }
        });
        }


        $('#addQBBtn').click(function(e){
          if ($('#addQBForm')[0].checkValidity()) {
            e.preventDefault();
            $('#addQBBtn').val('Please wait...');

            $.ajax({
              url: 'virus/add-process.php',
              method: 'post',
              data: $('#addQBForm').serialize()+'&action=add_qbState',
              success:function(response){
                if ($.trim(response) === 'success') {
                  $('#addQBBtn').val('Add');
                  $('#addQBForm')[0].reset();
                  $('#addQB').modal('hide');
                    fetchQBStae();
                }else{
                  $('#addQBAlert').fadeIn('slow').html(response)
                  setTimeout(function(){
                    $('#addQBAlert').html(response).fadeOut('slow');
                  }, 10000);
                }
              }
            });
          }
        });


        fetchQBStae();
        function fetchQBStae(){
        var action = 'fetchDataQB';
        $.ajax({
            url: 'virus/add-process.php',
            method: 'post',
            data: {action:action},
            success:function(response){
            $('#qbTable').html(response);
            $('#showQB').DataTable({
              "paging": true,
              "lengthChange": false,
              "searching": false,
              "ordering": true,
              "info": true,
              "autoWidth": false,
              "responsive": true,
               "lengthMenu": [[2,10, 25, 50, -1], [10, 25, 50, "All"]]
        });

        },
        error:function(){
            alert('something went wrong');
            }
        });
        }



        $('#addBMBtn').click(function(e){
          if ($('#addBMForm')[0].checkValidity()) {
            e.preventDefault();
            $('#addBMBtn').val('Please wait...');

            $.ajax({
              url: 'virus/add-process.php',
              method: 'post',
              data: $('#addBMForm').serialize()+'&action=add_bmState',
              success:function(response){
                if ($.trim(response) === 'success') {
                  $('#addBMBtn').val('Add');
                  $('#addBMForm')[0].reset();
                  $('#addBM').modal('hide');
                    fetchBMStae();
                }else{
                  $('#addBMAlert').fadeIn('slow').html(response)
                  setTimeout(function(){
                    $('#addBMAlert').html(response).fadeOut('slow');
                  }, 10000);
                }
              }
            });
          }
        });


        fetchBMStae();
        function fetchBMStae(){
        var action = 'fetchDataBM';
        $.ajax({
            url: 'virus/add-process.php',
            method: 'post',
            data: {action:action},
            success:function(response){
            $('#bmTable').html(response);
            $('#showBM').DataTable({
              "paging": true,
              "lengthChange": false,
              "searching": false,
              "ordering": true,
              "info": true,
              "autoWidth": false,
              "responsive": true,
               "lengthMenu": [[2,10, 25, 50, -1], [10, 25, 50, "All"]]
        });

        },
        error:function(){
            alert('something went wrong');
            }
        });
        }


        $('#addPMBtn').click(function(e){
          if ($('#addPMForm')[0].checkValidity()) {
            e.preventDefault();
            $('#addPMBtn').val('Please wait...');

            $.ajax({
              url: 'virus/add-process.php',
              method: 'post',
              data: $('#addPMForm').serialize()+'&action=add_pmState',
              success:function(response){
                if ($.trim(response) === 'success') {
                  $('#addPMBtn').val('Add');
                  $('#addPMForm')[0].reset();
                  $('#addPM').modal('hide');
                    fetchPMStae();
                }else{
                  $('#addPMAlert').fadeIn('slow').html(response)
                  setTimeout(function(){
                    $('#addPMAlert').html(response).fadeOut('slow');
                  }, 10000);
                }
              }
            });
          }
        });


        fetchPMStae();
        function fetchPMStae(){
        var action = 'fetchDataPM';
        $.ajax({
            url: 'virus/add-process.php',
            method: 'post',
            data: {action:action},
            success:function(response){
            $('#pmTable').html(response);
            $('#showPM').DataTable({
              "paging": true,
              "lengthChange": false,
              "searching": false,
              "ordering": true,
              "info": true,
              "autoWidth": false,
              "responsive": true,
               "lengthMenu": [[2,10, 25, 50, -1], [10, 25, 50, "All"]]
        });

        },
        error:function(){
            alert('something went wrong');
            }
        });
        }




                $('#addPPBtn').click(function(e){
                  if ($('#addPPForm')[0].checkValidity()) {
                    e.preventDefault();
                    $('#addPPBtn').val('Please wait...');

                    $.ajax({
                      url: 'virus/add-process.php',
                      method: 'post',
                      data: $('#addPPForm').serialize()+'&action=add_ppState',
                      success:function(response){
                        if ($.trim(response) === 'success') {
                          $('#addPPBtn').val('Add');
                          $('#addPPForm')[0].reset();
                          $('#addPP').modal('hide');
                            fetchPPStae();
                        }else{
                          $('#addPPAlert').fadeIn('slow').html(response)
                          setTimeout(function(){
                            $('#addPPAlert').html(response).fadeOut('slow');
                          }, 10000);
                        }
                      }
                    });
                  }
                });


                fetchPPStae();
                function fetchPPStae(){
                var action = 'fetchDataPP';
                $.ajax({
                    url: 'virus/add-process.php',
                    method: 'post',
                    data: {action:action},
                    success:function(response){
                    $('#ppTable').html(response);
                    $('#showPP').DataTable({
                      "paging": true,
                      "lengthChange": false,
                      "searching": false,
                      "ordering": true,
                      "info": true,
                      "autoWidth": false,
                      "responsive": true,
                       "lengthMenu": [[2,10, 25, 50, -1], [10, 25, 50, "All"]]
                });

                },
                error:function(){
                    alert('something went wrong');
                    }
                });
                }




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
              url: 'virus/add-process.php',
              method: 'POST',
              data: {del_id: del_id},
              success:function(response){
                Swal.fire(
                  'Note Trashed!',
                  'Note Sent to Trash Can! <a href="trash">Trash Can</a>',
                  'success'
                )
                fetchNotes();
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
      url: 'virus/add-process.php',
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

  // delete note
  $("body").on("click", ".deleteBtn", function(e){
      e.preventDefault();
      delp_id = $(this).attr('id');
      Swal.fire({
          title: 'Are you sure?',
          text: "You'r about to Delete Note permenatly!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.value) {
            $.ajax({
              url: 'scripts/process.php',
              method: 'POST',
              data: {delp_id: delp_id},
              success:function(response){
                Swal.fire(
                  'Deleted!',
                  'Note Deleted!</a>',
                  'success'
                )
                displayAllNotes();
              }
            });

          }
        });

  });


});
