<?php 
//logouyt
session_start();
require_once("../model/UserModel.php");

if (isset($_SESSION['id'])) {
    clearRememberToken($_SESSION['id']);
} 
    session_unset();
    session_destroy();
    setcookie('remember_token', '', time() - 3600, "/");
    header ('location: ../view/auth/login.php?success=logged_out');
    exit();

 ?>