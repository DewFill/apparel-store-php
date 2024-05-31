<?php
define('DB_SERVER','localhost');
define('DB_USER','u_edited');
define('DB_PASS' ,'bI3qT5oE3vaZ0b');
define('DB_NAME','edited');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>