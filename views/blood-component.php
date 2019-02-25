<?php 
include "../controller/fetchEmpAcc.php";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ReFeel</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
        <h3>Blood Component</h3>
      </div>
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 col-lg-12 p-0">
              <div class="content-container" style="padding-bottom: 4rem;">
                <h4>Active Blood Component</h4>
                <table id='tblActiveBloodComponent' class="table table-striped table-bordered text-center">
                  <thead>
                    <tr>
                      <th>Blood Component Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                </table>
                <button type='button' class='btn btn-outline-danger float-right mt-3' data-toggle='modal' data-target='#addBloodComponentModal'><i class="fas fa-plus"></i> Add Blood Component</button>
              </div>
            </div>
            <div class="col-md-12 col-lg-12 p-0 mt-2">
              <div class="content-container">
                <h4>Inactive Blood Component</h4>
                <table id='tblInactiveBloodComponent' class="table table-striped table-bordered text-center">
                  <thead>
                    <tr>
                      <th>Blood Component Name</th>
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
  <!--Add Blood Component Modal-->
  <div class="modal fade" id="addBloodComponentModal" tabindex="-1" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addnewbloodcomponentTitle">Add Blood Component</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action ="addnewbloodcomponent.php" name="form_addnewbloodcomponent">
          <div class="modal-body">
            <div class="form-group">
              <label for="newBloodComponentName">Blood Component Name</label>
              <input type="text" class="form-control" id='newBloodComponentName' name ='newBloodComponentName' required>
            </div>
            <div class="form-group">
              <label for="newBloodComponentDeferral">Blood Component Deferral</label>
              <input type="number" class="form-control" id='newBloodComponentDeferral' name ='newBloodComponentDeferral' required>
            </div>
            <div class="form-group">
              <label for="newBloodComponentML">Least Accepted Value (Male)</label>
              <input type="number" step = 'any' class="form-control" id='newBloodComponentML' name ='newBloodComponentML' required>
            </div>
            <div class="form-group">
              <label for="newBloodComponentMM">Max Accepted Value (Male)</label>
              <input type="number" step = 'any' class="form-control" id='newBloodComponentMM' name ='newBloodComponentMM' required>
            </div>
            <div class="form-group">
              <label for="newBloodComponentFL">Least Accepted Value (Female)</label>
              <input type="number" step = 'any' class="form-control" id='newBloodComponentFL' name ='newBloodComponentFL' required>
            </div>
            <div class="form-group">
              <label for="newBloodComponentFL">Max Accepted Value (Female)</label>
              <input type="number" step = 'any' class="form-control" id='newBloodComponentFM' name ='newBloodComponentFM' required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="btnsavenewbloodcomponent">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--Edit Blood Component Modal-->
  <div class="modal fade" id="editBloodComponentModal" tabindex="-1" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editnewbloodcomponentTitle">Edit Blood Coponent</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action ="editbloodcomponent.php" name="form_editbloodcomponent">
          <div class="modal-body">
            <div class="form-group">
              <label for="editBloodComponentName">Blood Component Name</label>
              <input type="hidden" name = "bloodcomp_ID" id = "bloodcomp_ID">
              <input type="text" class="form-control" id='editBloodComponentName' name ='editBloodComponentName' required>
            </div>
            <div class="form-group">
              <label for="editBloodComponentDeferral">Blood Component Deferral Day</label>
              <input type="number" class="form-control" id='editBloodComponentDeferral' name ='editBloodComponentDeferral' required>
            </div>
            <div class="form-group">
              <label for="editBloodComponentML">Least Accepted Value (Male)</label>
              <input type="number" step = 'any'class="form-control" id='editBloodComponentML' name ='editBloodComponentML' required>
            </div>
            <div class="form-group">
              <label for="editBloodComponentMM">Max Accepted Value (Male)</label>
              <input type="number" step = 'any' class="form-control" id='editBloodComponentMM' name ='editBloodComponentMM' required>
            </div>
            <div class="form-group">
              <label for="editBloodComponentFL">Least Accepted Value (Female)</label>
              <input type="number" step = 'any' class="form-control" id='editBloodComponentFL' name ='editBloodComponentFL' required>
            </div>
            <div class="form-group">
              <label for="editBloodComponentFM">Max Accepted Value (Female)</label>
              <input type="number" step = 'any' class="form-control" id='editBloodComponentFM' name ='editBloodComponentFM' required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="btnsaveeditbloodcomponent">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--view details-->
