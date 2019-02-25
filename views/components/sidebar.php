<div class="sidebar">
  <div class="logo">
    <img src="../public/img/refeel-logo-refined-white.png" style="max-width: 100%; width: 40%;  ">
  </div>
  <div class="navigation-wrapper">
    <div class="usr ">
      <div class="usrimg">
        <img src="../public/img/<?php echo $varImg ?>" style="max-width: 100%; height: 3rem; width: 3rem; border-radius: 5rem;">
      </div>
      <div class="usrinfo">
        <p style="font-weight: 600; color: #212121;"><?php echo $varFname . ' ' . $varLname; ?><br><span style="font-weight: 300;"><?php echo $varRole; ?></span></p>
      </div>
    </div>
    <div class="pl-1 pr-1">
      <hr style="margin: 0">
    </div>
    <ul class="nav custom-nav">
      <li class="custom-nav-item nav-item">
        <a href="" id="home" class="nav-link" data-toggle="collapse" data-target="#home-tabs" aria-controls="home-tabs" aria-expanded="false">
          <i class="fas fa-home"></i>
          <span>Home</span>
        </a>
        <div class="collapse show" id="home-tabs">
          <ul class="nav d-block pl-4">
            <li class="nav-item">
              <a href="graphs.php" id="graphs" class="nav-link"><i class="fas fa-chart-line mr-1"></i>Graphs</a>
            </li>
            <li class="nav-item">
              <a href="donor-list.php" id="donor-list" class="nav-link"><i class="fas fa-list mr-1"></i>Donor List</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="custom-nav-item nav-item">
        <a href="" id="maintenance" class="nav-link" data-toggle="collapse" data-target="#maintenance-tabs" aria-controls="maintenance-tabs" aria-expanded="false">
          <i class="fas fa-cogs"></i>
          <span>Maintenance</span>
        </a>
        <div class="collapse show" id="maintenance-tabs">
          <ul class="nav d-block pl-4">
            <li class="nav-item">
              <a href="donor.php" id="donor" class="nav-link"><i class="fas fa-user-cog mr-1"></i>Donor</a>
            </li>
            <li class="nav-item">
              <a href="blood-type.php" id="blood-type" class="nav-link"><i class="fas fa-heartbeat mr-1"></i>Blood Type</a>
            </li>
            <li class="nav-item">
              <a href="blood-component.php" id="blood-component" class="nav-link"><img src="../public/glyphicon/si-glyph-blood-bag.svg" style="width:20px;">Blood Component</a>
            </li>
            <li class="nav-item">
              <a href="preservative.php" id="preservative" class="nav-link"><i class="fas fa-pills mr-1"></i>Preservative</a>
            </li>
            <li class="nav-item">
              <a href="disease.php" id="disease" class="nav-link"><img src="../public/glyphicon/si-glyph-heart-delete.svg" style="width:17px; margin-right: .25rem !important;">Disease</a>
            </li>
            <li class="nav-item">
              <a href="donor-edit-requests.php" id="donor-edit-requests" class="nav-link"><img src="../public/glyphicon/si-glyph-document-checked.svg" style="width: 17px; margin-right: .25rem !important;">Donor Edit Requests</a>
            </li>
            <li class="nav-item">
              <a href="survey.php" id="survey" class="nav-link"><i class="fas fa-file-alt mr-1"></i>Survey</a>
            </li>
            <li class="nav-item">
              <a href="survey-category.php" id="survey-category" class="nav-link"><i class="far fa-file-alt mr-1"></i>Survey Category</a>
            </li>
            <li class="nav-item">
              <a href="storage.php" id="storage" class="nav-link"><i class="fas fa-box-open mr-1"></i>Storage</a>
            </li>
            <li class="nav-item">
              <a href="staff.php" id="staff" class="nav-link"><i class="fas fa-user-md mr-1"></i>Staff</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="custom-nav-item nav-item">
        <a href="" id="transaction" class="nav-link" data-toggle="collapse" data-target="#transaction-tabs" aria-controls="transaction-tabs" aria-expanded="false">
          <i class="fas fa-stethoscope"></i>
          <span>Transaction</span>
        </a>
        <div class="collapse show" id="transaction-tabs">
          <ul class="nav d-block pl-4">
            <li class="nav-item">
              <a href="donor-records.php" id="donor-records" class="nav-link"><i class="fas fa-file-medical-alt mr-1"></i>Donor Records</a>
            </li>
            <li class="nav-item">
              <a href="blood-inventory.php" id="blood-inventory" class="nav-link"><i class="fas fa-first-aid mr-1"></i>Blood Inventory</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="custom-nav-item nav-item">
        <a href="reports.php" id="reports" class="nav-link">
          <i class="fas fa-file-medical"></i>
          <span>Reports</span>
        </a>
      </li>
    </ul>
  </div>
</div>