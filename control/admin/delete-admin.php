<?php
include('../config/constant.php');
$id=$_GET['id'];
$sql="DELETE FROM tbl_admin WHERE id=$id";
$res=mysqli_query($conn,$sql);
if($res==TRUE){
    $_SESSION['delete']="<div style='color:green';>Admin Delete Successfully</div>";
    header('location:'. SITURAL . 'admin/manaage-admin.php');
}
else{
    $_SESSION['delete']="<div style='color:red';>Failed To Deleted Admin. Try Again Later.</div>";
    header('location:'. SITURAL . 'admin/manaage-admin.php');
}
?>