<?php

include "../vendor/autoload.php";

if (isset($_POST['login'])) {
  $uname = !empty($_POST['uname']) ? $_POST["uname"] : null;
  $pwd = !empty($_POST['pwd']) ? $_POST["pwd"] : null;
  $count = Admin::where('username', $uname)->count();

  if ($count > 0) {
    $user=Admin::where('username', $uname)->first();
    $corrpwd = password_verify($pwd, $user['password']);
    if ($corrpwd) {
      session_start();
      $_SESSION['loggedIn']=true;
      $_SESSION['role']='Admin';
      $_SESSION['id']=$user['id'];
      header('Location:../views/home.php');
    } else {
      header('Location:../index.php?msg=incorrect password');
    }
  } else {
    header('Location:../index.php?msg=incorrect user');
  }
}


if(isset($_GET['action'])){
  if($_GET['action']=='logout'){
    session_unset();
    session_destroy();
    header('Location:../index.php');
  }
}
