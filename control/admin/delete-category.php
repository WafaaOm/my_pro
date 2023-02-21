<?php
include('../config/constant.php');
if(isset($_GET['id'] ) AND isset($_GET['image_name'])){
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];
    if($image_name!=""){
        $path="../images/category/".$image_name;
        $remove=unlink($path);
        if($remove==false){
            $_SESSION['remove']="<div style='color:red;'>Failed To Remove Category Image.</div>";
            header('location:'.SITURAL.'admin/manage-category.php');
            die();
        }
    }
    $sql="DELETE FROM tbl_category WHERE id=$id";
    $res=mysqli_query($conn,$sql);
    if($res==true){
        $_SESSION['delete']="<div style='color:green;'>Category Deleted Successfully.</div>";
        header('location:'.SITURAL.'admin/manage-category.php');
    }
    else{
        $_SESSION['delete']="div style='color:red;'>Failed To Deleted Category.</div>";
        header('location:'.SITURAL.'admin/manage-category.php');
    }
}
else{
    header('location:'.SITURAL.'admin/manage-category.php');
}
?>