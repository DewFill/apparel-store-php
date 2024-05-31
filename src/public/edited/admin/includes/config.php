<?php
define('DB_SERVER','localhost');
define('DB_USER','l9tslhne_newsportal');
define('DB_PASS' ,'E#Qzb*6%[zb{');
define('DB_NAME','l9tslhne_newsportal');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>