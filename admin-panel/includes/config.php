<?php
define('DB_SERVER','localhost');
define('DB_USER','u486939189_rwanda_pet');
define('DB_PASS' ,'X[njPPYk$9');
define('DB_NAME','u486939189_rwanda_pet');
$conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>