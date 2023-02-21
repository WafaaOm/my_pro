<?php
include('../config/constant.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lodin-Food Order Website</title>
    <link rel="stylesheet" href="../css/admin1.css">
</head>
<body>
    <div class="login1">
        <h1 class="text-center">Login</h1><br><br>
        <?php
        if(isset($_SESSION['login'])){
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        if(isset($_SESSION['no-loin-message'])){
            echo $_SESSION['no-loin-message'];
            unset($_SESSION['no-loin-message']);
        }
        ?><br><br>
        <form action="" method="POST" class="text-center">
            User Name:<br>
            <input type="text" name="username" placeholder="Enter User Name"><br><br>
            Password:<br>
            <input type="password" name="password" placeholder="Enter Password"><br><br>
            <input type="submit" name="submit" value="Login" class="btn-primary"><br><br>
        </form>
        <p class="text-center">Created By -<a href="www.vijaythapa.com">Vijay Thapa</a></p>
    </div>
</body>
</html>
<?php
if(isset($_POST['submit'])){
    $username=mysqli_real_escape_string($conn,$_POST['username']);
    $row_password=md5($_POST['password']);
    $password=mysqli_real_escape_string($conn,$row_password);
    $sql="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
    $res=mysqli_query($conn,$sql);
    $count=mysqli_num_rows($res);
    if($count==1){
        $_SESSION['login']="<div style='color:green'>Login Successful.</div>";
        $_SESSION['user']=$username;
        header('location:'.SITURAL.'admin/');
    }
    else{
        $_SESSION['login']="<div class='text-center' style='color:red'>Username Or Password Didn't Match.</div>";
        header('location:' .SITURAL. 'admin/login.php');
    }
    }
?>