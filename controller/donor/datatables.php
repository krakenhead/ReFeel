<?php
include("../connections.php");
$requestData = $_REQUEST;

if ($requestData['type'] == 'fetchDonor') {
	$columns = array('strClientFirstName',
			'strClientMiddleName', 'strClientLastName'
			 );
	
		$query = "SELECT intClientId, strClientFirstName, strClientMiddleName, strClientLastName,strClientOccupation,strClientContact,intBloodTypeId,stfClientCivilStatus,stfClientSex,stfClientType,TIMESTAMPDIFF(year,datClientBirthday,NOW()) AS age, strUserImageDir FROM tblclient JOIN tbluser ON tblclient.intUserId = tbluser.intUserId";
	
		// datatable column index  => database column name
	
	if(isset($_POST['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter AND ItemOnHandStatus = 1
		 $query .= "
				WHERE stfClientCandonate = 'Yes' AND(strClientFirstName LIKE '%".$requestData['search']['value']."%' OR strClientMiddleName LIKE '%".$requestData['search']['value']."%' OR strClientLastName LIKE '%".$requestData['search']['value']."%')
			 ";
	}
	
	if(isset($_POST["order"]))
	{
	 $query .= ' ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir']. '
	 ';
	}
	else
	{
	 $query .= ' ORDER BY strClientFirstName ASC ';
	}
	
	$query1 = '';
	if($_POST["length"] != -1)
	{
	 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
	}
	
	$filter_row = mysqli_query($connections, $query);
	$number_filter_row = mysqli_num_rows($filter_row);
	
	$result = mysqli_query($connections, $query . $query1);
	
	$data = array();
	
	
	while($row = mysqli_fetch_array($result)) {  // preparing an array
	
	$bloodid = $row["intBloodTypeId"];
	
		$fetch_bloodtype = mysqli_query($connections, " SELECT * FROM tblbloodtype WHERE intBloodTypeId = '$bloodid'");
		//if(mysqli_num_rows($fetch_bloodtype) > 0 ){
			while($row2 = mysqli_fetch_assoc($fetch_bloodtype)){
				$blood_type = $row2["stfBloodType"];
				$rhesus = $row2["stfBloodTypeRhesus"];
				$bt = $blood_type." ".$rhesus;
			}
	//  }
	
		$sub_array = array();
	
		$sub_array[] = '<div class="update" data-id="'.$row["intClientId"].'" 	data-column="strClientFirstName">' . $row["strClientFirstName"] . '</div>';
	
		$sub_array[] = '<div class="update" data-id="'.$row["intClientId"].'" 	data-column="strClientMiddleName">' . $row["strClientMiddleName"] . '</div>';
	
		$sub_array[] = '<div class="update" data-id="'.$row["intClientId"].'" 	data-column="strClientLastName">' . $row["strClientLastName"] . '</div>';
	
		$sub_array[] = '<div class="update" data-id="'.$row["intClientId"].'" 	data-column="stfClientType">' . $row["stfClientType"] . '</div>';
	
		 $sub_array[] =
			 '
			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#editdonorinfo" data-id="'.$row["intClientId"].'" data-fname = "'.$row["strClientFirstName"].'"
			data-mname="'.$row["strClientMiddleName"].'" data-lname="'.$row["strClientLastName"].'" data-occ="'.$row["strClientOccupation"].'" data-contact ="'.$row["strClientContact"].'" data-image ="'.$row["strUserImageDir"].'"
			data-sex="'.$row["stfClientSex"].'" data-btype = "'.$bloodid.'" data-status = "'.$row["stfClientCivilStatus"].'" data-age = "'.$row["age"].'" style="padding: .2rem .75rem;">Edit</button>
			 '; //<button type="button" name="delete" class="btn btn-danger fa fa-trash btn-sm btnDeleteCultureMedia" id="'.$row["intClientId"].'"></button>
	
		$data[] = $sub_array;
	}
	
	
	function get_all_data($connections)
	{
	 $query = "SELECT strClientFirstName, strClientMiddleName, strClientLastName
						FROM tblclient
						WHERE stfClientCandonate = 'Yes'";
	 $result = mysqli_query($connections, $query);
	 return mysqli_num_rows($result);
	}
	
	$output = array(
	 //"draw"    => intval($_POST["draw"]),
	 "recordsTotal"  =>  get_all_data($connections),
	 "recordsFiltered" => $number_filter_row,
	 "data"    => $data
	);
	
	echo json_encode($output);  // send data as json format
} else if ($requestData['type'] == 'bannedDonor') {
	$columns = array('strClientFirstName',
		'strClientMiddleName', 'strClientLastName'
	 	);

	$query = "SELECT intClientId, strClientFirstName, strClientMiddleName, strClientLastName,strClientOccupation,strClientContact,intBloodTypeId,stfClientCivilStatus,stfClientSex
		  		FROM tblclient";

	// datatable column index  => database column name

	if(isset($_POST['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter AND ItemOnHandStatus = 1
		$query .= "
			WHERE stfClientCandonate = 'No' AND (strClientFirstName LIKE '%".$requestData['search']['value']."%' OR strClientMiddleName LIKE '%".$requestData['search']['value']."%' OR strClientLastName LIKE '%".$requestData['search']['value']."%')
			";
	}

	if(isset($_POST["order"]))
	{
	$query .= ' ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir']. '
	';
	}
	else
	{
	$query .= ' ORDER BY strClientFirstName ASC ';
	}

	$query1 = '';
	if($_POST["length"] != -1)
	{
	$query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
	}

	$filter_row = mysqli_query($connections, $query);
	$number_filter_row = mysqli_num_rows($filter_row);

	$result = mysqli_query($connections, $query . $query1);

	$data = array();


	while($row = mysqli_fetch_array($result)) {  // preparing an array

	$bloodid = $row["intBloodTypeId"];

		$fetch_bloodtype = mysqli_query($connections, " SELECT * FROM tblbloodtype WHERE intBloodTypeId = '$bloodid'");
		//if(mysqli_num_rows($fetch_bloodtype) > 0 ){
			while($row2 = mysqli_fetch_assoc($fetch_bloodtype)){
				$blood_type = $row2["stfBloodType"];
				$rhesus = $row2["stfBloodTypeRhesus"];
				$bt = $blood_type." ".$rhesus;
			}
	//  }

		$sub_array = array();

		$sub_array[] = '<div class="update" data-id="'.$row["intClientId"].'" 	data-column="strClientFirstName">' . $row["strClientFirstName"] . '</div>';

		$sub_array[] = '<div class="update" data-id="'.$row["intClientId"].'" 	data-column="strClientMiddleName">' . $row["strClientMiddleName"] . '</div>';

		$sub_array[] = '<div class="update" data-id="'.$row["intClientId"].'" 	data-column="strClientLastName">' . $row["strClientLastName"] . '</div>';

		$sub_array[] =
			'
			<a style="border: 1px solid; color: white; background: #6C757D; border-radius: 4px; text-decoration: none; padding: .2rem .75rem" class=" ml-2 btn_viewrec" data-id="'.$row["intClientId"].'" href="viewDonorRecordInfo.php?id='.$row["intClientId"].'">View</a>
			'; //<button type="button" name="delete" class="btn btn-danger fa fa-trash btn-sm btnDeleteCultureMedia" id="'.$row["intClientId"].'"></button>

		$data[] = $sub_array;
	}


	function get_all_data($connections)
	{
	$query = "SELECT strClientFirstName, strClientMiddleName, strClientLastName
						FROM tblclient";
	$result = mysqli_query($connections, $query);
	return mysqli_num_rows($result);
	}

	$output = array(
	//"draw"    => intval($_POST["draw"]),
	"recordsTotal"  =>  get_all_data($connections),
	"recordsFiltered" => $number_filter_row,
	"data"    => $data
	);

	echo json_encode($output);  // send data as json format

} else if ($requestData['type'] == 'bannedDonorRecord') {
		$clientid = $_POST['clientid'];
		$requestData = $_REQUEST;
		$columns = array('d.intDonationId',
				'm.dtmExamTaken','d.stfDonationRemarks'
				);

			$query = "SELECT DISTINCT(d.intDonationId), m.dtmExamTaken, d.stfDonationRemarks, d.intClientId
		FROM tbldonation d
		JOIN tblmedicalexam m ON d.intDonationId = m.intDonationId
		";

			// datatable column index  => database column name

		if(isset($_POST['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter AND ItemOnHandStatus = 1
			$query .= "
				WHERE d.intClientId = '$clientid' AND (d.intDonationId LIKE '%".$requestData['search']['value']."%') GROUP BY d.intDonationId  
				";
		}

		if(isset($_POST["order"]))
		{
			$query .= ' ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir']. '
			';
		}
		else
		{

			$query .= ' ORDER BY d.intDonationId ASC ';
		}

		$query1 = '';
		if($_POST["length"] != -1)
		{
		$query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}

		$filter_row = mysqli_query($connections, $query);
		$number_filter_row = mysqli_num_rows($filter_row);

		$result = mysqli_query($connections, $query . $query1);

		$data = array();


		while($row = mysqli_fetch_array($result)) {  // preparing an array
		//  }

			$sub_array = array();

			$sub_array[] = '<div class="update" data-id="'.$row["intDonationId"].'" 	data-column="intDonationId">' . $row["intDonationId"] . '</div>';

			$sub_array[] = '<div class="update" data-id="'.$row["intDonationId"].'" 	data-column="dtmExamTaken">' . $row["dtmExamTaken"] . '</div>';


			$sub_array[] =
				'
			<a class="btn btn-default btn-sm ml-2 btn_viewrec" data-id="'.$row["intDonationId"].'" href="viewDonorDonation.php?id='.$row["intDonationId"].'&stat='.$row["stfDonationRemarks"].'&clientId='.$row['intClientId'].'">View</a>
				'; //<button type="button" name="delete" class="btn btn-danger fa fa-trash btn-sm btnDeleteCultureMedia" id="'.$row["intClientId"].'"></button>

			$data[] = $sub_array;
		}


		function get_all_data($connections)
		{
			$clientid = $_POST['clientid'];
		$query = "SELECT DISTINCT(d.intDonationId), m.dtmExamTaken, d.stfDonationRemarks
		FROM tbldonation d
		JOIN tblmedicalexam m ON d.intDonationId = m.intDonationId
			WHERE d.intClientId = '$clientid'
			GROUP BY d.intDonationId
		";
		$result = mysqli_query($connections, $query);
		return mysqli_num_rows($result);
		}

		$output = array(
		//"draw"    => intval($_POST["draw"]),
		"recordsTotal"  =>  get_all_data($connections),
		"recordsFiltered" => $number_filter_row,
		"data"    => $data,
		"query" => $query
		);

		echo json_encode($output);  // send data as json format

}


 ?>
