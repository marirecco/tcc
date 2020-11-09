<?php
$host = "localhost";
$user = "root";
$senha = "";
$db = "plataformaexpert";

$conection = mysqli_connect($host, $user, $senha) or die (mysql_error());
mysqli_select_db($conection, $db) or die (mysqli_error());
?>