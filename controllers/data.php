<?php

require "../vendor/autoload.php";

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

  if ($empty = true) {
    header('Location:../views/Home.php?msg=emptyFields');
  } else {
    $record = Data::create(['idRecord' => $id, 'code' => $code, 'startDate' => $dateStart, 'endDate' => $dateEnd, 'nr1' => $nr1, 'nr2' => $nr2, 'expireDate' => $dateExp]);
    if ($record) {
      header('Location:../views/Home.php?msg=insertSuccess');
    }
  }
}
