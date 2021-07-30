<?php

require "../vendor/autoload.php";

$user = Admin::create(['username' => 'admin',"password"=>password_hash("123", PASSWORD_DEFAULT)]);