<?php
// Get parameters from URL
$user_id = $_GET["id"];

// Opens a connection to a MySQL server
$connection = mysql_connect ('localhost','root','bexuxicupiwe');
if (!$connection) {
  die('Not connected : ' . mysql_error());
}

// Set the active MySQL database
$db_selected = mysql_select_db('infs7202_project', $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}


$query = sprintf("SELECT user_id, description, start_date, end_date FROM deal WHERE user_id =".$user_id."");



$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}

while ($row = mysql_fetch_assoc($result)) {
        $listings_results[] = array(
            'id' => $row['user_id'],
            'description' => $row['description'],
            'start_date' => $row['start_date'],
            'end_date' => $row['end_date'],
        );
}

// send the encoded results;
$json = json_encode($listings_results);
echo $json;
exit(0);

?>