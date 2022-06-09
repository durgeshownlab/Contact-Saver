<?php

$server='localhost';
$dbuname='root';
$dbpassword='';
$db_name='contact';

$conn=mysqli_connect($server, $dbuname, $dbpassword, $db_name);
if($conn)
{
}
else
{
    echo"Could not connected";
}

?>