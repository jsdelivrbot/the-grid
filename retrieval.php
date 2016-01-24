<?php

$servername = "localhost";
$username = "cryszwjw_g_user";
$password = "vWNxak!auom3";
$dbname = "cryszwjw_g_stats";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT PlayerID, PlayerName, PlayerStats FROM gamesync_data";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
     // output data of each row
     while($row = $result->fetch_assoc()) {
         echo "<br> id: ". $row["PlayerID"]. " - Name: ". $row["PlayerName"]. " - Level: " . $row["PlayerStats"] . "<br>";
     }
} else {
     echo "0 results";
}

$conn->close();

?>
