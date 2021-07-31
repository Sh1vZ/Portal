<?php

require '../vendor/autoload.php';

if (isset($_POST['insertData'])) {
  $empty = false;
  $uname = !empty($_POST['uname']) ? $_POST["uname"] : $empty = true;
  $pwd = !empty($_POST['pwd']) ? $_POST["pwd"] : $empty = true;

  if ($empty == true) {
    header('Location:../views/Users.php?msg=emptyFields');
  } else {
      $record = User::insertOrIgnore(['username' => $uname, 'password' => password_hash($pwd, PASSWORD_DEFAULT)]);
      if ($record) {
        header('Location:../views/Users.php?msg=insertSuccess');
      }else{
        header('Location:../views/Users.php?msg=userExists');
      }
  }
}

if (isset($_GET['getId'])) {
  $id = $_GET['getId'];
  $record = User::find($id,['username'])->toArray();
  $data;
  foreach ($record as $row) {
    $data[] = $row;
  }
  header('Content-type:application/json;charset=utf-8');
  echo json_encode(['data' => $data]);
}

if (isset($_POST['updateData'])) {
  $empty = false;
  $rid = $_GET['id'];
  $pwd = !empty($_POST['pwd']) ? $_POST["pwd"] : $empty = true;
  if ($empty == true) {
    header('Location:../views/Users.php?msg=emptyFields');
  } else {
    $count = User::where('username', $uname)->count();
      $record = User::where('id', $rid)->update(['password' => password_hash($pwd, PASSWORD_DEFAULT)]);
      if ($record) {
        header('Location:../views/Users.php?msg=updateSuccess');
      }
  }
}

if(isset($_GET['delete'])){
  $id=$_GET['delete'];
  $res=User::where('id',$id)->delete();
  if($res){
    header('Location:../views/Users.php?msg=deleteSuccess');
  }
}
