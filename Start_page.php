
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

$sql = "INSERT INTO gamesync_data (PlayerID, PlayerName, PlayerStats)
VALUES ('ID12350', 'New Player', '30')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
