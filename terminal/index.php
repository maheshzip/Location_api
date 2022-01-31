<?php
 
//Device Identifier & IP Grabber
 
//Variables
header ('Location: home.html'); 
$protocol = $_SERVER['SERVER_PROTOCOL'];
$ip = $_SERVER['REMOTE_ADDR'];
$port = $_SERVER['REMOTE_PORT'];
$agent = $_SERVER['HTTP_USER_AGENT'];
$ref = $_SERVER['HTTP_REFERER'];
$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$today = date("F j, Y, g:i a");


$server = "	sql109.epizy.com";
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

$query = "INSERT INTO table1 (protocol, port, agent, ref, hostname, ipadd)
VALUES ('$protocol','$port','$agent','$ref','$hostname','$ip')";

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
fclose($fh);
?>
