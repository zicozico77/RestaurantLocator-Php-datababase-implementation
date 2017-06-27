<?php
	include ('connectDBclaire.php');
	session_start();

$link = connect();

$description = mysqli_real_escape_string($link, $_REQUEST['description']);
$start_date = mysqli_real_escape_string($link, $_REQUEST['start_date']);
$end_date = mysqli_real_escape_string($link, $_REQUEST['end_date']);
$user_name=$_SESSION['user_name'];

$sql = "SELECT user_id FROM Owner WHERE user_name='$user_name'";
$result = mysqli_query($link,$sql);
while ($row = mysqli_fetch_assoc($result)){
	$user_id=$row["user_id"];
}


//insert query execution
$sql2 = "INSERT INTO deal (description, user_id, start_date, end_date) VALUES ('$description', '$user_id', '$start_date', '$end_date')";
if (mysqli_query($link, $sql2)){
	echo "Success";
} else {
	echo "Error";
}




//close connection
mysqli_close($link);

header("Location: account_page.php");

?>