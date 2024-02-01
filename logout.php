<?php 
session_start();
unset($_SESSION['role']);
unset($_SESSION['user_id']);
unset($_SESSION['name']);
header('location:login.php');
?>