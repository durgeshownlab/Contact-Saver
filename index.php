<?php
session_start();
if(!isset($_SESSION['username']))
{
    header('Location: php/login.php');
    exit;
}

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $logout=$_POST['logout-btn'];
    if(isset($logout))
    {
        session_unset();
        session_destroy();
        header('Location: php/login.php');
        exit;
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Online Contact Saving</title>
    <link rel="stylesheet" href="css/index.css">

    <!-- code for font awasome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<!-- code for success  -->
<?php
    if(isset($_SESSION['login_success']))
    {?>
        <div class="notification-success" id="notification-success-id">
            <p><?php echo $_SESSION['login_success']; ?></p>
            <button onclick="closeSignupSuccess()">X</button>
        </div>
<?php unset($_SESSION['login_success']);}
?>

    <div class="container">

        <!-- code for header part is start from here  -->
        <div class="header">
            <div class="header-left">
                <div class="logo">
                    <a href="index.php">Contact  Saver</a>
                </div>
                <div class="menu-icon" onclick="menu()">
                    <i class="fa fa-bars"></i>
                </div>
            </div>

            <div class="header-right" id="id-header-right">
                <form action="index.php" method="POST" class="logout-form">
                    <input type="submit" name="logout-btn" id="logout-btn" value="Log out">
                </form>
                <p><?php echo"".$_SESSION['username'] ?></p>
                <div class="profile-image">
                    <img src="img/user_image/default_icon2.png">
                </div>
            </div>
        </div>

        <!-- code for center part is start from here  -->
        <div class="center-part">
            <div class="center-left">
                <button>
                   <a href="php/create.php">Create new contact</a>
                </button>
            </div>

            <div class="center-right">
                
                <!-- code for data display -->
                <?php 
                        
                include "partials/_dbconnect.php";
                $s_no=$_SESSION['s_no'];
                
                $sql="SELECT * FROM `num_records` WHERE `s_no_user` = '$s_no'";
                $result=mysqli_query($conn, $sql);
                
                if (mysqli_num_rows($result)>=1) 
                {
                    $i=1;
                    while($row=mysqli_fetch_assoc($result))
                   {?>
                        <div class="card">
                            <div class="card-details">
                                <div class="s-no">
                                    <p><?php echo$i;?></p>
                                </div>
                                <div class="name">
                                    <p><?php echo$row['name'];?></p>
                                </div>
                                <div class="number">
                                    <p><?php echo$row['number'];?></p>
                                </div>
                                <div class="email">
                                    <p><?php echo$row['email'];?></p>
                                </div>
                            </div>
                            <div class="card-btn">
                                <div class="delete">
                                    <button class="delete-btn">
                                        <a href="php/delete.php?id=<?php echo $row['s_no'];?>">Delete</a>
                                    </button>
                                </div>
                                <div class="update">
                                    <button class="update-btn">
                                        <a href="php/update.php?id=<?php echo $row['s_no'];?>&number=<?php echo $row['number'];?>">Update</a>
                                    </button>
                                </div>
                                <div class="call">
                                    <button class="call-btn">
                                        <a href="tel:+<?php echo$row['number']?>">Call Now</a>
                                    </button>
                                </div>
                            </div>
                        </div>
                <?php
                    $i++;
                    }
                }
                ?>


                <!-- <div class="card">
                    <div class="card-details">
                        <div class="s-no">
                            <p>1.</p>
                        </div>
                        <div class="name">
                            <p>durgesh kumar</p>
                        </div>
                        <div class="number">
                            <p>7667107173</p>
                        </div>
                        <div class="email">
                            <p>durgeshkumarraj62@gmail.com</p>
                        </div>
                    </div>
                    <div class="card-btn">
                        <div class="delete">
                            <button class="delete-btn">
                                <a href="#">Delete</a>
                            </button>
                        </div>
                        <div class="update">
                            <button class="update-btn">
                                <a href="#">Update</a>
                            </button>
                        </div>
                        <div class="call">
                            <button class="call-btn">
                                <a href="#">Call Now</a>
                            </button>
                        </div>
                    </div>
                </div> -->



            </div>
        </div>
    </div>

    <script src="javascript/index.js"></script>
</body>
</html>