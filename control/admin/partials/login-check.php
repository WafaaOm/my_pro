<?php
if(!isset($_SESSION['user'])){
    $_SESSION['no-loin-message']="<div class='text-center' style='color:red;'>Pleas Login To Access Admin Panel</div>";
    header('location:' .SITURAL. 'admin/login.php');
}
?>