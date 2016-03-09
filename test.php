<!DOCTYPE html>
<html>
	<head>
		<title>Test PHP</title>
	</head>

	<body>
		<?php
		
		include "../shared/query_UDFs.php";
		include "../shared/dbInfo.php";

		// Connect to DB
		$conn = mysqli_connect($dbInfo['dbIP'], $dbInfo['user'], $dbInfo['password'], $dbInfo['dbName']);
		if ($conn->connect_errno){
			echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
		}

		
		/***************************/
		/***     TABLE NAME      ***/
		/***************************/
		$table = "tc_event";
		

		$sql = "SELECT * FROM " . $table;

		// Run Query
		$qry_result = $conn->query($sql);

		// Output query results
		if (!$qry_result){
			echo "Query failed: (" . $conn->errno . ") " . $conn->error;
		}
		else{
			dumpQuery($qry_result);
		}
		// Close DB connection
		mysqli_close($conn);

		?>


	</body>
</html>