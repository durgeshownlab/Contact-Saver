<?php

// UPDATE `num_records` SET `name` = 'naveen ', `number` = '6205925685', `email` = 'Not Found ' WHERE `num_records`.`s_no` = 37;
session_start();
include '../partials/_dbconnect.php';
$vid=$_SESSION['s_no'];

// code from here to auto fill the form when user will click the update buttoon on previous page 
$fid=$_GET['id'];
$sql="SELECT * FROM `num_records` WHERE `s_no`=$fid";
$result=mysqli_query($conn, $sql);
if(mysqli_num_rows($result)==1)
{
    while($row=mysqli_fetch_assoc($result))
    {
        $fname=$row['name'];
        $fnumber=$row['number'];
        $femail=$row['email'];
        if($femail=="Not Found")
        {
            $femail='';
        }
    }
}


// code from here to update the details in the database
if(isset($_POST['save-btn']))
{
    $id = $_GET['id'];
    $url_number=$_GET['number'];
    $name=$_POST['c-name'];
    $number=$_POST['c-number'];
    $email=$_POST['c-email'];

    if(is_numeric($number))
    {
        // code to verify that the given number is allready exist in user contact or not 
        $sql="SELECT * FROM `num_records` WHERE `s_no_user`=$vid and `number`=$number;";
        $result=mysqli_query($conn, $sql);

        if(mysqli_num_rows($result)<=1)
        {
            $verify=1;
        }
        else if(mysqli_num_rows($result)>1)
        {
            $verify=0;
            $_SESSION['update_err']="Sorry number Allready Exist in your contact";
        }

        // code for email field formatting 
        if($email=="")
        {
            $email="Not Found";
        }

        // code from here to exicute the query in the databases to updtae the contact details
        if($verify==1)
        {
            $sql="UPDATE `num_records` SET `name` = '$name ', `number` = '$number', `email` =   '$email' WHERE    `num_records`.`s_no` = $id;";

            $result=mysqli_query($conn, $sql);

            if($result)
            {
                $_SESSION['login_success']="Contact Updated successfully ..";
                header("Location: ../index.php");
            }
            else
            {
                $_SESSION['update_err']="Sorry, could not update";
            }
        }
    }
    else
    {
        $_SESSION['update_err']="Please enter a valid number";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Contact| Online Contact Saving</title>
    <link rel="stylesheet" href="../css/create.css">
</head>
<body>
<!-- code for notification  -->
<?php
    if(isset($_SESSION['update_err']))
    {?>
        <div class="notification" id="notification-id">
            <p><?php echo $_SESSION['update_err']; ?></p>
                <button onclick="closeLoginError()">X</button>
        </div>
<?php unset($_SESSION['update_err']);}
?>

<!-- code for another part of the body  -->
    <div class="container">
        <div class="form-container">
            <div class="form-title">
                <p>Update Contact</p>
            </div>
            <form action="" method="post" class="main-form-container">
                <div class="form-field">
                    <input type="text" value="<?php echo$fname;?>" name="c-name" id="c-name" maxlength="50" placeholder="Name" required>
                </div>

                <div class="form-field">
                    <input type="tel" value="<?php echo$fnumber;?>" name="c-number" id="c-number" maxlength="10" minlength="10" placeholder="Phone Number" required>
                </div>

                <div class="form-field">
                    <input type="Email" value="<?php echo$femail;?>" name="c-email" id="c-email" maxlength="100" placeholder="Email">
                </div>

                <div class="form-field">
                    <input type="submit" name="save-btn" id="save-btn" value="Update">
                </div>
            </form>
        </div>
    </div>
    <script src="../javascript/index.js"></script>
</body>
</html>