<?php 
include "../controller/fetchEmpAcc.php";
$id = $_GET["id"];
$stat = $_GET["stat"];
$clientId = $_GET["clientId"];
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
    <main class="mainpanel" style="width: 100%;">
      <?php 
      include "components/special-header.php";
      ?>
      <div class="page-title">
        <h3>Donation Info</h3>
        <button type="button" onclick="location.href='donor-records.php'" class="btn"><i class="fas fa-long-arrow-alt-left"></i> Back</button>
      </div>
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 col-lg-12 p-0">
              <div class="content-container">
                <div class="form-group">
                  <h4 for="donorweight">Completion :</h4>
                  <input type="text" class="form-control col-md-6 text-center" value = "The record is <?php echo $stat?>" readonly>
                </div>
              </div>
            </div>
            <!-- medical exam -->
            <div class="col-md-12 col-lg-12 p-0 mt-2">
              <div class="content-container">
                <?php
                  $qryFetchSheetVer = mysqli_query($connections, "SELECT DISTINCT(q.decQuestionVersion)
                    FROM tblquestion q JOIN tblmedicalexam me ON q.intQuestionId = me.intQuestionId WHERE me.intDonationId = ( SELECT me1.intDonationId
                      FROM tbldonation d
                      JOIN tblmedicalexam me1 ON d.intDonationId = me1.intDonationId
                      WHERE d.intDonationId = $id
                      LIMIT 1 ) ");
                  while ($version = mysqli_fetch_assoc($qryFetchSheetVer) ) {
                    $version_used = $version["decQuestionVersion"];
                  }
                  $medicalexamQry = mysqli_query($connections,"SELECT * FROM tblmedicalexam WHERE intDonationId = '$id'");
                  if(mysqli_num_rows($medicalexamQry) > 0){
                ?>
                <h4>Donor Medical Exam<br><small>version <?php echo $version_used ?></small></h4>
                <table class='table table-bordered mt-1 mb-0 text-center' id='tbldonorsurvey'>
                  <thead>
                    <tr>
                      <th>Question</th>
                      <th>Answer: Yes or No</th>
                      <th>Answer: Date</th>
                      <th>Answer: Quantity</th>
                      <th>Answer: String</th>
                      <th>Remarks</th>
                    </tr>
                  </thead>
                  <?php
                    while($medical = mysqli_fetch_assoc($medicalexamQry)){
                      $questionId = $medical["intQuestionId"];
                      $answerYN = $medical["stfAnswerYn"];
                      $answerDate = $medical["datAnswerDate"];
                      $answerQuan = $medical["intAnswerQuantity"];
                      $answerstr = $medical["strAnswerString"];
                      $remarks = $medical["stfAnswerRemarks"];

                      $questionQry = mysqli_query($connections,"SELECT txtquestion FROM tblquestion WHERE intQuestionId = '$questionId'");
                      while ($question = mysqli_fetch_assoc($questionQry)) {
                        $txtquestion = $question["txtquestion"];
                      }
                  ?>
                  <tr>
                    <td><?php echo $txtquestion; ?></td>
                    <td><?php echo $answerYN; ?></td>
                    <td><?php echo $answerDate; ?></td>
                    <td><?php echo $answerQuan; ?></td>
                    <td><?php echo $answerstr; ?></td>
                    <td><?php echo $remarks; ?></td>
                  </tr>
                  <?php
                    }
                  ?>
                  </table>
                  <br/>
                  <br/>
                  <br/>
                  <?php
                    }else{
                  ?>
                  <p>No Medical Exam record</p>
                  <?php
                    }
                  ?>
              </div>
            </div>
            <!-- end medical exam -->
            <!-- physical exam -->
            <div class="col-md-12 col-lg-12 p-0 mt-2">
              <div class="content-container">
                <h4>Donor Physical Exam</h4>
                <?php
                  $physicalexamQry = mysqli_query($connections,"SELECT * FROM tblphysicalexam WHERE intDonationId = '$id'");
                  if(mysqli_num_rows($physicalexamQry) > 0){
                  while($physical = mysqli_fetch_assoc($physicalexamQry)){
                    $weight = $physical["decClientWeight"];
                    $bp = $physical["strClientBloodPressure"];
                    $pulserate = $physical["strClientPulseRate"];
                    $temp = $physical["decClientTemperature"];
                    $genapp = $physical["txtClientGenAppearance"];
                    $heent = $physical["txtClientHEENT"];
                    $heartnlungs = $physical["txtClientHeartLungs"];
                    $m_remarks = $physical["stfMedicalStatRemarks"];
                    $bloodvolume = $physical["intBloodVolumeId"];
                    $deferralID = $physical["intDeferralId"];
                    if($m_remarks == "Accepted"){
                ?>
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="donorweight">Weight</label>
                    <input type="text" class="form-control" value = "<?php echo $weight?>" readonly>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="donorbloodpressure">Blood Pressure</label>
                    <input type="text" class="form-control" value = "<?php echo $bp?>" readonly>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="donorpulserate">Pulse Rate</label>
                    <input type="text" class="form-control" value = "<?php echo $pulserate?>" readonly>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="donortemperature">Temperature</label>
                    <input type="text" class="form-control" value = "<?php echo $temp?>" readonly>
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="form-group">
                    <label for="donorgenapp">General Appearance</label>
                    <input type="text" class="form-control" value = "<?php echo $genapp?>" readonly>
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="form-group">
                    <label for="donorheent">Head, Ears, Eyes, Nose & Throat (HEENT)</label>
                    <input type="text" class="form-control" value = "<?php echo $heent?>"  readonly>
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="form-group">
                    <label for="donorheartlungs">Heart and Lungs</label>
                    <input type="text" class="form-control" value = "<?php echo $heartnlungs?>" readonly>
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="form-group">
                    <label for="donorheartlungs">Remarks</label>
                    <input type="text" class="form-control" value = "<?php echo $m_remarks?>" readonly>
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="form-group">
                    <label for="donorheartlungs">Blood Volume</label>
                    <input type="text" class="form-control" value = "<?php echo $bloodvolume?>" readonly>
                  </div>
                </div>
                <?php
                  }else if($m_remarks == "Temporarily Deferred" || $m_remarks == "Permanently Deferred"){
                    $deferralqry = mysqli_query($connections,"SELECT * FROM tbldeferral WHERE intDeferralId = '$deferralID'");
                    if(mysqli_num_rows($deferralqry) >0){
                      while($deferrals = mysqli_fetch_assoc($deferralqry)){
                        $reason = $deferrals["txtDeferralReason"];
                        $instruction =$deferrals["txtDeferralInstructions"];
                      }
                    }else{

                    }
                ?>
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="donorweight">Weight</label>
                    <input type="text" class="form-control" value = "<?php echo $weight?>" readonly>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="donorbloodpressure">Blood Pressure</label>
                    <input type="text" class="form-control" value = "<?php echo $bp?>" readonly>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="donorpulserate">Pulse Rate</label>
                    <input type="text" class="form-control" value = "<?php echo $pulserate?>" readonly>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="donortemperature">Temperature</label>
                    <input type="text" class="form-control" value = "<?php echo $temp?>" readonly>
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="form-group">
                    <label for="donorgenapp">General Appearance</label>
                    <input type="text" class="form-control" value = "<?php echo $genapp?>" readonly>
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="form-group">
                    <label for="donorheent">Head, Ears, Eyes, Nose & Throat (HEENT)</label>
                    <input type="text" class="form-control" value = "<?php echo $heent?>"  readonly>
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="form-group">
                    <label for="donorheartlungs">Heart and Lungs</label>
                    <input type="text" class="form-control" value = "<?php echo $heartnlungs?>" readonly>
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="form-group">
                    <label for="donorheartlungs">Remarks</label>
                    <input type="text" class="form-control" value = "<?php echo $m_remarks?>" readonly>
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="form-group">
                    <label for="donorheartlungs">Blood Volume</label>
                    <input type="text" class="form-control" value = "<?php echo $bloodvolume?>" readonly>
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="form-group">
                    <label for="donorheartlungs">Deferral reason</label>
                    <input type="text" class="form-control" value = "<?php echo $reason?>" readonly>
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="form-group">
                    <label for="donorheartlungs">Deferral Instruction</label>
                    <input type="text" class="form-control" value = "<?php echo $instruction?>" readonly>
                  </div>
                </div>
                <?php
                  }
                  ?>

                <?php
                  }
                }else{
                  ?>
                  <div class="text-center">
                    <i class="fas fa-user-slash fa-5x"></i>
                    <h5>No physical exam</h5>
                  </div>
                  <?php
                }
                ?>
              </div>
            </div>
            <!-- end physical exam -->
            <!-- initial screening -->
            <div class="col-md-12 col-lg-12 p-0 mt-2">
              <div class="content-container">
                <h4>Donor Initial Screening</h4>
                <?php
                  $initialQry = mysqli_query($connections,"SELECT * FROM tblinitialscreening WHERE intDonationId = '$id'");
                  if(mysqli_num_rows($initialQry) > 0){
                ?>
                <table class='table table-bordered mt-1 mb-0 text-center' >
                  <thead>
                    <tr>
                      <th>Blood Component</th>
                      <th>Result</th>
                      <th>Remarks</th>
                      <th>Screener</th>
                      <th>Verifier</th>

                    </tr>
                  </thead>
                <?php
                  while($initial = mysqli_fetch_assoc($initialQry)){
                    $componentid = $initial["intBloodComponentId"];
                    $result = $initial["strBloodComponentResult"];
                    $remarks = $initial["strBloodComponentRemarks"];
                    $screener = $initial["strBloodComponentScreener"];
                    $verifier = $initial["strIBloodComponentVerifier"];


                    $componentnQry = mysqli_query($connections,"SELECT strBloodComponent FROM tblbloodcomponent WHERE intBloodComponentId = '$componentid'");
                    while ($component = mysqli_fetch_assoc($componentnQry)) {
                      $bloodcomponent = $component["strBloodComponent"];
                    }
                ?>
                <tr>
                  <td><?php echo $bloodcomponent; ?></td>
                  <td><?php echo $result; ?></td>
                  <td><?php echo $remarks; ?></td>
                  <td><?php echo $screener; ?></td>
                  <td><?php echo $verifier; ?></td>
                </tr>
                <?php
                  }
                ?>
                </table>
                <br/>
                <br/>
                <br/>
                <?php
                  }else{
                    ?>
                    <div class="text-center">
                      <i class="fas fa-user-slash fa-5x"></i>
                      <h5>No Initial Screening record</h5>
                    </div>
                    <?php
                  }
                ?>
              </div>
            </div>
            <!-- end initial screening -->
            <!-- serological screening -->
            <div class="col-md-12 col-lg-12 p-0 mt-2">
              <div class="content-container">
                <h4>Donor Serological Screening</h4>
                <?php
                  $serologicalQry = mysqli_query($connections,"SELECT * FROM tblserologicalscreening WHERE intDonationId = '$id'");
                  if(mysqli_num_rows($serologicalQry) > 0){
                ?>
                <table class='table table-bordered mt-5 text-center' >
                  <thead>
                    <tr>
                      <th>Disease</th>
                      <th>Remarks</th>
                      <th>Screener</th>
                      <th>Verifier</th>
                      <th>Pass/Fail</th>

                    </tr>
                  </thead>
                <?php
                  while($serological = mysqli_fetch_assoc($serologicalQry)){
                    $diseaseid = $serological["intDiseaseId"];
                    $dremarks = $serological["decDiseaseRemarks"];
                    $dscreener = $serological["strDiseaseScreener"];
                    $dverifier = $serological["strDiseaseVerifier"];
                    $dpass = $serological["stfDonorSerologicalScreeningRemarks"];
                    $dbloodbag = $serological["intBloodBagId"];

                    $bloodbagQry = mysqli_query($connections,"SELECT strBloodBagSerialNo,dtmDateStored FROM tblbloodbag WHERE intBloodBagId = '$dbloodbag'");
                    if(mysqli_num_rows($bloodbagQry) > 0){
                      while($bags = mysqli_fetch_assoc($bloodbagQry)){
                        $bloodbagserial = $bags["strBloodBagSerialNo"];
                        $datestored = $bags["dtmDateStored"];
                      }
                    }else {
                      $bloodbagserial = 'N/A';
                      $datestored = 'N/A';
                    }


                    $diseaseQry = mysqli_query($connections,"SELECT strDisease FROM tbldisease WHERE intDiseaseId = '$diseaseid'");
                    while ($disease = mysqli_fetch_assoc($diseaseQry)) {
                      $diseaseName = $disease["strDisease"];
                    }
                  ?>
                  <tr>
                    <td><?php echo $diseaseName; ?></td>
                    <td><?php echo $dremarks; ?></td>
                    <td><?php echo $dscreener; ?></td>
                    <td><?php echo $dverifier; ?></td>
                    <td><?php echo $dpass; ?></td>
                  </tr>
                  <?php
                    }
                  ?>
                  </table>
                  <!-- <div class="col-md-5"> -->
                    <div class="row">
                      <div class="col-md-12 col-lg-12">
                        <label for="bloodbag">Blood bag :</label>
                      </div>
                      <div class="container-fluid text-center">
                        <input type="text" class="form-control col-md-5" value = "Donor Blood Bag: <?php echo $bloodbagserial?>" readonly>
                        <input type="text" class="form-control col-md-5" value = "Date Stored: <?php echo $datestored?>" readonly>
                      </div>
                    </div>
                  <!-- </div> -->
                  <br/>
                  <br/>
                  <br/>
                  <?php
                    }else{
                      ?>
                      <div class="text-center">
                        <i class="fas fa-user-slash fa-5x"></i>
                        <h5>No Serological Screening record</h5>
                      </div>
                      <?php
                    }
                  ?>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
  </div>
  <?php 
  include "components/core-script.php";
  ?>
  <script>
    $('.loader').hide();
  </script>
</body>
</html>