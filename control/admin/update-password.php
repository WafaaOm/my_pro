<?php
include('partials/menu.php');
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>
        <?php
        if(isset($_GET['id'])){
            $id=$_GET['id'];        }      
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password:</td>
                    <td>
                        <input type="password" name="Current_password" placeholder="Current Password">
                    </td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td>
                        <input type="password" name="conf_password" placeholder="Confirm Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
if(isset($_POST['submit'])){
    $id=$_POST['id'];
    $Current_password=md5($_POST['Current_password']);
    $new_password=md5($_POST['new_password']);
    $conf_password=md5($_POST['conf_password']);
    $sql="SELECT * FROM tbl_admin WHERE id='$id' AND password='$Current_password'";
    $res=mysqli_query($conn,$sql);
    if($res==true){
        $count=mysqli_num_rows($res);
        if($count==1){
            if($new_password==$conf_password){
                $sql2="UPDATE tbl_admin SET 
                password='$new_password'
                WHERE id=$id";
                $res2= mysqli_query($conn,$sql2);
                if($res2==true){
                    $_SESSION['change-bwd']="<div style='color:green;'>Password Change Successfully.</div>";
                    header('location:' .SITURAL. 'admin/manaage-admin.php');
                }
                else{
                    $_SESSION['change-bwd']="<div style='color:red;'>Failed To Change Password.</div>";
                    header('location:' .SITURAL. 'admin/manaage-admin.php');
                }
            }
            else{
                $_SESSION['pwd-not-match']="<div style='color:red;'>User Didn't Match</div>";
                header('location:' .SITURAL. 'admin/manaage-admin.php');
            }
        }
        else{
            $_SESSION['user-not-found']="<div style='color:red;'>User Not Found</div>";
            header('location:' .SITURAL. 'admin/manaage-admin.php');
        }
    }
}
?>

<?php
include('partials/footer.php');
?>