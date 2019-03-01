<?php 
include "../controller/fetchEmpAcc.php";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ReFeel - Donor List</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="../public/img/blood.ico">
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
        <h3>Donor List</h3>
      </div>
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 col-lg-12 p-0">
              <div class="content-container">
                <h4>Unchecked Survey</h4>
                <div id="donorSurveyList" class="text-center">
                  <!-- content goes here -->
                </div>
              </div>
            </div>
            <div class="col-md-12 col-lg-12 p-0 mt-2">
              <div class="content-container">
                <h4>Expected Donors</h4>
                <div id="expectedDonor" class="text-center">
                  <!-- content goes here -->
                </div>
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
  <script src="../public/js/notification.js"></script>
  <script>
    // 'use strict';
    $('#home').addClass('active');
    $('#donor-list').addClass('active');
    $('.loader').hide();

    checkExpiringBloodBags();

    function checkExpiringBloodBags() {
      $.ajax({
        type: "POST",
        url: "../controller/blood/checkExpiringBloodBags.php",
        complete: function(){
          setTimeout(checkExpiringBloodBags, 60000);
        }
      });
    }

    // $(document).ajaxStart(function() {
    //   $('.loader').show();
    // });

    // $(document).ajaxComplete(function() {
    //   $('.loader').hide();
    // });

    // show donor list
    let uncheckedSurveyRes = ``;
    $.ajax({
      url: "../controller/survey/fetchUncheckedSurvey.php",
      dataType: "json",
      success: data => {
        console.log(data);
        if (data.length == 0) {
          uncheckedSurveyRes = `
          <i class="fas fa-scroll fa-7x"></i>
          <h4>No unchecked surveys found</h4>
          `;
          $('#donorSurveyList').html(uncheckedSurveyRes);
        } else if (data.length !== 0) {
          uncheckedSurveyRes = `
          <table class='table table-bordered text-center' id='tbldonorsurvey'>
            <thead>
              <tr >
              <th>Exam Code</th>
              <th>Donor Code</th>
              <th>Donor/Applicant Name</th>
              <th>Action</th>
              </tr>
            </thead>
            <tbody>
              ${ iterateOverUncheckedSurvey(data) }
            </tbody>
          </table>
          `;
          $('#donorSurveyList').html(uncheckedSurveyRes);
        }
      }
    });

    function iterateOverUncheckedSurvey(arr) {
      return arr.map( obj => {
        return `
        <tr>
          <td>${ obj.intDonationId }</td>
          <td>${ obj.intClientId }</td>
          <td>${ obj.Applicant_DonorName }</td>
          <td><a href="fetchDonorSurveyAnswers.php?rowid=${ obj.intDonationId }"><button type='button' class='btn btn-sm' data-id='${ obj.intDonationId }'>Check</button></a></td>
        </tr>
        `;
      });
    }

    //show expected donor
    let expectedDonor = ``;
    $.ajax({
      url: '../controller/donor/fetchExpectedDonor.php',
      dataType: 'json',
      success: data => {
        console.log(data);
        if (data.length == 0) {
          expectedDonor = `
          <i class="fas fa-user-slash fa-7x"></i>
          <h4>No expected donor found</h4>
          `;
          $('#expectedDonor').html(expectedDonor);
        } else if (data.length !== 0) {
          expectedDonor = `
          <table class='table table-bordered text-center' id='tbldonorsurvey'>
            <thead>
              <tr>
              <th>Exam Code</th>
              <th>Donor Code</th>
              <th>Donor/Applicant Name</th>
              <th>Date</th>
              </tr>
            </thead>
            <tbody>
              ${ iterateOverExpectedDonor(data) }
            </tbody>
          </table>
          `;
          $('#expectedDonor').html(expectedDonor);
        }
      }
    });

    function iterateOverExpectedDonor(arr) {
      console.log(arr);
      return arr.map( obj => {
        return `
        <tr>
          <td>${ obj.intDonationId }</td>
          <td>${ obj.intClientId }</td>
          <td>${ obj.Applicant_DonorName }</td>
          <td>${ obj.dtmExamTaken }</td>
        </tr>
        `;
      });
    }
  </script>
</body>
</html>