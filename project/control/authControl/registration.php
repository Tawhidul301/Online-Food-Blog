
<?php
//registration
  session_start();  
  require_once("../model/UserModel.php");

  if (isset($_POST['register'])){
              $name   = $_POST['name'];
              $email  = $_POST['email'];   
           $password  = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
              $role   = $_POST['role'];
    if ( $name == "" || $email == "" || $password == "" || $confirm_password == "" || $role == ""){
       header ('location: ../view/auth/register.php?error=empty_fields');
       exit();
  }
  if (strlen($password) < 8){
       header ('location: ../view/auth/register.php?error=short_password');
       exit();
  }
  if ($password != $confirm_password){
       header ('location: ../view/auth/register.php?error=Passwords_mismatch');
       exit();
  }

  if (checkEmailExists($email)){
       header ('location: ../view/auth/register.php?error=Email_exists');
       exit();
  }

  $user = [
          'name' => $name,
         'email' => $email,
      'password' => password_hash($password, PASSWORD_DEFAULT),
          'role' => $role
  ];
  $status = registerUser($user);
  if ($status){
    header ('location: ../view/auth/login.php?success=registered');
  }else { 
    header('location: ../view/auth/register.php?error=registration_failed');
  }
  exit();
  }else {
    header('location: ../view/auth/register.php');
    exit();
  }
  ?>
<!-- //login 
     if (isset($_POST['login'])){
              $email  = $_POST['email'];   
           $password  = $_POST['password'];
    if (!$email || !$password){
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
            setcookie('email', $email, time() + (86400 * 30), '/');
            setcookie('password', $password, time() + (86400 * 30), '/');
        }
        header ('location: ../view/home/index.php');
    }else {
        header ('location: ../view/auth/login.php?error=invalide_credentials');
    }
    exit();
     }
     //remeber me
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
//logouyt
if (isset($_GET['action']) && $_GET['action'] == 'logout'){
    session_unset();
    session_destroy();
    setcookie('email', '', time() - 3600, '/');
    setcookie('password', '', time() - 3600, '/');
    header ('location: ../view/auth/login.php?success=logged_out');
    exit();
}

  
 ?> -->