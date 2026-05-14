<?php
//remeber me
require_once("../model/UserModel.php");
function saveToken($id){
    $token = bin2hex(random_bytes(16));
    $hashedToken = hash('sha256', $token);
    saveRememberToken(['id' => $id, 'remember_token' => $hashedToken]);
        setcookie('id', $id, time() + (86400 * 30), "/");
        setcookie('remember_token', $token, time() + (86400 * 30), "/");
    }

function checkRememberMe(){
    if (isset($_COOKIE['id']) && isset($_COOKIE['remember_token'])){
        $token= $_COOKIE['remember_token'];
        $hashedToken = hash('sha256', $token);
        $row = getUserByToken($hashedToken);
        if ($row){
            $_SESSION ['id']= $row['id'];
            $_SESSION ['user name '] = $row['name'];    
            $_SESSION ['user role '] = $row['role'];
        }
    }
}