<?php
// Get parameters from URL
$swLat = $_GET["swLat"];
$swLng = $_GET["swLng"];
$neLat = $_GET["neLat"];
$neLng = $_GET["neLng"];
$center_lat = $_GET["cLat"];
$center_Lng = $_GET["cLng"];
$bar = $_GET["bar"];
$cafe = $_GET["cafe"];
$restaurant = $_GET["restaurant"];
$date = $_GET["date"];

if( $swLng < $neLng )
    {
        $ANDOR_lng = "AND";
    }
else
    {
        $ANDOR_lng = "OR";
    }

if ($date == null) {
    $start_date = '9999-12-12';
    $end_date = '0000-00-00'; 
}
else {
    $start_date = $date; 
    $end_date = $date;   
}

$business_type = "nothing";

if ($bar == 'checked') {
    $bar = "bar";
}
if ($cafe == 'checked') {
    $cafe = "cafe";
}
if ($restaurant == 'checked') {
    $restaurant = "restaurant";
}
if ($bar == 'true') {
    $bar = "bar";
}
if ($cafe == 'true') {
    $cafe = "cafe";
}
if ($restaurant == 'true') {
    $restaurant = "restaurant";
}







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


$query = sprintf("SELECT user_id, business_name, user_email, business_phone, business_address, business_type, lat, lng FROM Owner WHERE lat BETWEEN '%s' AND '%s' AND ( lng > '%s' ".$ANDOR_lng." lng < '%s' ) AND user_id IN (SELECT user_id FROM deal WHERE '%s' <= end_date AND '%s' >= start_date) AND business_type = '%s' OR business_type = '%s' OR business_type = '%s'",
  mysql_real_escape_string($swLat),
  mysql_real_escape_string($neLat),
  mysql_real_escape_string($swLng),
  mysql_real_escape_string($neLng),
  mysql_real_escape_string($end_date),
  mysql_real_escape_string($start_date),
  mysql_real_escape_string($bar),
  mysql_real_escape_string($cafe),
  mysql_real_escape_string($restaurant)
                );



$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}

while ($row = mysql_fetch_assoc($result)) {
    $lat = (int)$row['lat'];
    $lng = (int)$row['lng'];
    if (!empty($lat) && !empty($lng)) { 
        $listings_results[] = array(
            'id' => $row['user_id'],
            'name' => $row['business_name'],
            'email' => $row['user_email'],
            'address' => $row['business_address'],
            'phone' => $row['business_phone'],
            'lat' => $row['lat'],
            'lng' => $row['lng'],
            'type' => $row['business_type']
        );
    }
}

// send the encoded results;
$json = json_encode($listings_results);
echo $json;
exit(0);

?>