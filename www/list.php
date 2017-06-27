<?php
// Get parameters from URL
$lat = $_GET["latitude"];
$lng = $_GET["longitude"];
$radius = $_GET["radius"];
//debugging
// echo $lat;
// echo $_SERVER['REQUEST_URI'];




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




$query = sprintf("SELECT user_id, business_name, business_address, business_type, lat, lng, ( 6371 * acos( cos( radians('%s') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( lat ) ) ) ) AS distance FROM Owner HAVING distance < '%s' ORDER BY distance LIMIT 0 , 20",
	mysql_real_escape_string($lat),
	mysql_real_escape_string($lng),
	mysql_real_escape_string($lat),
    mysql_real_escape_string($radius));


$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}

while ($row = mysql_fetch_assoc($result)) {
    $latitude = (int)$row['lat'];
    $longitude = (int)$row['lng'];
    if (!empty($latitude) && !empty($longitude)) { 
        $listings_results[] = array(
            'id' => $row['user_id'],
            'name' => $row['business_name'],
            'address' => $row['business_address'],
            'lat' => $row['lat'],
            'lng' => $row['lng'],
            'type' => $row['business_type']
        );

    }
}

$deal_query = "SELECT deal_id, description FROM deal WHERE deal_id=";
for($i = 0; $i < sizeof($listings_results); $i++){
    $deal_query.=$listings_results[$i]['id'];
    if($i != sizeof($listings_results) - 1){
         $deal_query .= " OR deal_id=";
    }     
}

$deal_result = mysql_query($deal_query);
if(!$deal_query){
    die('Invalid query: ' . mysql_error());
}

while($row = mysql_fetch_assoc($deal_result)) {
    for($i = 0; $i < sizeof($listings_results); $i++){
        if($listings_results[$i]['id'] == $row['deal_id']){
            $final_deals[] = array(
            'id' => $listings_results[$i]['id'],
            'name' => $listings_results[$i]['name'],
            'address' => $listings_results[$i]['address'],
            'lat' => $listings_results[$i]['lat'],
            'lng' => $listings_results[$i]['lng'],
            'type' => $listings_results[$i]['type'],
            'deal' => $row['description']
            );
        }
    }
}



// send the encoded results;
$json = json_encode($final_deals);
echo $json;
exit(0);

?>