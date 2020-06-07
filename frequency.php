<?php
include('bootstrap.php');
require_once 'google-api-php-client/vendor/autoload.php';
?>

<body>
	<?php include('navbar.php'); ?>

	<div class="frequency-table">
		<?php
		define('bucketLink', 'gs://cloud-a1/employees.csv');
		define('cloudId', 'cloudnguyen1');

		// Using Google Big Query service
		// Create client
		$client = new Google_Client();
		$client->useApplicationDefaultCredentials();
		$client->addScope(Google_Service_Bigquery::BIGQUERY);

		// using service as client
		$bigquery = new Google_Service_Bigquery($client);
		$projectId =  cloudId;

		// prepare query request
		$fnameQuery = new Google_Service_Bigquery_QueryRequest();
		$lnameQuery = new Google_Service_Bigquery_QueryRequest();

		// returnString to be echoed into frequency table
		$returnString = '';

		// create the string with table format
		$returnString = "<h4 class='form-header'>Firstname & Lastname Frequency of Employee</h4>";
		$returnString .= "<table id='employee_table' class='table table-bordered count-table'>" .
			"<thead>" .
			"<tr class='table-top-frequency'>" .
			"<th scope='col'>ID</th>" .
			"<th scope='col'>First Name</th>" .
			"<th scope='col'>Last Name</th>" .
			"<th scope='col'>Gender</th>" .
			"<th scope='col'>Age</th>" .
			"<th scope='col'>Address</th>" .
			"<th scope='col'>Phone</th>" .
			"<th scope='col'>F.Name Frequency</th>" .
			"<th scope='col'>L.Name Frequency</th>" .
			"</tr>" .
			"</thead>" .
			"<tbody>";

		// check if file exist
		if (file_exists(bucketLink)) {
			$csvFileLines = file(bucketLink, FILE_IGNORE_NEW_LINES);
			// read the csv file and put all line into an array
			foreach ($csvFileLines as $line) {
				$employeeObject = explode(",", $line);

				// get employee firstname and lastname value
				$fname = $employeeObject[1];
				$lname = $employeeObject[2];

				// query first name and last name frequency
				$fnameQuery->setQuery("SELECT SUM(count) FROM [cloudnguyen1:baby.names] 
													WHERE name = '$fname' GROUP BY name");

				$lnameQuery->setQuery("SELECT SUM(count) FROM [cloudnguyen1:baby.names] 
													WHERE name = '$lname' GROUP BY name");

				// get firstname and last name query value
				$fnameResponse = $bigquery->jobs->query($projectId, $fnameQuery);
				$lnameResponse = $bigquery->jobs->query($projectId, $lnameQuery);

				$fnameRows = $fnameResponse->getRows();
				$lnameRows = $lnameResponse->getRows();

				// insert query value into data table
				if (sizeof($fnameRows) == 0) {
					if (sizeof($lnameRows) == 0) {
						$returnString .= "<tr>" .
							"<td>" . $employeeObject[0] . "</td>" .
							"<td>" . $employeeObject[1] . "</td>" .
							"<td>" . $employeeObject[2] . "</td>" .
							"<td>" . $employeeObject[3] . "</td>" .
							"<td>" . $employeeObject[4] . "</td>" .
							"<td>" . $employeeObject[5] . "</td>" .
							"<td>" . $employeeObject[6] . "</td>" .
							"<td>" . 0 . "</td>" .
							"<td>" . 0 . "</td>" .
							"</tr>";
					} else {
						foreach ($lnameRows as $row) {
							$returnString .= "<tr>" .
								"<td>" . $employeeObject[0] . "</td>" .
								"<td>" . $employeeObject[1] . "</td>" .
								"<td>" . $employeeObject[2] . "</td>" .
								"<td>" . $employeeObject[3] . "</td>" .
								"<td>" . $employeeObject[4] . "</td>" .
								"<td>" . $employeeObject[5] . "</td>" .
								"<td>" . $employeeObject[6] . "</td>" .
								"<td>" . 0 . "</td>";
							foreach ($row['f'] as $field) {
								$returnString .= "<td>" . $field['v'] . "</td>";
							}
						}
					}
				} else {
					if (sizeof($lnameRows) == 0) {
						foreach ($fnameRows as $row) {
							$returnString .= "<tr>" .
								"<td>" . $employeeObject[0] . "</td>" .
								"<td>" . $employeeObject[1] . "</td>" .
								"<td>" . $employeeObject[2] . "</td>" .
								"<td>" . $employeeObject[3] . "</td>" .
								"<td>" . $employeeObject[4] . "</td>" .
								"<td>" . $employeeObject[5] . "</td>" .
								"<td>" . $employeeObject[6] . "</td>";
							foreach ($row['f'] as $field) {
								$returnString .= "<td>" . $field['v'] . "</td>";
							}
							$returnString .= "<td>" . 0 . "</td>";
						}
					} else {
						for ($i = 0; $i < count($lnameRows); $i++) {
							$returnString .= "<tr>" .
								"<td>" . $employeeObject[0] . "</td>" .
								"<td>" . $employeeObject[1] . "</td>" .
								"<td>" . $employeeObject[2] . "</td>" .
								"<td>" . $employeeObject[3] . "</td>" .
								"<td>" . $employeeObject[4] . "</td>" .
								"<td>" . $employeeObject[5] . "</td>" .
								"<td>" . $employeeObject[6] . "</td>";
							foreach ($fnameRows[$i]['f'] as $field) {
								$returnString .= "<td>" . $field['v'] . "</td>";
							}
							foreach ($lnameRows[$i]['f'] as $field) {
								$returnString .= "<td>" . $field['v'] . "</td>";
							}
						}
					}
				}
			}
		}
		$returnString .= '</tbody></table>';
		echo $returnString;
		?>
</body>