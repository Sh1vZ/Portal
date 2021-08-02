<?php

include "../vendor/autoload.php";

if (isset($_POST['login'])) {
  $uname = !empty($_POST['uname']) ? $_POST["uname"] : null;
  $pwd = !empty($_POST['pwd']) ? $_POST["pwd"] : null;
  $type = $_POST['type'];

  if ($type == 'admin') {
    $count = Admin::where('username', $uname)->count();
    if ($count > 0) {
      $user = Admin::where('username', $uname)->first();
      $corrpwd = password_verify($pwd, $user['password']);
      if ($corrpwd) {
        session_start();
        $_SESSION['loggedIn'] = true;
        $_SESSION['role'] = 'Admin';
        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        Audit::create(['username' => $_SESSION['username'], 'role' => $_SESSION['role'], 'action' => "Logged In"]);
        header('Location:../views/Home.php');
      } else {
        header('Location:../index.php?msg=incorrectPassword');
      }
    } else {
      header('Location:../index.php?msg=incorrectUser');
    }
  } elseif ($type == 'user') {
    $count = User::where('username', $uname)->count();
    if ($count > 0) {
      $user = User::where('username', $uname)->first();
      $corrpwd = password_verify($pwd, $user['password']);
      if ($corrpwd) {
        session_start();
        $_SESSION['loggedIn'] = true;
        $_SESSION['role'] = 'User';
        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        Audit::create(['username' => $_SESSION['username'], 'role' => $_SESSION['role'], 'action' => "Logged In"]);
        header('Location:../views/Home.php');
      } else {
        header('Location:../index.php?msg=incorrectPassword');
      }
    } else {
      header('Location:../index.php?msg=incorrectUser');
    }
  } else {
    header('Location:../index.php?msg=incorrectUser');
  }
}


if (isset($_GET['action'])) {
  if ($_GET['action'] == 'logout') {
    session_start();
    session_unset();
    session_destroy();
    header('Location:../index.php');
  }
}
