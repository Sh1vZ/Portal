<?php

include 'export.php';
require '../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
		echo  'Incorrect File';
	}
}

function sendMail($mailto, $body, $subj, $file)
{
	$mail = new PHPMailer(true);
	//Enable SMTP debugging.
	// $mail->SMTPDebug = 3;
	//Set PHPMailer to use SMTP.
	$mail->isSMTP();
	//Set SMTP host name                          
	$mail->Host = "smtp.gmail.com";
	//Set this to true if SMTP host requires authentication to send email
	$mail->SMTPAuth = true;
	//Provide username and password     
	$mail->Username = "testemailformails@gmail.com";
	$mail->Password = "testpasswordformails";
	//If SMTP requires TLS encryption then set it
	$mail->SMTPSecure = "tls";
	//Set TCP port to connect to
	$mail->Port = 587;

	$mail->setFrom("testemailformails@gmail.com","Test Mailer");

	$mail->addAddress(strval($mailto));
	$mail->addAttachment('../uploads/' . $file);
	$mail->isHTML(true);

	$mail->Subject = strval($subj);
	$mail->Body = strval($body);

	try {
		$mail->send();
		echo "Message has been sent successfully";
		Audit::create(['username' => $_SESSION['username'], 'role' => $_SESSION['role'], 'action' => "Mailed $file to $mailto"]);
	} catch (Exception $e) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	}
}

$empty = false;
$mail = !empty($_POST['adress']) ? $_POST["adress"] : $empty = true;
$body = !empty($_POST['body']) ? $_POST["body"] : $empty = true;
$type = !empty($_POST['type']) ? $_POST["type"] : $empty = true;
$subj = !empty($_POST['subj']) ? $_POST["subj"] : $empty = true;
$file = $_FILES['file']['tmp_name'];
$name = $_FILES['file']['name'];
$filename = uploadFile($file, $name);
if ($type == 'excel' or $type == 'csv') {
	$fileExport = exportExcel($filename, $type);
	sendMail($mail, $body, $subj, $fileExport);
	unlink('../uploads/' . $fileExport);
} elseif ($type == 'pdf') {
	$fileExport = exportPDF($filename);
	sendMail($mail, $body, $subj, $fileExport);
	unlink('../uploads/' . $fileExport);
} elseif ($type == 'word') {
	$fileExport = exportWord($filename);
	sendMail($mail, $body, $subj, $fileExport);
	unlink('../uploads/' . $fileExport);
} elseif ($type == 'json') {
	$fileExport = exportJson($filename);
	sendMail($mail, $body, $subj, $fileExport);
	unlink('../uploads/' . $fileExport);
} else {
	$empty = true;
}
