<?php

$password = "123456789";
$password = password_hash($password, PASSWORD_DEFAULT);
var_dump($password);
