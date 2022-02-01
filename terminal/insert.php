<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Data</title>
</head>
<body>

    <?php


$protocol = $_SERVER['SERVER_PROTOCOL'];
$ip = $_SERVER['REMOTE_ADDR'];
$port = $_SERVER['REMOTE_PORT'];
$agent = $_SERVER['HTTP_USER_AGENT'];
$ref = $_SERVER['HTTP_REFERER'];
$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$today = date("F j, Y, g:i a");

        

        
$server = "localhost";   
$username = "root";
$password = "";
$dbname = 'test';

//Create connection
$mysqli = new mysqli($server, $username, $password, $dbname);

//check connection
if ($mysqli->connect_error)
{
    die("Connection error: " . $mysqli->connect_error);
}

$query = "INSERT INTO table1 (protocol, port, agent, ref, hostname)
VALUES ('$protocol','$port','$agent','$ref','$hostname')";

if ($mysqli->query($query)===TRUE){
    echo "New record created successfully";
}else{
    echo "Error: " . $mysqli->error;
}

            $mysqli->close();

    ?>
    
</body>
</html>