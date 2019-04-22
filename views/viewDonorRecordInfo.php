<?php
	include "../controller/fetchEmpAcc.php";
	$clientid = $_GET['id'];
	// echo $clientid;
	$viewrecord = mysqli_query($connections, "
		SELECT tc.strClientFirstName, tc.strClientMiddleName, tc.strClientLastName, tc.stfClientSex, tc.strClientContact, tc.datClientBirthday, bt.stfBloodType, bt.stfBloodTypeRhesus, strUserImageDir
		FROM tblclient tc
		JOIN tblbloodtype bt ON tc.intBloodTypeId = bt.intBloodTypeId
		JOIN tbluser u ON u.intUserId = tc.intUserId
		WHERE tc.intClientId = '$clientid'
	");
	
	$row = mysqli_fetch_assoc($viewrecord);
	$clientfirstname = $row["strClientFirstName"];
	$clientmiddlename = $row["strClientMiddleName"];
	$clientlastname = $row["strClientLastName"];
	$clientbirthday = $row["datClientBirthday"];
	$clientsex = $row["stfClientSex"];
	$clientcontact = $row["strClientContact"];
	$bloodtype = $row["stfBloodType"];
	$bloodrhesus = $row["stfBloodTypeRhesus"];
	$image = $row["strUserImageDir"];

	$donationidqry = mysqli_query($connections,"
		SELECT intDonationId
		FROM tbldonation
		WHERE intClientId = '$clientid'
		ORDER BY intDonationId DESC
		LIMIT 1 OFFSET 0
	");

	if(mysqli_num_rows($donationidqry) > 0)	{
		while($donation = mysqli_fetch_assoc($donationidqry))	{
		 $donation_id = $donation["intDonationId"];
		}
	}
	else	{
		$donation_id = null;
	}

	$latestrequestqry = mysqli_query($connections,"
		SELECT intClientReqId, txtchanges
		FROM tblrequest
		WHERE intClientId = '$clientid'
		ORDER BY intClientReqId DESC
		LIMIT 1 OFFSET 0
	");

	if(mysqli_num_rows($latestrequestqry) > 0)	{
		while($request = mysqli_fetch_assoc($latestrequestqry))	{
		 $requestid = $request["intClientReqId"];
		 $changes = $request["txtchanges"];
		}
	}
	else	{
		$changes = "Profile not yet edited.";
	}

	$lastdonation = mysqli_query($connections,"
		SELECT d.intDonationId, m.dtmExamTaken, d.stfDonationRemarks
		FROM tbldonation d
		JOIN tblmedicalexam m ON d.intDonationId = m.intDonationId
		WHERE d.intClientId = '$clientid'
		AND d.intDonationId = '$donation_id'
	");

	if(mysqli_num_rows($lastdonation) > 0)	{
		while($donation2 = mysqli_fetch_assoc($lastdonation)){
			$lastdonationdate = $donation2["dtmExamTaken"];
		}
	}
	else	{
		$lastdonationdate = "None";
	}

	$timesdonatedqry = mysqli_query($connections,"
		SELECT COUNT(intDonationId) AS count
		FROM tbldonation
		WHERE intClientId = '$clientid'
		AND stfDonationRemarks = 'Complete'
		AND stfDonationStatus = 'Able'
	");
	
	if(mysqli_num_rows($timesdonatedqry) > 0)	{
		while($donation3 = mysqli_fetch_assoc($timesdonatedqry)){
			$donationfreq = $donation3["count"];
		}
	}
	else	{
		$lastdonationdate = "None";
	}

	$timesrejectedmedqry = mysqli_query($connections,"
		SELECT COUNT(DISTINCT(d.intDonationId)) AS count
		FROM tblmedicalexam m
		JOIN tbldonation d ON m.intDonationId = d.intDonationId
		WHERE intClientId = '$clientid'
		AND stfAnswerRemarks = 'Wrong'
	");
	if(mysqli_num_rows($timesrejectedmedqry) > 0)	{
		while($donation4 = mysqli_fetch_assoc($timesrejectedmedqry)){
			$donationrejmed = $donation4["count"];
		}
	}
	else	{
		$donationrejmed = "None";
	}

	$timesrejectedphysqry = mysqli_query($connections,"
		SELECT COUNT(DISTINCT(d.intDonationId)) AS count
		FROM tblphysicalexam p
		JOIN tbldonation d ON p.intDonationId = d.intDonationId
		WHERE intClientId = '$clientid'
		AND stfClientPhysicalExamRemarks = 'Failed'
	");
	if(mysqli_num_rows($timesrejectedphysqry) > 0)	{
	 while($donation5 = mysqli_fetch_assoc($timesrejectedphysqry)){
		$donationrejphy = $donation5["count"];
	 }
	}
	else	{
		$donationrejphy = "None";
	}

	$timesrejectedinitqry = mysqli_query($connections,"
		SELECT COUNT(DISTINCT(d.intDonationId)) AS count
		FROM tblinitialscreening i
		JOIN tbldonation d ON i.intDonationId = d.intDonationId
		WHERE intClientId = '$clientid'
		AND stfClientInitialScreeningRemarks = 'Failed'
	");
	if(mysqli_num_rows($timesrejectedinitqry) > 0)	{
		while($donation6 = mysqli_fetch_assoc($timesrejectedinitqry)){
			$donationrejinit = $donation6["count"];
		}
	}
	else	{
		$donationrejinit = "None";
	}

	$timesrejectedseroqry = mysqli_query($connections,"
		SELECT COUNT(DISTINCT(d.intDonationId)) AS count
		FROM tblserologicalscreening s
		JOIN tbldonation d ON s.intDonationId = d.intDonationId
		WHERE intClientId = '$clientid'
		AND stfDonorSerologicalScreeningRemarks = 'Failed'
	");
	if(mysqli_num_rows($timesrejectedseroqry) > 0)	{
		while($donation7 = mysqli_fetch_assoc($timesrejectedseroqry))	{
			$donationrejsero = $donation7["count"];
		}
	}
	else	{
		$donationrejsero = "None";
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>ReFeel - Donor Info</title>
		<link rel="icon" href="../public/img/blood.ico">
		<link rel="stylesheet" href="../public/bootstrap/bootstrap.min.css">
		<link rel="stylesheet" href="../public/css/main.css">
		<link rel="stylesheet" href="../public/css/all.css">
		<link rel="stylesheet" href="../public/css/datatables.min.css">
		<link rel="stylesheet" href="../public/css/bs-override.css">
	</head>
	<body>
		<?php include "components/loader.php"; ?>
		<div class="wrapper">
			<?php include "components/sidebar.php"; ?>
			<main class="mainpanel">
				<?php include "components/header.php"; ?>
				<div class="page-title">
					<div class="d-flex justify-content-between">
					<div>
						<h3 class="p-2 align-middle">Donor Info</h3>
					</div>
					<div class="p-2">
						<button type="button" onclick="location.href='donor-records.php'" class="btn btn-outline-danger">
							<i class="fas fa-long-arrow-alt-left"></i>
							Back
						</button>
					</div>
				</div>
				</div>
				<section class="content">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-12 col-lg-12 p-0">
								<div class="content-container">
									<div class="mx-2">
										<div class="row py-2">
											<div class="col-6 text-center client-info-card">
												<img src = "../public/img/<?php echo $image ?>" style = "width: 200px; height: 200px; border-radius:  100px;">
												<h4 class="pt-3">
													<?php
														// echo $clientfirstname . " " . $clientmiddlename . " " . $clientlastname;
														echo $clientlastname . ", " . $clientfirstname . " " . $clientmiddlename . " ";
														echo $clientsex == 'Male' ? '<i class="fa fa-mars text-primary"></i>' : '<i class="fa fa-venus text-danger"></i>';
													?>									
												</h4>
												<p class="mt-n2 mb-1 pt-0">Name</p>
											</div>
											<div class="col-6 text-center d-flex align-items-center justify-content-center client-info-card">
												<div>
													<p class="display-1">
														<?php
															echo $bloodtype;
															echo ($bloodrhesus == 'Negative' || $bloodrhesus == 'Positive') ? ($bloodrhesus == 'Positive' ? '+' : '-') : " " . $bloodrhesus
														?>
													</p>
													<p>Blood Type</p>
												</div>
											</div>
										</div>

										<hr class="my-0">
										<!-- Row 1 -->
										<div class="row collapse show" id="pnlPrsInfo">
											<div class="col-4 mx-auto text-center">
												<h4 class="pt-3">
													<?php
														echo date_format(date_create($clientbirthday), "F d, Y"); ;
													?>
												</h4>
												<p class="mt-n2 pt-0">Birthday</p>
											</div>
											<div class="col-4 mx-auto text-center">
												<h4 class="pt-3">
													<?php
														echo $clientsex;
													?>
												</h4>
												<p class="mt-n2 pt-0">Sex</p>
											</div>
											<div class="col-4 mx-auto text-center">
												<h4 class="pt-3">
													<?php
														echo $clientcontact;
													?>
												</h4>
												<p class="mt-n2 pt-0">Contact Number</p>
											</div>
										</div>

										<hr class="my-0">
										<!-- Row 2 -->
										<div class="row">
											<div class="col-6 text-center">
												<!--
												<h4 class="pt-3">
													<?php
														// echo $clientfirstname . " " . $clientmiddlename . " " . $clientlastname;
														echo $bloodtype;
													?>
												</h4>
												<p class="mt-n2 pt-0">ABO Type</p>
											</div>
											<div class="col-6 text-center">
												<h4 class="pt-3">
													<?php
														// echo $clientfirstname . " " . $clientmiddlename . " " . $clientlastname;
														echo $bloodrhesus;
													?>
												</h4>
												<p class="mt-n2 pt-0">Rhesus</p>
												-->
											</div>
										</div>
									</div>
									<!--
									<div class="row">
										client info
										<div class="container-fluid col-md-4 client-info-card">
											<b class="labeldonordiv">Name: </b>
											<label id='client_fullname'>
												<?php
													// echo $clientfirstname . " " . $clientmiddlename . " " . $clientlastname
													echo $clientlastname . ", " . $clientfirstname . " " . $clientmiddlename
												?>
											</label><br>
											<b class="labeldonordiv">Birthday:  </b>
											<label id='client_bday'><?php echo date_format(date_create($clientbirthday), "F d, Y"); ?></label><br>
											<b class="labeldonordiv">Sex: </b>
											<label id='client_sex'><?php echo $clientsex ?> </label><br>
											<b class="labeldonordiv">Contact: </b>
											<label id='client_contact'> <?php echo $clientcontact ?> </label><br>
											<b class="labeldonordiv">Blood Type: </b>
											<label id="client_bloodtype"> <?php echo $bloodtype . " " . $bloodrhesus ?> </label><br>
											<b class="labeldonordiv">Latest Profile Changes : </b><br>
											<label id="client_changes"> <?php echo $changes ?> </label>
										</div>
										client donation info
										<div class="col-md-4 container-fluid client-info-card">
											<b class="labeldonordiv" for="lastdonation">Last Donation: </b>
											<label id="lastdonation"><?php echo date_format(date_create($lastdonationdate), 'F d, Y h:m A'); ?></label><br>
											<b class="labeldonordiv" for="timesdonated">Times Donated: </b>
											<label id="timesdonated"><?php echo $donationfreq ?></label><br>
											<b class="labeldonordiv">Times Rejected:</b><br>
											<b class="mr-3" id="timesrejectedinsurvey">Survey: <span style="font-weight: 300"><?php echo $donationrejmed ?></span> </b>
											<b class="mr-3" id="timesrejectedphys">Physical Exam: <span style="font-weight: 300"><?php echo $donationrejphy ?></span> </b>
											<b class="mr-3" id="timesrejectedinit">Initial Screening: <span style="font-weight: 300"><?php echo $donationrejinit ?></span></b>
											<b class="mr-3" id="timesrejectedsero">Serological Screening: <span style="font-weight: 300"><?php echo $donationrejsero ?></span></b>
										</div>
										client image
										<div class="col-md-4 container-fluid text-center client-info-card">
											<img src = "../public/img/<?php echo $image ?>" class="ml-auto mr-auto" style = "width:200px; height:200px; border-radius: 100px;">
										</div>
									-->
										<div class="col-md-12 mt-4" id="divview_records">
											<table id="tblViewDonation" class="table table-hover table-bordered text-center" style="width: 100%">
												<thead>
													<tr class="bg-danger text-white">
														<td style="">Donation ID</td>
														<td>Donation Date</td>
														<td style="width: 7.5%" title="Medical Exam"><i class="fa fa-notes-medical"></i></td>
														<td style="width: 7.5%" title="Physical Exam"><i class="fa fa-stethoscope"></i></td>
														<td style="width: 7.5%" title="Initial Screening"><i class="fa fa-vial"></i></td>
														<td style="width: 7.5%" title="Serological Screening"><i class="fa fa-microscope"></i></td>
														<td>Action</td>
													</tr>
												</thead>
											</table>
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
		<script src="../public/js/datatables.min.js"></script>
		<script src="../public/js/notification.js"></script>
		<script>
			// feather.replace();
			$('#maintenance').addClass('active');
			$('#donor').addClass('active');
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

			let clientid = <?php echo $clientid ?>;
			let bannedDonorRecord = 'bannedDonorRecord';
			// console.log(clientid);
			//initialize active blood component table
			$('#tblViewDonation').DataTable({
				"processing" : true,
				"serverSide" : true,
				"ajax" : {
					url : "../controller/donor/datatables.php",
					type: "POST",
					data:{ clientid:clientid, type: bannedDonorRecord }
				},
				"language" : {
					"emptyTable" : "No donation record to show"
				}
			});
		</script>
	</body>
</html>
