<?php 
//login 
    session_start();
    require_once("../model/UserModel.php");

     if (isset($_POST['login'])){
              $email  = $_POST['email'];   
           $password  = $_POST['password'];
    if (!$email= "" || !$password = "") {
       header ('location: ../view/auth/login.php?error=empty_fields');
       exit();
    }
    $user = [
         'email' => $email,
      'password' => $password
    ];
    $row = loginUser($user);
    if ($row) {
                 $_SESSION ['id']= $row['id'];
        $_SESSION ['user name '] = $row['name'];    
        $_SESSION ['user role '] = $row['role'];

        if (isset($_POST['remember_me'])){
          require_once ('../rememberMe.php');
          saveToken($row['id']);
        }
        header ('location: ../view/home/index.php');
    }else {
        header ('location: ../view/auth/login.php?error=invalide_credentials');
    }
    exit();
    }else {
        header ('location: ../view/auth/login.php');
        exit();
    }
    ?>