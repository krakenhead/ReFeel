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
        <h3>Storage</h3>
      </div>
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 col-lg-12 p-0">
              <div class="content-container" style="padding-bottom: 4rem">
                <table id="tblActiveStorage" class="table table-striped table-bordered text-center">
                  <thead>
                    <tr>
                      <th>Storage Name</th>
                      <th>Storage Type</th>
                      <th>Capacity</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                </table>
                <button type="button" class="btn btn-outline-danger float-right mt-2" data-toggle="modal" data-target="#addBloodStorageModal"><i class="fas fa-plus"></i> Add Storage</button>
              </div>
            </div>
            <div class="col-md-12 col-lg-12 p-0 mt-2">
              <div class="content-container">
                <table id="tbl_inactivestorage" class="table table-striped table-bordered text-center" style="width: 100%">
                  <thead>
                    <tr>
                      <th>Storage Name</th>
                      <th>Storage Type</th>
                      <th>Capacity</th>
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
  <!-- modals -->
  <!--Add Storage Modal-->
  <div class="modal fade" id="addBloodStorageModal" tabindex="-1" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addnewbloodstorageTitle">Add Blood Storage</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action ="addnewbloodstorage.php" name="form_addnewbloodstorage">
          <div class="modal-body">
            <div class="form-group">
              <label for="newBloodStorageName">Storage Name</label>
              <input type="text" class="form-control" id='newBloodStorageName' name ='newBloodStorageName' required>
            </div>
            <div class="form-group">
              <label>Storage Type</label>
              <select class="form-control" name="sel_storagetype">
                <option selected disabled>Select storage type</option>
              <?php
              $fetch_storagetype = mysqli_query($connections, " SELECT * FROM tblstoragetype ");

              if(mysqli_num_rows($fetch_storagetype) > 0){
                while ($row = mysqli_fetch_assoc($fetch_storagetype)) {
                  $storagetype = $row["strStorageType"];
                  ?>
                <?php
                echo "<option value='".$storagetype."'>$storagetype</option>";
                 ?>
              <?php
            }
          }
               ?>
             </select>

            </div>
            <div class="form-group">
              <label for="newBloodStorageCapacity">Storage Capacity</label>
              <input type="number" class="form-control" id='newBloodStorageCapacity' name ='newBloodStorageCapacity' required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="btnsavenewbloodstorage">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!--Edit Storage Modal-->
  <div class="modal fade" id="editBloodStorageModal" tabindex="-1" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editnewbloodstorageTitle">Edit Blood Storage</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action ="blood-related/editstorage.php" name="form_editbloodstorage">
          <div class="modal-body">
            <div class="form-group">
              <label for="editBloodStorageName">Blood Storage Name</label>
              <input type="hidden" name = "bloodstorage_ID" id = "bloodstorage_ID">
              <input type="text" class="form-control" id='editBloodStorageName' name ='editBloodStorageName' required>
            </div>
            <div class="form-group">
              <label for="editBloodStorageCapacity">Blood Storage Capacity</label>
              <input type="number" class="form-control" id='editBloodStorageCapacity' name ='editBloodStorageCapacity' required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="btnsaveeditstorage">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--View Details-->
  <div class="modal fade" id="viewBloodStorageModal" tabindex="-1" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editnewbloodstorageTitle">Blood Storage</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action ="deletestorage.php" name="form_viewbloodstorage">
          <div class="modal-body">
            <div class="form-group">
              <label for="editBloodStorageName">Blood Storage Name</label>
              <input type="hidden" name = "viewbloodstorage_ID" id = "viewbloodstorage_ID">
              <input type="text" class="form-control" id='viewBloodStorageName' name ='viewBloodStorageName' readonly>
            </div>
            <div class="form-group">
              <label for="editBloodStorageCapacity">Blood Storage Capacity</label>
              <input type="number" class="form-control" id='viewBloodStorageCapacity' name ='viewBloodStorageCapacity'readonly>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="btnsavedeletestorage" >Disable</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- end -->
  <div class="modal fade" id="viewBloodStorageModal_enable" tabindex="-1" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="viewBloodStorageModal_enable">Blood Storage</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action ="enablestorage.php" name="form_viewbloodstorage_enable">
          <div class="modal-body">
            <div class="form-group">
              <label for="editBloodStorageName">Blood Storage Name</label>
              <input type="hidden" name = "viewbloodstorage_ID_enable" id = "viewbloodstorage_ID_enable">
              <input type="text" class="form-control" id='viewBloodStorageName_enable' name ='viewBloodStorageName_enable' readonly>
            </div>
            <div class="form-group">
              <label for="editBloodStorageCapacity">Blood Storage Capacity</label>
              <input type="number" class="form-control" id='viewBloodStorageCapacity_enable' name ='viewBloodStorageCapacity_enable'readonly>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" name="delete" class="btn btn-danger" id="btn_deletestorage">Delete</button>
            <button type="submit" class="btn btn-primary" id="btnsaveenablestorage" >Enable</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php 
  include "components/core-script.php";
  ?>
  <script>
    $('#maintenance').addClass('active');
    $('#storage').addClass('active');
    $('.loader').hide();
  </script>
</body>
</html>