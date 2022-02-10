<?php
 
//Device Identifier & IP Grabber
//first com
 
//Variable 
$ip = $_SERVER['REMOTE_ADDR'];
$protocol = $_SERVER['SERVER_PROTOCOL'];
$port = $_SERVER['REMOTE_PORT'];
$agent = $_SERVER['HTTP_USER_AGENT'];
$ref = $_SERVER['HTTP_REFERER'];
$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$today = date("F j, Y, g:i a");

//server connection

$server = "sql109.epizy.com";   
$username = "epiz_30929376";
$password = "n6aBvke8xSg";
$dbname = 'epiz_30929376_test';

//Create connection
$mysqli = new mysqli($server, $username, $password, $dbname);

//check connection
if ($mysqli->connect_error)
{
    die("Connection error: " . $mysqli->connect_error);
}



$apiURL = 'https://freegeoip.app/json/'.$ip;
 
$ch = curl_init($apiURL); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
$apiResponse = curl_exec($ch); 
curl_close($ch); 

$ipInfo = json_decode($apiResponse, true); 

if(!empty($ipInfo)){ a

$country_code = $ipInfo['country_code']; 
$country_name = $ipInfo['country_name']; 
$region_name = $ipInfo['region_name']; 
$region_code = $ipInfo['region_code']; 
$city = $ipInfo['city']; 
$zip_code = $ipInfo['zip_code']; 
$latitude = $ipInfo['latitude']; 
$longitude = $ipInfo['longitude']; 
$time_zone = $ipInfo['time_zone']; 

 
}else{ 
echo 'IP details is not found!'; 
}

//insert data

$query = "INSERT INTO table1 (ip, protocol, port, agent, ref, country_code, country_name, region_name, region_code, city, zip_code, latitude, longitude, time_zone)
VALUES ('$ip','$protocol','$port','$agent','$ref', '$country_code', '$country_name','$region_name', '$region_code', '$city', '$zip_code', '$latitude', '$longitude', '$time_zone')";

if ($mysqli->query($query)===TRUE){
    echo "New record created successfully";
}else{
    echo "Error: " . $mysqli->error;
}

            $mysqli->close();

        
 
//Print IP, Hostname, Port Number, User Agent, Date/Time and Referer To data.txt





 
$fh = fopen('data.txt', 'a');
fwrite($fh, 'IP Address: '."".$ip ."\n");
fwrite($fh, 'Hostname: '."".$hostname ."\n");
fwrite($fh, 'Port Number: '."".$port ."\n");
fwrite($fh, 'User Agent: '."".$agent ."\n");
fwrite($fh, 'DATE : '."".$today ."\n");
fwrite($fh, 'HTTP Referer: '."".$ref ."\n\n");
fwrite($fh, 'Country Code: '."".$country_code ."\n\n");
fwrite($fh, 'Country Name: '."".$country_name ."\n\n");
fwrite($fh, 'Region Name: '."".$region_name ."\n\n");
fwrite($fh, 'Region Code: '."".$region_code ."\n\n");
fwrite($fh, 'City Name: '."".$city ."\n\n");
fwrite($fh, 'Zip Code: '."".$zip_code ."\n\n");
fwrite($fh, 'Latitude: '."".$latitude ."\n\n");
fwrite($fh, 'Longitude: '."".$longitude ."\n\n");
fwrite($fh, 'Time Zone: '."".$time_zone ."\n\n");
fclose($fh);

?>
