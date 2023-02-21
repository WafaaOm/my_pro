<?php
include('../config/constant.php');
session_destroy();
header('location:'.SITURAL.'admin/login.php');
?>