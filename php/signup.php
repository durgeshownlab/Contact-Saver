<?php
session_start();
ob_start();
include "../partials/_dbconnect.php";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // getting data from form 
    $username=$_POST['username'];
    $mobile=$_POST['mobile'];
    $passwd=$_POST['passwd'];
    $cpasswd=$_POST['cpasswd'];
    $img="../img";

    // verify that user with this phone number is allready exist
    if(is_numeric($mobile))
    {
        $sql="SELECT * FROM `user_table` WHERE `mobile`=$mobile;";
        $result=mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)<1)
        {
            $verify=1;
        }
        else
        {
            $verify=0;
            $_SESSION['signup_err']="User Already exist Just login please";
        }

        // next step of verification  
        if($verify==1)
        {
            if($passwd != $cpasswd)
            {
                $_SESSION['signup_err']="Password not matched.";
            }
            else
            {
                // code to insert the data into databases table 
                $sql="INSERT INTO `user_table` (`user_name`, `mobile`, `password`,  `user_image`) VALUES     ('$username', '$mobile', '$passwd', '$img');";
                $result=mysqli_query($conn, $sql);
                if($result)
                {
                    $_SESSION['signup_success']="registered successfuly";

                    // unset($_SESSION['signup_err']);
                    // session_destroy();
                    header("Location: ../index.php");
                }
                else
                {
                    $_SESSION['signup_err']="could not registered";
                }
            }
        }
    }
    else
    {
        $_SESSION['signup_err']="only number allow in Phone number feild";
    }
}   


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup | Online Contact Saving</title>
    <link rel="stylesheet" href="../css/signup.css">
</head>
<body>
     <!-- code for notification -->
     <?php
    if(isset($_SESSION['signup_err']))
    {?>
        <div class="notification" id="notification-id">
            <p><?php echo $_SESSION['signup_err']; ?></p>
            <form action="" method="get">
                <button onclick="closeLoginError()">X</button>
            </form>
        </div>
<?php unset($_SESSION['signup_err']);}
?>
    <div class="container">
        <div class="form-container">

            <div class="form-title">
                <p>Register Here</p>
            </div>

            <form action="signup.php" method="post" class="main-form-container">

                <div class="form-field">
                    <input type="text" name="username" id="username" maxlength="50" placeholder="Username" required>
                    <input type="tel" name="mobile" id="mobile" maxlength="10" minlength="10" placeholder="Mobile" required>
                </div>

                <div class="form-field">
                    <input type="password" name="passwd" id="passwd" maxlength="50" placeholder="Password" required>
                    <input type="password" name="cpasswd" id="cpasswd" maxlength="50" placeholder="confirm Password" required>
                </div>

                <div class="form-field">
                    <input type="file" name="pro_img" id="pro_img" disabled>
                </div>

                <div class="form-field">
                    <input type="submit" name="submit-btn" id="submit-btn" value="Sign up">
                </div>

                <div class="form-field go-to-login">
                    <p>Already have an account ? <a href="login.php">Login</a></p>
                </div>

            </form>
        </div>
    </div>

    <script src="../javascript/index.js"></script>
</body>
</html>