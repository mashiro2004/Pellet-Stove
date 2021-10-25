<?php
$password='eleomar';
$param_password = password_hash($password, PASSWORD_DEFAULT);
echo $param_password;
?>