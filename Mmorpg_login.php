<?php 
$user_name="cryszwjw_g_user";
$password="vWNxak!auom3";
$database="cryszwjw_g_stats";
$server=127.0.0.1";

mysql_connect($server,$user_name,$password);
$db_found=mysql_select_db($database);
if($dbfound){
$SQL="SELECT"*FROM gamesync_data";
$result=mysql_query($SQL);

while($db_field=mysql_fetch_assoc($result)){
print $db_field['PlayerID']."<BR>";
print $db_field['PlayerName']."<BR>";
print $db_field['PlayerStats']."<BR>";}
print"database found";
}
else{
print"database not found";
}
print "Connection to the server opened";


?>

 
