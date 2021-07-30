<?php
$valid_extensions = array('unl');
$file = $_FILES['file']['tmp_name'];
$name = $_FILES['file']['name'];
$targetPath = '../uploads/' . $name;
$ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
if (in_array($ext, $valid_extensions)) {
	if(move_uploaded_file($file, $targetPath)){
    echo 'Success';
  }

}
