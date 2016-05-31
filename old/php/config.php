<?php
$host='staffindia.db.10655880.hostedresource.com'; // Host name
$username='staffindia'; // Mysql username
$password='ILLmonkey2015!'; // Mysql password
$db_name='staffindia'; // Database nam

$mysqli = new mysqli($host, $username, $password, $db_name);
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
error_reporting(0);

// Connect to server and select databse.
/*$conn = mysql_connect("$host", "$username", "$password")or die("cannot connect");
mysql_select_db("$db_name")or die("cannot select DB");*/
?>