<div class="modal fade" id="viewBloodComponentModal" tabindex="-1" role="dialog" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="viewnewbloodcomponentTitle">Blood Component</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="POST" action ="deletecomponent.php" name="form_viewbloodcomponent">
				<div class="modal-body">
					<div class="form-group">
						<label for="editBloodComponentName">Blood Component Name</label>
						<input type="hidden" name = "viewbloodcomp_ID" id = "viewbloodcomp_ID">
						<input type="text" class="form-control" id='viewBloodComponentName' name ='viewBloodComponentName' readonly>
					</div>
          <div class="form-group">
            <label for="viewBloodComponentDeferral">Blood Component Deferral Day</label>
            <input type="number"  class="form-control" id='viewBloodComponentDeferral' name ='viewBloodComponentDeferral' readonly>
          </div>
          <div class="form-group">
            <label for="editBloodComponentML">Least Accepted Value (Male)</label>
            <input type="number" step = 'any' class="form-control" id='viewBloodComponentML' name ='editBloodComponentML' readonly>
          </div>
          <div class="form-group">
            <label for="editBloodComponentMM">Max Accepted Value (Male)</label>
            <input type="number" step = 'any' class="form-control" id='viewBloodComponentMM' name ='editBloodComponentMM' readonly>
          </div>
          <div class="form-group">
            <label for="editBloodComponentFL">Least Accepted Value (Female)</label>
            <input type="number" step = 'any' class="form-control" id='viewBloodComponentFL' name ='editBloodComponentFL' readonly>
          </div>
          <div class="form-group">
            <label for="editBloodComponentFM">Max Accepted Value (Female)</label>
            <input type="number" step = 'any' class="form-control" id='viewBloodComponentFM' name ='editBloodComponentFM' readonly>
          </div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" id="btnsavedeletebloodcomponent">Disable</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- enable blood component -->
<div class="modal fade" id="viewBloodComponentModal_enable" tabindex="-1" role="dialog" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="viewnewbloodcomponentTitle">Blood Component</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="POST" action ="enablecomponent.php" name="form_viewbloodcomponent_enable">
				<div class="modal-body">
					<div class="form-group">
						<label for="editBloodComponentName">Blood Component Name</label>
						<input type="hidden" name = "viewbloodcomp_ID_enable" id = "viewbloodcomp_ID_enable">
						<input type="text" class="form-control" id='viewBloodComponentName_enable' name ='viewBloodComponentName_enable' readonly>
					</div>
          <div class="form-group">
            <label for="viewBloodComponentDeferral">Blood Component Deferral Day</label>
            <input type="number" class="form-control" id='viewBloodComponentDeferral_enable' name ='viewBloodComponentDeferral' readonly>
          </div>
          <div class="form-group">
            <label for="editBloodComponentML">Least Accepted Value (Male)</label>
            <input type="number" class="form-control" id='viewBloodComponentML_enable' name ='editBloodComponentML' readonly>
          </div>
          <div class="form-group">
            <label for="editBloodComponentMM">Max Accepted Value (Male)</label>
            <input type="number" class="form-control" id='viewBloodComponentMM_enable' name ='editBloodComponentMM' readonly>
          </div>
          <div class="form-group">
            <label for="editBloodComponentFL">Least Accepted Value (Female)</label>
            <input type="number" class="form-control" id='viewBloodComponentFL_enable' name ='editBloodComponentFL' readonly>
          </div>
          <div class="form-group">
            <label for="editBloodComponentFM">Max Accepted Value (Female)</label>
            <input type="number" class="form-control" id='viewBloodComponentFM_enable' name ='editBloodComponentFM' readonly>
          </div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" id="btnsaveenablebloodcomponent">Enable</button>
				</div>
			</form>
		</div>
	</div>
