<?php

	$query = "SEECT * FROM Business_Deals"
	$result = mysqli_query($connection, $query);
	if(!$result) {
		die("Database query failed");
	}
?>