<?php
include('partials/menu.php');
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>


        <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            ?>

        <form action="" method="post">
        <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="fullname" placeholder="Enter Your Name">
                    </td>
                </tr>
                <tr>
                    <td>User Name:</td>
                    <td>
                        <input type="text" name="username" placeholder="Enter Your User Name">
                    </td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="password" placeholder="Enter Your Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </from>
    </div>
</div>
<?php
include('partials/footer.php');
?>

<?php
if(isset($_POST["submit"])){
    $fullname=$_POST['fullname'];
    $username=$_POST['username'];
    $password=md5($_POST['password']);
    $sql="INSERT INTO tbl_admin SET 
    fullname='$fullname',
    username='$username',
    password='$password'";
    
   $res=mysqli_query($conn,$sql) or die(mysqli_error());
   if($res==TRUE){
    $_SESSION['add']="<div style='color:green';>Admin Added Successfully</div>";
    header('location:'. SITURAL . 'admin/manaage-admin.php');

   }
   else{
    $_SESSION['add']="<div style='color:red';>Failed To Admin</div>";
    header('location:'. SITURAL . 'admin/add-admin.php');

   }
}

?>