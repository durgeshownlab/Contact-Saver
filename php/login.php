<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $mobile=$_POST['mobile'];
    $passwd=$_POST['passwd'];

    if(is_numeric($mobile))
    {
        include "../partials/_dbconnect.php";

        $sql="SELECT * FROM `user_table` WHERE `mobile` = '$mobile'";
        $result=mysqli_query($conn, $sql);

        if(mysqli_num_rows($result)>0 && mysqli_num_rows($result)<=1)
        {
            $row=mysqli_fetch_assoc($result);

            if($row['password']==$passwd)
            {
                echo"Name : ".$row['user_name'];

                $_SESSION['username']=$row['user_name'];
                $_SESSION['s_no']=$row['s_no'];
                unset($_SESSION['login_err']);

                $_SESSION['login_success']="Login successfull..";
                header("Location: ../index.php");
            }
            else
            {
                $_SESSION['login_err']="Incorrect password";
            }
        }
        else
        {
            $_SESSION['login_err']="User not found";
        }
    }
    else
    {
        $_SESSION['login_err']="Please Enter Correct Phone Number";
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Online Contact Saving</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
     <!-- code for ERR notification -->
<?php
    if(isset($_SESSION['login_err']))
    {?>
        <div class="notification" id="notification-id">
            <p><?php echo $_SESSION['login_err']; ?></p>
            <form action="" method="get">
                <button onclick="closeLoginError()">X</button>
            </form>
        </div>
<?php unset($_SESSION['login_err']);}
?>

<!-- code for success  -->
<?php
    if(isset($_SESSION['signup_success']))
    {?>
        <div class="notification-success" id="notification-success-id">
            <p><?php echo $_SESSION['signup_success']; ?></p>
            <form action="" method="get">
                <button onclick="closeSignupSuccess()">X</button>
            </form>
        </div>
<?php unset($_SESSION['signup_success']);}
?>

    <div class="container">
       
        <!-- code for container  -->
        <div class="form-container">
            <div class="form-title">
                <p>Log in</p>
            </div>
            <form action="login.php" method="post" class="main-form-container">
                <div class="form-field">
                    <input type="tel" name="mobile" id="mobile" maxlength="10" minlength="10" placeholder="Mobile" required>
                </div>

                <div class="form-field">
                    <input type="password" name="passwd" id="passwd" maxlength="50" placeholder="Password" required>
                </div>
                <div class="form-field">
                    <input type="submit" name="submit-btn" id="submit-btn" value="Log in">
                </div>
                <div class="form-field">
                    <p>Create an account ? <a href="signup.php">Sign up</a></p>
                </div>
            </form>
        </div>
    </div>

    <script src="../javascript/index.js"></script>
</body>
</html>