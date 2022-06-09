<?php
session_start();
$id=$_GET['id'];
echo$id;

include "../partials/_dbconnect.php";

$sql="DELETE FROM `num_records` WHERE `num_records`.`s_no` = $id;";
$result=mysqli_query($conn, $sql);
if ($result)
{
    $_SESSION['login_success']="contact deleted successfully";
    header("Location: ../index.php");
}
else
{
    echo"could not delete the contact";
}


?>