</div>
  <?php 
  include "components/core-script.php";
  ?>
  <script src="../public/js/datatables.min.js"></script>
  <script src="../public/js/sweetalert.min.js"></script>
  <script>
    $('#maintenance').addClass('active');
    $('#blood-component').addClass('active');
    $('.loader').hide();

    //show active blood component
    let activeBloodComponent = 'activeBloodComponent';
    $('#tblActiveBloodComponent').DataTable({
      'processing': true,
      'serverSide': true,
      'ajax': {
        url: '../controller/blood/datatables.php',
        type: 'POST',
        data: { type: activeBloodComponent }
      },
      'language': {
        'emptyTable': 'No active blood component to show'
      }
    });

    //show inactive blood component
    let inactiveBloodComponent = 'inactiveBloodComponent';
    $('#tblInactiveBloodComponent').DataTable({
      'processing': true,
      'serverSide': true,
      'ajax': {
        url: '../controller/blood/datatables.php',
        type: 'POST',
        data: { type: inactiveBloodComponent }
      },
      'language': {
        'emptyTable': 'No inactive blood component to show'
      }
    });

    $(document).ajaxStart(function() {
      $('.loader').show();
    });

    $(document).ajaxComplete(function() {
      $('.loader').hide();
    });

    $(document).on("submit","form[name='form_addnewbloodcomponent']", function(e){
    e.preventDefault();
    // var confirm_input = confirm("Are you sure?");
    var formdata = $("form[name='form_addnewbloodcomponent']").serialize();

    swal({
      title: "Are you sure?",
      text: "You are about to add a blood component",
      icon: "info",
      buttons: true,
    })
    .then((willApprove) => {
      if (willApprove){
        $.ajax({
          type: "POST",
          url: '../controller/blood/addNewBloodComponent.php',
          data: {formdata,formdata},
          success:function(data){
            console.log(data);
            if(data == 1){
              // alert("Blood Component Added");
              swal({
                title: "",
                text: "Blood Component Added",
                icon: "success",
                buttons: {text:"Close"},
              })
              .then((willApprove) => {
                if (willApprove) {
                  $('#addBloodComponentModal').modal('hide');
                  $("#addBloodComponentModal .modal-body input").val("");
                  window.location.href = "blood-component.php";
                }
              });
              // $('#addBloodComponentModal').modal('hide');
              // $("#addBloodComponentModal .modal-body input").val("");
              // window.location.href = "bloodcomponent-tab.php";
              //$('#divdonoraddsero').show(600);
            }
            else if(data == 2){
              // swal("","The Blood Component You Entered Already Exists","info");
              swal({
                title: "",
                text: "The blood component you're trying to add already exists, Please check the disabled blood components too.",
                icon: "warning",
                buttons:{text:"Okay"},
              })
              .then((willApprove) => {
                if(willApprove) {
                  window.location.href = "blood-component.php";
                }
              });
            }
            else if (data == 3) {
              // swal("","Blood Component is not saved","info");
              swal({
                title:"",
                text:"Blood Component is not saved!",
                icon:"error",
                buttons:{text:"OKAY"},
              })
              .then((willApprove) => {
                if (willApprove) {
                  window.location.href = "blood-component.php";
                }
              });
            }
            else if (data == 4) {
              swal({
                title: "",
                text: "Blood Component is not added Least values must be lesser than max values!",
                icon: "error",
                buttons:{text:"Okay"},
              })
              .then((willApprove) => {
                if (willApprove) {
                  //window.location.href = "bloodcomponent-tab.php";
                }
              });
              // alert("Blood Component is not Edited");

            }
          }
        });
      }
      else {
        swal("","Cancelled","info");
      }
    });
  });

  $(document).on("show.bs.modal", "#editBloodComponentModal", function(e){
    var rowid = $(e.relatedTarget).data('id');
    // alert(rowid);
    $.ajax({
      type: "POST",
      url: '../controller/blood/fetchBloodComponentDetails.php',
      data: 'rowid=' + rowid,
      dataType: "json",
      success: function(data){
        $('#bloodcomp_ID').val(data.intBloodComponentId);
        $('#editBloodComponentName').val(data.strBloodComponent);
        $('#editBloodComponentDeferral').val(data.intDeferralDay);
        $('#editBloodComponentML').val(data.decMaleLeastVal);
        $('#editBloodComponentMM').val(data.decMaleMaxVal);
        $('#editBloodComponentFL').val(data.decFemaleLeastVal);
        $('#editBloodComponentFM').val(data.decFemaleMaxVal);

      }
    });
  });

  $(document).on("show.bs.modal", "#viewBloodComponentModal", function(e){
    var rowid = $(e.relatedTarget).data('id');
    // alert(rowid);
    $.ajax({
      type: "POST",
      url: '../controller/blood/fetchBloodComponentDetails.php',
      data: 'rowid=' + rowid,
      dataType: "json",
      success: function(data){
        $('#viewbloodcomp_ID').val(data.intBloodComponentId);
        $('#viewBloodComponentName').val(data.strBloodComponent);
        $('#viewBloodComponentDeferral').val(data.intDeferralDay);
        $('#viewBloodComponentML').val(data.decMaleLeastVal);
        $('#viewBloodComponentMM').val(data.decMaleMaxVal);
        $('#viewBloodComponentFL').val(data.decFemaleLeastVal);
        $('#viewBloodComponentFM').val(data.decFemaleMaxVal);
      }
    });
  });

  $(document).on("show.bs.modal", "#viewBloodComponentModal_enable", function(e){
    var rowid = $(e.relatedTarget).data('id');
    // alert(rowid);
    $.ajax({
      type: "POST",
      url: '../controller/blood/fetchBloodComponentDetails.php',
      data: 'rowid=' + rowid,
      dataType: "json",
      success: function(data){
        $('#viewbloodcomp_ID_enable').val(data.intBloodComponentId);
        $('#viewBloodComponentName_enable').val(data.strBloodComponent);
        $('#viewBloodComponentDeferral_enable').val(data.intDeferralDay);
        $('#viewBloodComponentML_enable').val(data.decMaleLeastVal);
        $('#viewBloodComponentMM_enable').val(data.decMaleMaxVal);
        $('#viewBloodComponentFL_enable').val(data.decFemaleLeastVal);
        $('#viewBloodComponentFM_enable').val(data.decFemaleMaxVal);
      }
    });
  });

  $(document).on("submit", "form[name='form_editbloodcomponent']", function(e){
    e.preventDefault();
    // var confirm_input = confirm("Are you sure?");

    var formdata = $("form[name='form_editbloodcomponent']").serialize();
    swal({
      title: "Are you sure?",
      text: "You are about to edit this blood component",
      icon: "warning",
      buttons: true,
    })
    .then((willApprove) => {
      if (willApprove) {
        $.ajax({
          type: "POST",
          url: '../controller/blood/editBloodComponent.php',
          data: {formdata,formdata},
          success:function(data){
            if(data == 1){
              swal({
                title: "",
                text: "Blood Component Successfully edited",
                icon: "success",
                buttons:{text:"Okay"},
              })
              .then((willApprove) => {
                $('#editBloodComponentModal').modal('hide');
                $("#editBloodComponentModal .modal-body input").val("");
                window.location.href = "blood-component.php";
              });
              // alert("Blood Component Succesfully Edited");
              //$('#divdonoraddsero').show(600);
            }
            else if(data == 2){
              swal({
                title: "",
                text: "The Blood Component you entered already exists!",
                icon: "error",
                buttons:{text:"Okay"},
              })
              .then((willApprove) => {
                if (willApprove) {
                  window.location.href = "blood-component.php";
                }
              });
              // alert("The Blood Component You Entered Already Exists");
            }
            else if (data == 3) {
              swal({
                title: "",
                text: "Blood Component is not edited",
                icon: "error",
                buttons:{text:"Okay"},
              })
              .then((willApprove) => {
                if (willApprove) {
                  window.location.href = "blood-component.php";
                }
              });
              // alert("Blood Component is not Edited");

            }
            else if (data == 4) {
              swal({
                title: "",
                text: "Blood Component is not edited Least values must be lesser than max values!",
                icon: "error",
                buttons:{text:"Okay"},
              })
              .then((willApprove) => {
                if (willApprove) {
                  //window.location.href = "bloodcomponent-tab.php";
                }
              });
              // alert("Blood Component is not Edited");

            }
          }
        });
      }
      else {
        swal("","Cancelled","info");
      }
    });
  });

  $(document).on("click", "#btnsavedeletebloodcomponent", function(e){
    e.preventDefault();
    var id = $("#viewbloodcomp_ID").val();
    // var confirm_enable = confirm("Are you sure?");
    swal({
      title: "Are you sure",
      text: "You are about to disable this blood component",
      icon: "info",
      buttons: true,
    })
    .then((willApprove) =>{
      if (willApprove) {
        $.ajax({
          type: "POST",
          url: '../controller/blood/disableBloodComponent.php',
          data: {id:id},
          success:function(data){
            // alert("Blood Component has been enabled");
            if(data == "deleted"){
            swal({
              title: "",
              text: "Blood Component is now disabled!",
              icons: "success",
              buttons:{text:"Okay"},
            })
            .then((willApprove) => {
              if (willApprove) {
                window.location.href = "blood-component.php";
              }
            });
          }else{
            swal({
              title: "",
              text: "The blood component is not disabled because "+data+" record/s uses this.",
              icons: "error",
              buttons:{text:"Okay"},
            })
            .then((willApprove) => {
              if (willApprove) {
                window.location.href = "blood-component.php";
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

  $(document).on("click", "#btnsaveenablebloodcomponent", function(e){
    e.preventDefault();
    var id = $("#viewbloodcomp_ID_enable").val();
    // var confirm_enable = confirm("Are you sure?");
    swal({
      title: "Are you sure",
      text: "You are about to enable this blood component",
      icon: "info",
      buttons: true,
    })
    .then((willApprove) =>{
      if (willApprove) {
        $.ajax({
          type: "POST",
          url: '../controller/blood/enableBloodComponent.php',
          data: {id:id},
          success:function(data){
            // alert("Blood Component has been enabled");
            swal({
              title: "",
              text: "Blood Component is now enabled!",
              icons: "success",
              buttons:{text:"Okay"},
            })
            .then((willApprove) => {
              if (willApprove) {
                window.location.href = "blood-component.php";
              }
            });
          }
        });
      }
      else {
        swal("","Cancelled","info");
      }
    });
  });
//new------------------------------------------------------------------------------------
  $("#newBloodComponentML").on('change',function(){
    var ml = parseFloat($('#newBloodComponentML').val());
    var mm = parseFloat($('#newBloodComponentMM').val());
    var fl = parseFloat($('#newBloodComponentFL').val());
    var fm = parseFloat($('#newBloodComponentFM').val());

    if(ml > mm){
      alert("Least value must be less than max value.");
    }
  });

  $("#newBloodComponentMM").on('change',function(){
    var ml = parseFloat($('#newBloodComponentML').val());
    var mm = parseFloat($('#newBloodComponentMM').val());
    var fl = parseFloat($('#newBloodComponentFL').val());
    var fm = parseFloat($('#newBloodComponentFM').val());

    if(ml > mm){
      alert("Least value must be less than max value.");
    }
  });

  $("#newBloodComponentFL").on('change',function(){
    var ml = parseFloat($('#newBloodComponentML').val());
    var mm = parseFloat($('#newBloodComponentMM').val());
    var fl = parseFloat($('#newBloodComponentFL').val());
    var fm = parseFloat($('#newBloodComponentFM').val());

    if(fl > fm){
      alert("Least value must be less than max value.");
    }
  });

  $("#newBloodComponentFM").on('change',function(){
    var ml = parseFloat($('#newBloodComponentML').val());
    var mm = parseFloat($('#newBloodComponentMM').val());
    var fl = parseFloat($('#newBloodComponentFL').val());
    var fm = parseFloat($('#newBloodComponentFM').val());

    if(fl > fm){
      alert("Least value must be less than max value.");
    }
  });
  //new------------------------------------------------------------------------------------
  //edit------------------------------------------------------------------------------------
  $("#editBloodComponentML").on('change',function(){
    var ml = parseFloat($('#editBloodComponentML').val());
    var mm = parseFloat($('#editBloodComponentMM').val());
    var fl = parseFloat($('#editBloodComponentFL').val());
    var fm = parseFloat($('#editBloodComponentFM').val());

    if(ml > mm){
      alert("Least value must be less than max value.");
    }
  });

  $("#editBloodComponentMM").on('change',function(){
    var ml = parseFloat($('#editBloodComponentML').val());
    var mm = parseFloat($('#editBloodComponentMM').val());
    var fl = parseFloat($('#editBloodComponentFL').val());
    var fm = parseFloat($('#editBloodComponentFM').val());

    if(ml > mm){
      alert("Least value must be less than max value.");
    }
  });

  $("#editBloodComponentFL").on('change',function(){
    var ml = parseFloat($('#editBloodComponentML').val());
    var mm = parseFloat($('#editBloodComponentMM').val());
    var fl = parseFloat($('#editBloodComponentFL').val());
    var fm = parseFloat($('#editBloodComponentFM').val());

    if(fl > fm){
      alert("Least value must be less than max value.");
    }
  });

  $("#editBloodComponentFM").on('change',function(){
    var ml = parseFloat($('#editBloodComponentML').val());
    var mm = parseFloat($('#editBloodComponentMM').val());
    var fl = parseFloat($('#editBloodComponentFL').val());
    var fm = parseFlaot($('#editBloodComponentFM').val());

    if(fl > fm){
      alert("Least value must be less than max value.");
    }
  });
  </script>
</body>
</html>