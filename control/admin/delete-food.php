<?php
include('../config/constant.php');
if(isset($_GET['id']) && isset($_GET['image_name'])){
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];
    if($image_name!=""){
        $path="../images/food/".$image_name;
        $remove=unlink($path);
        if($remove==false){
            $_SESSION['upload']="<div style='color:red;'>Failed To Remove Image.</div>";
            header('location:'.SITURAL.'admin/manage-food.php');
            die();
        }
    }
    $sql="DELETE FROM tbl_food WHERE id=$id";
    $res=mysqli_query($conn,$sql);
    if($res==true){
        $_SESSION['delete']="<div style='color:green;'>Food Deleted Successfully.</div>";
        header('location:'.SITURAL.'admin/manage-food.php');
    }
    else{
        $_SESSION['delete']="<div style='color:red;'>Failed To Deleted Food.</div>";
        header('location:'.SITURAL.'admin/manage-food.php');
    }
}
else{
  $_SESSION['Unauthorized']="<div style='color:red;'>Unauthorized Access.</div>";
  header('location:'.SITURAL.'admin/manage-food.php');  
}
?>