<?php 
include "../controller/fetchEmpAcc.php";
$fetch_countofbloodbagtypea = mysqli_query($connections, " SELECT COUNT(tbb.intBloodBagId) AS 'bloodbagcount' FROM tblbloodtype tbt
JOIN tblbloodbag tbb ON tbt.intBloodTypeId = tbb.intBloodTypeId
JOIN tblpreservatives tp ON tbb.intPreservativeId = tp.intPreservativeId
WHERE tbt.intBloodTypeId IN (SELECT intBloodTypeId FROM tblbloodtype WHERE stfBloodType = 'A') AND stfIsBloodBagExpired = 'No' AND stfIsBloodBagDiscarded = 'No' AND tbt.stfBloodType = 'A'  AND TIMESTAMPDIFF(DAY, dtmDateStored, NOW()) <= tp.intPreservativeLifespan ");
$row_countbloodbagtypea = mysqli_fetch_assoc($fetch_countofbloodbagtypea);
$countbloodbagtypea = $row_countbloodbagtypea["bloodbagcount"];
// type ab count
$fetch_countofbloodbagtypeab = mysqli_query($connections, " SELECT COUNT(tbb.intBloodBagId) AS 'bloodbagcount' FROM tblbloodtype tbt
JOIN tblbloodbag tbb ON tbt.intBloodTypeId = tbb.intBloodTypeId
JOIN tblpreservatives tp ON tbb.intPreservativeId = tp.intPreservativeId
WHERE tbt.intBloodTypeId IN (SELECT intBloodTypeId FROM tblbloodtype WHERE stfBloodType = 'AB') AND stfIsBloodBagExpired = 'No' AND stfIsBloodBagDiscarded = 'No' AND tbt.stfBloodType = 'AB' AND TIMESTAMPDIFF(DAY, dtmDateStored, NOW()) <= tp.intPreservativeLifespan ");
$row_countbloodbagtypeab = mysqli_fetch_assoc($fetch_countofbloodbagtypeab);
$countbloodbagtypeab = $row_countbloodbagtypeab["bloodbagcount"];
// type b count
$fetch_countofbloodbagtypeb = mysqli_query($connections, " SELECT COUNT(tbb.intBloodBagId) AS 'bloodbagcount' FROM tblbloodtype tbt
JOIN tblbloodbag tbb ON tbt.intBloodTypeId = tbb.intBloodTypeId
JOIN tblpreservatives tp ON tbb.intPreservativeId = tp.intPreservativeId
WHERE tbt.intBloodTypeId IN (SELECT intBloodTypeId FROM tblbloodtype WHERE stfBloodType = 'B') AND stfIsBloodBagExpired = 'No' AND stfIsBloodBagDiscarded = 'No' AND tbt.stfBloodType = 'B' AND TIMESTAMPDIFF(DAY, dtmDateStored, NOW()) <= tp.intPreservativeLifespan ");
$row_countbloodbagtypeb = mysqli_fetch_assoc($fetch_countofbloodbagtypeb);
$countbloodbagtypeb = $row_countbloodbagtypeb["bloodbagcount"];
// type o count
$fetch_countofbloodbagtypeo = mysqli_query($connections, " SELECT COUNT(tbb.intBloodBagId) AS 'bloodbagcount' FROM tblbloodtype tbt
JOIN tblbloodbag tbb ON tbt.intBloodTypeId = tbb.intBloodTypeId
JOIN tblpreservatives tp ON tbb.intPreservativeId = tp.intPreservativeId
WHERE tbt.intBloodTypeId IN (SELECT intBloodTypeId FROM tblbloodtype WHERE stfBloodType = 'O') AND stfIsBloodBagExpired = 'No' AND stfIsBloodBagDiscarded = 'No' AND tbt.stfBloodType = 'O'  AND TIMESTAMPDIFF(DAY, dtmDateStored, NOW()) <= tp.intPreservativeLifespan");
$row_countbloodbagtypeo = mysqli_fetch_assoc($fetch_countofbloodbagtypeo);
$countbloodbagtypeo = $row_countbloodbagtypeo["bloodbagcount"];
//wastage report
$fetch_totalbloodbags = mysqli_query($connections, " SELECT COUNT(*) AS 'total_remainingbloodbags' FROM tblbloodbag tbb JOIN tblpreservatives tp ON tbb.intPreservativeId = tp.intPreservativeId WHERE stfIsBloodBagExpired = 'No' AND stfIsBloodBagDiscarded = 'No' AND TIMESTAMPDIFF(DAY, dtmDateStored, NOW()) <= tp.intPreservativeLifespan ");
$row_totalbloodbags = mysqli_fetch_assoc($fetch_totalbloodbags);
$total_bloodbags = $row_totalbloodbags["total_remainingbloodbags"];
$fetch_wastedbloodbags = mysqli_query($connections, " SELECT COUNT(*) AS 'Wasted Blood Bags'
FROM tblbloodbag tbb
JOIN tblpreservatives tp ON tbb.intPreservativeId = tp.intPreservativeId
WHERE stfIsBloodBagExpired = 'Yes'
AND stfTransfusionSuccess = 'No' ");
$row_wastedbloodbags = mysqli_fetch_assoc($fetch_wastedbloodbags);
$wasted_bloodbags = $row_wastedbloodbags["Wasted Blood Bags"];
//donor count per blood type
// type a
$fetch_donorcounttypea = mysqli_query($connections, " SELECT bt.stfBloodType, COUNT(c.intClientId) AS 'Donor Count'
FROM tblbloodtype bt
JOIN tblclient c ON bt.intBloodTypeId = c.intBloodTypeId
WHERE c.stfClientType = 'Donor'
AND stfBloodType = 'A'
AND c.intClientId IN (
	SELECT d.intClientId
    FROM tbldonation d
) ");
$row_countdonortypea = mysqli_fetch_assoc($fetch_donorcounttypea);
$countdonortypea = $row_countdonortypea["Donor Count"];
// type ab
$fetch_donorcounttypeab = mysqli_query($connections, " SELECT bt.stfBloodType, COUNT(c.intClientId) AS 'Donor Count'
FROM tblbloodtype bt
JOIN tblclient c ON bt.intBloodTypeId = c.intBloodTypeId
WHERE c.stfClientType = 'Donor'
AND stfBloodType = 'AB'
AND c.intClientId IN (
	SELECT d.intClientId
    FROM tbldonation d
) ");
$row_countdonortypeab = mysqli_fetch_assoc($fetch_donorcounttypeab);
$countdonortypeab = $row_countdonortypeab["Donor Count"];
// type a
$fetch_donorcounttypeb = mysqli_query($connections, " SELECT bt.stfBloodType, COUNT(c.intClientId) AS 'Donor Count'
FROM tblbloodtype bt
JOIN tblclient c ON bt.intBloodTypeId = c.intBloodTypeId
WHERE c.stfClientType = 'Donor'
AND stfBloodType = 'B'
AND c.intClientId IN (
	SELECT d.intClientId
    FROM tbldonation d
) ");
$row_countdonortypeb = mysqli_fetch_assoc($fetch_donorcounttypeb);
$countdonortypeb = $row_countdonortypeb["Donor Count"];
// type a
$fetch_donorcounttypeo = mysqli_query($connections, " SELECT bt.stfBloodType, COUNT(c.intClientId) AS 'Donor Count'
FROM tblbloodtype bt
JOIN tblclient c ON bt.intBloodTypeId = c.intBloodTypeId
WHERE c.stfClientType = 'Donor'
AND stfBloodType = 'O'
AND c.intClientId IN (
	SELECT d.intClientId
    FROM tbldonation d
) ");
$row_countdonortypeo = mysqli_fetch_assoc($fetch_donorcounttypeo);
$countdonortypeo = $row_countdonortypeo["Donor Count"];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ReFeel - Graphs</title>
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
        <h3>Graphs</h3>
      </div>
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 col-lg-12 p-0">
              <div class="content-container">
                <div class="d-flex flex-row justify-content-center">
                  <div class="text-center align-self-center" style="width: 500pt;">
                    <h4>Count of remaining blood bags</h4>
                    <canvas id="bloodbagcountperbloodtype"></canvas>
                  </div>
                </div>
                <div class="d-flex flex-row justify-content-center">
                  <div class="text-center mt-2 align-self-center" style="width: 500pt;">
                    <h4>Wastage</h4>
                    <canvas id="wastage"></canvas>
                  </div>
                </div>
                <div class="d-flex flex-row justify-content-center">
                  <div class="text-center mt-2 align-self-center" style="width: 500pt">
                    <h4>Donor Count per blood type</h4>
                    <canvas id="donorcountperbloodtype"></canvas>
                  </div>
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
  <script src="../public/js/Chart.bundle.js"></script>
  <script>
    $('#home').addClass('active');
    $('#graphs').addClass('active');
    $('.loader').hide();

    // check_expiringbloodbags();

    var checkExpiringBloodBags = function() {
      $.ajax({
        type: "POST",
        url: "../controller/blood/checkExpiringBloodBags.php",
        complete: function(){
          setTimeout(checkExpiringBloodBags, 60000);
        }
      });
    }()

    // function check_expiringbloodbags(){
    //   $.ajax({
    //     type: "POST",
    //     url: "blood-related/check_expiringbloodbags.php",
    //     complete: function(){
    //       setTimeout(check_expiringbloodbags, 60000);
    //     }
    //   });
    // }


    var chart_bloodbagcountperbloodtype = document.getElementById("bloodbagcountperbloodtype").getContext('2d');
    var ch_bloodbagcountperbloodtype = new Chart(chart_bloodbagcountperbloodtype, {
      type: 'bar',
      data: {
        labels: ["A", "AB", "B", "O"],
        datasets: [{
          label: '# of Remaining Blood Bags',
          data: ["<?php echo $countbloodbagtypea ?>", "<?php echo $countbloodbagtypeab ?>", "<?php echo $countbloodbagtypeb ?>", "<?php echo $countbloodbagtypeo ?>"],
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)'
          ],
          borderColor: [
            'rgba(255,99,132,1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero:true
            }
          }]
        }
      }
    });

    var chart_wastage = document.getElementById("wastage").getContext('2d');
    var ch_wastage = new Chart(chart_wastage, {
      type: 'pie',
      data: {
        labels: ["Remaining blood bags", "Wasted"],
        datasets: [{
          label: 'Wastage',
          data: [ <?php echo json_encode($total_bloodbags) ?>, <?php echo json_encode($wasted_bloodbags) ?> ],
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)'
          ],
          borderColor: [
            'rgba(255,99,132,1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)'
          ],
          borderWidth: 1
        }]
      }
    });

    var chart_donorcountperbloodtype = document.getElementById("donorcountperbloodtype").getContext('2d');
    var ch_wastage = new Chart(chart_donorcountperbloodtype, {
      type: 'bar',
      data: {
        labels: ["A", "AB", "B", "O"],
        datasets: [{
          label: '# of Donors',
          data: [ "<?php echo $countdonortypea ?>", "<?php echo $countdonortypeab ?>","<?php echo $countdonortypeb ?>","<?php echo $countdonortypeo ?>", ],
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)'
          ],
          borderColor: [
            'rgba(255,99,132,1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero:true
            }
          }]
        }
      }
    });
  </script>
</body>
</html>