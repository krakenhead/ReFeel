<?php 
include "../controller/fetchEmpAcc.php";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ReFeel - Survey</title>
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
        <h3>Survey</h3>
      </div>
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 col-lg-12 p-0">
              <div class="content-container" style="padding-bottom: 4rem">
                <h4>Available Surveys</h4>
                <?php
                  $fetchsurveys = mysqli_query($connections,"SELECT DISTINCT(decQuestionVersion)
                  FROM tblquestion WHERE boolVersionInUse = '1' UNION SELECT DISTINCT(decQuestionVersion) FROM tblquestion WHERE boolVersionInUse = '0'");
                ?>
                <table class='table table-bordered mt-2 text-center' id='tblsurvey' style = "tr:first-child {background-color: rgb(234,72,127);}">
                <thead>
                  <tr>
                    <th>Survey Version</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <?php
                  while ($row = mysqli_fetch_assoc($fetchsurveys)) {
                    $version = $row["decQuestionVersion"];
                    //$inuse = $row["boolVersionInUse"];

                    /*if($inuse == '1'){
                      $inusetext = "Yes";
                    }
                    elseif ($inuse == '0') {
                      $inusetext = "No";
                    }*/

                ?>
                <tbody>
                  <tr>
                    <td><?php echo $version; ?></td>
                    <td><a href ="fetchSurvey.php?selected=<?php echo $version; ?>"><button type='button' class='btn'  name = 'check_survey'>View</button></a></td>
                  </tr>
                </tbody>
                <?php 
                  }
                ?>
                </table>
                <a href ="addNewSurvey.php"><button type = 'button' class='btn btn-outline-danger float-right mt-1' id = "make_survey" style="margin-top: -10px">Make a new Survey</button></a>
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
    $('#maintenance').addClass('active');
    $('#survey').addClass('active');
    $('.loader').hide();
  </script>
</body>
</html>