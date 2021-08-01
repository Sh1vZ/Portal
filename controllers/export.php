<?php

require '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;

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
        return $fileName;
      } catch (Exception $e) {
        echo 'Export Failed';
      }
    }
    if ($type == 'csv') {
      $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
      $fileName = $file . '.csv';
      try {
        $writer->save('../uploads/' . $fileName);
        return $fileName;
      } catch (Exception $e) {
        echo 'Export Failed';
      }
    }

    fclose($handle);
  } else {
    echo 'Failed to open file';
  }
}

function exportPDF($file)
{
  $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
  $handle = fopen('../uploads/' . $file, "r");
  $html = '';
  $html .= '<table border="1" cellspacing="0" cellspadding="0" width="100%">
	<thead>
      <tr>
      <th>ID</th>
      <th>Code</th>
      <th>Start Date</th>
      <th>End Date</th>
      <th>Nr 1</th>
      <th>%</th>
      <th>NR 2</th>
      <th>Expiry Date</th>
    </tr>
  </thead>
   <tbody>';
  if ($handle) {
    while (($line = fgets($handle)) !== false) {
      $arrData = explode("|", $line);
      $html .= "<tr>
      <td>$arrData[0]</td>
      <td>$arrData[1]</td>  
      <td>$arrData[2]</td>
      <td>$arrData[3]</td>
      <td>$arrData[4]</td>
      <td>$arrData[5]</td>
      <td>$arrData[6]</td>
      <td>$arrData[7]</td>
      </tr>";
    }
    $html .= '</tbody></table>';
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->WriteHTML($html);
    $fileName = $file . '.pdf';
    $mpdf->Output('../uploads/' . $fileName, 'F');
    return $fileName;
    fclose($handle);
  } else {
  }
}

function exportWord($file)
{
  $phpWord = new \PhpOffice\PhpWord\PhpWord();
  $section = $phpWord->addSection();
  $section->addTextBreak(1);
  $header = array('size' => 16, 'bold' => true);
  $section->addText(htmlspecialchars('Data'), $header);

  $styleTable = array('borderSize' => 6, 'borderColor' => '006699', 'cellMargin' => 80);
  $styleFirstRow = array('borderBottomSize' => 18, 'borderBottomColor' => '0000FF', 'bgColor' => '66BBFF');
  $styleCell = array('valign' => 'center');
  $styleCellBTLR = array('valign' => 'center', 'textDirection' => \PhpOffice\PhpWord\Style\Cell::TEXT_DIR_BTLR);
  $fontStyle = array('bold' => true, 'align' => 'center');
  $phpWord->addTableStyle('Fancy Table', $styleTable, $styleFirstRow);
  $table = $section->addTable('Fancy Table');
  $table->addRow(900);
  $table->addCell(2000, $styleCell)->addText(htmlspecialchars('ID'), $fontStyle);
  $table->addCell(2000, $styleCell)->addText(htmlspecialchars('Code'), $fontStyle);
  $table->addCell(2000, $styleCell)->addText(htmlspecialchars('Start Date'), $fontStyle);
  $table->addCell(2000, $styleCell)->addText(htmlspecialchars('End Date'), $fontStyle);
  $table->addCell(2000, $styleCell)->addText(htmlspecialchars('Nr 1'), $fontStyle);
  $table->addCell(2000, $styleCell)->addText(htmlspecialchars('Percent'), $fontStyle);
  $table->addCell(2000, $styleCell)->addText(htmlspecialchars('Nr 2'), $fontStyle);
  $table->addCell(2000, $styleCell)->addText(htmlspecialchars('Expire Date'), $fontStyle);

  $handle = fopen('../uploads/' . $file, "r");
  if ($handle) {
    while (($line = fgets($handle)) !== false) {
      $arrData = explode("|", $line);
      if (!empty($arrData)) {
        $table->addRow();
        $table->addCell(2000)->addText($arrData[0]);
        $table->addCell(2000)->addText($arrData[1]);
        $table->addCell(2000)->addText($arrData[2]);
        $table->addCell(2000)->addText($arrData[3]);
        $table->addCell(2000)->addText($arrData[4]);
        $table->addCell(2000)->addText($arrData[5]);
        $table->addCell(2000)->addText($arrData[6]);
        $table->addCell(2000)->addText($arrData[7]);
      }
    }
    fclose($handle);
  } else {
  }
  $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
  $fileName = $file . '.docx';
  $objWriter->save('../uploads/' . $fileName);
  return $fileName;
}

function exportJson($file)
{
  $handle = fopen('../uploads/' . $file, "r");
  $arr = array();
  $res = array();
  if ($handle) {
    while (($line = fgets($handle)) !== false) {
      $arrData = explode("|", $line);
      if (!empty($arrData)) {
        $arr[] = array('ID' => $arrData[0], 'Code' => $arrData[1], 'StartDate' => formatDate($arrData[2]), 'EndDate' => formatDate($arrData[3]), 'Nr1' => $arrData[4], 'Percent' => $arrData[5], 'Nr2' => $arrData[6], 'ExpireDate' => formatDate($arrData[7]));
      }
    }
    $res['Data'] = $arr;
    $fileName = $file . '.json';
    $fp = fopen('../uploads/' . $fileName, 'w');
    fwrite($fp, json_encode($res));
    fclose($fp);
    return $fileName;
    fclose($handle);
  } else {
  }
}
