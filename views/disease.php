<?php 
include "../controller/fetchEmpAcc.php";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ReFeel - Disease</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="../public/img/blood.ico">
  <link rel="stylesheet" href="../public/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="../public/css/main.css">
  <link rel="stylesheet" href="../public/css/all.css">
  <link rel="stylesheet" href="../public/css/datatables.min.css">
</head>
<body>
  <?php 
  include "components/loader.php";
  ?>
  <div class="wrapper">
    <?php 
    include "components/sidebar.php";
    ?>
    <main class="mainpanel">
      <?php 
      include "components/header.php";
      ?>
      <div class="page-title">
        <h3>Disease</h3>
      </div>
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 col-lg-12 p-0">
              <div class="content-container" style="padding-bottom: 4rem;">
                <h4>Active Diseases</h4>
                <table id='tblActiveDisease' class="table table-striped table-bordered text-center">
                  <thead>
                    <tr>
                      <th>Disease Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                </table>
                <button type='button' class='btn btn-outline-danger float-right mt-3' data-toggle='modal' data-target='#addnewdiseaseModal' id='btntbl'><i class="fas fa-plus"></i> Add Disease</button>
              </div>
            </div>
            <div class="col-md-12 col-lg-12 p-0 mt-2">
              <div class="content-container">
                <h4>Inactive Disease</h4>
                <table id='tblInactiveDisease' class="table table-striped table-bordered text-center">
                  <thead>
                    <tr>
                      <th>Disease Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
  </div>
  <!-- modal declaration -->
  <!-- add disease modal -->
  <!--Add Disease Modal-->
  <div class="modal fade" id="addnewdiseaseModal" tabindex="-1" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addnewdiseaseTitle">Add Disease</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="disease-related/addnewdisease.php" name="form_adddisease">
          <div class="modal-body">
            <div class="form-group">
              <label for="newDiseaseName">Disease Name</label>
              <input type="text" class="form-control" id='newDiseaseName' name ='newDiseaseName' required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="btnsavenewdisease">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- edit disease modal -->
  <div class="modal fade" id="editDiseaseModal" tabindex="-1" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editDiseaseTitle">Edit Disease</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action ="editdisease.php" name="form_editdisease">
          <div class="modal-body">
            <div class="form-group">
              <label for="editDiseaseName">Disease Name</label>
              <input type="hidden" name = "disease_ID" id = "disease_ID">
              <input type="text" class="form-control" id='editDiseaseName' name ='editDiseaseName' required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="btnsaveeditdisease">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- view record -->
  <div class="modal fade" id="viewDiseaseModal" tabindex="-1" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="viewDiseaseTitle">Disease</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action ="deletedisease.php" name="form_viewdisease">
          <div class="modal-body">
            <div class="form-group">
              <label for="editDiseaseName">Disease Name</label>
              <input type="hidden" name = "viewdisease_ID" id = "viewdisease_ID">
              <input type="text" class="form-control" id='viewDiseaseName' name ='viewDiseaseName' readonly>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="btnsavedeletedisease">Disable</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- enable disease modal -->
  <div class="modal fade" id="viewDiseaseModal_enable" tabindex="-1" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="viewDiseaseTitle">Disease</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action ="enabledisease.php" name="form_viewdisease_enable">
          <div class="modal-body">
            <div class="form-group">
              <label for="editDiseaseName">Disease Name</label>
              <input type="hidden" name = "viewdisease_ID_enable" id = "viewdisease_ID_enable">
              <input type="text" class="form-control" id='viewDiseaseName_enable' name ='viewDiseaseName_enable' readonly>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="btnsaveenabledisease">Enable</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- end modal declaration -->
  <?php 
  include "components/core-script.php";
  ?>
  <script src="../public/js/datatables.min.js"></script>
  <script src="../public/js/sweetalert.min.js"></script>
  <script src="../public/js/notification.js"></script>
  <script>
    $('#maintenance').addClass('active');
    $('#disease').addClass('active');
    $('.loader').hide();

    //show active disease
    let activeDisease = 'activeDisease';
    $('#tblActiveDisease').DataTable({
      'processing': true,
      'serverSide': true,
      'ajax': {
        url: '../controller/disease/datatables.php',
        type: 'POST',
        data: { type: activeDisease }
      },
      'language': {
        'emptyTable': 'No active disease to show'
      }
    });

    //show inactive disease
    let inactiveDisease = 'inactiveDisease';
    $('#tblInactiveDisease').DataTable({
      'processing': true,
      'serverSide': true,
      'ajax': {
        url: '../controller/disease/datatables.php',
        type: 'POST',
        data: { type: inactiveDisease }
      },
      'language': {
        'emptyTable': 'No inactive disease to show'
      }
    });

    $(document).ajaxStart(function() {
      $('.loader').show();
    });

    $(document).ajaxComplete(function() {
      $('.loader').hide();
    });

    $(document).on("submit", "form[name='form_adddisease']", function(e){
      e.preventDefault();
      // var confirm_input = confirm("Are you sure?");
      var formdata = $("form[name='form_adddisease']").serialize();
      swal({
        title: "Are you sure?",
        text: "You are about to add this disease",
        icon: "info",
        buttons:true,
      })
      .then((willApprove) => {
        if (willApprove) {
          $.ajax({
            type: "POST",
            url: '../controller/disease/addNewDisease.php',
            data: {formdata,formdata},
            success:function(data){
              if(data == 1){
                // alert("Blood Component Added");
                swal({
                  title:"",
                  text: "Disease Added",
                  icon: "success",
                  buttons:{text:"Okay"},
                })
                .then((willApprove) => {
                  if (willApprove) {
                    $('#addnewdiseaseModal').modal('hide');
                    $("#addnewdiseaseModal .modal-body input").val("");
                    window.location.href = "disease.php";
                  }
                });
                //$('#divdonoraddsero').show(600);
              }
              else if(data == 2){
                swal({
                  title: "",
                  text: "The Disease you entered already exists, Please check the disabled diseases too.",
                  icon: "warning",
                  buttons:{text:"Okay"},
                })
                .then((willApprove) => {
                  if (willApprove) {
                    window.location.href = "disease.php";
                  }
                });
              }
              else if (data == 3) {
                swal({
                  title: "",
                  text: "Disease is not saved",
                  icon: "error",
                  buttons:{text:"Okay"},
                })
                .then((willApprove) => {
                  if (willApprove) {
                    window.location.href = "disease.php";
                  }
                });
              }
            }
          });
        }
        else {
          swal("","Cancelled","info");
        }
      });
    });

    $(document).on("show.bs.modal", "#editDiseaseModal", function(e){
      var rowid = $(e.relatedTarget).data('id');
      // alert(rowid);
      $.ajax({
        type: "POST",
        url: '../controller/disease/fetchDiseaseDetails.php',
        data: 'rowid=' + rowid,
        dataType: "json",
        success: function(data){
          $('#disease_ID').val(data.intDiseaseId);
          $('#editDiseaseName').val(data.strDisease);
        }
      });
    });

    $(document).on("show.bs.modal", "#viewDiseaseModal", function(e){
      var rowid = $(e.relatedTarget).data('id');
      // alert(rowid);
      $.ajax({
        type: "POST",
        url: '../controller/disease/fetchDiseaseDetails.php',
        data: 'rowid=' + rowid,
        dataType: "json",
        success: function(data){
          $('#viewdisease_ID').val(data.intDiseaseId);
          $('#viewDiseaseName').val(data.strDisease);
        }
      });
    });

    $(document).on("show.bs.modal", "#viewDiseaseModal_enable", function(e){
      var rowid = $(e.relatedTarget).data('id');
      // alert(rowid);
      $.ajax({
        type: "POST",
        url: '../controller/disease/fetchDiseaseDetails.php',
        data: 'rowid=' + rowid,
        dataType: "json",
        success: function(data){
          $('#viewdisease_ID_enable').val(data.intDiseaseId);
          $('#viewDiseaseName_enable').val(data.strDisease);
        }
      });
    });

    $(document).on("submit", "form[name='form_editdisease']", function(e){
      e.preventDefault();
      // var confirm_input = confirm("Are you sure?");
      var formdata = $("form[name='form_editdisease']").serialize();
      console.log(formdata);
      swal({
        title: "Are you sure?",
        text: "You are about to edit this disease",
        icon: "info",
        buttons: true,
      })
      .then((willApprove) => {
        if (willApprove) {
          $.ajax({
            type: "POST",
            url: '../controller/disease/editDisease.php',
            data: {formdata,formdata},
            success:function(data){
              if(data == 1){
                // alert("Disease Succesfully Edited");
                swal({
                  title: "",
                  text: "Disease is successfully edited",
                  icon: "success",
                  buttons:{text:"Okay"},
                })
                .then((willApprove) => {
                  if (willApprove) {
                    $('#editDiseaseModal').modal('hide');
                    $("#editDiseaseModal .modal-body input").val("");
                    window.location.href = "disease.php";
                  }
                });
                //$('#divdonoraddsero').show(600);
              }
              else if(data == 2){
                swal({
                  title: "",
                  text: "The Disease you entered already exists!",
                  icon: "error",
                  buttons:{text:"Okay"},
                })
                .then((willApprove) => {
                  if (willApprove) {
                    window.location.href = "disease.php";
                  }
                });
                // alert("The Disease You Entered Already Exists");
              }
              else if (data == 3) {
                swal({
                  title: "",
                  text: "Disease is not edited",
                  icon: "error",
                  buttons:{text:"Okay"},
                })
                .then((willApprove) => {
                  if (willApprove) {
                    window.location.href = "disease.php";
                  }
                });
                // alert("Disease is not Edited");
              }
            }
          });
        }
        else {
          swal("","Cancelled","info");
        }
      });
    });

    $(document).on("click", "#btnsavedeletedisease", function(e){
      e.preventDefault();
      var id = $("#viewdisease_ID").val();
      // var confirm_delete = confirm("Are you sure?");
      swal({
        title: "Are you sure?",
        text: "You are about to disable this disease",
        icon: "info",
        buttons:true,
      })
      .then((willApprove) => {
        if (willApprove) {
          $.ajax({
            type: "POST",
            url: '../controller/disease/disableDisease.php',
            data: {id:id},
            success:function(data){
              if(data == "deleted"){
              swal({
                title: "",
                text: "The disease is now disabled",
                icon: "success",
                buttons: {text:"Okay"},
              })
              .then((willApprove) => {
                if (willApprove) {
                  window.location.href = "disease.php";
                }
              });
            }else{
              swal({
                title: "",
                text: "The disease is not disabled because "+data+" record/s uses this.",
                icon: "error",
                buttons: {text:"Okay"},
              })
              .then((willApprove) => {
                if (willApprove) {
                  window.location.href = "disease.php";
                }
              });
            }
            }
          });
        }
        else {
          swal("","Cancelled","info");
        }
      });
    });

    $(document).on("click", "#btnsaveenabledisease", function(e){
      e.preventDefault();
      var id = $("#viewdisease_ID_enable").val();
      // var confirm_enable = confirm("Are you sure?");
      swal({
        title: "Are you sure?",
        text: "You are about to enable this disease",
        icon: "info",
        buttons: true,
      })
      .then((willApprove) => {
        if (willApprove) {
          $.ajax({
            type: "POST",
            url: '../controller/disease/enableDisease.php',
            data: {id:id},
            success:function(data){
              swal({
                title:"",
                text: "Disease is now enabled",
                icon: "success",
                buttons:{text:"Okay"}
              })
              .then((willApprove) => {
                if (willApprove) {
                  window.location.href = "disease.php";
                }
              });
              // alert("Disease has been enabled");
            }
          });
        }
        else {
          swal("","Cancelled","info");
        }
      });
    });
  </script>
</body>
</html>