<?php
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;

function uploadFile($file, $name)
{
  $valid_extensions = array('unl');
  $targetPath = '../uploads/' . $name;
  $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
  if (in_array($ext, $valid_extensions)) {
    if (move_uploaded_file($file, $targetPath)) {
      return $name;
    }
  } else {
    echo 'incorrect file';
  }
}


function exportExcel($file, $type)
{
  $spreadsheet = new Spreadsheet();
  $sheet = $spreadsheet->getActiveSheet();
  $sheet->setCellValue('A1', 'ID');
  $sheet->setCellValue('B1', 'Code');
  $sheet->setCellValue('C1', 'Start Date');
  $sheet->setCellValue('D1', 'End Date');
  $sheet->setCellValue('E1', 'Nr 1');
  $sheet->setCellValue('F1', 'Percent');
  $sheet->setCellValue('G1', 'Nr 2');
  $sheet->setCellValue('H1', 'Expire Date');
  $handle = fopen('../uploads/' . $file, "r");
  if ($handle) {
    $rowCount = 2;
    while (($line = fgets($handle)) !== false) {
      $arrData = explode("|", $line);
      if (!empty($arrData)) {
        $sheet->setCellValue('A' . $rowCount, $arrData[0]);
        $sheet->setCellValue('B' . $rowCount, $arrData[1]);
        $sheet->setCellValue('C' . $rowCount, $arrData[2]);
        $sheet->setCellValue('D' . $rowCount, $arrData[3]);
        $sheet->setCellValue('E' . $rowCount, $arrData[4]);
        $sheet->setCellValue('F' . $rowCount, $arrData[5]);
        $sheet->setCellValue('G' . $rowCount, $arrData[6]);
        $sheet->setCellValue('H' . $rowCount, $arrData[7]);
        $rowCount++;
      }
    }
    if ($type == 'excel') {
      $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
      $fileName = $file . '.xlsx';
      try {
        $writer->save('../uploads/' . $fileName);
        echo $fileName;
      } catch (Exception $e) {
        echo 'Export Failed';
      }
    }
    if ($type == 'csv') {
      $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
      $fileName = $file . '.csv';
      try {
        $writer->save('../uploads/' . $fileName);
        echo $fileName;
      } catch (Exception $e) {
        echo 'Export Failed';
      }
    }

    fclose($handle);
  } else {
    echo 'Failed to open file';
  }
}

if (isset($_POST['mail'])) {
  $empty = false;
  $mail = !empty($_POST['adress']) ? $_POST["adress"] : $empty = true;
  $body = !empty($_POST['body']) ? $_POST["body"] : $empty = true;
  $type = !empty($_POST['type']) ? $_POST["type"] : $empty = true;
  $file = $_FILES['file']['tmp_name'];
  $name = $_FILES['file']['name'];
  $filename = uploadFile($file, $name);
  exportExcel($filename,'csv');
}
