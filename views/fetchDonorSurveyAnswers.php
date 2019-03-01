<?php 
include "../controller/fetchEmpAcc.php";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ReFeel - Donor Survey Answers</title>
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
        <h3>Donor Survey Answers</h3>
      </div>
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 col-lg-12 p-0">
              <div class="content-container" style="padding-bottom: 3rem;">
                <?php
                if($_GET['rowid']){
                $surveycode = $_GET['rowid'];

                $unchecked_surveys = mysqli_query($connections, "SELECT
                  intMedicalExamId,m.intQuestionId,intDonationId,stfAnswerYn,datAnswerDate,intAnswerQuantity,strAnswerString,q.txtQuestion
                  FROM tblmedicalexam m JOIN tblquestion q ON m.intQuestionId = q.intQuestionId
                  WHERE stfAnswerRemarks = 'Unchecked'
                  AND dtmExamTaken BETWEEN DATE_SUB(NOW(), INTERVAL 4 DAY) AND NOW()
                  AND intDonationId = '$surveycode'");
                  $getdonorid = mysqli_query($connections,"SELECT intClientId FROM tbldonation WHERE intDonationId = '$surveycode'");
                  while ($row2 = mysqli_fetch_assoc($getdonorid)) {
                    $client = $row2["intClientId"];
                  }

                  if(mysqli_num_rows($unchecked_surveys) > 0){
                    ?>
                    <form name = 'submit_update' method = 'POST' action = 'save_update_survey.php'>
                      <table class='table table-bordered mt-5 text-center' id='tbldonorsurvey'>
                        <thead>
                          <tr>
                            <!-- <th>Donation Id</th> -->
                            <th>Question</th>
                            <th>Answer: Yes or No</th>
                            <th>Answer: Date</th>
                            <th>Answer: Quantity</th>
                            <th>Answer: String</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <?php
                        while ($row = mysqli_fetch_assoc($unchecked_surveys)) {
                          $id = $row["intQuestionId"];
                          //$client = $row["intClientId"];
                          $examcode = $row["intDonationId"];
                          $question = $row["txtQuestion"];
                          $yn = $row["stfAnswerYn"];
                          $date = $row["datAnswerDate"];
                          $quantity = $row["intAnswerQuantity"];
                          $string = $row["strAnswerString"];
                          ?>
                          <tbody>
                            <tr>
                              <!-- <td><?php echo $examcode; ?></td> -->
                              <td><?php echo $question; ?></td>
                              <td><?php echo $yn; ?></td>
                              <td><?php echo $date; ?></td>
                              <td><?php echo $quantity; ?></td>
                              <td><?php echo $string; ?></td>
                              <td>
                                <input type = 'radio' name = 'updatestatus<?php echo $id;?>' id = 'updatestatus<?php echo $id; ?>' value = 'Correct' required = 'required' >Correct</br>
                                <input type = 'radio' name = 'updatestatus<?php echo $id;?>' id = 'updatestatus<?php echo $id; ?>' value = 'Wrong' >Wrong
                              </td>
                            </tr>
                          </tbody>
                          <?php
                        }
                        ?>
                      </table>
                      <input type="hidden" name="hiddenclientid" value="<?php echo $client;?>" required>
                      <input type="hidden" name="hiddenexamcode" value="<?php echo $examcode;?>" required>
                      <Button type='submit' class='btn btn-outline-danger float-right' id='updatesurvey_save'>Submit</button>
                    </form>
                    <?php
                  }
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
  <script src="../public/js/notification.js"></script>
  <script>
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

  $(function(){
    $("form[name ='submit_update']").on('submit',function(e){
      e.preventDefault();
      var formdata = $("form[name ='submit_update']").serialize();
      var confirmbutton = confirm("Are you sure?");
      console.log(formdata);
      if(confirmbutton == true)
      {
        $.ajax({
          url:"../controller/survey/saveUpdateSurvey.php",
          method:"POST",
          data:{formdata,formdata},
          success: function(data){
            alert("Survey has been checked");
            window.location.href = "donor-list.php";
            console.log(data);
          }
        });
      }
      else {
        alert("Confirmation Cancelled");
        return false;
      }
    });
  });
  </script>
</body>
</html>