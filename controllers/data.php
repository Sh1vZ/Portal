<?php

require "../vendor/autoload.php";
session_start();
function formatDate($date)
{
  $fdate = date('Y-m-d', strtotime(str_replace('-', '/', $date)));
  return $fdate;
}


if (isset($_POST['insertData'])) {
  $empty = false;
  $id = !empty($_POST['id']) ? $_POST["id"] : $empty = true;
  $code = !empty($_POST['code']) ? $_POST["code"] : $empty = true;
  $dateStart = !empty($_POST['dateStart']) ? formatDate($_POST["dateStart"]) : $empty = true;
  $dateEnd = !empty($_POST['dateEnd']) ? formatDate($_POST["dateEnd"]) : $empty = true;
  $nr1 = !empty($_POST['nr1']) ? $_POST["nr1"] : $empty = true;
  $nr2 = !empty($_POST['nr2']) ? $_POST["nr2"] : $empty = true;
  $dateExp = !empty($_POST['dateExp']) ? formatDate($_POST["dateExp"]) : $empty = true;

  if ($empty == true) {
    header('Location:../views/Home.php?msg=emptyFields');
  } else {
    $record = Data::create(['idRecord' => $id, 'code' => $code, 'startDate' => $dateStart, 'endDate' => $dateEnd, 'nr1' => $nr1, 'nr2' => $nr2, 'expireDate' => $dateExp]);
    if ($record) {
      Audit::create(['username'=>$_SESSION['username'],'role'=>$_SESSION['role'],'action'=>'Created a data record.']);
      header('Location:../views/Home.php?msg=insertSuccess');
    }
  }
}

//get data record
if (isset($_GET['getId'])) {
  $id = $_GET['getId'];
  $record = Data::find($id)->toArray();
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
  $id = !empty($_POST['id']) ? $_POST["id"] : $empty = true;
  $code = !empty($_POST['code']) ? $_POST["code"] : $empty = true;
  $dateStart = !empty($_POST['dateStart']) ? formatDate($_POST["dateStart"]) : $empty = true;
  $dateEnd = !empty($_POST['dateEnd']) ? formatDate($_POST["dateEnd"]) : $empty = true;
  $nr1 = !empty($_POST['nr1']) ? $_POST["nr1"] : $empty = true;
  $nr2 = !empty($_POST['nr2']) ? $_POST["nr2"] : $empty = true;
  $dateExp = !empty($_POST['dateExp']) ? formatDate($_POST["dateExp"]) : $empty = true;
  if ($empty == true) {
    header('Location:../views/Home.php?msg=emptyFields');
  } else {
    $record = Data::where('id', $rid)->update(['idRecord' => $id, 'code' => $code, 'startDate' => $dateStart, 'endDate' => $dateEnd, 'nr1' => $nr1, 'nr2' => $nr2, 'expireDate' => $dateExp]);
    if ($record) {
      Audit::create(['username'=>$_SESSION['username'],'role'=>$_SESSION['role'],'action'=>'Updated a data record.']);
      header('Location:../views/Home.php?msg=updateSuccess');
    }
  }
}

if(isset($_GET['delete'])){
  $id=$_GET['delete'];
  $res=Data::where('id',$id)->delete();
  if($res){
    Audit::create(['username'=>$_SESSION['username'],'role'=>$_SESSION['role'],'action'=>'Deleted a data record.']);
    header('Location:../views/Home.php?msg=deleteSuccess');
  }
}

