<?php

require "../vendor/autoload.php";
include 'data.php';


$valid_extensions = array('unl');
$file = $_FILES['file']['tmp_name'];
$name = $_FILES['file']['name'];
$targetPath = '../uploads/' . $name;
$ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
if (in_array($ext, $valid_extensions)) {
  if (move_uploaded_file($file, $targetPath)) {
    insertData($name);
  }
} else {
  echo 'incorrect file';
}

function insertData($file)
{
  $handle = fopen('../uploads/' . $file, "r");
  $status = 0;

  if ($handle) {
    while (($line = fgets($handle)) !== false) {
      $arrData = explode("|", $line);
      if (!empty($arrData)) {
        $record = Data::create(['idRecord' => $arrData[0], 'code' => $arrData[1], 'startDate' => formatDate($arrData[2]), 'endDate' => formatDate($arrData[3]), 'nr1' => $arrData[4], 'nr2' => $arrData[6], 'expireDate' => formatDate($arrData[7])]);
        if ($record) {
          $status = 1;
        }
      }
    }
    fclose($handle);
  } else {
    $status = 0;
  }

  if ($status == 1) {
    echo 'success';
    unlink('../uploads/' . $file);
  } else {
    echo 'failed';
  }
}
