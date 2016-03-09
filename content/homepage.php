<?php
	// Connect to DB
	$conn = mysqli_connect($dbInfo['dbIP'], $dbInfo['user'], $dbInfo['password'], $dbInfo['dbName']);
	if ($conn->connect_errno){
		echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
	}

	$sql = "
		SELECT *
		FROM (SELECT FName, LName, Email, DeptID, DateCertified
			  FROM " . $neo_table . "
			  WHERE Active=1) AS a
		JOIN (SELECT DISTINCT DeptID, WorkingDept AS DeptName
			  FROM " . $allActives_table . ") AS b
		ON a.DeptID = b.DeptID;
	";


	// Run Query
	if (!($qry_result = $conn->query($sql))){
		echo "Query failed: (" . $conn->errno . ") " . $conn->error;
		echo "<br />" . $sql;
	}
	
	// Close DB connection
	mysqli_close($conn);
?>	

<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<br />
			<table id="certTable" class="table table-striped">
				<thead>
					<tr>
						<th>Date Certified</th>
						<th>Name</th>
						<th>Department</th>
						<th>Email</th>
					</tr>
				</thead>
				<tbody>
				<?php
					// Loop through all rows in query result
					while ($row = $qry_result->fetch_assoc()){

						// Display rows
						echo '<tr>';
							echo '<td>' . date('m/d/Y', strtotime($row['DateCertified'])) . '</td>';
							echo '<td>' . $row['LName'] . ', ' . $row['FName'];
							echo '<td>' . $row['DeptName'] . '</td>';
							echo '<td>' . $row['Email'] . '</td>';
						echo '</tr>';

					}
				?>

				</tbody>
			</table>
		</div>
	</div>

</div>
		




		





