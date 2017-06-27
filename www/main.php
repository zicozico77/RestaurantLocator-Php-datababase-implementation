<?php
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

$query = "SELECT description FROM deal ORDER BY Rand() LIMIT 0 , 8";

$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}

while ($row = mysql_fetch_assoc($result)) {
    $deals[] = array(
        'description' => $row['description'],
    );
}

$json = json_encode($deals);
echo $json;
exit(0);
?>